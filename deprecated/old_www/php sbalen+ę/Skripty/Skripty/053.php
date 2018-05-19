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
      echo "<center><font color=red>Doplňte, prosím, první povinnou odpověď!</center>";
?>

  <!-- formulář naformátovaný pomocí tabulky -->
  <form>
  <table align="center" rules="none" cellpadding=5 bgcolor="#0563A5">
    <tr><th colspan=4><font color="#80D3F6">Kontrola pivního režimu</font></th></tr>
    <tr><td colspan=3><b>Kolik vypijete za den půllitrů:&nbsp;</b></td>
        <td><input type=text name="mn_tekutin" size=20></td></tr>
    <tr>
        <td><b>Hustota :-):</b></td>
        <td><input type=radio name="hustota" value=1
                   <? if($hustota==1) echo "checked"; ?>>8°&lt;</td>
        <td><input type=radio name="hustota" value=8
                   <? if($hustota==8) echo "checked"; ?>>8°</td>
        <td><input type=radio name="hustota" value=10
                   <? if($hustota==10 || !$hustota) echo "checked"; ?>>10°</td></tr>
    <tr><td></td>
        <td><input type=radio name="hustota" value=11
                   <? if($hustota==11) echo "checked"; ?>>11°</td>
        <td><input type=radio name="hustota" value=12
                   <? if($hustota==12) echo "checked"; ?>>12°</td>
        <td><input type=radio name="hustota" value=100
                   <? if($hustota==100) echo "checked"; ?>>&gt;12°</td></tr>
    <tr><td colspan=4>
      <fieldset>
        <legend><b><font color="#D1DFF5">Doplňující údaje</font></b></legend>
        <b>&nbsp;Pohlaví:&nbsp;</b><input type=radio name="pohlavi" value="m" checked>Muž
                      <input type=radio name="pohlavi" value="z">Žena
                &nbsp;&nbsp;
        <b>Hmotnost:&nbsp;</b><input type=radio name="hmotnost" value="docent" checked>Docent
                      <input type=radio name="hmotnost" value="prescent">Přescent&nbsp;
      </fieldset>
      </td></tr>
    <tr><th colspan=4><input type=submit value="   Diagnóza   ">
    <input type=hidden name="Provedeno" value=1></th></tr>
  </table>
  </form>

<? else: ?>
   <basefont color="black">
<?
    echo "<b>";
    if($pohlavi=="m"){
      echo "Vážený pane ";
      if($hmotnost=="docent")
        echo "docente: ";
      else
        echo "přescente: ";
    }else{
      echo "Vážená paní ";
      if($hmotnost=="docent")
        echo "docentko: ";
      else
        echo "přescentko: ";
    }
    echo "</b>";

    if($hustota>8 && $mn_tekutin>0)
      echo "Hustota dostačující.&nbsp;";

    switch($mn_tekutin){
      case $mn_tekutin<0:
        echo "Zřejmě vás zaměstnává Vitana v sekci instantní pokrmy, že?";
        break;
      case $mn_tekutin==0:
        echo "Doufám, že pijete aspoň něco jiného...";
        break;
      case ($mn_tekutin>0 && $mn_tekutin<3):
        echo "No, jste-li dospělý, mělo by vám to prospívat.";
        break;
      case ($mn_tekutin>2 && $mn_tekutin<6):
        echo "B vitamíny tedy rozhodně nezanebáváte.";
        break;
      default:
        echo "Vy máte mezi předky vodníka, nebo spíš pivníka?";
    }
  endif;
?>
     </body>
</html>
