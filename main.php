<h2>Scanner des pages</h2>
<p>Cliquer ici pour <a href="/scan/wait-scan.php">scanner une nouvelle page</a> au format A4.</p>

<h2>Générer un PDF</h2>
<p>Utiliser cette option pour prendre une ou plusieurs pages et les combiner en PDF</p>
<form method="get" action="/scan/wait-pdf.php"><?php

$dir = opendir('scans/');
$i = 0;
while ($file = readdir($dir)) {
	if ($file == '.' || $file == '..') {
		continue;
	}

	printf('<label for="%s"><input id="%s" type="checkbox" value="%s" name="files[%d]" /> %s</label><br />',
		md5($file), md5($file), $file, $i, $file);
	$i++;
}
closedir($dir);
if ($i == 0) {
	echo "<p>Il n'y a aucune page de scannée.</p>";
} else {
	echo '<input type="submit" value="Créer un PDF avec ces fichiers" />';
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
	if ($file == '.' || $file == '..') {
		continue;
	}
	$files[] = $file;
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
