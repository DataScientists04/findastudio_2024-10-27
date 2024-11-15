<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT'] . "/FindAStudio/php/ConnectDB.php";

if (isset($_GET['StudioID'])) {
  $StudioID = $_GET['StudioID'];

  $studioQuery = "SELECT * FROM studio WHERE StudioID = $StudioID";
  $studioResult = mysqli_query($conn, $studioQuery);

  if ($studioResult && mysqli_num_rows($studioResult) > 0) {
    $studio = mysqli_fetch_assoc($studioResult);

    $nextAvailableQuery = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/FindAStudio/sql/NextAvailable.sql");
    $nextAvailableQuery = str_replace(":StudioID", $StudioID, $nextAvailableQuery);
    $dateResult = mysqli_query($conn, $nextAvailableQuery);
    $nextAvailableDate = mysqli_fetch_assoc($dateResult)['Next_Available_Date'];

    $studioName = $studio['Studio_name'];
    $studioAddress = "{$studio['Street']} {$studio['street_no']}, {$studio['City']}, {$studio['Postal_code']}";
    $studioPrice = $studio['Price'];
  } else {
    echo "Studio not found.";
    exit;
  }
} else {
  echo "No StudioID provided.";
  exit;
}

if (isset($_SESSION['UserID'])) {
  $UserID = $_SESSION['UserID'];

  $userQuery = "SELECT * FROM user WHERE UserID = $UserID";
  $userResult = mysqli_query($conn, $userQuery);

  if ($userResult && mysqli_num_rows($userResult) > 0) {
    $user = mysqli_fetch_assoc($userResult);

    $name = $user['First_Name'];
    $surname = $user['Last_Name'];
    $email = $user['Email'];
    $phone = $user['Phone'];

  } else {
    echo "User not found.";
    exit;
  }
} else {
  echo "Please log in to make a reservation.";
  exit;
}

mysqli_close($conn);
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
        <form id="reservationForm" action="/FindAStudio/php/submitReservation.php" method="POST">
          <input type="hidden" name="StudioID" value="<?php echo $StudioID; ?>">
          <input type="hidden" name="UserID" value="<?php echo $UserID; ?>">
          <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <div class="row">
              <div class="col">
                <input type="text" class="form-control" id="name" name="name" placeholder="First name" value="<?php echo $name; ?>" required>
              </div>
              <div class="col">
                <input type="text" class="form-control" id="surname" name="surname" placeholder="Surname" value="<?php echo $surname; ?>" required>
              </div>
            </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required>
          </div>
          <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo $phone; ?>" required>
          </div>
          <div class="mb-3">
            <label for="studio" class="form-label">Studio</label>
            <input type="text" class="form-control" id="studio" name="studio" value="<?php echo $studioName; ?>" readonly>
          </div>
          <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" id="address" name="address" value="<?php echo $studioAddress; ?>" readonly>
          </div>
          <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" class="form-control" id="date" name="date" value="<?php echo $nextAvailableDate; ?>" required>
          </div>
          <div class="mb-3">
            <label for="time" class="form-label">Time</label>
            <input type="time" class="form-control" id="time" name="time" required>
          </div>
          <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="text" class="form-control" id="price" name="price" value="<?php echo $studioPrice; ?>" readonly>
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
  <script src="/FindAStudio/js/jquery.min.js"></script>
  <script src="/FindAStudio/js/reservation.js"></script>
  <script src="/FindAStudio/js/seeMore.js"></script>

</body>
</html>