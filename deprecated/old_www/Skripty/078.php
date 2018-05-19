<? /*
     Vygeneruje číslo, které má pak uživatel uhodnout. Po každém pokusu napoví,
     jestli je hledané číslo větší nebo menší než náš pokus.
   */
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>078.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
     </head>
     <body>
  <!-- 078.php -->
  <center>
    <font color="#2603BD" size=+2>Hádání čísla</font><br><br>
  </center>
  <table width="80%" align="center">
    <b>Program vygeneroval číslo z rozsahu 1..100, které máte uhodnout. Vaší volbu zapište a
    program Vám bude napovídat, je-li hledané číslo větší či menší než Vaše volba...</b>
  </table><br>
  <table rules="none" align="center" cellpadding=5 bgcolor="#0563A5">
      <tr><th colspan=2>
        <font color="#DDDDDD">
          <? if($Hledane){
                if($Hledane>$CISLO)
                  echo "<font color=yellow>Zkus číslo větší.</font>";
                else if($Hledane<$CISLO)        // vynecháme případ "rovná se"
                  echo "<font color=yellow>Zkus menší číslo.</font>";
             }else{
                SRand((double)MicroTime()*1e6); // generování náhodné hodnoty
                $Hledane=Rand(1,100);
             }
          ?>
        </font>
      </th></tr>  
      <? if($Hledane==$CISLO):
           echo "<tr><th colspan=2><font color=yellow size=+1>Výborně, uhádl jste!</font></th></tr>";
           echo "<tr><th colspan=2><form><input type=submit value=\"Spustit znovu\"></form></th></tr>";
         else:
      ?>
      <form method="post">       
        <tr><th><font color="#DDDDDD">Zapište Vaši volbu, prosím:</font></th><td><input type=text size=10
                      name="CISLO" value="<? echo $CISLO; ?>"></td></tr>
        <tr><th colspan=2><font color="#DDDDDD"><input type=submit value="Zkus">
                                              <input type=hidden name="Hledane" value=<? echo $Hledane ?>>
                          </font></th></tr>
      </form>
      <? endif; ?>
  </table>
     </body>
</html>
