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
    <input type="number" id="balance" name="balance" required><br>

    <input type="submit" value="ADD">
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

<form method="post" action="home.php">
  <button type="submit">Go back</button>
</form>
