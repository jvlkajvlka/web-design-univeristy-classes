<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
	<meta http-equiv="Content-Type" content="application/xhtml+xml;charset=UTF-8" />
	<link rel="stylesheet" type="text/css" href="style.css" media="screen" />
	<script type="text/javascript" src="script.js"></script>
	<title>Wpis!</title>
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

	

	$blogName = "";
	$userName = $_POST["userName"];
	$userPassword = $_POST["userPassword"];
 
	$dirContent = new RecursiveDirectoryIterator('.');
	$dirIterator = new RecursiveIteratorIterator($dirContent);

	foreach($dirIterator as $path => $file) {
		if (!($file->isDir()) && $file->getFileName() == 'info') {
				
			$lines = file($path);
			$fileUserName = $lines[0];
			$fileUserName = trim($fileUserName,"\r\n");
			$fileUserPassword = $lines[1];
			$fileUserPassword = trim($fileUserPassword,"\r\n");			
			if ($fileUserName == $userName && md5($userPassword) == $fileUserPassword) {
				$blogName = dirname($path);
				$blogName = trim($blogName,"./");
				break;
			}
		}
	}

	if ($blogName != "") {
		$date = $_POST["date"];
		$time = $_POST["time"];
	
		$date = str_replace("-","",$date);
		$time = str_replace(":","",$time);	

		date_default_timezone_set("Poland");
		$tmp = getdate();
		$seconds = sprintf("%02d",tmp['seconds']);


		if(sem_acquire($sem,1) != false) {
			$uID = 0;
			do {
				$stringUID = sprintf("%02d",$uID);
				$fileName = $date.$time.$seconds.$stringUID;
				$uID = $uID + 1;
			} while (file_exists($blogName."/".$fileName));

			$fileName = $date.$time.$seconds.$stringUID;
			$myFile = fopen($blogName."/".$fileName, "w");
                	fwrite($myFile,$_POST["message"]."\r\n");
			fclose($myFile);
			sem_release($sem);
		}

		$number = 1;
		for($i = 1; $i <= sizeof($_FILES); $i = $i + 1) {
			$file = $_FILES['file'.$i];
			if ($file['size'] != 0) {
				$extension = pathinfo($file['name'],PATHINFO_EXTENSION);
				$stringNumber = sprintf("%d",$number);
				$number = $number + 1;
				$attachmentName = $fileName.$stringNumber.".".$extension;
				if(!(file_exists($blogName."/".$attachmentName))) {
					move_uploaded_file($file['tmp_name'],$blogName."/".$attachmentName);
				}
			}
		}
	echo ' 
	<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
	<html>
	<body>
	<h1> Dodano wpis! </>
	</body>
	</html>
	';
	}	
	else {
		echo ' 
	<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
	<html>
	<body>
	<h1> Coś poszło nie tak! Sprawdź hasło i login. </h1>
	<a href="./Add_blogentry.php" class="button">LOGOWANIE</a>
	</body>
	</html>
	';
	
	}
?>
</body>
</html>