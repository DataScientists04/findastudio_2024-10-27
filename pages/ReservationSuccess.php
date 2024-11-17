<?php
if(!isset($_SESSION)) { session_start(); };
include_once $_SERVER['DOCUMENT_ROOT'] . "/FindAStudio/php/ConnectDB.php";

if (isset($_GET['ReservationID']) && isset($_SESSION['UserID'])) {
  $ReservationID = $_GET['ReservationID'];
  $UserID = $_SESSION['UserID'];

  $query = "SELECT r.Reservation_Date, s.Studio_name, s.City, s.Postal_code, s.Street, s.street_no, s.Type, s.Price
            FROM reservation r
            JOIN studio s ON r.StudioID = s.StudioID
            WHERE r.UserID = ? AND r.ReservationID = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("ii", $UserID, $ReservationID);
  $stmt->execute();
  $result = $stmt->get_result();
  $reservation = $result->fetch_assoc();

  if (!$reservation) {
    echo "Reservation not found.";
    exit;
  }

  $stmt->close();
  $conn->close();
} else {
  echo "No reservation details found.";
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<head>
  <title>Booking Confirmation</title>
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
      <div class="col-md-2">
      </div>
      <div class="col-md-8 text-center">
        <h2 class="pb-3">Booking Confirmation</h2>
        <p class="pb-3">Your booking has been successfully completed! Here are the details of your reservation:</p>

        <div class="row d-flex align-items-end border-top">
          <div class="row py-1">
            <div class="col-6">
              <h3>Reservation Date:</h3>
            </div>
            <div class="col-6">
              <h3><?php echo $reservation['Reservation_Date']; ?></h3>
            </div>
          </div>

          <div class="row py-1">
            <div class="col-6">
              <h3>Studio Name:</h3>
            </div>
            <div class="col-6">
              <h3><?php echo $reservation['Studio_name']; ?></h3>
            </div>
          </div>

          <div class="row py-1">
            <div class="col-6">
              <h4>Address:</h4>
            </div>
            <div class="col-6">
              <h4><?php echo $reservation['City'] . ", " . $reservation['Postal_code'] . ", " . $reservation['Street'] . " " . $reservation['street_no']; ?></h4>
            </div>
          </div>

          <div class="row py-1">
            <div class="col-6">
              <h4>Type of Studio:</h4>
            </div>
            <div class="col-6">
              <h4><?php echo $reservation['Type']; ?></h4>
            </div>
          </div>

          <div class="row py-1">
            <div class="col-6">
              <h4>Price:</h4>
            </div>
            <div class="col-6">
              <h4><?php echo $reservation['Price'] . "€"; ?></h4>
            </div>
          </div>
        </div>

        <p class="pt-4">You can view all your reservations <a href="/FindAStudio/pages/MyReservations.php"><u>here</u></a>.</p>
      </div>
      <div class="col-md-2">
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