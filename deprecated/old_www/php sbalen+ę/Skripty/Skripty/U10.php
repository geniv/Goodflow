<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>U10.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
          <basefont color="white">
     </head>
     <body>
  <!-- U10.php -->
    <font color="black"><div align="center">
    <h2>Interval</h2>
  <?
    if($mez1>0 && $mez2>0 && $mez1<$mez2):
      echo "Hledan� sud� ��sla z rozsahu <$mez1,$mez2>: ";
      if($mez1%2==1) $mez1++;   // nastavit na sud� ��slo
      for($mez1;$mez1<=$mez2;){
        echo "$mez1, ";
        $mez1+=2;
      }
    else:
      echo "<font color=red>Chybn� zad�n� mez� intervalu!</font>";
    endif;
  ?>
    </div></font><br>

  <!-- formul�� naform�tovan� pomoc� tabulky -->
  <form>
  <table align="center" rules="none" cellpadding=5 bgcolor="#0563A5">
    <tr><th colspan=2>Interval</th></tr>
    <tr><td>Zadej doln� mez:&nbsp;</td>
        <td><input type=text name="mez1" size=20></td></tr>
    <tr><td>Zadej horn� mez:&nbsp;</td>
        <td><input type=text name="mez2" size=20></td></tr>
    <tr><th colspan=2><input type=submit value="V�po�et"></th></tr>
  </table>
  </form>
     </body>
</html>
