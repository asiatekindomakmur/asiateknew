<?php
// sitemap-index.php
header("Content-Type: application/xml; charset=UTF-8");
error_reporting(0); // hentikan error supaya XML valid

// URL sitemap yang ingin dimasukkan
$sitemaps = [
    'https://asiatek.co.id/sitemap-produk.php',
    'https://asiatek.co.id/sitemap-artikel.php',
    'https://asiatek.co.id/sitemap-pages.xml',
];

// Mulai XML
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<sitemapindex xmlns="https://www.sitemaps.org/schemas/sitemap/0.9">
<?php foreach ($sitemaps as $sitemap): ?>
    <sitemap>
        <loc><?= htmlspecialchars($sitemap, ENT_QUOTES, 'UTF-8') ?></loc>
        <lastmod><?= date('Y-m-d') ?></lastmod>
    </sitemap>
<?php endforeach; ?>
</sitemapindex>
