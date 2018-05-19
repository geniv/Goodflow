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
    echo("Soubor nelze otevřít!");
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

    echo "<b>Hledání nejdelšího slova načteného ze souboru</b>";
    echo "<br>(slovo.txt)";
    echo "<br><br><b>Nejdelší slovo:</b>&nbsp;".$nej_slovo;
    echo "<br><b>Počet znaků slova:</b>&nbsp;".StrLen($nej_slovo);
  }
?>
     </body>
</html>
