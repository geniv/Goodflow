<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>U18.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
     </head>
     <body>
  <!-- U18.php -->
<?
  if(!$ukazatel=fopen("./text/slovo.txt","r")){
    echo("Soubor nelze otevřít!");
  }else{
    do{
      $pismeno=fgetc($ukazatel);
      if($pismeno=="\n" || $pismeno==" "){
        $statistika[StrLen($slovo)]++;
        $slovo="";
      }else{
        $slovo.=$pismeno;
      }
    }while($pismeno);
    fclose($ukazatel);

    echo "<b>Statistika délek slov načítaných ze souboru</b>";
    echo "<br>(slovo.txt)<br><br>";

    ARSort($statistika);     // sestupné utřídění se zachováním indexů
    while($polozka = Each($statistika)){
        echo "<b>Počet znaků:&nbsp;</b>".$polozka["key"].
             "&nbsp;&nbsp;<b>Výskytů:&nbsp;</b>".$polozka["value"]."<br>";
    }
  }
?>
     </body>
</html>
