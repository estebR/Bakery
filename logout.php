<?php
session_start();
session_unset();    // log out the user 
session_destroy();  // destroy the session

// Redirect to homepage or login page
header("Location: index.php");
exit();
?>
