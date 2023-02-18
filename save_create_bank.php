<?php
require("connect_db.php");

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$address = $_POST['address'];
$email =$_POST['email'];
$phone_number = $_POST['phone_number'];
$balance = $_POST['balance'];
$password =$_POST['password'];


$sql = "INSERT INTO customers (first_name, last_name, address, email, phone_number, password) 
VALUES ('$first_name', '$last_name', '$address','$email', '$phone_number','$password')";
if ($conn->query($sql) === TRUE) {
    $customer_id = $conn->insert_id;

    $sql = "INSERT INTO accounts (customer_id, balance) VALUES ($customer_id, $balance)";
    if ($conn->query($sql) === TRUE) {
        header("location: home.php");
    } else {
        echo "Error inserting into accounts table: " . $conn->error;
    }
} else {
    echo "Error inserting into customers table: " . $conn->error;
}

$conn->close();
?>
