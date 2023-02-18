<?php
require("connect_db.php");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query the database
$sql = "SELECT accounts.account_number, customers.first_name, customers.last_name, accounts.balance, accounts.open_date
FROM accounts
JOIN customers ON accounts.customer_id = customers.customer_id";
$result = mysqli_query($conn, $sql);

// Display the data in a table
echo "<table>";
echo "<tr><th>Account Number</th> <th>First Name</th> <th>Last Name</th> <th>Balance</th> <th>Open Date</th> </tr>";
while ($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['account_number'] . "</td>";
    echo "<td>" . $row['first_name'] . "</td>";
    echo "<td>" . $row['last_name'] . "</td>";
    echo "<td>" . $row['balance'] . "</td>";
    echo "<td>" . $row['open_date'] . "</td>";
    echo "</tr>";
}
echo "</table>";

// Close the database connection
mysqli_close($conn);
?>
<form method="post" action="b_deposit.php" >
  <button type="submit">Deposit</button>
</form>
<form method="post" action="b_withdraw.php" >
  <button type="submit">withdraw</button>
</form>
<form method="post" action="home.php">
  <button type="submit">went back earlier</button>
</form>





