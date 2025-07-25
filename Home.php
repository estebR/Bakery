<?php>
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Sweet Hour Bakery</title>
  <link rel="stylesheet" href="assets/css/navbar.css">
  <link rel="stylesheet" href="assets/css/home.css">
  <link rel="stylesheet" href="assets/images/Cookies.png">
</head>
<body>
  <div id="navbar-container"></div>


  <?php if (isset($_SESSION['full_name'])): ?>
   <div class="welcome-message">
        Welcome, <?php echo htmlspecialchars($_SESSION['full_name']); ?>!
        <a href="logout.php">Logout</a>
    </div>
  <?php endif; ?>

  <header class="hero-banner">
    <div class="hero-text">
      <h1>Welcome to Sweet Hour Bakery</h1>
      <p>Delicious bakery items made with love.</p>
    </div>
  </header>

  <main class="homepage-grid">
    <section class="highlighted-promotions">
      <h2>Highlighted Promotions</h2>
      <div class="promo">
        <img src="assets/images/cake.jpg" alt="Cake">
        <p><strong>Cake For Eid Al Adha!</strong></p>
      </div>
      <div class="promo">
        <img src="assets/images/brownies.jpg" alt="Brownies">
        <p>Try our New Brownies</p>
      </div>
    </section>

    <section class="overview">
      <h2>SweetTreats Overview</h2>
      <p>At SweetTreats, we believe in crafting delightful bakery items with the finest ingredients. Our story began in a small kitchen with a passion for baking that has grown into a beloved neighborhood bakery.</p>
      <img src="assets/images/bakery.jpg" alt="Bakery">
    </section>
  </main>

  <footer class="footer">
    <div class="footer-column">
      <p><strong>Follow Us</strong></p>
      <p>🔵 🐦 📸</p>
    </div>
    <div class="footer-column">
      <p><strong>Contact</strong><br>Email: info@sweettreats.com<br>Phone: (123) 456-7890</p>
    </div>
    <div class="footer-column">
      <p><strong>Quick Links</strong><br>Menu<br>About<br>Login</p>
    </div>
  </footer>

  <script src="js/navbar.js"></script>
</body>
</html>
