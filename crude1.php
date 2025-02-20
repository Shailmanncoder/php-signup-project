<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student_details";

try {
    // Establish database connection
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Handle Delete Request
    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];
        $deleteStmt = $conn->prepare("DELETE FROM course WHERE id = ?");
        $deleteStmt->execute([$id]);
        echo "<script>alert('Record Deleted Successfully'); window.location='crude1.php';</script>";
    }

    // Handle Update Request
    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $student = $_POST['student'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
        $date = $_POST['date'];
        $course = $_POST['course'];

        $updateStmt = $conn->prepare("UPDATE course SET student=?, email=?, Mobile_no=?, date=?, course=? WHERE id=?");
        $updateStmt->execute([$student, $email, $mobile, $date, $course, $id]);
        echo "<script>alert('Record Updated Successfully'); window.location='crude1.php';</script>";
    }

    // Fetch all records
    $stmt = $conn->prepare("SELECT id, student, email, Mobile_no, date, course FROM course"); // Password column removed
    $stmt->execute();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details</title>
</head>
<body>
    <h2>Student Records</h2>
    <table border='1' style='border-collapse: collapse; width: 70%; text-align: left;'>
        <tr>
            <th>S_no.</th><th>Student</th><th>Email</th><th>Mobile No.</th><th>Date</th><th>Course</th><th>Actions</th>
        </tr>
        
        <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['student'] ?></td>
                <td><?= $row['email'] ?></td>
                <td><?= $row['Mobile_no'] ?></td>
                <td><?= $row['date'] ?></td>
                <td><?= $row['course'] ?></td>
                <td>
                    <a href='?edit=<?= $row['id'] ?>'>Edit</a> |
                    <a href='?delete=<?= $row['id'] ?>' onclick='return confirm("Are you sure?")'>Delete</a>
                </td>
            </tr>
        <?php } ?>
    </table>

    <?php if (isset($_GET['edit'])) {
        $id = $_GET['edit'];
        $stmt = $conn->prepare("SELECT id, student, email, Mobile_no, date, course FROM course WHERE id = ?");
        $stmt->execute([$id]);
        $record = $stmt->fetch(PDO::FETCH_ASSOC);
    ?>

        <h2>Update Student Details</h2>
        <form method="POST">
            <input type="hidden" name="id" value="<?= $record['id'] ?>">
            Student: <input type="text" name="student" value="<?= $record['student'] ?>" required><br><br>
            Email: <input type="email" name="email" value="<?= $record['email'] ?>" required><br><br>
            Mobile No: <input type="text" name="mobile" value="<?= $record['Mobile_no'] ?>" required><br><br>
            Date: <input type="date" name="date" value="<?= $record['date'] ?>" required><br><br>
            <select name="course" class="clear" id="courseSelect" required>
    <option value="" disabled hidden>Select course</option>
    <option value="Digital Marketing" <?= ($record['course'] == "Digital Marketing") ? "selected" : "" ?>>Digital Marketing</option>
    <option value="SAP training" <?= ($record['course'] == "SAP training") ? "selected" : "" ?>>SAP training</option>
    <option value="MEAN/MERN Stack" <?= ($record['course'] == "MEAN/MERN Stack") ? "selected" : "" ?>>MEAN/MERN Stack</option>
    <option value="Excel training" <?= ($record['course'] == "Excel training") ? "selected" : "" ?>>Excel training</option>
    <option value="Automation training" <?= ($record['course'] == "Automation training") ? "selected" : "" ?>>Automation training</option>
    <option value="Software training" <?= ($record['course'] == "Software training") ? "selected" : "" ?>>Software training</option>
    <option value="React training" <?= ($record['course'] == "React training") ? "selected" : "" ?>>React training</option>
    <option value="Android training" <?= ($record['course'] == "Android training") ? "selected" : "" ?>>Android training</option>
    <option value="Aptitude training" <?= ($record['course'] == "Aptitude training") ? "selected" : "" ?>>Aptitude training</option>
    <option value="Graphic designing" <?= ($record['course'] == "Graphic designing") ? "selected" : "" ?>>Graphic designing</option>
    <option value="Database" <?= ($record['course'] == "Database") ? "selected" : "" ?>>Database</option>
    <option value=".Net Training" <?= ($record['course'] == ".Net Training") ? "selected" : "" ?>>.Net Training</option>
    <option value="Core and Advanced java" <?= ($record['course'] == "Core and Advanced java") ? "selected" : "" ?>>Core and Advanced Java</option>
    <option value="Data science" <?= ($record['course'] == "Data science") ? "selected" : "" ?>>Data Science</option>
    <option value="AWS/Azure" <?= ($record['course'] == "AWS/Azure") ? "selected" : "" ?>>AWS/Azure</option>
    <option value="UI development" <?= ($record['course'] == "UI development") ? "selected" : "" ?>>UI development</option>
    <option value="AI/Machine learning" <?= ($record['course'] == "AI/Machine learning") ? "selected" : "" ?>>AI/Machine Learning</option>
    <option value="HTML" <?= ($record['course'] == "HTML") ? "selected" : "" ?>>HTML</option>
    <option value="CSS" <?= ($record['course'] == "CSS") ? "selected" : "" ?>>CSS</option>
    <option value="JavaScript" <?= ($record['course'] == "JavaScript") ? "selected" : "" ?>>JavaScript</option>
    <option value="PHP" <?= ($record['course'] == "PHP") ? "selected" : "" ?>>PHP</option>
    <option value="C,C++" <?= ($record['course'] == "C,C++") ? "selected" : "" ?>>C, C++</option>
    <option value="Python" <?= ($record['course'] == "Python") ? "selected" : "" ?>>Python</option>
</select>

            <button type="submit" name="update">Update</button>
        </form>

    <?php } ?>
</body>
</html>
