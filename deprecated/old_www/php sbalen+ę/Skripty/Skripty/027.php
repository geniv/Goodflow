<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>027.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
     </head>
     <body>
  <!-- 027.php -->
  <!-- formulář naformátovaný pomocí tabulky -->
  <form>
  <table align="center" rules="none" cellpadding=5 bgcolor="#0563A5">
    <tr><th colspan=2>Taxametr drožkaře</th></tr>
    <tr><td>Zadej ujetou vzdálenost (km):&nbsp;</td>
        <td><input type=text name="vzdalenost" size=20 value="<? echo $vzdalenost; ?>"></td></tr>
    <tr><th colspan=2><input type=submit value="Výpočet"></th></tr>
  </table>
  </form>
  <basefont color="black">
  <?
    switch ($vzdalenost){
      case ($vzdalenost>0 && $vzdalenost<=3): $taxa = 100;
                                             break;
      case ($vzdalenost>3 && $vzdalenost<=6): $taxa = 80;
                                             break;
      case ($vzdalenost>6 && $vzdalenost<=10): $taxa = 70;
                                             break;
      default: $taxa = 60;
    }
    if($vzdalenost){
      echo "<br><div align = center>Vytisknuto: ".Date("H:i:s")."<br><br>";
      echo "Celková vzdálenost: $vzdalenost km<br>";
      echo "Cena jízdy: ".($vzdalenost*$taxa)." Kč</div>";
    }
  ?>
     </body>
</html>
