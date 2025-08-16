<?php
session_start();

// Database connection
$servername = "localhost";
$username = "u765616566_bakeryuser"; // Hostinger DB username
$password = "9;vJfy3j7DW?";         // Hostinger DB password
$dbname = "u765616566_Bakery";      // Hostinger DB name

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Gets the users  email, password, and role from login form
$email = $_POST['email'];
$password_plain = $_POST['password'];
$role = $_POST['role'];  // Gets the role (either 'admin' or 'user')

if ($role === 'admin') {
    // Admin login query
    $sql = "SELECT * FROM admin WHERE username = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Verifies admins  password
        if (password_verify($password_plain, $user['password'])) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_username'] = $user['username'];
            $_SESSION['role'] = 'admin'; // Set session role as admin
            header("Location: admin_dashboard.php");
            exit();
        } else {
            echo "❌ Incorrect password for admin.";
        }
    } else {
        echo "❌ Admin email not found.";
    }
} else {
    // User login query
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Verifies the users password
        if (password_verify($password_plain, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['full_name'] = $user['full_name'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = 'user'; 
            header("Location: index.php");
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

