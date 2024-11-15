function loadStudioDetailView(StudioID) {
  var PagePath = "/FindAStudio/pages/StudioDetailView.php?StudioID=" + StudioID;
  let xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("StudioDetailView").style.display = "none"; // For fade-in effect
      $("#StudioDetailView").fadeIn(500);
      document.getElementById("StudioDetailView").innerHTML = this.responseText;
      document.getElementById("AllStudiosView").style.display = "none";
      document.getElementById("StudioHeading").innerHTML = "Details for this studio";
    }
  };
  xhttp.open("GET", PagePath, true);
  xhttp.send();
}