<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
	<meta http-equiv="Content-Type" content="application/xhtml+xml;charset=UTF-8" />
	<link rel="stylesheet" type="text/css" href="style.css" media="screen" />
	<script type="text/javascript" src="script.js"></script>
	<title>Przeglądaj blogi!</title>
</head>
<body>

	<p id="menu">
	<?php include "menu.php"; ?>
	</p>
<?php
// sprawdzanie getem czy jest taki blog 
	echo "<br /><br />";
	$blogName = "";
	if (isset($_GET['nazwa'])) {
		$blogName = $_GET['nazwa'];
	}
//przekierowanie jeśli putse to lista blogów 
	if ($blogName == "") {
		$dir = new DirectoryIterator(".");
         	foreach ($dir as $file) {
             		if ($file->isDir() && !$file->isDot()) {
                		$blog = $file->getFilename();
                		echo sprintf("<a href=\"blog.php?nazwa=%s\"><h2>%s<h2></a><br />", $blog, $blog);
             		}
         	}
	}
//jeśli tak to wyświetlamy 
	else {
		if (file_exists($blogName)) {
			$blogDescription = fopen($blogName."/info", 'r');
			$lineNumber = 1;
			echo "<h1>Tytuł: ".$blogName."</h1><br />";
			while (($line = fgets($blogDescription)) != false) {
				if ($lineNumber == 1) {
						echo "<h1>Właściciel: ".$line."</h1><br />";
				} 
				else if ($lineNumber == 3) {
						echo "<h1>Opis: ".$line."</h1><br /><br />";
				}
				$lineNumber = $lineNumber + 1;
			}
			fclose($blogDescription);

			$dir = new DirectoryIterator($blogName);

			foreach($dir as $scan) {
				if(!($scan->isDir()) && preg_match("/^\d{16}$/",$scan)) { // wzorzec nazwy pilku 
					$file = fopen("./".$blogName."/".$scan,"r");
					while (($line = fgets($file)) != false) {
						echo "<strong>".$line."</strong><br /><br />"; // wpis
					}
				
					foreach(new DirectoryIterator($blogName) as $file) {
						if (preg_match("/".$scan."[1-3]/",$file)) {
							echo "<a href=./".$blogName."/".$file." download> ".$file."</a><br /><br />";
						}	 //załączniki 
					}
					$number = 0;
					if(file_exists($blogName."/".$scan.".k")) {
						foreach(new DirectoryIterator($blogName."/".$scan.".k") as $comm) {
							$file = fopen($blogName."/".$scan.".k/".$number,"r");
							while(($line = fgets($file)) != false) {
								echo $line."<br />";
							}
							$number = $number + 1; // komenatarz 
							echo "<br />";
						}
					}
				}
			}
		}
			
		else {
			echo "Blog ".$blogName." nie istnieje!";
		}	
	}
?>

</body>
</html>