<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>036.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
          <basefont color="black">
     </head>
     <body>
  <!-- 036.php -->
  <form>
  <table align="center" rules="none" cellpadding=5 bgcolor="#0563A5">
    <tr><th colspan=2>Zad�n� vstupn� hodnoty</th></tr>
    <tr><td>Zadej p�irozen� ��slo:&nbsp;</td>
        <td><input type=text name="prom_1" size=20></td></tr>
    <tr><th colspan=2><input type=submit value="V�po�et"></th></tr>
  </table>
  </form>
  <basefont color="black">
  <?
    // $prom_1 na�teno pomoc� formul��e
    $pokus=17;
    $prom_1=(int)$prom_1;
    while($prom_1>0):
      if($prom_1%$pokus==0):
        echo "Hledan� ��slo: $prom_1";
        break;
      endif;
      $prom_1++;
    endwhile;
  ?>
     </body>
</html>
