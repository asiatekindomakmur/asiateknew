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
      display: flex;
    }

    a {
      text-decoration: none;
      color: inherit;
    }

    /* === SIDEBAR === */
    .sidebar {
      width: 250px;
      background: linear-gradient(180deg, #b8860b, #ffd700);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 30px 0;
      box-shadow: 4px 0 12px rgba(0, 0, 0, 0.15);
      position: fixed;
      left: 0;
      top: 0;
    }

    .sidebar img {
      height: 60px;
      margin-bottom: 25px;
    }

    .sidebar nav {
      display: flex;
      flex-direction: column;
      width: 100%;
    }

    .sidebar a {
      display: flex;
      align-items: center;
      gap: 12px;
      color: #fff;
      font-weight: 600;
      padding: 12px 30px;
      transition: all 0.3s ease;
      font-size: 15px;
    }

    .sidebar a:hover,
    .sidebar a.active {
      background: rgba(255, 255, 255, 0.25);
      color: #fff;
      text-shadow: 0 0 8px rgba(255,255,255,0.8);
    }

    .sidebar .logout-btn {
      margin-top: auto;
      background: #fff;
      color: #b8860b;
      border: none;
      border-radius: 8px;
      padding: 10px 20px;
      font-weight: 600;
      margin-bottom: 20px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.15);
      transition: all 0.3s ease;
    }

    .sidebar .logout-btn:hover {
      background: #b8860b;
      color: white;
      transform: translateY(-2px);
    }

    /* === MAIN CONTENT === */
    .main-content {
      margin-left: 250px;
      padding: 50px 60px;
      background: #fff;
      flex: 1;
      min-height: 100vh;
    }

    .dashboard-header {
      margin-bottom: 40px;
    }

    .dashboard-header h2 {
      font-weight: 700;
      color: #b8860b;
    }

    .dashboard-header p {
      color: #666;
      margin-top: 6px;
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

    .bg-product,
    .bg-article,
    .bg-message {
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
      .sidebar {
        width: 100%;
        height: auto;
        flex-direction: row;
        justify-content: space-between;
        padding: 15px 20px;
      }

      .sidebar nav {
        flex-direction: row;
        justify-content: space-around;
        width: 100%;
      }

      .main-content {
        margin-left: 0;
        padding: 30px 20px;
      }
    }
  </style>
</head>

<body>

  <!-- Sidebar -->
  <aside class="sidebar">
    <img src="../img/logo.png" alt="Asiatek Logo">
    <nav>
      <a href="index.php" class="active"><i class="fa fa-gauge"></i> Dashboard</a>
      <a href="products.php"><i class="fa fa-box"></i> Produk</a>
      <a href="articles.php"><i class="fa fa-newspaper"></i> Artikel</a>
      <a href="messages.php"><i class="fa fa-envelope"></i> Pesan Customer</a>
    </nav>
    <a href="logout.php" class="logout-btn"><i class="fa fa-sign-out-alt"></i> Logout</a>
  </aside>

  <!-- Main Content -->
  <div class="main-content">
    <div class="dashboard-header">
      <h2>Selamat Datang, <?php echo $_SESSION['admin']; ?> 👋</h2>
      <p>Berikut ringkasan aktivitas website Anda hari ini.</p>
    </div>

    <div class="row g-4">
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

    <footer>
      © <?php echo date("Y"); ?> <strong>Asiatek</strong>. Semua Hak Dilindungi.
    </footer>
  </div>

</body>
</html>
