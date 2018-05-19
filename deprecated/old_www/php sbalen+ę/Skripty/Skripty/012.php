<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>012.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
     </head>
     <body>
<!-- 012.php -->
<?
  // formátování výstupní tabulky
  $tabulka = "<table border=1>\n";
  $tabulka .="<tr><th>Záhlaví</th></tr>\n";
  $tabulka .="<tr><td>První řádek</td></tr>\n";
  $tabulka .="<tr><td>Druhý řádek</td></tr>\n";
  $tabulka .="<tr><td>Třetí řádek</td></tr>\n";
  $tabulka .="</table>\n";

  // vlastní výpis tabulky
  echo $tabulka;
?>
     </body>
</html>
