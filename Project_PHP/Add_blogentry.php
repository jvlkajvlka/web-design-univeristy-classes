<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
	<meta http-equiv="Content-Type" content="application/xhtml+xml;charset=UTF-8" />
	<link rel="stylesheet" type="text/css" title="normal" href="style.css" media="screen" />
	<link rel="alternate stylesheet" title="blue" href="style2.css" type="text/css" media="screen" />
	<link rel="alternate stylesheet" title="pink" href="style3.css" type="text/css" media="screen" />
	<title>Dodaj wpis!</title>
	<script type="text/javascript" src="skrypt.js"></script>
</head>
<body onload="currentDate();listOfAttachments();listOfStyles();">
<meta http-equiv="Content-Type" content="application/xhtml+xml;
charset=UTF-8" />
	<p id="menu">
	<?php include "menu.php"; ?>
	</p>
	<div id="ListStyles"></div>
	
	<form action="wpis.php" method="post" enctype="multipart/form-data">
		<h1> Dodaj wpis </h1>
		<p>
		Login</br> <input type="text" name="userName"> <br/>
		Hasło</br> <input type="password" name="userPassword"> <br/>
		Wpis</br><br/> <textarea type="text" name="message" rows="5" cols="40"></textarea><br/>
		Data</br> <input type="text" name="date" id="iddata" onchange="checkDate();"> <br/>
		Godzina</br> <input type="text" name="time"id="idtime"onchange="checkTime();"><br/>
		Pliki:</br> 
		<div id="attachments"></div>		
		</br>
		</p>
		<p>
		<input type="submit" value="Dodaj wpis"><input type="reset"><br/>
		</p>
	</form>
</body>

</html>