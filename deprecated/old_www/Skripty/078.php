<? /*
     Vygeneruje ��slo, kter� m� pak u�ivatel uhodnout. Po ka�d�m pokusu napov�,
     jestli je hledan� ��slo v�t�� nebo men�� ne� n� pokus.
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
    <font color="#2603BD" size=+2>H�d�n� ��sla</font><br><br>
  </center>
  <table width="80%" align="center">
    <b>Program vygeneroval ��slo z rozsahu 1..100, kter� m�te uhodnout. Va�� volbu zapi�te a
    program V�m bude napov�dat, je-li hledan� ��slo v�t�� �i men�� ne� Va�e volba...</b>
  </table><br>
  <table rules="none" align="center" cellpadding=5 bgcolor="#0563A5">
      <tr><th colspan=2>
        <font color="#DDDDDD">
          <? if($Hledane){
                if($Hledane>$CISLO)
                  echo "<font color=yellow>Zkus ��slo v�t��.</font>";
                else if($Hledane<$CISLO)        // vynech�me p��pad "rovn� se"
                  echo "<font color=yellow>Zkus men�� ��slo.</font>";
             }else{
                SRand((double)MicroTime()*1e6); // generov�n� n�hodn� hodnoty
                $Hledane=Rand(1,100);
             }
          ?>
        </font>
      </th></tr>  
      <? if($Hledane==$CISLO):
           echo "<tr><th colspan=2><font color=yellow size=+1>V�born�, uh�dl jste!</font></th></tr>";
           echo "<tr><th colspan=2><form><input type=submit value=\"Spustit znovu\"></form></th></tr>";
         else:
      ?>
      <form method="post">       
        <tr><th><font color="#DDDDDD">Zapi�te Va�i volbu, pros�m:</font></th><td><input type=text size=10
                      name="CISLO" value="<? echo $CISLO; ?>"></td></tr>
        <tr><th colspan=2><font color="#DDDDDD"><input type=submit value="Zkus">
                                              <input type=hidden name="Hledane" value=<? echo $Hledane ?>>
                          </font></th></tr>
      </form>
      <? endif; ?>
  </table>
     </body>
</html>
