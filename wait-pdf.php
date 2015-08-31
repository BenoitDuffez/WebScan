<?php

if (isset($_GET['delete'])) {
	$path = str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']);
	foreach ($_GET['files'] as $name) {
		$file = $path . "scans/" . $name;
		if (file_exists($file) && strpos($name, '/') === false) {
			unlink($file);
			header("Location: /scan/");
			echo "<p>Delete $name</p>";
		}
	}
}
else {
?>
<script type="text/javascript">
setTimeout("window.location = '/scan/pdf.php<?php echo str_replace($_SERVER['REDIRECT_URL'], '', $_SERVER['REQUEST_URI']); ?>'", 100);
</script>
Génération du fichier PDF en cours...
<?php
}

