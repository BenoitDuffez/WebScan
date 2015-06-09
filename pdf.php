<?php

header('Location: /scan/');

$files = implode(' scans/', $_GET['files']);
sort($files);
$target = sprintf("results/%s_%s.pdf", date('Y-m-d'), $_GET['filename']);
$cmd = sprintf("convert -compress jpeg 'scans/%s' '%s'", $files, $target);

ws_log("executing: $cmd");

$ret = exec($cmd);

ws_log("result: $ret");
ws_log(exec("cp '$target' '/home/bicou/ownCloud/a trier/'"));
ws_log(exec("/home/bicou/ownCloudSync.sh &"));

foreach ($_GET['files'] as $file) {
	ws_log("removing scans/$file: %s", exec(sprintf("rm 'scans/%s'", $file)));
}

