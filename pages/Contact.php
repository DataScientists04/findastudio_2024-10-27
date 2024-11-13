<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT'] . "/FindAStudio/php/ConnectDB.php";
?>

<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<head>
  <title>Contact</title>
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="../css/findastudio.css">
  <link rel="stylesheet" type="text/css" href="../fonts/bootstrap-icons-1.11.3/font/bootstrap-icons.css">

</head>
<body>
  <div class="container-fluid vh-100"> <!-- Main container -->

    <!-- topbar -->
    <div id="navbar"></div>

    <!-- Contact Information -->
    <div class="row">
      <div class="col-md-3">
      </div>
      <div class="col-md-6">
        <h2>Contact Us</h2>
        <p class="pb-3">We’d love to hear from you! Whether you have questions, feedback, or need assistance, our team is here to help.</p>
        <h2>Get in Touch</h2>

        <div class="row">
          <div class="col-sm-3">
            <h3>Email:</h3>
          </div>
          <div class="col-sm-9">
            <p>support@findastudio.at</p>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-3">
            <h3>Phone:</h3>
          </div>
          <div class="col-sm-9">
            <p>+43 1 234 5678</p>
          </div>
        </div>

        <div class="row pb-3">
          <div class="col-sm-3">
            <h3>Address:</h3>
          </div>
          <div class="col-sm-9">
            <p>123 Music Lane, Vienna, Austria</p>
          </div>
        </div>

        <h2 class="pb-3">Meet our team</h2>

        <div class="row">
          <div class="col-sm-3">
            <h3>David</h3>
          </div>
          <div class="col-sm-9">
            <p></p>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-3">
            <h3>Thuy Duong</h3>
          </div>
          <div class="col-sm-9">
            <p></p>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-3">
            <h3>Vit</h3>
          </div>
          <div class="col-sm-9">
            <p></p>
          </div>
        </div>
      </div>
      <div class="col-md-3">
      </div>
    </div>


    <!-- Footer -->
    <div id="footer"></div>

  </div> <!-- Main container end-->

  <!-- js -->
  <script src="/FindAStudio/js/bootstrap.bundle.js"></script>
  <script src="/FindAStudio/js/jquery.min.js"></script>
  <script src="/FindAStudio/js/seeMore.js"></script>
  <script>
  $(function(){
    $("#navbar").load("/FindAStudio/pages/navbar.php");
    $("#footer").load("/FindAStudio/pages/footer.html");
  });
  </script>

</body>
</html>
