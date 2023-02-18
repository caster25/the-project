<?php
require("connect_db.php");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get the form data
$account_number = $_POST['account_number'];
$deposit_amount = $_POST['amount'];
$datetime = date('Y-m-d H:i:s');
// Construct the SQL query to update the balance in the accounts table
$sql = "UPDATE accounts SET balance = balance + $deposit_amount, open_date = '$datetime' WHERE account_number = $account_number";

// Execute the query
$result = mysqli_query($conn, $sql);

// Check if the query was successful
if ($result) {
    echo "Deposit successful!";
    header("Location: account.php");
} else {
    echo "Error: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>
