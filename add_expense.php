<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Expense - Expense Tracker</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-400 via-blue-100 to-white min-h-screen p-6 flex items-center justify-center">

    <div class="bg-white/90 p-8 rounded-2xl shadow-lg w-full max-w-lg backdrop-blur-sm">
        <h2 class="text-2xl font-bold text-blue-800 mb-6 text-center">Add New Expense</h2>

        <form action="add_expense_process.php" method="POST" class="space-y-5">
            <!-- Title -->
            <div>
                <label class="block mb-1 font-medium text-gray-700">Title</label>
                <input type="text" name="title" required placeholder="e.g. Grocery shopping" 
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Amount -->
            <div>
                <label class="block mb-1 font-medium text-gray-700">Amount (₹)</label>
                <input type="number" step="0.01" name="amount" required placeholder="e.g. 1500"
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Category -->
            <div>
                <label class="block mb-1 font-medium text-gray-700">Category</label>
                <select name="category" required
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Select Category</option>
                    <option value="Food">Food</option>
                    <option value="Travel">Travel</option>
                    <option value="Bills">Bills</option>
                    <option value="Shopping">Shopping</option>
                    <option value="Other">Other</option>
                </select>
            </div>

            <!-- Date -->
            <div>
                <label class="block mb-1 font-medium text-gray-700">Date</label>
                <input type="date" name="date" required 
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Description -->
            <div>
                <label class="block mb-1 font-medium text-gray-700">Description (optional)</label>
                <textarea name="description" rows="3" placeholder="e.g. Bought from Reliance Fresh"
                          class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            </div>

            <!-- Submit Button -->
            <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition duration-200">
                Save Expense
            </button>
        </form>

        <!-- Back Link -->
        <p class="mt-4 text-center text-sm text-gray-600">
            <a href="index.php" class="text-blue-600 hover:underline">← Back to Dashboard</a>
        </p>
    </div>

</body>
</html>
