<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>053.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
          <basefont color="white">
     </head>
     <body>
<!-- 053.php -->
<?
  if(!$mn_tekutin):
    if($Provedeno==1)
      echo "<center><font color=red>Dopl�te, pros�m, prvn� povinnou odpov��!</center>";
?>

  <!-- formul�� naform�tovan� pomoc� tabulky -->
  <form>
  <table align="center" rules="none" cellpadding=5 bgcolor="#0563A5">
    <tr><th colspan=4><font color="#80D3F6">Kontrola pivn�ho re�imu</font></th></tr>
    <tr><td colspan=3><b>Kolik vypijete za den p�llitr�:&nbsp;</b></td>
        <td><input type=text name="mn_tekutin" size=20></td></tr>
    <tr>
        <td><b>Hustota :-):</b></td>
        <td><input type=radio name="hustota" value=1
                   <? if($hustota==1) echo "checked"; ?>>8�&lt;</td>
        <td><input type=radio name="hustota" value=8
                   <? if($hustota==8) echo "checked"; ?>>8�</td>
        <td><input type=radio name="hustota" value=10
                   <? if($hustota==10 || !$hustota) echo "checked"; ?>>10�</td></tr>
    <tr><td></td>
        <td><input type=radio name="hustota" value=11
                   <? if($hustota==11) echo "checked"; ?>>11�</td>
        <td><input type=radio name="hustota" value=12
                   <? if($hustota==12) echo "checked"; ?>>12�</td>
        <td><input type=radio name="hustota" value=100
                   <? if($hustota==100) echo "checked"; ?>>&gt;12�</td></tr>
    <tr><td colspan=4>
      <fieldset>
        <legend><b><font color="#D1DFF5">Dopl�uj�c� �daje</font></b></legend>
        <b>&nbsp;Pohlav�:&nbsp;</b><input type=radio name="pohlavi" value="m" checked>Mu�
                      <input type=radio name="pohlavi" value="z">�ena
                &nbsp;&nbsp;
        <b>Hmotnost:&nbsp;</b><input type=radio name="hmotnost" value="docent" checked>Docent
                      <input type=radio name="hmotnost" value="prescent">P�escent&nbsp;
      </fieldset>
      </td></tr>
    <tr><th colspan=4><input type=submit value="   Diagn�za   ">
    <input type=hidden name="Provedeno" value=1></th></tr>
  </table>
  </form>

<? else: ?>
   <basefont color="black">
<?
    echo "<b>";
    if($pohlavi=="m"){
      echo "V�en� pane ";
      if($hmotnost=="docent")
        echo "docente: ";
      else
        echo "p�escente: ";
    }else{
      echo "V�en� pan� ";
      if($hmotnost=="docent")
        echo "docentko: ";
      else
        echo "p�escentko: ";
    }
    echo "</b>";

    if($hustota>8 && $mn_tekutin>0)
      echo "Hustota dosta�uj�c�.&nbsp;";

    switch($mn_tekutin){
      case $mn_tekutin<0:
        echo "Z�ejm� v�s zam�stn�v� Vitana v sekci instantn� pokrmy, �e?";
        break;
      case $mn_tekutin==0:
        echo "Douf�m, �e pijete aspo� n�co jin�ho...";
        break;
      case ($mn_tekutin>0 && $mn_tekutin<3):
        echo "No, jste-li dosp�l�, m�lo by v�m to prosp�vat.";
        break;
      case ($mn_tekutin>2 && $mn_tekutin<6):
        echo "B vitam�ny tedy rozhodn� nezaneb�v�te.";
        break;
      default:
        echo "Vy m�te mezi p�edky vodn�ka, nebo sp� pivn�ka?";
    }
  endif;
?>
     </body>
</html>
