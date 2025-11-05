<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include 'config.php';

// Ambil semua produk, urut berdasarkan created_at
$result = $conn->query("SELECT * FROM products ORDER BY created_at ASC"); // ASC supaya urut 1,2,3
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Manajemen Produk</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
<link rel="icon" type="image/png" href="/img/logo.png" />
<style>
body { background: #f8f9fb; font-family: 'Poppins', sans-serif; }

    /* === SIDEBAR === */
    :root {
  --primary: #0d6efd; /* biru bootstrap */
}

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

    .sidebar .logo {
      text-align: center;
      margin-bottom: 40px;
    }

    .sidebar .logo img {
      width: 140px;
      height: auto;
      object-fit: contain;
    }

    .sidebar a {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 12px 18px;
      color: #555;
      border-radius: 10px;
      font-size: 15px;
      text-decoration: none;
      margin-bottom: 8px;
      transition: all 0.3s;
    }

    .sidebar a i {
      font-size: 17px;
    }

    .sidebar a:hover, .sidebar a.active {
      background: var(--primary);
      color: white;
      box-shadow: 0 4px 10px rgba(13, 110, 253, 0.2);
    }

    .logout-link {
      margin-top: auto;
      color: #dc3545;
      font-weight: 500;
    }

    .logout-link:hover {
      color: #b02a37;
    }


.main-content { margin-left: 260px; padding: 30px; }
.btn-primary { background-color: #0d6efd; border: none; border-radius: 10px; font-weight: 500; }
.btn-primary:hover { background-color: #005ce6; }
.table th { background-color: #0d6efd; color: white; }
.table img { width: 60px; height: 60px; object-fit: cover; border-radius: 8px; }
.card { border-radius: 15px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }

/* NOTIFIKASI RAPI */
.alert-custom {
    position: relative;
    padding: 12px 20px;
    border-radius: 10px;
    margin-bottom: 20px;
    font-weight: 500;
    box-shadow: 0 4px 10px rgba(0,0,0,0.08);
}

.alert-custom-success { background-color: #d1e7dd; color: #0f5132; }
.alert-custom-danger  { background-color: #f8d7da; color: #842029; }

.alert-close {
    position: absolute;
    top: 8px;
    right: 12px;
    background: none;
    border: none;
    font-size: 18px;
    font-weight: bold;
    cursor: pointer;
    color: inherit;
}
</style>
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <div class="logo text-center">
        <img src="../img/logo.png" alt="Logo">
    </div>
    <a href="index.php"><i class="fa-solid fa-home"></i> Dashboard</a>
    <a href="produk.php" class="active"><i class="fa-solid fa-box"></i> Produk</a>
    <a href="artikel.php"><i class="fa-solid fa-file-alt"></i> Artikel</a>
    <a href="messages.php"><i class="fa-solid fa-envelope"></i> Pesan</a>
    <div class="mt-auto pt-3">
        <a href="logout.php" style="color:#dc3545;"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
    </div>
</div>

<!-- NOTIFIKASI -->
<?php if(isset($_SESSION['message'])):
    $type = $_SESSION['message']['type'] == 'success' ? 'alert-custom-success' : 'alert-custom-danger';
?>
<div class="alert-custom <?= $type ?>">
    <?= $_SESSION['message']['text'] ?>
    <button class="alert-close" onclick="this.parentElement.style.display='none';">&times;</button>
</div>
<?php unset($_SESSION['message']); endif; ?>

<!-- MAIN -->
<div class="main-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-semibold text-primary"><i class="fa-solid fa-box me-2"></i> Manajemen Produk</h3>
        <a href="produk_tambah.php" class="btn btn-primary"><i class="fa-solid fa-plus me-1"></i> Tambah Produk</a>
    </div>

    <div class="card p-3">
        <table class="table table-bordered align-middle">
            <thead>
                <tr class="text-center">
                    <th width="5%">No</th>
                    <th>Gambar</th>
                    <th>Nama Produk</th>
                    <th>Deskripsi</th>
                    <th>Tanggal Dibuat</th>
                    <th width="20%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td class="text-center"><?= $no++; ?></td>
                    <td class="text-center">
                        <?php if (!empty($row['image'])): ?>
                            <img src="uploads/produk/<?= $row['image'] ?>" alt="<?= htmlspecialchars($row['name']) ?>">
                        <?php else: ?>
                            <img src="https://via.placeholder.com/60?text=No+Image" alt="no image">
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= htmlspecialchars(substr($row['description'], 0, 70)) ?>...</td>
                    <td><?= date("d M Y", strtotime($row['created_at'])) ?></td>
                    <td class="text-center">
                        <a href="produk_detail.php?id=<?= $row['id'] ?>" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                        <a href="produk_edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                        <a href="produk_hapus.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus produk ini?')"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
