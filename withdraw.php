<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
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
			background-color: rgb(0, 205, 255);
		}
		button[type=onclick] {
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
		button[type=onclick]:hover {
			background-color: rgb(0, 205, 255);
		}
	</style>
</head>
<body>
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

// Check if the account exists
$sql = "SELECT * FROM accounts WHERE account_number = $account_number";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // Update the account balance
    $sql = "UPDATE accounts SET balance = balance - $amount, open_date = '$datetime' WHERE account_number = $account_number";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $transaction_date = date('Y-m-d H:i:s');
        $description = "Withdraw";

        $sql = "INSERT INTO transactions (account_number, transaction_date, amount, description)
                VALUES ('$account_number', '$transaction_date', '$amount', '$description')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo "Deposit successful!";
            $redirect_url = "account.php?account_number=" . urlencode($account_number);
            header("Location: $redirect_url");
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
</body>
</html>


