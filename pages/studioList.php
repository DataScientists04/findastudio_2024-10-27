
<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<head>
  <title>Studios</title>
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="../fonts/bootstrap-icons-1.11.3/font/bootstrap-icons.css">
  <link rel="stylesheet" type="text/css" href="../css/findastudio.css">
</head>
<body>
  <div class="container-fluid vh-100"> <!-- Main container -->

    <!-- topbar -->
    <div id="navbar"></div>

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
    <div id="footer"></div>

  </div> <!-- Main container end -->

  <!-- js -->
  <script src="../js/bootstrap.bundle.js"></script>
  <script src="../js/studioList.js" async ></script>
  <script src="../php/studioListFilter.php"></script>
  <script src="../js/jquery.min.js"></script>
  <script src="../js/seeMore.js"></script>
  <script>
  $(function(){
    $("#navbar").load("../html/navbar1.html");
    $("#footer").load("../html/footer1.html");
  });
  </script>

</body>
</html>