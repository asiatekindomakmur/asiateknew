<?php
include 'admin/config.php';

// Pagination
$limit = 15;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max($page, 1);
$start = ($page - 1) * $limit;

// Search
$search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';

// Total Produk
$total_sql = "SELECT COUNT(*) AS total FROM products";
if ($search) {
    $total_sql .= " WHERE name LIKE '%$search%'";
}
$total_result = $conn->query($total_sql);
$total_products = $total_result->fetch_assoc()['total'];
$total_pages = ceil($total_products / $limit);

// Ambil Produk
$sql = "SELECT * FROM products";
if ($search) {
    $sql .= " WHERE name LIKE '%$search%'";
}
$sql .= " ORDER BY id ASC LIMIT $start, $limit";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});
    var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;
    j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-53JF8MG7');</script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT Asiatek Indo Makmur | Spare Parts</title>
    <meta name="description" content="PT Asiatek Indo Makmur adalah distributor resmi alat berat dan sparepart untuk LiuGong, XCMG, SANY, dan SDLG. Menyediakan excavator, wheel loader, forklift, suku cadang asli dan layanan terbaik. Hubungi WhatsApp 0812-1383-8567.">
    <meta name="keywords" content="alat berat, sparepart alat berat, distributor alat berat, liugong, xcmg, sany, sdlg, excavator, wheel loader, forklift, suku cadang alat berat, jual alat berat, PT Asiatek Indo Makmur, heavy equipment">
    <meta name="author" content="PT Asiatek Indo Makmur" />
    <meta name="robots" content="index, follow" />

    <link rel="icon" type="image/png" href="/img/logo.png">

    <!-- =================================================================== -->
    <!-- 📱 OPEN GRAPH (FACEBOOK / WHATSAPP / LINKEDIN) -->
    <!-- =================================================================== -->
    <meta property="og:title" content="PT Asiatek Indo Makmur | The best spare parts for heavy equipment">
    <meta property="og:description" content="PT Asiatek Indo Makmur adalah distributor resmi alat berat dan sparepart untuk LiuGong, XCMG, SANY, dan SDLG. Menyediakan excavator, wheel loader, forklift, suku cadang asli dan layanan terbaik. Hubungi WhatsApp 0812-1383-8567.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://asiatek.co.id/">
    <meta property="og:image" content="https://asiatek.co.id/img/companyprofile.png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="PT Asiatek Indo Makmur - Heavy Equipment Dealer">
    <meta property="og:locale" content="id_ID" />
    <meta property="og:site_name" content="PT Asiatek Indo Makmur">

    <!-- =================================================================== -->
    <!-- 🐦 TWITTER CARD -->
    <!-- =================================================================== -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Distributor Alat Berat & Sparepart Resmi | PT Asiatek Indo Makmur">
    <meta name="twitter:description" content="Alat berat & sparepart lengkap: LiuGong, XCMG, SANY, SDLG. Hubungi WA 0812-1383-8567.">
    <meta name="twitter:image" content="https://asiatek.co.id/img/companyprofile.png">

    <!-- =================================================================== -->
    <!-- 🧩 JSON-LD SCHEMA (BEST SEO BOOSTER) -->
    <!-- =================================================================== -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "PT Asiatek Indo Makmur",
        "legalName": "PT PT Asiatek Indo Makmur",
        "url": "https://asiatek.co.id/",
        "logo": "https://asiatek.co.id/img/logo.png",
        "image": "https://asiatek.co.id/img/companyprofile.png",
        "description": "Distributor resmi alat berat dan sparepart untuk LiuGong, XCMG, SANY, dan SDLG. Excavator, wheel loader, suku cadang asli, dan layanan profesional. WA: 0812-1383-8567.",
        "telephone": "+6281213838567",
        "address": {
        "@type": "PostalAddress",
        "streetAddress": "Jl. Asia Baru Blok F. No 148 RW.04 RT. 005",
        "addressLocality": "Kota Jakarta Barat",
        "addressRegion": "DKI Jakarta",
        "postalCode": "11510",
        "addressCountry": "ID"
        },
        "contactPoint": {
        "@type": "ContactPoint",
        "telephone": "+6281213838567",
        "contactType": "customer service",
        "areaServed": "ID",
        "availableLanguage": ["id", "en"]
        },
        "sameAs": [
        "https://www.facebook.com/",
        "https://www.instagram.com/",
        "https://www.linkedin.com/"
        ]
    }
    </script>

    <!-- CSS -->
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
    <!-- GTM noscript -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-53JF8MG7"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>

    <!-- Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-YDPM3D26HV"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);} 
        gtag('js', new Date());
        gtag('config', 'G-YDPM3D26HV');
    </script>

    <!-- Header -->
    <header>
        <div class="container header-content navbar">
            <div class="header-title">
                <a href="index.php"><img src="img/logo.png" alt="Logo AIM" style="height: 60px" /></a>
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
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <?php
                        $wa_number = "6281213838567";
                        $message = "Halo saya dapat nomor anda dari google, Saya ingin menanyakan tentang produk (" . $row['name'] . ")";
                        $wa_link = "https://wa.me/" . $wa_number . "?text=" . urlencode($message);
                    ?>

                    <div class="gallery-item">
                        <a href="<?php echo $wa_link; ?>" target="_blank">
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
    <?php if ($total_pages > 1): ?>
        <div class="pagination">
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <a href="sparepart.php?page=<?php echo $i; ?><?php if ($search) echo '&search=' . $search; ?>"
                   class="<?php echo ($i == $page) ? 'active' : ''; ?>">
                   <?php echo $i; ?>
                </a>
            <?php endfor; ?>
        </div>
    <?php endif; ?>

    <!-- CTA -->
    <div class="cta-full">
        <h2>Tidak menemukan apa yang kamu cari?</h2>
        <a href="https://wa.me/+6281213838567?text=Halo%20Saya%20Ingin%20Menanyakan%20Tentang%20Produk" class="cta-full-button">Hubungi Kami</a>
    </div>

    <script>feather.replace();</script>
    <script>
        const hamburger = document.querySelector('.hamburger-menu');
        const navLinks = document.querySelector('.nav.links');
        hamburger.addEventListener('click', () => {
            navLinks.classList.toggle('active');
        });
    </script>

    <?php include 'footer.php'; ?>
</body>
</html>