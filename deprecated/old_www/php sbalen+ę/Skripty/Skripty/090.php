<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>090.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
          <basefont color="white">
     </head>
     <body>
  <!-- 090.php -->
  <!-- formulář naformátovaný pomocí tabulky -->
  <form>
  <table align="center" rules="none" cellpadding=5 bgcolor="#0563A5">
    <tr><th colspan=2>Zadání nového jména</th></tr>
    <tr><td>Zadej jméno a příjmení:&nbsp;</td>
        <td><input type=text name="jmeno" size=40></td></tr>
    <tr><th colspan=2><input type=submit value="Zařadit do seznamu"></th></tr>
  </table>
  </form>
  <basefont color="black">
<?
    if($jmeno){
      $jmeno.="<br>";
      if(!$ukazatel=fopen("./text/jmena.txt","a")){
        echo("Soubor nelze otevřít!");
      }else{
        if(!@fwrite($ukazatel,$jmeno))
          echo("Chyba při zápisu do souboru!");
        else
          fclose($ukazatel);
      }
    }

    if(File_Exists("./text/jmena.txt")):
      echo "<br><center><b>Výpis již existujícího seznamu</b></center><br>";
      $text=file("./text/jmena.txt");    // načtení do pole
      while($polozka = Each($text)){
        echo "<center>".$polozka["value"]."</center><br>";
      }
    endif;
?>
     </body>
</html>
