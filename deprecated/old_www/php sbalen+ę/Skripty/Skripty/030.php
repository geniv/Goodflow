<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>030.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
          <basefont color="white">
     </head>
     <body>
    <!-- 030.php -->
    <!-- formul�� naform�tovan� pomoc� tabulky -->
    <form>
    <table align="center" rules="none" cellpadding=5 bgcolor="#0563A5">
      <tr><th colspan=2>Euklid�v algoritmus</th></tr>
      <tr><th colspan=2>(v�po�et nejv�t��ho spole�n�ho d�litele)</th></tr>
      <tr><td>Zadej prvn� cel� kladn� ��slo:&nbsp;</td>
          <td><input type=text name="prom_1" size=20 value=<? echo $prom_1; ?>></td></tr>
      <tr><td>Zadej druh� cel� kladn� ��slo:&nbsp;</td>
          <td><input type=text name="prom_2" size=20 value=<? echo $prom_2; ?>></td></tr>
      <tr><th colspan=2><input type=submit value="V�po�et"></th></tr>
    </table>
    </form>

    <basefont color="black">
    <div align="center">
  <?
    if($prom_1>0 && $prom_2>0){
      if($prom_1<=$prom_2){
        $pomocna = $prom_1;   // v�t�� hodnota bude v $prom_1
        $prom_1 = $prom_2;
        $prom_2 = $pomocna;
      }
      $zal_prom_1 = $prom_1;  // z�loha p�vodn�ch hodnot pro
      $zal_prom_2 = $prom_2;  // z�v�re�n� v�pis v�sledku
      while($prom_1!=$prom_2){
        $rozdil = $prom_1 - $prom_2;
        $prom_1 = $rozdil;
        if($prom_1<=$prom_2){
          $pomocna = $prom_1; // opakovan� kontrola v�t�� hodnoty
          $prom_1 = $prom_2;
          $prom_2 = $pomocna;
        }   // if
      }  // while
      echo "<font color=red>\n";
      echo "<br>Nejv�t�� spole�n� d�litel ��sel $zal_prom_1 a $zal_prom_2 je ��slo $prom_1.";
      echo "</font>";
    }else{
      if($prom_1)  // vy�adit prvn� spu�t�n�
        echo "Chybn� zad�n� vstupn�ch hodnot!";
    }
  ?>
    </div>
     </body>
</html>
