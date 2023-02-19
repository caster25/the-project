<?php
// Start the session
session_start();


// Get the account number from the query string
if (!isset($_GET['account_number'])) {
    header("Location: account.php");
    exit();
}
$account_number = $_GET['account_number'];

// Connect to the database
require("connect_db.php");

// Get the customer information for the given account number
$sql = "SELECT * FROM customers c, accounts a WHERE c.customer_id = a.customer_id AND a.account_number = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $account_number);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);

// Check if the customer ID in the session matches the customer ID in the database
if ($row['customer_id'] !== $_SESSION['customer_id']) {
    header("Location: account.php");
    exit();
}

// Display the customer information
echo "<h1>Customer Information</h1>";
echo "<table>
    <tr>
        <td>Customer ID:</td>
        <td>{$row['customer_id']}</td>
    </tr>
    <tr>
        <td>First Name:</td>
        <td>{$row['first_name']}</td>
    </tr>
    <tr>
        <td>Last Name:</td>
        <td>{$row['last_name']}</td>
    </tr>
    <tr>
        <td>Address:</td>
        <td>{$row['address']}</td>
    </tr>
    <tr>
        <td>Phone Number:</td>
        <td>{$row['phone_number']}</td>
    </tr>
    <tr>
        <td>Email:</td>
        <td>{$row['email']}</td>
    </tr>
</table>";

// Close the database connection
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
