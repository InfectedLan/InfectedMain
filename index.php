<?php
$version = 7;
$url = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] . 'v' . $version . '/';

header('Location: https://' . $url);
?>