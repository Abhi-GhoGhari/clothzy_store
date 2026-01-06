<?php
include 'db.php';

$is_logged_in = isset($_SESSION['user_id']);
$username = $_SESSION['username'] ?? '';

$sort = $_GET['sort'] ?? 'created_at';
$filter = $_GET['filter'] ?? 'all';

$sql = "SELECT * FROM products";
$params = [];

if ($filter == 'trending') {
    $sql .= " WHERE is_trending = 1";
}

switch ($sort) {
    case 'price_high':
        $sql .= " ORDER BY price DESC";
        break;
    case 'price_low':
        $sql .= " ORDER BY price ASC";
        break;
    default:
        $sql .= " ORDER BY created_at DESC";
        break;
}

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$products = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Clothzy Store</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Welcome to Clothzy</h1>
        
        <div class="user-nav">
            <?php if ($is_logged_in): ?>
                <span>Welcome, <?php echo htmlspecialchars($username); ?>!</span>
                <a href="logout.php">Logout</a>
            <?php else: ?>
                <a href="login.php">Login</a>
                <a href="signup.php">Sign Up</a>
            <?php endif; ?>
        </div>
    </header>
    
    <nav class="filters">
        <strong>Sort By:</strong>
        <a href="index.php?sort=price_low">Price: Low to High</a>
        <a href="index.php?sort=price_high">Price: High to Low</a>
        <a href="index.php?sort=created_at">Newest (Default)</a>
        <strong>Filter:</strong>
        <a href="index.php?filter=trending">Trending</a>
        <a href="index.php?filter=all">Show All</a>
    </nav>

    <main class="container">
        <div class="product-grid">
            <?php if (empty($products)): ?>
                <p>No products found.</p>
            <?php else: ?>
                <?php foreach ($products as $product): ?>
                    <div class="product-card">
                        <img src="<?php echo htmlspecialchars($product['image_url']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                        <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                        <p><?php echo htmlspecialchars($product['description']); ?></p>
                        <span class="price">₹<?php echo htmlspecialchars($product['price']); ?></span>
                        <?php if ($product['is_trending']): ?>
                            <span class="trending-badge">Trending</span>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </main>
   <footer class="main-footer">
  <div class="container footer-content">
    <div class="footer-section about">
      <h3>CLOTHZY STORE</h3>
      <p>Your premium destination for luxurious apparel. Crafted with excellence and designed for elegance.</p>
    </div>

    <div class="footer-section links">
      <h4>Quick Links</h4>
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="categories.php">Categories</a></li>
        <li><a href="contact.php">Contact Us</a></li>
        <li><a href="privacy.php">Privacy Policy</a></li>
      </ul>
    </div>

    <div class="footer-section contact">
      <h4>Contact Us</h4>
      <p>Email: support@clothzystore.com</p>
      <p>Phone: +91 8128214806</p>
      <div class="social-icons">
        <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
        <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
        <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
        <a href="#" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
      </div>
    </div>
  </div>
    <div class="footer-admin-link">
    <p><a href="admin_panel.php" class="admin-link">Admin Panel</a></p>
  </div>
  <div class="footer-bottom">
    <p>&copy; 2025 CLOTHZY STORE. All rights reserved.</p>
  </div>
</footer>

<!-- Add Font Awesome CDN if not present -->
<link
  rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
/>
</body>
</html>