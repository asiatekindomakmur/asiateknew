<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
include 'config.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
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

        /* SIDEBAR */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 250px;
            height: 100vh;
            background: #fff;
            box-shadow: 3px 0 15px rgba(0,0,0,0.05);
            padding: 30px 20px;
            display: flex;
            flex-direction: column;
            transition: 0.3s;
        }
        .sidebar .logo { text-align: center; margin-bottom: 40px; }
        .sidebar .logo img { width: 140px; height: auto; object-fit: contain; }
        .sidebar a { display: flex; align-items: center; gap: 12px; padding: 12px 18px; color: #555; border-radius: 10px; font-size: 15px; text-decoration: none; margin-bottom: 8px; transition: all 0.3s; }
        .sidebar a i { font-size: 17px; }
        .sidebar a:hover, .sidebar a.active { background: var(--primary); color: white; box-shadow: 0 4px 10px rgba(13,110,253,0.2); }
        .logout-link { margin-top: auto; color: #dc3545; font-weight: 500; }
        .logout-link:hover { color: #b02a37; }

        /* MAIN CONTENT */
        .main-content {
            margin-left: 270px;
            padding: 40px 50px;
        }
        .main-header { margin-bottom: 30px; }
        .main-header h3 { font-weight: 700; color: var(--primary); }

        .card-list {
            background: var(--card-bg);
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 4px 14px rgba(0,0,0,0.06);
        }

        .card-list table {
            margin-bottom: 0;
        }

        .btn-primary, .btn-success, .btn-danger, .btn-secondary {
            border-radius: 10px;
        }

        img.product-image {
            width: 60px;
            border-radius: 8px;
        }
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
    <a href="#"><i class="fa-solid fa-file-lines"></i> Artikel</a>
    <a href="#"><i class="fa-solid fa-envelope"></i> Pesan</a>
    <a href="logout.php" class="logout-link"><i class="fa-solid fa-right-from-bracket"></i> Log Out</a>
</div>

<!-- MAIN CONTENT -->
<div class="main-content">
    <div class="main-header">
        <h3>Daftar Produk</h3>
        <p class="text-muted">Kelola produk di sini.</p>
    </div>

    <!-- Notifikasi -->
    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-<?= $_SESSION['message']['type'] ?> alert-dismissible fade show" role="alert">
            <?= $_SESSION['message']['text'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>

    <div class="card-list">
        <div class="mb-3 text-end">
            <a href="tambah_produk.php" class="btn btn-success"><i class="fa-solid fa-plus me-1"></i> Tambah Produk</a>
        </div>
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Gambar</th>
                    <th>Nama Produk</th>
                    <th>Deskripsi</th>
                    <th>Dibuat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $result = $conn->query("SELECT * FROM products ORDER BY created_at DESC");
            $no = 1;
            while($row = $result->fetch_assoc()):
            ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td>
                        <?php if ($row['image']): ?>
                            <img src="uploads/<?= $row['image'] ?>" class="product-image" alt="Gambar Produk">
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= htmlspecialchars(substr($row['description'],0,50)) ?>...</td>
                    <td><?= date("d M Y", strtotime($row['created_at'])) ?></td>
                    <td>
                        <a href="detail_produk.php?id=<?= $row['id'] ?>" class="btn btn-primary btn-sm"><i class="fa-solid fa-eye"></i></a>
                        <a href="edit_produk.php?id=<?= $row['id'] ?>" class="btn btn-success btn-sm"><i class="fa-solid fa-edit"></i></a>
                        <a href="hapus_produk.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus produk ini?');"><i class="fa-solid fa-trash"></i></a>
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
