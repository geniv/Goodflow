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
    echo("Soubor nelze otev��t!");
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

    echo "<b>Statistika d�lek slov na��tan�ch ze souboru</b>";
    echo "<br>(slovo.txt)<br><br>";

    ARSort($statistika);     // sestupn� ut��d�n� se zachov�n�m index�
    while($polozka = Each($statistika)){
        echo "<b>Po�et znak�:&nbsp;</b>".$polozka["key"].
             "&nbsp;&nbsp;<b>V�skyt�:&nbsp;</b>".$polozka["value"]."<br>";
    }
  }
?>
     </body>
</html>
