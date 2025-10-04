<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
include 'config.php';

$id = $_GET['id'];
$result = $conn->query("DELETE FROM products WHERE id=$id");

if ($result) {
    $_SESSION['message'] = ['type' => 'success', 'text' => 'Produk berhasil dihapus!'];
} else {
    $_SESSION['message'] = ['type' => 'danger', 'text' => 'Gagal menghapus produk.'];
}

header("Location: produk.php");
exit;
?>
