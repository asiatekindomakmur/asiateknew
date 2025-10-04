<?php
session_start();

$host = 'localhost';
$user = 'u429834259_admin';
$pass = 'Sqwe123@@';
$db   = 'u429834259_asiatekindo';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
