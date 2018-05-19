<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>050.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
          <basefont color="black">
     </head>
     <body>
  <!-- 050.php -->
  <table align="center"><tr><td colspan=2>
  <?
    if($Bazar1){
      echo "<b>Provedený výběr</b><br><br>";
      echo "Proměnná \$Bazar1:&nbsp;".$Bazar1."<br>";
      echo "Proměnná \$Bazar2:&nbsp;".$Bazar2."<br>";
      if($Skryto!="-")
        echo "Proměnná \$Skryto:&nbsp;".$Skryto."<br><br>";
    }
  ?>
  </td></tr>
  <tr>
  <th>
<form>
  <!-- Seznam -->
  <select name="Bazar1" align="middle">
    <option>Felicie
    <option value="S120">Škoda 120
    <option value="Ren">Renault 19
  </select>
  </th>
  <th>
  <!-- Seznam s vnitřním dělením na skupiny -->
  <select name="Bazar2" align="middle">
    <optgroup label="Domácí">
      <option value="Fel">Felicie
      <option value="S120" selected>Škoda 120
    </optgroup>
    <optgroup label="Zahraniční">
      <option value="Ren">Renault 19
    </optgroup>
  </select>
  </th></tr>
  <tr><th colspan=2><br>
  <input type=submit value="Zobrazit aktuální výběr">
  <input type=hidden name="Skryto" value=<? echo $Bazar1."-".$Bazar2; ?>>
  </th></tr>
</form>
  </table>
     </body>
</html>
