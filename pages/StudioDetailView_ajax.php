<div class="row">
  <div class="col-md-2">
  </div>
  <div class="col-md-8">
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
      echo "Studio Name: " . $Studio_name . "<br>";
      echo "City: " . $City . "<br>";
      echo "Postal Code: " . $Postal_code . "<br>";
      echo "Street: " . $Street . "<br>";
      echo "Street No: " . $street_no . "<br>";
      echo "Type: " . $Type . "<br>";
      echo "Price: " . $Price . "<br>";
    }
  } else {
    echo "No data found";
  }

  mysqli_close($conn);
} else {
  echo "No StudioID provided";
}
?>
    <script>
    document.getElementById("StudioHeading").innerHTML = "1";
    </script>
  </div>
  <div class="col-md-2">
  </div>
</div>
<div class="row">
  <div class="col-md-3">
  </div>
  <div class="col-md-6 text-center">
    <div id="seeAllStudios" class="text-center mt-3"> <!-- style="display: none;"> -->
      <a class="btn btn-primary" href="/FindAStudio/pages/studioList.php" title="See all Studios">See all studios</a>
    </div>
  </div>
  <div class="col-md-3">
  </div>
</div>