<?php
    error_reporting(0);
    session_start();
    $host="localhost";
    $user="root";
    $password="";
    $db="acgv";
    $conn=mysqli_connect($host,$user,$password,$db);

    $sql="select *  from students";
    $result=mysqli_query($conn,$sql);

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
    <?php  
        // Include the sidebar for the admin page
        include 'admin_sidebar.php';
    ?>
    
    <div class="content">
        <center>
          <br>
       <h1>Student Data</h1>
       
       <?php
          if($_SESSION['message'])
       {
          echo $_SESSION['message'];
       }
          unset($_SESSION['message']);
       ?>
<table class="table table-info table-striped table-hover table-bordered border-primary">
  <thead>
    <tr class="table-primary">
      <th scope="col">Student Id</th>
      <th scope="col">Student Name</th>
      <th scope="col">Department</th>
      <th scope="col">Institution</th>
      <th scope="col">Email</th>
      <th scope="col">Phone</th>
      <th scope="col">GPA</th>
      <th scope="col">Joined_date</th>
      <th scope="col">Certificate</th>
      <th scope="col">Delete</th>
      <th scope="col">Update</th>
    </tr>
  </thead>
  <tbody class="table-group-divider">
  <?php
            while($info=$result->fetch_assoc())
            {
            ?>
            <tr>
            <td scope="col"><?php echo "{$info['student_id']}"; ?> </td>
            <td scope="col"><?php echo "{$info['student_name']}"; ?> </td>
            <td scope="col"><?php echo "{$info['course_name']}"; ?>  </td>
            <td scope="col"><?php echo "{$info['college_name']}"; ?>  </td>
            <td scope="col"><?php echo "{$info['email']}"; ?> </td>
            <td scope="col"><?php echo "{$info['phone']}"; ?> </td>
            <td scope="col"><?php echo "{$info['marks']}"; ?> </td>
            <td scope="col"><?php echo "{$info['date_of_joining']}"; ?></td>
            <td scope="col"><?php echo "{$info['isCertIssued']}"; ?> </td>
            <td scope="col"><?php echo "<a onClick=\" javascript:return confirm('Are sure to delete this?');\" 
                                        href='delete_student.php?delete={$info['student_id']}' class='btn btn-danger'>Delete</a>";?></td>
            <td scope="col"><?php echo "<a onClick=\" javascript:return confirm('Are sure to edit this?');\" 
                                        href='update_student.php?edit={$info['student_id']}' class='btn btn-success'>Update</a>"; ?></td>
            </tr>
            <?php
            }
            ?>
  </tbody>
</table>
</center>
</div>
</body>
</html>
