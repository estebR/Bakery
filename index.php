<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Sweet Hour Bakery</title>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Quicksand&display=swap" rel="stylesheet">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="/assets/css/navbar.css">
  <link rel="stylesheet" href="/assets/css/index.css">

  <!-- AOS CSS -->
  <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
</head>
<body>

  <!-- Navbar -->
  <?php include 'components/navbar.php'; ?>

  <!-- Hero Section -->
  <header class="hero-banner text-white d-flex align-items-center justify-content-center text-center">
    <div class="hero-text" data-aos="fade-up">
      <h1 class="display-4 fw-bold">Welcome to Sweet Hour Bakery</h1>
      <p class="lead">Delicious bakery items made with love.</p>
      <a href="/order.php" class="btn btn-light mt-3 px-4 py-2 rounded-pill fw-semibold">Order Now</a>
    </div>
  </header>

  <!-- Main Content -->
  <main class="container py-5">
    <div class="row g-5">
      
      <!-- Promotions -->
      <div class="col-md-6">
        <section class="highlighted-promotions h-100 shadow-sm rounded p-4 bg-white" data-aos="fade-right">
          <h2 class="mb-4 text-center text-primary-emphasis">Highlighted Promotions</h2>
          <div class="promo mb-3 text-center" data-aos="zoom-in" data-aos-delay="200">
            <img src="assets/images/dubai_chocolate.png" alt="Dubai Chocolate" class="img-fluid rounded mb-2 shadow-sm">
            <p><strong>Dubai Chocolate!</strong> A rich, luxurious treat inspired by Middle Eastern flavors.</p>
          </div>
          <div class="promo text-center" data-aos="zoom-in" data-aos-delay="400">
            <img src="assets/images/brownies.jpg" alt="Brownies" class="img-fluid rounded mb-2 shadow-sm">
            <p><strong>Try our New Brownies</strong> — gooey, chocolatey, and freshly baked daily.</p>
          </div>
        </section>
      </div>

      <!-- Overview -->
      <div class="col-md-6">
        <section class="overview h-100 shadow-sm rounded p-4 text-white" style="background-color: #BF6B04;" data-aos="fade-left" data-aos-delay="300">
          <h2 class="mb-4">Sweet Hour Overview</h2>
          <p>
            At Sweet Hour Bakery, we believe every treat should be as special as the moment it’s made for.
            From cupcakes to seasonal specials, all made with love. We also take custom orders for birthdays and events.
            Follow us on Instagram for the latest creations!
          </p>
          <img src="assets/images/bakery.jpg" alt="Bakery" class="img-fluid rounded mt-3 shadow-sm">
        </section>
      </div>
    </div>
  </main>

  <!-- Footer -->
  <footer class="footer text-white d-flex justify-content-between flex-wrap p-4 mt-5" style="background-color: #333;">
    <div class="footer-column mb-3">
      <h6 class="text-uppercase fw-bold">Follow Us</h6>
      <p>📘 Facebook | 📸 Instagram | 🐦 Twitter</p>
    </div>
    <div class="footer-column mb-3">
      <h6 class="text-uppercase fw-bold">Contact</h6>
      <p>Email: info@sweettreats.com<br>Phone: (123) 456-7890</p>
    </div>
    <div class="footer-column mb-3">
      <h6 class="text-uppercase fw-bold">Quick Links</h6>
      <a href="/menu.php" class="d-block text-white text-decoration-none">Menu</a>
      <a href="/about.php" class="d-block text-white text-decoration-none">About</a>
      <a href="/login.php" class="d-block text-white text-decoration-none">Login</a>
    </div>
  </footer>

  <!-- JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <!-- AOS JS -->
  <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
  <script>
    AOS.init({
      duration: 800,
      easing: 'ease-in-out',
      once: true
    });
  </script>
</body>
</html>

