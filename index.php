<?php
include 'config.php';

// Ambil data produk (urut berdasarkan id / urutan admin)
$products = fetchAll("SELECT * FROM products ORDER BY id ASC");

// Ambil artikel terbaru (limit 3)
$articles = fetchAll("SELECT * FROM artikel ORDER BY created_at DESC LIMIT 3");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>
      PT Asiatek Indo Makmur | The best spare parts for heavy equipment
    </title>
    <meta
      name="description"
      content="PT Asiatek Indo Makmur Menyediakan berbagai Suku Cadang dan Sparepart Alat Berat dengan Harga yang kompetetif dan berkualitas. Hubungi: +62 812-1383-8567 untuk mendapatkan informasi produk. Layanan Terbaik dan Jaminan Mutu."
    />
    <link rel="icon" type="image/png" href="/img/logo.png">


    <!-- Font -->
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;700&display=swap"
      rel="stylesheet"
    />

    <link rel="icon" type="image/png" href="img/logo.png" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/navbar.css" />
    <link rel="stylesheet" href="css/home_css/header.css" />
    <link rel="stylesheet" href="css/home_css/product.css" />
    <link rel="stylesheet" href="css/footer.css" />
    <link rel="stylesheet" href="css/home_css/contactsec.css" />
    <link rel="stylesheet" href="css/home_css/companyprofilehome.css" />
    <link rel="stylesheet" href="css/home_css/ourcommitment.css" />
    <link rel="stylesheet" href="css/home_css/application.css" />
    <link rel="stylesheet" href="css/home_css/blogcard.css" />
    <link rel="stylesheet" href="css/home_css/keunggulankami.css" />
    <link rel="stylesheet" href="css/home_css/contact.css" />
    <link rel="stylesheet" href="css/home_css/ourclient.css" />

    <script src="js/script.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
  </head>
  <body>
    <!-- Header -->
    <header>
      <div class="container header-content navbar">
        <!-- Logo -->
        <div class="header-title">
          <img src="img/logo.png" alt="Logo AIM" style="height: 60px" />
        </div>

        <!-- Hamburger Menu (Mobile Only) -->
        <div class="hamburger-menu">&#9776;</div>

        <!-- Nav Links -->
        <nav class="nav links">
          <a href="index.html">Home</a>
          <a href="sparepart.html">Spare parts</a>
          <a href="service.html">Service</a>
          <a href="about.html">About Us</a>
          <a href="contact.html">Contact</a>
          <a href="contact.html">Blog & Artikel</a>
        </nav>
      </div>
    </header>

    <!-- Hero -->
    <section class="hero">
      <img
        src="img/header.jpg"
        alt="Header Background"
        style="
          position: absolute;
          width: 100%;
          height: 100%;
          object-fit: cover;
          z-index: 0;
        "
      />
      <div class="container">
        <h2>Best Spare Part Heavy Equipment</h2>
        <p>
          PT. Asiatek Indo Makmur lahir sebagai perusahaan yang memfokuskan pada
          pengadaan suku cadang alat berat asal China. Dengan tujuan membantu
          memenuhi kebutuhan customer dalam suku cadang A2B asal China yang saat
          ini ketersediaannya masih sangat terbatas di pasar Indonesia.
        </p>
        <a
          href="https://wa.me/+6281213838567?text=Halo%20Saya%20Dapat%20Nomor%20Anda%20Dari%20Google"
          class="btn btn-contact"
          >Hubungi Sekarang</a
        >
      </div>
    </section>

<!-- About Company -->
<section class="about-company">
  <div class="container">
    <div class="about-content">
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

      <!-- Galeri 3 Gambar -->
      <div class="image-gallery">
        <img src="img/gudangliugong.jpeg" alt="Gudang PT Asiatek 1" />
        <img src="img/gudangliugong2.jpeg" alt="Gudang PT Asiatek 2" />
        <img src="img/gudangliugong3.jpeg" alt="Gudang PT Asiatek 3" />
      </div>
    </div>
  </div>
</section>


    <!-- Hero -->
    <section class="hero1">
      <img
        src="img/lgpart.jpg"
        alt="Header Background"
        style="
          position: absolute;
          width: 100%;
          height: 100%;
          object-fit: cover;
          z-index: 0;
        "
      />
      <div class="container">
        <h2>Spare Parts For Earthmoving And Construction Equipment</h2>
        <p>High quality products, fast delivery</p>
        <a href="sparepart.html" class="btn btn-contact">Browse Catalog</a>
      </div>
    </section>

  <!-- Product Section Dinamis -->
  <section class="product-carousel">
      <h2>Spare parts for heavy machinery</h2>
      <p>Accessories, parts and spare parts for your machinery</p>

      <div class="carousel-wrapper">
          <!-- Left button -->
          <button class="carousel-btn left">&#10094;</button>

          <!-- Carousel dengan produk dinamis -->
          <div class="carousel">
              <?php foreach ($products as $p): ?>
              <div class="product-item">
                  <a href="<?= htmlspecialchars($p['link']) ?>">
                      <img src="uploads/produk/<?= htmlspecialchars($p['image']) ?>" alt="<?= htmlspecialchars($p['name']) ?>" />
                      <p><?= htmlspecialchars($p['name']) ?></p>
                  </a>
              </div>
              <?php endforeach; ?>
          </div>

          <!-- Right button -->
          <button class="carousel-btn right">&#10095;</button>
      </div>

      <!-- Teks di bawah carousel -->
      <div class="product-description">
          <p class="highlight-text">
              Asiatek delivers replacement parts and maintenance products for Construction and Mining Equipment
          </p>
          <p>
              With more than 100,000 part numbers in stock, Asiatek offers its customers the best possible service in the replacement parts industry.
          </p>
      </div>
  </section>

  <!-- Keunggulan Kami -->
  <section class="advantages">
    <div class="advantages-container">
        <div class="advantages-image">
          <img src="img/worker.png" alt="Worker Image" />
        </div>
        <div class="advantages-content">
          <h2>Keunggulan Kami</h2>
          
          <div class="advantage-item">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="icon"
              fill="none"
              viewBox="0 0 24 24"
              stroke="#0a1950"
              stroke-width="2"
              >
              <path
              stroke-linecap="round"
              stroke-linejoin="round"
                d="M5 13l4 4L19 7"
                />
              </svg>
            
            <div>
              <h4>Jaminan Mutu</h4>
              <p>
                Semua produk yang kami jual memiliki jaminan mutu keaslian dan
                garansi pada item tertentu
              </p>
            </div>
          </div>

          <div class="advantage-item">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="icon"
              fill="none"
              viewBox="0 0 24 24"
              stroke="#0a1950"
              stroke-width="2"
              >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6 5.87v-2a4 4 0 00-3-3.87M16 7a4 4 0 11-8 0 4 4 0 018 0z"
                />
            </svg>
            <div>
              <h4>Tenaga Profesional</h4>
              <p>
                Semua pekerja perusahaan kami merupakan orang-orang profesional
                di bidangnya dan memiliki pengalaman yang mumpuni
              </p>
            </div>
          </div>
          
          <div class="advantage-item">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="icon"
              fill="none"
              viewBox="0 0 24 24"
              stroke="#0a1950"
              stroke-width="2"
              >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M12 8c1.657 0 3-1.343 3-3S13.657 2 12 2 9 3.343 9 5s1.343 3 3 3zm0 0v13m-3.5-3.5L12 21l3.5-3.5"
                />
              </svg>
            <div>
              <h4>Usaha Resmi</h4>
              <p>
                Usaha kami berdiri resmi memiliki badan hukum sesuai bidang jasa
                dan siap menjadi mitra terbaik perusahaan anda
              </p>
            </div>
          </div>
          
          <div class="advantage-item">
            <svg
            xmlns="http://www.w3.org/2000/svg"
            class="icon"
            fill="none"
            viewBox="0 0 24 24"
            stroke="#0a1950"
            stroke-width="2"
            >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M9 17H4a1 1 0 01-1-1V6a1 1 0 011-1h11a1 1 0 011 1v10a1 1 0 01-1 1h-1m5 0a2 2 0 100-4h-1m-4 4h6m-1 0a2 2 0 110 4 2 2 0 010-4zM6 17a2 2 0 100 4 2 2 0 000-4z"
                />
              </svg>
              <div>
              <h4>Pengiriman Cepat</h4>
              <p>
                Semua produk kami ready stok wilayah Indonesia sehingga
                pengiriman bisa lebih cepat anda terima
              </p>
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
                  <div class="client-item">
                    <div class="client-box">
                      <img src="img/LOGO AUD.png" alt="Popular Kaca" onclick="openModal(this.src)" />
                    </div>
                  </div>
                  <div class="client-item">
                    <div class="client-box">
                      <img src="img/LOGO STIM.png" alt="Popular Kaca" onclick="openModal(this.src)" />
                    </div>
                  </div>
                  <div class="client-item">
                    <div class="client-box">
                      <img src="img/LOGO ARKA.png" alt="Popular Kaca" onclick="openModal(this.src)" />
                    </div>
                  </div>
                  <div class="client-item">
                    <div class="client-box">
                      <img src="img/LOGO IPIP.png" alt="Popular Kaca" onclick="openModal(this.src)" />
                    </div>
                  </div>
                  <div class="client-item">
                    <div class="client-box">
                      <img src="img/LOGO JA WATTIE.png" alt="Popular Kaca" onclick="openModal(this.src)" />
                    </div>
                  </div>
                  <div class="client-item">
                    <div class="client-box">
                      <img src="img/LOGO BPM.png" alt="Best Label" onclick="openModal(this.src)" />
                    </div>
                  </div>
                  <div class="client-item">
                    <div class="client-box">
                      <img src="img/LOGO RIM.png" alt="Sheraton" onclick="openModal(this.src)" />
                    </div>
                  </div>
                  <div class="client-item">
                    <div class="client-box">
                      <img src="img/LOGO RIMAU.png" alt="Packing Material Indonesia" onclick="openModal(this.src)" />
                    </div>
                  </div>
                </div>
              </section>
              
              <!-- Modal -->
              <div id="modal" class="modal" onclick="closeModal()">
                <img id="modal-img" class="modal-content" />
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
    
    <!-- Aplication Section -->
    <section
    class="applications-carousel"
    style="
      background-image: url('img/bgpr.jpg');
      background-repeat: no-repeat;
      background-position: center center;
    "
  >
    <div class="carousel-wrapper">
      <button class="carousel-btn left">&#10094;</button>
  
      <div class="carousel">
        <div class="product-item">
          <img src="img/aplikasi/Hyundai.png" alt="Undercarriage" />
        </div>
        <div class="product-item">
          <img src="img/aplikasi/Hitachi.png" alt="Hardware" />
        </div>
        <div class="product-item">
          <img src="img/aplikasi/Caterpillar.png" alt="Chasis" />
        </div>
        <div class="product-item">
          <img src="img/aplikasi/Kobelco.png" alt="Lights" />
        </div>
        <div class="product-item">
          <img src="img/aplikasi/Komatsu.png" alt="Electrical Parts" />
        </div>
        <div class="product-item">
          <img src="img/aplikasi/SANY.png" alt="Engine" />
        </div>
        <div class="product-item">
          <img src="img/aplikasi/Zoomlion.png" alt="Hydraulics" />
        </div>
        <div class="product-item">
          <img src="img/aplikasi/XCMG.png" alt="Filters" />
        </div>
      </div>
      <button class="carousel-btn right">&#10095;</button>
    </div>
  </section>
    
    <!-- Blog Section -->
    <section class="blog-section">
      <div class="container">
        <h2>Blog & Artikel</h2>
        <p>
          Dapatkan informasi terbaru seputar alat berat, perawatan, dan tips
          terbaik.
        </p>

        <div class="blog-grid">
          <!-- Artikel 1 -->
          <div class="blog-card">
            <img src="img/exb.jpg" alt="Tips Merawat Excavator" />
            <h3>Tips Merawat Excavator Agar Tetap Prima</h3>
            <p>
              Excavator yang dirawat dengan baik akan lebih awet dan efisien.
              Berikut adalah 7 tips perawatan yang wajib dilakukan.
            </p>
            <a href="#">Read More</a>
          </div>

          <!-- Artikel 2 -->
          <div class="blog-card">
            <img src="img/spb.jpg" alt="Memilih Sparepart" />
            <h3>Cara Memilih Spare Part Berkualitas untuk Alat Berat</h3>
            <p>
              Memilih suku cadang yang tepat sangat penting untuk menjaga
              performa alat berat Anda.
            </p>
            <a href="#">Read More</a>
          </div>

          <!-- Artikel 3 -->
          <div class="blog-card">
            <img src="img/pwb.jpg" alt="Perawatan Berkala" />
            <h3>Pentingnya Perawatan Berkala pada Alat Berat</h3>
            <p>
              Servis rutin dapat mencegah kerusakan besar dan menghemat biaya
              operasional jangka panjang.
            </p>
            <a href="#">Read More</a>
          </div>
        </div>
      </div>
    </section>

    <?php include 'footer.php'; ?>
  </body>
</html>
