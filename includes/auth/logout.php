<?php

session_start(); // Start the session
session_unset(); // Clear all session variables
session_destroy(); // Destroy the session
header("Location: ../../index.php");
exit();
?>
