<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>U12.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
     </head>
     <body>
  <!-- U12.php -->
  <?
     $platidla = array("5000","2000","1000","500","200","100","50","20","10","5","2","1");

     echo "<table frame=void align=center><tr><th colspan=3><h3>Použitá platidla</h3>";
     if($cislo>0):
       for($i=0;$i<12;$i++){
         $pocet=0;
         while($cislo>=$platidla[$i]){
           $cislo-=$platidla[$i];
           $pocet++;
         }
         if($pocet>0) // aspoň jedna bankovka (mince)
           echo "<tr><th><font color=red>$pocet</font><th>x<th>$platidla[$i]";
         else
           echo "<tr><th>$pocet<th>x<th>$platidla[$i]";
       }
     else:
       echo "<tr><th colspan=3>Není zadáno číslo k převodu!";
     endif;
     echo "</table>";
  ?>
  <br>

  <!-- formulář naformátovaný pomocí tabulky -->
  <form>
  <table align="center" rules="none" cellpadding=5 bgcolor="#0563A5">
    <tr><td><font color="white">Zadej přirozené číslo:</font>&nbsp;</td>
        <td><input type=text name="cislo" size=20></td></tr>
    <tr><th colspan=2><input type=submit value="Převod"></th></tr>
  </table>
  </form>
     </body>
</html>
