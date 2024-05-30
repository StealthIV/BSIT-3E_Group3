<?php
require '../dbcon.php';

if (!isset($_GET['ids'])) {
    // Redirect to a suitable error page or back to the main page
    header("Location: ../account.php");
    exit();
}

// Fetch the IDs of the employees to delete from the query string
$roleIDs = explode(',', $_GET['ids']);

// Delete the selected employees from the database
try {
    // Prepare a SQL statement with placeholders for the IDs
    $sql = 'DELETE FROM accessright WHERE accessID IN (' . implode(',', array_fill(0, count($roleIDs), '?')) . ')';
    $stmt = $pdo->prepare($sql);
    $stmt->execute($roleIDs);
    // Redirect to the main page after deletion
    header("Location: ../access.php");
    exit();
} catch (PDOException $e) {
    // Handle errors gracefully, you can customize this as per your needs
    echo "Error: " . $e->getMessage();
}
?>
