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
      min-height: 100vh;
      overflow-x: hidden;
    }

    a {
      text-decoration: none;
      color: inherit;
    }

    /* === SIDEBAR === */
    .sidebar {
      width: 260px;
      background: linear-gradient(180deg, #b8860b, #ffd700);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 25px 0;
      box-shadow: 4px 0 12px rgba(0, 0, 0, 0.15);
      position: fixed;
      left: 0;
      top: 0;
      transition: width 0.3s ease;
      overflow: hidden;
    }

    .sidebar.collapsed {
      width: 90px;
    }

    .sidebar img {
      height: 60px;
      margin-bottom: 20px;
      transition: opacity 0.3s ease, transform 0.3s ease;
    }

    .sidebar.collapsed img {
      transform: scale(0.8);
    }

    .toggle-btn {
      position: absolute;
      top: 20px;
      right: -15px;
      background: #fff;
      color: #b8860b;
      border-radius: 50%;
      width: 35px;
      height: 35px;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      box-shadow: 0 2px 6px rgba(0,0,0,0.15);
      transition: all 0.3s ease;
      z-index: 1000;
    }

    .toggle-btn:hover {
      background: #b8860b;
      color: #fff;
    }

    /* Tombol Logout di atas menu */
    .logout-btn {
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

    .logout-btn:hover {
      background: #b8860b;
      color: white;
      transform: translateY(-2px);
    }

    /* Menu */
    .sidebar nav {
      display: flex;
      flex-direction: column;
      width: 100%;
      gap: 5px;
      margin-top: 10px;
    }

    .sidebar a {
      display: flex;
      align-items: center;
      gap: 12px;
      color: #fff;
      font-weight: 600;
      padding: 12px 25px;
      transition: all 0.3s ease;
      font-size: 15px;
      white-space: nowrap;
    }

    .sidebar a:hover,
    .sidebar a.active {
      background: rgba(255, 255, 255, 0.25);
      text-shadow: 0 0 8px rgba(255,255,255,0.8);
      border-left: 4px solid #fff;
      padding-left: 22px;
    }

    .sidebar.collapsed a span,
    .sidebar.collapsed .logout-btn span {
      display: none;
    }

    .sidebar.collapsed .logout-btn {
      width: 45px;
      padding: 10px 0;
      text-align: center;
    }

    /* === MAIN CONTENT === */
    .main-content {
      margin-left: 260px;
      padding: 50px 60px;
      background: #fff;
      flex: 1;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      min-height: 100vh;
      transition: margin-left 0.3s ease;
    }

    .collapsed + .main-content {
      margin-left: 90px;
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
      margin-top: 60px;
      text-align: center;
      padding: 40px 20px;
      color: #f2f3f4;
      background: linear-gradient(135deg, #0d1b2a, #1b263b, #2a3f5f);
      border-top: 3px solid #b8860b;
      box-shadow: 0 -4px 10px rgba(0,0,0,0.3);
      font-size: 16px;
      border-radius: 10px;
    }

    footer strong {
      color: #ffd700;
    }

    @media (max-width: 992px) {
      .sidebar {
        position: fixed;
        z-index: 2000;
      }
      .main-content {
        margin-left: 90px;
        padding: 30px 20px;
      }
    }
  </style>
</head>

<body>

  <!-- Sidebar -->
  <aside class="sidebar" id="sidebar">
    <div class="toggle-btn" id="toggle-btn"><i class="fa fa-bars"></i></div>
    <img src="../img/logo.png" alt="Asiatek Logo">

    <!-- Logout di atas -->
    <a href="logout.php" class="logout-btn"><i class="fa fa-sign-out-alt"></i> <span>Logout</span></a>

    <nav>
      <a href="index.php" class="active"><i class="fa fa-gauge"></i> <span>Dashboard</span></a>
      <a href="products.php"><i class="fa fa-box"></i> <span>Produk</span></a>
      <a href="articles.php"><i class="fa fa-newspaper"></i> <span>Artikel</span></a>
      <a href="messages.php"><i class="fa fa-envelope"></i> <span>Pesan Customer</span></a>
    </nav>
  </aside>

  <!-- Main Content -->
  <div class="main-content" id="main-content">
    <div>
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
    </div>

    <footer>
      © <?php echo date("Y"); ?> <strong>Asiatek</strong>. Semua Hak Dilindungi.
    </footer>
  </div>

  <script>
    const toggleBtn = document.getElementById('toggle-btn');
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('main-content');

    toggleBtn.addEventListener('click', () => {
      sidebar.classList.toggle('collapsed');
      mainContent.classList.toggle('collapsed');
    });
  </script>

</body>
</html>
