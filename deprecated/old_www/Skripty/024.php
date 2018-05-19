<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>024.php</title>
          <basefont color="white">
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
     </head>
     <body>
  <!-- 024.php -->
  <!-- formulář naformátovaný pomocí tabulky -->
  <form>  
    <table align="center" rules="none" cellpadding=5 bgcolor="#0563A5">
      <tr><th colspan=2>Zadání vstupní hodnoty</th></tr>
      <tr><td>Zadej číslo:&nbsp;</td>
          <td><input type=text name="prom_1" size=20></td></tr>
      <tr><th colspan=2><input type=submit value="Výpočet"></th></tr>
    </table>
  </form>
  <basefont color="black">
  <?
    // použití zanořené konstrukce if
    if ($prom_1!=0)
      if ($prom_1<0)
        echo "Číslo $prom_1 je záporné.";
      else
        echo "Číslo $prom_1 je kladné.";
    else
      echo "Číslo nebylo zatím zadáno
            nebo je rovno nule.";
  ?>
  <br>
  <?
    // použití konstrukce elseif
    if ($prom_1>0)
      echo "Číslo $prom_1 je kladné.";
    elseif ($prom_1<0)
      echo "Číslo $prom_1 je záporné.";
    else
      echo "Číslo nebylo zatím zadáno
            nebo je rovno nule.";
  ?>

     </body>
</html>
