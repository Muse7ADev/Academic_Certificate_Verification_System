


<?php
    session_start();
    $host="localhost";
    $user="root";
    $password="";
    $db="acgv";
    $conn=mysqli_connect($host,$user,$password,$db);
    $sql="select *  from admission";
    $result=mysqli_query($conn,$sql);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admission Dashboard</title>
    <?php
    include 'admin_css.php';
    ?>

</head>
<body>
    
<?php  
    include 'admin_sidebar.php';
?>
    <div class="content">
           <center>
    <h1>Applied For Admission</h1>
    <div class="container">
<table class="table table-info table-striped table-hover table-bordered border-primary">
  <thead>
    <tr class="table-primary">
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Phone</th>
      <th scope="col">Message</th>
    </tr>
  </thead>
  <tbody class="table-group-divider">
  <?php
            while($info=$result->fetch_assoc())
            {
            ?>
            <tr>
            <td><?php echo "{$info['id']}"; ?></td>
            <td><?php echo "{$info['name']}"; ?> </td>
            <td><?php echo "{$info['email']}";?> </td>
            <td><?php echo "{$info['phone']}"; ?> </td>
            <td><?php echo "{$info['message']}";?></td>
            </tr>
            <?php
            }
            ?>
  </tbody>
</table>
</div>
</center>
</div>

</body>
</html>