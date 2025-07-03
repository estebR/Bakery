<?php
$servername = "localhost";
$username = "root";
$password = "kiramiso"; // likely empty unless you set one
$dbname = "bakery";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



// Collect and sanitize form data
$full_name = $conn->real_escape_string($_POST['full_name']);
$phone_number = $conn->real_escape_string($_POST['phone_number']);
$email = $conn->real_escape_string($_POST['email']);
$password_plain = $_POST['password'];

// Hash the password securely
$password_hashed = password_hash($password_plain, PASSWORD_DEFAULT);

// Insert into database
$sql = "INSERT INTO users (full_name, phone_number, email, password)
        VALUES ('$full_name', '$phone_number', '$email', '$password_hashed')";

if ($conn->query($sql) === TRUE) {
    header("Location: login.html");
    exit();

} else {
    echo "❌ Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
