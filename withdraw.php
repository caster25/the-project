<?php
require("connect_db.php");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$account_number = $_POST['account_number'];
$withdraw_amount = $_POST['amount'];
$datetime = date('Y-m-d H:i:s');
$sql = "UPDATE accounts SET balance = balance - $withdraw_amount, open_date = '$datetime' WHERE account_number = $account_number";

$result = mysqli_query($conn, $sql);

if ($result) {
    echo "Deposit successful!";
    header("Location: account.php");
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
