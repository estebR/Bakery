<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
include 'db.php';

$id = $_GET['id'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];

    $stmt = $conn->prepare("UPDATE menu SET name = ?, price = ? WHERE id = ?");
    $stmt->bind_param("sdi", $name, $price, $id);
    $stmt->execute();

    header("Location: admin_dashboard.php");
    exit();
}

$result = $conn->query("SELECT * FROM menu WHERE id = $id");
$item = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Menu Item</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="p-4">
  <h2>Edit Menu Item</h2>
  <form method="POST">
    <div class="mb-3">
      <label>Name</label>
      <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($item['name']) ?>" required>
    </div>
    <div class="mb-3">
      <label>Price</label>
      <input type="number" step="0.01" name="price" class="form-control" value="<?= $item['price'] ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Update Item</button>
    <a href="admin_dashboard.php" class="btn btn-secondary">Cancel</a>
  </form>
</body>
</html>
