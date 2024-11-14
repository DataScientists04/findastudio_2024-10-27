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
        <img src="img/Studio1.jpg" alt="StudioImage" class="h-100 w-100 object-fit-cover"> <!-- class "h-..." is always relative to the parents height. This class doesn't seem to be automatically transisting, therefore some "h-..." class must be applied to every parent for this to work: img -> col -> row -> "main" container-fluid -->
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
              <th scope="col"></th>
              <th scope="col">Studio</th>
              <th scope="col">Location</th>
              <th scope="col">Next available time slot</th>
            </tr>
          </thead>
          <tbody>
          <?php
          $sql_file = "sql/NextAvailable.sql";
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
              echo "<th scope='row'>" . $row['ID'] . "</th>"; # dots combine strings
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
            <!-- Additional studios, initially hidden
            <tr class="more-studios" style="display: none;">
              <th scope="row"></th>
              <td>Studio D</td>
              <td>1180</td>
              <td>Today, 11:00</td>
            </tr>
            <tr class="more-studios" style="display: none;">
              <th scope="row"></th>
              <td>Studio E</td>
              <td>1040</td>
              <td>Tomorrow, 15:00</td>
            </tr>
          </tbody> -->
        </table>
      </div>
      <div class="col-md-3">
      </div>
    </div>
    <div class="row">
      <div class="col-md-3">
      </div>
      <div class="col-md-6 text-center">
        <!-- See more studios button
        <div class="text-center">
          <button id="seeMoreStudios" class="btn btn-primary">See more studios</button>
        </div> -->
        <div id="seeAllStudios" class="text-center mt-3"> <!-- style="display: none;"> -->
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
        <iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d42540.035937471235!2d16.35414655519814!3d48.21138787178054!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1mdusic%20studio!5e0!3m2!1sen!2sat!4v1730152479933!5m2!1sen!2sat" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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