<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT'] . "/FindAStudio/php/ConnectDB.php";
?>

<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<head>
  <title>Reservation</title>
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="../css/findastudio.css">
  <link rel="stylesheet" type="text/css" href="../fonts/bootstrap-icons-1.11.3/font/bootstrap-icons.css">

</head>
<body>
  <div class="container-fluid vh-100"> <!-- Main container -->

    <!-- topbar -->
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/FindAStudio/pages/navbar.php"; ?>

    <!-- Reservation form -->
    <div class="row pt-5">
      <div class="col-12 text-center"><h2>Reservation</h2>
      </div>
    </div>
    <div class="row">
      <div class="col-md-3">
      </div>
      <div class="col-md-6">
        <form id="reservationForm" action="\">
          <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <div class="row">
              <div class="col">
                <input type="text" class="form-control" id="name" name="name" placeholder="First name" required>
              </div>
              <div class="col">
                <input type="text" class="form-control" id="surname" name="surname" placeholder="Surname" required>
              </div>
            </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
          </div>
          <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="tel" class="form-control" id="phone" name="phone" required>
          </div>
          <div class="mb-3">
            <label for="studio" class="form-label">Studio</label>
            <input type="text" class="form-control" id="studio" name="studio" required>
          </div>
          <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" class="form-control" id="date" name="date" required>
          </div>
          <div class="mb-3">
            <label for="time" class="form-label">Time</label>
            <input type="time" class="form-control" id="time" name="time" required>
          </div>
          <button type="submit" class="btn btn-primary">Reserve</button>
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
  <script>
  if (typeof jQuery === 'undefined') { // Only load jquery if it's not already included. Leads to issues otherwise.
    document.write('<script src="/FindAStudio/js/jquery.min.js"><\/script>'); // Extra backslash to escape end tag
  }
  </script>
  <script src="/FindAStudio/js/reservation.js"></script>
  <script src="/FindAStudio/js/seeMore.js"></script>

</body>
</html>