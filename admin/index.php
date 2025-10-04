<?php 
session_start();
if (!isset($_SESSION['admin'])) { 
  header("Location: login.php"); 
  exit; 
} 

include 'config.php';
include 'includes/header.php';

// Ambil data dari database (contoh hitung total data)
$total_products = $conn->query("SELECT COUNT(*) as total FROM products")->fetch_assoc()['total'] ?? 0;
$total_articles = $conn->query("SELECT COUNT(*) as total FROM articles")->fetch_assoc()['total'] ?? 0;
$total_messages = $conn->query("SELECT COUNT(*) as total FROM messages")->fetch_assoc()['total'] ?? 0;
?>

<!-- ==== DASHBOARD CONTENT ==== -->
<div class="container-fluid content-wrapper">
  <div class="dashboard-header mb-4">
    <h2>Selamat Datang, <?php echo $_SESSION['admin']; ?> 👋</h2>
    <p class="text-muted">Berikut ringkasan aktivitas website Anda hari ini.</p>
  </div>

  <div class="row g-4">
    <!-- Produk -->
    <div class="col-md-4">
      <div class="info-card">
        <div class="icon-box bg-product">
          <i class="fa fa-box"></i>
        </div>
        <div>
          <h5>Total Produk</h5>
          <h2><?php echo $total_products; ?></h2>
        </div>
      </div>
    </div>

    <!-- Artikel -->
    <div class="col-md-4">
      <div class="info-card">
        <div class="icon-box bg-article">
          <i class="fa fa-newspaper"></i>
        </div>
        <div>
          <h5>Total Artikel</h5>
          <h2><?php echo $total_articles; ?></h2>
        </div>
      </div>
    </div>

    <!-- Pesan -->
    <div class="col-md-4">
      <div class="info-card">
        <div class="icon-box bg-message">
          <i class="fa fa-envelope"></i>
        </div>
        <div>
          <h5>Pesan Masuk</h5>
          <h2><?php echo $total_messages; ?></h2>
        </div>
      </div>
    </div>
  </div>

  <div class="mt-5 text-center">
    <h5 class="text-muted">Panel Admin Asiatek — Didesain untuk kemudahan & kecepatan kerja</h5>
  </div>
</div>

<?php include 'includes/footer.php'; ?>

<style>
  /* ==== DASHBOARD STYLE ==== */
  .content-wrapper {
    background: #fdfcf8;
    min-height: calc(100vh - 80px);
    padding: 40px 50px;
    font-family: 'Poppins', sans-serif;
  }

  .dashboard-header h2 {
    font-weight: 700;
    color: #b8860b;
  }

  .info-card {
    background: #fff;
    border-radius: 15px;
    padding: 25px 30px;
    display: flex;
    align-items: center;
    justify-content: flex-start;
    gap: 20px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
  }

  .info-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 6px 18px rgba(0,0,0,0.15);
  }

  .info-card h5 {
    font-weight: 600;
    color: #555;
    margin-bottom: 6px;
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
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
  }

  .bg-product {
    background: linear-gradient(135deg, #b8860b, #ffd700);
  }

  .bg-article {
    background: linear-gradient(135deg, #ff9800, #ffc107);
  }

  .bg-message {
    background: linear-gradient(135deg, #007bff, #00bcd4);
  }

  .text-muted {
    color: #6c757d !important;
  }
</style>
