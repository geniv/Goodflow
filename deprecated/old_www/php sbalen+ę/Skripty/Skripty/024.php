<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>024.php</title>
          <basefont color="white">
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
     </head>
     <body>
  <!-- 024.php -->
  <!-- formul�� naform�tovan� pomoc� tabulky -->
  <form>  
    <table align="center" rules="none" cellpadding=5 bgcolor="#0563A5">
      <tr><th colspan=2>Zad�n� vstupn� hodnoty</th></tr>
      <tr><td>Zadej ��slo:&nbsp;</td>
          <td><input type=text name="prom_1" size=20></td></tr>
      <tr><th colspan=2><input type=submit value="V�po�et"></th></tr>
    </table>
  </form>
  <basefont color="black">
  <?
    // pou�it� zano�en� konstrukce if
    if ($prom_1!=0)
      if ($prom_1<0)
        echo "��slo $prom_1 je z�porn�.";
      else
        echo "��slo $prom_1 je kladn�.";
    else
      echo "��slo nebylo zat�m zad�no
            nebo je rovno nule.";
  ?>
  <br>
  <?
    // pou�it� konstrukce elseif
    if ($prom_1>0)
      echo "��slo $prom_1 je kladn�.";
    elseif ($prom_1<0)
      echo "��slo $prom_1 je z�porn�.";
    else
      echo "��slo nebylo zat�m zad�no
            nebo je rovno nule.";
  ?>

     </body>
</html>
