<?php
include 'db.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$title = $_POST['title'];
$amount = $_POST['amount'];
$category = $_POST['category'];
$date = $_POST['expense_date'];

$sql = "INSERT INTO expenses (title, amount, category, expense_date)
        VALUES ('$title', '$amount', '$category', '$date')";

if (mysqli_query($conn, $sql)) {
    header("Location: index.php");
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
