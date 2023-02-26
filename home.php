<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Kanit">	
	<style>
		div {
			background-color: rgb(225, 255, 255);
			border: 1px solid #CCCCCC;
			border-radius: 5px;
			padding: 20px;
			width: 400px;
			margin: 0 auto;
		}
		body {
			font-family: Kanit;
			background-color: rgb(225, 255, 255);
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
		input[type=submit]:hover {
			background-color: rgb(0, 255, 205);
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
<?php
if (isset($_POST['reset_account_number'])) {
	$account_number = '';
  } else {
	$account_number = $_GET['account_number'] ?? '';
  }
  
?>
<body>
	<h1>Login</h1>

	<form method="post" action="check.php">
		<label for="account_number">Account Number:</label>
		<input type="text" id="account_number" name="account_number" required>

		<label for="password">Password:</label>
		<input type="password" id="password" name="password" required>

		<input type="submit" value="Login">
	</form>

	<form method="post" action="create_bank.php">
		<button type="submit">Create an account</button>
	</form>


</body>
<?php
/*
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  <select name="lang" onchange="this.form.submit()">
    <option value="en" <?php if ($_POST['lang'] == 'en') { echo 'selected'; } ?>>English</option>
    <option value="fr" <?php if ($_POST['lang'] == 'fr') { echo 'selected'; } ?>>Français</option>
    <option value="es" <?php if ($_POST['lang'] == 'es') { echo 'selected'; } ?>>Español</option>
  </select>
</form>
*/
?>
</html>

