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
    echo("Soubor nelze otev��t!"); // o�et�en� chybn�ho otev�en�
  }else{
    fpassthru($ukazatel);          // na�te cel� soubor
  }
?>
     </body>
</html>
