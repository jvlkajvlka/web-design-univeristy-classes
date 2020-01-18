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

<?php
        $key = 123456;
        $max = 1;
        $permissions = 0666;
        $auto = 1;
        $sem = sem_get($key,$max,$permissions,$auto);

	$commentType = $_POST['commentType'];
	$commentText = $_POST['comment'];
	$commentNick = $_POST['nick'];
	$commentRecord = $_POST['recordToComment'];
	
	date_default_timezone_set("Poland");
	$time = date("H:i:s");
	$date = date("Y-m-d");
	
	if (sem_acquire($sem,1) != false) {
		if (!(file_exists($commentRecord.".k")) && $commentRecord != "") {
			$oldMask = umask(0);
            mkdir($commentRecord.".k", 0777);
			umask($oldMask);
		}

		$number = 0;
		$stringNumber = sprintf("%d",$number);

		while (file_exists($commentRecord.".k/".$stringNumber)) {
			$number = $number + 1;
			$stringNumber = sprintf("%d",$number);
		}
		
	}

	$newPath = $commentRecord.".k/".$stringNumber;
	
		$file = fopen($newPath,"w");
		fwrite($file,$commentType."\n".$date." ".$time."\n".$commentNick."\n".$commentText."\n");
		fclose($file);
		sem_release($sem);


	echo ' 
	<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
	<html>
	<body>
	<h1> Dodano komantarz! </h1>
	<a href="./blog.php" class="button">BLOGI</a>
	</body>
	</html>
	';
?>
</body>
</html>