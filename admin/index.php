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
      background: #0d1b2a;
      color: #e0e1dd;
    }

    a {
      text-decoration: none;
    }

    /* === NAVBAR === */
    .navbar-custom {
      background: linear-gradient(135deg, #0d1b2a 0%, #1b263b 60%, #2b6777 100%);
      box-shadow: 0 3px 10px rgba(0,0,0,0.3);
      padding: 12px 40px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      position: sticky;
      top: 0;
      z-index: 1000;
    }

    .navbar-custom .navbar-brand {
      display: flex;
      align-items: center;
      gap: 10px;
      color: #f8f9fa;
      font-weight: 700;
      font-size: 20px;
      letter-spacing: 0.5px;
    }

    .navbar-custom .navbar-brand img {
      height: 45px;
      border-radius: 6px;
      background: none;
    }

    .navbar-custom .btn-logout {
      background: transparent;
      border: 1px solid #468faf;
      color: #e0e1dd;
      border-radius: 8px;
      padding: 8px 16px;
      font-weight: 600;
      transition: 0.3s;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .navbar-custom .btn-logout:hover {
      background: #468faf;
      color: white;
      transform: translateY(-2px);
    }

    /* === DASHBOARD WRAPPER === */
    .dashboard-wrapper {
      padding: 50px 60px;
    }

    .dashboard-header {
      margin-bottom: 40px;
    }

    .dashboard-header h2 {
      font-weight: 700;
      color: #f8f9fa;
    }

    .dashboard-header p {
      color: #adb5bd;
      margin-top: 6px;
    }

    /* === INFO CARDS === */
    .info-card {
      background: #1b263b;
      border-radius: 15px;
      padding: 25px 30px;
      display: flex;
      align-items: center;
      gap: 20px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.2);
      transition: 0.3s;
    }

    .info-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 18px rgba(0,0,0,0.3);
    }

    .info-card h5 {
      color: #e0e1dd;
      font-weight: 600;
      margin-bottom: 5px;
    }

    .info-card h2 {
      font-weight: 800;
      color: #f0c808;
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
    }

    .bg-product {
      background: linear-gradient(135deg, #0077b6, #00b4d8);
    }

    .bg-article {
      background: linear-gradient(135deg, #3a86ff, #90e0ef);
    }

    .bg-message {
      background: linear-gradient(135deg, #2a9d8f, #52b788);
    }

    /* === FOOTER === */
    footer {
      text-align: center;
      padding: 25px;
      color: #adb5bd;
      border-top: 1px solid #1e3d59;
      background: #0d1b2a;
      margin-top: 60px;
    }

    /* === RESPONSIVE === */
    @media (max-width: 992px) {
      .dashboard-wrapper {
        padding: 30px 20px;
      }
      .info-card {
        flex-direction: column;
        text-align: center;
      }
      .icon-box {
        margin-bottom: 10px;
      }
    }
  </style>
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar-custom">
    <a class="navbar-brand" href="index.php">
      <img src="../img/logo.png" alt="Asiatek Logo">
      <span>Admin Panel</span>
    </a>
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

    <div class="row g-4">
      <!-- Produk -->
      <div class="col-md-4">
        <div class="info-card">
          <div class="icon-box bg-product"><i class="fa fa-box"></i></div>
          <div>
            <h5>Total Produk</h5>
            <h2><?php echo $total_products; ?></h2>
          </div>
        </div>
      </div>

      <!-- Artikel -->
      <div class="col-md-4">
        <div class="info-card">
          <div class="icon-box bg-article"><i class="fa fa-newspaper"></i></div>
          <div>
            <h5>Total Artikel</h5>
            <h2><?php echo $total_articles; ?></h2>
          </div>
        </div>
      </div>

      <!-- Pesan -->
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
      <h6 style="color:#adb5bd;">Panel Admin <strong style="color:#f0c808;">Asiatek</strong> — dirancang untuk efisiensi & kemudahan kerja</h6>
    </div>
  </div>

  <!-- Footer -->
  <footer>
    © <?php echo date("Y"); ?> Asiatek. Semua Hak Dilindungi.
  </footer>
</body>
</html>
