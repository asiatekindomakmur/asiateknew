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
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail Produk</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/admin.css?v=2">
  <link rel="icon" type="image/png" href="/img/logo.png" />
  <style>
  
    /* MAIN CONTENT */
    .main-content {
      margin-left: 270px;
      padding: 40px 50px;
    }
    .main-header { margin-bottom: 40px; }
    .main-header h3 { font-weight: 700; color: var(--primary); }

    .card-detail {
      background: var(--card-bg);
      border-radius: 16px;
      padding: 30px;
      box-shadow: 0 4px 14px rgba(0,0,0,0.06);
    }

    .card-detail img {
      width: 100%;
      border-radius: 12px;
      margin-bottom: 20px;
    }

    .btn-secondary { border-radius: 10px; }
  </style>
</head>
<body>

  <!-- HAMBURGER TOGGLE & OVERLAY -->
  <button class="menu-toggle"><i class="fa-solid fa-bars"></i></button>
  <div class="overlay"></div>

  <!-- SIDEBAR -->
  <div class="sidebar">
    <div class="logo">
      <img src="../img/logo.png" alt="Logo">
    </div>

    <a href="index.php"><i class="fa-solid fa-house"></i> Dashboard</a>
    <a href="produk.php" class="active"><i class="fa-solid fa-house"></i> Produk</a>
    <a href="artikel.php"><i class="fa-solid fa-file-lines"></i> Artikel</a>
    <a href="messages.php"><i class="fa-solid fa-envelope"></i> Pesan</a>

    <a href="logout.php" class="logout-link"><i class="fa-solid fa-right-from-bracket"></i> Log Out</a>
  </div>

  <!-- MAIN CONTENT -->
  <div class="main-content">
    <div class="main-header">
      <h3>Detail Produk</h3>
      <p class="text-muted">Informasi lengkap produk.</p>
    </div>

    <div class="card-detail">
      <h4 class="text-primary mb-3"><i class="fa-solid fa-box me-2"></i> <?= htmlspecialchars($product['name']) ?></h4>
      <?php if ($product['image']): ?>
        <img src="uploads/produk/<?= $product['image'] ?>" alt="Gambar Produk">
      <?php endif; ?>
      <p><?= nl2br(htmlspecialchars($product['description'])) ?></p>
      <small class="text-muted">Dibuat pada: <?= date("d M Y", strtotime($product['created_at'])) ?></small>
      <div class="text-end mt-4">
        <a href="produk.php" class="btn btn-secondary">Kembali</a>
      </div>
    </div>
  </div>

    <!-- JS -->
  <script src="js/admin.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
