<?php
session_start();
 
// DB connection
$servername = "localhost";
$username = "bakeryuser"; // Hostinger's DB username
$password = "Bakery@2025"; // Hostinger's DB password
$dbname = "Bakery";
 
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
 
// Get credentials from form
$email = $_POST['email'];
$password_plain = $_POST['password'];
 
// First check if it's an admin login
$sql_admin = "SELECT * FROM admin WHERE username = '$email'";
$result_admin = $conn->query($sql_admin);
 
if ($result_admin->num_rows > 0) {
    // Admin found
    $admin = $result_admin->fetch_assoc();
    if (password_verify($password_plain, $admin['password'])) {
        // Admin login successful, set session
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_username'] = $admin['username'];
        $_SESSION['role'] = 'admin'; // Store admin role in session
        header("Location: admin_dashboard.php");
        exit();
    } else {
        echo "❌ Incorrect password for admin.";
    }
} else {
    // If it's not an admin, check in the users table
    $sql_user = "SELECT * FROM users WHERE email = '$email'";
    $result_user = $conn->query($sql_user);
 
    if ($result_user->num_rows > 0) {
        // User found
        $user = $result_user->fetch_assoc();
        if (password_verify($password_plain, $user['password'])) {
            // User login successful, set session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['full_name'] = $user['full_name'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = 'user'; // Store user role in session
            header("Location: home.php");
            exit();
        } else {
            echo "❌ Incorrect password for user.";
        }
    } else {
        echo "❌ Email not found.";
    }
}
 
$conn->close();
?>
 
 