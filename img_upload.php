<!DOCTYPE html>
<html>
<head>
    <title>Upload Image</title>
</head>
<body>

<h2>Upload Image</h2>
<form action="upload.php" method="post" enctype="multipart/form-data">
    Enter Image Name:
    <input type="text" name="image_name" required>
    <br><br>
    Select Image to Upload:
    <input type="file" name="fileToUpload" id="fileToUpload" required>
    <br><br>
    <input type="submit" value="Upload Image" name="submit">
</form>

</body>
</html>
