<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "upload";

// Create database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve images from the database
$sql = "SELECT * FROM image";
$result = $conn->query($sql);

echo "<h2>Uploaded Images</h2>";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<h3>" . $row["image_name"] . "</h3>"; // Display image name
        echo "<img src='" . $row["image_path"] . "' width='200' height='200'><br><br>";
    }
} else {
    echo "No images found.";
}

$conn->close();
?>
