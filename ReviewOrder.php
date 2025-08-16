<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: order.php'); exit; }

// Database connection
$servername = "localhost";
$username = "u765616566_bakeryuser";
$password = "9;vJfy3j7DW?";
$dbname = "u765616566_Bakery";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) die("DB connection failed: " . $conn->connect_error);

// Get the posted data
$items = $_POST['items'] ?? [];
$custom_order = $_POST['custom_order'] ?? '';

$total = 0.0;

// Fetch the names as long as items are greater than 0
$selected = [];
foreach ($items as $id => $qty) {
  $qty = (int)$qty;
  if ($qty > 0) {
    $id = (int)$id;
    $res = $conn->query("SELECT id, name, price FROM menu WHERE id = $id");
    if ($res && $row = $res->fetch_assoc()) {
      $row['qty'] = $qty;
      $row['subtotal'] = $qty * (float)$row['price'];
      $total += $row['subtotal'];
      $selected[] = $row;
    }
  }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Review Order - Sweet Hour Bakery</title>
  <link rel="stylesheet" href="/assets/css/navbar.css">
  <link rel="stylesheet" href="/assets/css/login.css">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Quicksand&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Quicksand', sans-serif; background:#fffaf5; }
    .box { max-width: 700px; margin: 30px auto; background:#fff; border:1px solid #ddd; border-radius:12px; padding:20px; }
    table { width:100%; border-collapse:collapse; }
    th, td { padding:8px; border-bottom:1px solid #eee; }
    th { text-align:left; }
    td:last-child, th:last-child { text-align:right; }
    .actions { display:flex; gap:10px; justify-content:flex-end; margin-top:18px; }
    .btn { padding:10px 16px; border-radius:8px; border:0; cursor:pointer; }
    .btn-secondary { background:#e5e7eb; }
    .btn-primary { background:#7ec982; color:#111; }
  </style>
</head>
<body>

<?php include 'components/navbar.php'; ?>

<main class="container py-5">
  <div class="box">
    <h2>Review Your Order</h2>

    <?php if (empty($selected)): ?>
      <p>No items selected. <a href="order.php">Go back</a> and add something delicious 😊</p>
    <?php else: ?>
      <table>
        <tr>
          <th>Item</th>
          <th>Qty</th>
          <th>Price</th>
          <th>Subtotal</th>
        </tr>
        <?php foreach ($selected as $row): ?>
          <tr>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= (int)$row['qty'] ?></td>
            <td>$<?= number_format((float)$row['price'], 2) ?></td>
            <td>$<?= number_format((float)$row['subtotal'], 2) ?></td>
          </tr>
        <?php endforeach; ?>
        <tr>
          <td colspan="3" style="text-align:right; font-weight:600;">Total</td>
          <td style="font-weight:600;">$<?= number_format($total, 2) ?></td>
        </tr>
      </table>

      <?php if (!empty($custom_order)): ?>
        <p><strong>Custom Notes:</strong> <?= htmlspecialchars($custom_order) ?></p>
      <?php endif; ?>

      <div class="actions">
        <form action="order.php" method="get">
          <button type="submit" class="btn btn-secondary">Go Back & Edit</button>
        </form>

        <form action="PlaceOrder.php" method="post">
          <?php foreach ($items as $id => $qty): ?>
            <input type="hidden" name="items[<?= (int)$id ?>]" value="<?= (int)$qty ?>">
          <?php endforeach; ?>
          <input type="hidden" name="custom_order" value="<?= htmlspecialchars($custom_order) ?>">
          <button type="submit" class="btn btn-primary">Confirm & Submit</button>
        </form>
      </div>
    <?php endif; ?>
  </div>
</main>

</body>
</html>
