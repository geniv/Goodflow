<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>U08.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
          <basefont color="white">
     </head>
     <body>
  <!-- U08.php -->
  <?
    if(!$i){
      $i=1;
      $soucet = 0;
    }else{
      $soucet += $plat;
      $i++;
    }
  ?>
    <font color="black"><div align="center">
    <h2>Platy zam�stnanc�</h2>
  <?
    if($plat>40000){
      echo "<br>Po�et zam�stnanc� podniku: ".($i-1)."<br>\n";
      echo "M�s��n� na platech vyplaceno celkem: $soucet K�.<br>\n";
      echo "Pr�m�rn� plat v�ech zam�stnanc� podniku (cel� koruny): ".(int)($soucet/($i-1))." K�";

      // vynulov�n� pro dal�� v�po�et
      $plat=0;
      $i=1;
      $soucet=0;
    }
  ?>
    </div></font><br>

  <!-- formul�� naform�tovan� pomoc� tabulky -->
  <form>
  <table align="center" rules="none" cellpadding=5 bgcolor="#0563A5">
    <tr><th colspan=2>Zad�v�n� ukon��me platem �editele - v�t�� jak 40&nbsp;000 K�</th></tr>
    <tr><td>Zadej <? if($plat<=40000) echo $i; else echo "1"; ?>. plat (K�):&nbsp;</td>
        <td><input type=text name="plat" size=20></td></tr>
    <tr><th colspan=2><input type=submit value="V�po�et"></th></tr>
  </table>  
    <input type=hidden name="i" value="<? echo $i; ?>">
    <input type=hidden name="soucet" value="<? echo $soucet; ?>">
  </form>
     </body>
</html>
