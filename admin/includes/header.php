<?php 
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Panel | Asiatek</title>
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <style>
    /* === FONT & GLOBAL === */
    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      padding: 0;
    }

    /* === HEADER NAVBAR (selaras dengan logo Asiatek) === */
    .navbar-custom {
      background: linear-gradient(135deg, #0d1b2a 0%, #1e3d59 60%, #2b6777 100%);
      box-shadow: 0 3px 8px rgba(0, 0, 0, 0.3);
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
      color: #f8f9fa;
      text-decoration: none;
      letter-spacing: 0.5px;
    }

    .navbar-custom .navbar-brand img {
      height: 45px;
      width: auto;
      border-radius: 6px;
      background: none;
      box-shadow: none;
      padding: 0;
    }

    .navbar-custom .navbar-brand span {
      text-shadow: 0 1px 3px rgba(0,0,0,0.3);
    }

    /* Tombol Logout */
    .navbar-custom .btn-logout {
      background: transparent;
      color: #e0e1dd;
      border: 1px solid #468faf;
      font-weight: 600;
      border-radius: 8px;
      padding: 8px 16px;
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .navbar-custom .btn-logout:hover {
      background: #468faf;
      color: #fff;
      transform: translateY(-1px);
      box-shadow: 0 4px 10px rgba(0,0,0,0.3);
    }

    /* === RESPONSIVE === */
    @media (max-width: 768px) {
      .navbar-custom {
        flex-direction: column;
        align-items: flex-start;
        padding: 10px 20px;
      }

      .navbar-custom .btn-logout {
        align-self: flex-end;
        margin-top: 10px;
      }
    }
  </style>
</head>

<body>
  <!-- Header / Navbar -->
  <nav class="navbar-custom">
    <a class="navbar-brand" href="index.php">
      <img src="../img/logo.png" alt="Asiatek Logo">
      <span>Admin Panel</span>
    </a>
    <a href="logout.php" class="btn btn-logout">
      <i class="fa fa-sign-out-alt"></i> Logout
    </a>
  </nav>
