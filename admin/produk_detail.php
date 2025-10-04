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
  <style>
    :root {
      --primary: #0d6efd;
      --accent: #f4f6fb;
      --text-dark: #2e2e2e;
      --card-bg: #fff;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background: var(--accent);
      color: var(--text-dark);
      margin: 0;
      overflow-x: hidden;
    }

    /* SIDEBAR */
    .sidebar {
      position: fixed;
      left: 0;
      top: 0;
      width: 250px;
      height: 100vh;
      background: #fff;
      box-shadow: 3px 0 15px rgba(0,0,0,0.05);
      padding: 30px 20px;
      display: flex;
      flex-direction: column;
      transition: 0.3s;
    }
    .sidebar .logo { text-align: center; margin-bottom: 40px; }
    .sidebar .logo img { width: 140px; height: auto; object-fit: contain; }
    .sidebar a { display: flex; align-items: center; gap: 12px; padding: 12px 18px; color: #555; border-radius: 10px; font-size: 15px; text-decoration: none; margin-bottom: 8px; transition: all 0.3s; }
    .sidebar a i { font-size: 17px; }
    .sidebar a:hover, .sidebar a.active { background: var(--primary); color: white; box-shadow: 0 4px 10px rgba(13,110,253,0.2); }
    .logout-link { margin-top: auto; color: #dc3545; font-weight: 500; }
    .logout-link:hover { color: #b02a37; }

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

  <!-- SIDEBAR -->
  <div class="sidebar">
    <div class="logo">
      <img src="../img/logo.png" alt="Logo">
    </div>
    <a href="index.php"><i class="fa-solid fa-house"></i> Dashboard</a>
    <a href="produk.php" class="active"><i class="fa-solid fa-box"></i> Produk</a>
    <a href="#"><i class="fa-solid fa-file-lines"></i> Artikel</a>
    <a href="#"><i class="fa-solid fa-envelope"></i> Pesan</a>
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
        <img src="uploads/<?= $product['image'] ?>" alt="Gambar Produk">
      <?php endif; ?>
      <p><?= nl2br(htmlspecialchars($product['description'])) ?></p>
      <small class="text-muted">Dibuat pada: <?= date("d M Y", strtotime($product['created_at'])) ?></small>
      <div class="text-end mt-4">
        <a href="produk.php" class="btn btn-secondary">Kembali</a>
      </div>
    </div>
  </div>

</body>
</html>
