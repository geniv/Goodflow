<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>087.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
     </head>
     <body>
<!-- 087.php -->
<?
  if(!$ukazatel=fopen("./text/soubor2.txt","r")){
    echo("Soubor nelze otev��t!");
  }else{
    $text=fread($ukazatel,1000);    // navracen cel� (krat��) text
    echo "1)&nbsp;".$text."<br>";
    rewind($ukazatel);              // p�esune ukazatel zp�t na za��tek souboru
    $text=fread($ukazatel,50);      // navr�ceno prvn�ch 50 znak�
    echo "2)&nbsp;".$text;

    fclose($ukazatel);
  }
?>
</body>
</html>
