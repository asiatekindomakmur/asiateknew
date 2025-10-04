<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit;
}

include 'config.php';

// --- Ambil data dari database ---
$total_products = $conn->query("SELECT COUNT(*) AS total FROM products")->fetch_assoc()['total'] ?? 0;
$total_users = $conn->query("SELECT COUNT(*) AS total FROM users")->fetch_assoc()['total'] ?? 0;
$total_sales = $conn->query("SELECT SUM(total_price) AS total FROM orders")->fetch_assoc()['total'] ?? 0;
$total_views = $conn->query("SELECT COUNT(*) AS total FROM visitors")->fetch_assoc()['total'] ?? 0;

$recent_products = $conn->query("SELECT id, name, stock, status, created_at FROM products ORDER BY created_at DESC LIMIT 5");
$recent_activities = $conn->query("SELECT user, activity, time FROM activities ORDER BY time DESC LIMIT 5");
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
      overflow-x: hidden;
    }

    .sidebar {
      position: fixed;
      left: 0;
      top: 0;
      width: 240px;
      height: 100vh;
      background: #ffffff;
      box-shadow: 2px 0 10px rgba(0,0,0,0.05);
      padding: 30px 20px;
    }

    .sidebar .logo {
      font-weight: 700;
      font-size: 22px;
      color: #0d6efd;
      margin-bottom: 30px;
    }

    .sidebar h6 {
      font-size: 12px;
      color: #999;
      margin: 25px 0 10px;
      letter-spacing: 1px;
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

    .topbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 30px;
    }

    .topbar .search-box input {
      border: 1px solid #ddd;
      border-radius: 8px;
      padding: 8px 12px;
      width: 250px;
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

    table {
      font-size: 14px;
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

  <!-- ===== SIDEBAR ===== -->
  <div class="sidebar">
    <div class="logo"><i class="fa-solid fa-chart-line"></i> Dashboard</div>

    <h6>MENU</h6>
    <a href="#" class="active"><i class="fa-solid fa-home"></i> Dashboard</a>
    <a href="#"><i class="fa-solid fa-box"></i> Produk</a>
    <a href="#"><i class="fa-solid fa-file-alt"></i> Artikel</a>
    <a href="#"><i class="fa-solid fa-envelope"></i> Pesan Customer</a>

    <h6>PROFIL</h6>
    <a href="#"><i class="fa-solid fa-gear"></i> Pengaturan</a>
    <a href="#"><i class="fa-solid fa-user"></i> Akun</a>

    <div class="mt-auto pt-3">
      <a href="logout.php" style="color:#dc3545;"><i class="fa-solid fa-right-from-bracket"></i> Log Out</a>
    </div>
  </div>

  <!-- ===== MAIN CONTENT ===== -->
  <div class="main-content">
    <div class="topbar">
      <h3>Selamat Datang, <?php echo $_SESSION['admin']; ?> 👋</h3>
      <div class="search-box">
        <input type="text" placeholder="Cari sesuatu...">
      </div>
    </div>

    <div class="row g-4 mb-4">
      <div class="col-md-3"><div class="card-stat"><h6>Total Produk</h6><h3><?php echo $total_products; ?></h3></div></div>
      <div class="col-md-3"><div class="card-stat"><h6>Total Pengguna</h6><h3><?php echo $total_users; ?></h3></div></div>
      <div class="col-md-3"><div class="card-stat"><h6>Total Penjualan</h6><h3>$<?php echo number_format($total_sales,2); ?></h3></div></div>
      <div class="col-md-3"><div class="card-stat"><h6>Total Tampilan</h6><h3><?php echo $total_views; ?></h3></div></div>
    </div>

    <div class="row g-4">
      <div class="col-md-8">
        <div class="chart-container">
          <h6>Pengguna Aktif Bulanan</h6>
          <canvas id="userChart" height="150"></canvas>
        </div>
      </div>

      <div class="col-md-4">
        <div class="chart-container">
          <h6>Produk Terbaru</h6>
          <table class="table table-sm table-borderless">
            <thead>
              <tr>
                <th>No</th><th>Produk</th><th>Stok</th><th>Status</th>
              </tr>
            </thead>
            <tbody>
              <?php $no=1; while($p=$recent_products->fetch_assoc()): ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><?= htmlspecialchars($p['name']) ?></td>
                  <td><?= $p['stock'] ?></td>
                  <td><span class="<?= $p['status']=='ready'?'text-success':'text-danger' ?>">
                    <?= ucfirst($p['status']) ?></span></td>
                </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
        </div>
      </div>

      <div class="col-md-12">
        <div class="chart-container">
          <h6>Aktivitas Terakhir</h6>
          <table class="table table-striped">
            <thead><tr><th>Waktu</th><th>Pengguna</th><th>Aktivitas</th></tr></thead>
            <tbody>
              <?php while($a=$recent_activities->fetch_assoc()): ?>
              <tr>
                <td><?= $a['time'] ?></td>
                <td><?= htmlspecialchars($a['user']) ?></td>
                <td><?= htmlspecialchars($a['activity']) ?></td>
              </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <footer>
      © <?php echo date('Y'); ?> Panel Admin — Desain Modern & Elegan
    </footer>
  </div>

  <script>
    const ctx = document.getElementById('userChart');
    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'],
        datasets: [{
          label: 'Pengguna Aktif',
          data: [120, 90, 150, 180, 210, 170, 220, 240, 260, 300, 280, 320],
          backgroundColor: '#0d6efd'
        }]
      },
      options: {
        responsive: true,
        scales: { y: { beginAtZero: true } },
        plugins: { legend: { display: false } }
      }
    });
  </script>
</body>
</html>
