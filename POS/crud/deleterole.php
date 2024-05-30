<?php
require '../dbcon.php';

if (!isset($_GET['ids'])) {
    header("Location: ../account.php");
    exit();
}

$roleIDs = explode(',', $_GET['ids']);

try {
    $sql = 'DELETE FROM accessright WHERE accessID IN (' . implode(',', array_fill(0, count($roleIDs), '?')) . ')';
    $stmt = $pdo->prepare($sql);
    $stmt->execute($roleIDs);
    header("Location: ../account.php");
    exit();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
