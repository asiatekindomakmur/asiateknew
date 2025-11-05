<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
include 'config.php';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $image = '';

    // Upload gambar
    if (isset($_FILES['image']) && $_FILES['image']['name'] != '') {
        $targetDir = "uploads/produk/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }
        $fileName = time() . '_' . basename($_FILES['image']['name']);
        $targetFilePath = $targetDir . $fileName;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
            $image = $fileName;
        }
    }

    $stmt = $conn->prepare("INSERT INTO products (name, description, image, created_at) VALUES (?, ?, ?, NOW())");
    $stmt->bind_param("sss", $name, $description, $image);

    if ($stmt->execute()) {
        $_SESSION['message'] = ['type' => 'success', 'text' => 'Produk berhasil ditambahkan!'];
    } else {
        $_SESSION['message'] = ['type' => 'danger', 'text' => 'Gagal menambahkan produk.'];
    }

    header("Location: produk.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Produk</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/admin.css?v=2">
  <link rel="icon" type="image/png" href="/img/logo.png" />
  <style>
    :root {
      --primary: #0d6efd;
      --accent: #f4f6fb;
      --text-dark: #2e2e2e;
      --card-bg: #fff;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background: var(--accent);
      color: var(--text-dark);
      margin: 0;
      overflow-x: hidden;
    }

    /* SIDEBAR sama seperti index.php */
    .sidebar {
      position: fixed;
      left: 0;
      top: 0;
      width: 250px;
      height: 100vh;
      background: #fff;
      box-shadow: 3px 0 15px rgba(0, 0, 0, 0.05);
      padding: 30px 20px;
      display: flex;
      flex-direction: column;
      transition: 0.3s;
    }
    .sidebar .logo { text-align: center; margin-bottom: 40px; }
    .sidebar .logo img { width: 140px; height: auto; object-fit: contain; }
    .sidebar a { display: flex; align-items: center; gap: 12px; padding: 12px 18px; color: #555; border-radius: 10px; font-size: 15px; text-decoration: none; margin-bottom: 8px; transition: all 0.3s; }
    .sidebar a i { font-size: 17px; }
    .sidebar a:hover, .sidebar a.active { background: var(--primary); color: white; box-shadow: 0 4px 10px rgba(13, 110, 253, 0.2); }
    .logout-link { margin-top: auto; color: #dc3545; font-weight: 500; }
    .logout-link:hover { color: #b02a37; }

    /* MAIN CONTENT */
    .main-content {
      margin-left: 270px;
      padding: 40px 50px;
    }
    .main-header { margin-bottom: 40px; }
    .main-header h3 { font-weight: 700; color: var(--primary); }

    .card-form {
      background: var(--card-bg);
      border-radius: 16px;
      padding: 30px;
      box-shadow: 0 4px 14px rgba(0,0,0,0.06);
    }
    .card-form h4 { margin-bottom: 25px; color: var(--primary); font-weight: 700; }
    .btn-primary { background-color: var(--primary); border-radius: 10px; border: none; }
    .btn-secondary { border-radius: 10px; }
  </style>
</head>
<body>

  <!-- SIDEBAR -->
  <div class="sidebar">
    <div class="logo">
      <img src="../img/logo.png" alt="Logo">
    </div>
    <a href="index.php"><i class="fa-solid fa-house"></i> Dashboard</a>
    <a href="produk.php" class="active"><i class="fa-solid fa-box"></i> Produk</a>
    <a href="artikel.php"><i class="fa-solid fa-file-lines"></i> Artikel</a>
    <a href="messages.php"><i class="fa-solid fa-envelope"></i> Pesan</a>
    <a href="logout.php" class="logout-link"><i class="fa-solid fa-right-from-bracket"></i> Log Out</a>
  </div>

  <!-- MAIN CONTENT -->
  <div class="main-content">
    <div class="main-header">
      <h3>Tambah Produk Baru</h3>
      <p class="text-muted">Isi form berikut untuk menambahkan produk baru.</p>
    </div>

    <!-- NOTIFIKASI -->
    <?php if (isset($_SESSION['message'])): ?>
      <div class="alert alert-<?= $_SESSION['message']['type'] ?> alert-dismissible fade show" role="alert">
        <?= $_SESSION['message']['text'] ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      <?php unset($_SESSION['message']); ?>
    <?php endif; ?>

    <div class="card-form">
      <form method="post" enctype="multipart/form-data">
        <div class="mb-3">
          <label class="form-label">Nama Produk</label>
          <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Deskripsi</label>
          <textarea name="description" class="form-control" rows="5" required></textarea>
        </div>
        <div class="mb-3">
          <label class="form-label">Gambar</label>
          <input type="file" name="image" class="form-control">
        </div>
        <div class="text-end">
          <a href="produk.php" class="btn btn-secondary">Batal</a>
          <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>

  <!-- JS -->
  <script src="js/admin.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  
</body>
</html>
