<?php if (!isset($_SESSION['admin'])) { header("Location: login.php"); exit; } ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <title>Admin Panel</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand ms-3" href="index.php">Admin Panel</a>
  <div class="ms-auto me-3">
    <a href="logout.php" class="btn btn-outline-light btn-sm">Logout</a>
  </div>
</nav>
<div class="container-fluid">
  <div class="row">
    <div class="col-2 bg-light p-3 vh-100">
      <h6>Menu</h6>
      <a href="index.php" class="d-block mb-2">Dashboard</a>
      <a href="products.php" class="d-block mb-2">Produk</a>
      <a href="articles.php" class="d-block mb-2">Artikel</a>
      <a href="messages.php" class="d-block mb-2">Pesan</a>
    </div>
    <div class="col-10 p-4">
