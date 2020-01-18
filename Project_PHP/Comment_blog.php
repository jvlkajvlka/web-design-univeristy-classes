<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
	<meta http-equiv="Content-Type" content="application/xhtml+xml;charset=UTF-8" />
	<link rel="stylesheet" type="text/css" href="style.css" media="screen" />
	<script type="text/javascript" src="script.js"></script>
	<title>Dodaj komentarz!</title>
</head>
<body>
	<p id="menu">
	<?php include "menu.php"; ?>
	</p>
	<form action="comment.php" method="post" enctype="multipart/form-data">
		<h1>Dodaj Komentarz!</h1><br/>
		<p>
		Wybierz wpis, który chcesz skomentować:
		<select name="recordToComment">
			<?php
				$dir = new RecursiveDirectoryIterator('.');
				$iter = new RecursiveIteratorIterator($dir);
		      		foreach ($iter as $path => $file) {
	              			if (!($file->isDir())) {
	                			if (preg_match("/\d{16}$/",$file)) {
	                      				echo "<option>".$file."</option>";
						}
	                		}
	                	}
			?>
       		</select><br/>
		Rodzaj komentarza:<br/>
		<select name="commentType">
			<option>Pozytywny</option>
			<option>Neutralny</option>
			<option>Negatywny</option>
		</select><br/>
		Komentarz<br/><textarea type="text" name="comment" rows="5" cols="40"></textarea><br/>
		Pseudonim<input type="text" name="nick"><br/>
		 <br><input type="submit" value="Dodaj komentarz"><input type="reset"><br/>
					</p>
	</form>
</body>
</html>