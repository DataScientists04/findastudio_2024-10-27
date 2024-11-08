<?php
header('Content-Type: application/json');

function getStudios($name = '', $price = '', $type = '') {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "find_a_studio";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Base SQL query
    $sql = "SELECT * FROM find_a_studio.studio WHERE 1=1";

    // Add filters based on input
    $params = [];
    if (!empty($name)) {
        $sql .= " AND Studio_name LIKE ?";
        $params[] = "%$name%";
    }
    if (!empty($price)) {
        $sql .= " AND Price <= ?";
        $params[] = $price;
    }
    if (!empty($type)) {
        $sql .= " AND `Type` = ?";
        $params[] = $type;
    }

    // Prepare and execute statement
    $stmt = $conn->prepare($sql);

    // Bind parameters
    if (!empty($params)) {
        $types = str_repeat('s', count($params));
        $stmt->bind_param($types, ...$params);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch data as an associative array
    $studios = [];
    while ($row = $result->fetch_assoc()) {
        $studios[] = $row;
    }

    // Close connection
    $stmt->close();
    $conn->close();

    // Return JSON response
    echo json_encode($studios);
}

// Get input data
$name = isset($_GET['name']) ? $_GET['name'] : '';
$price = isset($_GET['price']) ? $_GET['price'] : '';
$type = isset($_GET['type']) ? $_GET['type'] : '';

// Call the function and return filtered results
getStudios($name, $price, $type);
?>
