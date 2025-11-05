<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include 'config.php';

$id = intval($_GET['id']); // pastikan aman
$result = $conn->query("SELECT * FROM messages WHERE id=$id");
$message = $result->fetch_assoc();

if (!$message) {
    $_SESSION['message'] = ['type'=>'danger','text'=>'Pesan tidak ditemukan.'];
    header("Location: messages.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Detail Pesan</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/admin.css?v=2">
<link rel="icon" type="image/png" href="/img/logo.png" />
<style>
.main-content { margin-left: 260px; padding: 30px; }

.card { border-radius: 15px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
.btn-primary { background-color: #0d6efd; border: none; border-radius: 10px; font-weight: 500; }
.btn-primary:hover { background-color: #005ce6; }
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
    <a href="produk.php"><i class="fa-solid fa-house"></i> Produk</a>
    <a href="artikel.php"><i class="fa-solid fa-file-lines"></i> Artikel</a>
    <a href="messages.php" class="active"><i class="fa-solid fa-envelope"></i> Pesan</a>

    <a href="logout.php" class="logout-link"><i class="fa-solid fa-right-from-bracket"></i> Log Out</a>
  </div>

<!-- MAIN CONTENT -->
<div class="main-content">
    <h3 class="fw-semibold text-primary mb-4"><i class="fa-solid fa-envelope-open-text me-2"></i> Detail Pesan</h3>

    <div class="card p-4">
        <div class="mb-3">
            <label class="fw-semibold">Nama Pengirim:</label>
            <p><?= htmlspecialchars($message['name']) ?></p>
        </div>
        <div class="mb-3">
            <label class="fw-semibold">Nomor Pengirim:</label>
            <p><?= htmlspecialchars($message['phone']) ?></p>
        </div>
        <div class="mb-3">
            <label class="fw-semibold">Pesan:</label>
            <p><?= nl2br(htmlspecialchars($message['message'])) ?></p>
        </div>
        <div class="mb-3">
            <label class="fw-semibold">Tanggal Diterima:</label>
            <p><?= date("d M Y H:i", strtotime($message['created_at'])) ?></p>
        </div>
        <a href="messages.php" class="btn btn-primary"><i class="fa fa-arrow-left me-1"></i> Kembali ke Pesan</a>
    </div>
</div>

  <!-- JS -->
  <script src="js/admin.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
