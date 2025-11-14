<?php
include 'admin/config.php'; // Koneksi database

// ===================================
// Fungsi SLUG
// ===================================
function buatSlug($text) {
    $text = strtolower(trim($text));
    $text = preg_replace('/[^a-z0-9]+/i', '-', $text);
    return trim($text, '-');
}

// ===================================
// Pagination
// ===================================
$limit = 15;
$page  = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;

$start = ($page - 1) * $limit;

// ===================================
// Search
// ===================================
$search = isset($_GET['search']) 
    ? $conn->real_escape_string($_GET['search']) 
    : '';

$whereSQL = $search ? "WHERE title LIKE '%$search%'" : '';

// ===================================
// Hitung Total Artikel
// ===================================
$total_sql    = "SELECT COUNT(*) AS total FROM artikel $whereSQL";
$total_result = $conn->query($total_sql);
$total_row    = $total_result ? $total_result->fetch_assoc() : ['total' => 0];

$total_artikel = $total_row['total'];
$total_pages   = ceil($total_artikel / $limit);

// ===================================
// Ambil Artikel
// ===================================
$sql    = "SELECT * FROM artikel $whereSQL ORDER BY id DESC LIMIT $start, $limit";
$result = $conn->query($sql);

$artikel = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $row['slug'] = buatSlug($row['title']); // Tambahkan slug
        $artikel[]   = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>

<!-- Google Tag Manager -->
<script>
(function(w,d,s,l,i){
  w[l]=w[l]||[];
  w[l].push({'gtm.start': new Date().getTime(), event:'gtm.js'});
  var f=d.getElementsByTagName(s)[0],
      j=d.createElement(s),
      dl=l!='dataLayer'?'&l='+l:'';
  j.async=true;
  j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;
  f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-53JF8MG7');
</script>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-YDPM3D26HV"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){ dataLayer.push(arguments); }
  gtag('js', new Date());
  gtag('config', 'G-YDPM3D26HV');
</script>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>PT Asiatek Indo Makmur | Blog & Artikel</title>
<meta name="description" content="Kontak PT Asiatek Indo Makmur untuk pertanyaan dan layanan sparepart alat berat.">

<link rel="icon" type="image/png" href="img/logo.png">

<!-- Fonts & CSS -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/navbar.css">
<link rel="stylesheet" href="css/footer.css">
<link rel="stylesheet" href="css/artikel_css/header_artikel.css">
<link rel="stylesheet" href="css/artikel_css/search.css">
<link rel="stylesheet" href="css/artikel_css/pagination.css">
<link rel="stylesheet" href="css/artikel_css/artikel.css">

<script src="js/script.js"></script>
<script src="https://unpkg.com/feather-icons"></script>

</head>
<body>

<!-- Google Tag Manager (noscript) -->
<noscript>
  <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-53JF8MG7"
          height="0" width="0"
          style="display:none;visibility:hidden"></iframe>
</noscript>

<!-- Header -->
<header>
  <div class="container header-content navbar">

    <!-- Logo -->
    <div class="header-title">
      <a href="index.php">
        <img src="img/logo.png" alt="Logo AIM" style="height:60px;">
      </a>
    </div>

    <!-- Hamburger Menu -->
    <div class="hamburger-menu">&#9776;</div>

    <!-- Nav Links -->
    <nav class="nav links">
      <a href="index.php">Home</a>
      <a href="sparepart.php">Spare parts</a>
      <a href="service.php">Service</a>
      <a href="about.php">About Us</a>
      <a href="contact.php">Contact</a>
      <a href="artikel.php" class="active">Blog & Artikel</a>
    </nav>

  </div>
</header>

<!-- Hero -->
<section class="about-hero" 
         style="background-image:url('img/bgp.jpg');background-size:cover;background-position:center;">
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
      <input type="text" name="search" placeholder="Cari Artikel..." 
             value="<?= htmlspecialchars($search); ?>">
      <button type="submit"><i data-feather="search"></i></button>
    </div>
  </form>
</div>

<!-- Artikel -->
<section class="content-section" id="artikel">
  <div class="container">

    <!-- Grid -->
    <div class="blog-grid">
      <?php if (!empty($artikel)): ?>
        <?php foreach ($artikel as $row): ?>

          <div class="blog-post">

            <img src="admin/uploads/artikel/<?= htmlspecialchars($row['image']) ?>"
                 alt="Artikel - <?= htmlspecialchars($row['title']) ?>"
                 loading="lazy">

            <h2>
              <a href="detail_artikel.php?slug=<?= htmlspecialchars($row['slug']) ?>">
                <?= htmlspecialchars($row['title']) ?>
              </a>
            </h2>

            <p><?= substr(strip_tags($row['description']), 0, 120) ?>...</p>

            <div class="card-footer">
              <a href="detail_artikel.php?slug=<?= htmlspecialchars($row['slug']) ?>">
                Baca Selengkapnya
              </a>
            </div>

          </div>

        <?php endforeach; ?>
      <?php else: ?>
        <p>Tidak ada artikel yang ditemukan.</p>
      <?php endif; ?>
    </div>

    <!-- Pagination -->
    <?php if ($total_pages > 1): ?>
    <div class="pagination">
      <?php for ($i = 1; $i <= $total_pages; $i++): ?>
        <a href="artikel.php?page=<?= $i ?><?= $search ? '&search='.urlencode($search) : '' ?>"
           class="<?= $i == $page ? 'active' : '' ?>">
          <?= $i ?>
        </a>
      <?php endfor; ?>
    </div>
    <?php endif; ?>

  </div>
</section>

<!-- Footer -->
<?php include 'footer.php'; ?>

<script>
  feather.replace();
</script>

</body>
</html>
