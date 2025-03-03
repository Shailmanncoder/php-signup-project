<?php
$servername = "localhost"; // Change if needed
$username = "root"; // Your database username (default: root)
$password = ""; // Your database password (default: empty for XAMPP)
$database = "popup-details"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle DELETE Request
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM ticket WHERE S_no=$id";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Ticket Deleted Successfully'); window.location.href='manage_tickets.php';</script>";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Handle UPDATE Request
if (isset($_POST['update_ticket'])) {
    $id = $_POST['id'];
    $person = $_POST['person'];
    $email = $_POST['email'];
    $country = $_POST['country'];

    $sql = "UPDATE ticket SET person='$person', email='$email', country='$country' WHERE S_no=$id";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Ticket Updated Successfully'); window.location.href='manage_tickets.php';</script>";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Fetch all tickets
$sql = "SELECT * FROM ticket";
$result = $conn->query($sql);

// Fetch ticket for editing
$edit_ticket = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $sql_edit = "SELECT * FROM ticket WHERE S_no=$id";
    $edit_result = $conn->query($sql_edit);
    $edit_ticket = $edit_result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Tickets</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <h2 class="text-center">Manage Ticket Bookings</h2>

        <!-- Show Edit Form Only When Editing -->
        <?php if ($edit_ticket): ?>
            <h3>Edit Ticket</h3>
            <form method="POST">
                <input type="hidden" name="id" value="<?php echo $edit_ticket['S_no']; ?>">
                <div class="form-group">
                    <label>Number of Persons:</label>
                    <input type="number" name="person" class="form-control" value="<?php echo $edit_ticket['person']; ?>" required>
                </div>
                <div class="form-group">
                    <label>Email:</label>
                    <input type="email" name="email" class="form-control" value="<?php echo $edit_ticket['email']; ?>" required>
                </div>
                <div class="form-group">
                    <label>Country:</label>
                    <select name="country" class="form-control" required>
                        <option value="Paris" <?php if ($edit_ticket['country'] == "Paris") echo "selected"; ?>>Paris</option>
                        <option value="New york" <?php if ($edit_ticket['country'] == "New york") echo "selected"; ?>>New york</option>
                        <option value="San Francisco" <?php if ($edit_ticket['country'] == "San Francisco") echo "selected"; ?>>San Francisco</option>
                    </select>
                </div>
                <button type="submit" name="update_ticket" class="btn btn-success">Update Ticket</button>
                <a href="manage_tickets.php" class="btn btn-default">Cancel</a>
            </form>
        <?php endif; ?>

        <hr>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>S_no</th>
                    <th>Person</th>
                    <th>Email</th>
                    <th>Country</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['S_no']; ?></td>
                            <td><?php echo $row['person']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['country']; ?></td>
                            <td>
                                <a href="manage_tickets.php?edit=<?php echo $row['S_no']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="manage_tickets.php?delete=<?php echo $row['S_no']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan='5' class='text-center'>No Tickets Found</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
$conn->close();
?>
