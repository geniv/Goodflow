<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>U14.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
          <basefont color="white">
     </head>
     <body>
  <!-- U14.php -->
  <!-- formul�� naform�tovan� pomoc� tabulky -->
  <form>
  <table align="center" rules="none" cellpadding=5 bgcolor="#0563A5">
    <tr><th colspan=2>Zad�n� vstupn�ch hodnot p��kladu</th></tr>
    <tr><td>Zad�n� z�klad mocniny:&nbsp;</td>
        <td><input type=text name="prom_1" size=20></td></tr>
    <tr><td>Zad�n� stupe� mocniny:&nbsp;</td>
        <td><input type=text name="prom_2" size=20></td></tr>
    <tr><th colspan=2><input type=submit value="V�po�et"></th></tr>
  </table>
  </form>
  <basefont color="black">
  <?
    function Mocnina($zaklad,$stupen=2)
    {
      $vysledek=$zaklad;
      for($rad=1;$rad<$stupen;$rad++)
        $vysledek*=$zaklad;
      return $vysledek;
    }

    if($prom_2){
      echo "<br><center>Po�adovan� mocnina:&nbsp;$prom_1<sup>$prom_2</sup>&nbsp;=&nbsp;";
      echo Mocnina($prom_1,$prom_2)."</center>";
    }
    else{
      $prom_2=2;
      echo "<br><center>Po�adovan� mocnina:&nbsp;$prom_1<sup>$prom_2</sup>&nbsp;=&nbsp;";
      echo Mocnina($prom_1)."</center>";
    }
  ?>
     </body>
</html>
