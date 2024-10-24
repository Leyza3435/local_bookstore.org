<?php include 'db.php'; session_start(); ?>

<?php
// Load all employees and customers for the form
$employees = $conn->query("SELECT * FROM Employee");
$customers = $conn->query("SELECT * FROM Customer");

$transactionID = $_GET['id'] ?? '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customerID = $_POST['customerID'];
    $employeeID = $_POST['employeeID'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $quantity = $_POST['quantity'];

    // Update the sales transaction record
    $sql = "UPDATE SalesTransaction 
            SET CustomerID='$customerID', EmployeeID='$employeeID', Date='$date', Time='$time', Quantity='$quantity'
            WHERE TransactionID='$transactionID'";

    if ($conn->query($sql) === TRUE) {
        echo "Sales transaction updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    // Load the existing transaction details
    $transaction = $conn->query("SELECT * FROM SalesTransaction WHERE TransactionID='$transactionID'")->fetch_assoc();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Sales Transaction - Local Bookstore</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2>Update Sales Transaction ID: <?php echo $transactionID; ?></h2>
    <form method="POST" action="">
        <label>Customer:</label><br>
        <select name="customerID" required>
            <option value="">Select a customer</option>
            <?php while($row = $customers->fetch_assoc()) { ?>
                <option value="<?php echo $row['CustomerID']; ?>" <?php if ($row['CustomerID'] == $transaction['CustomerID']) echo 'selected'; ?>>
                    <?php echo $row['Name']; ?>
                </option>
            <?php } ?>
        </select><br>

        <label>Employee:</label><br>
        <select name="employeeID" required>
            <option value="">Select an employee</option>
            <?php while($row = $employees->fetch_assoc()) { ?>
                <option value="<?php echo $row['TaxpayerID']; ?>" <?php if ($row['TaxpayerID'] == $transaction['EmployeeID']) echo 'selected'; ?>>
                    <?php echo $row['Name']; ?>
                </option>
            <?php } ?>
        </select><br>

        <label>Date:</label><br>
        <input type="date" name="date" value="<?php echo $transaction['Date']; ?>" required><br>
        
        <label>Time:</label><br>
        <input type="time" name="time" value="<?php echo $transaction['Time']; ?>" required><br>

        <label>Quantity:</label><br>
        <input type="number" name="quantity" value="<?php echo $transaction['Quantity']; ?>" required><br>

        <input type="submit" value="Update Transaction">
    </form>
</body>
</html>
