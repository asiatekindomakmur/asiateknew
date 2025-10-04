<?php
session_start();
if (!isset($_SESSION['admin'])) { header("Location: login.php"); exit; }
include 'config.php';

$id=intval($_GET['id']);
$result=$conn->query("DELETE FROM artikel WHERE id=$id");

if($result){
    $_SESSION['message']=['type'=>'success','text'=>'Artikel berhasil dihapus!'];
}else{
    $_SESSION['message']=['type'=>'danger','text'=>'Gagal menghapus artikel.'];
}

header("Location: artikel.php");
exit;
