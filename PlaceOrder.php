<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit;
}

require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';

$servername = "localhost";
$username = "u765616566_bakeryuser";
$password = "9;vJfy3j7DW?";
$dbname = "u765616566_Bakery";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$user_id = $_SESSION['user_id'];
$items = $_POST['items'] ?? [];
$custom_order = trim($_POST['custom_order'] ?? '');
$total_price = 0;

// Get the user informationn
$user_result = $conn->query("SELECT full_name, email FROM users WHERE id = $user_id");
$user = $user_result->fetch_assoc();
$user_name = $user['full_name'];
$user_email = $user['email'];

// Inserts the order with the total price 0 for now
$conn->query("INSERT INTO orders (user_id, order_date, total_price) VALUES ($user_id, NOW(), 0)");
$order_id = $conn->insert_id;

// Inserts each item into order_items table in the database
foreach ($items as $menu_id => $quantity) {
  $quantity = intval($quantity);
  if ($quantity > 0) {
    $result = $conn->query("SELECT name, price FROM menu WHERE id = $menu_id");
    $row = $result->fetch_assoc();
    $item_name = $row['name'];
    $item_price = $row['price'];
    $item_total = $item_price * $quantity;
    $total_price += $item_total;

    $stmt = $conn->prepare("INSERT INTO order_items (order_id, item_name, quantity, price) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isid", $order_id, $item_name, $quantity, $item_price);
    $stmt->execute();
    $stmt->close();
  }
}

// Insert custom order as a separate item with price 0, quantity 1, if any
if (!empty($custom_order)) {
  $custom_item_name = "Custom Order: " . $custom_order;
  $custom_quantity = 1;
  $custom_price = 0.00;

  $stmt = $conn->prepare("INSERT INTO order_items (order_id, item_name, quantity, price) VALUES (?, ?, ?, ?)");
  $stmt->bind_param("isid", $order_id, $custom_item_name, $custom_quantity, $custom_price);
  $stmt->execute();
  $stmt->close();
}

// Updates the total price in orders table
$conn->query("UPDATE orders SET total_price = $total_price WHERE id = $order_id");

// Prepare $order_items list to display it in the confirmationp age
$order_items = [];

foreach ($items as $menu_id => $quantity) {
    $quantity = intval($quantity);
    if ($quantity > 0) {
        $result = $conn->query("SELECT name, price FROM menu WHERE id = $menu_id");
        $row = $result->fetch_assoc();
        $order_items[] = [
            'name' => htmlspecialchars($row['name']),
            'quantity' => $quantity,
            'price' => $row['price'],
            'subtotal' => $row['price'] * $quantity,
        ];
    }
}

// Adds the  custom order if user has one
if (!empty($custom_order)) {
    $order_items[] = [
        'name' => htmlspecialchars($custom_item_name),
        'quantity' => 1,
        'price' => 0,
        'subtotal' => 0,
        'is_custom' => true,
    ];
}

$conn->close();

// Prepare email text with waht the useres ordered
$emailBody = "<h3>Hi $user_name,</h3>";
$emailBody .= "<p>Thank you for your order from Sweet Hour Bakery!</p>";
$emailBody .= "<table border='1' cellpadding='6' cellspacing='0' style='border-collapse: collapse;'>";
$emailBody .= "<tr><th>Item</th><th>Qty</th><th>Price</th><th>Subtotal</th></tr>";

foreach ($order_items as $item) {
    $emailBody .= "<tr>";
    $emailBody .= "<td>{$item['name']}</td>";
    $emailBody .= "<td>{$item['quantity']}</td>";
    if (!empty($item['is_custom'])) {
        $emailBody .= "<td>To be determined</td><td>—</td>";
    } else {
        $emailBody .= "<td>$" . number_format($item['price'], 2) . "</td>";
        $emailBody .= "<td>$" . number_format($item['subtotal'], 2) . "</td>";
    }
    $emailBody .= "</tr>";
}

$emailBody .= "<tr><td colspan='3' style='text-align:right; font-weight:bold;'>Total:</td><td><strong>$" . number_format($total_price, 2) . "</strong></td></tr></table>";

if (!empty($custom_order)) {
  $emailBody .= "<p><strong>Custom Notes:</strong> " . htmlspecialchars($custom_order) . "</p>";
}

$emailBody .= "<p>We appreciate your business!</p>";

// Sends the confirmation email to user
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
  $mail->addAddress($user_email, $user_name);
  $mail->isHTML(true);
  $mail->Subject = 'Your Sweet Hour Bakery Order Confirmation';
  $mail->Body    = $emailBody;
  $mail->send();
} catch (Exception $e) {
  error_log("Order email failed: {$mail->ErrorInfo}");
}

// Send the confrimation email to clients email

$ownerEmail = 'no-reply@sweethour.shop';   // <-- change later when you know it
$ownerName  = 'Sweet Hour Orders';

// Build an admin body (reuse the same receipt table)
$adminBody  = "<h3>New order received</h3>";
$adminBody .= "<p><strong>Order ID:</strong> $order_id<br>";
$adminBody .= "<strong>Customer:</strong> " . htmlspecialchars($user_name) . " (" . htmlspecialchars($user_email) . ")</p>";
$adminBody .= $emailBody; // reuse the same receipt HTML sent to user

$admin = new PHPMailer(true);
try {
  $admin->isSMTP();
  $admin->Host       = 'smtp.hostinger.com';
  $admin->SMTPAuth   = true;
  $admin->Username   = 'no-reply@sweethour.shop';
  $admin->Password   = 'Sweethour@1';
  $admin->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
  $admin->Port       = 587;

  $admin->setFrom('no-reply@sweethour.shop', 'Sweet Hour Bakery');
  $admin->addAddress($ownerEmail, $ownerName);
  // So the owner can reply directly to the customer if needed:
  $admin->addReplyTo($user_email, $user_name);

  $admin->isHTML(true);
  $admin->Subject = "New Order #$order_id from $user_name";
  $admin->Body    = $adminBody;

  $admin->send();
} catch (Exception $e) {
  error_log("Admin order email failed: {$admin->ErrorInfo}");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Order Confirmation - Sweet Hour Bakery</title>
  <link rel="stylesheet" href="/assets/css/navbar.css" />
  <link rel="stylesheet" href="/assets/css/login.css" />
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Quicksand&display=swap" rel="stylesheet" />
  <style>
    body {
      font-family: 'Quicksand', sans-serif;
      background-color: #fffaf5;
    }
    .summary-box {
      max-width: 700px;
      margin: 30px auto;
      border: 1px solid #ccc;
      padding: 20px;
      border-radius: 12px;
      background: #fff;
    }
    table {
      width: 100%;
      border-collapse: collapse;
    }
    th, td {
      padding: 8px;
    }
    th {
      text-align: left;
      border-bottom: 1px solid #ccc;
    }
    td:last-child, th:last-child {
      text-align: right;
    }
    .footer {
      margin-top: 50px;
      padding: 20px;
      color: #666;
      font-size: 14px;
    }
  </style>
</head>
<body>

<?php include 'components/navbar.php'; ?>

<main class="container py-5">
  <div class="summary-box">
    <h2>✅ Order submitted!</h2>
    <h3>Order Summary</h3>
    <table>
      <tr>
        <th>Item</th>
        <th>Qty</th>
        <th>Price</th>
        <th>Subtotal</th>
      </tr>

      <?php foreach ($order_items as $item): ?>
      <tr>
        <td><?= $item['name'] ?></td>
        <td><?= $item['quantity'] ?></td>
        <td>
          <?= !empty($item['is_custom']) ? 'To be determined' : '$' . number_format($item['price'], 2) ?>
        </td>
        <td>
          <?= !empty($item['is_custom']) ? '—' : '$' . number_format($item['subtotal'], 2) ?>
        </td>
      </tr>
      <?php endforeach; ?>

      <tr>
        <td colspan="3" style="text-align:right; font-weight:bold;">Total:</td>
        <td style="font-weight:bold;">$<?= number_format($total_price, 2) ?></td>
      </tr>
    </table>

    <?php if (!empty($custom_order)): ?>
      <p><strong>Custom Notes:</strong> <?= htmlspecialchars($custom_order) ?></p>
    <?php endif; ?>
  </div>
</main>

<footer class="footer text-center">
  <p class="text-muted">Contact us at info@sweettreats.com | Hamden, CT</p>
</footer>

</body>
</html>

