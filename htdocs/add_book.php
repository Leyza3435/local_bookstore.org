<?php include 'db.php'; ?>

<?php
// Function to generate an ISBN
function generateISBN() {
    $isbnBase = str_pad(rand(0, 999999999999), 12, '0', STR_PAD_LEFT);
    $checkDigit = calculateISBNCheckDigit($isbnBase);
    return $isbnBase . $checkDigit;
}

// Function to calculate the check digit for ISBN-13
function calculateISBNCheckDigit($isbnBase) {
    $sum = 0;
    for ($i = 0; $i < 12; $i++) {
        $digit = intval($isbnBase[$i]);
        $sum += ($i % 2 === 0) ? $digit : $digit * 3;
    }
    $remainder = $sum % 10;
    return ($remainder === 0) ? 0 : 10 - $remainder;
}

// Auto-generate an ISBN when the page loads
$autoISBN = generateISBN();

// Fetch employees for the dropdown
$employeeResult = $conn->query("SELECT TaxpayerID, Name FROM Employee");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $isbn = $_POST['isbn'];
    $title = $_POST['title'];
    $year = $_POST['year'];
    $employeeId = $_POST['employee'];

    // Get the employee's name to use as the publisher
    $employeeQuery = $conn->query("SELECT Name FROM Employee WHERE TaxpayerID = '$employeeId'");
    $employeeRow = $employeeQuery->fetch_assoc();
    $publisher = $employeeRow['Name'];

    if (strlen($isbn) === 13) {
        $sql = "INSERT INTO Book (ISBN, Title, Year, Publisher) VALUES ('$isbn', '$title', '$year', '$publisher')";

        if ($conn->query($sql) === TRUE) {
            echo "New book added successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error: ISBN must be 13 digits.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Book - Local Bookstore</title>
    <link rel="stylesheet" type="text/css" href="books.css">
</head>
<body>
    <h2>Add New Book</h2>
    <button><a href="home.php">Home</a></button>
    <button><a href="books.php">Back</a></button>
    <form method="POST" action="">
        <label>ISBN (Auto-generated):</label><br>
        <input type="text" name="isbn" value="<?php echo $autoISBN; ?>" readonly><br>
        <label>Title:</label><br>
        <input type="text" name="title" required><br>
        <label>Year:</label><br>
        <input type="number" name="year" required><br>
        <label>Author (Employee):</label><br>
        <select name="employee" required>
            <?php
            if ($employeeResult->num_rows > 0) {
                while($row = $employeeResult->fetch_assoc()) {
                    echo "<option value='{$row['TaxpayerID']}'>{$row['Name']}</option>";
                }
            }
            ?>
        </select><br>
        <input type="submit" value="Add Book">
    </form>
</body>
</html>
