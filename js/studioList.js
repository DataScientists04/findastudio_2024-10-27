const musicStudios = [
    {
        name: "Studio A",
        type: "Recording",
        price: 50,
        district: "1010",
        size: "500 sq ft"
    },
    {
        name: "Studio B",
        type: "Rehearsal",
        price: 75,
        district: "1210",
        size: "750 sq ft"
    },
    {
        name: "Studio C",
        type: "Production",
        price: 100,
        district: "1100",
        size: "1000 sq ft"
    },
    {
        name: "Studio D",
        type: "Recording",
        price: 60,
        district: "1180",
        size: "600 sq ft"
    },
    {
        name: "Studio E",
        type: "Rehearsal",
        price: 80,
        district: "1040",
        size: "800 sq ft"
    }
];

var HTMLlist = document.getElementById("cards");
if (!HTMLlist) {
    console.error("Element with ID 'cards' not found in the DOM.");
}

var newElement = document.createElement("div"); 
// to add a class: 
newElement.setAttribute("class", "card"); 
// to add an id 
newElement.setAttribute("id", "cardsToCreate"); 
// console.log(newElement);



for (let i = 0; i < musicStudios.length; i++) {
    let newElement = document.createElement("div"); 
    newElement.setAttribute("class", "card lg-3 m-4 col-3"); 
    newElement.setAttribute("style",  "max-width: 22rem; min-width: 16rem; max-height: 22rem; min-height: 16rem;"); 
    newElement.setAttribute("id", "cardsToCreate"); 
        const studioName = musicStudios[i].name;
        const studioType = musicStudios[i].type;
        const studioPrice = musicStudios[i].price;
        const studioDistrict = musicStudios[i].district;
        const studioSize = musicStudios[i].size;
        newElement.innerHTML = `
            <div class="card-body">
                <div class="row">
                    <div class="col-12"><h3>${studioName}</h3></div>
                    <h5 class="card-title">${studioType}</h5>
                    <p class="card-text">Price: ${studioPrice}</p>
                    <p class="card-text">District: ${studioDistrict}</p>
                    <p class="card-text">Size: ${studioSize}</p>
                </div>
            </div>
        `
        HTMLlist.appendChild(newElement);
        
    }
   

