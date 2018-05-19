<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>076.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
          <basefont color="white">
     </head>
     <body>
<!-- 076.php -->
<!-- formulář naformátovaný pomocí tabulky -->
  <form> 
  <table align="center" rules="none" cellpadding=5 bgcolor="#0563A5">
    <tr><th colspan=2>Výpočet mocniny</th></tr>
    <tr><td>Zadej základ mocniny:&nbsp;</td>
        <td><input type=text name="zaklad" size=5 <? echo "value=$zaklad";?>></td></tr>
    <tr><td>Zadej řád mocniny:&nbsp;</td>
        <td><input type=text name="rad" size=5 <? echo "value=$rad";?>></td></tr>
    <tr><th colspan=2><input type=submit value="Výpočet"></th></tr>
  </table>
  </form>
  <basefont color="black">
<?
   function Mocnina($zaklad,$rad){
     $vysledek=1;
     while($rad>0){
       $vysledek*=$zaklad;
       $rad--;
     }
     return $vysledek;
   }

   if($zaklad && $rad):
     echo "<div align=center>\n";
     echo "<br>$zaklad<sup>$rad</sup>&nbsp;=&nbsp;\n";
     echo Mocnina($zaklad,$rad)."</div>";
   endif;
?>
     </body>
</html>
