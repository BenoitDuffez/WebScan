<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php
header('Content-type: text/html; charset=utf-8');
?>
<style>
body {
	counter-reset : h2;
	background-color: #eee;
}
h2:before {
	counter-increment: h2;
	content: counter(h2) " — ";
}
#main {
	margin-left: 25%;
	padding: 25px;
	width: 50%;
	min-width: 500px;
	margin-top: 50px;
	border: 1px #999 solid;
	background-color: #fff;
	box-shadow: 5px 5px 5px #888888;
}
</style>
</head>
<body>
<div id="main">
<h1>HP Deskjet F2100 Series</h1>
<hr />
<?php

$page = $_GET['page'];
switch ($page) {
case 'delete':
case 'download':
case 'scan':
case 'wait-scan':
case 'pdf':
case 'wait-pdf':
	include "$page.php";
	break;

case '':
default:
	include "main.php";
	break;
}

?>
</div>
</body>
</html>
