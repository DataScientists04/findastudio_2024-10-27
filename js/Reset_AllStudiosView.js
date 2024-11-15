function Reset_AllStudiosView() {
  document.getElementById("StudioDetailView").innerHTML = "";
  document.getElementById("StudioDetailView").style.display = "none"
  document.getElementById("AllStudiosView").style.display = "";

  document.getElementById("cards").style.display = "none"; // For fade-in effect
  $("#cards").fadeIn(500);

  document.getElementById("StudioHeading").innerHTML = "Overview of our studio";
}