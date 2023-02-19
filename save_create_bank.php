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

// Insert new customer record
$sql = "INSERT INTO customers (first_name, last_name, address, password, email, phone_number) VALUES ('$first_name', '$last_name', '$address', '$password', '$email', '$phone_number')";
$result = mysqli_query($conn, $sql);

if ($result) {
    // Get the customer_id of the newly inserted record
    $customer_id = mysqli_insert_id($conn);
    
    // Insert new account record
    $sql = "INSERT INTO accounts (customer_id, balance) VALUES ('$customer_id', '$balance')";
    $result = mysqli_query($conn, $sql);
    
    if ($result) {
        // Get the account_number of the newly inserted record
        $account_number = mysqli_insert_id($conn);
        
        // Display success message with account_number and customer_id
        echo "Bank account successfully created!<br>";
        echo "Account Number: $account_number<br>";
        echo "Customer ID: $customer_id<br>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
<form method="post" action="home.php">
    <button type="bo">Go to Login </input>
</form>

