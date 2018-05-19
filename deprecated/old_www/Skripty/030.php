<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>030.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
          <basefont color="white">
     </head>
     <body>
    <!-- 030.php -->
    <!-- formulář naformátovaný pomocí tabulky -->
    <form>
    <table align="center" rules="none" cellpadding=5 bgcolor="#0563A5">
      <tr><th colspan=2>Euklidův algoritmus</th></tr>
      <tr><th colspan=2>(výpočet největšího společného dělitele)</th></tr>
      <tr><td>Zadej první celé kladné číslo:&nbsp;</td>
          <td><input type=text name="prom_1" size=20 value=<? echo $prom_1; ?>></td></tr>
      <tr><td>Zadej druhé celé kladné číslo:&nbsp;</td>
          <td><input type=text name="prom_2" size=20 value=<? echo $prom_2; ?>></td></tr>
      <tr><th colspan=2><input type=submit value="Výpočet"></th></tr>
    </table>
    </form>

    <basefont color="black">
    <div align="center">
  <?
    if($prom_1>0 && $prom_2>0){
      if($prom_1<=$prom_2){
        $pomocna = $prom_1;   // větší hodnota bude v $prom_1
        $prom_1 = $prom_2;
        $prom_2 = $pomocna;
      }
      $zal_prom_1 = $prom_1;  // záloha původních hodnot pro
      $zal_prom_2 = $prom_2;  // závěrečný výpis výsledku
      while($prom_1!=$prom_2){
        $rozdil = $prom_1 - $prom_2;
        $prom_1 = $rozdil;
        if($prom_1<=$prom_2){
          $pomocna = $prom_1; // opakovaná kontrola větší hodnoty
          $prom_1 = $prom_2;
          $prom_2 = $pomocna;
        }   // if
      }  // while
      echo "<font color=red>\n";
      echo "<br>Největší společný dělitel čísel $zal_prom_1 a $zal_prom_2 je číslo $prom_1.";
      echo "</font>";
    }else{
      if($prom_1)  // vyřadit první spuštění
        echo "Chybné zadání vstupních hodnot!";
    }
  ?>
    </div>
     </body>
</html>
