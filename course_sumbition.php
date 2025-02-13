<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student details</title>
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
    <form id="loginForm"action=""method="POST">
        <h1>Student details</h1>
        <input type="text" name="student"class="clear" placeholder="Enter student name" required>
        <input type="email" name="email"class="clear" placeholder="Enter your email Id" maxlength="40" required>
        <input type="password" name="password"class="clear" placeholder="Enter your password" required>
        <input type="number" name="number"class="clear" placeholder="Enter your Mobile no." maxlength="10" required>
        <input type="date" name="date"class="clear" required>
        
        <!-- Dropdown for Course Selection -->
        <select name="fd" name="courses"class="clear" id="courseSelect" required>
            <option value="" disabled selected hidden>Select Course</option>
            <option value="PHP">HTML</option>
            <option value="JavaScript">CSS</option>
            <option value="Python">JavaScript</option>
            <option value="PHP">PHP</option>
            <option value="JavaScript">C,C++</option>
            <option value="Python">Python</option>
        </select>

        <button type="submit" class="btn">submit</button>
        <button type="button" class="butn" onclick="clearFields()">Clear</button>
    </form>

    <script>
        document.getElementById("courseSelect").addEventListener("invalid", function(event) {
            event.target.setCustomValidity("Please select a course"); // Set custom validation message
        });

        document.getElementById("courseSelect").addEventListener("input", function(event) {
            event.target.setCustomValidity(""); // Clear message when user selects a valid option
        });

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
$username = "root";
$password = "";
$dbname = "student_details";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student = $_REQUEST["student"];
    $email = $_REQUEST["email"];
    $key = $_REQUEST["password"];
    $number = $_REQUEST["number"];
    $date = $_REQUEST["date"];
    $courses = $_REQUEST["courses"];
 
 

    // Hash the password before storing it
    $hashed_password = password_hash($key, PASSWORD_DEFAULT);

    echo "Student Name: ", $student, "<br>";
    echo "Parent Name: ", $email, "<br>";
    echo "Roll No: ", $key, "<br>";
    echo "Class: ", $number, "<br>";
    echo "Section: ", $date, "<br>";
    echo "School: ", $courses, "<br>";
   

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // Set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare the SQL statement
        $sql = "INSERT INTO course (student,email, password, Mobile_no, date, course) 
                VALUES (:student,:email, :password_hash,:Mobile_no, :date, :course)";
        
        $stmt = $conn->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':student', $student);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password_hash', $hashed_password);
        $stmt->bindParam(':Mobile_no', $number);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':course', $courses);

        // Execute the statement
        $stmt->execute();

       /*  echo "New record created successfully!"; */
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    $conn = null;
}
?>