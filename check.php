<?php
require("connect_db.php");

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require("connect_db.php");

    $password = $_POST['password'];
    $account_number = $_POST['account_number'];

    $sql = "SELECT * FROM customers c, accounts a WHERE c.customer_id = a.customer_id AND a.account_number = ? AND c.password = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $account_number, $password);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['customer_id'] = $row['customer_id'];
        header("Location: account.php?account_number=" . urlencode($account_number));
        exit();
    } else {
        echo "Invalid username or password.";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}

?>

