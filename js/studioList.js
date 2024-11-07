

function getCards(studioName, street, street_no, postalCode, price, type) {



    var HTMLlist = document.getElementById("cards");
    if (!HTMLlist) {
        console.error("Element with ID 'cards' not found in the DOM.");
    }
    
    var newElement = document.createElement("div"); 
    // to add a class: 
    // to add an id 
    newElement.setAttribute("class", "card lg-3 m-4 col-3"); 
    newElement.setAttribute("id", "cardsToCreate"); 
    newElement.setAttribute("style",  "max-width: 22rem; min-width: 16rem; max-height: 22rem; min-height: 16rem;"); 
    
    newElement.innerHTML = `
        <div class="card-body">
            <div class="row">
                <div class="col-12"><h3>${studioName}</h3></div>
                <h5 class="card-title">Street: ${street} ${street_no}</h5>
                <p class="card-text">District: ${postalCode}</p>
                <p class="card-text">Price: ${price}</p>
                <p class="card-text">Type: ${type}</p>
            </div>
        </div>
    `
    
    HTMLlist.appendChild(newElement);
    }
    