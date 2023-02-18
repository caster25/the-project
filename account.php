<?php
require("connect_db.php");

$account_number = $_POST["account_number"];

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT customers.first_name, accounts.account_number, customers.last_name, accounts.balance, accounts.open_date
FROM accounts
JOIN customers ON accounts.customer_id = customers.customer_id
WHERE accounts.account_number = $account_number";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 0) {
    echo "Account not found.";
} else {
    $row = mysqli_fetch_array($result);
    $first_name = $row['first_name'];
    echo "<h2>Welcome, $first_name!</h2>";
    echo "<table>";
    echo "<tr><th>Account Number</th> <th>First Name</th> <th>Last Name</th> <th>Balance</th> <th>Open Date</th> </tr>";
    echo "<tr>";
    echo "<td>" . $row['account_number'] . "</td>";
    echo "<td>" . $row['first_name'] . "</td>";
    echo "<td>" . $row['last_name'] . "</td>";
    echo "<td>" . $row['balance'] . "</td>";
    echo "<td>" . $row['open_date'] . "</td>";
    echo "</tr>";
    echo "</table>";
}

mysqli_close($conn);
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




