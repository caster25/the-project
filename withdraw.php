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
    echo "<h1>ข้อผิดพลาด: ยอดเงินคงเหลือไม่เพียงพอ คุณไม่สามารถถอนเงินได้มากกว่ายอดเงินปัจจุบันของคุณ</h1>";
    echo '<h2><button onclick="history.back()" .urlencode($account_number)>Go Back</button><h2>' ;
} else {
    $sql = "UPDATE accounts SET balance = balance - $withdraw_amount, open_date = '$datetime' WHERE account_number = $account_number";
    $result = mysqli_query($conn, $sql);

    if ($result) {
		date_default_timezone_set('Asia/Bangkok');

		$time = date('H:i:s');
        $transaction_date = date('Y-m-d H:i:s');
        $description = "การถอนเงิน";
		
        $sql = "INSERT INTO transactions (account_number, transaction_date, amount, description) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssds", $account_number, $transaction_date, $withdraw_amount, $description);
        $result = $stmt->execute();

        if ($result) {
            echo "Withdrawal successful!";
            $redirect_url = "account.php?account_number=" . urlencode($account_number);
            header("Location: $redirect_url");
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Error: " . $conn->error;
    }
}

mysqli_close($conn);
?>

</body>
</html>






