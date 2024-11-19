<?php

error_reporting(0);
session_start();
$host = "localhost";
$user = "root";
$password = "";
$dbname = "acgv"; 

// PDO connection (only PDO is used, removed MySQLi)
try {
    $db = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Function to clean input (sanitize)
function clean($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

// Retrieve students who have not been issued certificates
$query = "SELECT * FROM students WHERE isCertIssued = 0";
$stmt = $db->query($query);
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Issue certificate
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["issue_certificate"])) {
    $student_id = clean($_POST["student_id"]);
    $student_name = clean($_POST["student_name"]);
    $course_name = clean($_POST["course_name"]);
    $college_name = clean($_POST["college_name"]);
    $date_of_joining = clean($_POST["date_of_joining"]);
    $marks = clean($_POST["marks"]);

    // Check if the student already has a certificate
    $query = "SELECT * FROM certificates WHERE student_id = :student_id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":student_id", $student_id);
    $stmt->execute();
    $existing_certificate = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($existing_certificate) {
        $error_message = "Certificate already issued for this student.";
    } else {
        // Generate a random certificate ID
        $certificate_id = generateCertificateID();

        // Insert the certificate into the database
        $query = "INSERT INTO certificates (student_id, student_name, certificate_id, course_name,college_name, marks, date_of_joining) 
                  VALUES (:student_id, :student_name, :certificate_id, :course_name, :college_name, :marks, :date_of_joining)";
        $stmt = $db->prepare($query);
        $stmt->bindParam(":student_id", $student_id);
        $stmt->bindParam(":student_name", $student_name);
        $stmt->bindParam(":certificate_id", $certificate_id);
        $stmt->bindParam(":course_name", $course_name);
        $stmt->bindParam(":college_name", $college_name);
        $stmt->bindParam(":marks", $marks);
        $stmt->bindParam(":date_of_joining", $date_of_joining);

        // Update isCertIssued to 1 in the students table
        $updateQuery = "UPDATE students SET isCertIssued = 1 WHERE student_id = :student_id";
        $updateStmt = $db->prepare($updateQuery);
        $updateStmt->bindParam(":student_id", $student_id);

        $db->beginTransaction();

        try {
            $stmt->execute();
            $updateStmt->execute();
            $db->commit();
            $success_message = "Certificate issued successfully.";
            header('Location: add_certificate.php'); // Redirect after successful certificate issuance
            exit;
        } catch (Exception $e) {
            $db->rollBack();
            $error_message = "Error: " . $e->getMessage();
        }
    }
}

// Function to generate a random certificate ID (using random_int for better randomness)
function generateCertificateID() {
    $characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $certificate_id = "";

    for ($i = 0; $i < 10; $i++) {
        $index = random_int(0, strlen($characters) - 1); // Better randomness with random_int
        $certificate_id .= $characters[$index];
    }

    return $certificate_id;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Certificate</title>
    <?php include 'logo.php'; ?>
    <?php include 'admin_css.php'; ?>
</head>
<body>
    
<?php include 'admin_sidebar.php'; ?>

<div class="container content">
        <center>
    <h2>Add Certificate</h2>
        
    <!-- Display success or error messages -->
    <?php if (isset($success_message)): ?>
        <div class="alert alert-success" role="alert">
            <?php echo $success_message; ?>
        </div>
    <?php endif; ?>

    <?php if (isset($error_message)): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $error_message; ?>
        </div>
    <?php endif; ?>

    <!-- Table to display students without certificates -->
    <?php if (count($students) > 0): ?>
        <table class="table table-info table-striped table-hover table-bordered border-primary">
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>Department</th>
                    <th>Institution</th>
                    <th>Certificate Date</th>
                    <th>GPA</th>
                    <th>Certification</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <?php foreach ($students as $student): ?>
                    <tr>
                        <td><?php echo $student["student_id"]; ?></td>
                        <td><?php echo $student["student_name"]; ?></td>
                        <td><?php echo $student["course_name"]; ?></td>
                        <td><?php echo $student["college_name"]; ?></td>
                        <td><?php echo $student["date_of_joining"]; ?></td>
                        <td><?php echo $student["marks"]; ?></td>
                        <td><form method="POST">
                                <input type="hidden" name="student_id" value="<?php echo $student["student_id"]; ?>">
                                <input type="hidden" name="student_name" value="<?php echo $student["student_name"]; ?>">
                                <input type="hidden" name="course_name" value="<?php echo $student["course_name"]; ?>">
                                <input type="hidden" name="college_name" value="<?php echo $student["college_name"]; ?>">
                                <input type="hidden" name="date_of_joining" value="<?php echo $student["date_of_joining"]; ?>">
                                <input type="hidden" name="marks" value="<?php echo $student["marks"]; ?>">
                                <button type="submit" name="issue_certificate" class="btn btn-primary">Certificate</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No students available to certificate.</p>
    <?php endif; ?> 
    </center>
</div>

</body>
</html>
