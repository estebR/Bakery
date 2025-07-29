<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Sign Up | Sweet Hour Bakery</title>
  <link rel="stylesheet" href="/assets/css/navbar.css">
  <link rel="stylesheet" href="/assets/css/login.css">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Quicksand&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
</head>
<body class="login-body">
  <?php include 'components/navbar.php'; ?>

  <div class="login-container" data-aos="zoom-in">
    <div class="login-box shadow rounded p-4 bg-white">
      <h1><img src="/assets/images/image.jpg" alt="Logo" class="logo-img"> Sweet Hour Bakery</h1>
      <h2 class="mb-4">Sign Up</h2>

      <form action="processsignup.php" method="post">
        <label>Full Name</label>
        <input type="text" name="full_name" placeholder="Full Name" required>

        <label>Email Address</label>
        <input type="email" name="email" placeholder="you@example.com" required>

        <label>Password</label>
        <input type="password" name="password" placeholder="Create a password" required>

        <button type="submit" class="btn btn-primary w-100 mt-3">Sign Up</button>
      </form>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
  <script>AOS.init({ duration: 800, once: true });</script>
</body>
</html>