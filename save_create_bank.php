<!DOCTYPE html>
<html>
<head>
  <title>Bank Account Application - Account Created</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
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
      background-color: #4CAF50;
      color: #fff;
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    button:hover {
      background-color: #45a049;
    }
  </style>
</head>
<body>
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

    $sql = "INSERT INTO customers (first_name, last_name, address, password, email, phone_number ) 
            VALUES ('$first_name', '$last_name', '$address', '$password', '$email', '$phone_number')";
    $result = mysqli_query($conn, $sql);


    if ($result) {
        $customer_id = mysqli_insert_id($conn);

        $sql = "INSERT INTO accounts (customer_id, balance) VALUES ('$customer_id', '$balance')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $account_number = mysqli_insert_id($conn);

            echo "<h2>Bank account successfully created!</h2>";
            echo "<p>Account Number: $account_number</p>";
            echo "<p>Customer ID: $customer_id</p>";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
    ?>
    <form method="post" action="home.php">
      <button type="submit">Go to Login</button>
    </form>
  </div>
</body>
</html>
