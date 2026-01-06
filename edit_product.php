<?php
include 'db.php';
$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: admin_panel.php');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $desc = $_POST['description'];
    $price = $_POST['price'];
    $img = $_POST['image_url'];
    $trending = isset($_POST['is_trending']) ? 1 : 0;

    $sql = "UPDATE products SET name = ?, description = ?, price = ?, image_url = ?, is_trending = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $desc, $price, $img, $trending, $id]);

    header("Location: admin_panel.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Edit Product - Clothzy Admin</title>
    <link rel="stylesheet" href="style.css" />
    <style>
      body {
        font-family: Arial, sans-serif;
        background: #f8f5f0;
        margin: 30px;
        color: #0b1226;
      }
      header h1 {
        font-family: 'Playfair Display', serif;
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 30px;
        color: #c9a34a;
      }
      main.container {
        max-width: 600px;
        margin: 0 auto;
        background: white;
        padding: 25px 30px;
        border-radius: 12px;
        box-shadow: 0 8px 24px rgb(201 163 74 / 0.3);
      }
      table.form-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 15px 10px;
      }
      table.form-table td {
        vertical-align: middle;
      }
      table.form-table label {
        font-weight: 600;
        font-size: 1.05rem;
        color: #333;
        display: inline-block;
        min-width: 130px;
      }
      table.form-table input[type="text"],
      table.form-table input[type="number"],
      table.form-table textarea {
        width: 100%;
        padding: 10px 14px;
        border-radius: 8px;
        border: 1px solid #ccc;
        font-size: 1rem;
        font-family: 'Inter', sans-serif;
        color: #0b1226;
        resize: vertical;
        transition: box-shadow 0.3s ease;
      }
      table.form-table input[type="text"]:focus,
      table.form-table input[type="number"]:focus,
      table.form-table textarea:focus {
        box-shadow: 0 0 8px #c9a34a;
        border-color: #c9a34a;
        outline: none;
      }
      .form-table input[type="checkbox"] {
        transform: scale(1.3);
        cursor: pointer;
      }
      button.btn {
        background-color: #c9a34a;
        color: #0b1226;
        font-weight: 700;
        font-size: 1.2rem;
        padding: 12px 0;
        width: 100%;
        border: none;
        border-radius: 30px;
        cursor: pointer;
        margin-top: 25px;
        transition: background-color 0.3s ease;
      }
      button.btn:hover {
        background-color: #0b1226;
        color: #c9a34a;
        box-shadow: 0 0 15px #c9a34a;
      }
    </style>
</head>
<body>
    <header>
        <h1>Edit Product</h1>
    </header>
    <main class="container">
        <form action="edit_product.php?id=<?= htmlspecialchars($product['id']) ?>" method="POST" autocomplete="off">
            <input type="hidden" name="id" value="<?= htmlspecialchars($product['id']) ?>" />
            <table class="form-table">
                <tr>
                    <td><label for="name">Product Name</label></td>
                    <td>
                        <input type="text" id="name" name="name" value="<?= htmlspecialchars($product['name']) ?>" required />
                    </td>
                </tr>
                <tr>
                    <td><label for="description">Description</label></td>
                    <td>
                        <textarea id="description" name="description" rows="4"><?= htmlspecialchars($product['description']) ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td><label for="price">Price</label></td>
                    <td>
                        <input type="number" id="price" name="price" step="0.01" value="<?= htmlspecialchars($product['price']) ?>" required />
                    </td>
                </tr>
                <tr>
                    <td><label for="image_url">Image URL</label></td>
                    <td>
                        <input type="text" id="image_url" name="image_url" value="<?= htmlspecialchars($product['image_url']) ?>" />
                    </td>
                </tr>
                <tr>
                    <td><label for="is_trending">Is Trending?</label></td>
                    <td>
                        <input type="checkbox" id="is_trending" name="is_trending" value="1" <?= $product['is_trending'] ? 'checked' : '' ?> />
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <button type="submit" class="btn">Update Product</button>
                    </td>
                </tr>
            </table>
        </form>
    </main>
</body>
</html>
