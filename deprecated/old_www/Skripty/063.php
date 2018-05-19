<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>063.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
     </head>
     <body>
<!-- 063.php -->
<?
  // definice funkce Nadpis()
  function Nadpis($text)
  {
    echo "<br>\n";
    echo "<center><font color=blue size=+2>$text</font></center>\n";
    echo "<br>\n";
  }
?>
<?
  Nadpis("Text nadpisu");
  for($i=0;$i<5;$i++)
    echo "Cokoliv<br>";
  Nadpis("Další nadpis");
?>
     </body>
</html>
