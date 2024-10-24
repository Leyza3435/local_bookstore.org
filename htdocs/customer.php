<?php include 'db.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Customer - Local Bookstore</title>
    <link rel="stylesheet" type="text/css" href="books.css">
</head>
<body>
    <header>
        <div class="image">
            <div class="menu">
    <a href="home.php">Home</a>
        <h2>Customers</h2>
    <table>
        <tr>
            <th>CustomerID</th>
            <th>name</th>
            <th>PhoneNumber</th>
            <th>Address</th>
            <th>DateOfBirth</th>
        </tr>
        <?php
        $sql = "SELECT * FROM Customer";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['CustomerID']}</td>
                        <td>{$row['Name']}</td>
                        <td>{$row['PhoneNumber']}</td>
                        <td>{$row['Address']}</td>
                        <td>{$row['DateOfBirth']}</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No Customer found</td></tr>";
        }
        ?>
    </table>
    <a href="add_customer.php">Add New Customer</a>
            </div>
        </div>
    </header>
    
</body>
</html>