<?php
require("connect_db.php");

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$address = $_POST['address'];
$email =$_POST['email'];
$phone_number = $_POST['phone_number'];
$balance = $_POST['balance'];

// Insert data into the customers table
$sql = "INSERT INTO customers (first_name, last_name, address, email, phone_number) VALUES ('$first_name', '$last_name', '$address','$email', '$phone_number')";
if ($conn->query($sql) === TRUE) {
    // Retrieve the customer ID of the newly inserted row
    $customer_id = $conn->insert_id;

    // Insert data into the accounts table
    $sql = "INSERT INTO accounts (customer_id, balance) VALUES ($customer_id, $balance)";
    if ($conn->query($sql) === TRUE) {
        // Redirect to the home page
        header("location: home.php");
    } else {
        echo "Error inserting into accounts table: " . $conn->error;
    }
} else {
    echo "Error inserting into customers table: " . $conn->error;
}

// Close the database connection
$conn->close();
?>
