<?php
// Ambil slug dari URL
$slug = $_GET['slug'] ?? null;

// Ambil data artikel dari API
$data = json_decode(file_get_contents("https://asiatek.co.id/admin/api/get_artikel.php"), true);
$artikel = null;

// Cari artikel berdasarkan slug
if ($slug && is_array($data)) {
    foreach ($data as $item) {
        if (isset($item['slug']) && $item['slug'] === $slug) {
            $artikel = $item;
            break;
        }
    }
}

// Jika tidak ketemu slug, fallback ke ID (kompatibel dengan URL lama)
if (!$artikel && isset($_GET['id'])) {
    $id = $_GET['id'];
    foreach ($data as $item) {
        if ($item['id'] == $id) {
            $artikel = $item;
            break;
        }
    }
}

// Buat ID aman untuk sidebar Recent Post
if ($artikel) {
    $id = $artikel['id'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>

  <!-- Google Tag Manager -->
  <script>
    (function(w,d,s,l,i){
      w[l]=w[l]||[];
      w[l].push({'gtm.start': new Date().getTime(),event:'gtm.js'});
      var f=d.getElementsByTagName(s)[0],
          j=d.createElement(s),
          dl=l!='dataLayer'?'&l='+l:'';
      j.async=true;
      j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;
      f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-53JF8MG7');
  </script>
  <!-- End Google Tag Manager -->

  <!-- Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-YDPM3D26HV"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){ dataLayer.push(arguments); }
    gtag('js', new Date());
    gtag('config', 'G-YDPM3D26HV');
  </script>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- SEO META -->
  <meta name="keywords" content="<?= htmlspecialchars($artikel['title'] ?? '') ?>, Asiatek, Sparepart, Alat Berat">

  <meta property="og:title" content="<?= htmlspecialchars($artikel['title'] ?? '') ?>">
  <meta property="og:description" content="<?= substr(strip_tags($artikel['description'] ?? ''), 0,150) ?>...">
  <meta property="og:image" content="<?= htmlspecialchars($artikel['image'] ?? '') ?>">
  <meta property="og:url" content="https://asiatek.co.id/detail_artikel.php?slug=<?= htmlspecialchars($artikel['slug'] ?? '') ?>">

  <title><?= htmlspecialchars($artikel['title'] ?? 'Artikel Tidak Ditemukan') ?> | PT Asiatek Indo Makmur</title>
  <meta name="description" content="<?= substr(strip_tags($artikel['description'] ?? ''), 0, 150) ?>...">
  
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

  <!-- Font -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;700&display=swap" rel="stylesheet">

  <!-- CSS -->
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/navbar.css">
  <link rel="stylesheet" href="css/home_css/header.css">
  <link rel="stylesheet" href="css/footer.css">
  <link rel="stylesheet" href="css/artikel_css/artikel.css">
  <link rel="stylesheet" href="css/artikel_css/blog.css">

  <script src="js/script.js"></script>
  <script src="https://unpkg.com/feather-icons"></script>

</head>
<body>

  <!-- GTM Noscript -->
  <noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-53JF8MG7"
            height="0"
            width="0"
            style="display:none;visibility:hidden"></iframe>
  </noscript>
  <!-- End GTM Noscript -->

  <!-- Header -->
  <header>
    <div class="container header-content navbar">

      <!-- Logo -->
      <div class="header-title">
        <a href="index.php">
          <img src="img/logo.png" alt="Logo AIM" style="height:60px">
        </a>
      </div>

      <!-- Hamburger Menu -->
      <div class="hamburger-menu">&#9776;</div>

      <!-- Navigation -->
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
      <div class="artikel-wrapper" style="display:flex;flex-wrap:wrap;gap:30px;">

        <!-- Artikel Utama -->
        <div class="artikel-main" style="flex:1 1 65%;">

          <?php if ($artikel): ?>

            <h1><?= htmlspecialchars($artikel['title']) ?></h1>

            <p style="color:#888;font-size:14px;margin-bottom:15px;">
              Diposting oleh
              <strong><?= htmlspecialchars($artikel['author'] ?? 'Admin Asiatek') ?></strong>
              pada <?= date('d M Y', strtotime($artikel['created_at'] ?? 'now')) ?>
            </p>

            <img src="<?= htmlspecialchars($artikel['image']) ?>"
                 alt="<?= htmlspecialchars($artikel['title']) ?>"
                 class="featured-image"
                 style="width:100%;height:auto;margin-bottom:20px;">

            <div class="isi-artikel">
              <?= nl2br($artikel['description']) ?>
            </div>

            <a href="artikel.php" class="btn-kembali" style="display:inline-block;margin-top:20px;">
              Kembali ke Daftar Artikel
            </a>

          <?php else: ?>

            <p>Artikel tidak ditemukan.</p>

          <?php endif; ?>

        </div>

        <!-- Sidebar -->
        <aside class="artikel-sidebar" style="flex:1 1 30%;">
          <div class="sidebar-section">
            <h3>Recent Posts</h3>

            <div class="recent-posts-list">

              <?php
              foreach (array_slice($data, 0, 5) as $recent):

                  if ($recent['id'] == $id) continue;

                  // Tentukan URL slug atau ID
                  $link = isset($recent['slug'])
                          ? 'detail_artikel.php?slug=' . $recent['slug']
                          : 'detail_artikel.php?id=' . $recent['id'];
              ?>

                <div class="recent-post-item"
                     style="display:flex;align-items:center;gap:12px;margin-bottom:15px;">

                  <a href="<?= $link ?>" style="flex-shrink:0;">
                    <img src="<?= htmlspecialchars($recent['image']) ?>"
                         alt="<?= htmlspecialchars($recent['title']) ?>"
                         style="width:80px;height:60px;object-fit:cover;border-radius:6px;">
                  </a>

                  <div style="flex:1;">
                    <a href="<?= $link ?>"
                       style="font-weight:600;text-decoration:none;color:#333;line-height:1.3;display:block;">
                      <?= htmlspecialchars($recent['title']) ?>
                    </a>
                  </div>

                </div>

              <?php endforeach; ?>

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
