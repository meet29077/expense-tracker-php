<?php
include 'db.php';
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Process form only on POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get and sanitize inputs
    $user_id     = $_SESSION['user_id'];
    $title       = trim($_POST['title']);
    $amount      = floatval($_POST['amount']);
    $category    = trim($_POST['category']);
    $date        = $_POST['date'];
    $description = trim($_POST['description']);

    // Simple validation
    if ($title && $amount > 0 && $category && $date) {
        $stmt = $conn->prepare("INSERT INTO expenses (user_id, title, amount, category, date, description) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isdsss", $user_id, $title, $amount, $category, $date, $description);
        
        if ($stmt->execute()) {
            // Success, redirect to dashboard
            header("Location: index.php");
            exit();
        } else {
            echo "<script>alert('Error saving expense.'); window.history.back();</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('All fields except description are required!'); window.history.back();</script>";
    }

    $conn->close();
} else {
    // If accessed without POST
    header("Location: add_expense.php");
    exit();
}
?>
