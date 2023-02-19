<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<style>
    button[type=onclick] {
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
      margin-top: 20px;
    }

		body {
			background-color: #F7F7F7;
			font-family: Arial, sans-serif;
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
		input[type=onclick] {
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
		input[type=onclick]:hover {
			background-color: #3E8E41;
		}
		button[type=onclick] {
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
		button[type=onclick]:hover {
			background-color: #3E8E41;
		}
	</style>
</head>
<body>
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

    echo "<h1>Error: Insufficient balance. You cannot withdraw more than your current balance.</h1>";
    echo '<h2><button onclick="history.back()" .urlencode($account_number)>Go Back</button><h2>' ;
    
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
</body>
</html>


