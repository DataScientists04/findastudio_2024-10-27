<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT'] . "/FindAStudio/php/ConnectDB.php";
?>

<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<head>
  <title>My Reservations</title>
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
        <h2 class="pb-3">Your Reservations</h2>
        <?php
        if (isset($_SESSION['UserID'])) {
          $UserID = $_SESSION['UserID'];
          $query = "SELECT r.Reservation_Date, s.Studio_Name
                    FROM reservation r
                    JOIN studio s ON r.StudioID = s.StudioID
                    WHERE r.UserID = ?
                    ORDER BY r.Reservation_Date";
          $stmt = $conn->prepare($query);
          $stmt->bind_param("i", $UserID);
          $stmt->execute();
          $result = $stmt->get_result();

          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              echo "<p class='pb-3'>Reservation Date: " . $row['Reservation_Date'] . "<br>Studio: " . $row['Studio_Name'] . "</p>";
            }
          } else {
            echo "<p class='pb-3'>You have no reservations.</p>";
          }

          $stmt->close();
          $conn->close();
      }
      else {
        echo "Please log in to make a reservation.";
        exit;
      }
        ?>
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