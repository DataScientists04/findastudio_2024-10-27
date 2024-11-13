<?php
session_start();
if(count($_POST)>0) {
	include_once $_SERVER['DOCUMENT_ROOT'] . "/FindAStudio/php/ConnectDB.php";
	$First_Name = $_POST['First_Name'];
	$Last_Name = $_POST['Last_Name'];
	$Email = $_POST['Email'];
	$Phone_number = $_POST['Phone_number'];
	$User_Password = $_POST['User_Password'];

	$sql = "SELECT * FROM user WHERE Email='$Email'";
	$result = mysqli_query($conn, $sql);

	if(mysqli_num_rows($result) === 1){
		$_SESSION['error'] = "The E-Mail" . $Email . "is already registered";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
	}
	else {
		$sql = "INSERT INTO user (First_Name, Last_Name, Email, Phone_number, User_Password) VALUES
		('$First_Name', '$Last_Name', '$Email', '$Phone_number', '$User_Password')";
        $result = mysqli_query($conn, $sql);

        if($result){
								include_once $_SERVER['DOCUMENT_ROOT'] . "/FindAStudio/php/loginUser.php";
								$_SESSION['logged_in'] = "Successfully created account for" . $Email;
                $pathto = "http://localhost/FindAStudio/index.php";
                header("Location: " . $pathto);
        }
        else {
                $_SESSION['error'] = "Error creating account";
                header("Location: " . $_SERVER['HTTP_REFERER']);
                exit();
        }
	}
}
?>