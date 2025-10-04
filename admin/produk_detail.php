<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit;
}
include 'config.php';

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM products WHERE id=$id");
$product = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Detail Produk</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background: #f8f9fb; font-family: 'Poppins', sans-serif; }
    .container { max-width: 700px; margin-top: 50px; }
    .card { border-radius: 15px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); }
  </style>
</head>
<body>
  <div class="container">
    <div class="card p-4">
      <h4 class="text-primary mb-3"><i class="fa-solid fa-box me-2"></i> Detail Produk</h4>
      <img src="uploads/<?= $product['image'] ?>" class="rounded mb-3" width="100%">
      <h5><?= htmlspecialchars($product['name']) ?></h5>
      <p><?= nl2br(htmlspecialchars($product['description'])) ?></p>
      <small class="text-muted">Dibuat pada: <?= date("d M Y", strtotime($product['created_at'])) ?></small>
      <div class="text-end mt-4">
        <a href="produk.php" class="btn btn-secondary">Kembali</a>
      </div>
    </div>
  </div>
</body>
</html>
