<?php 
error_reporting(0);
session_start();

// Database connection details
$host = "localhost";
$user = "root";
$password = "";
$dbname = "acgv";

try 
{
    $db = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} 
catch (PDOException $e) 
{
    die("Database connection failed: " . $e->getMessage());
}

// Retrieve all issued certificates
$query = "SELECT * FROM certificates";
$stmt = $db->query($query);
$certificates = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Certificates</title>
    <?php include 'logo.php'; ?>
    <?php include 'admin_css.php'; ?>
</head>
<body>
    
<?php include 'admin_sidebar.php'; ?>

<div class="container mt-5 content">
    <br>
    <center>
    <h2>All Certificates</h2>

    <!-- Display certificates if available -->
    <?php if (count($certificates) > 0): ?>
        <table class="table table-info table-striped table-hover table-bordered border-primary">
            <thead>
            <tr class="table-primary">
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>Course Name</th>
                    <th>Institution</th>
                    <th>Certificate ID</th>
                    <th>GFA</th>
                    <th>Certificate Date</th>
            </tr>
            </thead>
            <tbody class="table-group-divider">
                <?php foreach ($certificates as $certificate): ?>
                    <tr>
                        <td><?php echo $certificate["student_id"]; ?></td>
                        <td><?php echo $certificate["student_name"]; ?></td>
                        <td><?php echo $certificate["course_name"]; ?></td>
                        <td><?php echo $certificate["college_name"]; ?></td>
                        <td><?php echo $certificate["certificate_id"]; ?></td>
                        <td><?php echo $certificate["marks"]; ?></td>
                        <td><?php echo $certificate["date_of_joining"]; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No certificates issued yet.</p>
    <?php endif; ?> 
    </center>
</div>

</body>
</html>
