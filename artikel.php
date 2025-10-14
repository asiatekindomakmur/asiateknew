<?php
include 'admin/config.php'; // koneksi database

// Pagination
$limit = 15;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;
$start = ($page - 1) * $limit;

// Search
$search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';

// Total Artikel (untuk pagination)
$whereSQL = $search ? "WHERE title LIKE '%$search%'" : '';
$total_sql = "SELECT COUNT(*) as total FROM artikel $whereSQL";
$total_result = $conn->query($total_sql);
$total_row = $total_result->fetch_assoc();
$total_artikel = $total_row['total'];
$total_pages = ceil($total_artikel / $limit);

// Ambil Artikel
$sql = "SELECT * FROM artikel $whereSQL ORDER BY id DESC LIMIT $start, $limit";
$result = $conn->query($sql);

// Simpan hasil ke array
$artikel = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $artikel[] = $row;
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PT Asiatek Indo Makmur | Blog & Artikel</title>
    <meta name="description" content="Kontak PT Asiatek Indo Makmur untuk pertanyaan dan layanan sparepart alat berat.">

    <!-- Font & CSS -->
    <link rel="icon" type="image/png" href="img/logo.png" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/navbar.css" />
    <link rel="stylesheet" href="css/footer.css" />
    <link rel="stylesheet" href="css/artikel_css/header_artikel.css" />
    <link rel="stylesheet" href="css/artikel_css/search.css" />
    <link rel="stylesheet" href="css/artikel_css/pagination.css" />
    <link rel="stylesheet" href="css/artikel_css/artikel.css" />

    <script src="js/script.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
</head>
<body>
    <!-- Header -->
    <header>
      <div class="container header-content navbar">
        <!-- Logo -->
        <div class="header-title">
          <a href="index.php">
            <img src="img/logo.png" alt="Logo AIM" style="height: 60px" />
          </a>
        </div>

        <!-- Hamburger Menu (Mobile Only) -->
        <div class="hamburger-menu">&#9776;</div>

        <!-- Nav Links -->
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

    <!-- Artikel Hero -->
    <section class="about-hero" style="background-image: url('img/bgp.jpg'); background-size: cover; background-position: center;">
      <div class="about-hero-overlay">
        <div class="about-hero-content container">
          <h1>Blog & Artikel</h1>
          <p>Dapatkan informasi terbaru seputar alat berat, perawatan, dan tips terbaik.</p>
        </div>
      </div>
    </section>

    <!-- Search -->
    <div class="container search-container">
      <form method="GET" action="artikel.php">
        <div class="search-wrapper">
          <input type="text" name="search" placeholder="Cari Artikel..." value="<?php echo htmlspecialchars($search); ?>">
          <button type="submit"><i data-feather="search"></i></button>
        </div>
      </form>
    </div>

<!-- Blog & Artikel -->
<section class="content-section" id="artikel">
    <div class="container">

        <!-- Artikel Grid -->
        <div class="blog-grid">
            <?php if (is_array($artikel) && count($artikel) > 0): ?>
                <?php foreach ($artikel as $row): ?>
                    <div class="blog-post">
                        <img src="admin/uploads/artikel/<?= htmlspecialchars($row['image']) ?>" 
                            alt="Artikel - <?= htmlspecialchars($row['title']) ?>" 
                            loading="lazy">
                        <h2>
                            <a href="detail_artikel.php?id=<?= $row['id'] ?>">
                                <?= htmlspecialchars($row['title']) ?>
                            </a>
                        </h2>
                        <p><?= substr(strip_tags($row['description']), 0, 120) ?>...</p>
                        <div class="card-footer">
                            <a href="detail_artikel.php?id=<?= $row['id'] ?>">Baca Selengkapnya</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Tidak ada artikel yang ditemukan.</p>
            <?php endif; ?>
        </div> <!-- blog-grid -->

        <!-- Pagination -->
        <?php if($total_pages > 1): ?>
        <div class="pagination">
          <?php for($i=1; $i<=$total_pages; $i++): ?>
            <a href="artikel.php?page=<?= $i ?><?= $search ? '&search=' . urlencode($search) : '' ?>" class="<?= $i == $page ? 'active' : '' ?>">
              <?= $i ?>
            </a>
          <?php endfor; ?>
        </div>
        <?php endif; ?>

    </div> <!-- container -->
</section>

<?php include 'footer.php'; ?>

<script>
  feather.replace(); // Aktifkan feather icons
</script>
</body>
</html>
