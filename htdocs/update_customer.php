<?php include 'db.php'; ?>

<?php
$customerID = $_GET['id'] ?? '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $phoneNumber = $_POST['phoneNumber'];
    $address = $_POST['address'];
    $dateOfBirth = $_POST['dateOfBirth'];

    // Update the customer record
    $sql = "UPDATE Customer SET Name='$name', PhoneNumber='$phoneNumber', Address='$address', DateOfBirth='$dateOfBirth' WHERE CustomerID='$customerID'";

    if ($conn->query($sql) === TRUE) {
        echo "Customer updated successfully";
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    // Load the existing customer details
    $customer = $conn->query("SELECT * FROM Customer WHERE CustomerID='$customerID'")->fetch_assoc();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Customer - Local Bookstore</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2>Update Customer ID: <?php echo $customerID; ?></h2>
    <form method="POST" action="">
        <label>Name:</label><br>
        <input type="text" name="name" value="<?php echo $customer['Name']; ?>" required><br>

        <label>Phone Number:</label><br>
        <input type="text" name="phoneNumber" value="<?php echo $customer['PhoneNumber']; ?>" required><br>

        <label>Address:</label><br>
        <input type="text" name="address" value="<?php echo $customer['Address']; ?>" required><br>

        <label>Date of Birth:</label><br>
        <input type="date" name="dateOfBirth" value="<?php echo $customer['DateOfBirth']; ?>" required><br>

        <input type="submit" value="Update Customer">
    </form>
</body>
</html>
