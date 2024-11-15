<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT'] . "/FindAStudio/php/ConnectDB.php";

if (isset($_POST['StudioID']) && isset($_POST['UserID']) && isset($_POST['date']) && isset($_POST['time'])) {
  $StudioID = $_POST['StudioID'];
  $UserID = $_POST['UserID'];
  $Reservation_Date = $_POST['date'];
  $Reservation_Time = $_POST['time'];

  $query = "INSERT INTO reservation (StudioID, UserID, Reservation_Date, Reservation_Time) VALUES ($StudioID, $UserID, $Reservation_Date, $Reservation_Time)";

  if (mysqli_query($conn, $query)) {
    echo "Reservation successful!";
  } else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
  }
} else {
  echo "Please fill in all required fields.";
}