<?php
header("Content-Type: application/xml; charset=utf-8");

include "admin/config.php";

echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<urlset xmlns="https://www.sitemaps.org/schemas/sitemap/0.9">
<?php
$produk = fetchAll("SELECT slug, updated_at FROM products ORDER BY id DESC");

foreach ($produk as $p) {
?>
    <url>
        <loc>https://asiatek.co.id/produk/<?= htmlspecialchars($p['slug']) ?></loc>
        <lastmod><?= date('Y-m-d', strtotime($p['updated_at'])) ?></lastmod>
        <priority>0.85</priority>
    </url>
<?php } ?>
</urlset>
