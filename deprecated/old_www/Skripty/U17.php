<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>U17.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
     </head>
     <body>
<!-- U17.php -->
<?
  if(!$ukazatel=fopen("./text/slovo.txt","r")){
    echo("Soubor nelze otev��t!");
  }else{
    $nej_slovo="";
    do{
      $pismeno=fgetc($ukazatel);
      if($pismeno=="\n" || $pismeno==" "){
        if(StrLen($nej_slovo)<StrLen($slovo))
          $nej_slovo=$slovo;
        $slovo="";
      }else{
        $slovo.=$pismeno;
      }
    }while($pismeno);
    fclose($ukazatel);

    echo "<b>Hled�n� nejdel��ho slova na�ten�ho ze souboru</b>";
    echo "<br>(slovo.txt)";
    echo "<br><br><b>Nejdel�� slovo:</b>&nbsp;".$nej_slovo;
    echo "<br><b>Po�et znak� slova:</b>&nbsp;".StrLen($nej_slovo);
  }
?>
     </body>
</html>
