<?php include 'db.php'; ?>

<?php
$taxpayerID = $_GET['id'] ?? '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $dateOfBirth = $_POST['dateOfBirth'];
    $pseudonym = $_POST['pseudonym'];

    // Update the employee record
    $sql = "UPDATE Employee SET Name='$name', Address='$address', DateOfBirth='$dateOfBirth', Pseudonym='$pseudonym' WHERE TaxpayerID='$taxpayerID'";

    if ($conn->query($sql) === TRUE) {
        echo "Employee updated successfully";
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    // Load the existing employee details
    $employee = $conn->query("SELECT * FROM Employee WHERE TaxpayerID='$taxpayerID'")->fetch_assoc();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Employee - Local Bookstore</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2>Update Employee ID: <?php echo $taxpayerID; ?></h2>
    <form method="POST" action="">
        <label>Name:</label><br>
        <input type="text" name="name" value="<?php echo $employee['Name']; ?>" required><br>

        <label>Address:</label><br>
        <input type="text" name="address" value="<?php echo $employee['Address']; ?>" required><br>

        <label>Date of Birth:</label><br>
        <input type="date" name="dateOfBirth" value="<?php echo $employee['DateOfBirth']; ?>" required><br>

        <label>Pseudonym:</label><br>
        <input type="text" name="pseudonym" value="<?php echo $employee['Pseudonym']; ?>" required><br>

        <input type="submit" value="Update Employee">
    </form>
</body>
</html>
