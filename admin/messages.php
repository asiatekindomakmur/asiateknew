<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include 'config.php';

// Ambil semua pesan, urut dari terbaru
$result = $conn->query("SELECT * FROM messages ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Pesan Masuk</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/admin.css?v=2">
<link rel="icon" type="image/png" href="/img/logo.png" />
<style>
.main-content { margin-left: 260px; padding: 30px; }

.card { border-radius: 15px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
.table th { background-color: #0d6efd; color: white; }
.btn-primary, .btn-info, .btn-danger { border-radius: 8px; font-weight: 500; }
.btn-primary { background-color: #0d6efd; border: none; }
.btn-primary:hover { background-color: #005ce6; }
.btn-info { background-color: #17a2b8; border: none; color:white; }
.btn-info:hover { background-color: #138496; }
.btn-danger { background-color: #dc3545; border: none; color:white; }
.btn-danger:hover { background-color: #b02a37; }
</style>
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
    <a href="artikel.php"><i class="fa-solid fa-file-lines"></i> Artikel</a>
    <a href="messages.php" class="active"><i class="fa-solid fa-envelope"></i> Pesan</a>

    <a href="logout.php" class="logout-link"><i class="fa-solid fa-right-from-bracket"></i> Log Out</a>
  </div>

<!-- MAIN CONTENT -->
<div class="main-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-semibold text-primary"><i class="fa-solid fa-envelope me-2"></i> Pesan Masuk</h3>
    </div>

    <div class="card p-3">
        <table class="table table-bordered align-middle">
            <thead>
                <tr class="text-center">
                    <th width="5%">No</th>
                    <th>Nama</th>
                    <th>Nomor Pengirim</th>
                    <th>Pesan</th>
                    <th>Tanggal</th>
                    <th width="20%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                while($row = $result->fetch_assoc()):
                ?>
                <tr>
                    <td class="text-center"><?= $no++; ?></td>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= htmlspecialchars($row['phone']) ?></td>
                    <td><?= htmlspecialchars(substr($row['message'],0,70)) ?>...</td>
                    <td><?= date("d M Y H:i", strtotime($row['created_at'])) ?></td>
                    <td class="text-center">
                        <a href="messages_detail.php?id=<?= $row['id'] ?>" class="btn btn-info btn-sm" title="Lihat"><i class="fa fa-eye"></i></a>
                        <a href="messages_hapus.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm('Yakin ingin menghapus pesan ini?')"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

  <!-- JS -->
  <script src="js/admin.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
