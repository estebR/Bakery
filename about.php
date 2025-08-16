<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="icon" type="image/png" href="/assets/images/favicon.png">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>About Us | Sweet Hour Bakery</title>

  <!-- Fonts & Styles -->
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Quicksand&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/assets/css/navbar.css">
  <link rel="stylesheet" href="/assets/css/about.css">

  <!-- AOS -->
  <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
</head>
<body>
  <?php include 'components/navbar.php'; ?>

  <!-- Hero -->
  <header class="about-hero text-center text-white d-flex align-items-center justify-content-center" style="background-color: #BF6B04; height: 300px;" data-aos="fade-down">
    <div class="content">
      <h1 class="display-4 fw-bold">About Sweet Hour Bakery</h1>
      <p class="lead">Where every bite tells a story</p>
    </div>
  </header>

  <!-- About Section -->
  <main class="container py-5">
    <div class="row align-items-center g-5">
      <div class="col-md-6" data-aos="fade-right">
        <img src="/assets/images/bakery_shelf.jpg" alt="Bakery Shelf" class="img-fluid rounded shadow">
      </div>
      <div class="col-md-6" data-aos="fade-left">
        <h2 class="fw-bold mb-3">Our Story</h2>
        <p class="fs-6">
          Sweet Hour Bakery was born from a passion for baking and a desire to bring warmth to the community.
          Founded by Ruhma Nazim, the bakery started in a cozy kitchen and grew into a neighborhood favorite —
          known for creativity, comfort, and deliciousness.
          <br><br>
          From custom cakes to everyday cookies, we believe every hour should be a Sweet Hour.
        </p>
      </div>
    </div>

    <!-- Testimonials -->
    <section class="testimonials mt-5 text-center">
      <h3 class="mb-4" data-aos="fade-up">What Customers Are Saying</h3>
      <div class="row g-4 justify-content-center">
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
          <div class="testimonial-card p-4 shadow-sm bg-light rounded">
            <p class="mb-2">“The pastries are divine — every single time.”</p>
            <strong>- Shaheer N.</strong>
          </div>
        </div>
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
          <div class="testimonial-card p-4 shadow-sm bg-light rounded">
            <p class="mb-2">“A cozy gem. Always fresh, always perfect.”</p>
            <strong>- Hamza N.</strong>
          </div>
        </div>
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
          <div class="testimonial-card p-4 shadow-sm bg-light rounded">
            <p class="mb-2">“Best bakery in town. Highly recommended!”</p>
            <strong>- Steve R.</strong>
          </div>
        </div>
      </div>
    </section>
  </main>

  <!-- Footer -->
  <footer class="footer text-white d-flex justify-content-between flex-wrap p-4 mt-5" style="background-color: #333;">
    <div class="footer-column mb-3">
      <h6>Contact Us</h6>
      <p>Email: Sweethourbakery@gmail.com</p>
    </div>
    <div class="footer-column mb-3">
      <h6>Quick Links</h6>
      <a href="/menu.php" class="d-block text-white">Menu</a>
      <a href="/order.php" class="d-block text-white">Order</a>
      <a href="/login.php" class="d-block text-white">Login</a>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
  <script>AOS.init({ duration: 800, once: true });</script>
</body>
</html>
