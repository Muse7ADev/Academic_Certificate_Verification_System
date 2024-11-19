<?php
error_reporting(E_ALL); 
ini_set('display_errors', 1);

session_start();

$host = "localhost";
$user = "root";
$password = "";
$db = "acgv";
$conn = mysqli_connect($host, $user, $password, $db);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['edit']) && !empty($_GET['edit'])) {
    $edit_id = $_GET['edit']; 
} else {
    header("Location: view_student.php");
    exit();
}

$stmt = $conn->prepare("SELECT * FROM students WHERE student_id = ?");
$stmt->bind_param("s", $edit_id);
$stmt->execute();
$result = $stmt->get_result();
$info = $result->fetch_assoc();

if (!$info) {
    header("Location: view_student.php");
    exit();
}

if (isset($_POST['update'])) {
    $student_name = $_POST["student_name"];
    $course_name = $_POST["course_name"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $city = $_POST["city"];
    $state = $_POST["state"];
    $college_name = $_POST["college_name"];
    $marks = $_POST["marks"];
    $date_of_joining = $_POST["date_of_joining"];
    $date_of_birth = $_POST["date_of_birth"];
    $gender = $_POST["gender"];
    $address = $_POST["address"];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Invalid email format!";
    } else {
        if (!preg_match("/^(?:[0-3](?:\.\d{2})?|4(\.00)?)$/", $marks)) {
            $error_message = "Invalid GPA. Please enter a valid GPA between 0.00 and 4.00.";
        } else {
            $update_query = "UPDATE students SET student_name=?, course_name=?, phone=?, email=?, city=?, state=?, college_name=?, marks=?, date_of_joining=?, date_of_birth=?, gender=?, address=? WHERE student_id=?";
            $stmt = $conn->prepare($update_query);
            $stmt->bind_param("sssssssssssss", $student_name, $course_name, $phone, $email, $city, $state, $college_name, $marks,$date_of_joining, $date_of_birth, $gender, $address, $edit_id);

            if ($stmt->execute()) {
                $_SESSION['success_message'] = "Student information updated successfully.";
                header("Location: view_student.php"); 
                exit();
            } else {
                $error_message = "Error: " . $stmt->error;
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
    <?php include 'admin_css.php'; ?>
</head>
<body>
    <?php include 'admin_sidebar.php'; ?>

    <div class="content">
        <h1 class="text-center">Update Student</h1>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Student Registration Form</div>
                        <div class="card-body">
                            <?php if (isset($error_message)) { ?>
                                <div class="alert alert-danger"><?php echo $error_message; ?></div>
                            <?php } ?>

                            <?php if (isset($_SESSION['success_message'])) { ?>
                                <div class="alert alert-success"><?php echo $_SESSION['success_message']; unset($_SESSION['success_message']); ?></div>
                            <?php } ?>
                           <!-- Update Form -->
                            <form action="" method="POST">
                                        <div class="form-group">
                                            <label for="student_name">Student Name:</label>
                                            <input type="text" name="student_name" id="student_name" class="form-control" 
                                                value="<?php echo htmlspecialchars($info['student_name']); ?>" required
                                                pattern="[A-Za-z\s]+" title="Only letters and spaces are allowed.">
                                        </div>

                                        <div class="form-group">
                                            <label for="course_name">Course Name:</label>
                                            <input type="text" name="course_name" id="course_name" class="form-control" 
                                                value="<?php echo htmlspecialchars($info['course_name']); ?>" required
                                                pattern="[A-Za-z0-9\s]+" title="Only letters, numbers, and spaces are allowed.">
                                        </div>

                                        <div class="form-group">
                                            <label for="phone">Mobile Number:</label>
                                            <input type="tel" name="phone" id="phone" class="form-control"
                                                value="<?php echo htmlspecialchars($info['phone']); ?>" required
                                                pattern="^\+?[0-9]{1,3}?[-. ]?[0-9]+([-./]?[0-9]+)*" 
                                                title="Please enter a valid phone number (e.g., +123-456-7890).">
                                        </div>

                                        <div class="form-group">
                                            <label for="email">Email ID:</label>
                                            <input type="email" name="email" id="email" class="form-control" 
                                                value="<?php echo htmlspecialchars($info['email']); ?>" required
                                                title="Please enter a valid email address (e.g., example@example.com).">
                                        </div>

                                        <div class="form-group">
                                            <label for="date_of_joining">Date of Joining:</label>
                                            <input type="date" name="date_of_joining" id="date_of_joining" class="form-control" 
                                                value="<?php echo htmlspecialchars($info['date_of_joining']); ?>" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="address">Address:</label>
                                            <input type="text" name="address" id="address" class="form-control" 
                                                value="<?php echo htmlspecialchars($info['address']); ?>" required
                                                title="Please enter your full address.">
                                        </div>

                                        <div class="form-group">
                                            <label for="city">City:</label>
                                            <input type="text" name="city" id="city" class="form-control" 
                                                value="<?php echo htmlspecialchars($info['city']); ?>" required
                                                pattern="[A-Za-z\s]+" title="City should only contain letters and spaces.">
                                        </div>

                                        <div class="form-group">
                                            <label for="state">State:</label>
                                            <input type="text" name="state" id="state" class="form-control" 
                                                value="<?php echo htmlspecialchars($info['state']); ?>" required
                                                pattern="[A-Za-z\s]+" title="State should only contain letters and spaces.">
                                        </div>

                                        <div class="form-group">
                                            <label for="college_name">Organization Name:</label>
                                            <input type="text" name="college_name" id="college_name" class="form-control" 
                                                value="<?php echo htmlspecialchars($info['college_name']); ?>" required
                                                pattern="[A-Za-z0-9\s]+" title="Only letters, numbers, and spaces are allowed.">
                                        </div>

                                        <div class="form-group">
                                            <label for="date_of_birth">Birth Date:</label>
                                            <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" 
                                                value="<?php echo htmlspecialchars($info['date_of_birth']); ?>" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="gender">Gender:</label>
                                            <select name="gender" id="gender" class="form-control" required>
                                                <option value="Male" <?php echo ($info['gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
                                                <option value="Female" <?php echo ($info['gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
                                                <option value="Other" <?php echo ($info['gender'] == 'Other') ? 'selected' : ''; ?>>Other</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="marks">GPA:</label>
                                            <input type="text" name="marks" id="marks" class="form-control" 
                                                value="<?php echo htmlspecialchars($info['marks']); ?>" required
                                                pattern="^(?:[0-3](?:\.\d{2})?|4(\.00)?)$" 
                                                title="Please enter a valid GPA between 0.00 and 4.00 with exactly two decimal places.">
                                        </div>
                                    </form>


                                <button type="submit" name="update" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</body>
</html>
