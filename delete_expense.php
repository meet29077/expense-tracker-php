<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id']) || !isset($_GET['id'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];
$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("DELETE FROM expenses WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $id, $user_id);
$stmt->execute();

$stmt->close();
$conn->close();

header("Location: view_expenses.php");
exit();
?>
