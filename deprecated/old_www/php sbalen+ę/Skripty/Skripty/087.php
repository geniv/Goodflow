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
    echo("Soubor nelze otevřít!");
  }else{
    $text=fread($ukazatel,1000);    // navracen celý (kratší) text
    echo "1)&nbsp;".$text."<br>";
    rewind($ukazatel);              // přesune ukazatel zpět na začátek souboru
    $text=fread($ukazatel,50);      // navráceno prvních 50 znaků
    echo "2)&nbsp;".$text;

    fclose($ukazatel);
  }
?>
</body>
</html>
