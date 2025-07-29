<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Order - Sweet Hour Bakery</title>

  <!-- Fonts & CSS -->
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Quicksand&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/assets/css/navbar.css">
  <link rel="stylesheet" href="/assets/css/order.css">
  <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Quicksand', sans-serif;
      background-color: #fffaf5;
    }

    .order-container h2 {
      font-family: 'Playfair Display', serif;
      font-weight: 600;
    }

    .product-list {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 2rem;
    }

    .product {
      background: white;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.08);
      padding: 20px;
      text-align: center;
      width: 260px;
      transition: transform 0.3s ease;
    }

    .product img {
      max-width: 100%;
      border-radius: 10px;
      margin-bottom: 10px;
    }

    .product:hover {
      transform: translateY(-5px);
    }

    .product select {
      width: 100%;
      padding: 8px;
      border-radius: 6px;
      border: 1px solid #ccc;
      margin-top: 10px;
    }

    .custom-form textarea {
      width: 90%;
      max-width: 600px;
      margin: auto;
      border-radius: 8px;
      padding: 15px;
      border: 1px solid #ccc;
    }

    .btn-success {
      background-color: #7ec982;
      border: none;
    }

    .btn-success:hover {
      background-color: #62b268;
    }
  </style>
</head>
<body>

  <?php include 'components/navbar.php'; ?>

  <main class="order-container container py-5">
    <section class="products text-center">
      <h2 class="mb-4" data-aos="fade-up">Customize Your Order</h2>
      <p class="mb-5 text-muted" data-aos="fade-up">Select how many of each item you’d like to order. You’ll pay upon pickup.</p>

      <div class="product-list" data-aos="fade-up">
        <!-- Product Cards -->
        <?php
        $products = [
          ["Tres Leches", "tres_leches.jpg", "$15.99"],
          ["Dubai Chocolate", "dubai_chocolate.png", "$12.99"],
          ["Brownies", "brownies.jpg", "$5.99"],
          ["Cupcakes", "mixed_cupcake.jpg", "$9.99"],
          ["Cookies", "cookies.jpg", "$9.99"],
        ];
        foreach ($products as $product) {
          echo "
            <div class='product' data-aos='fade-up'>
              <img src='/assets/images/{$product[1]}' alt='{$product[0]}'>
              <h3>{$product[0]}</h3>
              <p>{$product[2]}</p>
              <select><option>0</option><option>1</option><option>2</option></select>
            </div>
          ";
        }
        ?>
      </div>

      <!-- Custom Order -->
      <div class="custom-order mt-5" data-aos="fade-up">
        <h3 class="text-center mb-3">Want Something Special?</h3>
        <p class="text-center text-muted mb-3">Let us know exactly what you're craving — flavors, quantity, frosting, or instructions.</p>
        <div class="custom-form text-center">
          <textarea name="custom_order" placeholder="Example: 1 dozen mini pistachio cupcakes with rose frosting" rows="4"></textarea>
        </div>
      </div>

      <!-- Submit Button -->
      <div class="text-center mt-4" data-aos="fade-up">
        <button type="submit" class="btn btn-success px-5 py-2 rounded-pill fw-semibold">Submit Order</button>
      </div>
    </section>
  </main>

  <!-- Footer -->
  <footer class="footer text-center mt-5 py-4">
    <p class="text-muted">Contact us at info@sweettreats.com | Hamden, CT</p>
  </footer>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
  <script>AOS.init({ duration: 800, once: true });</script>
</body>
</html>

