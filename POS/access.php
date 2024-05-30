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
try {
    // Execute the query to count the number of employees for each role and access
    $stmt = $pdo->query('SELECT ar.accessID, ar.name, ar.access, COUNT(e.userID) AS EmployeeCount
                         FROM accessright ar
                         LEFT JOIN emp e ON ar.accessID = e.accessID
                         GROUP BY ar.accessID, ar.name, ar.access');
    $roleAccessCounts = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
            <li class="dropdown">
                <a class="dropdown-btn active">Employees <span class="dropdown-icon">&#9662;</span></a>
                <div class="dropdown-container">
                    <a href="account.php">Employee List</a>
                    <a href="access.php" class="active">Access Rights</a>
                    <a href="time.php">Timecards</a>
                    <a href="totalhour.php">Total Hours Worked</a>
                </div>
            </li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>


    <script src="sample.js"></script>

    <div class="container">
        <div class="header">
            <h2>Role and Access Summary</h2>
            <a href="crud/addaccess.php" class="add-employee-btn">Add Role</a>
            <button onclick="deleteSelected()" class="delete-button">Delete Selected</button>
        </div>

        <div class="table-wrapper">
            <div class="table">
                <table>
                    <thead>
                        <tr>
                            <th class="align-left"><input type="checkbox" id="select-all"></th>
                            <th class="align-left">No</th>
                            <th class="align-left">Role</th>
                            <th class="align-left">Access</th>
                            <th class="align-left">Employee Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($roleAccessCounts as $index => $roleAccessCount): ?>
                            <tr>
                                <td><input type="checkbox" name="selectedRoles[]"
                                        value="<?php echo $roleAccessCount['accessID']; ?>"></td>
                                <td>
                                    <?php echo $index + 1; ?>
                                </td>
                                <td onclick="location.href='crud/updateaccess.php?id=<?php echo $roleAccessCount['accessID']; ?>';"
                                    style="cursor: pointer;">
                                    <?php echo $roleAccessCount['name']; ?>
                                </td>
                                <td onclick="location.href='crud/updateaccess.php?id=<?php echo $roleAccessCount['accessID']; ?>';"
                                    style="cursor: pointer;">
                                    <?php echo $roleAccessCount['access']; ?>
                                </td>
                                <td onclick="location.href='crud/updateaccess.php?id=<?php echo $roleAccessCount['accessID']; ?>';"
                                    style="cursor: pointer;">
                                    <?php echo $roleAccessCount['EmployeeCount']; ?>
                                </td>
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
            var checkboxes = document.querySelectorAll('input[name="selectedRoles[]"]:checked');
            var roleIDs = [];
            checkboxes.forEach(function (checkbox) {
                roleIDs.push(checkbox.value);
            });

            if (roleIDs.length === 0) {
                alert('Please select at least one role to delete.');
            } else {
                var confirmation = confirm('Are you sure you want to delete the selected roles?');
                if (confirmation) {
                    // Redirect to delete script with selected role IDs
                    window.location.href = 'crud/deleteaccess.php?ids=' + roleIDs.join(',');
                }
            }
        }

        // Function to handle "select all" checkbox
        document.addEventListener("DOMContentLoaded", function () {
            var selectAllCheckbox = document.getElementById('select-all');
            var checkboxes = document.querySelectorAll('input[name="selectedRoles[]"]');

            selectAllCheckbox.addEventListener('change', function () {
                checkboxes.forEach(function (checkbox) {
                    checkbox.checked = selectAllCheckbox.checked;
                });
            });
        });
    </script>
</body>

</html>