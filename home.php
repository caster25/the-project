<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<body>
	<h1>Login</h1>

	<form method="post" action="check.php">
		<label for="account_number">Account Number:</label>
		<input type="text" id="account_number" name="account_number" required><br>

		<label for="password">Password:</label>
		<input type="password" id="password" name="password" required><br>

		<input type="submit" value="Login"><br>
	</form>
  <form method="post" action="create_bank.php">
    <button type="submit">Create an account</button>
  </form>
</body>
</html>


