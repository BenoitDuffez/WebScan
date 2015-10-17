<?php

if (isset($_GET['delete']) || isset($_GET['download'])) {
	$delete = isset($_GET['delete']);
	if ($delete) {
		header("Location: /scan/");
	} else {
		echo <<<HTML
<h2>Téléchargement au format jpg</h2>
<p>Faire clic droit: enregistrer la cible sous</p>
HTML;
	}

	$path = str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']);
	foreach ($_GET['files'] as $name) {
		$file = $path . "scans/" . $name;
		if (file_exists($file) && strpos($name, '/') === false) {
			if ($delete) {
				exec("trash $file");
				echo "<p>Delete $name</p>";
			} else {
				echo <<<HTML
<p><a href="scans/{$name}"><img src="pic.php?file={$name}" /></a></p>
HTML;
			}
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

