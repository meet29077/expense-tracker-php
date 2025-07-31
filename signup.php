<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up - Expense Tracker</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-400 via-blue-100 to-white min-h-screen flex items-center justify-center">
    <div class="bg-white/90 shadow-lg rounded-2xl p-8 w-full max-w-md backdrop-blur-sm">
        <h2 class="text-3xl font-bold mb-6 text-center text-blue-800">Create Your Account</h2>
        <form action="signup_process.php" method="POST" class="space-y-5">
            <!-- Username -->
            <div>
                <label class="block mb-1 font-medium text-gray-700">Username</label>
                <input 
                    type="text" 
                    name="username" 
                    required 
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Enter your username"
                >
            </div>

            <!-- Email -->
            <div>
                <label class="block mb-1 font-medium text-gray-700">Email</label>
                <input 
                    type="email" 
                    name="email" 
                    required 
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="you@example.com"
                >
            </div>

            <!-- Password -->
            <div>
                <label class="block mb-1 font-medium text-gray-700">Password</label>
                <input 
                    type="password" 
                    name="password" 
                    required 
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Choose a strong password"
                >
            </div>

            <!-- Submit Button -->
            <input 
                type="submit" 
                value="Register" 
                class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition duration-200"
            >
        </form>

        <!-- Login link -->
        <p class="mt-5 text-sm text-center text-gray-700">
            Already have an account?
            <a href="login.php" class="text-blue-600 font-semibold hover:underline">Login here</a>
        </p>
    </div>
</body>
</html>
