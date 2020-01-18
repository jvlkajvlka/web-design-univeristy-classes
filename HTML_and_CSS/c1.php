<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Lab PHP</title>
</head>
<body>
   
    <?php
    function witaj($wpisz) {
        if($wpisz=="Julia"){
        return 'Cześć ' . $wpisz . '!';
        }else{
            echo ('Brak dostępu');
            for($i=1;$i<=$wpisz;$i++){
                echo($i );
            }
            
      }
    } 
    

	// print_r($_GET); // puste tabele - tablice do odczytu co przesylamy za pomocą pól formularza
    // print_r($_POST);

    $zmienna = witaj($_GET[imie]);
    echo $zmienna;
 

    ?>
</body>
</html>