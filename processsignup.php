<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Including the PHPMailer classes
require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';

// Database connection
$servername = "localhost";
$username   = "u765616566_bakeryuser";
$password   = "9;vJfy3j7DW?"; 
$dbname     = "u765616566_Bakery";

// Create Database connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Database connection failed.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $conn->real_escape_string($_POST['full_name'] ?? '');
    $email     = $conn->real_escape_string($_POST['email'] ?? '');
    $password_plain = $_POST['password'] ?? '';

    if (empty($full_name) || empty($email) || empty($password_plain)) {
        die("All fields are required.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format.");
    }

    $password_hashed = password_hash($password_plain, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (full_name, email, password) VALUES ('$full_name', '$email', '$password_hashed')";
    if ($conn->query($sql) === TRUE) {
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.hostinger.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'no-reply@sweethour.shop';
            $mail->Password   = 'Sweethour@1';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            $mail->setFrom('no-reply@sweethour.shop', 'Sweet Hour Bakery');
            $mail->addAddress($email, $full_name);
            $mail->isHTML(true);
            $mail->Subject = 'Welcome to Sweet Hour Bakery!';
            $mail->Body    = "<h3>Welcome, $full_name!</h3><p>Thank you for signing up at Sweet Hour Bakery.</p>";

            $mail->send();
        } catch (Exception $e) {
            error_log("Email failed: {$mail->ErrorInfo}");
        }

        header("Location: login.php");
        exit();
    } else {
        if (str_contains($conn->error, 'Duplicate entry')) {
            die("That email is already registered.");
        } else {
            die("Something went wrong. Please try again.");
        }
    }
} else {
    die("Invalid request.");
}

$conn->close();
?>
