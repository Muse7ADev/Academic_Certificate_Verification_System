<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <?php include 'logo.php'; ?>

      <!--CSS-->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <center>
        <div class="form_deg">
           <center class="title_deg">
            <h1>Login Form</h1>
            <h4>
                <?php 
                error_reporting(0);
                session_start();
                session_destroy();
                echo $_SESSION['LoginMessage']; 
                ?>
            </h4>
           </center> 
            <form action="login_check.php" method="POST" class="login_form">
                <div>
                    <label for="" class="label_deg">UserName:</label>
                    <input type="email" name="email" required>
                </div>

                <div>
                    <label for="" class="label_deg">PassWord:</label>
                    <input type="password" name="password" required>
                </div>

                <div>
                    
                    <input class="btn btn-primary" type="submit"  value="Login">
                </div>
            </form>
        </div>
    </center>

</body>
</html>