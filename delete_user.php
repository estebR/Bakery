<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: admin_dashboard.php");
    exit();
}

$user_id = intval($_GET['id']);

$servername = "localhost";
$username = "u765616566_bakeryuser";
$password = "9;vJfy3j7DW?";
$dbname = "u765616566_Bakery";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("DB connection failed: " . $conn->connect_error);
}

// Begins the transaction
$conn->begin_transaction();

try {
    // Delete order items for user's orders
    $stmt = $conn->prepare("DELETE oi FROM order_items oi JOIN orders o ON oi.order_id = o.id WHERE o.user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->close();

    // Delete orders for the user
    $stmt = $conn->prepare("DELETE FROM orders WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->close();

    // Delete the user
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->close();

    $conn->commit();
} catch (Exception $e) {
    $conn->rollback();
    die("Failed to delete user: " . $e->getMessage());
}

$conn->close();

header("Location: admin_dashboard.php?msg=User+deleted+successfully");
exit();
?>
