<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>065.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
     </head>
     <body>
<!-- 065.php -->
<?
  function Nadpis($text="M�sto pro nadpis",$barva="blue",$velikost="+2")
  {
    echo "<br>\n";
    echo "<center><font color=$barva size=$velikost>$text</font></center>\n";
    echo "<br>\n";
  }
?>
<?
  Nadpis();
  Nadpis("Dal�� nadpis");
  Nadpis("Dal�� nadpis","red");
  Nadpis("Dal�� nadpis","red","-2");
?>
     </body>
</html>
