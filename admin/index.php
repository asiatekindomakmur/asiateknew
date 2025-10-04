<?php 
session_start();
if (!isset($_SESSION['admin'])) { 
  header("Location: login.php"); 
  exit; 
} 

// koneksi database
$host = 'localhost';
$user = 'u429834259_admin';
$pass = 'Sqwe123@@';
$db   = 'u429834259_asiatekindo';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
}

// ambil data dashboard
$total_products = $conn->query("SELECT COUNT(*) as total FROM products")->fetch_assoc()['total'] ?? 0;
$total_articles = $conn->query("SELECT COUNT(*) as total FROM articles")->fetch_assoc()['total'] ?? 0;
$total_messages = $conn->query("SELECT COUNT(*) as total FROM messages")->fetch_assoc()['total'] ?? 0;
?>

<!doctype html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Admin Panel | Asiatek</title>
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      background: #fff;
      color: #333;
      display: flex;
      min-height: 100vh;
    }

    /* === SIDEBAR === */
    .sidebar {
      width: 240px;
      background: linear-gradient(180deg, #b8860b, #ffd700);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 30px 0;
      box-shadow: 3px 0 12px rgba(0, 0, 0, 0.15);
      position: fixed;
      left: 0;
      top: 0;
    }

    .sidebar img {
      height: 70px;
      margin-bottom: 25px;
    }

    .sidebar nav {
      display: flex;
      flex-direction: column;
      width: 100%;
      gap: 8px;
      margin-top: 20px;
    }

    .sidebar a {
      display: flex;
      align-items: center;
      gap: 12px;
      color: #fff;
      font-weight: 600;
      padding: 12px 25px;
      transition: 0.3s;
      font-size: 15px;
      width: 100%;
    }

    .sidebar a:hover,
    .sidebar a.active {
      background: rgba(255, 255, 255, 0.25);
      border-left: 4px solid white;
      padding-left: 21px;
    }

    .logout-btn {
      margin-top: auto;
      background: #fff;
      color: #b8860b;
      border: none;
      border-radius: 10px;
      padding: 10px 20px;
      font-weight: 600;
      box-shadow: 0 2px 6px rgba(0,0,0,0.15);
      transition: 0.3s;
    }

    .logout-btn:hover {
      background: #b8860b;
      color: white;
      transform: translateY(-2px);
    }

    /* === MAIN CONTENT === */
    .main-content {
      margin-left: 240px;
      padding: 50px 60px;
      background: #fff;
      width: 100%;
    }

    .dashboard-header {
      margin-bottom: 40px;
    }

    .dashboard-header h2 {
      font-weight: 700;
      color: #b8860b;
      font-size: 26px;
    }

    .dashboard-header p {
      color: #666;
      margin-top: 6px;
      font-size: 15px;
    }

    /* === INFO CARDS === */
    .info-card {
      background: #000;
      border-radius: 15px;
      padding: 25px 30px;
      display: flex;
      align-items: center;
      gap: 20px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.15);
      transition: 0.3s;
      color: white;
    }

    .info-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 6px 16px rgba(0,0,0,0.25);
    }

    .info-card h5 {
      color: #ffd700;
      font-weight: 600;
      margin-bottom: 5px;
    }

    .info-card h2 {
      font-weight: 800;
      color: white;
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
      background: #b8860b;
      box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }

    footer {
      margin-top: 80px;
      text-align: center;
      padding: 25px;
      color: #f2f3f4;
      background: linear-gradient(135deg, #0d1b2a, #1b263b, #2a3f5f);
      border-top: 3px solid #b8860b;
      border-radius: 10px;
    }

    footer strong {
      color: #ffd700;
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

  <!-- Main -->
  <div class="main-content">
    <div class="dashboard-header">
      <h2>Selamat Datang, <?php echo $_SESSION['admin']; ?> 👋</h2>
      <p>Berikut ringkasan aktivitas website Anda hari ini.</p>
    </div>

    <div class="row g-4">
      <div class="col-md-4">
        <div class="info-card">
          <div class="icon-box"><i class="fa fa-box"></i></div>
          <div>
            <h5>Total Produk</h5>
            <h2><?php echo $total_products; ?></h2>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="info-card">
          <div class="icon-box"><i class="fa fa-newspaper"></i></div>
          <div>
            <h5>Total Artikel</h5>
            <h2><?php echo $total_articles; ?></h2>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="info-card">
          <div class="icon-box"><i class="fa fa-envelope"></i></div>
          <div>
            <h5>Pesan Masuk</h5>
            <h2><?php echo $total_messages; ?></h2>
          </div>
        </div>
      </div>
    </div>

    <footer>
      © <?php echo date("Y"); ?> <strong>Asiatek</strong>. Semua Hak Dilindungi.
    </footer>
  </div>

</body>
</html>
