<?php

header('Location: /scan/');
$LOG = '/var/log/scan.log';

$files = implode(' scans/', $_GET['files']);
sort($files);
$target = sprintf("results/%s_%s.pdf", date('Y-m-d'), $_GET['filename']);
$cmd = sprintf("convert -compress jpeg scans/%s %s", $files, $target);
$ret = exec($cmd);
exec("cp -v '$target' '/home/bicou/ownCloud/a trier/' >$LOG");
exec("/home/bicou/ownCloudSync.sh >$LOG");

foreach ($_GET['files'] as $file) {
	exec(sprintf('rm scans/%s', $file));
}

