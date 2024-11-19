<?php 
require_once('configverify.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Academic Certificate Verification System">
  <meta name="keywords" content="Certificate Verification, ACVS">
  <title>ACVS : Academic Certificate Verification System</title>

  <?php include 'logo.php'; ?> 
  <!-- Add Bootstrap 5 CSS from CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Font Awesome for icons -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

  <style>
    body {
      font-family: 'Source Serif Pro', serif;
      background-image: url('img/verify_image.png');
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
      height: 100vh;
    }

    .des_logo {
      font-size: 30px;
      padding-top: 30px;
      text-align: center;
    }

    .footer {
      font-size: 16px;
      padding-top: 120px;
    }

    /* Table Styles */
    .table-fill {
      background: white;
      border-radius: 3px;
      border-collapse: collapse;
      height: 320px;
      margin: auto;
      max-width: 600px;
      padding: 5px;
      width: 100%;
      box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
    }

    th {
      color: #D5DDE5;
      background: #1b1e24;
      border-bottom: 4px solid #9ea7af;
      border-right: 1px solid #343a45;
      font-size: 23px;
      font-weight: 100;
      padding: 24px;
      text-align: left;
      vertical-align: middle;
    }

    td {
      background: #FFFFFF;
      padding: 20px;
      text-align: left;
      vertical-align: middle;
      font-weight: 300;
      font-size: 18px;
      border-right: 1px solid #C1C3D1;
    }

    td:last-child {
      border-right: 0px;
    }

    .table-title h3 {
      color: green;
      font-size: 20px;
      font-weight: 400;
      text-transform: uppercase;
      text-align: center;
    }

    .table-title-red h3 {
      color: red;
      font-size: 20px;
      font-weight: 400;
      text-transform: uppercase;
      text-align: center;
    }

    html {
      overflow: scroll;
      overflow-x: hidden;
    }*/

  </style>
</head>
<body>

<div class="container">

  <br>
  <div class="row ms-5">
    <div class="text-center">
      <div class="col-sm-3"></div>
      <div class="col-sm-6">
        <form class="form-inline" method="POST">
          <div class="form-group">
            <input type="text" class="form-control input-lg" name="cert_no" placeholder="Certificate Number" required>
          </div>
          &nbsp;&nbsp;
          <button type="submit" name="validate" class="btn btn-primary btn-lg">View</button>
          <button type="button" class="btn btn-primary view">
          <a href="index.php" class="btn btn-primary back">Back</a>
          </button>
        </form>
      </div>
    </div>
  </div>

  <?php validate(); ?>

</div>

<!-- Add Bootstrap 5 and jQuery from CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

