<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>084.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
     </head>
     <body>
<!-- 084.php -->
<?
  if(!$ukazatel=fopen("./text/soubor.txt","r")){
    echo("Soubor nelze otevřít!"); // ošetření chybného otevření
  }else{
    fpassthru($ukazatel);          // načte celý soubor
  }
?>
     </body>
</html>
