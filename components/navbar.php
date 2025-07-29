<?php session_start(); ?>
<div class="navbar">
  <div class="nav-left">
    <a href="/index.html" class="logo">
      <img src="/assets/images/image.jpg" alt="Sweet Hour Bakery Logo" class="logo-img">
      Sweet Hour Bakery
    </a>
  </div>
  <div class="nav-right">
    <a href="/index.php">Home</a>
    <a href="/menu.php">Menu</a>
    <a href="/about.php">About</a>
    <a href="/order.php">Order</a>

    <?php if (isset($_SESSION['user_id'])): ?>
      <a href="/logout.php">Logout</a>
    <?php else: ?>
      <a href="/SignUp.php">Sign Up</a>
      <a href="/login.php">Login</a>
    <?php endif; ?>
  </div>
</div>
<hr>