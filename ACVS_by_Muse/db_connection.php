<?php
// Database connection details
$host = "localhost";  
$user = "root";      
$password = "";      
$db = "acgv";

// Establish the database connection
$conn = mysqli_connect($host, $user, $password, $db);

// Check if the connection is successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

session_start();  // Start session

// Function to escape strings to prevent SQL injection
function escape($string) {
    global $conn;
    return mysqli_real_escape_string($conn, $string);
}

// Query function
function Query($query) {
    global $conn;
    return mysqli_query($conn, $query);
}

// Function to confirm query success
function confirm($result) {
    global $conn;
    if(!$result) {
        die('Query Failed: ' . mysqli_error($conn));
    }
}

// Fetch data from a result set
function fetch_data($result) {
    return mysqli_fetch_array($result);
}

// Count the number of rows in the result set
function count_rows($result) {
    return mysqli_num_rows($result);
}

// Optional: Handle user logout (assuming you want to log out a user)
if (isset($_GET['logout'])) {
    session_destroy();  // End the session if 'logout' parameter is passed
    header("Location: login.php");  // Redirect to login page
    exit;
}

?>
