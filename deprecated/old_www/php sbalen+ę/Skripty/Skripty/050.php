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
      echo "<b>Proveden� v�b�r</b><br><br>";
      echo "Prom�nn� \$Bazar1:&nbsp;".$Bazar1."<br>";
      echo "Prom�nn� \$Bazar2:&nbsp;".$Bazar2."<br>";
      if($Skryto!="-")
        echo "Prom�nn� \$Skryto:&nbsp;".$Skryto."<br><br>";
    }
  ?>
  </td></tr>
  <tr>
  <th>
<form>
  <!-- Seznam -->
  <select name="Bazar1" align="middle">
    <option>Felicie
    <option value="S120">�koda 120
    <option value="Ren">Renault 19
  </select>
  </th>
  <th>
  <!-- Seznam s vnit�n�m d�len�m na skupiny -->
  <select name="Bazar2" align="middle">
    <optgroup label="Dom�c�">
      <option value="Fel">Felicie
      <option value="S120" selected>�koda 120
    </optgroup>
    <optgroup label="Zahrani�n�">
      <option value="Ren">Renault 19
    </optgroup>
  </select>
  </th></tr>
  <tr><th colspan=2><br>
  <input type=submit value="Zobrazit aktu�ln� v�b�r">
  <input type=hidden name="Skryto" value=<? echo $Bazar1."-".$Bazar2; ?>>
  </th></tr>
</form>
  </table>
     </body>
</html>
