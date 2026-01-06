<?php
include 'db.php';
$stmt = $pdo->query("SELECT * FROM products ORDER BY created_at DESC");
$products = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Clothzy Admin Panel</title>
<style>
  body {
    font-family: Arial, sans-serif;
    background: #f8f5f0;
    margin: 20px;
  }
  header {
    display: flex; justify-content: space-between; align-items: center;
    margin-bottom: 20px;
  }
  header h1 {
    color: #0b1226;
    font-family: 'Playfair Display', serif;
    font-size: 2rem;
    font-weight: 700;
  }
  .btn {
    background: #c9a34a;
    color: #0b1226;
    font-weight: 700;
    padding: 10px 16px;
    border-radius: 5px;
    text-decoration: none;
    margin-left: 10px;
  }
  .btn:hover {
    background: #0b1226;
    color: #c9a34a;
  }
  table.admin-table {
    width: 100%;
    border-collapse: collapse;
    background: white;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  }
  table.admin-table th, table.admin-table td {
    padding: 12px 15px;
    border-bottom: 1px solid #ddd;
    text-align: left;
    vertical-align: middle;
  }
  table.admin-table th {
    background: #0b1226;
    color: #c9a34a;
    font-weight: 700;
  }
  table.admin-table td img {
    max-width: 80px;
    height: auto;
    border-radius: 6px;
    object-fit: cover;
  }
  .actions {
    display: flex;
    gap: 10px;
    align-items: center;
  }
  .actions a {
    padding: 6px 12px;
    border-radius: 5px;
    font-size: 0.9rem;
    font-weight: 600;
    text-decoration: none;
    color: white;
    line-height: 1;
    white-space: nowrap;
  }
  .btn-edit {
    background-color: #f0ad4e;
  }
  .btn-edit:hover {
    background-color: #ec971f;
  }
  .btn-delete {
    background-color: #d9534f;
  }
  .btn-delete:hover {
    background-color: #c9302c;
  }
  /* Responsive */
  @media (max-width: 768px) {
    table.admin-table, header {
      font-size: 14px;
    }
    table.admin-table th, table.admin-table td {
      padding: 8px;
    }
  }
</style>
</head>
<body>
<header>
  <h1>Clothzy Admin Panel</h1>
  <div>
    <a href="create_product.php" class="btn btn-create">Add New Product</a>
    <a href="index.php" class="btn">View Store Front</a>
  </div>
</header>
<main>
  <table class="admin-table" aria-label="Products Table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Image</th>
        <th>Name</th>
        <th>Description</th>
        <th>Price</th>
        <th>Trending</th>
        <th>Created At</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($products as $product): ?>
      <tr>
        <td><?= htmlspecialchars($product['id']) ?></td>
        <td>
          <?php 
          $imgPath = 'uploads/' . htmlspecialchars($product['image_url']);
          if (!empty($product['image_url']) && file_exists($imgPath)): ?>
            <img src="<?= $imgPath ?>" alt="<?= htmlspecialchars($product['name']) ?>">
          <?php else: ?>
            <span>No img</span>
          <?php endif; ?>
        </td>
        <td><?= htmlspecialchars($product['name']) ?></td>
        <td><?= htmlspecialchars(substr($product['description'], 0, 50)) ?>...</td>
        <td>₹<?= number_format($product['price'], 2) ?></td>
        <td><?= $product['is_trending'] ? 'Yes' : 'No' ?></td>
        <td><?= htmlspecialchars(date('Y-m-d', strtotime($product['created_at']))) ?></td>
        <td class="actions">
          <a href="edit_product.php?id=<?= $product['id'] ?>" class="btn btn-edit" title="Edit">Edit</a>
          <a href="delete_product.php?id=<?= $product['id'] ?>" class="btn btn-delete" title="Delete" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</main>
</body>
</html>
