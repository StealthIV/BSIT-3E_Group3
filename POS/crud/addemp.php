<?php
require '../dbcon.php'; // Include database connection file

// Retrieve form data
$fullname = $_POST['Fullname'];
$selectedRole = explode('|', $_POST['AppliedRole']); 
$accessID = $selectedRole[0];
$roleName = $selectedRole[1];
$date = $_POST['Date'];

// Retrieve pincode from form data
$pincode = $_POST['pincode'];

// Check if the pincode is valid (4 digits)
if (!preg_match("/^\d{4}$/", $pincode)) {
    // Redirect back with an error message if the pincode is invalid
    header("Location: ../account.php?error=invalid_pincode");
    exit();
}

// Insert the employee details into the database along with the pincode
$stmt = $pdo->prepare('INSERT INTO emp (Fullname, accessID, AppliedRole, date, pincode) VALUES (?, ?, ?, ?, ?)');
$stmt->execute([$fullname, $accessID, $roleName, $date, $pincode]);

// Redirect back to the employee list page
header("Location: ../account.php");
exit();
?>
