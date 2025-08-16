<?php session_start(); ?>

<?php
// Database connection
$servername = "localhost";
$username = "u765616566_bakeryuser";
$password = "9;vJfy3j7DW?";
$dbname = "u765616566_Bakery";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("DB connection failed: " . $conn->connect_error);
}

// Fetch the menu items
$menuQuery = "SELECT * FROM menu ORDER BY id DESC";
$menuItems = $conn->query($menuQuery);

// Descriptions for each item
function getDescription($name) {
    $descriptions = [
        "Tres Leches Cake" => "A light sponge cake soaked in a blend of three milks, topped with whipped cream and cinnamon.",
        "Dubai Chocolate" => "Luxurious chocolate cake infused with rich ganache and Middle Eastern flair.",
        "Brownies" => "Fudgy, rich chocolate brownies with a crackly top and gooey center.",
        "Cupcakes" => "Assorted cupcakes with buttercream icing in chocolate, vanilla, and red velvet.",
        "Cookies" => "Golden, soft-baked cookies made with love and premium ingredients.",
        "Chocolate Cake" => "Rich and moist chocolate cake topped with smooth chocolate frosting.",
        "Vanilla Cupcake" => "Fluffy vanilla cupcake with creamy vanilla buttercream icing.",
        "Strawberry Tart" => "Crispy tart crust filled with custard and topped with fresh strawberries.",
    ];

    return $descriptions[$name] ?? "Delicious freshly baked item!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="icon" type="image/png" href="/assets/images/favicon.png">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Menu | Sweet Hour Bakery</title>

  <!-- Bootstrap and Fonts -->
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
      <h1 class="text-center mb-5" data-aos="fade-down">Our Menu</h1>
      <div class="row justify-content-center g-4">
        <?php if ($menuItems->num_rows > 0): ?>
          <?php while ($item = $menuItems->fetch_assoc()): ?>
            <?php
              $imageFile = $item['image'] ?? '';
              $imagePath = '';

              if (str_starts_with($imageFile, 'assets/')) {
                  $imagePath = '/' . $imageFile;
              } elseif (!empty($imageFile)) {
                  $imagePath = '/assets/images/' . $imageFile;
              } else {
                  $imagePath = '/assets/images/default.jpg';
              }

              $description = getDescription($item['name']);
            ?>
            <div class="col-md-6 col-lg-3" data-aos="fade-up">
              <div class="card h-100 shadow-sm rounded">
                <img src="<?= htmlspecialchars($imagePath) ?>" class="card-img-top" alt="<?= htmlspecialchars($item['name']) ?>">
                <div class="card-body text-center">
                  <h5 class="card-title fw-bold"><?= htmlspecialchars($item['name']) ?></h5>
                  <p class="card-text"><?= $description ?></p>
                  <p class="fw-bold">$<?= number_format($item['price'], 2) ?></p>
                </div>
              </div>
            </div>
          <?php endwhile; ?>
        <?php else: ?>
          <p class="text-center">No menu items found.</p>
        <?php endif; ?>
      </div>
    </div>
  </main>

  <footer class="footer text-center mt-5 py-4">
    <div class="container">
      <div class="d-flex justify-content-between flex-wrap text-muted small">
        <div>© 2025 Sweet Hour Bakery</div>
      </div>
    </div>
  </footer>

  <!-- Javascripts files -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
  <script>AOS.init({ duration: 800, once: true });</script>
</body>
</html>

<?php $conn->close(); ?>


