<?php
require("connect_db.php");

$account_number = $_POST['account_number'];
$amount = $_POST['amount'];

$check_balance_sql = "SELECT balance FROM accounts WHERE account_number = '$account_number'";
$check_balance_result = $conn->query($check_balance_sql);
if ($check_balance_result->num_rows > 0) {
    $row = $check_balance_result->fetch_assoc();
    $balance = $row["balance"];
    if ($balance < $amount) {
        echo "Error: Insufficient balance in the from account.";
        exit();
    }
} else {
    echo "Error: From account not found.";
    exit();
}

$update_from_sql = "UPDATE accounts SET balance = balance - $amount WHERE account_number = '$account_number'";
if ($conn->query($update_from_sql) === TRUE) {
    $update_to_sql = "UPDATE accounts SET balance = balance + $amount WHERE account_number = '$account_number'";
    if ($conn->query($update_to_sql) === TRUE) {
        echo "Money transferred successfully.";
    } else {
        $conn->query("UPDATE accounts SET balance = balance + $amount WHERE account_number = '$account_number'");
        echo "Error: " . $conn->error;
    }
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
