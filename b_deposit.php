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
<form method="post" action="deposit.php" onsubmit="return confirm('Are you sure you want to deposit this amount?')">
  <label for="account_number">Account Number:</label>
  <input type="text" name="account_number" required>
  <br>
  <label for="amount">Amount:</label>
  <input type="number" name="amount" step="0.01" placeholder="Enter amount to deposit" required>
  <br>
  <button type="submit">Deposit</button>
</form>
</body>
</html>
