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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <title>Admin Panel | Asiatek</title>

  <style>
    /* === FONT & GLOBAL === */
    body {
      font-family: 'Poppins', sans-serif;
      background: #0d1b2a;
      margin: 0;
      padding: 0;
      color: #e0e1dd;
    }

    /* === NAVBAR ELEGAN BIRU === */
    .navbar-custom {
      background: linear-gradient(135deg, #0d1b2a, #1b263b);
      box-shadow: 0 3px 8px rgba(0,0,0,0.3);
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
      gap: 12px;
      font-weight: 700;
      font-size: 20px;
      color: #e0e1dd;
      text-decoration: none;
      letter-spacing: 0.5px;
    }

    .navbar-custom .navbar-brand img {
      height: 45px;
      width: auto;
      border-radius: 6px;
      background: transparent;
      padding: 0;
      box-shadow: none;
    }

    .navbar-custom .navbar-brand span {
      text-shadow: 0 1px 3px rgba(0,0,0,0.3);
    }

    .navbar-custom .btn-logout {
      background: transparent;
      color: #e0e1dd;
      border: 1px solid #415a77;
      font-weight: 600;
      border-radius: 10px;
      padding: 8px 16px;
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .navbar-custom .btn-logout:hover {
      background: #415a77;
      color: #fff;
      transform: translateY(-1px);
      box-shadow: 0 4px 10px rgba(0,0,0,0.3);
    }

    /* === SIDEBAR === */
    .sidebar {
      background: #1b263b;
      border-right: 1px solid #415a77;
      min-height: 100vh;
      padding-top: 25px;
      position: fixed;
      width: 220px;
      top: 70px;
      left: 0;
    }

    .sidebar h6 {
      font-weight: 700;
      color: #778da9;
      margin-bottom: 15px;
      padding-left: 15px;
      text-transform: uppercase;
      font-size: 14px;
    }

    .sidebar a {
      color: #e0e1dd;
      text-decoration: none;
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 10px 15px;
      border-radius: 8px;
      margin: 5px 10px;
      transition: all 0.2s ease;
      font-weight: 500;
    }

    .sidebar a:hover,
    .sidebar a.active {
      background: #415a77;
      color: #fff;
      font-weight: 600;
    }

    .sidebar a i {
      width: 20px;
      text-align: center;
    }

    /* === CONTENT === */
    .content {
      margin-left: 220px;
      padding: 40px;
      background: #0d1b2a;
      min-height: calc(100vh - 70px);
    }

    .content h3 {
      font-weight: 700;
      color: #e0e1dd;
      margin-bottom: 10px;
    }

    .content p {
      color: #adb5bd;
      font-size: 15px;
    }

    /* === RESPONSIVE === */
    @media (max-width: 992px) {
      .sidebar {
        display: none;
      }
      .content {
        margin-left: 0;
      }
      .navbar-custom {
        flex-direction: column;
        align-items: flex-start;
        gap: 8px;
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
    <a href="logout.php" class="btn btn-logout btn-sm">
      <i class="fa fa-sign-out-alt"></i> Logout
    </a>
  </nav>

  <!-- Sidebar -->
  <div class="sidebar">
    <h6>Menu</h6>
    <a href="index.php" class="active"><i class="fa fa-home"></i> Dashboard</a>
    <a href="products.php"><i class="fa fa-box"></i> Produk</a>
    <a href="articles.php"><i class="fa fa-newspaper"></i> Artikel</a>
    <a href="messages.php"><i class="fa fa-envelope"></i> Pesan</a>
  </div>

  <!-- Content -->
  <div class="content">
    <h3>Selamat Datang, <?php echo $_SESSION['admin']; ?> 👋</h3>
    <p>Ini adalah panel admin <strong>Asiatek</strong>. Gunakan menu di sebelah kiri untuk mengelola konten website Anda.</p>
  </div>
</body>
</html>
