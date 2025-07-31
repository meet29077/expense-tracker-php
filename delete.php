<?php
session_start();
include 'db.php';

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $expense_id = $_GET['id'];
    $user_id = $_SESSION['user_id'];

    // Prepare the statement to ensure security
    $stmt = $conn->prepare("DELETE FROM expenses WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $expense_id, $user_id);

    if ($stmt->execute()) {
        // Redirect back to view_expenses.php with success message
        header("Location: view_expenses.php?msg=deleted");
    } else {
        echo "<script>alert('Failed to delete expense.'); window.location.href='view_expenses.php';</script>";
    }

    $stmt->close();
    $conn->close();
} else {
    // No ID passed, redirect safely
    header("Location: view_expenses.php");
    exit();
}
?>
