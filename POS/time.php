<?php
require 'dbcon.php';
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to the login page if the user is not logged in
    header("Location: index.php");
    exit();

}
$username = $_SESSION['username'];
$userID = $_SESSION['userID'];
// Fetch data from the timecards table along with employee names
try {
    $stmt = $pdo->query('SELECT t.*, e.Fullname 
                         FROM timecards t
                         INNER JOIN emp e ON t.employeeID = e.userID');
    $timecards = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/efa820665e.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="style/account.css">
    <title>HR Accounts</title>
</head>

<body>


    <div class="navigator">
        <a href="pincode.php">
            <i class="fa-regular fa-clock icon"></i>
        </a>
        <div class="right-align">
            <img src="img/12.png" alt="">
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
                    <a href="account.php">Employee List</a>
                    <a href="access.php">Access Rights</a>
                    <a href="time.php" class="active">Timecards</a>
                    <a href="totalhour.php">Total Hours Worked</a>
                </div>
            </li>
            <!-- Add a logout button -->
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>




    <script src="sample.js"></script>

    <div class="container">
        <div class="header">
            <h2>Timecards</h2>
            <a href="crud/addtime.php" class="add-employee-btn">Add Timecard</a>
        </div>

        <div class="table-wrapper">
            <div class="table">
                <table>
                    <thead>
                        <tr>
                            <th class="align-left">Employee</th>
                            <th class="align-left">Clock in</th>
                            <th class="align-left">Clock out</th>
                            <th class="align-left">Total hours</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($timecards as $timecard): ?>
                            <tr>
                                <td>
                                    <?php echo $timecard['Fullname']; ?>
                                </td>
                                <td>
                                    <?php echo $timecard['clockIn']; ?>
                                </td>
                                <td>
                                    <?php echo $timecard['clockOut']; ?>
                                </td>
                                <td>
                                    <?php echo $timecard['totalHours']; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    </div>
    <script src="js/nav.js"></script>

</body>

</html>