<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT'] . "/FindAStudio/php/ConnectDB.php";
?>

<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<head>
  <title>Studios</title>
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="../fonts/bootstrap-icons-1.11.3/font/bootstrap-icons.css">
  <link rel="stylesheet" type="text/css" href="../css/findastudio.css">
  <script src="/FindAStudio/js/StudioDetailView.js" async></script>
  <script src="/FindAStudio/js/Reset_AllStudiosView.js" async></script>
  <script src="/FindAStudio/js/redirectReservation.js" async></script>
</head>
<body>
  <div class="container-fluid vh-100"> <!-- Main container -->

    <!-- topbar -->
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/FindAStudio/pages/navbar.php"; ?>

    <div class="row py-3">
      <div class="col-12 text-center"><h2 id="StudioHeading">Overview of our studios</h2>
      </div>
    </div>

    <div id="StudioDetailView" class="p-5" style="display: none;"></div>
    <div id="AllStudiosView">
      <!-- Filters -->
      <div class="row">
        <div class="col-sm w-50 py-1">
          <label for="search-name" class="form-label">Studio name</label>
          <input type="text" class="form-control" id="search-name">
        </div>
        <div class="col-sm w-50 py-1">
          <label for="search-name" class="form-label">Max. Price</label>
          <input type="number" class="form-control" id="search-price" placeholder="$">
        </div>
        <div class="col-sm w-50 py-1">
          <label for="search-name" class="form-label">Studio type</label>
          <select id="search-type" class="form-select">
            <option value="">All Types</option>
            <option value="Recording">Recording</option>
            <option value="Rehearsal">Rehearsal</option>
          </select>
        </div>
        <div class="col-xl py-1 d-flex align-items-end">
          <button class="btn btn-primary" id="search">Search</button>
        </div>
      </div>

      <!-- Cards -->
      <div class="row min-vh-100"> <!-- to have a min height before the footer-->
        <div id="cards" class="row p-5 d-flex justify-content-center"></div>
      </div>
    </div>
    <!-- Cards to display the studios - Data obtained by objects with those IDs, parsed through the JS URLSearchParams into a php script/function getStudios -->
    <script>
    async function fetchStudios () {

      const searchButton = document.getElementById("search"); // possibly not needed
      const name = document.getElementById("search-name").value;
      const price = document.getElementById("search-price").value;
      const type = document.getElementById("search-type").value;

      if (!searchButton) {
        console.error("Search button not found in the DOM.");
        return;
      }
      console.log("Searching with filters:", { name, price, type });

      // Create query parameters for the API request
      const queryParams = new URLSearchParams({
          name: name,
          price: price,
          type: type
      });

      try {
        document.getElementById('cards').style.display = 'none'; // For fade-in effect (further down)
        // Make the API request
        const response = await fetch(`../php/getStudios.php?${queryParams}`);
        // console.log("API Request made to:", `../php/getStudios.php?${queryParams}`);

        if (!response.ok) {
            console.error("Failed to fetch data. Status:", response.status);
            return;
        }
        const studios = await response.json();
        console.log("Data received:", studios);

        // Validate response data
        if (!Array.isArray(studios)) {
            console.error("Invalid response format:", studios);
            return;
        }

        // Get the container for results
        const resultsContainer = document.getElementById("cards");
        if (!resultsContainer) {
          console.error("Results container not found in the DOM.");
          return;
        }
        resultsContainer.innerHTML = "";

        // Loop through the studios and create cards
        studios.forEach(studio => {
          getCards(
            studio.StudioID,
            studio.Studio_name,
            studio.Street,
            studio.street_no,
            studio.Postal_code,
            `${studio.Price}€`,
            studio.Type
          );
        });
        $("#cards").fadeIn(500); //$("#x") syntax is part of jQuery
      }
      catch (error) {
        console.error("Error fetching studios:", error);
      }
    };
    document.getElementById("search").addEventListener("click", fetchStudios); // Trigger fetchStudios on button press
    window.addEventListener('DOMContentLoaded', fetchStudios); // Trigger fetchStudios on page load
    </script>


    <!-- Footer -->
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/FindAStudio/pages/footer.html"; ?>

  </div> <!-- Main container end -->

  <!-- js -->
  <script src="/FindAStudio/js/bootstrap.bundle.js"></script>
  <script src="/FindAStudio/js/jquery.min.js"></script>
  <script src="/FindAStudio/js/studioList.js" async ></script>

</body>
</html>