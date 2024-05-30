<?php
session_start();
require 'dbcon.php';

// Check if the user is logged in

    session_destroy();
    header("Location: index.php");
    exit();

?>
