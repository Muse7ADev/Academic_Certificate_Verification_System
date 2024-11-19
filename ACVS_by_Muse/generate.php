<?php
// Function to clean and sanitize string values (HTML escaping)
function clean($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

// Validate certificate and return the corresponding table
function validate() {
    // Check if the form is submitted
    if (isset($_POST['validate'])) {
        // Sanitize input
        $certificate_id = clean($_POST['cert_no']);
        global $conn;

        // Check database connection
        if (!$conn) {
            die('Database connection failed: ' . mysqli_connect_error());
        }

        // Use prepared statement to safely query the database
        $sql = "SELECT * FROM certificates WHERE certificate_id = ?";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt === false) {
            die('MySQL prepare failed: ' . mysqli_error($conn)); // Error handling for query preparation
        }

        // Bind parameters and execute the query
        mysqli_stmt_bind_param($stmt, "s", $certificate_id); // Bind certificate_id as a string
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        // Check if the result is valid
        if (mysqli_num_rows($result) == 1) {
            // Fetch the certificate data
            $data = mysqli_fetch_assoc($result);

            // Sanitize output for HTML
            $student_name = htmlspecialchars($data['student_name'], ENT_QUOTES, 'UTF-8');
            $marks = htmlspecialchars($data['marks'], ENT_QUOTES, 'UTF-8');
            $course_name = htmlspecialchars($data['course_name'], ENT_QUOTES, 'UTF-8');
            $college_name = htmlspecialchars($data['college_name'], ENT_QUOTES, 'UTF-8');
            $created_at = htmlspecialchars($data['date_of_joining'], ENT_QUOTES, 'UTF-8');
            $certificate_id = htmlspecialchars($data['certificate_id'], ENT_QUOTES, 'UTF-8');

            // Format the date (e.g., d-m-Y)
            $formatted_date = date("d-m-Y", strtotime($created_at));

            // Print the certificate
            echo renderCertificate($student_name, $marks, $course_name, $college_name, $formatted_date, $certificate_id);
        } else {
            // Display message if certificate number is invalid
            echo '<div class="table-title">
                    <center style="color: red;"><h3>Invalid Certificate Number!</h3></center>
                  </div>';
        }

        // Close the prepared statement
        mysqli_stmt_close($stmt);
    }
}

// Function to render certificate HTML
function renderCertificate($student_name, $marks, $course_name, $college_name, $created_at, $certificate_id) {
    return '
    <div class="container pm-certificate-container">
        <div class="outer-border"></div>
        <div class="inner-border"></div>
        <div class="pm-certificate-border col-12">
            <div class="row pm-certificate-header">
                <div class="pm-certificate-title Oleo col-12 text-center">
                    <h2 class="underline">Certificate Of Completion</h2>
                    <h4>This is to certify that</h4>
                </div>
            </div>
            <div class="row pm-certificate-body">
                <div class="pm-certificate-block">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-2"></div>
                            <div class="pm-certificate-name underline margin-0 col-8 text-center">
                                <span class="pm-name-text bold">' . $student_name . '</span>
                            </div>
                            <div class="col-2"></div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="row">
                            <div class="col-2"></div>
                            <div class="pm-earned col-8 text-center">
                                <span class="pm-earned-text padding-0 block Oleo">has earned</span>
                                <br>
                                <span class="pm-credits-text underline">' . $marks . ' Of GPA</span>
                            </div>
                            <div class="col-2"></div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="row">
                            <div class="col-2"></div>
                            <div class="pm-course-title col-8 text-center">
                                <span class="pm-earned-text block Oleo">while completing the training course of department</span>
                            </div>
                            <div class="col-2"></div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="row">
                            <div class="col-2"></div>
                            <div class="pm-course-title underline col-8 text-center">
                                <span class="pm-credits-text block bold sans">' . $course_name . '</span>
                            </div>
                            <div class="col-2"></div>
                        </div>
                    </div>
                </div>

                <div class="pm-certificate-footer" >


                <div style="justify-content: space-between; display: flex; padding-top: 40px;" >
                <div class="pm-certified">
                        <span class="underline">' . $college_name . '</span>
                        <br>
                        <span class="bold">AUTHORIZED</span>
                    </div>

                    <div class="pm-certified">
                        <span class="h">DATE COMPLETED: ' . $created_at . '</span>
                        <br>
                        <span class="bold">CERTIFICATE ID: ' . $certificate_id . '</span>
                    </div>

                </div>
                    <center style="padding-top: 70px;">
                        <div>
                            <a href="#" class="print btn btn-default"><span class="fas fa-print"></span> Print Certificate</a>
                        </div>
                        <p>This is a computer-generated document. No signature required.</p>
                    </center>
                </div>
            </div>
        </div>
    </div>';
}
?>
