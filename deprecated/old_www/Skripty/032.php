<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>032.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
          <basefont color="white">
     </head>
     <body>
    <!-- 032.php -->
    <? if(!$pocet){     // po��te�n� inicializace hodnot
         $pocet=0;
         $prom_1=0;
         $soucet=0;
       }
       echo "<font color=\"black\"><div align=center>\n";
       $soucet+=$prom_1;
       if($prom_1>=0)
         echo "Dosavadn� sou�et: $soucet";
       else{                      // ode��st posledn� hodnoty
         echo "Po�et ��sel: ".($pocet-1)."<br>\n";
         echo "Celkov� sou�et: ".($soucet-$prom_1)."<br>\n";
         echo "Aritmetick� pr�m�r: ".(($soucet-$prom_1)/($pocet-1))."<br>\n";
         $pocet=0;
         $prom_1=0;
         $soucet=0;
       }
       echo "</div></font><br>\n";
    ?>
    <!-- formul�� naform�tovan� pomoc� tabulky -->
    <form>
    <table align="center" rules="none" cellpadding=5 bgcolor="#0563A5">
      <tr><th colspan=2>Aritmetick� pr�m�r</th></tr>
      <tr><th colspan=2>(na��t�n� ukon�eno po vlo�en� z�porn�ho ��sla)</th></tr>
      <tr><td>Zadej <? echo ++$pocet.". "; ?>��slo:&nbsp;</td>
          <td><input type=text name="prom_1" size=20 value=<? echo $prom_1; ?>></td></tr>
      <tr><th colspan=2><input type=submit value="Zapo��tej hodnotu"></th></tr>
    </table>
      <input type=hidden name="pocet" value=<? echo $pocet ?>>
      <input type=hidden name="soucet" value=<? echo $soucet ?>>
    </form>
     </body>
</html>
