<?php
require("connect_db.php");

$account_number = $_POST['account_number'];

$amount = $_POST['amount'];
$transaction_type = 'deposit';
$datetime = date('Y-m-d H:i:s');
$sql = "SELECT * FROM accounts WHERE account_number = '$account_number'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $sql = "UPDATE accounts SET balance = balance + ?, open_date = ? WHERE account_number = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("dss", $amount, $datetime, $account_number);
    $result = $stmt->execute();

    if ($result) {
        date_default_timezone_set('Asia/Bangkok');

        // Get the current time in 24-hour format
        $time = date('H:i:s');
        $transaction_date = date('Y-m-d H:i:s');
        $description = "เงินฝาก";
        

        $sql = "INSERT INTO transactions (account_number, transaction_date, amount, description) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssds", $account_number, $transaction_date, $amount, $description);
        $result = $stmt->execute();

        if ($result) {
            echo "Deposit successful!";
            $redirect_url = "account.php?account_number=" . urlencode($account_number);
            header("Location: $redirect_url");
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "Account not found";
}

$conn->close();
?>
