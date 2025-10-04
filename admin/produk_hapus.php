<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit;
}
include 'config.php';

$id = $_GET['id'];
$conn->query("DELETE FROM products WHERE id=$id");

header("Location: produk.php");
exit;
?>
