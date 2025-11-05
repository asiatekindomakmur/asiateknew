<?php
session_start();
if (!isset($_SESSION['admin'])) { 
    header("Location: login.php"); 
    exit; 
}
include 'config.php';

$id = intval($_GET['id']);
$result = $conn->query("SELECT * FROM artikel WHERE id=$id");
$article = $result->fetch_assoc();

if (!$article) {
    $_SESSION['message'] = ['type'=>'danger','text'=>'Artikel tidak ditemukan.'];
    header("Location: artikel.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Detail Artikel</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/admin.css?v=2">
<link rel="icon" type="image/png" href="/img/logo.png" />
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
    <a href="produk.php"><i class="fa-solid fa-house"></i> Produk</a>
    <a href="artikel.php" class="active"><i class="fa-solid fa-file-lines"></i> Artikel</a>
    <a href="messages.php"><i class="fa-solid fa-envelope"></i> Pesan</a>

    <a href="logout.php" class="logout-link"><i class="fa-solid fa-right-from-bracket"></i> Log Out</a>
  </div>

<div class="main-content">
  <div class="main-header">
    <h3>Detail Artikel</h3>
    <p class="text-muted">Informasi lengkap artikel.</p>
  </div>

  <div class="card-detail">
    <h4><?= htmlspecialchars($article['title']) ?></h4>
    <p class="text-muted">Tanggal Dibuat: <?= date("d M Y", strtotime($article['created_at'])) ?></p>
    
    <?php if(!empty($article['image'])): ?>
        <img src="uploads/artikel/<?= $article['image'] ?>" class="article-image" alt="<?= htmlspecialchars($article['title']) ?>">
    <?php else: ?>
        <img src="https://via.placeholder.com/400x250?text=No+Image" class="article-image" alt="No Image">
    <?php endif; ?>

    <p><?= nl2br(htmlspecialchars($article['description'])) ?></p>

    <a href="artikel.php" class="btn btn-primary"><i class="fa fa-arrow-left me-1"></i> Kembali</a>
  </div>
</div>
  <!-- JS -->
  <script src="js/admin.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
