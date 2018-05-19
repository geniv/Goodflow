<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>U04.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
          <basefont color="white">
     </head>
     <body>
  <!-- U04.php -->
  // formulář naformátovaný pomocí tabulky
  <form>
  <table align="center" rules="none" cellpadding=5 bgcolor="#0563A5">
    <tr><th colspan=2>Zadání vstupních hodnot příkladu</th></tr>
    <tr><td>Zadání rychlosti v m/s:&nbsp;</td>
        <td><input type=text name="prom_1" size=20></td></tr>
    <tr><th colspan=2><input type=submit value="Výpočet"></th></tr>
  </table>
  </form>
  <basefont color="black"><br><br>
  <?
    if($prom_1>0) echo "$prom_1&nbsp;m/s je rovno ".($prom_1*3.6)."&nbsp;km/h.";
  ?>
     </body>
</html>
