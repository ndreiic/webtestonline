<?php
// update_user.php

$host = "localhost";
$username = "root";
$password = "";
$database = "useraccount";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from the form
$userId = $_POST['editUserId'];
$lastName = $_POST['editLastName'];
$firstName = $_POST['editFirstName'];
$middleName = $_POST['editMiddleName'];
$email = $_POST['editEmail'];
$stallNumber = $_POST['editStallNumber'];

// Update the user data in the database
$sql = "UPDATE useraccount SET lname='$lastName', fname='$firstName', mname='$middleName', email='$email', stall_number='$stallNumber' WHERE unique_id='$userId'";

if ($conn->query($sql) === TRUE) {
    echo "User data updated successfully";
    header("Location: usertest.php");
} else {
    echo "Error updating user data: " . $conn->error;
}

$conn->close();
?>
