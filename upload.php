<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "upload";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Folder where images will be stored
$target_dir = "uploads/";

// Check if form is submitted
if (isset($_POST["submit"])) {
    // Get image name from input field
    $image_name = $conn->real_escape_string($_POST["image_name"]);

    // Get file details
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Validate if the file is an actual image
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Allow only specific file types
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
            // Save image name & file path in database
            $sql = "INSERT INTO image (image_name, image_path) VALUES ('$image_name', '$target_file')";
            
            if ($conn->query($sql) === TRUE) {
                echo "File uploaded successfully.";
            } else {
                echo "Error: " . $conn->error;
            }
        } else {
            echo "Error uploading file.";
        }
    }
}

// Fetch the latest uploaded image
$sql = "SELECT image_path FROM image ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Upload</title>
</head>
<body>

<form action="" method="post" enctype="multipart/form-data">
    <label for="image_name">Image Name:</label>
    <input type="text" name="image_name" required>
    <br>
    <input type="file" name="fileToUpload" required>
    <br>
    <input type="submit" name="submit" value="Upload Image">
</form>

<?php
// Display the latest uploaded image
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "<h3>Uploaded Image:</h3>";
    echo "<img src='" . $row["image_path"] . "' width='300' alt='Uploaded Image'>";
}
?>

</body>
</html>
