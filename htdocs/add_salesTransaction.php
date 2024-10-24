<?php include 'db.php'; session_start(); ?>

<?php
// Function to generate a unique TransactionID
function generateTransactionID($conn) {
    do {
        $transactionID = str_pad(rand(0, 99999999999), 11, '0', STR_PAD_LEFT); // Generates a unique transaction ID
        // Check if this ID already exists
        $result = $conn->query("SELECT TransactionID FROM SalesTransaction WHERE TransactionID = '$transactionID'");
    } while ($result->num_rows > 0);
    return $transactionID;
}

// Auto-generate TransactionID when the page loads
$autoTransactionID = generateTransactionID($conn);

// Load employees and customers for the form
$employees = $conn->query("SELECT * FROM Employee");
$customers = $conn->query("SELECT * FROM Customer");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customerID = intval($_POST['customerID']);
    $employeeID = $conn->real_escape_string($_POST['employeeID']);
    $date = $conn->real_escape_string($_POST['date']);
    $time = $conn->real_escape_string($_POST['time']);
    $quantity = intval($_POST['quantity']);

    // Insert into SalesTransaction without specifying TransactionID
    $sql = "INSERT INTO SalesTransaction (CustomerID, EmployeeID, Date, Time, Quantity) 
            VALUES ($customerID, '$employeeID', '$date', '$time', $quantity)";

    if ($conn->query($sql) === TRUE) {
        // Retrieve the auto-generated TransactionID
        $transactionID = $conn->insert_id;
        $_SESSION['lastTransactionID'] = $transactionID;
        
        // Redirect to the add transaction books page
        header("Location: add_transaction_books.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Sales Transaction - Local Bookstore</title>
    <link rel="stylesheet" type="text/css" href="books.css">
</head>
<body>
    <h2>Add New Sales Transaction</h2>
    <button><a href="home.php">Home</a></button>
    <button><a href="salesTransaction.php">Back</a></button>
    <form method="POST" action="">
        <label>Transaction ID (Auto-generated):</label><br>
        <input type="text" name="transactionID" value="<?php echo $autoTransactionID; ?>" readonly><br>
        
        <label>Customer:</label><br>
        <select name="customerID" required>
            <option value="">Select a customer</option>
            <?php while($row = $customers->fetch_assoc()) { ?>
                <option value="<?php echo $row['CustomerID']; ?>"><?php echo $row['Name']; ?></option>
            <?php } ?>
        </select><br>

        <label>Employee:</label><br>
        <select name="employeeID" required>
            <option value="">Select an employee</option>
            <?php while($row = $employees->fetch_assoc()) { ?>
                <option value="<?php echo $row['TaxpayerID']; ?>"><?php echo $row['Name']; ?></option>
            <?php } ?>
        </select><br>

        <label>Date:</label><br>
        <input type="date" name="date" required><br>
        
        <label>Time:</label><br>
        <input type="time" name="time" required><br>

        <label>Quantity:</label><br>
        <input type="number" name="quantity" required><br>

        <input type="submit" value="Add Transaction">
    </form>
</body>
</html>