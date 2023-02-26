<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Account</title>
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
		#popup-box {
		    position: fixed;
		    top: 50%;
		    left: 50%;
		    transform: translate(-50%, -50%);
		    z-index: 9999;
		    background-color: #FFFFFF;	
		    border: 1px solid #CCCCCC;
    		border-radius: 5px;
    		padding: 20px;
    		width: 400px;
		  }
		
	</style>
</head>

<body>
<form>
<?php
session_start();
require("connect_db.php");

if (isset($_SESSION['customer_id'])) {

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
            echo "<h2>Account number:   $account_number </h2>";
            echo "<h2>Current balance: <span style='color: green;'> ฿  ". number_format($balance, 2). "</h2>" ;
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
	date_default_timezone_set('Asia/Bangkok');
	$now = date('m/d/Y h:i A');
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];

    echo "<h1>Customer Information</h1>";
    echo "<h2>Name: " . $first_name . " " . $last_name . "</h2>";

    echo "<h2>Latest time: " . date('Y-m-d H:i:s') . "</h2>";

    mysqli_stmt_close($stmt);
    mysqli_close($conn);


?>

</form>
<form method="post" action="b_deposit.php" >
  <input type="hidden" name="account_number" value="<?php print($account_number); ?>">
  <button type="submit">Deposit into account</button>
</form>

<form method="post" action="b_withdraw.php">
  <input type="hidden" name="account_number" value="<?php print($account_number); ?>">
  <button type="submit">Withdraw from account</button>
</form>

<form method="post" action="transaction_listing.php">
  <input type="hidden" name="account_number" value="<?php print($account_number); ?>">
  <button type="submit">Transaction Listing</button>
</form>


<body>
  <div id="popup-box" style="display:none; ">
    <p>Are you sure you want to go back to the account list?</p>
    <button onclick="hidePopup(true)">Yes</button>
    <button onclick="hidePopup(false)">No</button>
  </div>

  <button onclick="showPopup()" style="background-color: white; color: black;  float: right; position: fixed;" >Back to Login Page</button>

  <form method="post" action="home.php" style="display:none;">
    <button id="submit-button" type="submit">Submit form</button>
  </form>

  <script>
    function showPopup() {
      document.getElementById("popup-box").style.display = "block";
    }

    function hidePopup(confirmation) {
      document.getElementById("popup-box").style.display = "none";
      if (confirmation) {
        document.getElementById("submit-button").click();
      }
    }
  </script>
</body>
</html>

<?php
}
?>



