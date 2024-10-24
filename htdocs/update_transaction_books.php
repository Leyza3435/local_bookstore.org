<?php include 'db.php'; session_start(); ?>

<?php
$transactionID = $_GET['id'] ?? '';
$bookISBN = $_GET['isbn'] ?? '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bookISBN = $_POST['bookISBN'];

    // Update the record in TransactionBooks
    $sql = "UPDATE TransactionBooks 
            SET ISBN='$bookISBN' 
            WHERE TransactionID='$transactionID' AND ISBN='$bookISBN'";

    if ($conn->query($sql) === TRUE) {
        echo "Book updated in the transaction successfully";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Load all books for the form
$books = $conn->query("SELECT * FROM Book");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Book in Transaction - Local Bookstore</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2>Update Book in Transaction ID: <?php echo $transactionID; ?></h2>
    <form method="POST" action="">
        <label>Book ISBN:</label><br>
        <select name="bookISBN" required>
            <option value="">Select a book</option>
            <?php while($row = $books->fetch_assoc()) { ?>
                <option value="<?php echo $row['ISBN']; ?>"><?php echo $row['Title']; ?></option>
            <?php } ?>
        </select><br>

        <input type="submit" value="Update Book">
    </form>
</body>
</html>
