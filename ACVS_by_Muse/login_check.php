<?php 
error_reporting(0);
session_start();

// Database connection parameters
$host = "localhost";
$user = "root";
$password = "";
$db = "acgv";
$conn = mysqli_connect($host, $user, $password, $db);

// Check for successful connection
if ($conn === false) {
    die("Connection error: " . mysqli_connect_error());
}

// Handle the POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the submitted email and password
    $email = $_POST['email'];
    $pass = $_POST['password'];

    // Check if email or password are empty
    if (empty($email) || empty($pass)) {
        $Message = "Email or Password cannot be empty!";
        $_SESSION['LoginMessage'] = $Message;
        header("location:login.php"); 
        exit();
    }

    // Prepare SQL query (with proper escaping to prevent SQL Injection)
    $email = mysqli_real_escape_string($conn, $email);
    $pass = mysqli_real_escape_string($conn, $pass);

    // Check for matching user credentials
    $sql = "SELECT * FROM admin WHERE email = '".$email."' AND password = '".$pass."' LIMIT 1";
    $result = mysqli_query($conn, $sql);

    // Check if the user exists
    if (mysqli_num_rows($result) == 1) {
        // Redirect to admin home if credentials are correct
        header("location:adminhome.php"); 
        exit();
    } else {
        // Error message for invalid login
        $Message = "Invalid Email or Password!";
        $_SESSION['LoginMessage'] = $Message;
        header("location:login.php"); 
        exit();
    }
}
?>
