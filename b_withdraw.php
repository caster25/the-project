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
<form method="post" action="withdraw.php" onsubmit="return confirm('Are you sure you want to withdraw this amount?')">
<label for="account_number">Account Number:</label>
  <input type="text" name="account_number" required><br>
  <label for="amount">amount:</label>
  <input type="number" name="amount" step="0.01" placeholder="Enter amount to withdraw" required><br>
  <br>
  <button type="submit">withdraw</button>
</form>
</body>
</html>
