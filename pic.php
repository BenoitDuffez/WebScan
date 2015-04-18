<?php

$thumbn = sprintf('thumbs/%s', $_GET['file']);
$source = sprintf('scans/%s', $_GET['file']);

if (!file_exists($thumbn)) {
	$width = 210;
	$height = 297;

	$im = new Imagick($source);
	$im->setImageFormat('jpg');
	$im->resizeImage($width, $height, Imagick::FILTER_LANCZOS, 1.0);
	$im->writeImage($thumbn);
	$im->clear();
	$im->destroy();
}

header('Location: ' . $thumbn);

