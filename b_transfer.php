<form method="post" action="transfer_money.php" onsubmit="return confirm('Are you sure you want to transfer this amount?')">
  <label for="from_account">From Account Number:</label>
  <input type="text" name="from_account" required>
  <br>
  <label for="to_account">To Account Number:</label>
  <input type="text" name="to_account" required>
  <br>
  <label for="amount">Amount:</label>
  <input type="number" name="amount" step="0.01" placeholder="Enter amount to transfer" required>
  <br>
  <button type="submit">Transfer</button>
</form>