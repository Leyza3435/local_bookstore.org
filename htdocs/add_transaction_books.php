<?php include 'db.php'; session_start(); ?>

<?php
// Check if the lastTransactionID is set in session
if (!isset($_SESSION['lastTransactionID'])) {
    echo "No transaction ID found. Please create a transaction first.";
    exit();
}

$transactionID = $_SESSION['lastTransactionID'];

// Load all books for the form
$books = $conn->query("SELECT * FROM Book");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bookISBN = $_POST['bookISBN'];

    // Insert the new record into TransactionBooks
    $sql = "INSERT INTO TransactionBooks (TransactionID, ISBN) 
            VALUES ('$transactionID', '$bookISBN')";

    if ($conn->query($sql) === TRUE) {
        echo "Book associated with transaction successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Book to Transaction - Local Bookstore</title>
    <link rel="stylesheet" type="text/css" href="books.css">
</head>
<body>
    <h2>Add Book to Transaction ID: <?php echo $transactionID; ?></h2>
    <form method="POST" action="">
        <label>Book ISBN:</label><br>
        <select name="bookISBN" required>
            <option value="">Select a book</option>
            <?php while($row = $books->fetch_assoc()) { ?>
                <option value="<?php echo $row['ISBN']; ?>"><?php echo $row['Title']; ?></option>
            <?php } ?>
        </select><br>

        <input type="submit" value="Add Book to Transaction">
    </form>
</body>
</html>
