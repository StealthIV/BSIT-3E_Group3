<?php
require 'dbcon.php';
session_start();

// Check if the user is logged in
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $userID = $_SESSION['userID'];

} else {
    // Redirect to the login page if the user is not logged in
    header("Location: index.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/account.css">
    <title>Add Employee</title>
</head>

<body>

    <div class="navigator">
        <div class="right-align">
            <img src="img./12.png" alt="">
            </b><br><b>
                <div><b>
                        <span></span> <?php echo $username; ?><span>
                    </b><br><b>
                        <small style="color: gray">Administrator</small></b>

                </div>
        </div>
        <ul>
            <li><a href="home.php">Reports</a></li>
            <!-- Change "Accounts" to "Employees" and add dropdown -->
            <li class="dropdown">
                <a class="dropdown-btn active">Employees <span class="dropdown-icon">&#9662;</span></a>
                <div class="dropdown-container">
                    <a href="account.php" class="active">Employee List</a>
                    <a href="access.php">Access Rights</a>
                    <a href="time.php">Timecards</a>
                    <a href="totalhour.php">Total Hours Worked</a>
                </div>
            </li>
            <!-- Add a logout button -->
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>

    <script src="sample.js"></script>

    <div class="container">
    <h2>Add Employee</h2>
    <form action="crud/addemp.php" method="POST">
        <label for="fullname">Full Name:</label>
        <input type="text" id="Fullname" name="Fullname" required><br><br>

        <label for="role">Applied Role:</label>
        <select id="role" name="AppliedRole" required>
            <option value="">Select Role</option>
            <?php
            // PHP code to fetch roles from the database
            require 'dbcon.php'; // Include database connection file
            $stmt = $pdo->query('SELECT accessID, name FROM accessright');
            $roles = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($roles as $role) {
                echo "<option value=\"{$role['accessID']}|{$role['name']}\">{$role['name']}</option>";
            }
            ?>
        </select>

        <div class="form-group">
            <label for="application_date">Application Date:</label>
            <input type="date" id="Date" name="Date" value="<?php echo date('Y-m-d'); ?>" required readonly>
        </div>
        
        <!-- Add pincode input field -->
        <div class="form-group">
            <label for="pincode">Pincode (4 digits):</label>
            <input type="text" id="pincode" name="pincode" pattern="\d{4}" title="Pincode must be 4 digits" maxlength="4" required>
        </div>

        <button type="submit">Add Employee</button>
    </form>
</div>


    <script src="js/nav.js"></script>

    <script>
    document.getElementById('pincode').addEventListener('input', function(event) {
        var input = event.target.value;
        var regex = /^[0-9]*$/; // Regular expression to match only digits

        if (!regex.test(input)) {
            // If input contains non-numeric characters, remove them
            event.target.value = input.replace(/\D/g, '');
        }
    });
</script>

</body>

</html>