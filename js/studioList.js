function getCards(StudioID, studioName, street, street_no, postalCode, price, type) {
    var HTMLlist = document.getElementById("cards");
    if (!HTMLlist) {
        console.error("Element with ID 'cards' not found in the DOM.");
    }
  
    var newElement = document.createElement("div");
    newElement.setAttribute("class", "card lg-3 m-4 col-3");
    newElement.setAttribute("style", "max-width: 22rem; min-width: 16rem; max-height: 22rem; min-height: 16rem; cursor: pointer;");
    newElement.setAttribute("id", StudioID);
    newElement.onclick = function() {
      loadXMLDoc(StudioID);
    };
  
    newElement.innerHTML = `
        <div class="card-body">
            <div class="row">
                <div class="col-12"><h3>${studioName}</h3></div>
                <p class="card-title">Street: ${street}</p>
                <p class="card-text">District: ${postalCode}</p>
                <p class="card-text">Price: ${price}</p>
                <p class="card-text">Type: ${type}</p>
            </div>
        </div>
    `;
  
    HTMLlist.appendChild(newElement);
  }