<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>U19.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
     </head>
     <body>
<!-- U19.php -->
<?
  if((!$ukazatel=fopen("./text/slovo.txt","r")) || (!$ukazatel2=fopen("./text/prepis.txt","w"))){
    echo("Nelze otevřít potřebné soubory!");
  }else{
    do{
      $pismeno=fgetc($ukazatel);
      if($pismeno=="\n" || $pismeno==" "){
        if(StrLen($slovo)==5){
          $slovo.=" ";
          fputs($ukazatel2,$slovo);
        }
        $slovo="";
      }else{
        $slovo.=$pismeno;
      }
    }while($pismeno);
    fclose($ukazatel);
    fclose($ukazatel2);

    echo "<b>Přepis pětiznakových slov do nového souboru</b>";
    echo "<br>(slovo.txt -> prepis.txt)<br><br>";
  }
?>
     </body>
</html>
