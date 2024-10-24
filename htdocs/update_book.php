<?php include 'db.php'; ?>

<?php
$bookISBN = $_GET['isbn'] ?? '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $year = $_POST['year'];
    $publisher = $_POST['publisher'];

    // Update the book record
    $sql = "UPDATE Book SET Title='$title', Year='$year', Publisher='$publisher' WHERE ISBN='$bookISBN'";

    if ($conn->query($sql) === TRUE) {
        echo "Book updated successfully";
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    // Load the existing book details
    $book = $conn->query("SELECT * FROM Book WHERE ISBN='$bookISBN'")->fetch_assoc();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Book - Local Bookstore</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2>Update Book ISBN: <?php echo $bookISBN; ?></h2>
    <form method="POST" action="">
        <label>Title:</label><br>
        <input type="text" name="title" value="<?php echo $book['Title']; ?>" required><br>

        <label>Year:</label><br>
        <input type="number" name="year" value="<?php echo $book['Year']; ?>" required><br>

        <label>Publisher:</label><br>
        <input type="text" name="publisher" value="<?php echo $book['Publisher']; ?>" required><br>

        <input type="submit" value="Update Book">
    </form>
</body>
</html>
