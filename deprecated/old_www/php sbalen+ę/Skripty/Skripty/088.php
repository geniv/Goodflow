<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>088.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
     </head>
     <body>
<!-- 088.php -->
<?
    $text=file("./text/soubor2.txt");    // načtení do pole
    echo "Obsah druhého řádku souboru:&nbsp;<b>\"".$text[1]."\"</b>";
?>
     </body>
</html>
