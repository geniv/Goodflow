<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>064.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
     </head>
     <body>
<!-- 064.php -->
<?
  // definice funkce Nadpis()
  function Nadpis($text,$barva,$velikost)
  {
    echo "<br>\n";
    echo "<center><font color=$barva size=$velikost>$text</font></center>\n";
    echo "<br>\n";
  }
?>
<?
  Nadpis("Text nadpisu","green","+3");
  Nadpis("Další nadpis","red","-1");
?>
     </body>
</html>
