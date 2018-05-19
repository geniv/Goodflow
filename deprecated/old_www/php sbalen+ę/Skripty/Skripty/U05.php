<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>U05.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
          <basefont color="white">
     </head>
     <body>
  <!-- U05.php -->
  // formulář naformátovaný pomocí tabulky
  <form>
  <table align="center" rules="none" cellpadding=5 bgcolor="#0563A5">
    <tr><th colspan=2>Zadání vstupních hodnot příkladu</th></tr>
    <tr><td>Zadej počáteční vklad (Kč):&nbsp;</td>
        <td><input type=text name="prom_1" size=20></td></tr>
    <tr><td>Zadej úrokovou míru (%):&nbsp;</td>
        <td><input type=text name="prom_2" size=20></td></tr>
    <tr><th colspan=2><input type=submit value="Výpočet"></th></tr>
  </table>
  </form>
  <basefont color="black"><br><br>
  <?
    if($prom_1>0){
      echo "Z počátečního vkladu $prom_1 Kč je po roce ".($prom_1*(1+$prom_2/100))." Kč.";
    }
  ?>
     </body>
</html>
