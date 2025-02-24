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

    // Fetch the image to delete
    $stmt = $conn->prepare("SELECT image FROM course WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $image = $stmt->fetchColumn();

    if ($image && file_exists("uploads/$image")) {
        unlink("uploads/$image"); // Delete the image
    }

    // Delete record
    $stmt = $conn->prepare("DELETE FROM course WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    echo "<script>alert('Record deleted successfully!'); window.location.href='crude1.php';</script>";
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student = $_POST["student"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $number = $_POST["number"];
    $date = $_POST["date"];
    $course = $_POST["courses"];
    
    // Handle image upload
    $image = "";
    if (!empty($_FILES["image"]["name"])) {
        $image = time() . "_" . basename($_FILES["image"]["name"]);
        $target = "uploads/" . $image;
        move_uploaded_file($_FILES["image"]["tmp_name"], $target);
    }

    // Insert data
    $sql = "INSERT INTO course (student, email, password, Mobile_no, date, course, image) 
            VALUES (:student, :email, :password, :Mobile_no, :date, :course, :image)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':student', $student);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':Mobile_no', $number);
    $stmt->bindParam(':date', $date);
    $stmt->bindParam(':course', $course);
    $stmt->bindParam(':image', $image);
    $stmt->execute();

    echo "<script>alert('Student details saved successfully!'); window.location.href='crude1.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        form {
            background: white;
            padding: 25px;
            width: 350px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.3);
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
        }
        .btn, .butn {
            width: 48%;
            background-color: #2ea44f;
            color: white;
            padding: 10px;
            font-size: 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
        .btn:hover, .butn:hover {
            background-color: #22863a;
        }
    </style>
</head>
<body>
    <form id="loginForm" action="" method="POST" enctype="multipart/form-data">
        <h1>Student Details</h1>
        <input type="file" name="image" required>
        <input type="text" name="student" placeholder="Enter student name" required>
        <input type="email" name="email" placeholder="Enter your email Id" required>
        <input type="password" name="password" placeholder="Enter your password" required>
        <input type="number" name="number" placeholder="Enter your Mobile no." required>
        <input type="date" name="date" required>

        <!-- Course Selection -->
        <select name="courses" required>
            <option value="" disabled hidden>Select course</option>
            <option value="Digital Marketing">Digital Marketing</option>
            <option value="SAP training">SAP training</option>
            <option value="MEAN/MERN Stack">MEAN/MERN Stack</option>
            <option value="Excel training">Excel training</option>
            <option value="Automation training">Automation training</option>
            <option value="Software training">Software training</option>
            <option value="React training">React training</option>
            <option value="Android training">Android training</option>
            <option value="Aptitude training">Aptitude training</option>
            <option value="Graphic designing">Graphic designing</option>
            <option value="Database">Database</option>
            <option value=".Net Training">.Net Training</option>
            <option value="Core and Advanced Java">Core and Advanced Java</option>
            <option value="Data science">Data science</option>
            <option value="AWS/Azure">AWS/Azure</option>
            <option value="UI development">UI development</option>
            <option value="AI/Machine learning">AI/Machine learning</option>
            <option value="HTML">HTML</option>
            <option value="CSS">CSS</option>
            <option value="JavaScript">JavaScript</option>
            <option value="PHP">PHP</option>
            <option value="C,C++">C, C++</option>
            <option value="Python">Python</option>
        </select>

        <button type="submit" class="btn">Submit</button>
        <button type="button" class="butn" onclick="clearFields()">Clear</button>
    </form>

    <script>
        function clearFields() {
            let inputs = document.querySelectorAll("input, select");
            inputs.forEach(input => {
                if (input.tagName === "SELECT") {
                    input.selectedIndex = 0;
                } else {
                    input.value = "";
                }
            });
        }
    </script>
</body>
</html>
