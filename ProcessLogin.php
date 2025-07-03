<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "kiramiso"; // your MySQL password
$dbname = "bakery";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get email and password from form
$email = $_POST['email'];
$password_plain = $_POST['password'];

// Retrieve user data from DB
$sql = "SELECT * FROM users WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    // Verify password
    if (password_verify($password_plain, $user['password'])) {
        // Password correct, set session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['full_name'] = $user['full_name'];
        $_SESSION['email'] = $user['email'];

        //echo "✅ Login successful! Welcome, " . $_SESSION['full_name'] . ".";
        header("Location: home.php");
        exit();

        // Redirect to dashboard if desired:
        // header("Location: dashboard.php");
        // exit();
    } else {
        echo "❌ Incorrect password.";
    }
} else {
    echo "❌ Email not found.";
}

$conn->close();
?>
