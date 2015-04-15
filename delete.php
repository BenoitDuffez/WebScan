<?php
if (isset($_POST['files']) && is_array($_POST['files'])) {
	foreach ($_POST['files'] as $file) {
		if (file_exists("results/$file")) {
			unlink("results/$file");
		}
	}
}

header('Location: /scan/');

