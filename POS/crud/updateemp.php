<?php
require '../dbcon.php';
session_start();

// Check if the employee ID is provided
if (!isset($_GET['id'])) {
    header("Location: ../edit.php");
    exit();
}

$username = $_SESSION['username'];
$userID = $_SESSION['userID'];

try {
    $stmt = $pdo->prepare('SELECT * FROM emp WHERE userID = ?');
    $stmt->execute([$_GET['id']]);
    $employee = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if the employee exists
    if (!$employee) {
        header("Location: ../account.php");
        exit();
    }
} catch (PDOException $e) {
    header("Location: ../error.php?message=" . urlencode($e->getMessage()));
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    // Process update here
    try {
        $fullname = $_POST['fullname'];
        $appliedRole = explode('|', $_POST['applied_role'])[1]; 
        $accessID = explode('|', $_POST['applied_role'])[0];
        $date = $_POST['date'];
        $pincode = $_POST['pincode']; // Get pincode from the form

        // Update employee details including pincode
        $stmt = $pdo->prepare('UPDATE emp SET Fullname = ?, AppliedRole = ?, AccessID = ?, Date = ?, pincode = ? WHERE userID = ?');
        $stmt->execute([$fullname, $appliedRole, $accessID, $date, $pincode, $_GET['id']]);

        // Redirect to a suitable page after successful update
        header("Location: ../account.php");
        exit();
    } catch (PDOException $e) {
        header("Location: ../error.php?message=" . urlencode($e->getMessage()));
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/account.css">
    <title>Update Employee</title>
</head>

<body>
    <div class="navigator">
        <div class="right-align">
            <img src="../img/12.png" alt="">
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
                    <a href="../account.php" class="active">Employee List</a>
                    <a href="../access.php">Access Rights</a>
                    <a href="../time.php">Timecards</a>
                    <a href="../totalhour.php">Total Hours Worked</a>
                </div>
            </li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>

    <script src="../sample.js"></script>

    <div class="container">
        <h2>Update Employee</h2>
        <form action="" method="post">
            <input type="hidden" name="id" value="<?php echo $employee['userID']; ?>">
            <label for="fullname">Full Name:</label>
            <input type="text" id="fullname" name="fullname" value="<?php echo $employee['Fullname']; ?>">
            <label for="applied_role">Applied Role:</label>
            <select id="role" name="applied_role" required>
                <option value="">Select Role</option>
                <?php
                require '../dbcon.php'; // Include database connection file
                
                // Fetch roles with their corresponding accessIDs from the accessright table
                $stmt = $pdo->query('SELECT accessID, name FROM accessright');
                $roles = $stmt->fetchAll(PDO::FETCH_ASSOC);

                // Output each role as an option in the select dropdown
                foreach ($roles as $role) {
                    $selected = ($role['name'] === $employee['AppliedRole']) ? 'selected' : '';
                    echo "<option value=\"{$role['accessID']}|{$role['name']}\" data-access-id=\"{$role['accessID']}\" $selected>{$role['name']}</option>";
                }
                ?>
            </select>

            <label for="date">Application Date:</label>
            <input type="date" id="date" name="date" value="<?php echo $employee['Date']; ?>" readonly>

            <div class="form-group">
    <label for="pincode">Pincode (4 digits):</label>
    <div class="pincode-input">
        <input type="text" id="pincode" name="pincode" pattern="\d{4}" title="Pincode must be 4 digits" maxlength="4" required value="<?php echo isset($employee['pincode']) ? $employee['pincode'] : ''; ?>">
    </div>
</div>


            <button type="submit" name="update">Update</button>
        </form>
    </div>


    <script>
        document.getElementById('role').addEventListener('change', function () {
            var selectedOption = this.options[this.selectedIndex];
            var accessID = selectedOption.getAttribute('data-access-id');
            document.getElementById('access_id').value = accessID;
        });

    </script>

    <script>
        document.getElementById('pincode').addEventListener('input', function (event) {
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