<?php
include 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Prepare statement
    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();

    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($user_id, $fetched_username, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            // ✅ Save correct session variables
            $_SESSION['user_id'] = $user_id;
            $_SESSION['username'] = $fetched_username;

            header("Location: index.php");
            exit();
        } else {
            echo "<script>alert('Incorrect password!'); window.location.href='login.php';</script>";
        }
    } else {
        echo "<script>alert('User not found!'); window.location.href='login.php';</script>";
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: login.php");
    exit();
}
?>
