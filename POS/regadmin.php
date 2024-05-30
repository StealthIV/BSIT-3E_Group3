<?php
require 'dbcon.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $levelOfAccess = $_POST['levelofAccess'];

        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare('INSERT INTO usercredential (username, password, levelofAccess) VALUES (?, ?, ?)');
        $stmt->execute([$username, $hashedPassword, $levelOfAccess]);

        header("Location: login.php");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration</title>
</head>
<body>
    <h2>Register</h2>
    <form method="post">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        <label for="levelOoAccess">Level of Access:</label><br>
        <select id="levelofAccess" name="levelofAccess" required>
            <option value="1">Admin</option>
            <option value="2">User</option>
        </select><br><br>
        <button type="submit">Register</button>
    </form>
</body>
</html>
