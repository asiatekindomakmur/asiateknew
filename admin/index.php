<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit;
}

include 'config.php';

// === AMBIL DATA DARI DATABASE ===
$total_products = 0;
$total_artikel = 0;
$total_messages = 0;

try {
  $query = $conn->query("SELECT COUNT(*) AS total FROM products");
  if ($query && $row = $query->fetch_assoc()) $total_products = $row['total'];

  $query = $conn->query("SELECT COUNT(*) AS total FROM artikel");
  if ($query && $row = $query->fetch_assoc()) $total_artikel = $row['total'];

  $query = $conn->query("SELECT COUNT(*) AS total FROM messages");
  if ($query && $row = $query->fetch_assoc()) $total_messages = $row['total'];
} catch (Exception $e) {
  echo "⚠️ Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Admin</title>

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

    <a href="index.php" class="active"><i class="fa-solid fa-house"></i> Dashboard</a>
    <a href="produk.php"><i class="fa-solid fa-box"></i> Produk</a>
    <a href="artikel.php"><i class="fa-solid fa-file-lines"></i> Artikel</a>
    <a href="messages.php"><i class="fa-solid fa-envelope"></i> Pesan</a>

    <a href="logout.php" class="logout-link"><i class="fa-solid fa-right-from-bracket"></i> Log Out</a>
  </div>

  <!-- MAIN CONTENT -->
  <div class="main-content">
    <div class="main-header">
      <h3>Selamat Datang, <?php echo $_SESSION['admin']; ?> 👋</h3>
      <p class="text-muted">Panel Admin Asiatek Indo Makmur — Didesain untuk kemudahan & kecepatan kerja.</p>
    </div>

    <div class="row g-4">
      <div class="col-md-4">
        <div class="stat-card">
          <div class="stat-icon icon-products"><i class="fa-solid fa-box"></i></div>
          <div class="stat-info">
            <h6>Total Produk</h6>
            <h3><?php echo $total_products; ?></h3>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="stat-card">
          <div class="stat-icon icon-artikel"><i class="fa-solid fa-file-lines"></i></div>
          <div class="stat-info">
            <h6>Total Artikel</h6>
            <h3><?php echo $total_artikel; ?></h3>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="stat-card">
          <div class="stat-icon icon-messages"><i class="fa-solid fa-envelope"></i></div>
          <div class="stat-info">
            <h6>Pesan Customer</h6>
            <h3><?php echo $total_messages; ?></h3>
          </div>
        </div>
      </div>
    </div>
  </div>

    <!-- JS -->
  <script src="js/admin.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
