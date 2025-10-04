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

// ==== Ambil data dari database ====
$total_products = 0;
$total_articles = 0;
$total_messages = 0;

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

  <style>
    body {
      background: #f8f9fb;
      font-family: 'Poppins', sans-serif;
      margin: 0;
    }

    /* Sidebar */
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

    /* Main Content */
    .main-content {
      margin-left: 260px;
      padding: 40px;
    }

    .card-stat {
      background: white;
      border-radius: 12px;
      padding: 25px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.05);
      text-align: center;
      transition: all 0.3s;
    }

    .card-stat:hover {
      transform: translateY(-3px);
    }

    .card-stat h6 {
      color: #6c757d;
      font-weight: 500;
    }

    .card-stat h3 {
      color: #0d6efd;
      font-weight: 700;
      margin-top: 10px;
    }

    /* Logout Button */
    .logout-link {
      color: #dc3545;
      text-decoration: none;
      display: flex;
      align-items: center;
      gap: 8px;
      margin-top: 40px;
    }

    .logout-link:hover {
      color: #b02a37;
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

    <a href="logout.php" class="logout-link"><i class="fa-solid fa-right-from-bracket"></i> Log Out</a>
  </div>

  <!-- MAIN CONTENT -->
  <div class="main-content">
    <h3 class="mb-5">Selamat Datang, <?php echo $_SESSION['admin']; ?> 👋</h3>

    <div class="row g-4">
      <div class="col-md-4">
        <div class="card-stat">
          <h6>Total Produk</h6>
          <h3><?php echo $total_products; ?></h3>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card-stat">
          <h6>Total Artikel</h6>
          <h3><?php echo $total_articles; ?></h3>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card-stat">
          <h6>Pesan Customer</h6>
          <h3><?php echo $total_messages; ?></h3>
        </div>
      </div>
    </div>
  </div>

</body>
</html>
