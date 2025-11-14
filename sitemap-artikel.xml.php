<?php
header("Content-Type: application/xml; charset=utf-8");

include "admin/config.php";

echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<urlset xmlns="https://www.sitemaps.org/schemas/sitemap/0.9">
<?php
$artikel = fetchAll("SELECT slug, updated_at FROM artikel ORDER BY id DESC");

foreach ($artikel as $a) {
?>
    <url>
        <loc>https://asiatek.co.id/artikel/<?= htmlspecialchars($a['slug']) ?></loc>
        <lastmod><?= date('Y-m-d', strtotime($a['updated_at'])) ?></lastmod>
        <priority>0.80</priority>
    </url>
<?php } ?>
</urlset>
