<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>037.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
          <basefont color="black">
     </head>
     <body>
  <!-- 037.php -->
  <form>
  <table align="center" rules="none" cellpadding=5 bgcolor="#0563A5">
    <tr><th colspan=2>Zadání vstupní hodnoty</th></tr>
    <tr><td>Zadej přirozené číslo:&nbsp;</td>
        <td><input type=text name="prom_1" size=20></td></tr>
    <tr><th colspan=2><input type=submit value="Výpočet"></th></tr>
  </table>
  </form>
  <basefont color="black">
  <?
    // $prom_1 načteno pomocí formuláře
    $pokus=17;
    $prom_1=(int)$prom_1;
    $poradi=1;
    while($prom_1>0):
      if($prom_1%$pokus==0):
        if($poradi<2):            // zajišťuje odskok v případě nálezu první
          $poradi++;              // hodnoty dělitelné 17
          $prom_1++;
          continue;               // přeskočen výpis echo
        endif;
        echo "Hledané číslo: $prom_1";
        break;
      endif;
      $prom_1++;
    endwhile;
  ?>
     </body>
</html>
