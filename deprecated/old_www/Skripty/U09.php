<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>U09.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
          <basefont color="white">
     </head>
     <body>
  <!-- U09.php -->
    <font color="black"><div align="center">
    <h2>Směnárna</h2>
  <?
    if(castka):
      switch($mena){
        case 1: $kurs=27; $mena="$"; break;
        case 2: $kurs=49; $mena="&pound;"; break;
        case 3: $kurs=33; $mena="€"; break;
        default: $kurs=0; echo "Není zvolen kurs.";
      }
      if($kurs>0):
        echo "$castka&nbsp;Kč&nbsp;=&nbsp;";
        printf("%10.2f",$castka/$kurs);
        echo "&nbsp;$mena.";
      endif;
    endif;
  ?>
    </div></font><br>

  <!-- formulář naformátovaný pomocí tabulky -->
  <form>
  <table align="center" rules="none" cellpadding=5 bgcolor="#0563A5">
    <tr><th colspan=2>Směnárna</th></tr>
    <tr><td>Zadej částku ke směně (Kč):&nbsp;</td>
        <td><input type=text name="castka" size=20></td></tr>
    <tr><td>Zadej měnu (americký dolar&nbsp;=&nbsp;1, libra&nbsp;=&nbsp;2, euro&nbsp;=&nbsp;3):&nbsp;</td>
        <td><input type=text name="mena" size=20></td></tr>
    <tr><th colspan=2><input type=submit value="Výpočet"></th></tr>
  </table>
  </form>
     </body>
</html>
