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
    Die("Ukon�en� b�hu skriptu po zad�n� z�porn� hodnoty.");
  else
    echo "<font color=blue><b>Pokra�ujeme</b></font>";
?>
  <form>
    <b>Pro ukon�en� skriptu zapi�te z�porn� ��slo</b><br><br>
    <input type=text name="hodnota"><br>
    <input type=submit value="Potvrdit">
  </form>
     </body>
</html>
