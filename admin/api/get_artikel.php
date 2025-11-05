<?php
include "../config.php";
header('Content-Type: application/json; charset=utf-8');

// Ambil parameter pencarian
$search = isset($_GET['search']) ? trim($_GET['search']) : null;

// Query dasar
$sql = "SELECT id, title, description, image, created_at FROM artikel";

// Tambahkan pencarian jika ada
if (!empty($search)) {
    $safe_search = $conn->real_escape_string($search);
    $sql .= " WHERE title LIKE '%$safe_search%' OR description LIKE '%$safe_search%'";
}

// Urutkan artikel terbaru
$sql .= " ORDER BY id DESC";

$result = $conn->query($sql);

$artikel = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Buat URL gambar lengkap
        if (!empty($row['image'])) {
            $row['image'] = 'https://asiatek.co.id/admin/uploads/artikel/' . $row['image'];
        }
        $artikel[] = $row;
    }
}

// Output JSON
echo json_encode($artikel, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
?>
