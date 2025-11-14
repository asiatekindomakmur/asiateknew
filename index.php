<?php
include 'admin/config.php';

// Ambil data produk (urut berdasarkan id / urutan admin)
$products = fetchAll("SELECT * FROM products ORDER BY id ASC");

// Ambil artikel terbaru (limit 3)
$articles = fetchAll("SELECT * FROM artikel ORDER BY created_at DESC LIMIT 3");
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
          j=d.createElement(s), dl=l!='dataLayer'?'&l='+l:'';
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
  <title>PT Asiatek Indo Makmur | The best spare parts for heavy equipment</title>
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

  <!-- Font -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;700&display=swap" rel="stylesheet">

  <!-- Styles -->
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/navbar.css">
  <link rel="stylesheet" href="css/home_css/header.css">
  <link rel="stylesheet" href="css/home_css/product.css">
  <link rel="stylesheet" href="css/footer.css">
  <link rel="stylesheet" href="css/home_css/contactsec.css">
  <link rel="stylesheet" href="css/home_css/companyprofilehome.css">
  <link rel="stylesheet" href="css/home_css/ourcommitment.css">
  <link rel="stylesheet" href="css/home_css/application.css">
  <link rel="stylesheet" href="css/home_css/blogcard.css">
  <link rel="stylesheet" href="css/home_css/keunggulankami.css">
  <link rel="stylesheet" href="css/home_css/contact.css">
  <link rel="stylesheet" href="css/home_css/ourclient.css">
  <link rel="stylesheet" href="css/artikel_css/artikel.css">
  <link rel="stylesheet" href="css/artikel_css/blog.css">

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
  <!-- End Google Tag Manager (noscript) -->

  <!-- Header -->
  <header>
    <div class="container header-content navbar">
      <div class="header-title">
        <a href="index.php">
          <img src="img/logo.png" alt="Logo AIM" style="height: 60px">
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

  <!-- Hero Section -->
  <section class="hero">
    <img src="img/header.jpg" alt="Header Background"
         style="position:absolute;width:100%;height:100%;object-fit:cover;z-index:0;">
    <div class="container">
      <h2>Best Spare Part Heavy Equipment</h2>
      <p>
        PT. Asiatek Indo Makmur lahir sebagai perusahaan yang memfokuskan pada
        pengadaan suku cadang alat berat asal China. Dengan tujuan membantu
        memenuhi kebutuhan customer dalam suku cadang A2B asal China yang saat ini
        ketersediaannya masih sangat terbatas di pasar Indonesia.
      </p>
      <a href="https://wa.me/+6281213838567?text=Halo%20Saya%20Dapat%20Nomor%20Anda%20Dari%20Google"
         class="btn btn-contact">Hubungi Sekarang</a>
    </div>
  </section>

<!-- About Company -->
<section class="about-company">
  <div class="container">
    <div class="about-content">

      <!-- Text -->
      <div class="text">
        <h2>PT Asiatek Indo Makmur</h2>
        <div class="divider"></div>

        <p>
          Kami adalah perusahaan yang berbasis di Jakarta. Kami bergerak
          pada pengadaan barang, spare parts dan mesin serta solusi untuk
          jasa fabrikasi dan konstruksi.
        </p>

        <p>
          Kami menyediakan berbagai sparepart alat berat dari China seperti
          Excavator, Wheel Loader, Motor Grader, Vibro Roller, Bulldozer dengan
          beberapa brand yang kami sediakan dengan harga yang kompetitif dan
          berkualitas. PT. Asiatek Indo Makmur senantiasa berusaha konsisten
          dalam menghadirkan produk dan pekerjaan yang berkualitas dengan
          harga kompeten.
        </p>

        <div class="contact-buttons">
          <a href="https://wa.me/6281213838567" class="btn whatsapp-btn">
            <i class="fab fa-whatsapp"></i> +62 812-1383-8567
          </a>

          <a href="mailto:sales@asiatek.co.id" class="btn email-btn">
            <i class="fas fa-envelope"></i> sales@asiatek.co.id
          </a>
        </div>
      </div>

      <!-- Image Gallery -->
      <div class="image-gallery">
        <img src="img/gudangliugong.jpeg" alt="Gudang PT Asiatek 1">
        <img src="img/gudangliugong2.jpeg" alt="Gudang PT Asiatek 2">
        <img src="img/gudangliugong3.jpeg" alt="Gudang PT Asiatek 3">
      </div>

    </div>
  </div>
</section>

<!-- Hero 2 -->
<section class="hero1">
  <img src="img/lgpart.jpg" alt="Header Background"
       style="position:absolute;width:100%;height:100%;object-fit:cover;z-index:0;">
  <div class="container">
    <h2>Spare Parts For Earthmoving And Construction Equipment</h2>
    <p>High quality products, fast delivery</p>
    <a href="sparepart.php" class="btn btn-contact">Browse Catalog</a>
  </div>
</section>

<!-- Product Carousel -->
<section class="product-carousel">
  <h2>Spare parts for heavy machinery</h2>
  <p>Accessories, parts and spare parts for your machinery</p>

  <div class="carousel-wrapper">
    <button class="carousel-btn left">&#10094;</button>

    <div class="carousel">

      <?php 
        $wa_number = "6281213838567";
        foreach ($products as $p):
          $message  = "Halo saya dapat nomor anda dari google, Saya ingin menanyakan tentang produk (" . $p['name'] . ")";
          $wa_link  = "https://wa.me/" . $wa_number . "?text=" . urlencode($message);
      ?>

      <div class="product-item">
        <a href="<?= $wa_link ?>" target="_blank">
          <img src="admin/uploads/produk/<?= htmlspecialchars($p['image']) ?>"
               alt="<?= htmlspecialchars($p['name']) ?>">
          <p><?= htmlspecialchars($p['name']) ?></p>
        </a>
      </div>

      <?php endforeach; ?>

    </div>

    <button class="carousel-btn right">&#10095;</button>
  </div>
</section>

<!-- Product Description -->
<section class="product-description">
  <p class="highlight-text">
    Asiatek delivers replacement parts and maintenance products for Construction and Mining Equipment
  </p>

  <p>
    With more than 100,000 part numbers in stock, Asiatek offers its customers
    the best possible service in the replacement parts industry.
  </p>
</section>

<!-- Keunggulan Kami -->
<section class="advantages">
  <div class="advantages-container">

    <!-- Image -->
    <div class="advantages-image">
      <img src="img/worker.png" alt="Worker Image">
    </div>

    <!-- Content -->
    <div class="advantages-content">
      <h2>Keunggulan Kami</h2>

      <!-- Advantage Item 1 -->
      <div class="advantage-item">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none"
             viewBox="0 0 24 24" stroke="#0a1950" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round"
                d="M5 13l4 4L19 7"/>
        </svg>
        <div>
          <h4>Jaminan Mutu</h4>
          <p>Semua produk yang kami jual memiliki jaminan mutu keaslian dan garansi pada item tertentu.</p>
        </div>
      </div>

      <!-- Advantage Item 2 -->
      <div class="advantage-item">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none"
             viewBox="0 0 24 24" stroke="#0a1950" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round"
                d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6 5.87v-2a4 4 0 00-3-3.87M16 7a4 4 0 11-8 0 4 4 0 018 0z"/>
        </svg>
        <div>
          <h4>Tenaga Profesional</h4>
          <p>Semua pekerja perusahaan kami merupakan orang-orang profesional di bidangnya dan berpengalaman.</p>
        </div>
      </div>

      <!-- Advantage Item 3 -->
      <div class="advantage-item">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none"
             viewBox="0 0 24 24" stroke="#0a1950" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round"
                d="M12 8c1.657 0 3-1.343 3-3S13.657 2 12 2 9 3.343 9 5s1.343 3 3 3zm0 0v13m-3.5-3.5L12 21l3.5-3.5"/>
        </svg>
        <div>
          <h4>Usaha Resmi</h4>
          <p>Usaha kami berdiri resmi, memiliki badan hukum, dan siap menjadi mitra terbaik perusahaan Anda.</p>
        </div>
      </div>

      <!-- Advantage Item 4 -->
      <div class="advantage-item">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none"
             viewBox="0 0 24 24" stroke="#0a1950" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round"
                d="M9 17H4a1 1 0 01-1-1V6a1 1 0 011-1h11a1 1 0 011 1v10a1 1 0 01-1 1h-1m5 0a2 2 0 100-4h-1m-4 4h6m-1 0a2 2 0 110 4 2 2 0 010-4zM6 17a2 2 0 100 4 2 2 0 000-4z"/>
        </svg>
        <div>
          <h4>Pengiriman Cepat</h4>
          <p>Semua produk kami ready stok wilayah Indonesia sehingga pengiriman lebih cepat diterima.</p>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- Contact Indonesia -->
<div class="contact-container">
  <div class="contact-tabs">
    <div class="tab active">Hubungi Kami</div>
  </div>

  <div class="contact-info">
    <div class="contact-item">
      <img src="img/cssupport.png" alt="Phone Icon">
      <div>
        <strong>Customer Support</strong><br>
        +62 812-1383-8567
      </div>
    </div>

    <div class="divider"></div>

    <div class="contact-item">
      <img src="https://img.icons8.com/ios-filled/50/000000/phone.png" alt="Mobile Icon">
      <div>
        <strong>Asiatek Central</strong><br>
        +62 812-1383-8567
      </div>
    </div>

    <div class="divider"></div>

    <div class="contact-item">
      <img src="https://img.icons8.com/ios-filled/50/000000/new-post.png" alt="Email Icon">
      <div>
        <strong>Email</strong><br>
        sales@asiatek.co.id
      </div>
    </div>
  </div>
</div>

<!-- Our Client -->
<section class="our-clients-section">
  <div class="title">
    <h2>Our Clients</h2>
  </div>

  <div class="clients-grid">

    <!-- Client Logos -->
    <?php
      $clients = [
        "LOGO AUD.png", "LOGO STIM.png", "LOGO ARKA.png",
        "LOGO IPIP.png", "LOGO JA WATTIE.png", "LOGO BPM.png",
        "LOGO RIM.png", "LOGO RIMAU.png"
      ];
      foreach ($clients as $logo):
    ?>
    <div class="client-item">
      <div class="client-box">
        <img src="img/<?= $logo ?>" alt="Client Logo" onclick="openModal(this.src)">
      </div>
    </div>
    <?php endforeach; ?>

  </div>
</section>

<!-- Modal -->
<div id="modal" class="modal" onclick="closeModal()">
  <img id="modal-img" class="modal-content">
</div>

<script>
  function openModal(src) {
    document.getElementById("modal").style.display = "flex";
    document.getElementById("modal-img").src = src;
  }
  function closeModal() {
    document.getElementById("modal").style.display = "none";
  }
</script>

<!-- Applications Carousel -->
<section class="applications-carousel"
         style="background-image:url('img/bgpr.jpg');background-repeat:no-repeat;background-position:center;">
  <div class="carousel-wrapper">

    <button class="carousel-btn left">&#10094;</button>

    <div class="carousel">
      <div class="product-item"><img src="img/aplikasi/Hyundai.png" alt="Hyundai"></div>
      <div class="product-item"><img src="img/aplikasi/Hitachi.png" alt="Hitachi"></div>
      <div class="product-item"><img src="img/aplikasi/Caterpillar.png" alt="Caterpillar"></div>
      <div class="product-item"><img src="img/aplikasi/Kobelco.png" alt="Kobelco"></div>
      <div class="product-item"><img src="img/aplikasi/Komatsu.png" alt="Komatsu"></div>
      <div class="product-item"><img src="img/aplikasi/SANY.png" alt="SANY"></div>
      <div class="product-item"><img src="img/aplikasi/Zoomlion.png" alt="Zoomlion"></div>
      <div class="product-item"><img src="img/aplikasi/XCMG.png" alt="XCMG"></div>
    </div>

    <button class="carousel-btn right">&#10095;</button>
  </div>
</section>

<!-- Blog & Artikel -->
<section class="content-section" id="artikel">
  <div class="container">

    <!-- JUDUL -->
    <h2 class="section-title">Blog & Artikel</h2>
    <p class="section-subtitle">Informasi terbaru dan update penting untuk Anda</p>

    <?php
      // Ambil data artikel dari API
      $artikel = json_decode(
        file_get_contents("https://asiatek.co.id/admin/api/get_artikel.php"),
        true
      );
    ?>

    <!-- Artikel Grid -->
    <div class="blog-grid">

      <?php if (is_array($artikel) && count($artikel) > 0): ?>
        <?php foreach ($artikel as $row): ?>
        
          <div class="blog-post">
            <img src="<?= htmlspecialchars($row['image']) ?>"
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

    </div> <!-- end blog-grid -->

  </div>
</section>

<?php include 'footer.php'; ?>

</body>
</html>

