<?php
if (isset($_SERVER['HTTP_REFERER']) && preg_match('#/$#', $_SERVER['HTTP_REFERER'])) {
	echo <<<HTML
<script type="text/javascript">
setTimeout("window.location = 'scan.php'", 100);
</script>
Scan en cours...
HTML;
} else {
	header('Location: /scan/');
}

