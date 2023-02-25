<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bank Account Application</title>
  <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Kanit">	
          
  <style>
    body {
      background-color: rgb(225, 255, 255);
      font-family: Kanit;;
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

    form {
      margin-top: 20px;
    }

    label {
      display: block;
      margin-bottom: 5px;
    }

    input[type="text"],
    input[type="password"],
    input[type="number"] {
      width: 100%;
      padding: 10px;
      border: 1px solid #ddd;
      border-radius: 4px;
      margin-bottom: 20px;
      box-sizing: border-box;
    }

    input[type="submit"],
    button {
      background-color: rgb(0, 205, 255);
      color: #fff;
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    input[type="submit"]:hover,
    button:hover {
      background-color: rgb(0, 255, 203);
    }

    .error {
      color: red;
      font-size: 0.8em;
      margin-top: 5px;
    }
  </style>
</head>
<body>
  <div class="container">
    <form action="save_create_bank.php" method="post" onsubmit="return validatePasswords()">
      <h2>Bank Account Application</h2>
      <label for="first_name">First Name:</label>
      <input type="text" id="first_name" name="first_name" required><br>

      <label for="last_name">Last Name:</label>
      <input type="text" id="last_name" name="last_name" required><br>

      <label for="address">Address:</label>
      <input type="text" id="address" name="address" required><br>

      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required><br>

      <label for="confirm_password">Confirm Password:</label>
      <input type="password" id="confirm_password" name="confirm_password" required><br>

      <label for="email">Gmail:</label>
      <input type="text" id="email" name="email" required><br>

      <label for="phone_number">Phone Number:</label>
      <input type="text" id="phone_number" name="phone_number" required><br>

      <label for="balance">Initial Deposit Amount:</label>
      <input type="number" id="balance" step="100" name="balance" required><br>

      <input type="submit" value="ADD">
    </form>

    <form method="post" action="home.php">
      <button type="submit">Go back</button>
    </form>
  </div>

  <script>
    function validatePasswords() {
      var password = document.getElementById("password").value;
      var confirm_password = document.getElementById("confirm_password").value;
      if (password != confirm_password) {
        alert("Passwords do not match");
        return false;
      }
      return true;
    }
  </script>
</body>
</html>


