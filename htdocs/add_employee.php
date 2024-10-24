<?php include 'db.php'; ?>

<?php
// Function to generate a unique TaxpayerID
function generateTaxpayerID($conn) {
    do {
        $taxpayerID = str_pad(rand(1, 1000000), 15, '0', STR_PAD_LEFT); // Generate a 15-digit ID
        // Check if this ID already exists
        $result = $conn->query("SELECT TaxpayerID FROM Employee WHERE TaxpayerID = '$taxpayerID'");
    } while ($result->num_rows > 0);
    return $taxpayerID;
}

// Auto-generate TaxpayerID when the page loads
$autoTaxpayerID = generateTaxpayerID($conn);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $taxpayerID = $_POST['taxpayerID'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $dateOfBirth = $_POST['dob'];
    $pseudonym = $_POST['pseudonym'];

    // Insert the new employee record
    $sql = "INSERT INTO Employee (TaxpayerID, Name, Address, DateOfBirth, Pseudonym) 
            VALUES ('$taxpayerID', '$name', '$address', '$dateOfBirth', '$pseudonym')";

    if ($conn->query($sql) === TRUE) {
        echo "New employee added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Employee - Local Bookstore</title>
    <link rel="stylesheet" type="text/css" href="books.css">
</head>
<body>
    <h2>Add New Employee</h2>
    <button><a href="home.php">Home</a></button>
    <button><a href="employee.php">Back</a></button>
    <form method="POST" action="">
        <label>Taxpayer ID (Auto-generated):</label><br>
        <input type="text" name="taxpayerID" value="<?php echo $autoTaxpayerID; ?>" readonly><br>
        <label>FullName:</label><br>
        <input type="text" name="name" required><br>
        <label>Address:</label><br>
        <input type="text" name="address" required><br>
        <label>Date of Birth:</label><br>
        <input type="date" name="dob" required><br>
        <label>Pseudonym:</label><br>
        <input type="text" name="pseudonym" required><br>
        <input type="submit" value="Add Employee">
    </form>
</body>
</html>
