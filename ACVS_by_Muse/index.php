<?php 
error_reporting(0);
session_start();
session_destroy();

    if($_SESSION['message'])
    {
        $message=$_SESSION['message'];
        echo "<script type='text/javascript'>
        alert('$message');
        </script>";
    }


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ACVS:</title>
    <?php include 'logo.php'; ?>
    <!--CSS-->
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">


    <!-- Custom CSS for Circular Images, Social Icon Styling and Proper Alignment -->
<style>

    h1 i 
    {
        margin-right: 10px; 
    }


    .admn_body
    {
        width: 50%;
        border-radius: 20px;
        height: 50%;
        margin-right: 50%;
        margin-left: 30%;
        border: 5px solid black;
    }
    .card-img 
    {
        border-radius: 50% !important;
        width: 100%;
        height: 150px;
        object-fit: cover;
        margin-right: 15px;
        border: 2px solid skyblue;
    }

    .card-body 
    {
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .row.no-gutters 
    {
        margin-right: 0;
        margin-left: 0;
    }

    /* Styling for the social icons */
    .social-icons 
    {
        display: flex;
        gap: 10px;
        margin-top: 15px;
    }

    .social-icons .btn 
    {
        font-size: 20px;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background-color: #f0f0f0;
        border: 1px solid #ddd;
    }

    .social-icons .btn:hover 
    {
        background-color: #007bff;
        color: white;
    }


    footer 
    {
    background-color: #333; /* Dark background */
    color: #fff; /* Light text */
    padding: 30px 20px;
    text-align: center;
    margin-top: 25px;
}

.footer-content {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    max-width: 1200px;
    margin: 0 auto;
    padding: 10px;
}

.footer_text, .footer-links {
    flex: 1;
    min-width: 250px;
    margin-bottom: 20px;
}

.footer_text h4, .footer-links h4 {
    margin-bottom: 10px;
    font-weight: bold;
}

.footer-links p {
    margin: 0;
    font-size: 14px;
}

.social-links {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 20px;
}

.social-links a {
    font-size: 20px;
    color: #fff;
    transition: color 0.3s;
}

.social-links a:hover {
    color: #1a73e8;
}

@media screen and (max-width: 768px) {
    .footer-content {
        flex-direction: column;
        align-items: center;
    }

    .social-links {
        margin-top: 20px;
    }
}


</style>

</head>
<body>
    <nav>
        <label class="logo">ACVS</label>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="#services">Sevices</a></li>
            <li><a href="#contact">Contact</a></li>
            <li><a href="login.php" class="btn btn-success">Login</a></li>
        </ul>
    </nav>
    <!------Main------------>
    <div class="section1" id="home">

    <label class="img_text"> Academic Certificate Verification System </label>
        <img class="main_img" src="img/image2.png" alt="">
    </div>

<!---------------------------Welcome------------------------>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
            <img class="welcome_img" src="img/image6.jpg" alt="">
            </div>

            <div class="col-md-8">
        <h1> Welcome To ACVS</h1>
        <p>A verified certificate confirms your successful completion of a course and is recognized by employers and educational institutions. Verification is done using a unique certificate ID, ensuring the authenticity of your achievement.
        <br><br>
        Once verified, you can generate your certificate and save it as a PDF for printing. This certificate can be used for job applications, promotions, or college admissions.</p>

        <h1><i class="fa fa-briefcase" aria-hidden="true"></i> Build skills and your career</h1>
        <p>Impress your employer with a verified certificate that documents your learning.</p>

        <h1><i class="fa fa-trophy" aria-hidden="true"></i> Challenge yourself</h1>
        <p>Sometimes we all need that extra push. Working towards a certificate keeps you motivated.</p>

        <h1><i class="fa fa-share-alt" aria-hidden="true"></i> Share it with the world</h1>
        <p>Share your verified certificate with others securely through a dedicated link that we provide.</p>
</div>

     </div>
</div>

<!---------------------Service----------------------->
<div class="container" id="services">
        <center>
    <h1 class="">Services</h1>
        </center>
<div class="row">
  <div class="col-sm-6 mb-3 mb-sm-0">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Generate Certificate</h5>
        <p class="card-text">Please type your certificate id to generate certificate only if your details is present in our database or else contact your organization.</p>
        <a href="generate_certificate.php" class="btn btn-primary btn-lg ms-5">Generate</a>
      </div>
    </div>
  </div>

  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Verify Certificate</h5>
        <p class="card-text">Please type your certificate number to verify certificate only if your details is present in our database or else contact your organization.</p>
        <a href="verify_certificate.php" class="btn btn-primary btn-lg ms-5">Verify</a>
      </div>
    </div>
  </div>
</div>
</div>
 <!----------TEAM---------------------->
 <div class="container">
    <center>
        <h1>Meet Our Team</h1>
        <p>Our team is composed of dedicated professionals committed to delivering the best for our users.</p>
        </div>
    </center>
    <div class="row">
        <!-- First Card -->
        <div class="col-md-4">
            <div class="card">
                <div class="row no-gutters">
                    <!-- Image Section -->
                    <div class="col-md-4">
                        <img class="team card-img img-circle" src="img/muse1.jpg" alt="Muse">
                    </div>
                    <!-- Text Section -->
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5>Muse Madalcho</h5>
                            <p>Full-Stack Developer | Software Engineering Student at Debre Berhan Univerisity
                                <a href="https://muse7adev.github.io/muse2/about.html">more</a>
                            </p>
                            <div class="social-icons">
                                <!-- Social Media Links with Icons -->
                                <a href="https://web.facebook.com/godebomadalchomuse" target="_blank" class="btn btn-white text-dark"><i class="fab fa-facebook"></i></a>
                                <a href="https://github.com/Muse7ADev" target="_blank" class="btn btn-white text-dark"><i class="fab fa-github"></i></a>
                                <a href="https://linkedin.com/in/muse-madalcho-8534a338" target="_blank" class="btn btn-white text-dark"><i class="fab fa-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Second Card -->
        <div class="col-md-4">
            <div class="card">
                <div class="row no-gutters">
                    <!-- Image Section -->
                    <div class="col-md-4">
                        <img src="img/alebachew.png" class="card-img img-circle" alt="Alebachew">
                    </div>
                    <!-- Text Section -->
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5>Alebachew Chiche (ASS. Prof)</h5>
                            <p>Univerisity Mentor | Educator and Researcher at Debre Berhan Univerisity.<a href="https://www.linkedin.com/in/alebachew-ch-zewdu-a8142410">more</a></p>
                            <div class="social-icons">
                                <!-- Social Media Links with Icons -->
                                <a href="https://facebook.com" target="_blank" class="btn btn-white text-dark"><i class="fab fa-facebook"></i></a>
                                <a href="https://github.com" target="_blank" class="btn btn-white text-dark"><i class="fab fa-github"></i></a>
                                <a href="https://linkedin.com/in/alebachew-ch-zewdu--a8142410" target="_blank" class="btn btn-white text-dark"><i class="fab fa-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Third Card -->
        <div class="col-md-4">
            <div class="card">
                <div class="row no-gutters">
                    <!-- Image Section -->
                    <div class="col-md-4">
                        <img src="img/dawit.png" class="card-img img-circle" alt="Dawit">
                    </div>
                    <!-- Text Section -->
                    <div class="col-md-8">
                        <div class="card-body">
                        <h5>Mr. Dawit Uta</h5>
                        <p>Company Supervisor | Founder & CEO of CITCS | Senior Lecturer at Wolaita Sodo University
                        <a href="https://www.davidtechnotips.com/founder/">.more</a></p>
                              </p>
                            <div class="social-icons">
                                <!-- Social Media Links with Icons -->
                                <a href="https://web.facebook.com/dawit.uta" target="_blank" class="btn btn-white text-dark"><i class="fab fa-facebook"></i></a>
                                <a href="https://github.com/Davidcs2016" target="_blank" class="btn btn-white text-dark"><i class="fab fa-github"></i></a>
                                <a href="https://www.linkedin.com/in/dawit-uta-594194110/" target="_blank" class="btn btn-white text-dark"><i class="fab fa-linkedin"></i></a>
                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





<!-------------------------------Admission--------------------------->
<div class="admn_body">
    <center>
        <h1 class="adm">Admission Form</h1>
    </center>

    <div align="center" class="admission_form" >
        <form action="data_check.php" method="POST">

        <div class="adm_int">
                <label for="" class="label_text">Name:</label>
                <input type="text" class="input_deg" name="name" required
                    pattern="[A-Za-z\s]+" title="Only letters and spaces are allowed.">
            </div>

            <div class="adm_int">
                <label for="" class="label_text">Email:</label>
                <input type="email" class="input_deg" name="email" required
                    title="Please enter a valid email address (e.g., example@example.com).">
            </div>

            <div class="adm_int">
                <label for="" class="label_text">Phone:</label>
                <input type="tel" class="input_deg" name="phone" required
                    pattern="^\+?[0-9]{1,3}?[-. ]?[0-9]+([-./]?[0-9]+)*$"
                    title="Please enter a valid phone number (e.g., +123-456-7890).">
            </div>

            <div class="adm_int ms-4">
                <label for="">Message:</label>
                <textarea name="message" class="input_txt" required
                        title="Please provide your message."></textarea>
            </div>

                <br>
                <input type="submit"  class="btn btn-primary" value="Apply" id="submit" name="apply">
            </div>
            <br><br>
        </form>

    </div>
</div>

<footer>
    <div class="footer-content">
        <!-- Footer Text -->
        <div class="footer_text">
            <h4>&copy; 2024-<?php echo date("Y"); ?> All Rights Are Reserved</h4>
        </div>

        <!-- Contact Information -->
        <div class="footer-links">
            <h4 id="contact">Contact Us</h4>
            <p>
                ACVS<br>
                Debre Berhan University (DBU)<br>
                Debre Berhan, Ethiopia<br>
                <strong>Phone:</strong> +251 925 37 8065<br>
                <strong>Email:</strong> muse3720madalcho@gmail.com<br>
            </p>
        </div>

        <!-- Social Media Links -->
        <div class="social-links">
            <a href="https://twitter.com/" class="twitter" target="_blank" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
            <a href="https://facebook.com/" class="facebook" target="_blank" aria-label="Facebook"><i class="fab fa-facebook"></i></a>
            <a href="https://linkedin.com/" class="linkedin" target="_blank" aria-label="LinkedIn"><i class="fab fa-linkedin"></i></a>
            <a href="https://instagram.com/" class="instagram" target="_blank" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
        </div>
    </div>
</footer>


<!--JS Bootstrap CDN-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>