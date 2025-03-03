<?php
$servername = "localhost"; // Change if using a different host
$username = "root"; // Your database username (default is 'root' for XAMPP)
$password = ""; // Your database password (leave empty for XAMPP)
$database = "popup-details"; // Your database name

// Create database connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get Data from Form
$person = $_POST['person'];
$email = $_POST['email'];
$country = $_POST['country'];

// Insert Query
$sql = "INSERT INTO ticket (person, email, country) VALUES ('$person', '$email', '$country')";

if ($conn->query($sql) === TRUE) {
    echo "success";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close Connection
$conn->close();
?>
