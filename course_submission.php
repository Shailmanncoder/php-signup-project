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
    if (!is_dir($target_dir)) mkdir($target_dir, 0777, true);

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

        echo "<script>alert('Registration successful! Please login.'); window.location.href='login.php';</script>";
    } catch (PDOException $e) {
        echo "<script>alert('Database Error: " . $e->getMessage() . "');</script>";
    }
}
?>
