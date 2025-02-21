<?php
$servername = "localhost"; // Database Server
$username = "root"; // Database Username
$password = ""; // Database Password
$dbname = "upload"; // Database Name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Folder where images will be stored
$target_dir = "uploads/";

// Get image name from input field
$image_name = $_POST["image_name"];
$image_name = $conn->real_escape_string($image_name); // Prevent SQL Injection

// Get file details
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Validate if the file is an actual image
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

// Allow only specific file types (JPG, JPEG, PNG, GIF)
$allowed_extensions = array("jpg", "jpeg", "png", "gif");
if (!in_array($imageFileType, $allowed_extensions)) {
    echo "Only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

// Check file size (Max: 5MB)
if ($_FILES["fileToUpload"]["size"] > 5000000) {
    echo "File size is too large.";
    $uploadOk = 0;
}

// Check if file already exists
if (file_exists($target_file)) {
    echo "File already exists.";
    $uploadOk = 0;
}

// Upload the file
if ($uploadOk == 1) {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "File " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " uploaded.";

        // Save image name & file path in database
        $sql = "INSERT INTO image (image_name, image_path) VALUES ('$image_name', '$target_file')";
        
        if ($conn->query($sql) === TRUE) {
            echo " Image details saved in database.";
        } else {
            echo " Error: " . $conn->error;
        }
    } else {
        echo "Error uploading file.";
    }
}

$conn->close();
?>
