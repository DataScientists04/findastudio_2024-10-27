<?php
session_start();
if(count($_POST)>0) {
	include_once $_SERVER['DOCUMENT_ROOT'] . "/FindAStudio/php/ConnectDB.php";
	$Email = $_POST['Email'];
	$User_Password = $_POST['User_Password'];

	$sql = "SELECT * FROM user WHERE Email='$Email' and User_Password = '$User_Password'";
	$result = mysqli_query($conn, $sql);

	if(mysqli_num_rows($result) === 1){
		$row = mysqli_fetch_assoc($result);
		$_SESSION['UserID'] = $row['UserID'];
		$_SESSION['First_Name'] = $row['First_Name'];
		$_SESSION['Email'] = $row['Email'];
		$_SESSION['logged_in'] = "Successfully logged in as " . $row['Email'];
	}
  else {
		$_SESSION['error'] = "Invalid username or password";
  }
}
header("Location: " . $_SERVER['HTTP_REFERER']);
?>