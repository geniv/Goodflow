<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>U14.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
          <basefont color="white">
     </head>
     <body>
  <!-- U14.php -->
  <!-- formulář naformátovaný pomocí tabulky -->
  <form>
  <table align="center" rules="none" cellpadding=5 bgcolor="#0563A5">
    <tr><th colspan=2>Zadání vstupních hodnot příkladu</th></tr>
    <tr><td>Zadání základ mocniny:&nbsp;</td>
        <td><input type=text name="prom_1" size=20></td></tr>
    <tr><td>Zadání stupeň mocniny:&nbsp;</td>
        <td><input type=text name="prom_2" size=20></td></tr>
    <tr><th colspan=2><input type=submit value="Výpočet"></th></tr>
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
      echo "<br><center>Požadovaná mocnina:&nbsp;$prom_1<sup>$prom_2</sup>&nbsp;=&nbsp;";
      echo Mocnina($prom_1,$prom_2)."</center>";
    }
    else{
      $prom_2=2;
      echo "<br><center>Požadovaná mocnina:&nbsp;$prom_1<sup>$prom_2</sup>&nbsp;=&nbsp;";
      echo Mocnina($prom_1)."</center>";
    }
  ?>
     </body>
</html>
