<?php
require("connect_db.php");

// Get the form data
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];

// Construct the SQL query to check if the username and password exist in the database
$sql = "SELECT * FROM customers WHERE first_name='$first_name' AND last_name='$last_name'";

// Execute the query and check if any rows were returned
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    //echo "Text exists in database.";
    header("Location: account.php");
    exit();

} else {
    echo "Text does not exist in database.";
}

// Close the database connection
mysqli_close($conn);
?>

