<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>090.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
          <basefont color="white">
     </head>
     <body>
  <!-- 090.php -->
  <!-- formul�� naform�tovan� pomoc� tabulky -->
  <form>
  <table align="center" rules="none" cellpadding=5 bgcolor="#0563A5">
    <tr><th colspan=2>Zad�n� nov�ho jm�na</th></tr>
    <tr><td>Zadej jm�no a p��jmen�:&nbsp;</td>
        <td><input type=text name="jmeno" size=40></td></tr>
    <tr><th colspan=2><input type=submit value="Za�adit do seznamu"></th></tr>
  </table>
  </form>
  <basefont color="black">
<?
    if($jmeno){
      $jmeno.="<br>";
      if(!$ukazatel=fopen("./text/jmena.txt","a")){
        echo("Soubor nelze otev��t!");
      }else{
        if(!@fwrite($ukazatel,$jmeno))
          echo("Chyba p�i z�pisu do souboru!");
        else
          fclose($ukazatel);
      }
    }

    if(File_Exists("./text/jmena.txt")):
      echo "<br><center><b>V�pis ji� existuj�c�ho seznamu</b></center><br>";
      $text=file("./text/jmena.txt");    // na�ten� do pole
      while($polozka = Each($text)){
        echo "<center>".$polozka["value"]."</center><br>";
      }
    endif;
?>
     </body>
</html>
