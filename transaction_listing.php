<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction</title>
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Kanit">	
			
	<style>
		body {
			background-color: rgb(225, 255, 255);
			font-family: Kanit;
			padding: 20px;
		}
		h1 {
			color: #333333;
			margin-bottom: 20px;
			text-align: center;
		}
    	h2 {
			color: #333333;
			margin-bottom: 20px;
			text-align: center;
		}
		form {
			background-color: #FFFFFF;
			border: 1px solid #CCCCCC;
			border-radius: 5px;
			padding: 20px;
			width: 400px;
			margin: 0 auto;
		}
		label {
			display: block;
			margin-bottom: 10px;
		}
		input[type=text],
		input[type=password] {
			border: 1px solid #CCCCCC;
			border-radius: 3px;
			padding: 8px;
			width: 100%;
			box-sizing: border-box;
			font-size: 14px;
			margin-bottom: 20px;
		}
		input[type=submit] {
			background-color: #4CAF50;
			border: none;
			color: #FFFFFF;
			padding: 10px 16px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			font-size: 16px;
			border-radius: 5px;
			cursor: pointer;
		}
		input[type=submit]:hover {
			background-color: #3E8E41;
		}
		button[type=submit] {
			background-color: rgb(0, 205, 255);
			border: none;
			color: #FFFFFF;
			padding: 10px 16px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			font-size: 16px;
			border-radius: 5px;
			cursor: pointer;
		}
		button[type=submit]:hover {
			background-color: rgb(0, 255, 205);
		}
	</style>
</head>
<body>
    
<form>
<?php
require("connect_db.php");

$account_number = $_POST['account_number'];

$sql = "SELECT * FROM transactions WHERE account_number = '$account_number' ORDER BY transaction_date DESC";
$result = $conn->query($sql);

if($result->num_rows > 0){
    echo "<h1>Transaction Listing for Account #$account_number</h1>";
    echo "<table>";
    echo "<tr><th>Date</th><th>Description</th><th>Amount</th></tr>";

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

<form method="post" action="account.php">
    <input type="hidden" name="account_number" value="<?php echo htmlspecialchars($account_number); ?>">
    <input type="hidden" name="customer_id" value="<?php echo htmlspecialchars($customer_id); ?>">
    <button onclick="goBack()" style="background-color: white; color: black; float: right;">Go Back</button>


    <script>
    function goBack() {
        window.history.back();
    }
    </script>
</form>
</body>
</html>