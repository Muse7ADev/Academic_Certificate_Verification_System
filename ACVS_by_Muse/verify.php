<?php
// Function to clean and sanitize string values
function clean($string) {
    // Using htmlspecialchars for output escaping to prevent XSS
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

// Validate certificate number and return the corresponding table
function validate() {
    if (isset($_POST['validate'])) {
        // Clean user input to prevent XSS
        $certificate_id = clean($_POST['cert_no']);

        // Assuming $conn is your database connection
        global $conn;

        // Use a prepared statement to avoid SQL injection
        $sql = "SELECT * FROM certificates WHERE certificate_id = ?";
        
        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Bind parameters to the prepared statement
            mysqli_stmt_bind_param($stmt, "s", $certificate_id);

            // Execute the statement
            mysqli_stmt_execute($stmt);

            // Get the result of the query
            $result = mysqli_stmt_get_result($stmt);

            // Check if any rows are returned
            if (mysqli_num_rows($result) == 1) {
                // Fetch the certificate data
                $data = mysqli_fetch_assoc($result);

                // Display certificate details
                echo '
                <div class="table-title">
                    <center>
                    <h1>Valid!</h1>
                    </center>
                </div>
             
                <table class="table-fill table table-info table-striped table-hover table-bordered border-primary">
                    <thead></thead>
                    <tbody class="table-hover">
                        <tr>
                            <td class="text-left">Student Name</td>
                            <td class="text-left">' . clean($data['student_name']) . '</td>
                        </tr>
                        <tr>
                            <td class="text-left">Department</td>
                            <td class="text-left">' . clean($data['course_name']) . '</td>
                        </tr>
                        <tr>
                            <td class="text-left">GPA</td>
                            <td class="text-left">' . clean($data['marks']) . '</td>
                        </tr>
                        <tr>
                            <td class="text-left">Institution</td>
                            <td class="text-left">' . clean($data['college_name']) . '</td>
                        </tr>
                        <tr>
                            <td class="text-left">Certificate Date</td>
                            <td class="text-left">' . clean($data['date_of_joining']) . '</td>
                        </tr>
                    </tbody>
                </table>';
            } else {
                // If no certificate was found
                echo '
                <div class="table-title-red text-danger">
                    <center><h1>Invalid!</h1></center>
                </div>';
            }

            // Close the prepared statement
            mysqli_stmt_close($stmt);
        } else {
            // Error handling if the query preparation fails
            echo '<div class="table-title-red">
                    <center><h3>Error preparing the database query</h3></center>
                  </div>';
        }
    }
}
?>
