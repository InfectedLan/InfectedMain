<?php
// Add include_path in order to
set_include_path('.:/home/infectedlan.tk/public_html/api/');

require_once 'site.php';

// Execute the site.
$site = new Site();
$site->execute();
?>