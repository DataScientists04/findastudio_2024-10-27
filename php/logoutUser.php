<?php
session_start();
session_unset();
session_destroy();
session_start();
$_SESSION['logged_out'] = "You have been successfully logged out.";
$pathto = "http://localhost/FindAStudio/index.php";
header("Location: " . $pathto);
exit();
?>