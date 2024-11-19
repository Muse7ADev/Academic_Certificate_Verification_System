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
?>