<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>U16.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
          <basefont color="white">
     </head>
     <body>
  <!-- U16.php -->
  <!-- formulář naformátovaný pomocí tabulky -->
  <form>
  <table align="center" rules="none" cellpadding=5 bgcolor="#0563A5">
    <tr><th colspan=2>Výpočet faktoriálu</th></tr>
    <tr><td>Zadej přirozené číslo:&nbsp;</td>
        <td><input type=text name="hodnota" size=20></td></tr>
    <tr><th colspan=2><input type=submit value="Výpočet"></th></tr>
  </table>
  </form>
  <basefont color="black">
  <?
    function Faktorial($fakt)
    {
      if($fakt>0) return Faktorial($fakt-1)*$fakt;
      return 1;
    }

    if($hodnota>=0){
      $hodnota=(int)$hodnota;
      $vysledek=Faktorial($hodnota);
      echo "<br><center><b>$hodnota!&nbsp;=&nbsp;$vysledek</b></center>";
    }else{
      echo "<br><center><b>Zadej celé kladné číslo!</b></center>";
    }
  ?>
     </body>
</html>
