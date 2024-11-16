<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT'] . "/FindAStudio/php/ConnectDB.php";

if (isset($_GET['StudioID'])) {
  $StudioID = $_GET['StudioID'];

  $studioQuery = "SELECT * FROM studio WHERE StudioID = $StudioID";
  $studioResult = mysqli_query($conn, $studioQuery);

  if ($studioResult && mysqli_num_rows($studioResult) > 0) {
    $studio = mysqli_fetch_assoc($studioResult);

    $sql_file = $_SERVER['DOCUMENT_ROOT'] . "/FindAStudio/sql/NextAvailable.sql";

    $specific_studio_id = $StudioID;
    $set_specific_studio_id = "SET @specific_studio_id = '$specific_studio_id'";
    if (mysqli_query($conn, $set_specific_studio_id) === FALSE) {
      die("Error setting @specific_studio_id: " . mysqli_error($conn));
    }
    $number_of_days = "14";
    $set_number_of_days = "SET @number_of_days = $number_of_days";
    if (mysqli_query($conn, $set_number_of_days) === FALSE) {
      die("Error setting @number_of_days: " . mysqli_error($conn));
    }
    $nextAvailableQuery = file_get_contents($sql_file);
    $result = mysqli_query($conn, $nextAvailableQuery);

    $dateResult = mysqli_query($conn, $nextAvailableQuery);
    $nextAvailableDate = mysqli_fetch_assoc($dateResult)['Next_Available_Date'];

    $studioName = $studio['Studio_name'];
    $studioAddress = "{$studio['Street']} {$studio['street_no']}, {$studio['Postal_code']} {$studio['City']}";
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
    $phone = $user['Phone_number'];

  } else {
    echo "User not found.";
    exit;
  }
} else {
  echo "Please log in to make a reservation.";
  exit;
}
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
          <input type="hidden" name="UserID" value="<?php echo $UserID; ?>">
          <input type="hidden" name="StudioID" value="<?php echo $StudioID; ?>">
          <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <div class="row">
              <div class="col">
                <input type="text" class="form-control" id="name" name="name" placeholder="First name" value="<?php echo $name; ?>" required readonly>
              </div>
              <div class="col">
                <input type="text" class="form-control" id="surname" name="surname" placeholder="Surname" value="<?php echo $surname; ?>" required readonly>
              </div>
            </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required readonly>
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
            <label for="price" class="form-label">Price</label>
            <input type="text" class="form-control" id="price" name="price" value="<?php echo $studioPrice . "€"; ?>" readonly>
          </div>
          <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <select type="date" class="form-control" id="date" name="date" required>
              <?php
              $specific_studio_id = $StudioID;
              $specific_user_id = $UserID;
              // Fetch the next 7 dates and their reservation statuses
              $sql_file = $_SERVER['DOCUMENT_ROOT'] . "/FindAStudio/sql/StudioBookedStatus.sql";
              $query = file_get_contents($sql_file);
              $stmt = $conn->prepare($query);
              $stmt->bind_param("ii", $specific_user_id, $specific_studio_id);
              $stmt->execute();
              $result = $stmt->get_result();

              $availableDates = [];
              while ($row = $result->fetch_assoc()) {
                  if ($row['status'] === 'Available') {
                      $availableDates[] = $row['date'];
                  }
              }
              if (empty($availableDates)) {
                echo "<option>No available dates in the next 7 days</option>";
                $submit_btn_disable = true;
              }
              else {
                foreach ($availableDates as $availableDate) {
                  echo "<option value='$availableDate'>$availableDate</option>";
                }
              }
              ?>
            </select>
            <!-- Calendar-->
            <?php
            $specific_studio_id = $StudioID;
            $specific_user_id = $UserID;
            // Fetch the next 7 dates and their reservation statuses
            $query = $sql_file = $_SERVER['DOCUMENT_ROOT'] . "/FindAStudio/sql/StudioBookedStatus.sql";
            $query = file_get_contents($sql_file);
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ii", $specific_user_id, $specific_studio_id);
            $stmt->execute();
            $result = $stmt->get_result();

            $dates = [];
            $statuses = [];
            while ($row = $result->fetch_assoc()) {
                $dates[] = $row['date'];
                $statuses[] = $row['status'];
            }
            ?>
            <div class="table-responsive pt-3">
              <table class="table">
                  <thead>
                      <tr>
                          <?php foreach ($dates as $date) : ?>
                              <th><?php echo $date; ?></th>
                          <?php endforeach; ?>
                      </tr>
                  </thead>
                  <tbody>
                      <tr>
                          <?php foreach ($statuses as $status) : ?>
                              <td><?php echo $status; ?></td>
                          <?php endforeach;
                          mysqli_close($conn);?>
                      </tr>
                  </tbody>
              </table>
            </div> <!-- Calendar end -->
          </div>
          <span class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary" <?php if ($submit_btn_disable) echo 'disabled'; ?>>Reserve</button>
            <a class="btn btn-primary" href="/FindAStudio/pages/studioList.php">Back to all studios</a>
          </span>
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
  <script src="/FindAStudio/js/reservationValidation.js"></script>
  <script src="/FindAStudio/js/seeMore.js"></script>

</body>
</html>