<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT'] . "/FindAStudio/php/ConnectDB.php";

if isset($_POST['UserID']) && isset($_POST['date'])) {
  $UserID = $_POST['UserID'];
  $date = $_POST['date'];
  $query = "INSERT INTO reservation (UserID, Reservation_Date) VALUES
  ('$UserID', '$date')";

  if (mysqli_query($conn, $query)) {
    echo "Reservation successful!";
  }
  else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
  }
}
else {
  echo "Please fill in all required fields.";
}
?>