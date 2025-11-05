<?php
session_start();
if (!isset($_SESSION['admin'])) { header("Location: login.php"); exit; }
include 'config.php';

if(isset($_POST['submit'])){
    $title = $_POST['title'];
    $description = $_POST['description'];
    $image = '';

    // Upload gambar jika ada
    if(isset($_FILES['image']) && $_FILES['image']['name'] != ''){
        $targetDir = "uploads/artikel/";
        if(!is_dir($targetDir)) mkdir($targetDir,0755,true);

        $fileName = time().'_'.basename($_FILES['image']['name']);
        $targetFilePath = $targetDir.$fileName;

        if(move_uploaded_file($_FILES['image']['tmp_name'],$targetFilePath)){
            $image = $fileName;
        }
    }

    $stmt = $conn->prepare("INSERT INTO artikel(title, description, image, created_at) VALUES(?,?,?,NOW())");
    $stmt->bind_param("sss",$title,$description,$image);

    if($stmt->execute()){
        $_SESSION['message']=['type'=>'success','text'=>'Artikel berhasil ditambahkan!'];
    } else{
        $_SESSION['message']=['type'=>'danger','text'=>'Gagal menambahkan artikel.'];
    }

    header("Location: artikel.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tambah Artikel</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/admin.css?v=2">
<link rel="icon" type="image/png" href="/img/logo.png" />
</head>
<body>
  <!-- HAMBURGER TOGGLE & OVERLAY -->
  <button class="menu-toggle"><i class="fa-solid fa-bars"></i></button>
  <div class="overlay"></div>

  <!-- SIDEBAR -->
  <div class="sidebar">
    <div class="logo">
      <img src="../img/logo.png" alt="Logo">
    </div>

    <a href="index.php"><i class="fa-solid fa-house"></i> Dashboard</a>
    <a href="produk.php"><i class="fa-solid fa-house"></i> Produk</a>
    <a href="artikel.php" class="active"><i class="fa-solid fa-file-lines"></i> Artikel</a>
    <a href="messages.php"><i class="fa-solid fa-envelope"></i> Pesan</a>

    <a href="logout.php" class="logout-link"><i class="fa-solid fa-right-from-bracket"></i> Log Out</a>
  </div>

<div class="main-content">
  <div class="main-header">
    <h3>Tambah Artikel Baru</h3>
    <p class="text-muted">Isi form berikut untuk menambahkan artikel baru.</p>
  </div>

  <div class="card-form">
    <form method="post" enctype="multipart/form-data">
      <div class="mb-3">
        <label class="form-label">Judul</label>
        <input type="text" name="title" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Deskripsi</label>
        <textarea name="description" class="form-control" rows="5" required></textarea>
      </div>
      <div class="mb-3">
        <label class="form-label">Gambar (opsional)</label>
        <input type="file" name="image" class="form-control">
      </div>
      <div class="text-end">
        <a href="artikel.php" class="btn btn-secondary">Batal</a>
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
