
<?php
session_start();

if (isset($_SESSION['customer_id'])) {
    require("connect_db.php");

    if (isset($_GET['account_number'])) {
        $account_number = $_GET['account_number'];
        $query = "SELECT * FROM accounts WHERE account_number = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "s", $account_number);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);

        if ($row) {
            $balance = $row['balance'];

            echo "<h1>Account Summary</h1>";
            echo "<p>Account number: " . $account_number . "</p>";
            echo "<p>Current balance: $" . number_format($balance, 2) . "</p>";
        } else {
            echo "<p>Invalid account number.</p>";
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "<p>No account number specified.</p>";
    }

    $query = "SELECT * FROM customers WHERE customer_id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $_SESSION['customer_id']);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    $first_name = $row['first_name'];
    $last_name = $row['last_name'];

    echo "<h2>Customer Information</h2>";
    echo "<p>Name: " . $first_name . " " . $last_name . "</p>";
    
    // Display the latest time
    echo "<p>Latest time: " . date('Y-m-d H:i:s') . "</p>";

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    header("Location: customer_info.php");
    exit();
}
?>

<form method="post" action="b_deposit.php" >
  <button type="submit">Deposit</button>
</form>
<form method="post" action="b_withdraw.php" >
  <button type="submit">withdraw</button>
</form>
<form method="post" action="b_transfer.php">
 <button type="submit">transfer money</button>
</form>
<form method="post" action="home.php">
  <button type="submit">went back earlier</button>
</form>




