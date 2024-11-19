

<?php
    error_reporting(0);
    session_start();
    $host="localhost";
    $user="root";
    $password="";
    $db="acgv";
    $conn=mysqli_connect($host,$user,$password,$db);
        if($_GET['delete'])
        {
            $delete_id=$_GET['delete'];
            $sql="delete from students where student_id='$delete_id' ";
            $result=mysqli_query($conn,$sql);
        }
        if($result)
        {
            $_SESSION['message']='Delete Student is successful!';
            header("location:view_student.php");
        }


?>