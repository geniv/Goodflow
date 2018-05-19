<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>096.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
     </head>
     <body>
<!-- 096.php -->
<?
  $spojeni = MySQL_Connect("nejaky_server","uzivatel","heslo");
  MySQL_Select_DB("priklad_db");

  $dotaz = "SELECT * FROM Otazka";
  $vysledek = MySQL_Query($dotaz);
  while($zaznam = MySQL_Fetch_Array($vysledek)):
    // tělo cyklu
  endwhile;
?>
     </body>
</html>
