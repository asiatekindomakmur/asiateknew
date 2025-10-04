<?php
// contact.php
include 'admin/config.php'; // koneksi database

// Tangani POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $conn->real_escape_string($_POST['name']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $message = $conn->real_escape_string($_POST['message']);

    // Simpan ke database
    $sql = "INSERT INTO messages (name, phone, message, created_at) VALUES ('$name', '$phone', '$message', NOW())";
    if ($conn->query($sql)) {
        echo "✅ Pesan berhasil dikirim! Terima kasih.";
    } else {
        echo "❌ Terjadi kesalahan: " . $conn->error;
    }
    exit; // hentikan eksekusi setelah AJAX response
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PT Asiatek Indo Makmur | Contact</title>
    <meta name="description" content="Kontak PT Asiatek Indo Makmur untuk pertanyaan dan layanan sparepart alat berat.">

    <!-- Font & CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/navbar.css" />
    <link rel="stylesheet" href="css/footer.css" />
    <link rel="stylesheet" href="css/contact_css/header_contact.css" />
    <link rel="stylesheet" href="css/contact_css/contact.css" />

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
          <a href="index.php">Home</a>
          <a href="sparepart.php">Spare parts</a>
          <a href="service.php">Service</a>
          <a href="about.php">About Us</a>
          <a href="contact.php">Contact</a>
          <a href="artikel.php">Blog & Artikel</a>
        </nav>
      </div>
    </header>

    <!-- Contact Hero -->
    <section class="about-hero" style="background-image: url('img/contact.jpeg'); background-size: cover; background-position: center;">
      <div class="about-hero-overlay">
        <div class="about-hero-content container">
          <h1>Contact Us</h1>
          <p>Jika Anda membutuhkan bantuan atau informasi lebih lanjut, kami siap membantu Anda dengan solusi terbaik. Hubungi kami sekarang!</p>
        </div>
      </div>
    </section>

    <!-- Contact Section -->
    <div class="wrapper">
      <h2>Contact Us</h2>
      <p>Fill out the form below to get in touch with us.</p>

      <div class="container">
        <div class="contact-form">
          <form id="contactForm" method="post">
            <label for="name">Your Name:</label>
            <input type="text" id="name" name="name" required />

            <label for="phone">Your Phone Number:</label>
            <input type="tel" id="phone" name="phone" required />

            <label for="message">Message:</label>
            <textarea id="message" name="message" rows="6" required></textarea>

            <button type="submit"><strong>Submit</strong></button>
          </form>
        </div>

        <div class="map1">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.6806696924154!2d106.77030197355363!3d-6.173490760493029!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f7d546233a65%3A0x12f0fd11a90e435!2sJl.%20Asia%20Baru%2C%20Kedoya%20Utara%2C%20Kec.%20Kebon%20Jeruk%2C%20Kota%20Jakarta%20Barat%2C%20Daerah%20Khusus%20Ibukota%20Jakarta%2011510!5e0!3m2!1sen!2sid!4v1700000000000" width="100%" height="200" style="border:0" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
      </div>
    </div>

    <!-- Footer -->
    <?php include 'footer.php'; ?>

    <script>
      feather.replace(); // Inisialisasi feather icon

      // AJAX submit form
      document.getElementById("contactForm").addEventListener("submit", function (e) {
        e.preventDefault(); 
        const form = e.target;
        const formData = new FormData(form);

        fetch("contact.php", {
          method: "POST",
          body: formData
        })
        .then(res => res.text())
        .then(data => {
          alert(data);
          form.reset();
        })
        .catch(err => {
          alert("❌ Gagal mengirim pesan.");
          console.error(err);
        });
      });
    </script>
</body>
</html>
