<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit;
}
include 'config.php';

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM products WHERE id=$id");
$product = $result->fetch_assoc();

if (isset($_POST['update'])) {
  $name = $_POST['name'];
  $description = $_POST['description'];
  $image = $product['image'];

  if ($_FILES['image']['name']) {
    $targetDir = "uploads/";
    $fileName = time() . '_' . basename($_FILES['image']['name']);
    $targetFilePath = $targetDir . $fileName;
    if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
      $image = $fileName;
    }
  }

  $stmt = $conn->prepare("UPDATE products SET name=?, description=?, image=? WHERE id=?");
  $stmt->bind_param("sssi", $name, $description, $image, $id);
  $stmt->execute();

  header("Location: produk.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Produk</title>
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
      <h4 class="mb-4 text-primary"><i class="fa-solid fa-edit me-2"></i> Edit Produk</h4>
      <form method="post" enctype="multipart/form-data">
        <div class="mb-3">
          <label>Nama Produk</label>
          <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($product['name']) ?>" required>
        </div>
        <div class="mb-3">
          <label>Deskripsi</label>
          <textarea name="description" class="form-control" rows="5" required><?= htmlspecialchars($product['description']) ?></textarea>
        </div>
        <div class="mb-3">
          <label>Gambar Sekarang</label><br>
          <img src="uploads/<?= $product['image'] ?>" width="120" class="rounded mb-2">
          <input type="file" name="image" class="form-control">
        </div>
        <div class="text-end">
          <a href="produk.php" class="btn btn-secondary">Batal</a>
          <button type="submit" name="update" class="btn btn-primary">Update</button>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
