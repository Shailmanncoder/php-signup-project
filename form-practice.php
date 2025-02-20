<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
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

        
        .form {
            background: white;
            padding: 25px;
            width: 350px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        
    
        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #d1d5da;
            border-radius: 6px;
            font-size: 14px;
            margin-bottom: 15px;
            transition: border-color 0.3s ease-in-out;
        }

        input:focus {
            border-color:rgb(8, 8, 8);
            outline: none;
            box-shadow: 5px 10px 5px rgba(12, 12, 12, 0.3);
        }

       
        
        .btn {
            width: 100%;
            background-color: #2ea44f;
            color: white;
            padding: 10px;
            font-size: 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn:hover {
            background-color: #22863a;
        }

        /* Footer Links */
        .form-footer {
            font-size: 12px;
            margin-top: 15px;
            color: #586069;
        }

        .form-footer a {
            color: #0366d6;
            text-decoration: none;
        }

        .form-footer a:hover {
            text-decoration: underline;
        }
        .btn {
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
    margin-right: 10px;
}

.butn {
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
.butn:hover{
    background-color:#22863a;
}

    </style>
</head>
<body>
    <form action="" method="post"class="form">
    <h1>Signup</h1> 
        <input type="text"placeholder="Enter student name " name="student"required>
        <input type="text"placeholder="Enter Parents name " name="parents"required>
        <input type="number"placeholder="Enter your Roll no. " name="rollno"required>
        <input type="text"placeholder="Enter your Class  " name="class"required>
        <input type="text"placeholder="Enter your Section" name="section"required>
        <input type="text"placeholder="Enter your School" name="school"required>
        <input type="email"placeholder="Enter your email id" name="email"required>
        <input type="number"placeholder="Enter your Mobile no." name="mobile-number"required>
        <input type="password"placeholder="Enter your Password " name="password"required>
        <button type="submit" class="btn">Login</button><button type="submit" class="butn">Clear</button> 
       
    </form>
    <div class="container">
    <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student_detail";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student = $_REQUEST["student"];
    $parents = $_REQUEST["parents"];
    $rollno = $_REQUEST["rollno"];
    $class = $_REQUEST["class"];
    $section = $_REQUEST["section"];
    $school = $_REQUEST["school"];
    $email = $_REQUEST["email"];
    $mobilenumber = $_REQUEST["mobile-number"];
    $password_plain = $_REQUEST["password"];

    // Hash the password before storing it
    $hashed_password = password_hash($password_plain, PASSWORD_DEFAULT);

    echo "Student Name: ", $student, "<br>";
    echo "Parent Name: ", $parents, "<br>";
    echo "Roll No: ", $rollno, "<br>";
    echo "Class: ", $class, "<br>";
    echo "Section: ", $section, "<br>";
    echo "School: ", $school, "<br>";
    echo "Email: ", $email, "<br>";
    echo "Mobile No: ", $mobilenumber, "<br>";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // Set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare the SQL statement
        $sql = "INSERT INTO student_details (student, parent, rollno, class, section, school, email, mobilenumber, password_hash) 
                VALUES (:student, :parent, :rollno, :class, :section, :school, :email, :mobilenumber, :password_hash)";
        
        $stmt = $conn->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':student', $student);
        $stmt->bindParam(':parent', $parents);
        $stmt->bindParam(':rollno', $rollno);
        $stmt->bindParam(':class', $class);
        $stmt->bindParam(':section', $section);
        $stmt->bindParam(':school', $school);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':mobilenumber', $mobilenumber);
        $stmt->bindParam(':password_hash', $hashed_password);

        // Execute the statement
        $stmt->execute();

        echo "New record created successfully!";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    $conn = null;
}
?>

 </div>
</body>
</html>
