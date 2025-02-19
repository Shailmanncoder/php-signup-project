<?php
echo "<table border='1' style='border-collapse: collapse; width: 50%; text-align: left;'>";
echo "<tr><th>S_no</th><th>Student</th><th>Email</th><th>Password</th><th>Mobile No.</th><th>Date</th><th>Course</th></tr>";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student_details";

try {
    // Establish database connection
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare and execute the SQL query
    $stmt = $conn->prepare("SELECT * FROM course");
    $stmt->execute(); // Missing execution in original code

    // Fetch data and display it in a table
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>{$row['S_no.']}</td>";  // Removed the period in column name
        echo "<td>{$row['student']}</td>";
        echo "<td>{$row['email']}</td>";
        echo "<td>{$row['password']}</td>";
        echo "<td>{$row['Mobile_no']}</td>";
        echo "<td>{$row['date']}</td>";
        echo "<td>{$row['course']}</td>";
        echo "</tr>";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Close connection
$conn = null;
echo "</table>";
?>
