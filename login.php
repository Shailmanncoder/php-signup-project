<?php
session_start();

// Database Connection
$servername = "localhost";
$username = "root";
$password = ""; // Database password (leave empty if no password)
$dbname = "student_details";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $passwordInput = trim($_POST["password"]);

    try {
        // Create PDO Connection
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Fetch user from database
        $stmt = $conn->prepare("SELECT * FROM course WHERE email = :email");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
       
        // Debugging: Uncomment to check data
        // var_dump($user); exit();

        // Check if user exists and verify hashed password
        if ($user && password_verify($passwordInput, $user["password"])) {
            $_SESSION["user"] = $user["email"]; // Corrected missing semicolon
            echo "<script>alert('Login successful!'); window.location.href='band.php';</script>";
            exit();
        } else {
            echo "<script>alert('Invalid email or password!'); window.history.back();</script>";
        }
    } catch (PDOException $e) {
        echo "<script>alert('Database Error: " . addslashes($e->getMessage()) . "');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
        input:focus{
            border-color: #1877f2;
            outline: none;
            box-shadow: 0px 0px 8px rgba(24, 119, 242, 0.3);
        }
        .btn, .butn {
            width: 48%;
            background-color:rgb(12, 107, 231);
            color: white;
            padding: 10px;
            font-size: 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            margin-top: 20px;
        }
        .btn:hover, .butn:hover {
            background-color:rgb(53, 130, 245); 
        }
    </style>
</head>
<body>
    <form action="" method="post">
        <h1>Login</h1>
        <input type="email" name="email" placeholder="Enter your email" required>
        <input type="password" name="password" placeholder="Enter your Password"required>
        <button type="submit"class ="btn">Login</button>
    </form>
</body>
</html>
