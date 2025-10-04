<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
include 'config.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // pastikan id aman

    // Ambil info produk untuk mendapatkan nama file gambar
    $query = $conn->query("SELECT image FROM products WHERE id=$id");
    if ($query && $query->num_rows > 0) {
        $row = $query->fetch_assoc();
        $imageFile = $row['image'];

        // Hapus file gambar jika ada
        if (!empty($imageFile)) {
            $filePath = "uploads/produk/" . $imageFile;
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        // Hapus data produk dari database
        $result = $conn->query("DELETE FROM products WHERE id=$id");

        if ($result) {
            $_SESSION['message'] = ['type' => 'success', 'text' => 'Produk berhasil dihapus!'];
        } else {
            $_SESSION['message'] = ['type' => 'danger', 'text' => 'Gagal menghapus produk.'];
        }
    } else {
        $_SESSION['message'] = ['type' => 'warning', 'text' => 'Produk tidak ditemukan.'];
    }
}

header("Location: produk.php");
exit;
?>
