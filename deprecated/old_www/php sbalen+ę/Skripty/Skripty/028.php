<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>028.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
     </head>
     <body>
  <!-- 028.php -->
  <? $barva = $barva%4 + 0; ?>

  <div align=center>
    <h3>Zkuste chvíli "řídit křizovatku" přepínáním semaforu...</h3><br>
  </div>
  <hr>

  <table rules="none" align="center" cellpadding=5 bgcolor="silver">
    <tr><th>&nbsp;&nbsp;S&nbsp;E&nbsp;M&nbsp;A&nbsp;F&nbsp;O&nbsp;R&nbsp;&nbsp;</th></tr>
    <tr><th><table border=2 width="90%"
              bgcolor=<? if($barva==0) echo "RED"; else echo "GRAY"; ?>>
              <tr><td>&nbsp;</td></tr>
            </table>  
        </th>
    </tr>
    <tr><th><table border=2 width="90%"
              bgcolor=<? if($barva==1 || $barva==3) echo "#FA9300"; else echo "GRAY"; ?>>
              <tr><td>&nbsp;</td></tr>
            </table>  
        </th>
    </tr> 
    <tr><th><table border=2 width="90%" 
             bgcolor=<? if($barva==2) echo "GREEN"; else echo "GRAY"; ?>>
             <tr><td>&nbsp;</td></tr>
            </table>  
        </th>
    </tr>
  </table>
  <center>
    <form>
      <!-- Typ 'hidden' pro přenos proměnné barva -->
      <input type=hidden name="barva" value=<? echo ++$barva; ?>>
      <input type=submit value="Změnit barvu">
    </form>
  </center>
     </body>
</html>
