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
            border: 1px solid #d1d5da;
            border-radius: 6px;
            font-size: 14px;
            margin-bottom: 15px;
            background-color: white;
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
            margin-top: 20px;
        }
        .btn:hover, .butn:hover {
            background-color: #22863a;
        }
    </style>
</head>
<body>

<form id="loginForm" action="" method="POST" enctype="multipart/form-data">
    <h1>Student Details</h1>

    <!-- Image Upload -->
    <input type="file" name="image" accept="image/*" required>

    <input type="text" name="student" placeholder="Enter student name" required>
    <input type="email" name="email" placeholder="Enter your email Id" maxlength="40" required>
    <input type="password" name="password" placeholder="Enter your password" required>
    <input type="number" name="number" placeholder="Enter your Mobile no." required>
    <input type="date" name="date" required>

    <!-- Dropdown for Course Selection -->
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
        <option value="Data Science">Data Science</option>
        <option value="AWS/Azure">AWS/Azure</option>
        <option value="UI Development">UI Development</option>
        <option value="AI/Machine Learning">AI/Machine Learning</option>
        <option value="HTML">HTML</option>
        <option value="CSS">CSS</option>
        <option value="JavaScript">JavaScript</option>
        <option value="PHP">PHP</option>
        <option value="C, C++">C, C++</option>
        <option value="Python">Python</option>
    </select>

    <button type="submit" class="btn">Submit</button>
    <button type="button" class="butn" onclick="clearFields()">Clear</button>
</form>

<script>
    function clearFields() {
        let inputs = document.querySelectorAll("input, select");
        inputs.forEach(input => input.value = "");
    }
</script>

</body>
</html>

<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "student_details"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student = $_POST["student"] ?? null;
    $email = $_POST["email"] ?? null;
    $key = $_POST["password"] ?? null;
    $number = $_POST["number"] ?? null;
    $date = $_POST["date"] ?? null;
    $courses = $_POST["courses"] ?? null;

    // Image Upload Handling
    $target_dir = "uploads/";
    $imageFileType = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
    $image_name = time() . '.' . $imageFileType;
    $target_file = $target_dir . $image_name;

    if (!move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        echo "<script>alert('Image upload failed!'); window.history.back();</script>";
        exit();
    }

    if (!$courses) {
        echo "<script>alert('Please select a course!'); window.history.back();</script>";
        exit();
    }

    $hashed_password = password_hash($key, PASSWORD_DEFAULT);

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO course (image, student, email, password, Mobile_no, date, course) 
                VALUES (:image, :student, :email, :password, :Mobile_no, :date, :course)";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':image', $image_name);
        $stmt->bindParam(':student', $student);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->bindParam(':Mobile_no', $number);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':course', $courses);
        $stmt->execute();

        echo "<script>alert('Student details saved successfully!'); window.location.href='crude1.php';</script>";
    } catch (PDOException $e) {
        echo "<script>alert('Database Error: " . $e->getMessage() . "');</script>";
    }
    $conn = null;
}
?>
