<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>026.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
          <basefont color="white">
     </head>
     <body>
  <!-- 026.php -->
  <!-- formul�� naform�tovan� pomoc� tabulky -->
  <form>
  <table align="center" rules="none" cellpadding=5 bgcolor="#0563A5">
    <tr><th colspan=2>V�b�r maxima ze t�� hodnot</th></tr>
    <tr><td>Zadej prvn� ��slo:&nbsp;</td>
        <td><input type=text name="a" size=20 value="<? echo $a; ?>"></td></tr>
    <tr><td>Zadej druh� ��slo:&nbsp;</td>
        <td><input type=text name="b" size=20 value="<? echo $b; ?>"></td></tr>
    <tr><td>Zadej t�et� ��slo:&nbsp;</td>
        <td><input type=text name="c" size=20 value="<? echo $c; ?>"></td></tr>
    <tr><th colspan=2><input type=submit value="V�po�et"></th></tr>
  </table>
  </form>
  <basefont color="black">
  <?
    if ($a > $b){        // vlastn� algoritmus ur�en�
      if ($a > $c){      // maxim�ln� hodnoty
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
    // V�pis v�sledku pouze p�i �pln�m zad�n�
    if($a && $b && $c)
      echo "<br><div align=center>Maximum z ��sel $a, $b a $c je
            hodnota $max.</div>";
    else
      echo "<br><div align=center><font color=red>Zad�n� nen� �pln�!
            Dopl�te, pros�m.</font></div>";
  ?>
     </body>
</html>
