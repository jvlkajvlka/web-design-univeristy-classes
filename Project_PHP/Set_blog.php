<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
	<meta http-equiv="Content-Type" content="application/xhtml+xml;charset=UTF-8" />
	<link rel="stylesheet" type="text/css" href="style.css" media="screen" />
	<script type="text/javascript" src="script.js"></script>
	<title>Załóż Blog!</title>
</head>
<body>
	<p id="menu">
	<?php include "menu.php"; ?>
	</p>
    <form action="nowy.php" method="post" enctype="multipart/form-data">
        <h1>Załóż nowy blog</h1>
        <p>
        Podaj nazwę bloga:<br /> <input type="text" name="blogName"><br />
		Login<br /> <input type="text" name="userName"><br />
		Hasło<br /> <input type="password" name="userPassword"><br />
		Opis bloga <br/> <textarea type="text" rows="5" cols="40" name="blogDescription"></textarea><br />
 		<input type="submit" value="Stwórz bloga">
        <input type="reset">
		<p>

	</form>
</body>
</html>

