<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>U03.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
          <basefont color="white">
     </head>
     <body>
  <!-- U03.php -->
  // formul�� naform�tovan� pomoc� tabulky
  <form>
  <table align="center" rules="none" cellpadding=5 bgcolor="#0563A5">
    <tr><th colspan=2>Zad�n� vstupn�ch hodnot p��kladu</th></tr>
    <tr><td>Zad�n� d�lky obd�ln�ka:&nbsp;</td>
        <td><input type=text name="prom_1" size=20></td></tr>
    <tr><td>Zad�n� ���ky obd�ln�ka:&nbsp;</td>
        <td><input type=text name="prom_2" size=20></td></tr>
    <tr><th colspan=2><input type=submit value="V�po�et"></th></tr>
  </table>
  </form>
  <basefont color="black"><br><br>
  <?
     echo "Obd�ln�k o d�lce $prom_1 a ���ce $prom_2 m� obsah "
          .$prom_1*$prom_2." jednotek �tvere�n�ch.";
  ?>
     </body>
</html>
