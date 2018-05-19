<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>031.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
     </head>
     <body>
  <!-- 031.php -->
  <?
    $cislo=1;
    $mocnina=1;
    do{
      if($cislo==1)
        echo "Třetí mocniny přirozených čísel menších jak tisíc: ";
      else
        echo ",";
      echo " $mocnina";
      $cislo++;
      $mocnina = $cislo * $cislo * $cislo; // výpočet třetí mocniny
    }while($mocnina<1000);
  ?>
     </body>
</html>
