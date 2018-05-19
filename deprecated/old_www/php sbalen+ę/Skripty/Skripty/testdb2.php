<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>Provedení SQL příkazu</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
     </head>
<body bgcolor="#C6D8F4">
  <!-- testdb2.php -->
  <div align="center">
  <?
    $host="localhost"; $uziv=""; $heslo="";
    if(!mysql_connect($host,$uziv,$heslo))
      echo "Nelze vytvořit spojení s databází!!!";

    $vysledek=mysql_db_query($db,$dotaz);
    echo "<font color=navy size=+2>Výsledek dotazu</font><br>";
    echo "<b>".$dotaz."</b><hr width=40%>";

    if(!$vysledek):
      echo "<b>Nastala chyba při zpracování dotazu!</b>";
    elseif(!mysql_num_rows($vysledek)):
      echo "<b>Zadaný dotaz proveden...</b>";
    else:
      echo "<table style=\"color:white;\" rules=none cellpadding=5 bgcolor=\"#0563A5\">";
      for($i=0;$i<mysql_num_fields($vysledek);$i++)
        echo "<th>".mysql_field_name($vysledek,$i)."</th>";
      echo "</tr>";

      for($i=0;$i<mysql_num_rows($vysledek);$i++){
        echo "<tr>";
        $pole_radku=mysql_fetch_row($vysledek);
        for($j=0;$j<mysql_num_fields($vysledek);$j++)
          echo "<td>".$pole_radku[$j]."</td>";
        echo "</tr>";
      }
      echo "</table>";
    endif;
    mysql_close();
  ?>

  <br><hr width="40%"><br>
  <form action="testdb1.php" method="post">
    <input type=submit value="  Zadat další dotaz  ">
  </form>
  </div>
</body>
</html>
