<?php
// get_user.php

// Assuming you have a database connection established
$host = "localhost";
$username = "root";
$password = "";
$database = "useraccount";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user ID from the GET request
$userId = $_GET['userId'];

// Fetch user data from the database based on the user ID
$sql = "SELECT * FROM useraccount WHERE unique_id = '$userId'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Return user data as JSON
    $user = $result->fetch_assoc();
    echo json_encode($user);
} else {
    // Return an empty JSON object if no user is found
    echo json_encode([]);
}

$conn->close();
?>
