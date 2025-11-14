<?php
header("Content-Type: application/xml; charset=UTF-8");
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'admin/config.php';

// Ambil data produk
$produk = [];
$result = $conn->query("SELECT slug, updated_at FROM products ORDER BY id DESC");
while($row = $result->fetch_assoc()) {
    $produk[] = $row;
}

// Mulai XML
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<urlset xmlns="https://www.sitemaps.org/schemas/sitemap/0.9">
<?php foreach($produk as $p): ?>
    <url>
        <loc>https://asiatek.co.id/produk/<?php echo htmlspecialchars($p['slug'], ENT_QUOTES, 'UTF-8'); ?></loc>
        <lastmod><?php echo !empty($p['updated_at']) ? date('Y-m-d', strtotime($p['updated_at'])) : date('Y-m-d'); ?></lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.80</priority>
    </url>
<?php endforeach; ?>
</urlset>
