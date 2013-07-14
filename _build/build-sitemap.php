<?php

$pages = glob( realpath( __DIR__."/../" )."/*.php" );
$filename = realpath( __DIR__."/../" )."/sitemap.xml";

$sitemap = '<?xml version="1.0" encoding="UTF-8"?>
<urlset
      xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
      xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
<url>
  <loc>http://gibson-db.in/</loc>
  <changefreq>daily</changefreq>
  <priority>1.00</priority>
</url>
<url>
  <loc>http://gibson-db.in/blog/</loc>
  <changefreq>daily</changefreq>
  <priority>1.00</priority>
</url>';

foreach( $pages as $page ){
    $page = basename($page);
    $sitemap .= '<url>
                    <loc>http://gibson-db.in/'.$page.'</loc>
                    <changefreq>weekly</changefreq>
                    <priority>0.80</priority>
                 </url>';
}

$sitemap .= '</urlset>';

file_put_contents( $filename, $sitemap );

?>
