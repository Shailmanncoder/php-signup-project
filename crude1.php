<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student_details";

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Handle delete request
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    // Fetch the image name from database
    $stmt = $conn->prepare("SELECT image FROM course WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $image = $stmt->fetchColumn();

    // Delete the image file if it exists
    if ($image && file_exists("uploads/$image")) {
        unlink("uploads/$image");
    }

    // Delete the record from database
    $stmt = $conn->prepare("DELETE FROM course WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    echo "<script>alert('Record deleted successfully!'); window.location.href='crude1.php';</script>";
}

// Fetch all student records
$stmt = $conn->prepare("SELECT * FROM course");
$stmt->execute();
$students = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student List</title>
    <style>
        table { width: 80%; margin: 20px auto; border-collapse: collapse; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: center; }
        img { width: 50px; height: 50px; border-radius: 50%; object-fit: cover; }
        .btn { padding: 8px 12px; color: white; text-decoration: none; margin: 5px; }
        .update { background-color: #f39c12; }
        .delete { background-color: #e74c3c; }
    </style>
</head>
<body>
    <h2>Student Records</h2>
    <a href="course_submission.php" class="btn add">Add New Student</a>
    <table>
        <tr><th>ID</th><th>Image</th><th>Name</th><th>Email</th><th>Course</th><th>Actions</th></tr>
        <?php foreach ($students as $student): ?>
            <tr>
                <td><?= $student["id"] ?></td>
                <td><img src="uploads/<?= $student["image"] ?>" alt="Student Image"></td>
                <td><?= $student["student"] ?></td>
                <td><?= $student["email"] ?></td>
                <td><?= $student["course"] ?></td>
                <td>
                    <a href="course_submission.php?edit=<?= $student["id"] ?>" class="btn update">Update</a>
                    <a href="?delete=<?= $student["id"] ?>" onclick="return confirm('Are you sure?')" class="btn delete">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
