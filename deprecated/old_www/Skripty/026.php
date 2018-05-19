<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>026.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
          <basefont color="white">
     </head>
     <body>
  <!-- 026.php -->
  <!-- formulář naformátovaný pomocí tabulky -->
  <form>
  <table align="center" rules="none" cellpadding=5 bgcolor="#0563A5">
    <tr><th colspan=2>Výběr maxima ze tří hodnot</th></tr>
    <tr><td>Zadej první číslo:&nbsp;</td>
        <td><input type=text name="a" size=20 value="<? echo $a; ?>"></td></tr>
    <tr><td>Zadej druhé číslo:&nbsp;</td>
        <td><input type=text name="b" size=20 value="<? echo $b; ?>"></td></tr>
    <tr><td>Zadej třetí číslo:&nbsp;</td>
        <td><input type=text name="c" size=20 value="<? echo $c; ?>"></td></tr>
    <tr><th colspan=2><input type=submit value="Výpočet"></th></tr>
  </table>
  </form>
  <basefont color="black">
  <?
    if ($a > $b){        // vlastní algoritmus určení
      if ($a > $c){      // maximální hodnoty
        $max=$a;
      }else{
        $max=$c;
      }
    }else{
      if($b>$c){
        $max=$b;
      }else{
        $max=$c;
      }
    }
    // Výpis výsledku pouze při úplném zadání
    if($a && $b && $c)
      echo "<br><div align=center>Maximum z čísel $a, $b a $c je
            hodnota $max.</div>";
    else
      echo "<br><div align=center><font color=red>Zadání není úplné!
            Doplňte, prosím.</font></div>";
  ?>
     </body>
</html>
