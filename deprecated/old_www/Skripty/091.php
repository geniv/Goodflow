<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>091.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
     </head>
     <body>
<!-- 091.php -->
<?
  $jmeno="soubor.txt";
  if(copy("./text/".$jmeno, "./zaloha/".$jmeno))
    echo "Záložní kopie souboru <b>$jmeno</b> v pořádku vytvořena.";
  else
    echo "Nastala chyba při práci se soubory.";
?>
     </body>
</html>
