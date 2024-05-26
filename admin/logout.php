<?php
// Start or resume session
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();


echo "<script> 
window.location.href = 'login.php';  
</script>";