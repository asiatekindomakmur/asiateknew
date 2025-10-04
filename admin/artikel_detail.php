<?php
session_start();
if (!isset($_SESSION['admin'])) { header("Location: login.php"); exit; }
include 'config.php';

$id=intval($_GET['id']);
$result=$conn->query("SELECT * FROM articles WHERE id=$id");
$article=$result->fetch_assoc();

if (!$article) {
    $_SESSION['message']=['type'=>'danger','text'=>'Artikel tidak ditemukan.'];
    header("Location: articles.php");
    exit;
}
?>

<!-- HTML menampilkan title, description, created_at dan tombol kembali ke articles.php -->
