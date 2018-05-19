<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>032.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
          <basefont color="white">
     </head>
     <body>
    <!-- 032.php -->
    <? if(!$pocet){     // počáteční inicializace hodnot
         $pocet=0;
         $prom_1=0;
         $soucet=0;
       }
       echo "<font color=\"black\"><div align=center>\n";
       $soucet+=$prom_1;
       if($prom_1>=0)
         echo "Dosavadní součet: $soucet";
       else{                      // odečíst poslední hodnoty
         echo "Počet čísel: ".($pocet-1)."<br>\n";
         echo "Celkový součet: ".($soucet-$prom_1)."<br>\n";
         echo "Aritmetický průměr: ".(($soucet-$prom_1)/($pocet-1))."<br>\n";
         $pocet=0;
         $prom_1=0;
         $soucet=0;
       }
       echo "</div></font><br>\n";
    ?>
    <!-- formulář naformátovaný pomocí tabulky -->
    <form>
    <table align="center" rules="none" cellpadding=5 bgcolor="#0563A5">
      <tr><th colspan=2>Aritmetický průměr</th></tr>
      <tr><th colspan=2>(načítání ukončeno po vložení záporného čísla)</th></tr>
      <tr><td>Zadej <? echo ++$pocet.". "; ?>číslo:&nbsp;</td>
          <td><input type=text name="prom_1" size=20 value=<? echo $prom_1; ?>></td></tr>
      <tr><th colspan=2><input type=submit value="Započítej hodnotu"></th></tr>
    </table>
      <input type=hidden name="pocet" value=<? echo $pocet ?>>
      <input type=hidden name="soucet" value=<? echo $soucet ?>>
    </form>
     </body>
</html>
