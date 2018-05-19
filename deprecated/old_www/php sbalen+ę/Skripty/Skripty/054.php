<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>054.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
     </head>
     <body>
<!-- 054.php -->
<?
  if($hodnota<0)
    Die("Ukončení běhu skriptu po zadání záporné hodnoty.");
  else
    echo "<font color=blue><b>Pokračujeme</b></font>";
?>
  <form>
    <b>Pro ukončení skriptu zapište záporné číslo</b><br><br>
    <input type=text name="hodnota"><br>
    <input type=submit value="Potvrdit">
  </form>
     </body>
</html>
