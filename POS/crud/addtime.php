<?php
require '../dbcon.php';
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: ../index.php");
    exit();
}

$username = $_SESSION['username'];
$userID = $_SESSION['userID'];
// Fetch data from the database
try {
    $stmt = $pdo->query('SELECT * FROM emp');
    $employees = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Handle form submission for adding timecard
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_timecard'])) {
    try {
        // Retrieve form data
        $employeeID = $_POST['employee'];
        $clockIn = $_POST['clock_in'];
        $clockOut = $_POST['clock_out'];

        // Calculate total hours worked
        $totalHours = round((strtotime($clockOut) - strtotime($clockIn)) / 3600, 2);

        // Check if total hours are negative
        if ($totalHours < 0) {
            echo "<script>alert('Warning: Total hours cannot be negative.');</script>";
        } else {
            // Insert timecard data into the database
            $stmt = $pdo->prepare('INSERT INTO timecards (employeeID, clockIn, clockOut, totalHours) VALUES (?, ?, ?, ?)');
            $stmt->execute([$employeeID, $clockIn, $clockOut, $totalHours]);

            // Redirect back to account.php after adding timecard
            header("Location: ../time.php");
            exit();
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
    <link rel="stylesheet" href="../style/time.css">

    <title>HR Accounts</title>
</head>

<body>

    <div class="navigator">
        <div class="right-align">
            <img src="../img/12.png" width="60px" style="margin-left: 10px;">
            </b><br><b>
                <div><b>
                        <span></span> <?php echo $username; ?><span>
                    </b><br><b>
                        <small style="color: gray">Administrator</small></b>
                </div>
        </div>
        <ul>
            <li><a href="../home.php">Reports</a></li>
            <li class="dropdown">
                <a class="dropdown-btn active">Employees <span class="dropdown-icon">&#9662;</span></a>
                <div class="dropdown-container">
                    <a href="../account.php">Employee List</a>
                    <a href="../access.php">Access Rights</a>
                    <a href="../time.php" class="active">Timecards</a>
                    <a href="../totalhour.php">Total Hours Worked</a>
                </div>
            </li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>

    <div class="container">
        <div class="add-timecard-form">
            <h2>Add Timecard</h2>
            <form action="" method="post">
                <label for="employee">Select Employee:</label>
                <select id="employee" name="employee" required>
                    <?php foreach ($employees as $employee): ?>
                        <option value="<?php echo $employee['userID']; ?>">
                            <?php echo $employee['Fullname']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <label for="clock_in">Clock In:</label>
                <input type="datetime-local" id="clock_in" name="clock_in" required>

                <label for="clock_out">Clock Out:</label>
                <input type="datetime-local" id="clock_out" name="clock_out" required>
                <br>
                <button type="submit" name="add_timecard">Add Timecard</button>
            </form>
        </div>

    </div>
    <script src="../sample.js"></script>
    <script src="..js/nav.js"></script>

</body>

</html>