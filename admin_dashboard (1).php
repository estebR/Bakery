<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

// DB connection
$servername = "localhost";
$username = "u765616566_bakeryuser";
$password = "9;vJfy3j7DW?";
$dbname = "u765616566_Bakery";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("DB connection failed: " . $conn->connect_error);
}

$menuResult = $conn->query("SELECT * FROM menu");
$userResult = $conn->query("SELECT id, full_name, email FROM users");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .container {
      margin-top: 40px;
    }
    .logout-btn {
      float: right;
    }
    .table th, .table td {
      vertical-align: middle;
    }
  </style>
</head>
<body>

<div class="container">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="text-primary">🍰 Admin Dashboard</h1>
    <a href="logout.php" class="btn btn-outline-danger logout-btn">🚪 Logout</a>
  </div>

  <!-- Menu Items -->
  <div class="card mb-4">
    <div class="card-header bg-warning text-white d-flex justify-content-between align-items-center">
      <h5 class="mb-0">📋 Menu Items</h5>
      <a href="add_menu.php" class="btn btn-light btn-sm">➕ Add Item</a>
    </div>
    <div class="card-body p-0">
      <table class="table table-striped table-hover m-0">
        <thead class="table-light">
          <tr>
            <th>Name</th>
            <th>Price</th>
            <th style="width: 20%;">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php while($row = $menuResult->fetch_assoc()): ?>
          <tr>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td>$<?= number_format($row['price'], 2) ?></td>
            <td>
              <a href="edit_menu.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
              <a href="delete_menu.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this item?')">Delete</a>
            </td>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Registered Users -->
  <div class="card">
    <div class="card-header bg-info text-white">
      <h5 class="mb-0">👥 Registered Users</h5>
    </div>
    <div class="card-body p-0">
      <table class="table table-striped table-hover m-0">
        <thead class="table-light">
          <tr>
            <th>Name</th>
            <th>Email</th>
            <th style="width: 20%;">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php while($user = $userResult->fetch_assoc()): ?>
          <tr>
            <td><?= htmlspecialchars($user['full_name']) ?></td>
            <td><?= htmlspecialchars($user['email']) ?></td>
            <td>
              <a href="delete_user.php?id=<?= $user['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this user?')">Delete</a>
            </td>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

</body>
</html>

<?php $conn->close(); ?>
