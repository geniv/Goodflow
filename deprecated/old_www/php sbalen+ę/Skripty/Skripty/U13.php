<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>U13.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
     </head>
     <body>
  <!-- U13.php -->
  <?
    $zal_cislo = $cislo;

    $cislo = (string) $cislo;
    $i=0;
    while($cislo[$i]!=""){
      $pole_cisel[$cislo[$i]]++;
      $i++;
    }

    echo "<br><div align=center><b>Počty cifer čísla $zal_cislo:&nbsp;</b><br>";
    for($i=0;$i<10;$i++){
      if($pole_cisel[$i]>0){
        echo  $pole_cisel[$i]."&nbsp;x&nbsp;$i&nbsp;&nbsp;&nbsp;";
      }
    }
    echo "</div>";
  ?>
  <br>

  <!-- formulář naformátovaný pomocí tabulky -->
  <form>
  <table align="center" rules="none" cellpadding=5 bgcolor="#0563A5">
    <tr><td><font color="white">Zadej číslo:</font>&nbsp;</td>
        <td><input type=text name="cislo" size=20></td></tr>
    <tr><th colspan=2><input type=submit value="Výpočet"></th></tr>
  </table>
  </form>
     </body>
</html>
