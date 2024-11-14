function loadXMLDoc(StudioID) {
    var PagePath = "/FindAStudio/pages/StudioDetailView_ajax.php?StudioID=" + StudioID;
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("StudioDetailView").innerHTML =
        this.responseText;
  
        // Change AllStudiosView
        document.getElementById("AllStudiosView").setAttribute("style", "display: none;");
        document.getElementById("StudioHeading").innerHTML = "Details for Studio";
      }
    };
    xhttp.open("GET", PagePath, true);
    xhttp.send();
  }  