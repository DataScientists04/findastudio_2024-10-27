<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT'] . "/FindAStudio/php/ConnectDB.php";

if (isset($_POST['StudioID']) && isset($_POST['UserID']) && isset($_POST['date'])) {
  $UserID = $_POST['UserID'];
  $date = $_POST['date'];
  $StudioID = $_POST['StudioID'];
  $query = "INSERT INTO reservation (Reservation_Date, UserID, StudioID) VALUES ('$date', '$UserID', '$StudioID')";

  if (mysqli_query($conn, $query)) {
    header("Location: /FindAStudio/index.php");
    exit;
  }
  else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
  }
}
else {
  echo "Please fill in all required fields.";
}
?>