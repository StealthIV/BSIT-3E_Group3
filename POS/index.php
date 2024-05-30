<?php
require 'dbcon.php';
session_start();

if (isset($_SESSION['username'])) {
    // Redirect to the home page if the user is already logged in
    header("Location: home.php");
    exit();
}

$errorMsg = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Get username and password from the form
        $username = $_POST['username'];
        $password = $_POST['password'];

        $stmt = $pdo->prepare('SELECT userID, password FROM usercredential WHERE username = ?');

        // Execute the statement
        $stmt->execute([$username]);

        // Fetch user data
        $userData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($userData) {
            // Verify the password
            if (password_verify($password, $userData['password'])) {
                // Set session variables for username and userID
                $_SESSION['username'] = $username;
                $_SESSION['userID'] = $userData['userID'];

                // Redirect to home page
                header("Location: home.php");
                exit();
            } else {
                // Password does not match
                $errorMsg = "Incorrect password";
            }
        } else {
            // User does not exist
            $errorMsg = "User not found";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banana</title>
    <link rel="stylesheet" href="sample.css">
</head>
<body>
    <div class="login-container">
        <img src="img/banana.png" alt="logo Image" class="image">
        <?php if(!empty($errorMsg)): ?>
            <div class="error"><?php echo $errorMsg; ?></div>
        <?php endif; ?>
        <form action="index.php" method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" value="Login">Login</button>
        </form>
    </div>
</body>
</html>
