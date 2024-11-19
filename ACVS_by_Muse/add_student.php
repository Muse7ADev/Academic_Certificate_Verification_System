<?php
error_reporting(E_ALL);
session_start();

$host = "localhost";
$user = "root";
$password = "";
$db = "acgv";
$conn = mysqli_connect($host, $user, $password, $db);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['add_student'])) {
    // Retrieve form data and sanitize inputs
    $student_name = mysqli_real_escape_string($conn, $_POST["student_name"]);
    $course_name = mysqli_real_escape_string($conn, $_POST["course_name"]);
    $phone = mysqli_real_escape_string($conn, $_POST["phone"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $city = mysqli_real_escape_string($conn, $_POST["city"]);
    $state = mysqli_real_escape_string($conn, $_POST["state"]);
    $college_name = mysqli_real_escape_string($conn, $_POST["college_name"]);
    $marks = mysqli_real_escape_string($conn, $_POST["marks"]);
    $date_of_joining = mysqli_real_escape_string($conn, $_POST["date_of_joining"]);
    $date_of_birth = mysqli_real_escape_string($conn, $_POST["date_of_birth"]);
    $gender = mysqli_real_escape_string($conn, $_POST["gender"]);
    $address = mysqli_real_escape_string($conn, $_POST["address"]);

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Invalid email format!";
    } else {
        // Check if the student already exists (based on email or mobile number)
        $check_query = "SELECT student_id FROM students WHERE email = ? OR phone = ?";
        $stmt = mysqli_prepare($conn, $check_query);
        mysqli_stmt_bind_param($stmt, "ss", $email, $phone);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $error_message = "A student with this email or mobile number already exists!";
        } else {
            // Generate student ID
            $prefix = "CGV/24/";
            $next_id = 1;

            $query = "SELECT student_id FROM students WHERE student_id LIKE ?";
            $stmt = mysqli_prepare($conn, $query);
            $search_pattern = $prefix . "%";
            mysqli_stmt_bind_param($stmt, "s", $search_pattern);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $num_rows = mysqli_num_rows($result);

            if ($num_rows > 0) {
                $last_id = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $current_id = intval(substr($row["student_id"], strlen($prefix)));
                    $last_id = max($last_id, $current_id);
                }
                $next_id = $last_id + 1;
            }

            $student_id = $prefix . str_pad($next_id, 4, "0", STR_PAD_LEFT);

            // Set isCertIssued to 0 (as a variable, not a constant)
            $is_cert_issued = 0;

            // Validate and sanitize marks
            $marks = floatval($marks); // Ensure marks are a valid float

            // Insert new student into the database
            $query = "INSERT INTO students (student_id, student_name, course_name, college_name, phone, email, address, city, state, gender, date_of_joining, marks, isCertIssued) 
                      VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 0)";
            $stmt = mysqli_prepare($conn, $query);
            
            // Bind parameters: ensure the types are correct (12 fields, 1 for isCertIssued)
            mysqli_stmt_bind_param($stmt, "ssssssssssss", 
                                   $student_id, $student_name, $course_name, $college_name, $phone, 
                                   $email, $address, $city, $state, 
                                   $gender, $date_of_joining, $marks);

            if (mysqli_stmt_execute($stmt)) {
                $success_message = "Student registered successfully.";
            } else {
                $error_message = "Error: " . mysqli_error($conn);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <?php include 'logo.php'; ?>
    <?php include 'admin_css.php'; ?>
</head>
<body>
    
    <?php include 'admin_sidebar.php'; ?>

    <div class="container mt-5">
        <?php if (isset($success_message)): ?>
            <div class="alert alert-success" role="alert">
                <?php echo htmlspecialchars($success_message, ENT_QUOTES, 'UTF-8'); ?>
            </div>
        <?php endif; ?>
        <?php if (isset($error_message)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo htmlspecialchars($error_message, ENT_QUOTES, 'UTF-8'); ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="content">
        <h1 class="text-center">Add Student</h1> 
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            Student Registration Form
                        </div>
                        <div class="card-body">
                            <form action="" method="POST">
                                <!-- Form fields -->
                                <div class="form-group">
                                <label for="student_name">Student Name:</label>
                                <input type="text" name="student_name" id="student_name" class="form-control" required 
                                 pattern="[A-Za-z\s]+" 
                                  title="Student name should only contain letters and spaces.">
                                </div>

                                <div class="form-group">
                                <label for="course_name">Course Name:</label>
                                <input type="text" name="course_name" id="course_name" class="form-control" required 
                                    pattern="[A-Za-z\s]+" 
                                    title="Course name should only contain letters and spaces.">
                                </div>


                             <div class="form-group">
                                <label for="phone">Mobile Number:</label>
                                <input type="tel" name="phone" id="phone" class="form-control" required
                                    pattern="^\+?[1-9]{1}[0-9]{1,14}$" 
                                    placeholder="e.g. +123-456-7890123"
                                    title="Please enter a valid mobile number (e.g., +123-456-7890123 or +1234567890123).">
                                  </div>


                            <div class="form-group">
                                <label for="email">Email ID:</label>
                                <input type="email" name="email" id="email" class="form-control" required
                                    placeholder="example@example.com" title="Please enter a valid email address.">
                            </div>

                            <div class="form-group">
                                <label for="date_of_joining">Date of Joining:</label>
                                <input type="date" name="date_of_joining" id="date_of_joining" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="address">Address:</label>
                                <input type="text" name="address" id="address" class="form-control" required
                                    placeholder="Enter your address here..." title="Please enter your full address.">
                            </div>

                            <div class="form-group">
                                <label for="city">City:</label>
                                <input type="text" name="city" id="city" class="form-control" required
                                    pattern="[A-Za-z\s]+" title="City should only contain letters and spaces.">
                            </div>

                            <div class="form-group">
                                <label for="state">State:</label>
                                <input type="text" name="state" id="state" class="form-control" required
                                    pattern="[A-Za-z\s]+" title="State should only contain letters and spaces.">
                            </div>

                            <div class="form-group">
                                <label for="college_name">Organization Name:</label>
                                <input type="text" name="college_name" id="college_name" class="form-control" required
                                    title="Please enter the name of your organization.">
                            </div>

                                <div class="form-group">
                                    <label for="date_of_birth">Birth Date:</label>
                                    <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="gender">Gender:</label>
                                    <select name="gender" id="gender" class="form-control" required>
                                        <option value="">Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="marks">GPA:</label>
                                    <input type="text" name="marks" id="marks" class="form-control" required
                                           pattern="^(?:[0-3](?:\.\d{2})?|4(\.00)?)$"
                                           title="Please enter a valid GPA between 0.00 and 4.00 with exactly two decimal places.">
                                </div>

                                <button type="submit" name="add_student" class="btn btn-primary">Register</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     </div>
 </body>
</html>
