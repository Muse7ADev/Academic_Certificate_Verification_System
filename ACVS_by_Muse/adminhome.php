

<?php
// Include your database connection file
include 'admin_db.php';

// Fetching the total number of admissions, students, and certificates issued
$query = "SELECT 
                (SELECT COUNT(*) FROM students) AS total_students,
                (SELECT COUNT(*) FROM certificates) AS total_certificates,
                (SELECT COUNT(*) FROM admission WHERE id IS NOT NULL) AS total_admission";
                
$result = mysqli_query($conn, $query);
$student_count = mysqli_fetch_assoc($result);

if (!$student_count) {
    // If the query fails, handle the error
    $student_count = [
        "total_students" => 0,
        "total_certificates" => 0,
        "total_admission" => 0
    ];
}

mysqli_free_result($result);  // Free the result set
mysqli_close($conn);  // Close the database connection
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <?php include 'admin_css.php'; ?>
    <style>
        .table
        {
            width: 50%;
        }
    </style>
</head>
<body>
    <?php  
        // Include the sidebar for the admin page
        include 'admin_sidebar.php';
    ?>
    
    <div class="content">
        <center>
            <h1>Admin Dashboard</h1> 
            <table class="table table-info table-striped table-hover table-bordered border-primary">
                <thead >
                    <th scope="col" class="text-primary h1">Parameters</th>
                    <th scope="col" class="text-primary h1">Total</th>
                </thead>
                <tbody class="table-group-divider">

                <tr>
                        <th scope="col">Admission</th>
                        <td><?php echo $student_count["total_admission"]; ?></td>
                </tr>

                <tr>
                        <th scope="col">Students</th>
                        <td><?php echo $student_count["total_students"]; ?></td>

                <tr>
                     <th scope="col">Certificates</th>
                     <td><?php echo $student_count["total_certificates"]; ?></td>
                </tr>
                </tbody>
            </table>
        </center>
    </div>
</body>
</html>
