<?php include 'db.php'; 
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Expense</title>
</head>
<body>
    <h2>Add Expense</h2>
    <form action="insert.php" method="POST">
        <label>Title:</label><br>
        <input type="text" name="title" required><br>

        <label>Amount:</label><br>
        <input type="number" step="0.01" name="amount" required><br>

        <label>Category:</label><br>
        <input type="text" name="category" required><br>

        <label>Date:</label><br>
        <input type="date" name="expense_date" required><br><br>

        <input type="submit" value="Add Expense">
    </form>
    <br>
    <a href="index.php">Back to Expense List</a>
</body>
</html>
