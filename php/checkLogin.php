<?php
session_start();
$response = [
    'loggedin' => isset($_SESSION['Email'])
];

header('Content-Type: application/json');
echo json_encode($response);
exit;
?>
