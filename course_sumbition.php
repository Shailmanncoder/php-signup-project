<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f6f8fa;
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
            border-radius: 10px;
            text-align: center;
            border: 1px solid black;
        }
        input, select {
            width: 100%;
            padding: 10px;
            border: 1px solid #d1d5da;
            border-radius: 6px;
            font-size: 14px;
            margin-bottom: 15px;
            transition: border-color 0.3s ease-in-out;
            background-color: white;
        }
        input:focus, select:focus {
            border-color: rgb(6, 6, 6);
            outline: none;
            box-shadow: 0px 8px 5px rgba(10, 10, 10, 0.3);
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
            transition: background 0.3s;
            margin-top: 20px;
        }
        .btn:hover, .butn:hover {
            background-color: #22863a;
        }
    </style>
</head>
<body>
    <form id="loginForm" action="" method="POST">
        <h1>Student Details</h1>
        <input type="text" name="student" class="clear" placeholder="Enter student name" required>
        <input type="email" name="email" class="clear" placeholder="Enter your email Id" maxlength="40" required>
        <input type="password" name="password" class="clear" placeholder="Enter your password" required>
        <input type="number" name="number" class="clear" placeholder="Enter your Mobile no." required>
        <input type="date" name="date" class="clear" required>

        <!-- Dropdown for Course Selection -->
        <select name="courses" class="clear" id="courseSelect" required>
            <option value="" disabled selected hidden>Select Course</option>
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
            let inputs = document.getElementsByClassName("clear");
            for (let i = 0; i < inputs.length; i++) {
                if (inputs[i].tagName === "SELECT") {
                    inputs[i].selectedIndex = 0; // Reset dropdown to placeholder
                } else {
                    inputs[i].value = ""; // Clear input fields
                }
            }
        }
    </script>
</body>
</html>
<?php
$servername = "localhost";
$username = "root"; // Change if different
$password = ""; // Your database password
$dbname = "student_details"; // Your actual database name

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the 'courses' key exists before accessing it
    $student = $_POST["student"] ?? null;
    $email = $_POST["email"] ?? null;
    $key = $_POST["password"] ?? null;
    $number = $_POST["number"] ?? null;
    $date = $_POST["date"] ?? null;
    $courses = $_POST["courses"] ?? null;

    // If courses is still NULL, show an error
    if (!$courses) {
        echo "<script>alert('Please select a course!'); window.history.back();</script>";
        exit();
    }

    // Hash the password before storing it
    $hashed_password = password_hash($key, PASSWORD_DEFAULT);

    try {
        // Establish database connection
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare the SQL statement
        $sql = "INSERT INTO course (student, email, password, Mobile_no,date, course) 
                VALUES (:student, :email, :password, :Mobile_no, :date, :course)";

        $stmt = $conn->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':student', $student);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->bindParam(':Mobile_no', $number);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':course', $courses);

        // Execute the statement
        $stmt->execute();

        echo "<script>alert('Student details saved successfully!'); window.location.href='course_sumbition.php';</script>";
    } catch (PDOException $e) {
        echo "<script>alert('Database Error: " . $e->getMessage() . "');</script>";
    }

    $conn = null; // Close connection
}
?>
