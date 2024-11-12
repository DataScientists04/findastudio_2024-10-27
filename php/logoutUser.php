<?php
session_start();
session_unset();
session_destroy();
$pathto = "http://localhost/FindAStudio/index.php";
header("Location: " . $pathto);
?>