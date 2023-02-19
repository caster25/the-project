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
<form>
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
        echo "<h1>Invalid username or password.</h1>";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>
</form>

<form method="post" action="home.php">
    <button type="submit">Black</button>
</form>
</html>



