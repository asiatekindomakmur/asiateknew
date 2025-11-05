<?php
// Ambil ID artikel dari URL
$id = $_GET['id'] ?? null;
$data = json_decode(file_get_contents("https://asiatek.co.id/admin/api/get_artikel.php"), true);
$artikel = null;

// Cari artikel berdasarkan ID
if ($id && is_array($data)) {
  foreach ($data as $item) {
    if ($item['id'] == $id) {
      $artikel = $item;
      break;
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="keywords" content="<?= htmlspecialchars($artikel['title'] ?? '') ?>, Hino, Truk, Dealer Hino, Jabodetabek, Hino Indonesia" />
    <meta property="og:title" content="<?= htmlspecialchars($artikel['title'] ?? '') ?>" />
    <meta property="og:description" content="<?= substr(strip_tags($artikel['description'] ?? ''), 0, 150) ?>..." />
    <meta property="og:image" content="<?= htmlspecialchars($artikel['image'] ?? '') ?>" />
    <meta property="og:url" content="https://asiatek.co.id/detail_artikel.php?id=<?= $artikel['id'] ?? '' ?>" />
    <title>PT Asiatek Indo Makmur | The best spare parts for heavy equipment</title>
    <meta name="description" content="PT Asiatek Indo Makmur Menyediakan berbagai Suku Cadang dan Sparepart Alat Berat dengan Harga yang kompetetif dan berkualitas. Hubungi: +62 812-1383-8567 untuk mendapatkan informasi produk. Layanan Terbaik dan Jaminan Mutu." />
    <link rel="icon" type="image/png" href="/img/logo.png">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;700&display=swap" rel="stylesheet" />
    
    <!-- CSS -->
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/navbar.css" />
    <link rel="stylesheet" href="css/home_css/header.css" />
    <link rel="stylesheet" href="css/footer.css" />
    <link rel="stylesheet" href="css/artikel_css/artikel.css">
    <link rel="stylesheet" href="css/artikel_css/blog.css">

    <script src="js/script.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
  </head>
  <body>

    <!-- Header -->
    <header>
      <div class="container header-content navbar">
        <div class="header-title">
          <a href="index.php">
            <img src="img/logo.png" alt="Logo AIM" style="height: 60px" />
          </a>
        </div>

        <div class="hamburger-menu">&#9776;</div>

        <nav class="nav links">
          <a href="index.php">Home</a>
          <a href="sparepart.php">Spare parts</a>
          <a href="service.php">Service</a>
          <a href="about.php">About Us</a>
          <a href="contact.php">Contact</a>
          <a href="artikel.php">Blog & Artikel</a>
        </nav>
      </div>
    </header>

    <!-- Konten Artikel -->
    <section class="detail-artikel">
      <div class="container">
        <div class="artikel-wrapper" style="display: flex; flex-wrap: wrap; gap: 30px;">
          <div class="artikel-main" style="flex: 1 1 65%;">
            <?php if($artikel): ?>
              <h1><?= htmlspecialchars($artikel['title']) ?></h1>
              <p style="color: #888; font-size: 14px; margin-bottom: 15px;">
                Diposting oleh <strong><?= htmlspecialchars($artikel['author'] ?? 'Admin Asiatek') ?></strong> pada <?= date('d M Y', strtotime($artikel['created_at'] ?? 'now')) ?>
              </p>
              <img src="<?= htmlspecialchars($artikel['image']) ?>" alt="<?= htmlspecialchars($artikel['title']) ?>" class="featured-image" style="width: 100%; height: auto; margin-bottom: 20px;">
              <div class="isi-artikel">
                <?= nl2br($artikel['description']) ?>
              </div>
              <a href="artikel.php" class="btn-kembali" style="display:inline-block; margin-top:20px;">Kembali ke Daftar Artikel</a>
            <?php else: ?>
              <p>Artikel tidak ditemukan.</p>
            <?php endif; ?>
          </div>

          <!-- Sidebar -->
          <aside class="artikel-sidebar" style="flex: 1 1 30%;">
            <div class="sidebar-section">
              <h3>Recent Posts</h3>
              <div class="recent-posts-list">
                <?php
                foreach (array_slice($data, 0, 5) as $recent) {
                  if ($recent['id'] != $id) {
                    echo '<div class="recent-post-item" style="display: flex; align-items: center; gap: 12px; margin-bottom: 15px;">';
                    echo '<a href="detail_artikel.php?id=' . $recent['id'] . '" style="flex-shrink: 0;">';
                    echo '<img src="' . htmlspecialchars($recent['image']) . '" alt="' . htmlspecialchars($recent['title']) . '" style="width: 80px; height: 60px; object-fit: cover; border-radius: 6px;">';
                    echo '</a>';
                    echo '<div style="flex: 1;">';
                    echo '<a href="detail_artikel.php?id=' . $recent['id'] . '" style="font-weight: 600; text-decoration: none; color: #333; line-height: 1.3; display: block;">' . htmlspecialchars($recent['title']) . '</a>';
                    echo '</div>';
                    echo '</div>';
                  }
                }
                ?>
              </div>
            </div>
          </aside>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <?php include 'footer.php'; ?>

    <script src="https://elfsightcdn.com/platform.js" async></script>
    <div class="elfsight-app-b334841b-ad07-411c-889b-4364272215a1" data-elfsight-app-lazy></div>

    <script>
      feather.replace();
    </script>
  </body>
</html>
