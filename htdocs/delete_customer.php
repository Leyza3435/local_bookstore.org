<?php include 'db.php'; ?>

<?php
$customerID = $_GET['id'] ?? '';

if ($customerID) {
    // Delete the customer
    $sql = "DELETE FROM Customer WHERE CustomerID='$customerID'";

    if ($conn->query($sql) === TRUE) {
        echo "Customer deleted successfully";
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "Customer ID not specified.";
}
?>

<a href="view_customers.php">Back to Customers</a>
