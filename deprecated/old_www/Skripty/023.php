<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>023.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
          <basefont color="white">
     </head>
     <body>
  <!-- 023.php -->
  <!-- formul�� naform�tovan� pomoc� tabulky -->
  <form>
    <table align="center" rules="none" cellpadding=5 bgcolor="#0563A5">
      <tr><th colspan=2>Zad�n� vstupn� hodnoty</th></tr>
      <tr><td>Zadej ��slo:&nbsp;</td>
          <td><input type=text name="prom_1" size=20></td>
      </tr>
      <tr><th colspan=2><input type=submit value="V�po�et"></th></tr>
    </table>
  </form>
  <basefont color="black">
  <?
            if ($prom_1){
              echo "V�po�et druh� mocniny<br>";
              echo "Druh� mocnina ��sla $prom_1 je ".($prom_1*$prom_1);
            }
  ?>
     </body>
</html>
