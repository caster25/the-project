<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<style>
    button[type=submit] {
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
		button[type=submit]:hover {
			background-color: #3E8E41;
		}
	</style>
</head>
<body>
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
            echo "<h2>Account number:  . $account_number </h2>";
            echo "<h2>Current balance: $  ". number_format($balance, 2). "</h2>" ;
        } else {
            echo "<h1>Invalid account number.</h1>";
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "<h1>No account number specified.</h1>";
    }

    $query = "SELECT * FROM customers WHERE customer_id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $_SESSION['customer_id']);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    $first_name = $row['first_name'];
    $last_name = $row['last_name'];

    echo "<h1>Customer Information</h1>";
    echo "<h2>Name: " . $first_name . " " . $last_name . "</h2>";
    

    echo "<h2>Latest time: " . date('Y-m-d H:i:s') . "</h2>";

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
<?php
/*<form method="post" action="b_transfer.php">
 <button type="submit">transfer money</button>
</form>*/
?>
<form method="post" action="home.php">
  <button type="submit">went back earlier</button>
</form>

</body>
</html>




