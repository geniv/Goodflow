<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>085.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
     </head>
     <body>
<!-- 085.php -->
<?
  if(!$ukazatel=fopen("./text/soubor.txt","r")){
    echo("Soubor nelze otevřít!"); // ošetření chybného otevření
  }else{
    // používání souboru
    fclose($ukazatel);
  }
?>
     </body>
</html>
