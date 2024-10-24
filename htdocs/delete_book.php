<?php include 'db.php'; ?>

<?php
$bookISBN = $_GET['isbn'] ?? '';

if ($bookISBN) {
    // Delete the book
    $sql = "DELETE FROM Book WHERE ISBN='$bookISBN'";

    if ($conn->query($sql) === TRUE) {
        echo "Book deleted successfully";
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "Book ISBN not specified.";
}
?>

<a href="view_books.php">Back to Books</a>
