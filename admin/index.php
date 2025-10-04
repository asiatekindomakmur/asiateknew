<?php include 'config.php'; include 'includes/header.php'; ?>

<h3>Selamat datang, <?= $_SESSION['admin'] ?>!</h3>
<p>Ini adalah dashboard admin perusahaan.</p>

<div class="row mt-4">
  <div class="col-md-4">
    <div class="card text-center p-3">
      <h5><?= $conn->query("SELECT COUNT(*) AS c FROM products")->fetch_assoc()['c']; ?></h5>
      <p>Produk</p>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card text-center p-3">
      <h5><?= $conn->query("SELECT COUNT(*) AS c FROM articles")->fetch_assoc()['c']; ?></h5>
      <p>Artikel</p>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card text-center p-3">
      <h5><?= $conn->query("SELECT COUNT(*) AS c FROM messages")->fetch_assoc()['c']; ?></h5>
      <p>Pesan</p>
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>
