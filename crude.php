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
        echo "<script>alert('Record Deleted Successfully'); window.location='crude.php';</script>";
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
        echo "<script>alert('Record Updated Successfully'); window.location='crude.php';</script>";
    }

    // Fetch all records
    $stmt = $conn->prepare("SELECT id, student, email, Mobile_no, date, course FROM course"); // Password column removed
    $stmt->execute();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!-- Display Student Records (Without Password Column) -->
<table border='1' style='border-collapse: collapse; width: 70%; text-align: left;'>
    <tr>
        <th>S_no.</th><th>Student</th><th>Email</th><th>Mobile No.</th><th>Date</th><th>Course</th><th>Actions</th>
    </tr>

    <?php
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT id, student, email, Mobile_no, date, course FROM course"); // Password column removed
    $stmt->execute();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>{$row['id']}</td>";
        echo "<td>{$row['student']}</td>";
        echo "<td>{$row['email']}</td>";
        echo "<td>{$row['Mobile_no']}</td>";
        echo "<td>{$row['date']}</td>";
        echo "<td>{$row['course']}</td>";
        echo "<td>
            <a href='?edit={$row['id']}'>Edit</a> | 
            <a href='?delete={$row['id']}' onclick='return confirm(\"Are you sure?\")'>Delete</a>
        </td>";
        echo "</tr>";
    }
    ?>
</table>

<!-- Update Form -->
<?php
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $stmt = $conn->prepare("SELECT id, student, email, Mobile_no, date, course FROM course WHERE id = ?"); // Password column removed
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
        Course: <input type="text" name="course" value="<?= $record['course'] ?>" required><br><br>
        <button type="submit" name="update">Update</button>
    </form>

<?php } ?>
