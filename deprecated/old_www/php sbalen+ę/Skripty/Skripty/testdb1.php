<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>Test SQL příkazu</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
     </head>
     <body bgcolor="#C6D8F4">
<!-- testdb1.php -->
<div align="center">
<?
  $host="localhost"; $uziv=""; $heslo="";
?>
  <form action="testdb2.php" method="post">
    <font color="navy" size=+1>Zadejte databázi pro dotaz</font><br>
    <select name="db">
      <?
        mysql_connect($host,$uziv,$heslo);
        $db_jmeno=mysql_list_dbs();
        for($i=0;$i<mysql_num_rows($db_jmeno);$i++){
          $nazev=mysql_dbname($db_jmeno,$i);
          if($nazev=="test")
            echo "<option selected>".$nazev;
          else
            echo "<option>".$nazev;
        }
        mysql_close();
      ?>
    </select>
    <br><hr width="40%"><br>

    <font color="navy" size=+1>Zadejte dotaz SQL k provedení</font><br>
    <textarea name="dotaz" cols=50 rows=8></textarea>
    <br><br>
    <input type=submit value="  Zpracuj  ">
  </form>
</div>
     </body>
</html>
