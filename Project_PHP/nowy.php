<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link rel="stylesheet" type="text/css" href="style.css" media="screen" />
	<script type="text/javascript" src="script.js"></script>
	<title>BLOG</title>
</head>
<body>

<p id="menu">
<?php include "menu.php";?>
</p>

<?php
        $key = 123456;
        $max = 1;
        $permissions = 0666;
        $auto = 1;
        $sem = sem_get($key,$max,$permissions,$auto);

	

	$newBlog = $_POST['blogName'];
	$ifCreate = false;
	if(sem_acquire($sem,1) != false) {
		if (!is_dir($newBlog)) {
			$oldMask = umask(0);
 			mkdir($newBlog, 0777);
			umask($oldMask);
			$myFile = fopen($newBlog."/info", "w");
			fwrite($myFile,$_POST["userName"]."\r\n".md5($_POST["userPassword"])."\r\n".$_POST["blogDescription"]);
			fclose($myFile);
			$ifCreate =true;
		echo ' 
		<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
		<html>
		<body>
		<h1> Dodano Bloga! </h1>
		<a href="./Add_blogentry.php" class="button">DODAJ WPIS</a>
		</body>
		</html>';
			

			
		}
		else {
			echo'
			<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
			<html>
			<body>
			<h1> Taki blog już istnieje! </h1>
			<a href="./Set_blog.php" class="button">STWÓRZ BLOGA!</a>
			</body>
			</html>';
		}
		sem_release($sem);
	}
?>

</body>
</html>