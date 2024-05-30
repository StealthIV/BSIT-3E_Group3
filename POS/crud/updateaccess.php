<?php
require '../dbcon.php'; // Assuming this file contains the database connection
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to the login page if the user is not logged in
    header("Location: index.php");
    exit();
}

$username = $_SESSION['username'];
$userID = $_SESSION['userID'];

// Fetch the employee details from the database based on the provided ID
try {
    $stmt = $pdo->prepare('SELECT * FROM accessright WHERE accessID = ?');
    $stmt->execute([$_GET['id']]);
    $roleAccessCount = $stmt->fetch(PDO::FETCH_ASSOC);
    // Check if the employee exists
    if (!$roleAccessCount) {
        header("Location: ../access.php");
        exit();
    }
} catch (PDOException $e) {
    header("Location: ../error.php?message=" . urlencode($e->getMessage()));
    exit();
}


// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $access = '';
        if (isset($_POST['pos'])) {
            $access .= 'pos,'; // Include POS if checked
        }
        if (isset($_POST['back_office'])) {
            $access .= 'back_office,'; // Include Back Office if checked
        }

        // Remove trailing comma
        $access = rtrim($access, ',');

        // Intermediate variables to ensure only variables are passed to bindParam
        $accept = isset($_POST['accept']) ? 1 : 0;
        $discounts = isset($_POST['discounts']) ? 1 : 0;
        $taxes = isset($_POST['taxes']) ? 1 : 0;
        $drawer = isset($_POST['drawer']) ? 1 : 0;
        $viewreceipts = isset($_POST['viewreceipts']) ? 1 : 0;
        $refunds = isset($_POST['refunds']) ? 1 : 0;
        $Reprint = isset($_POST['Reprint']) ? 1 : 0;
        $shift = isset($_POST['shift']) ? 1 : 0;
        $Manageitem = isset($_POST['Manageitem']) ? 1 : 0;
        $costitem = isset($_POST['costitem']) ? 1 : 0;
        $settings = isset($_POST['settings']) ? 1 : 0;
        $bViewsales = isset($_POST['bViewsales']) ? 1 : 0;
        $bmanageitem = isset($_POST['bmanageitem']) ? 1 : 0;
        $bviewcost = isset($_POST['bviewcost']) ? 1 : 0;
        $bmanageemployee = isset($_POST['bmanageemployee']) ? 1 : 0;
        $bmanagecustomers = isset($_POST['bmanagecustomers']) ? 1 : 0;
        $bmanagefeatured = isset($_POST['bmanagefeatured']) ? 1 : 0;
        $bmanagebilling = isset($_POST['bmanagebilling']) ? 1 : 0;
        $bmanagepayment = isset($_POST['bmanagepayment']) ? 1 : 0;
        $bmanageloyalty = isset($_POST['bmanageloyalty']) ? 1 : 0;
        $bmanagetaxes = isset($_POST['bmanagetaxes']) ? 1 : 0;

        // Prepare a SQL statement to insert/update the role and access
        $stmt = $pdo->prepare("UPDATE accessright SET 
            name = :name, 
            access = :access, 
            accept = :accept, 
            discounts = :discounts, 
            taxes = :taxes, 
            drawer = :drawer, 
            viewreceipts = :viewreceipts, 
            refunds = :refunds, 
            Reprint = :Reprint, 
            shift = :shift, 
            Manageitem = :Manageitem, 
            costitem = :costitem, 
            settings = :settings, 
            bViewsales = :bViewsales, 
            bmanageitem = :bmanageitem, 
            bviewcost = :bviewcost, 
            bmanageemployee = :bmanageemployee, 
            bmanagecustomers = :bmanagecustomers, 
            bmanagefeatured = :bmanagefeatured, 
            bmanagebilling = :bmanagebilling, 
            bmanagepayment = :bmanagepayment, 
            bmanageloyalty = :bmanageloyalty, 
            bmanagetaxes = :bmanagetaxes
            WHERE accessID = :accessID");

        // Bind parameters
        $stmt->bindParam(':accessID', $_GET['id']); // Bind accessID from the URL
        $stmt->bindParam(':name', $_POST['Fullname']);
        $stmt->bindParam(':access', $access);
        $stmt->bindParam(':accept', $accept);
        $stmt->bindParam(':discounts', $discounts);
        $stmt->bindParam(':taxes', $taxes);
        $stmt->bindParam(':drawer', $drawer);
        $stmt->bindParam(':viewreceipts', $viewreceipts);
        $stmt->bindParam(':refunds', $refunds);
        $stmt->bindParam(':Reprint', $Reprint);
        $stmt->bindParam(':shift', $shift);
        $stmt->bindParam(':Manageitem', $Manageitem);
        $stmt->bindParam(':costitem', $costitem);
        $stmt->bindParam(':settings', $settings);
        $stmt->bindParam(':bViewsales', $bViewsales);
        $stmt->bindParam(':bmanageitem', $bmanageitem);
        $stmt->bindParam(':bviewcost', $bviewcost);
        $stmt->bindParam(':bmanageemployee', $bmanageemployee);
        $stmt->bindParam(':bmanagecustomers', $bmanagecustomers);
        $stmt->bindParam(':bmanagefeatured', $bmanagefeatured);
        $stmt->bindParam(':bmanagebilling', $bmanagebilling);
        $stmt->bindParam(':bmanagepayment', $bmanagepayment);
        $stmt->bindParam(':bmanageloyalty', $bmanageloyalty);
        $stmt->bindParam(':bmanagetaxes', $bmanagetaxes);

        $stmt->execute();

        header("Location: ../access.php");

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
    <link rel="stylesheet" href="../style/access.css">
    <title>Update Role</title>
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
                    <a href="../account.php" >Employee List</a>
                    <a href="../access.php" class="active">Access Rights</a>
                    <a href="../time.php">Timecards</a>
                    <a href="../totalhour.php">Total Hours Worked</a>
                </div>
            </li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        var dropdownBtns = document.querySelectorAll(".dropdown-btn");

        dropdownBtns.forEach(function (btn) {
            btn.addEventListener("click", function () {
                var dropdownContainer = this.nextElementSibling;
                dropdownContainer.classList.toggle("active");
                this.classList.toggle("active");
            });
        });
    });
</script>


    <div class="container">
        <h2>Update Role:</h2>
        <form action="updateaccess.php?id=<?php echo $_GET['id']; ?>" method="POST">
            <label for="fullname">Name:</label>
            <input type="text" id="Fullname" name="Fullname"
                value="<?php echo htmlspecialchars($roleAccessCount['name']); ?>" required><br><br>

            <!-- POS Toggle Button -->
            <label for="pos">POS:</label>
            <input type="checkbox" id="pos" name="pos" class="toggle-btn" <?php if (strpos($roleAccessCount['access'], 'pos') !== false)
                echo 'checked'; ?>><br><br>

            <!-- Additional options for POS -->
            <div class="additional-options" id="pos-options" <?php if (strpos($roleAccessCount['access'], 'pos') === false)
                echo 'style="display: none;"'; ?>>
                <label><input type="checkbox" name="accept" <?php if ($roleAccessCount['accept'])
                    echo 'checked'; ?>>
                    Accept payments</label>
                <label><input type="checkbox" name="discounts" <?php if ($roleAccessCount['discounts'])
                    echo 'checked'; ?>> Apply discounts with restricted access</label>
                <label><input type="checkbox" name="taxes" <?php if ($roleAccessCount['taxes'])
                    echo 'checked'; ?>>
                    Change taxes in a sale</label>
                <label><input type="checkbox" name="drawer" <?php if ($roleAccessCount['drawer'])
                    echo 'checked'; ?>>
                    Open cash drawer without making a sale</label>
                <label><input type="checkbox" name="viewreceipts" <?php if ($roleAccessCount['viewreceipts'])
                    echo 'checked'; ?>> View all receipts</label>
                <label><input type="checkbox" name="refunds" <?php if ($roleAccessCount['refunds'])
                    echo 'checked'; ?>>
                    Perform refunds</label>
                <label><input type="checkbox" name="Reprint" <?php if ($roleAccessCount['Reprint'])
                    echo 'checked'; ?>>
                    Reprint and resend receipts</label>
                <label><input type="checkbox" name="shift" <?php if ($roleAccessCount['shift'])
                    echo 'checked'; ?>> View
                    shift report</label>
                <label><input type="checkbox" name="Manageitem" <?php if ($roleAccessCount['Manageitem'])
                    echo 'checked'; ?>> Manage items</label>
                <label><input type="checkbox" name="costitem" <?php if ($roleAccessCount['costitem'])
                    echo 'checked'; ?>> View cost of items</label>
                <label><input type="checkbox" name="settings" <?php if ($roleAccessCount['settings'])
                    echo 'checked'; ?>> Change settings</label>
            </div>

            <!-- Back Office Toggle Button -->
            <label for="back_office">Back Office:</label>
            <input type="checkbox" id="back_office" name="back_office" class="toggle-btn" <?php if (strpos($roleAccessCount['access'], 'back_office') !== false)
                echo 'checked'; ?>><br><br>

            <!-- Additional options for Back Office -->
            <div class="additional-options" id="back-office-options" <?php if (strpos($roleAccessCount['access'], 'back_office') === false)
                echo 'style="display: none;"'; ?>>
                <label><input type="checkbox" name="bViewsales" <?php if ($roleAccessCount['bViewsales'])
                    echo 'checked'; ?>> View sales reports</label>
                <label><input type="checkbox" name="bcancelreceipts" <?php if ($roleAccessCount['bmanageitem'])
                    echo 'checked'; ?>> Cancel receipts</label>
                <label><input type="checkbox" name="bmanageitem" <?php if ($roleAccessCount['bmanageitem'])
                    echo 'checked'; ?>> Manage items</label>
                <label><input type="checkbox" name="bviewcost" <?php if ($roleAccessCount['bviewcost'])
                    echo 'checked'; ?>> View cost of items</label>
                <label><input type="checkbox" name="bmanageemployee" <?php if ($roleAccessCount['bmanageemployee'])
                    echo 'checked'; ?>> Manage employees</label>
                <label><input type="checkbox" name="bmanagecustomers" <?php if ($roleAccessCount['bmanagecustomers'])
                    echo 'checked'; ?>> Manage customers</label>
                <label><input type="checkbox" name="bmanagefeatured" <?php if ($roleAccessCount['bmanagefeatured'])
                    echo 'checked'; ?>> Manage feature settings</label>
                <label><input type="checkbox" name="bmanagebilling" <?php if ($roleAccessCount['bmanagebilling'])
                    echo 'checked'; ?>> Manage billing</label>
                <label><input type="checkbox" name="bmanagepayment" <?php if ($roleAccessCount['bmanagepayment'])
                    echo 'checked'; ?>> Manage payment types</label>
                <label><input type="checkbox" name="bmanageloyalty" <?php if ($roleAccessCount['bmanageloyalty'])
                    echo 'checked'; ?>> Manage loyalty program</label>
                <label><input type="checkbox" name="bmanagetaxes" <?php if ($roleAccessCount['bmanagetaxes'])
                    echo 'checked'; ?>> Manage taxes</label>
            </div>

            <button type="submit">Update Role</button>
        </form>
    </div>

    <script>
        document.getElementById('pos').addEventListener('change', function () {
            var posOptions = document.getElementById('pos-options');
            posOptions.style.display = this.checked ? 'block' : 'none';
        });

        document.getElementById('back_office').addEventListener('change', function () {
            var backOfficeOptions = document.getElementById('back-office-options');
            backOfficeOptions.style.display = this.checked ? 'block' : 'none';
        });
    </script>

</body>

</html>