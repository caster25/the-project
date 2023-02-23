<!DOCTYPE html>
<html>
<head>
  <title>Bank Account Application - Account Created</title>
  <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Kanit">	
  <style>
    body {
      background-color: rgb(225, 255, 255);
      font-family: Kanit;;
      margin: 0;
      padding: 0;
    }
    form {
			background-color: #FFFFFF;
			border: 1px solid #CCCCCC;
			border-radius: 5px;
			padding: 20px;
			width: 400px;
			margin: 0 auto;
		}
    

    .container {
      margin: 50px auto;
      width: 80%;
      max-width: 600px;
      border: 1px solid #ddd;
      padding: 20px;
    }

    h2 {
      margin-top: 0;
    }

    button {
      background-color:rgb(0, 206, 255);
      color: #fff;
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    button:hover {
      background-color: rgb(0, 255, 205);
    }
  </style>
</head>

<body>
<form method="post" action="home.php">
<div class="container">
    <?php
    require("connect_db.php");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $address = $_POST['address'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $balance = $_POST['balance'];
    if (isset($_POST['first_name'])) {
      $first_name = $_POST['first_name'];
    } else {
      $first_name = "";
    }
    
    $sql = "INSERT INTO customers (first_name, last_name, address, password, email, phone_number) 
            VALUES ('$first_name', '$last_name', '$address', '$password', '$email', '$phone_number')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $customer_id = mysqli_insert_id($conn);

        $sql = "INSERT INTO accounts (customer_id, balance) VALUES ('$customer_id', '$balance')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $account_number = mysqli_insert_id($conn);

            $transaction_date = date('Y-m-d H:i:s');
            $amount = $balance;
            $description = "Initial deposit";

            $sql = "INSERT INTO transactions (account_number, transaction_date, amount, description)
                    VALUES ('$account_number', '$transaction_date', '$amount', '$description')";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                echo "<h2>Bank account successfully created!</h2>";
                echo "<p>Account Number: $account_number</p>";
                echo "<p>Customer ID: $customer_id</p>";
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
    ?>
</div>
      <button type="submit">Go to Login</button>
    </form>
</body>
</html>
