<h2>Scanner des pages</h2>
<p>Cliquer ici pour <a href="/scan/wait-scan.php">scanner une nouvelle page</a> au format A4.</p>

<h2>Générer un PDF</h2>
<p>Utiliser cette option pour prendre une ou plusieurs pages et les combiner en PDF</p>
<script type="text/javascript">
function createPdf() {
	var name = prompt("Quel nom de fichier? (sans la date)", '<?php echo date('G-i-s'); ?>');
	document.getElementById('filename').value = name;
	document.getElementById('pdfForm').submit();
}
</script>
<form id="pdfForm" method="get" action="/scan/wait-pdf.php">
<?php

$dir = opendir('scans/');
$files = array();
$i = 0;
while ($file = readdir($dir)) {
	if ($file == '.' || $file == '..') {
		continue;
	}
	$files[] = $file;
}
sort($files);

foreach($files as $file) {
	printf('<label style="float: left" for="%s"><input style="float: left" id="%s" type="checkbox" value="%s" name="files[%d]" /><img src="pic.php?file=%s" alt="%s" /></label>',
		md5($file), md5($file), $file, $i, $file, $file);
	$i++;
}
closedir($dir);
echo '<p style="clear: both">&nbsp;</p>';
if ($i == 0) {
	echo "<p>Il n'y a aucune page de scannée.</p>";
} else {
	echo <<<HTML
<input type="hidden" name="filename" id="filename" />
<input type="submit" name="delete" value="Supprimer" /> les fichiers sélectionnés (irréversible!)<br />
<input type="submit" name="download" value="Télécharger" /> les fichiers sélectionnés<br />
<input type="button" onclick="javascript:createPdf();" value="Créer un PDF avec ces fichiers" />
HTML;
}

?>
</form>

<h2>Télécharger les documents scannés</h2>
<p>Voici la liste des PDF récemment scannés :</p>
<form method="post" action="/scan/delete.php"><?php

$dir = opendir('results/');
$i = 0;
$files = array();
while ($file = readdir($dir)) {
	if (preg_match('/^.*\.pdf$/i', $file)) {
		$files[] = $file;
	}
}
sort($files);

foreach ($files as $file) {
	$html = ' 
<label for="%s">
	<input id="%s" type="checkbox" value="%s" name="files[%d]" /> %s (%.1f MB)
	<input type="button" value="Télécharger" onclick="javascript:window.location.href=\'download.php?file=%s\'">
</label><br />
';

	$stat = stat("results/$file");
	printf($html,
		md5($file),
		md5($file),
		$file,
		$i,
		$file,
		$stat['size'] / 1024 / 1024,
		$file
		);
	$i++;
}

closedir($dir);
clearstatcache();

if ($i == 0) {
	echo "<p>Il n'y a aucun PDF.</p>";
} else {
	echo '<p><input type="submit" value="Supprimer" /> les fichiers sélectionnés (irréversible!)</p>';
}
?>
</form>
</div>
