<?php
// sitemap-artikel.php
header("Content-Type: application/xml; charset=UTF-8");
error_reporting(0); // hentikan error agar XML tetap valid

include "admin/config.php";

// Ambil data artikel terbaru
$artikel = fetchAll("SELECT slug, updated_at FROM artikel ORDER BY id DESC");

// Mulai XML
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<urlset xmlns="https://www.sitemaps.org/schemas/sitemap/0.9">
<?php foreach ($artikel as $a): ?>
    <url>
        <loc>https://asiatek.co.id/artikel/<?= htmlspecialchars($a['slug'], ENT_QUOTES, 'UTF-8') ?></loc>
        <lastmod><?= !empty($a['updated_at']) ? date('Y-m-d', strtotime($a['updated_at'])) : date('Y-m-d') ?></lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.80</priority>
    </url>
<?php endforeach; ?>
</urlset>
