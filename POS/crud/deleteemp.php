<?php
require '../dbcon.php';

// Check if the IDs of the employees to delete are provided in the query string
if (!isset($_GET['ids'])) {
    header("Location: ../account.php?error=ids_not_provided");
    exit();
}

// Fetch the IDs of the employees to delete from the query string
$employeeIDs = explode(',', $_GET['ids']);

// Delete the selected employees from the database
try {
    $sql = 'DELETE FROM emp WHERE userID IN (' . implode(',', array_fill(0, count($employeeIDs), '?')) . ')';
    $stmt = $pdo->prepare($sql);
    $stmt->execute($employeeIDs);
    
    header("Location: ../account.php?success=employees_deleted");
    exit();
} catch (PDOException $e) {
    header("Location: ../account.php?error=" . urlencode($e->getMessage()));
    exit();
}
?>
