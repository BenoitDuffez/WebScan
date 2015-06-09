<?php
echo "Ref: '".print_r($_SERVER['HTTP_REFERER'],true)."'";

if (isset($_SERVER['HTTP_REFERER']) && preg_match('/wait-scan\.php$/', $_SERVER['HTTP_REFERER'])) {
	$ret = exec('scan-one-image');
	ws_log(print_r($ret, true));
}

header('Location: /scan/');

