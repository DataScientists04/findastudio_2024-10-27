<?php
	if(count($_POST)>0) {
  	include_once $_SERVER['DOCUMENT_ROOT'] . "/FindAStudio/php/ConnectDB.php";
  	$uname = $_POST['username'];
  	$pass = $_POST['password'];

  	$sql = "SELECT * FROM user WHERE Email='$uname' and User_Password = '$pass'";
  	$result = mysqli_query($conn, $sql);

  	if(mysqli_num_rows($result) === 1){
  		$row = mysqli_fetch_assoc($result);

  		if($row['Email']===$uname && $row['User_Password'] === $pass){
  			$_SESSION['UserID'] = $row['UserID'];
  			$_SESSION['First_Name'] = $row['First_Name'];
  			$_SESSION['username'] = $row['Email'];
				$_SESSION['logged_in'] = "Successfully logged in as " . $row['Email'];
			}
  	}
    else { $_SESSION['error'] = "Invalid username or password";
      header("Location: " . $_SERVER['HTTP_REFERER']);
      exit();
      }
	}
?>