<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction</title>
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
        button[type=onclick] {
            background-color: white; 
            color: black; 
            float: right; 
            position: fixed;
		}
		button[type=submit]:hover {
			background-color: rgb(0, 255, 205);
		}
	</style>
</head>
<body>
    <button onclick="goBack()" style="background-color: white; color: black;  float: right; position: fixed;" >Go Back</button>
<script>
function goBack() {
  window.history.back();
}
</script>

<form>
<?php
require("connect_db.php");

$account_number = $_POST['account_number'];
$sql = "SELECT * FROM transactions WHERE account_number = '$account_number' ORDER BY transaction_date DESC";
$result = $conn->query($sql);

if($result->num_rows > 0){
    echo "<h1>รายการธุรกรรมสำหรับบัญชี #$account_number</h1>";
    echo "<table>";
    echo "<tr><th>วันที่</th><th>ลักษณะ</th><th>จำนวน</th></tr>";

	while ($row = mysqli_fetch_assoc($result)) {
		date_default_timezone_set('Asia/Bangkok');
		$time = date('H:i:s');
		$transaction_date = date('m/d/Y H:i:s', strtotime($row['transaction_date']));
		$description = $row['description'];
		$amount = number_format($row['amount'], 2);
	
		// Set color based on description
		if (strpos($description, 'เงินฝาก') !== false || strpos($description, 'Initial deposit') !== false) {
			$color = 'green';
		} elseif (strpos($description, 'การถอนเงิน') !== false) {
			$color = 'red';
			$amount = '-' . $amount; // Add negative sign for withdrawals
		} else {
			$color = 'black';
		}
	
		echo "<tr>";
		echo "<td>$transaction_date</td>";
		echo "<td >$description</td>";
		echo "<td style=\"color: $color;\">฿$amount</td>"; // Set color for amount column
		echo "</tr>";
	}
	
	
    echo "</table>";
} else {
    echo "No transactions found for Account #$account_number";
}

mysqli_close($conn);

?>
</form>
</body>
</html>