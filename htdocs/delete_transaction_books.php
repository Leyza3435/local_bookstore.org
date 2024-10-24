<?php include 'db.php'; ?>

<?php
$transactionID = $_GET['transactionID'] ?? '';
$bookISBN = $_GET['isbn'] ?? '';

if ($transactionID && $bookISBN) {
    // Delete the book from TransactionBooks
    $sql = "DELETE FROM TransactionBooks WHERE TransactionID='$transactionID' AND ISBN='$bookISBN'";

    if ($conn->query($sql) === TRUE) {
        echo "Book deleted from transaction successfully";
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "Transaction ID or Book ISBN not specified.";
}
?>

<a href="view_transaction_books.php?transactionID=<?php echo $transactionID; ?>">Back to Transaction Books</a>
