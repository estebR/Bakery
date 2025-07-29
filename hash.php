<?php
$password = 'Admin123!';
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
echo "Hashed password: " . $hashedPassword;
?>