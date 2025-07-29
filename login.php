<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login | Sweet Hour Bakery</title>
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
      <h2 class="mb-4">Login to Your Account</h2>

      <div id="signup-success" class="popup-message mb-3" style="display: none;">
        ✅ Successfully signed up! You can now log in.
      </div>

      <form action="processlogin.php" method="post">
        <label>Email Address</label>
        <input type="email" name="email" placeholder="you@example.com" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <!-- Role selection -->
        <label>Login as:</label>
        <input type="radio" id="admin" name="role" value="admin"> Admin
        <input type="radio" id="user" name="role" value="user" checked> User

        <div class="login-options mt-2 mb-3 d-flex justify-content-between">
          <label><input type="checkbox"> Remember Me</label>
          <a href="#" class="text-muted small">Forgot your password?</a>
        </div>

        <button type="submit" class="btn btn-primary w-100">Sign in</button>
      </form>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
  <script>AOS.init({ duration: 800, once: true });</script>

  <script>
    const params = new URLSearchParams(window.location.search);
    if (params.get('signup') === 'success') {
      const popup = document.getElementById('signup-success');
      if (popup) popup.style.display = 'block';
      window.history.replaceState({}, document.title, window.location.pathname);
    }
  </script>
</body>
</html>

