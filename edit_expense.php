<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id']) || !isset($_GET['id'])) {
    header("Location: login.php");
    exit();
}

$expense_id = $_GET['id'];
$user_id = $_SESSION['user_id'];

// Fetch the expense
$stmt = $conn->prepare("SELECT * FROM expenses WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $expense_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();
$expense = $result->fetch_assoc();

if (!$expense) {
    echo "<script>alert('Expense not found'); window.location.href='view_expenses.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Expense</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-400 via-blue-100 to-white min-h-screen flex items-center justify-center">
    <div class="bg-white/90 shadow-lg rounded-2xl p-8 w-full max-w-md backdrop-blur-sm">
        <h2 class="text-3xl font-bold mb-6 text-center text-blue-800">Edit Expense</h2>
        <form action="update.php" method="POST">
            <input type="hidden" name="id" value="<?= $expense['id'] ?>">
            <div>
                <label class="block mb-1 font-medium text-gray-700">Title</label>
                <input type="text" name="title" value="<?= htmlspecialchars($expense['title']) ?>" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block mb-1 font-medium text-gray-700">Amount</label>
                <input type="number" step="0.01" name="amount" value="<?= $expense['amount'] ?>" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block mb-1 font-medium text-gray-700">Category</label>
                <input type="text" name="category" value="<?= htmlspecialchars($expense['category']) ?>" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block mb-1 font-medium text-gray-700">Date</label>
                <input type="date" name="date" value="<?= $expense['date'] ?>" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block mb-1 font-medium text-gray-700">Description</label>
                <textarea name="description" rows="3" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500"><?= htmlspecialchars($expense['description']) ?></textarea>
            </div>
            <input type="submit" value="Update Expense" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">
        </form>
    </div>
</body>
</html>
