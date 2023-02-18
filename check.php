<?php
require("connect_db.php");


$first_name = $_POST['first_name'];
$password = $_POST["password"];

$sql = "SELECT * FROM customers WHERE first_name = ? AND password = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ss", $first_name, $password);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);


if (mysqli_num_rows($result) > 0) {
    header("Location: account.php");
    exit();
} else {
    echo "Invalid username or password.";
}


mysqli_stmt_close($stmt);
mysqli_close($conn);

?>

