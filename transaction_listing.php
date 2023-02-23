<?php
require("connect_db.php");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$account_number = $_POST['account_number'];
include 'account.php';


// Query the transactions table for the given account number
$sql = "SELECT * FROM transactions WHERE account_number = $account_number ORDER BY transaction_date DESC";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "<h1>Transaction Listing for Account #$account_number</h1>";
    echo "<table>";
    echo "<tr><th>Date</th><th>Description</th><th>Amount</th></tr>";

    // Loop through each transaction record and display them in a table format
    while ($row = mysqli_fetch_assoc($result)) {
        $transaction_date = date('m/d/Y h:i A', strtotime($row['transaction_date']));
        $description = $row['description'];
        $amount = number_format($row['amount'], 2);

        echo "<tr>";
        echo "<td>$transaction_date</td>";
        echo "<td>$description</td>";
        echo "<td>$amount</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No transactions found for Account #$account_number";
}

mysqli_close($conn);
?>
