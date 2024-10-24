<?php include 'db.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Employees - Local Bookstore</title>
    <link rel="stylesheet" type="text/css" href="books.css">
</head>
<body>
    <header>
        <div class="image">
            <div class="menu">
    <a href="home.php">Home</a>
        <h2>Employees</h2>
    <table>
        <tr>
            <th>TaxpayerID</th>
            <th>Name</th>
            <th>Address</th>
            <th>DateOfBirth</th>
            <th>Pseudonym</th>
        </tr>
        <?php
        $sql = "SELECT * FROM Employee";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['TaxpayerID']}</td>
                        <td>{$row['Name']}</td>
                        <td>{$row['Address']}</td>
                        <td>{$row['DateOfBirth']}</td>
                        <td>{$row['Pseudonym']}</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No Employee found</td></tr>";
        }
        ?>
    </table>
    <a href="add_employee.php">Add New Employee</a>
            </div>
        </div>
    </header>
    
</body>
</html>