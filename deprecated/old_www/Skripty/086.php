<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>086.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
     </head>
     <body>
<!-- 086.php -->
<?
  if(!$ukazatel=fopen("./text/soubor2.txt","r")){
    echo("Soubor nelze otevřít!");
  }else{
    do{
      $pismeno=fgetc($ukazatel);
      if($pismeno=="\n")
        echo "<br>";   // konec řádku
      else
        echo $pismeno;
    }while($pismeno);
    fclose($ukazatel);
  }
?>
</body>
</html>
