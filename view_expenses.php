<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$result = $conn->prepare("SELECT * FROM expenses WHERE user_id = ? ORDER BY date DESC");
$result->bind_param("i", $user_id);
$result->execute();
$expenses = $result->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Expenses</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-400 via-blue-100 to-white min-h-screen p-6">
    <div class="max-w-4xl mx-auto bg-white/90 rounded-xl shadow-lg p-6 backdrop-blur-sm">
        <h2 class="text-3xl font-bold text-blue-800 mb-6 text-center">Expense History</h2>

        <?php if ($expenses->num_rows > 0): ?>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-700">
                    <thead class="text-xs uppercase bg-blue-200 text-blue-800">
                        <tr>
                            <th class="py-2 px-3">Title</th>
                            <th class="py-2 px-3">Amount (₹)</th>
                            <th class="py-2 px-3">Category</th>
                            <th class="py-2 px-3">Date</th>
                            <th class="py-2 px-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $expenses->fetch_assoc()): ?>
                            <tr class="border-b hover:bg-blue-50">
                                <td class="py-2 px-3"><?= htmlspecialchars($row['title']) ?></td>
                                <td class="py-2 px-3"><?= number_format($row['amount'], 2) ?></td>
                                <td class="py-2 px-3"><?= htmlspecialchars($row['category']) ?></td>
                                <td class="py-2 px-3"><?= htmlspecialchars($row['date']) ?></td>
                                <td class="py-2 px-3 space-x-2">
                                    <a href="edit_expense.php?id=<?= $row['id'] ?>" class="text-blue-600 hover:underline">Edit</a>
                                    <a href="delete_expense.php?id=<?= $row['id'] ?>" class="text-red-600 hover:underline" onclick="return confirm('Are you sure?')">Delete</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="text-center text-gray-700">No expenses found.</p>
        <?php endif; ?>

        <div class="mt-6 text-center">
            <a href="index.php" class="text-blue-600 font-semibold hover:underline">← Back to Dashboard</a>
        </div>
    </div>
</body>
</html>
