<?php
$file = 'results/' . str_replace('/', '', $_GET['file']);
if (file_exists($file)) {
    if(false !== ($handler = fopen($file, 'r'))) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.basename($file));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));

	readfile($file);
    }
    exit;
}

echo 'Fichier non trouvé!';

