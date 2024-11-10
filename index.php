<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<head>
  <title>Find A Studio - Home</title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="css/findastudio.css">
  <link rel="stylesheet" type="text/css" href="fonts/bootstrap-icons-1.11.3/font/bootstrap-icons.css">

  <script src="js/bootstrap.bundle.js"></script>
  <script src="js/jquery.min.js"></script>
  <script src="js/seeMore.js"></script>

</head>
<body>
  <div class="container-fluid vh-100"> <!-- Main container -->

    <!-- topbar -->
    <div class="row navbar">
      <div class="col-3">
        <nav class="navbar-expand-md">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <span class="navbar-dark navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarContent">
            <div class="navbar-nav px-3">
              <a class="nav-item nav-link" href="#studios_anchor">Studios</a>
              <a class="nav-item nav-link" href="#map_anchor">Map</a>
              <a class="nav-item nav-link" href="#reviews_anchor">Reviews</a>
            </div>
          </div>
        </nav>
      </div>
      <div class="col-6 text-center align-self-center">
        <a class="nav-link d-inline-block " href="/FindAStudio" title="Home"><h1>Find A Studio</h1></a>
      </div>
      <div class="col-3 text-end align-self-center">
        <a class="nav-link d-inline-block"><h1 class="bi-person px-4"></h1></a>
      </div>
    </div>

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
            include_once "php/ConnectDB.php";

            $query = "SELECT * FROM studio LIMIT 5";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<th scope='row'>" . $row['ID'] . "</th>";
                    echo "<td>" . $row['Studio_name'] . "</td>";
                    echo "<td>" . $row['Postal_code'] . "</td>";
                    echo "<td> Tomorrow, 10:00 </td>";
                    echo "</tr>";
                }
            } else {
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
    <div class="row pt-5 mt-5 footer">
      <div class="col-12 text-center">
        <h2>FindAStudio</h2>
      </div>
    </div>
    <div class="row footer">
      <div class="col-3">
      </div>
      <div class="col-6 text-center border-top">
        <ul class="list-group">
          <li class="list-group-item">
            <a href="pages/Contact.html" title="Contact Information">Contact</a>
          </li>
          <li class="list-group-item">
            <a href="pages/AboutUs.html" title="About Us">About Us</a>
          </li>
          <li class="list-group-item">
            © 2024 FindAStudio
          </li>
        </ul>
      </div>
      <div class="col-3">
      </div>
    </div>

  </div> <!-- Main container end -->
</body>
</html>
