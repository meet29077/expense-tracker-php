<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
$user_id = $_SESSION['user_id'];

// Total spent today
$today = date("Y-m-d");
$stmt = $conn->prepare("SELECT SUM(amount) FROM expenses WHERE user_id = ? AND date = ?");
$stmt->bind_param("is", $user_id, $today);
$stmt->execute();
$stmt->bind_result($total_today);
$stmt->fetch();
$stmt->close();

// Total spent this month
$month = date("Y-m");
$stmt = $conn->prepare("SELECT SUM(amount) FROM expenses WHERE user_id = ? AND DATE_FORMAT(date, '%Y-%m') = ?");
$stmt->bind_param("is", $user_id, $month);
$stmt->execute();
$stmt->bind_result($total_month);
$stmt->fetch();
$stmt->close();

// Total all time
$stmt = $conn->prepare("SELECT SUM(amount) FROM expenses WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($total_all);
$stmt->fetch();
$stmt->close();

// Latest expense
$stmt = $conn->prepare("SELECT category, amount, date FROM expenses WHERE user_id = ? ORDER BY date DESC, id DESC LIMIT 1");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($latest_category, $latest_amount, $latest_date);
$has_latest = $stmt->fetch();
$stmt->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Expense Tracker</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-400 via-blue-100 to-white min-h-screen p-6">

    <!-- Navbar -->
    <nav class="flex flex-col md:flex-row justify-between items-center mb-8 bg-white/80 p-4 rounded-lg shadow-md backdrop-blur-sm">
        <h1 class="text-2xl font-bold text-blue-800">Expense Tracker</h1>
        <div class="space-x-4 mt-2 md:mt-0">
            <a href="add_expense.php" class="text-blue-600 font-medium hover:underline">Add Expense</a>
            <a href="view_expenses.php" class="text-blue-600 font-medium hover:underline">View History</a>
            <a href="logout.php" class="text-red-600 font-medium hover:underline">Logout</a>
        </div>
    </nav>

    <!-- Welcome + Summary -->
    <div class="bg-white/90 rounded-2xl p-6 shadow-lg max-w-3xl mx-auto text-center backdrop-blur-sm">
        <h1 class="text-3xl font-bold text-blue-800 mb-2">Welcome, <?php echo htmlspecialchars($username); ?> 👋</h1>
        <p class="text-lg text-gray-700 mb-6">Track your spending and manage your budget easily.</p>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-blue-100 p-6 rounded-xl shadow-sm">
                <h3 class="text-lg font-semibold text-blue-700">Total Expenses</h3>
                <p class="text-2xl mt-2 font-bold">₹<?= number_format($total_all ?? 0, 2) ?></p>
            </div>
            <div class="bg-green-100 p-6 rounded-xl shadow-sm">
                <h3 class="text-lg font-semibold text-green-700">This Month</h3>
                <p class="text-2xl mt-2 font-bold">₹<?= number_format($total_month ?? 0, 2) ?></p>
            </div>
            <div class="bg-yellow-100 p-6 rounded-xl shadow-sm">
                <h3 class="text-lg font-semibold text-yellow-700">Latest Expense</h3>
                <p class="text-md mt-2">
                    <?php
                    if ($has_latest) {
                        echo htmlspecialchars($latest_category) . ' - ₹' . number_format($latest_amount, 2);
                        echo "<br><span class='text-sm text-gray-600'>Date: " . htmlspecialchars($latest_date) . "</span>";
                    } else {
                        echo "No recent expenses";
                    }
                    ?>
                </p>
            </div>
        </div>
    </div>

    <!-- Totals Breakdown -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6 max-w-4xl mx-auto">
        <div class="bg-blue-100 p-4 rounded-xl text-center">
            <p class="text-gray-600">Spent Today</p>
            <p class="text-2xl font-bold text-blue-800">₹<?= number_format($total_today ?? 0, 2) ?></p>
        </div>
        <div class="bg-blue-200 p-4 rounded-xl text-center">
            <p class="text-gray-600">This Month</p>
            <p class="text-2xl font-bold text-blue-900">₹<?= number_format($total_month ?? 0, 2) ?></p>
        </div>
        <div class="bg-blue-300 p-4 rounded-xl text-center">
            <p class="text-gray-600">All Time</p>
            <p class="text-2xl font-bold text-blue-900">₹<?= number_format($total_all ?? 0, 2) ?></p>
        </div>
    </div>

</body>
</html>