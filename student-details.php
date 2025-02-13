<?php
echo "<table border='1' style='border-collapse: collapse; width: 50%; text-align: left;'>";
echo "<tr><th>S_no.</th><th>student</th><th>parent</th><th>roll no.</th><th>school</th><th>class</th><th>section</th><th>email</th></tr>";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student_detail";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT* FROM student_details");
    $stmt->execute();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>{$row['S_no.']}</td>";
        echo "<td>{$row['student']}</td>";
        echo "<td>{$row['parent']}</td>";
        echo "<td>{$row['rollno']}</td>";
        echo "<td>{$row['class']}</td>";
        echo "<td>{$row['section']}</td>";
        echo "<td>{$row['school']}</td>";
        echo "<td>{$row['email']}</td>";
        echo "</tr>";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
echo "</table>";
?>