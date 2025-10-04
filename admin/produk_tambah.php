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
  if ($_FILES['image']['name']) {
    $targetDir = "uploads/";
    $fileName = time() . '_' . basename($_FILES['image']['name']);
    $targetFilePath = $targetDir . $fileName;
    if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
      $image = $fileName;
    }
  }

  $stmt = $conn->prepare("INSERT INTO products (name, description, image, created_at) VALUES (?, ?, ?, NOW())");
  $stmt->bind_param("sss", $name, $description, $image);
  $stmt->execute();

  header("Location: produk.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Produk</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background: #f8f9fb; font-family: 'Poppins', sans-serif; }
    .container { max-width: 700px; margin-top: 50px; }
    .card { border-radius: 15px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); }
    .btn-primary { background-color: #0d6efd; border: none; border-radius: 10px; }
  </style>
</head>
<body>
  <div class="container">
    <div class="card p-4">
      <h4 class="mb-4 text-primary"><i class="fa-solid fa-plus me-2"></i> Tambah Produk Baru</h4>
      <form method="post" enctype="multipart/form-data">
        <div class="mb-3">
          <label>Nama Produk</label>
          <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Deskripsi</label>
          <textarea name="description" class="form-control" rows="5" required></textarea>
        </div>
        <div class="mb-3">
          <label>Gambar</label>
          <input type="file" name="image" class="form-control">
        </div>
        <div class="text-end">
          <a href="produk.php" class="btn btn-secondary">Batal</a>
          <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
