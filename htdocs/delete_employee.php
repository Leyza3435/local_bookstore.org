<?php include 'db.php'; ?>

<?php
$taxpayerID = $_GET['id'] ?? '';

if ($taxpayerID) {
    // Delete the employee
    $sql = "DELETE FROM Employee WHERE TaxpayerID='$taxpayerID'";

    if ($conn->query($sql) === TRUE) {
        echo "Employee deleted successfully";
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "Employee ID not specified.";
}
?>

<a href="view_employees.php">Back to Employees</a>
