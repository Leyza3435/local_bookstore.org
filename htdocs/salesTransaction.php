<?php include 'db.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>SalesTransaction - Local Bookstore</title>
    <link rel="stylesheet" type="text/css" href="books.css">
</head>
<body>
    <header>
        <div class="image">
            <div class="menu">
    <a href="home.php">Home</a>
        <h2>SalesTransaction</h2>
    <table>
        <tr>
            <th>TransactionID</th>
            <th>CustomerID</th>
            <th>EmployeeID</th>
            <th>Date</th>
            <th>Time</th>
            <th>Quantity</th>
        </tr>
        <?php
        $sql = "SELECT * FROM SalesTransaction";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['TransactionID']}</td>
                        <td>{$row['CustomerID']}</td>
                        <td>{$row['EmployeeID']}</td>
                        <td>{$row['Date']}</td>
                        <td>{$row['Time']}</td>
                        <td>{$row['Quantity']}</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No Transaction found</td></tr>";
        }
        ?>
    </table>
    <a href="add_salesTransaction.php">Add New Sales Transaction</a>
    <a href="add_transaction_books.php">See Transaction Books</a>
            </div>
        </div>
    </header>
    
</body>
</html>