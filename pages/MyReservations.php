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
      <div class="col-md-2">
      </div>
      <div class="col-md-8 text-center">
        <h2 class="pb-3">Your upcoming reservations</h2>
        <p class="pb-3">Welcome to your reservations page! Here, you'll find all the details about your upcoming studio bookings.</p>
        <p class="pb-3">If you're looking to book more studio time, check out our available studios <a href="/FindAStudio/pages/studioList.php"><u>here</u></a>.
        We have a wide range of options to suit your needs, whether you're a professional artist or a weekend rockstar.
        </p>
        <?php
        if (isset($_SESSION['UserID'])) {
          $UserID = $_SESSION['UserID'];
          $query = "SELECT r.Reservation_Date, s.Studio_name, s.City, s.Postal_code, s.Street, s.street_no, s.Type, s.Price
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
              $Studio_name = $row['Studio_name'];
              $City = $row['City'];
              $Postal_code = $row['Postal_code'];
              $Street = $row['Street'];
              $street_no = $row['street_no'];
              $Type = $row['Type'];
              $Price = $row['Price'];
              $Reservation_Date = $row['Reservation_Date'];
              if ($Reservation_Date >= date('Y-m-d')) {?>
              <div class="row d-flex align-items-end border-top">
                <div class="row py-1">
                  <div class="col-6">
                    <?php echo "<h3>" . "Reservation Date: " . "</h3>"; ?>
                  </div>
                  <div class="col-6">
                    <?php echo "<h3>" . $Reservation_Date . "</h3>"; ?>
                  </div>
                </div>

                <div class="row py-1">
                  <div class="col-6">
                    <?php echo "<h3>" . "Studio Name: " . "</h3>"; ?>
                  </div>
                  <div class="col-6">
                    <?php echo "<h3>" . $Studio_name . "</h3>"; ?>
                  </div>
                </div>

                <div class="row py-1">
                  <div class="col-6">
                    <?php echo "<h4>" . "Address: " . "</h4>"; ?>
                  </div>
                  <div class="col-6">
                    <?php echo "<h4>" . $City . ", " . $Postal_code . ", " . $Street . " " . $street_no . "</h4>"; ?>
                  </div>
                </div>

                <div class="row py-1">
                  <div class="col-6">
                    <?php echo "<h4>" . "Type of Studio: " . "</h4>"; ?>
                  </div>
                  <div class="col-6">
                    <?php echo "<h4>" . $Type . "</h4>"; ?>
                  </div>
                </div>

                <div class="row py-1">
                  <div class="col-6">
                    <?php echo "<h4>" . "Price: " . "</h4>"; ?>
                  </div>
                  <div class="col-6">
                    <?php echo "<h4>" . $Price . "€" . "</h4>"; ?>
                  </div>
                </div>
              </div>
              <?php
              } // if Reservation_Date >= today end
            }
          } else {
            ?>
            <div class="row d-flex align-items-end border-top">
              <div class="row pt-3 py-1" style="height: 25vh;">
                <div class="col-12">
                  <h2>You currently have no reservations</h2>
                </div>
              </div>
            </div>
            <?php
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