<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>U07.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
          <basefont color="white">
     </head>
     <body>
  <!-- U07.php -->
  // formul�� naform�tovan� pomoc� tabulky
  <form>
  <table align="center" rules="none" cellpadding=5 bgcolor="#0563A5">
    <tr><th colspan=2>Zad�n� vstupn�ch hodnot p��kladu</th></tr>
    <tr><td>Zadej cenu zbo�� bez DPH (K�):&nbsp;</td>
        <td><input type=text name="prom_1" size=20></td></tr>
    <tr><th colspan=2><input type=submit value="V�po�et"></th></tr>
  </table>
  </form>
  <basefont color="black"><br><br>
  <?
    if($prom_1>0){
      echo "Cena zbo�� bez DPH: $prom_1 K�";
      echo "<br>Cena zbo�� s 5&nbsp;% DPH je ".($prom_1*1.05)." K�.";
      echo "<br>Cena zbo�� s 19&nbsp;% DPH je ".($prom_1*1.19)." K�.";
    }
  ?>
     </body>
</html>
