<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

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
  <meta charset="UTF-8" />
  <title>Admin Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background-color: #f8f9fa;
    }
    .navbar-nav .nav-link.active {
      font-weight: 600;
      color: #0d6efd !important;
    }
    .card-header.bg-warning {
      background-color: #ffc107 !important;
      color: #212529 !important;
      font-weight: 600;
      font-size: 1.1rem;
    }
    .card-header.bg-info {
      background-color: #0dcaf0 !important;
      color: #212529 !important;
      font-weight: 600;
      font-size: 1.1rem;
    }
    .container {
      margin-top: 40px;
      max-width: 1100px;
    }
    .logout-btn {
      float: right;
    }
    table {
      vertical-align: middle;
    }
    .btn-sm {
      font-size: 0.85rem;
    }
    /* Hover effect for rows */
    tbody tr:hover {
      background-color: #e9ecef;
    }

    /* Navbar adjustments */
    .navbar {
      padding-top: 0.3rem;
      padding-bottom: 0.3rem;
    }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
  <div class="container-fluid px-4 px-lg-5">
    <a class="navbar-brand fw-bold" href="admin_dashboard.php">Sweet Hour Admin</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar"
      aria-controls="adminNavbar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="adminNavbar">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link<?= basename($_SERVER['PHP_SELF']) == 'admin_dashboard.php' ? ' active' : '' ?>" href="admin_dashboard.php">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link<?= basename($_SERVER['PHP_SELF']) == 'order_history.php' ? ' active' : '' ?>" href="order_history.php">Order History</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-danger" href="logout.php">Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container">
  <h1 class="mb-4 fw-bold text-primary">Admin Dashboard</h1>

  <!-- Menu Items -->
  <div class="card mb-5 shadow-sm rounded-4">
    <div class="card-header bg-warning d-flex justify-content-between align-items-center">
      <span>📋 Menu Items</span>
      <a href="add_menu.php" class="btn btn-light btn-sm fw-semibold">➕ Add Item</a>
    </div>
    <div class="card-body p-0">
      <table class="table table-hover m-0">
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
  <div class="card shadow-sm rounded-4">
    <div class="card-header bg-info d-flex justify-content-between align-items-center">
      <span>👥 Registered Users</span>
    </div>
    <div class="card-body p-0">
      <table class="table table-hover m-0">
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
              <a href="delete_user.php?id=<?= $user['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this user? This action is irreversible!')">Delete</a>
            </td>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php $conn->close(); ?>
