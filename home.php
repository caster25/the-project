<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
</head>
<body>
    <div class="home">
        <h2>Login</h2>
        <?php
        require("connect_db.php");
        ?>
        <form method="post" action="check.php">
            <div>
                <label for="first_name">Username:</label>
                <input type="text" id="first_name" name="first_name" required>
            </div>
            <div>
                <label for="last_name">Password:</label>
                <input type="password" id="last_name" name="last_name" required>
            </div>
            <button type="submit">LOGIN</button>
        </form>
        <br>
        <p>Create an account:</p>
        <a href="create_bank.php">Sign Up</a>
    </div>
</body>
</html>

