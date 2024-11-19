<?php require_once('config.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>ACVS</title>
    <?php include 'logo.php'; ?>
    <link rel="icon" href="img/acvslogo.PNG" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- External CSS and JS libraries -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script> 
    <link href="https://fonts.googleapis.com/css2?family=Source+Serif+Pro&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oleo+Script:wght@400;700&display=swap" rel="stylesheet">

    <!-- Internal Styles -->
    <style>
        /* Global Font Definitions */
        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-weight: 400;
            src: local('Open Sans Regular'), local('OpenSans-Regular'),
                url(https://fonts.gstatic.com/s/opensans/v17/mem8YaGs126MiZpBA-UFVZ0e.ttf) format('truetype');
        }



        
        /* Body Styling */
        body {
            font-family: 'Source Serif Pro', serif;
            background-image: url(img/image5.jpg);
            background-size: cover;
            background-repeat: no-repeat;
            height: 100vh;
            margin: 0;
            padding: 20px 0;
            color: #333;
        }

        /* Global Variable Definitions for Colors */
        :root {
            --primary-color: #618597;
            --secondary-color: #b2cad6;
            --font-family-sans: 'Open Sans', sans-serif;
            --font-family-cursive: 'Pinyon Script', cursive;
            --font-family-serif: 'Rochester', serif;
            --text-color-light: #E1E5F0;
            --text-color-dark: #333;
            --border-color: #fff;
            --background-color: #ccc;
            --button-bg-color: #007bff;
            --button-text-color: #fff;
            --certificate-width: 800px;
            --certificate-height: 600px;
        }

        /* Reset Margin and Padding */
        *,
        *::before,
        *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Button Styling */
        button,
        input[type="submit"] {
            background-color: var(--button-bg-color);
            color: var(--button-text-color);
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover,
        input[type="submit"]:hover {
            background-color: darken(var(--button-bg-color), 10%);
        }

                /* Apply cursive typography */
        .Oleo 
        {
            font-family: "Oleo Script", system-ui;
        }
        
        
        /* Certificate Container Styling */
        .pm-certificate-container {
            position: relative;
            width: var(--certificate-width);
            height: var(--certificate-height);
            padding: 30px;
            background-color: var(--primary-color);
            color: var(--text-color-dark);
            font-family: var(--font-family-sans);
            margin: 0 auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            border-radius: 8px;
            background: repeating-linear-gradient(45deg, var(--primary-color), var(--primary-color) 1px, var(--secondary-color) 1px, var(--secondary-color) 2px);
            overflow: hidden;
        }

        .pm-certificate-container .outer-border,
        .pm-certificate-container .inner-border {
            position: absolute;
            border: 2px solid var(--border-color);
        }

        .pm-certificate-container .outer-border {
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
        }

        .pm-certificate-container .inner-border {
            width: calc(100% - 60px);
            height: calc(100% - 60px);
            top: 30px;
            left: 30px;
        }

        /* Certificate Content Area */
        .pm-certificate-container .pm-certificate-border {
            position: relative;
            width: calc(var(--certificate-width) - 60px);
            height: calc(var(--certificate-height) - 60px);
            padding: 30px;
            border: 1px solid var(--text-color-light);
            background-color: #fff;
            color: var(--text-color-dark);
            margin: 0 auto;
            border-radius: 8px;
        }

        /* Certificate Title Styling */
        .pm-certificate-container .pm-certificate-border .pm-certificate-title h2 {
            font-size: 36px;
            font-weight: bold;
            text-align: center;
            color: var(--primary-color);
        }

        /* Certificate Body Styling */
        .pm-certificate-container .pm-certificate-border .pm-certificate-body {
            padding: 20px;
            text-align: center;
        }

        .pm-certificate-container .pm-certificate-border .pm-name-text,
        .pm-certificate-container .pm-certificate-border .pm-earned-text {
            font-size: 20px;
            
        }
       .underline
       {
        text-decoration: underline;
       }
       .bold
       {
        font-weight: bold;
       }
        /* Footer Styling */
        .pm-certificate-container .pm-certificate-border .pm-certificate-footer {
            text-align: center;
            padding-top: 40px;
            font-size: 12px;
            color: #666;
        }

        /* Scrollbar Removal */
        ::-webkit-scrollbar {
            display: none;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .pm-certificate-container {
                width: 100%;
                height: auto;
                padding: 20px;
            }

            .pm-certificate-container .pm-certificate-border {
                width: 100%;
                height: auto;
            }
        }
        /* Print-specific CSS to hide elements with 'no-print' class when printing */
        @media print 
        {
        .no-print 
        {
        display: none !important;
    }
}

    </style>
</head>

<body>

    <div class="container">
        <div class="text-center">
            <button style="border:none;" type="button" class="btn btn-primary btn-md no-print" onclick="myFunction()">Generate Certificate</button>
            <br><br>
            <div id="myDIV" style="display:none;">
                <form class="form-inline no-print" method="POST" style="display: flex;">
                    <div class="form-group" style="padding-left: 500px;">
                        <input type="text" style="width: 200px;" class="form-control input-lg" name="cert_no" placeholder="Enter Your Certificate ID" required>
                    </div>&nbsp;&nbsp;
                    <button type="submit" name="validate" class="btn btn-primary">View</button>
                </form>
            </div>
            <br>
            <div>
                <button type="button" class="btn btn-primary no-print">
                    <a href="index.php" class="btn btn-danger no-print">Back</a>
                </button>
            </div>
            <?php validate(); ?>
            <div class="row"></div>
        </div>
    </div>

    <script src="js/script.js"></script>
    <script>
        function myFunction() {
            var x = document.getElementById("myDIV");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }
    </script>
</body>

</html>
