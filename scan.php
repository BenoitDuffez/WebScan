<?php

$ret = exec('scan-one-image');
print_r($ret);
header('Location: /scan/');

