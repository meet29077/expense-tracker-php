<?php
session_start();
include 'db.php';

// Check if user is admin (you need a role column in your users table)
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Fetch all users
$users = $conn->query("SELECT id, username FROM users");

// Fetch all expenses
$expenses = $conn->query("SELECT e.id, u.username, e.category, e.amount, e.date 
                          FROM expenses e 
                          JOIN users u ON e.user_id = u.id 
                          ORDER BY e.date DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="p-8 bg-gray-100">

    <h1 class="text-3xl font-bold mb-6 text-center text-blue-700">Admin Dashboard</h1>

    <div class="mb-10">
        <h2 class="text-xl font-semibold mb-2">👥 All Users</h2>
        <table class="min-w-full bg-white shadow rounded overflow-hidden">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-3">ID</th>
                    <th class="p-3">Username</th>
                    <th class="p-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($user = $users->fetch_assoc()): ?>
                <tr class="border-b">
                    <td class="p-3"><?= $user['id'] ?></td>
                    <td class="p-3"><?= htmlspecialchars($user['username']) ?></td>
                    <td class="p-3">
                        <a href="delete_user.php?id=<?= $user['id'] ?>" class="text-red-600 hover:underline">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <div>
        <h2 class="text-xl font-semibold mb-2">💰 All Expenses</h2>
        <table class="min-w-full bg-white shadow rounded overflow-hidden">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-3">ID</th>
                    <th class="p-3">Username</th>
                    <th class="p-3">Category</th>
                    <th class="p-3">Amount</th>
                    <th class="p-3">Date</th>
                    <th class="p-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($expense = $expenses->fetch_assoc()): ?>
                <tr class="border-b">
                    <td class="p-3"><?= $expense['id'] ?></td>
                    <td class="p-3"><?= htmlspecialchars($expense['username']) ?></td>
                    <td class="p-3"><?= htmlspecialchars($expense['category']) ?></td>
                    <td class="p-3">₹<?= number_format($expense['amount'], 2) ?></td>
                    <td class="p-3"><?= $expense['date'] ?></td>
                    <td class="p-3">
                        <a href="delete_expense.php?id=<?= $expense['id'] ?>" class="text-red-600 hover:underline">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

</body>
</html>
