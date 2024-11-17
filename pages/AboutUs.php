<?php
if(!isset($_SESSION)) { session_start(); };;
include_once $_SERVER['DOCUMENT_ROOT'] . "/FindAStudio/php/ConnectDB.php";
?>

<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<head>
  <title>About Us</title>
  <link rel="icon" type="image/x-icon" href="/FindAStudio/img/favicon.ico">
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="../css/findastudio.css">
  <link rel="stylesheet" type="text/css" href="../fonts/bootstrap-icons-1.11.3/font/bootstrap-icons.css">

</head>
<body>
  <div class="container-fluid vh-100"> <!-- Main container -->

    <!-- topbar -->
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/FindAStudio/pages/navbar.php"; ?>

    <div class="row">
      <div class="col-md-3">
      </div>
      <div class="col-md-6">
        <p class="pb-3">Find A Studio is an online platform that can provide a creative place for professional music artists and bands 
        who are looking for a studio to work in, as well as for newcomers and freelance musicians trying to find a place 
        where they can unleash their inner weekend rockstars. 
        <br>We are focused on studios in Vienna.</p>
        <h2 class="pb-3">Your Needs:</h2>
        <p class="pb-3">Currently, finding a music studio with the right equipment, price, and location requires a time-consuming process. 
        Musicians must visit each studio's website, compare the details, and then contact the studio to check for availability. 
        For studios, visibility is also a challenge. Many rely on Google searches, and those without optimized websites 
        or paid ads often struggle to be found, making them virtually invisible to potential clients.</p>
        <h2 class="pb-3">Our Solution:</h2>
        <p class="pb-3">We provide a platform where music studios can showcase their services, including equipment details, pricing, and available time slots. 
        For musicians, the platform offers an easy way to browse, compare, and filter studios in Vienna based on various criteria, 
        streamlining the search and booking process.</p> 
      </div>
      <div class="col-md-3">
      </div>
    </div>

    <!-- Footer -->
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/FindAStudio/pages/footer.html"; ?>
    
  </div> <!-- Main container end-->

  <!-- js -->
  <script src="/FindAStudio/js/bootstrap.bundle.js"></script>
  <script src="/FindAStudio/js/jquery.min.js"></script>

</body>
</html>