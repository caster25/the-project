<?php
require("connect_db.php");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$account_number = $_POST['account_number'];
$withdraw_amount = $_POST['amount'];
$datetime = date('Y-m-d H:i:s');

$query = "SELECT balance FROM accounts WHERE account_number = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "s", $account_number);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);
$current_balance = $row['balance'];

if ($withdraw_amount > $current_balance) {

    echo "Error: Insufficient balance. You cannot withdraw more than your current balance.";
    echo '<button onclick="history.back()" .urlencode($account_number)>Go Back</button>' ;
    
} else {
    $sql = "UPDATE accounts SET balance = balance - $withdraw_amount, open_date = '$datetime' WHERE account_number = $account_number";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "Withdrawal successful!";
        header("Location: account.php?account_number=" . urlencode($account_number));
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>


