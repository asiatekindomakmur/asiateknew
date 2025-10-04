<?php 
session_start();
if (!isset($_SESSION['admin'])) { 
  header("Location: login.php"); 
  exit; 
} 

include 'config.php';

// Ambil data dari database
$total_products = $conn->query("SELECT COUNT(*) as total FROM products")->fetch_assoc()['total'] ?? 0;
$total_articles = $conn->query("SELECT COUNT(*) as total FROM articles")->fetch_assoc()['total'] ?? 0;
$total_messages = $conn->query("SELECT COUNT(*) as total FROM messages")->fetch_assoc()['total'] ?? 0;
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Panel | Asiatek</title>
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    /* === GLOBAL === */
    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      background: #ffffff;
      color: #333;
    }

    a {
      text-decoration: none;
    }

    /* === NAVBAR === */
    .navbar-custom {
      background: linear-gradient(135deg, #b8860b, #ffd700);
      box-shadow: 0 4px 12px rgba(0,0,0,0.25);
      padding: 12px 40px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      position: sticky;
      top: 0;
      z-index: 1000;
      border-bottom: 2px solid rgba(255,255,255,0.2);
    }

    .navbar-left {
      display: flex;
      align-items: center;
      gap: 25px;
    }

    .navbar-brand img {
      height: 45px;
    }

    .navbar-menu {
      display: flex;
      align-items: center;
      gap: 40px;
      margin-left: 40px;
    }

    .navbar-menu a {
      color: #fff;
      font-weight: 600;
      transition: 0.3s;
      font-size: 16px;
      display: flex;
      align-items: center;
      gap: 8px;
      position: relative;
      text-transform: capitalize;
    }

    .navbar-menu a::after {
      content: '';
      position: absolute;
      bottom: -6px;
      left: 0;
      width: 0%;
      height: 2px;
      background: white;
      transition: 0.3s;
    }

    .navbar-menu a:hover::after {
      width: 100%;
    }

    .navbar-menu a:hover {
      color: #fff;
      transform: translateY(-2px);
      text-shadow: 0 0 10px rgba(255,255,255,0.7);
    }

    .btn-logout {
      background: #fff;
      border: none;
      color: #b8860b;
      border-radius: 8px;
      padding: 8px 16px;
      font-weight: 600;
      transition: 0.3s;
      display: flex;
      align-items: center;
      gap: 8px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.15);
    }

    .btn-logout:hover {
      background: #b8860b;
      color: white;
      transform: translateY(-2px);
    }

    /* === DASHBOARD === */
    .dashboard-wrapper {
      padding: 50px 60px;
      background: #fff;
      min-height: calc(100vh - 120px);
    }

    .dashboard-header {
      text-align: center;
      margin-bottom: 40px;
    }

    .dashboard-header h2 {
      font-weight: 700;
      color: #b8860b;
      font-size: 28px;
    }

    .dashboard-header p {
      color: #666;
      margin-top: 6px;
      font-size: 15px;
    }

    /* === INFO CARDS === */
    .info-card {
      background: #ffffff;
      border-radius: 15px;
      padding: 25px 30px;
      display: flex;
      align-items: center;
      gap: 20px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.08);
      transition: 0.3s;
      border: 1px solid #f0e6c8;
    }

    .info-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 6px 16px rgba(0,0,0,0.12);
    }

    .info-card h5 {
      color: #555;
      font-weight: 600;
      margin-bottom: 5px;
    }

    .info-card h2 {
      font-weight: 800;
      color: #b8860b;
      margin: 0;
    }

    .icon-box {
      width: 70px;
      height: 70px;
      border-radius: 15px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-size: 28px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    }

    .bg-product, .bg-article, .bg-message {
      background: linear-gradient(135deg, #000000, #434343);
    }

    /* === FOOTER === */
    footer {
      text-align: center;
      padding: 25px;
      color: #e0e1dd;
      background: linear-gradient(135deg, #0d1b2a, #1b263b, #2a3f5f);
      border-top: 2px solid #b8860b;
      margin-top: 60px;
      box-shadow: 0 -4px 10px rgba(0,0,0,0.2);
    }

    footer strong {
      color: #ffd700;
    }

    /* === RESPONSIVE === */
    @media (max-width: 992px) {
      .navbar-custom {
        flex-direction: column;
        align-items: flex-start;
        padding: 15px 20px;
      }
      .navbar-menu {
        flex-wrap: wrap;
        gap: 15px;
        margin-left: 0;
      }
      .dashboard-wrapper {
        padding: 30px 20px;
      }
    }
  </style>
</head>

<body>

  <!-- Navbar -->
  <nav class="navbar-custom">
    <div class="navbar-left">
      <a class="navbar-brand" href="index.php">
        <img src="../img/logo.png" alt="Asiatek Logo">
      </a>
      <div class="navbar-menu">
        <a href="index.php"><i class="fa fa-gauge"></i> Dashboard</a>
        <a href="products.php"><i class="fa fa-box"></i> Produk</a>
        <a href="articles.php"><i class="fa fa-newspaper"></i> Artikel</a>
        <a href="messages.php"><i class="fa fa-envelope"></i> Pesan Customer</a>
      </div>
    </div>
    <a href="logout.php" class="btn btn-logout">
      <i class="fa fa-sign-out-alt"></i> Logout
    </a>
  </nav>

  <!-- Dashboard Content -->
  <div class="dashboard-wrapper">
    <div class="dashboard-header">
      <h2>Selamat Datang, <?php echo $_SESSION['admin']; ?> 👋</h2>
      <p>Berikut ringkasan aktivitas website Anda hari ini.</p>
    </div>

    <div class="row g-4 text-center">
      <div class="col-md-4">
        <div class="info-card">
          <div class="icon-box bg-product"><i class="fa fa-box"></i></div>
          <div>
            <h5>Total Produk</h5>
            <h2><?php echo $total_products; ?></h2>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="info-card">
          <div class="icon-box bg-article"><i class="fa fa-newspaper"></i></div>
          <div>
            <h5>Total Artikel</h5>
            <h2><?php echo $total_articles; ?></h2>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="info-card">
          <div class="icon-box bg-message"><i class="fa fa-envelope"></i></div>
          <div>
            <h5>Pesan Masuk</h5>
            <h2><?php echo $total_messages; ?></h2>
          </div>
        </div>
      </div>
    </div>

    <div class="text-center mt-5">
      <h6 style="color:#666;">Panel Admin <strong style="color:#b8860b;">Asiatek</strong> — dirancang untuk efisiensi & kemudahan kerja</h6>
    </div>
  </div>

  <!-- Footer -->
  <footer>
    © <?php echo date("Y"); ?> <strong>Asiatek</strong>. Semua Hak Dilindungi.
  </footer>

</body>
</html>
