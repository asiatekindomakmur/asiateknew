<?php 
session_start();
if (!isset($_SESSION['admin'])) { 
  header("Location: login.php"); 
  exit; 
} 
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <title>Admin Panel</title>

  <style>
    /* ==== NAVBAR STYLE ==== */
    .navbar-custom {
      background: linear-gradient(135deg, #b8860b, #ffd700);
      box-shadow: 0 3px 8px rgba(0, 0, 0, 0.25);
      padding: 10px 20px;
      position: sticky;
      top: 0;
      z-index: 1000;
    }

    .navbar-custom .navbar-brand {
      display: flex;
      align-items: center;
      font-weight: 700;
      color: #fff !important;
      letter-spacing: 0.5px;
      text-shadow: 0 1px 2px rgba(0,0,0,0.2);
      transition: all 0.3s ease;
    }

    .navbar-custom .navbar-brand img {
      height: 40px;
      width: auto;
      margin-right: 10px;
      border-radius: 8px;
      background: #fff;
      padding: 3px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.2);
    }

    .navbar-custom .navbar-brand:hover {
      color: #fffacd !important;
      transform: scale(1.03);
    }

    .navbar-custom .btn-logout {
      background: #fff;
      color: #b8860b;
      border: none;
      font-weight: 600;
      border-radius: 8px;
      padding: 6px 16px;
      transition: all 0.3s ease;
    }

    .navbar-custom .btn-logout:hover {
      background: #b8860b;
      color: #fff;
      transform: translateY(-1px);
      box-shadow: 0 3px 8px rgba(0,0,0,0.2);
    }

    /* ==== SIDEBAR STYLE ==== */
    .sidebar {
      background: #fffdfa;
      border-right: 1px solid #e0c97f;
      min-height: 100vh;
      padding-top: 20px;
      position: sticky;
      top: 56px; /* Tinggi navbar agar sidebar tidak tertutup */
    }

    .sidebar h6 {
      font-weight: 700;
      color: #b8860b;
      margin-bottom: 15px;
      padding-left: 10px;
    }

    .sidebar a {
      color: #444;
      text-decoration: none;
      display: block;
      padding: 8px 12px;
      border-radius: 8px;
      margin: 5px 8px;
      transition: all 0.2s ease;
      font-weight: 500;
    }

    .sidebar a:hover {
      background: linear-gradient(135deg, #fff4cc, #ffe680);
      color: #b8860b;
      font-weight: 600;
    }

    /* ==== MAIN CONTENT ==== */
    .content {
      padding: 25px;
      background: #f9f9f9;
      min-height: calc(100vh - 56px);
    }

    .content h3 {
      font-weight: 700;
      color: #b8860b;
      margin-bottom: 20px;
    }
  </style>
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-custom">
    <a class="navbar-brand ms-2" href="index.php">
      <img src="../img/logo.png" alt="Logo"> <!-- Logo di luar folder admin -->
      Admin Panel
    </a>
    <div class="ms-auto me-3">
      <a href="logout.php" class="btn btn-logout btn-sm">Logout</a>
    </div>
  </nav>

  <!-- Sidebar + Content -->
  <div class="container-fluid">
    <div class="row">
      <div class="col-2 sidebar">
        <h6>Menu</h6>
        <a href="index.php">🏠 Dashboard</a>
        <a href="products.php">📦 Produk</a>
        <a href="articles.php">📰 Artikel</a>
        <a href="messages.php">✉️ Pesan</a>
      </div>
      <div class="col-10 content">
        <h3>Selamat Datang, <?php echo $_SESSION['admin']; ?> 👋</h3>
        <p>Ini adalah panel admin <strong>Asiatek</strong>. Gunakan menu di sebelah kiri untuk mengelola konten website.</p>
      </div>
    </div>
  </div>

</body>
</html>
