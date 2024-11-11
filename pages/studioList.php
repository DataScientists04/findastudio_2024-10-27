
<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<head>
  <title>Studios</title>
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="../fonts/bootstrap-icons-1.11.3/font/bootstrap-icons.css">
  <link rel="stylesheet" type="text/css" href="../css/findastudio.css">

  <script src="../js/studioList.js" async ></script>
  <script src="../php/studioListFilter.php"></script>
  <script src="../js/bootstrap.bundle.js" async></script>
  <script src="../js/jquery.min.js"></script>
  <script src="../js/seeMore.js"></script>

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
              <a class="nav-item nav-link" href="../index.php#studios_anchor">Studios</a>
              <a class="nav-item nav-link" href="../index.php#map_anchor">Map</a>
              <a class="nav-item nav-link" href="../index.php#reviews_anchor">Reviews</a>
            </div>
          </div>
        </nav>
      </div>
      <div class="col-6 text-center align-self-center">
        <a class="nav-link d-inline-block " href="/FindAStudio" title="Home"><h1>Find A Studio</h1></a>
      </div>
      <div class="col-3 d-flex justify-content-end align-self-center">
        <a class="nav-link d-inline-block" id="dropdown-login-button"><h1 class="bi-person px-4"></h1></a>
          <div class="top-100 dropdown-menu dropdown-menu-dark dropdown-menu-end" style="display:none;">
            <a class="dropdown-item" href="#">Login</a>
            <a class="dropdown-item" href="#">Sign up</a>
          </div>
      </div>
    </div>

    <div>
        <input type="text" id="search-name" placeholder="Studio Name">
        <input type="number" id="search-price" placeholder="Max Price">
        <select id="search-type">
            <option value="">All Types</option>
            <option value="Recording">Recording</option>
            <option value="Rehearsal">Rehearsal</option>
        </select>
        <button id="search">Search</button>
      </div>
      
        <div class="row">
            <div class="col-12 text-center">
                <h2 id="filter"></h2>
            </div>
        </div>
        
          <div id="cards" class="row p-5"></div>
          <!-- Cards to display the studios - Data obtained by objects with those IDs, parsed through the JS URLSearchParams into a php script/function getStudios -->
          <script>
            document.getElementById("search").addEventListener("click", async function () {
            
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
                          studio.Studio_name,
                          studio.Street,
                          studio.street_no,
                          studio.Postal_code,
                          `${studio.Price}€`,
                          studio.Type
                      );
                  });
              } catch (error) {
                  console.error("Error fetching studios:", error);
              }
          });
          </script>
         

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
            <a href="Contact.html" title="Contact Information">Contact</a>
          </li>
          <li class="list-group-item">
            <a href="AboutUs.html" title="About Us">About Us</a>
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