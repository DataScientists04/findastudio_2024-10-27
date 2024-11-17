<?php
if(!isset($_SESSION)) { session_start(); };
include_once $_SERVER['DOCUMENT_ROOT'] . "/FindAStudio/php/ConnectDB.php";
$submit_btn_disable = false;
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
      ?>
      <!-- Start of the row for studio details and image -->
      <div class="row d-flex align-items-end">
        <!-- Start of the column for studio details -->
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
              $number_of_days = "6";
              $set_number_of_days = "SET @number_of_days = $number_of_days";
              if (mysqli_query($conn, $set_number_of_days) === FALSE) {
                die("Error setting @number_of_days: " . mysqli_error($conn));
              }
              $nextAvailableQuery = file_get_contents($sql_file);

              $dateResult = mysqli_query($conn, $nextAvailableQuery);
              $nextAvailableDate = mysqli_fetch_assoc($dateResult)['Next_Available_Date'];
              if ($nextAvailableDate) {
                if ($nextAvailableDate == date('Y-m-d')) {
                  $nextAvailableDate = 'Today';
                }
                elseif ($nextAvailableDate == date('Y-m-d', strtotime('+1 day'))) {
                  $nextAvailableDate = 'Tomorrow';
                }
              echo "<h4>" . $nextAvailableDate . "</h4>";
              }
              else {
                echo "<h4>No free booking slots in the next 7 days</h4>";
                $submit_btn_disable = true;
              }
              ?>
            </div>
          </div>

          <div class="row pt-3">
            <div class="col-3">
              <?php
              if(isset($_SESSION['Email'])) {?>
                <a href="/FindAStudio/pages/reservation.php?StudioID=<?php echo $StudioID; ?>" type="button" class="btn btn-primary d-flex align-items-center justify-content-center"
                <?php if ($submit_btn_disable) echo 'disabled'; ?> style="aspect-ratio: 2 / 1; width: 25%%;">
                Book this studio
                </a>

              <?php
              }
              else {
              ?>
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AccountNeeded_Modal"
              <?php if ($submit_btn_disable) echo 'disabled'; ?> style="aspect-ratio: 2 / 1; width: 25%%;">
              Book this studio
              </button>
              <!-- Modal -->
              <div class="modal fade" id="AccountNeeded_Modal" tabindex="-1" aria-labelledby="AccountNeeded_Modal_Label" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content bg-dark">
                    <div class="modal-header">
                      <h3 class="modal-title" id="AccountNeeded_Modal_Label">Book A Studio</h3>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      To book a studio, please sign up or log in using the user button at the top right corner.
                    </div>
                    <div class="modal-footer d-flex justify-content-between">
                      <div>
                        <a type="button" class="btn btn-primary" href="/FindAStudio/pages/SignUp.php">Sign up</a>
                      </div>
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>
              <?php
              }
              ?>

            </div>
            <div class="col-9">
            </div>
          </div>
        </div> <!-- Closing col-6 for text -->
        <!-- Start of the column for the image -->
        <div class="col-6">
          <img src="/FindAStudio/img/Studio2.jpg" alt="StudioImage" class="d-block h-100 w-100 object-fit-cover">
        </div>
      </div> <!-- Closing row for studio details and image -->
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

<!-- Footer Buttons -->
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