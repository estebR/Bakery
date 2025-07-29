<?php
echo "<pre>";
print_r($_POST);
echo "</pre>";

session_start();

$servername = "localhost";
$username = "u765616566_bakeryuser"; // Full username
$password = "9;vJfy3j7DW?";
$dbname = "u765616566_Bakery"; // ✅ Fixed DB name

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_POST['email'];
$password_plain = $_POST['password'];
$role = $_POST['role']; // "user" or "admin"

if ($role === "admin") {
    $sql = "SELECT * FROM admin WHERE username = '$email'";
} else {
    $sql = "SELECT * FROM users WHERE email = '$email'";
}

echo "<pre>SQL: $sql</pre>";


$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    if (password_verify($password_plain, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $role === "admin" ? $user['username'] : $user['email'];
        $_SESSION['role'] = $role;

        if ($role === "admin") {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_username'] = $user['username'];
            header("Location: admin_dashboard.php");
        } else {
            header("Location: home.php");
        }
        exit();
    } else {
        echo "❌ Incorrect password.";
    }
} else {
    echo "❌ Email/Username not found.";
}

$conn->close();
?>

