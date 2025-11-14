<?php
header("Content-Type: application/xml; charset=UTF-8");

// Include koneksi database
include __DIR__ . "/admin/config.php"; 

// Query artikel
$query = $conn->query("SELECT slug, created_at FROM artikel ORDER BY id DESC");

// Output header XML
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<?php
while ($row = $query->fetch_assoc()):
    $slug = htmlspecialchars($row['slug']);
    $lastmod = date('Y-m-d', strtotime($row['created_at']));
?>
  <url>
    <loc>https://asiatek.co.id/detail_artikel.php?slug=<?= $slug ?></loc>
    <lastmod><?= $lastmod ?></lastmod>
    <changefreq>weekly</changefreq>
    <priority>0.80</priority>
  </url>
<?php endwhile; ?>
</urlset>
