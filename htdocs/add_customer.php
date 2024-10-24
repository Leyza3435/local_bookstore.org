<?php include 'db.php'; ?>

<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customerID = $_POST['customerID'];
    $name = $_POST['name'];
    $phoneNumber = $_POST['phone'];
    $address = $_POST['address'];
    $dateOfBirth = $_POST['dob'];

    // Check if CustomerID is 11 digits
    if (strlen($customerID) === 11) {
        $sql = "INSERT INTO Customer (CustomerID, Name, PhoneNumber, Address, DateOfBirth) VALUES ('$customerID', '$name', '$phoneNumber', '$address', '$dateOfBirth')";

        if ($conn->query($sql) === TRUE) {
            echo "New customer added successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error: CustomerID must be 11 digits.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Customer - Local Bookstore</title>
    <link rel="stylesheet" type="text/css" href="books.css">
</head>
<body>
    <h2>Add New Customer</h2>
    <button><a href="home.php">Home</a></button>
    <button><a href="customer.php">Back</a></button>
    <form method="POST" action="">


        <label>Name:</label><br>
        <input type="text" name="name" required><br>
        <label>Phone Number:</label><br>
        <input type="text" name="phone" required><br>
        <label>Address:</label><br>
        <input type="text" name="address" required><br>
        <label>Date of Birth:</label><br>
        <input type="date" name="dob" required><br>
        <input type="submit" value="Add Customer">
    </form>
</body>
</html>
