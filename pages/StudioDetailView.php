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
              <?php echo "<h4>" . "Adress: " . "</h4>"; ?>
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
            <div class="col-3">
              <button id="BookStudio_btn" class="btn btn-primary" style="aspect-ratio: 2 / 1; width: 25%%;" onclick="redirectReservation(<?php echo $StudioID; ?>)">
                Book this studio</button>
            </div>
            <div class="col-9">
              <!-- Calendar-->
              <?php
              $specific_studio_id = $StudioID; // Set the specific StudioID
              // Fetch the next 7 dates and their reservation statuses
              $query = "
                  WITH RECURSIVE dates AS (
                      SELECT CURDATE() AS date
                      UNION ALL
                      SELECT date + INTERVAL 1 DAY
                      FROM dates
                      WHERE date < CURDATE() + INTERVAL 6 DAY
                  )
                  SELECT d.date, IF(r.Reservation_Date IS NOT NULL, 'Reserved', 'Available') AS status
                  FROM dates d
                  LEFT JOIN reservation r ON r.StudioID = ? AND r.Reservation_Date = d.date
                  ORDER BY d.date
              ";

              $stmt = $conn->prepare($query);
              $stmt->bind_param("i", $specific_studio_id);
              $stmt->execute();
              $result = $stmt->get_result();

              // Prepare data for the calendar
              $dates = [];
              $statuses = [];
              while ($row = $result->fetch_assoc()) {
                  $dates[] = $row['date'];
                  $statuses[] = $row['status'];
              }
              ?>
              <div class="table-responsive">
                <table class="table table-bordered">
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
                            <?php endforeach; ?>
                        </tr>
                    </tbody>
                </table>
              </div>

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