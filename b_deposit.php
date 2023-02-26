<!DOCTYPE html>
<html>
<head>
	<title>Deposit</title>
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
  			font-size: 30px; /* Set the font size to 24px */
  			background-color: #FFFFFF;
		  	border: 1px solid #CCCCCC;
  			border-radius: 5px;
  			padding: 40px; /* Increase the padding to make the form larger */
  			max-width: 800px; /* Set the maximum width of the form to 800px */
  			margin: 0 auto; /* Center the form horizontally */
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
			background-color:rgb(0, 205, 255);
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
$account_number=$_POST['account_number'];
?>
<form method="post" action="deposit.php" onsubmit="return confirmDeposit()">
  <input type="hidden" name="account_number" value="<?php echo htmlspecialchars($account_number); ?>">
  <input type="hidden" name="customer_id" value="<?php echo htmlspecialchars($customer_id); ?>">
  <label for="amount">Enter the amount to be deposited:</label>
  <input type="number" name="amount" step="0.01" placeholder="Enter amount to deposit" required><br> 
  <br>
  <button type="submit">Deposit</button><br>


	<script>
	function confirmDeposit() {
	  var amount = document.getElementsByName('amount')[0].value;
	  return confirm("Are you sure you want to deposit $" + amount + "?");
	}

	</script>
	<form>
  		<button onclick="goBack()" style="background-color: white; color: black; float: right;">Go Back</button>
	</form>

	<script>
	function goBack() {
 	 window.history.back();
	}
	</script>
</form>

</body>
</html>




