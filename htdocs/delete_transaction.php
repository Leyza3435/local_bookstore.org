<?php include 'db.php'; ?>

<?php
$transactionID = $_GET['id'] ?? '';

if ($transactionID) {
    // Delete the sales transaction
    $sql = "DELETE FROM SalesTransaction WHERE TransactionID='$transactionID'";

    if ($conn->query($sql) === TRUE) {
        echo "Sales transaction deleted successfully";
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "Transaction ID not specified.";
}
?>

<a href="view_transactions.php">Back to Transactions</a>
