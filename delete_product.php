<?php
include 'db.php';

$id = $_GET['id'] ?? null;

if ($id) {
    $sql = "DELETE FROM products WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
}

header("Location: admin_panel.php");
exit;
?>