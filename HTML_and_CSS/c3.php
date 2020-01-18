<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Lab PHP</title>
</head>
<body>
    <?php
    
    // header('Content-type: text/plain');
    $plik = fopen("slownik.txt", 'r');
    while (!feof($plik)) {
        $s = trim(fgets($plik));
        $s2 = $_GET[imie];
        $eq =true;
        
        if(strlen($s)==strlen($s2)){
            for($i=0; $i<strlen($s2); $i++){
                if(($s[$i]=!$s2[$i]) && ($s2[$i]!='_')){
                    $eq = false ;
                }
            }
            if($eq){
            echo $s."<br/>";
            }
          
        }
    }      
    fclose($plik);

?>
</body>

</html>