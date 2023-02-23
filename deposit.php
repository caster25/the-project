<?php
require("connect_db.php");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
session_start();

if (!isset($_SESSION['account_number'])) {
    // Redirect to login page or display an error message
    exit("Error: Account number not found in session.");
}

$account_number = $_SESSION['account_number'];
$amount = $_POST['amount'];
$transaction_type = 'deposit';
$datetime = date('Y-m-d H:i:s');



// Prepare a SELECT query to check if the account number exists
$sql = "SELECT * FROM accounts WHERE account_number = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $account_number);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) > 0) {
    // Prepare an UPDATE query to update the balance and open date of the account
    $sql = "UPDATE accounts SET balance = balance + ?, open_date = ? WHERE account_number = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "dss", $amount, $datetime, $account_number);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        $transaction_date = date('Y-m-d H:i:s');
        $description = "Deposit";

        // Prepare an INSERT query to insert a new transaction record
        $sql = "INSERT INTO transactions (account_number, transaction_date, amount, description) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssds", $account_number, $transaction_date, $amount, $description);
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            echo "Deposit successful!";
            $redirect_url = "account.php?account_number=" . urlencode($account_number);
            header("Location: $redirect_url");
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "Account not found";
}

mysqli_close($conn);
?>

