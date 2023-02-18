<form method="post" action="withdraw.php" onsubmit="return confirm('Are you sure you want to deposit this amount?')">
<label for="account_number">Account Number:</label>
  <input type="text" name="account_number" required>
  <br>
  <label for="amount">amount:</label>
  <input type="number" name="amount" step="0.01" placeholder="Enter amount to deposit" required>
  <br>
  <button type="submit">withdraw</button>
</form>
<form method="post" action="account.php">
  <button type="submit">went back earlier</button>
</form>