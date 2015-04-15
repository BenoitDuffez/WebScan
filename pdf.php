<?php

header('Location: /scan/');
$LOG = '/var/log/scan.log';

$files = implode(' scans/', $_GET['files']);
sort($files);
$target = sprintf("results/%s.pdf", date('Y-m-d_G-i-s'));
$cmd = sprintf("convert -compress jpeg scans/%s %s", $files, $target);
$ret = exec($cmd);
exec("cp -v '$target' '/home/bicou/ownCloud/a trier/' >$LOG");
exec("/home/bicou/ownCloudSync.sh >$LOG");

foreach ($_GET['files'] as $file) {
	exec(sprintf('rm -v scans/%s >%s', $file, $LOG));
}

