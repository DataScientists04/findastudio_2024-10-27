<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT'] . "/FindAStudio/php/ConnectDB.php";
?>

<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<head>
  <title>Find A Studio - Home</title>
  <link rel="icon" type="image/x-icon" href="/FindAStudio/img/favicon.ico">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="css/findastudio.css">
  <link rel="stylesheet" type="text/css" href="fonts/bootstrap-icons-1.11.3/font/bootstrap-icons.css">
  <!-- js is included at the bootom of the page-->

</head>
<body>
  <div class="container-fluid vh-100"> <!-- Main container -->

    <!-- topbar -->
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/FindAStudio/pages/navbar.php"; ?>

    <!-- Image -->
    <div class="row h-50">
      <div class="col-12 h-100">
        <div class="carousel slide h-100" data-bs-ride="carousel" id="image_carousel_home">
          <div class="carousel-indicators">
            <button type="button" data-bs-target="#image_carousel_home" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#image_carousel_home" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#image_carousel_home" data-bs-slide-to="2" aria-label="Slide 3"></button>
          </div>
          <div class="carousel-inner h-100">
            <div class="carousel-item active h-100">
              <img src="img/Studio1.jpg" alt="StudioImage" class="d-block h-100 w-100 object-fit-cover">
              <!-- Image height: class "h-..." is always relative to the parents height.
              This class doesn't seem to be automatically transisting, therefore some "h-..." class must be applied to every parent for this to work:
              img -> col -> row -> "main" container-fluid -->
              <div class="top-50 carousel-caption d-none d-md-block">
                <h3 class="fs-1 bg-black bg-opacity-50 p-3 rounded">Discover and book the perfect music studio in Vienna</h3>
              </div>
            </div>
            <div class="carousel-item h-100">
              <img src="img/Studio2.jpg" alt="StudioImage" class="d-block h-100 w-100 object-fit-cover">
              <!-- Image height: class "h-..." is always relative to the parents height.
              This class doesn't seem to be automatically transisting, therefore some "h-..." class must be applied to every parent for this to work:
              img -> col -> row -> "main" container-fluid -->
              <div class="top-50 carousel-caption d-none d-md-block">
                <h3 class="fs-1 bg-black bg-opacity-50 p-3 rounded">Unleash your musical potential—find the ideal studio space today</h3>
              </div>
            </div>
            <div class="carousel-item h-100">
              <img src="img/Studio3.jpg" alt="StudioImage" class="d-block h-100 w-100 object-fit-cover">
              <!-- Image height: class "h-..." is always relative to the parents height.
              This class doesn't seem to be automatically transisting, therefore some "h-..." class must be applied to every parent for this to work:
              img -> col -> row -> "main" container-fluid -->
              <div class="top-50 carousel-caption d-none d-md-block">
                <h3 class="fs-1 bg-black bg-opacity-50 p-3 rounded">Book top studios effortlessly</h3>
              </div>
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#image_carousel_home" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#image_carousel_home" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>
    </div>

    <!-- Studios -->
    <div class="row pt-5">
      <div class="col-12 text-center"><h2 id=studios_anchor>Studios</h2></div>
    </div>
    <div class="row">
      <div class="col-md-3">
      </div>
      <div class="col-md-6">
        <table class="table table-dark">
          <thead>
            <tr>
              <th scope="col">Studio</th>
              <th scope="col">Location</th>
              <th scope="col">Next available time slot</th>
            </tr>
          </thead>
          <tbody>
          <?php
          $sql_file = "sql/NextAvailable.sql";

          $specific_studio_id = "%";
          $set_specific_studio_id = "SET @specific_studio_id = '$specific_studio_id'";
          if (mysqli_query($conn, $set_specific_studio_id) === FALSE) {
            die("Error setting @specific_studio_id: " . mysqli_error($conn));
          }
          $number_of_days = "14";
          $set_number_of_days = "SET @number_of_days = $number_of_days";
          if (mysqli_query($conn, $set_number_of_days) === FALSE) {
            die("Error setting @number_of_days: " . mysqli_error($conn));
          }
          $query = file_get_contents($sql_file);
          $result = mysqli_query($conn, $query);
          if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
              $Next_Available_Date = $row['Next_Available_Date'];
              if ($Next_Available_Date == date('Y-m-d')) {
                $Next_Available_Date = 'Today';
              }
              elseif ($Next_Available_Date == date('Y-m-d', strtotime('+1 day'))) {
                $Next_Available_Date = 'Tomorrow';
              }
              echo "<tr>";
                echo "<td>" . $row['Studio_name'] . "</td>";
                echo "<td>" . $row['Postal_code'] . "</td>";
                echo "<td>" . $Next_Available_Date . "</td>";
              echo "</tr>";
            }
          }
          else {
            echo "<tr><td colspan='3'>No data found</td></tr>";
          }

          mysqli_close($conn);
          ?>
        </table>
      </div>
      <div class="col-md-3">
      </div>
    </div>
    <div class="row">
      <div class="col-md-3">
      </div>
      <div class="col-md-6 text-center">
        <div id="seeAllStudios" class="text-center mt-3">
          <a class="btn btn-primary" href="pages/studiolist.php" title="See all Studios">See all studios</a>
        </div>
      </div>
      <div class="col-md-3">
      </div>
    </div>

    <!-- Map -->
    <div class="row pt-5">
      <div class="col-12 text-center"><h2 id=map_anchor>Map</h2></div>
    </div>
    <div class="row h-50">
      <div class="col-md-3">
      </div>
      <div class="col-md-6">
        <iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d42540.035937471235!2d16.35414655519814!3d48.21138787178054!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1smusic%20studio!5e0!3m2!1sen!2sat!4v1730152479933!5m2!1sen!2sat" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></div>
      </div>
      <div class="col-md-3">
      </div>
    </div>

    <!-- Reviews -->
    <div class="row pt-5">
        <div class="col-12 text-center"><h2 id=reviews_anchor>Reviews</h2></div>
    </div>
    <div class="row">
      <div class="col-md-3">
      </div>
      <div class="col-md-6">
        <table class="table table-dark">
          <thead>
            <tr>
              <th scope="col"></th>
              <th scope="col">Rating</th>
              <th scope="col">Reviewer</th>
              <th scope="col">Comment</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row"></th>
              <td> ***** </td>
              <td> Anna </td>
              <td> Great! </td>
            </tr>
            <tr>
              <th scope="row"></th>
              <td> *** </td>
              <td> Bernie </td>
              <td> Okay </td>
            </tr>
            <tr>
              <th scope="row"></th>
              <td> *** </td>
              <td> Charlie </td>
              <td> Good. </td>
            </tr>
        </table>
      </div>
      <div class="col-md-3">
      </div>
    </div>

    <!-- Footer -->
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/FindAStudio/pages/footer.html"; ?>

  </div> <!-- Main container end -->

  <!-- js -->
  <script src="/FindAStudio/js/bootstrap.bundle.js"></script>
  <script src="/FindAStudio/js/jquery.min.js"></script>
  <script src="/FindAStudio/js/seeMore.js"></script>

</body>
</html>