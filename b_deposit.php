<form method="post" action="deposit.php" onsubmit="return confirm('Are you sure you want to deposit this amount?')">
<label for="account_number">Account Number:</label>
  <input type="text" name="account_number" required>
  <br>
  <label for="amount">Amount:</label>
  <input type="number" name="amount" step="0.01" placeholder="Enter amount to deposit" required>
  <br>
  <button type="submit">Deposit</button>
</form>

