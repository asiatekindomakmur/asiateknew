<?php
// sitemap-produk.php
header("Content-Type: application/xml; charset=UTF-8");

// Tampilkan error sementara untuk debugging (hapus di live jika mau)
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'admin/config.php'; // Pastikan config.php TIDAK menampilkan apapun

// Ambil data produk
$produk = [];
$result = $conn->query("SELECT slug, updated_at FROM products ORDER BY id DESC");
if($result) {
    while($row = $result->fetch_assoc()) {
        $produk[] = $row;
    }
}

// Mulai XML
echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<urlset xmlns="https://www.sitemaps.org/schemas/sitemap/0.9">';

foreach($produk as $p) {
    $slug = !empty($p['slug']) ? htmlspecialchars($p['slug'], ENT_QUOTES, 'UTF-8') : 'tidak-ada-slug';
    $lastmod = !empty($p['updated_at']) ? date('Y-m-d', strtotime($p['updated_at'])) : date('Y-m-d');

    echo "<url>
        <loc>https://asiatek.co.id/produk/$slug</loc>
        <lastmod>$lastmod</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.80</priority>
    </url>";
}

echo '</urlset>';