<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>089.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
     </head>
     <body>
<!-- 089.php -->
<?
  if(!$ukazatel=fopen("./text/soubor3.txt","r")){
    echo("Soubor nelze otev��t!");
  }else{
    $text=fread($ukazatel,100);
    echo "<b>Origin�ln� interpretovan� obsah:</b>&nbsp;".$text."<br>";
    rewind($ukazatel);              // zp�t na za��tek souboru
    $text=fgetss($ukazatel,100);
    echo "<b>Vy�ezan� zna�kov�n� textu:</b>&nbsp;".$text;
    fclose($ukazatel);
  }
?>
     </body>
</html>
