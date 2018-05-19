<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>U03.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
          <basefont color="white">
     </head>
     <body>
  <!-- U03.php -->
  // formulář naformátovaný pomocí tabulky
  <form>
  <table align="center" rules="none" cellpadding=5 bgcolor="#0563A5">
    <tr><th colspan=2>Zadání vstupních hodnot příkladu</th></tr>
    <tr><td>Zadání délky obdélníka:&nbsp;</td>
        <td><input type=text name="prom_1" size=20></td></tr>
    <tr><td>Zadání šířky obdélníka:&nbsp;</td>
        <td><input type=text name="prom_2" size=20></td></tr>
    <tr><th colspan=2><input type=submit value="Výpočet"></th></tr>
  </table>
  </form>
  <basefont color="black"><br><br>
  <?
     echo "Obdélník o délce $prom_1 a šířce $prom_2 má obsah "
          .$prom_1*$prom_2." jednotek čtverečních.";
  ?>
     </body>
</html>
