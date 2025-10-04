<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit;
}

include 'config.php';

// ==== CEK KONEKSI ====
if (!$conn) {
  die("Koneksi ke database gagal: " . mysqli_connect_error());
}

// ==== Ambil data dari database dengan pengecekan aman ====
$total_products = 0;
$total_articles = 0;
$total_messages = 0;
$recent_products = [];
$recent_articles = [];

try {
  // Total produk
  $query = $conn->query("SELECT COUNT(*) AS total FROM products");
  if ($query && $row = $query->fetch_assoc()) {
    $total_products = $row['total'];
  }

  // Total artikel
  $query = $conn->query("SELECT COUNT(*) AS total FROM articles");
  if ($query && $row = $query->fetch_assoc()) {
    $total_articles = $row['total'];
  }

  // Total pesan customer
  $query = $conn->query("SELECT COUNT(*) AS total FROM messages");
  if ($query && $row = $query->fetch_assoc()) {
    $total_messages = $row['total'];
  }

  // Produk terbaru
  $recent_products = [];
  $query = $conn->query("SELECT name, stock, status FROM products ORDER BY created_at DESC LIMIT 5");
  if ($query) {
    while ($row = $query->fetch_assoc()) {
      $recent_products[] = $row;
    }
  }

  // Artikel terbaru
  $recent_articles = [];
  $query = $conn->query("SELECT title, created_at FROM articles ORDER BY created_at DESC LIMIT 5");
  if ($query) {
    while ($row = $query->fetch_assoc()) {
      $recent_articles[] = $row;
    }
  }

} catch (Exception $e) {
  echo "⚠️ Terjadi kesalahan: " . $e->getMessage();
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
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <style>
    body {
      background: #f8f9fb;
      font-family: 'Poppins', sans-serif;
      margin: 0;
    }

    .sidebar {
      position: fixed;
      left: 0;
      top: 0;
      width: 240px;
      height: 100vh;
      background: #fff;
      box-shadow: 2px 0 10px rgba(0,0,0,0.05);
      padding: 30px 20px;
    }

    .sidebar .logo {
      font-weight: 700;
      font-size: 22px;
      color: #0d6efd;
      margin-bottom: 30px;
    }

    .sidebar a {
      display: flex;
      align-items: center;
      gap: 10px;
      color: #555;
      padding: 10px 15px;
      border-radius: 8px;
      text-decoration: none;
      font-size: 15px;
      transition: 0.3s;
    }

    .sidebar a:hover, .sidebar a.active {
      background: #0d6efd;
      color: white;
    }

    .main-content {
      margin-left: 260px;
      padding: 30px;
    }

    .card-stat {
      background: white;
      border-radius: 12px;
      padding: 20px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.05);
      transition: 0.3s;
    }

    .card-stat:hover {
      transform: translateY(-3px);
    }

    .chart-container {
      background: white;
      padding: 25px;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    }

    footer {
      background: #0d6efd;
      color: white;
      text-align: center;
      padding: 15px;
      border-top-left-radius: 15px;
      border-top-right-radius: 15px;
      margin-top: 40px;
    }
  </style>
</head>

<body>

  <!-- SIDEBAR -->
  <div class="sidebar">
    <div class="logo"><i class="fa-solid fa-chart-line"></i> Dashboard</div>

    <a href="#" class="active"><i class="fa-solid fa-home"></i> Dashboard</a>
    <a href="#"><i class="fa-solid fa-box"></i> Produk</a>
    <a href="#"><i class="fa-solid fa-file-alt"></i> Artikel</a>
    <a href="#"><i class="fa-solid fa-envelope"></i> Pesan</a>

    <div class="mt-auto pt-3">
      <a href="logout.php" style="color:#dc3545;"><i class="fa-solid fa-right-from-bracket"></i> Log Out</a>
    </div>
  </div>

  <!-- MAIN CONTENT -->
  <div class="main-content">
    <h3 class="mb-4">Selamat Datang, <?php echo $_SESSION['admin']; ?> 👋</h3>

    <div class="row g-4 mb-4">
      <div class="col-md-4"><div class="card-stat"><h6>Total Produk</h6><h3><?php echo $total_products; ?></h3></div></div>
      <div class="col-md-4"><div class="card-stat"><h6>Total Artikel</h6><h3><?php echo $total_articles; ?></h3></div></div>
      <div class="col-md-4"><div class="card-stat"><h6>Pesan Customer</h6><h3><?php echo $total_messages; ?></h3></div></div>
    </div>

    <div class="row g-4">
      <div class="col-md-6">
        <div class="chart-container">
          <h6>Produk Terbaru</h6>
          <table class="table table-sm">
            <thead><tr><th>Nama</th><th>Stok</th><th>Status</th></tr></thead>
            <tbody>
              <?php while($p = $recent_products->fetch_assoc()): ?>
              <tr>
                <td><?= htmlspecialchars($p['name']) ?></td>
                <td><?= $p['stock'] ?></td>
                <td class="<?= $p['status']=='ready'?'text-success':'text-danger' ?>">
                  <?= ucfirst($p['status']) ?>
                </td>
              </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
        </div>
      </div>

      <div class="col-md-6">
        <div class="chart-container">
          <h6>Artikel Terbaru</h6>
          <table class="table table-sm">
            <thead><tr><th>Judul</th><th>Tanggal</th></tr></thead>
            <tbody>
              <?php while($a = $recent_articles->fetch_assoc()): ?>
              <tr>
                <td><?= htmlspecialchars($a['title']) ?></td>
                <td><?= date("d M Y", strtotime($a['created_at'])) ?></td>
              </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
        </div>
      </div>

      <div class="col-md-12">
        <div class="chart-container">
          <h6>Pesan Customer</h6>
          <table class="table table-striped">
            <thead><tr><th>Nama</th><th>Email</th><th>Pesan</th><th>Tanggal</th></tr></thead>
            <tbody>
              <?php while($m = $recent_messages->fetch_assoc()): ?>
              <tr>
                <td><?= htmlspecialchars($m['name']) ?></td>
                <td><?= htmlspecialchars($m['email']) ?></td>
                <td><?= htmlspecialchars(substr($m['message'], 0, 60)) ?>...</td>
                <td><?= date("d M Y", strtotime($m['created_at'])) ?></td>
              </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <footer>
      © <?= date('Y'); ?> Panel Admin — Desain Modern & Elegan
    </footer>
  </div>
</body>
</html>
