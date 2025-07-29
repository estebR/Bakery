<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Menu | Sweet Hour Bakery</title>

  <!-- Bootstrap & Fonts -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Quicksand&display=swap" rel="stylesheet">
  
  <!-- Custom Styles -->
  <link rel="stylesheet" href="/assets/css/navbar.css">
  <link rel="stylesheet" href="/assets/css/menu.css">

  <!-- AOS CSS -->
  <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
</head>
<body>
  <?php include 'components/navbar.php'; ?>

  <main class="py-5">
    <div class="container">
      <div class="row justify-content-center g-4">
        <!-- Card 1 -->
        <div class="col-md-6 col-lg-3" data-aos="fade-up">
          <div class="card h-100 shadow-sm rounded">
            <img src="/assets/images/tres_leches.jpg" class="card-img-top" alt="Tres Leches Cake">
            <div class="card-body text-center">
              <h5 class="card-title fw-bold">Tres Leches Cake</h5>
              <p class="card-text">A light sponge cake soaked in a blend of three milks, topped with whipped cream and cinnamon.</p>
              <p class="fw-bold">$15.99</p>
            </div>
          </div>
        </div>

        <!-- Card 2 -->
        <div class="col-md-6 col-lg-3" data-aos="fade-up">
          <div class="card h-100 shadow-sm rounded">
            <img src="/assets/images/dubai_chocolate.png" class="card-img-top" alt="Dubai Chocolate">
            <div class="card-body text-center">
              <h5 class="card-title fw-bold">Dubai Chocolate</h5>
              <p class="card-text">Luxurious chocolate cake infused with rich ganache and Middle Eastern flair.</p>
              <p class="fw-bold">$12.99</p>
            </div>
          </div>
        </div>

        <!-- Card 3 -->
        <div class="col-md-6 col-lg-3" data-aos="fade-up">
          <div class="card h-100 shadow-sm rounded">
            <img src="/assets/images/brownies.jpg" class="card-img-top" alt="Brownies">
            <div class="card-body text-center">
              <h5 class="card-title fw-bold">Brownies</h5>
              <p class="card-text">Fudgy, rich chocolate brownies with a crackly top and gooey center.</p>
              <p class="fw-bold">$5.99</p>
            </div>
          </div>
        </div>

        <!-- Card 4 -->
        <div class="col-md-6 col-lg-3" data-aos="fade-up">
          <div class="card h-100 shadow-sm rounded">
            <img src="/assets/images/mixed_cupcake.jpg" class="card-img-top" alt="Cupcakes">
            <div class="card-body text-center">
              <h5 class="card-title fw-bold">Cupcakes</h5>
              <p class="card-text">Assorted cupcakes with buttercream icing in chocolate, vanilla, and red velvet.</p>
              <p class="fw-bold">$9.99</p>
            </div>
          </div>
        </div>

        <!-- Card 5 -->
        <div class="col-md-6 col-lg-3" data-aos="fade-up">
          <div class="card h-100 shadow-sm rounded">
            <img src="/assets/images/cookies.jpg" class="card-img-top" alt="Cookies">
            <div class="card-body text-center">
              <h5 class="card-title fw-bold">Cookies</h5>
              <p class="card-text">Golden, soft-baked cookies made with love and premium ingredients.</p>
              <p class="fw-bold">$9.99</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <footer class="footer text-center mt-5 py-4">
    <div class="container">
      <div class="d-flex justify-content-between flex-wrap text-muted small">
        <div>© 2023 Sweet Hour Bakery</div>
        <div>
          <a href="#" class="text-muted text-decoration-none me-3">Contact</a>
          <a href="#" class="text-muted text-decoration-none me-3">Privacy</a>
          <a href="#" class="text-muted text-decoration-none">Follow</a>
        </div>
      </div>
    </div>
  </footer>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
  <script>AOS.init({ duration: 800, once: true });</script>
</body>
</html>
