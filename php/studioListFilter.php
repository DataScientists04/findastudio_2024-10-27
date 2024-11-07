
<?php

// studioListFilter.php



function getStudios() {

    $servername = "localhost";
    $username = "root";
    $password = "";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password);

    
    echo $conn->connect_error;
    // Check connection 
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Select database
    $db = mysqli_select_db($conn, "find_a_studio");
    
    // Check if database was selected
    if (!$db) {
        die("Connection failed: ".mysqli_connect_error());
    }

    // Query to get all studios

    $sql = "SELECT * FROM find_a_studio.studio";

    $result = mysqli_query($conn, $sql);

    if (!$result) {
        echo $result;
    }

    
    return $result;
   
}
?>


?>
