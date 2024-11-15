<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/FindAStudio/php/ConnectDB.php";

// Get StudioID from the URL parameters
if (isset($_GET['StudioID'])) {
  $StudioID = $_GET['StudioID'];

  $query = "SELECT * FROM studio WHERE StudioID = $StudioID";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      $Studio_name = $row['Studio_name'];
      $City = $row['City'];
      $Postal_code = $row['Postal_code'];
      $Street = $row['Street'];
      $street_no = $row['street_no'];
      $Type = $row['Type'];
      $Price = $row['Price'];

      // Output the data as needed
      ?>
      <div class="row d-flex align-items-end">
        <div class="col-6">
          <div class="row py-3">
            <div class="col-6">
              <?php echo "<h3>" . "Studio Name: " . "</h3>"; ?>
            </div>
            <div class="col-6">
              <?php echo "<h3>" . $Studio_name . "</h3>"; ?>
            </div>
          </div>

          <div class="row">
            <div class="col-6">
              <?php echo "<h4>" . "Address: " . "</h4>"; ?>
            </div>
            <div class="col-6">
              <?php echo "<h4>" . $City . ", " . $Postal_code . "</h4>"; ?>
            </div>
          </div>

          <div class="row">
            <div class="col-6">
            </div>
            <div class="col-6">
              <?php echo "<h4>" . $Street . " " . $street_no . "</h4>"; ?>
            </div>
          </div>

          <div class="row pt-3">
            <div class="col-6">
              <?php echo "<h4>" . "Type of Studio: " . "</h4>"; ?>
            </div>
            <div class="col-6">
              <?php echo "<h4>" . $Type . "</h4>"; ?>
            </div>
          </div>

          <div class="row pt-3">
            <div class="col-6">
              <?php echo "<h4>" . "Price: " . "</h4>"; ?>
            </div>
            <div class="col-6">
              <?php echo "<h4>" . $Price . "€" . "</h4>"; ?>
            </div>
          </div>

          <div class="row pt-3">
            <div class="col-6">
              <?php echo "<h4>" . "Next available booking date: " . "</h4>"; ?>
            </div>
            <div class="col-6">
              <?php
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

              $dateResult = mysqli_query($conn, $nextAvailableQuery);
              $nextAvailableDate = mysqli_fetch_assoc($dateResult)['Next_Available_Date'];
              if ($nextAvailableDate == date('Y-m-d')) {
                $nextAvailableDate = 'Today';
              }
              elseif ($nextAvailableDate == date('Y-m-d', strtotime('+1 day'))) {
                $nextAvailableDate = 'Tomorrow';
              }
              echo "<h4>" . $nextAvailableDate . "</h4>";
              ?>
            </div>
          </div>

          <div class="row pt-3">
            <div class="col-3">
              <button id="BookStudio_btn" class="btn btn-primary" style="aspect-ratio: 2 / 1; width: 25%%;" onclick="redirectReservation(<?php echo $StudioID; ?>)">
                Book this studio</button>
            </div>
            <div class="col-9">
            </div>
          </div>
      </div>

      <div class="col-6">
        <img src="/FindAStudio/img/Studio2.jpg" alt="StudioImage" class="d-block h-100 w-100 object-fit-cover">
      </div>
    <?php
    }
  } else {
    echo "No data found";
  }

  mysqli_close($conn);
} else {
  echo "No StudioID provided";
}
?>

<div class="row">
  <div class="col-md-3">
  </div>
  <div class="col-md-6 text-center">
    <div id="seeAllStudios" class="text-center mt-3">
      <button class="btn btn-primary" onClick="Reset_AllStudiosView()" title="Back to all studios">Back to all studios</button>
    </div>
  </div>
  <div class="col-md-3">
  </div>
</div>

<script src="/FindAStudio/js/redirectReservation.js"></script>
