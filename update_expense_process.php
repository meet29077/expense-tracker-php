<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST['id'];
    $user_id = $_SESSION['user_id'];
    $title = trim($_POST['title']);
    $amount = floatval($_POST['amount']);
    $category = trim($_POST['category']);
    $date = $_POST['date'];
    $description = trim($_POST['description']);

    $stmt = $conn->prepare("UPDATE expenses SET title=?, amount=?, category=?, date=?, description=? WHERE id=? AND user_id=?");
    $stmt->bind_param("sdsssii", $title, $amount, $category, $date, $description, $id, $user_id);
    
    if ($stmt->execute()) {
        header("Location: view_expenses.php");
        exit();
    } else {
        echo "<script>alert('Update failed'); window.history.back();</script>";
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: index.php");
    exit();
}
?>
