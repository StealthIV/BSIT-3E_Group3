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

// Fetch data from the database
try {
    $stmt = $pdo->query('SELECT * FROM emp');
    $employees = $stmt->fetchAll(PDO::FETCH_ASSOC);
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



    <body>
        <div class="container">
            <div class="header">
                <h2>Employee List</h2>
                <a href="emp.php" class="add-employee-btn">Add Employee <i class="fas fa-plus"></i></a>
                <button onclick="deleteSelected()" class="delete-button">Delete Selected <i
                        class="fas fa-trash"></i></button>
            </div>

            <div class="table-wrapper">
                <div class="table">
                    <table>
                        <thead>
                            <tr>
                                <th class="align-left"><input type="checkbox" id="select-all"></th>
                                <th class="align-left">No</th>
                                <th class="align-left">Full Name</th>
                                <th class="align-left">Applied Role</th>
                                <th class="align-left">Application Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($employees as $index => $employee): ?>
                                <tr class="row-hover">
                                    <td><input type="checkbox" name="selectedEmployees[]"
                                            value="<?php echo $employee['userID']; ?>"></td>
                                    <td><?php echo $index + 1; ?></td>
                                    <td class="clickable"
                                        onclick="location.href='crud/updateemp.php?id=<?php echo $employee['userID']; ?>';">
                                        <?php echo $employee['Fullname']; ?></td>
                                    <td class="clickable"
                                        onclick="location.href='crud/updateemp.php?id=<?php echo $employee['userID']; ?>';">
                                        <?php echo $employee['AppliedRole']; ?></td>
                                    <td class="clickable"
                                        onclick="location.href='crud/updateemp.php?id=<?php echo $employee['userID']; ?>';">
                                        <?php echo $employee['Date']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <script>
            // Function to handle deletion of selected employees
            function deleteSelected() {
                var checkboxes = document.querySelectorAll('input[name="selectedEmployees[]"]:checked');
                var employeeIDs = [];
                checkboxes.forEach(function (checkbox) {
                    employeeIDs.push(checkbox.value);
                });

                if (employeeIDs.length === 0) {
                    alert('Please select at least one employee to delete.');
                } else {
                    var confirmation = confirm('Are you sure you want to delete the selected employees?');
                    if (confirmation) {
                        // Redirect to delete script with selected employee IDs
                        window.location.href = 'crud/deleteemp.php?ids=' + employeeIDs.join(',');
                    }
                }
            }

            // Function to handle "select all" checkbox
            document.addEventListener("DOMContentLoaded", function () {
                var selectAllCheckbox = document.getElementById('select-all');
                var checkboxes = document.querySelectorAll('input[name="selectedEmployees[]"]');

                selectAllCheckbox.addEventListener('change', function () {
                    checkboxes.forEach(function (checkbox) {
                        checkbox.checked = selectAllCheckbox.checked;
                    });
                });
            });
        </script>

    </body>

</html>