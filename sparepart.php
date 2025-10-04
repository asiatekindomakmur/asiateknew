<?php
include 'admin/config.php'; // koneksi database

// Pagination
$limit = 15;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if($page < 1) $page = 1;
$start = ($page - 1) * $limit;

// Search
$search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';

// Total produk (untuk pagination)
$total_sql = "SELECT COUNT(*) as total FROM products";
if($search) $total_sql .= " WHERE name LIKE '%$search%'";
$total_result = $conn->query($total_sql);
$total_row = $total_result->fetch_assoc();
$total_products = $total_row['total'];
$total_pages = ceil($total_products / $limit);

// Ambil produk sesuai page & search
$sql = "SELECT * FROM products";
if($search) $sql .= " WHERE name LIKE '%$search%'";
$sql .= " ORDER BY id ASC LIMIT $start, $limit";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>PT Asiatek Indo Makmur | Spare Parts</title>
<link rel="icon" type="image/png" href="img/logo.png" />
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/navbar.css">
<link rel="stylesheet" href="css/footer.css">
<link rel="stylesheet" href="css/sparepart_css/header_sparepart.css">
<link rel="stylesheet" href="css/sparepart_css/product_sparepart.css">
<link rel="stylesheet" href="css/sparepart_css/search.css">
<link rel="stylesheet" href="css/sparepart_css/pagination.css">
<script src="https://unpkg.com/feather-icons"></script>
</head>
<body>
<header>
  <div class="container header-content navbar">
    <div class="header-title">
      <img src="img/logo.png" alt="Logo AIM" style="height:60px">
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

<!-- Hero -->
<section class="about-hero" style="background-image:url('img/spb.jpg'); background-size:cover; background-position:center;">
  <div class="about-hero-overlay">
    <div class="about-hero-content container">
      <h1>Spare Parts For Earthmoving And Construction Equipment</h1>
      <p>Kami menyediakan berbagai jenis sparepart yang dibutuhkan untuk alat berat, dengan kualitas terjamin dan harga yang kompetitif.</p>
    </div>
  </div>
</section>

<!-- Search -->
<div class="container search-container">
  <form method="GET" action="sparepart.php">
    <div class="search-wrapper">
      <input type="text" name="search" placeholder="Cari produk..." value="<?php echo htmlspecialchars($search); ?>">
      <button type="submit"><i data-feather="search"></i></button>
    </div>
  </form>
</div>

<!-- Products -->
<div class="gallery-wrapper">
  <div class="gallery">
    <?php if($result->num_rows > 0): ?>
      <?php while($row = $result->fetch_assoc()): ?>
        <div class="gallery-item">
          <a href="<?php echo $row['link']; ?>">
            <img src="admin/uploads/produk/<?php echo $row['image']; ?>" alt="<?php echo htmlspecialchars($row['name']); ?>">
            <p><?php echo htmlspecialchars($row['name']); ?></p>
          </a>
        </div>
      <?php endwhile; ?>
    <?php else: ?>
      <p>Tidak ada produk yang tersedia saat ini.</p>
    <?php endif; ?>
  </div>
</div>

<!-- Pagination -->
<?php if($total_pages > 1): ?>
<div class="pagination">
  <?php for($i=1; $i<=$total_pages; $i++): ?>
    <a href="sparepart.php?page=<?php echo $i; ?><?php if($search) echo '&search='.$search; ?>" class="<?php if($i==$page) echo 'active'; ?>"><?php echo $i; ?></a>
  <?php endfor; ?>
</div>
<?php endif; ?>

<!-- CTA -->
<div class="cta-full">
  <h2>Tidak menemukan apa yang kamu cari?</h2>
  <a href="https://wa.me/+6281213838567?text=Halo%20Saya%20Ingin%20Menanyakan%20Tentang%20Produk" class="cta-full-button">Hubungi Kami</a>
</div>

<!-- Footer -->
<footer class="site-footer">
  <div class="footer-container">
    <div class="footer-section">
      <img src="img/logo.png" alt="Logo" class="footer-logo">
      <p>PT Asiatek Indo Makmur Menyediakan berbagai Suku Cadang dan Sparepart Alat Berat dengan Harga yang kompetetif dan berkualitas.</p>
    </div>
    <div class="footer-section">
      <h4>HUBUNGI KAMI</h4>
      <p>📞 0812-1383-8567</p>
      <p>📧 sales@asiatek.co.id</p>
      <p>📍 Jl. Asia Baru Blok F. No 148 RW.04 RT. 005, Kota Jakarta Barat</p>
      <div class="footer-social" style="margin-top:20px">
        <a href="https://www.instagram.com/asiatek.indomakmur" target="_blank"><i data-feather="instagram"></i></a>
        <a href="https://wa.me/+6281213838567" target="_blank"><i data-feather="phone"></i></a>
        <a href="https://tokopedia.com/asiatekindo" target="_blank"><i data-feather="shopping-cart"></i></a>
      </div>
    </div>
  </div>
</footer>

<script>
feather.replace();
</script>
</body>
</html>
