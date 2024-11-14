<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT'] . "/FindAStudio/php/ConnectDB.php";
?>

<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<head>
  <title>Sign up</title>
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="../css/findastudio.css">
  <link rel="stylesheet" type="text/css" href="../fonts/bootstrap-icons-1.11.3/font/bootstrap-icons.css">

</head>
<body>
  <div class="container-fluid vh-100"> <!-- Main container -->

    <!-- topbar -->
    <div id="navbar"></div>

    <!-- Reservation form -->
    <div class="row pt-3">
      <div class="col-12 text-center"><h2>Create a new user account</h2>
      </div>
    </div>
    <div class="row">
      <div class="col-md-3">
      </div>
      <div class="col-md-6">
        <form id="frm_userSignup" method="post" action="/FindAStudio/php/createUser.php">
          <div class="mb-3">
            <label class="form-label">Name</label>
            <div class="row">
              <div class="col">
                <input type="text" class="form-control" id="First_Name" name="First_Name" placeholder="First name" required>
              </div>
              <div class="col">
                <input type="text" class="form-control" id="Last_Name" name="Last_Name" placeholder="Last Name" required>
              </div>
            </div>
          <div class="mb-3">
            <label for="Email" class="form-label">E-Mail</label>
            <input type="email" class="form-control" id="Email" name="Email" required>
          </div>
          <div class="mb-3">
            <label for="Phone_number" class="form-label">Phone number</label>
            <input type="tel" class="form-control" id="Phone_number" name="Phone_number" required>
          </div>
          <div class="mb-3">
            <label for="User_Password" class="form-label">Password</label>
            <input type="password" class="form-control" id="User_Password" name="User_Password" required>
          </div>
          <button type="submit" class="btn btn-primary">Sign Up</button>
        </form>
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
  <script src="/FindAStudio/js/seeMore.js"></script>
  <script>
  $(function(){
    $("#navbar").load("/FindAStudio/pages/navbar.php");
  });
  </script>

</body>
</html>