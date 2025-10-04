<?php
session_start();
if (!isset($_SESSION['admin'])) { header("Location: login.php"); exit; }
include 'config.php';

$id = intval($_GET['id']);
$result = $conn->query("SELECT * FROM articles WHERE id=$id");
$article = $result->fetch_assoc();

if (!$article) {
    $_SESSION['message'] = ['type'=>'danger','text'=>'Artikel tidak ditemukan.'];
    header("Location: articles.php");
    exit;
}

if (isset($_POST['update'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];

    $stmt = $conn->prepare("UPDATE articles SET title=?, description=? WHERE id=?");
    $stmt->bind_param("ssi",$title,$description,$id);

    if ($stmt->execute()) {
        $_SESSION['message'] = ['type'=>'success','text'=>'Artikel berhasil diperbarui!'];
    } else {
        $_SESSION['message'] = ['type'=>'danger','text'=>'Gagal memperbarui artikel.'];
    }
    header("Location: articles.php");
    exit;
}
?>

<!-- HTML sama seperti tambah artikel tapi dengan value diisi dan tombol Update -->
