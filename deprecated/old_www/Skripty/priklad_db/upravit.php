<!-- upravit.php - na�ten� polo�ky pro �pravy, z�pis aktualizace provede
     skript aktualizovat.php -->

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
    <title>Upravit ot�zku</title>
    <link rel="stylesheet" href="styl.css">
    <SCRIPT language="javascript" SRC="./skripty/javascript/functions.js"></SCRIPT>
</head>

<body>
    <table width="100%">
    <tr>
      <td width="10%">
        <!-- Prvn� sloupec - pr�zdn� -->
      </td>  
      <td width="80%">
        <center><img src="./obr/aktualizace.gif"></center>
      </td>  
      <td width="10%"><b><h1 class="NADPIS">
        <SCRIPT LANGUAGE="JavaScript">
          document.write(dnes());
        </SCRIPT></h1></b>
      </td>
    </tr>  
    </table>
<?
   if(!$Edit):
?>
     <form action="upravit.php">
        <table frame="box" rules="none" border=2 cellpadding=7 align="center" bgcolor="#483D8B">
          <tr><th>&nbsp;<font color="#DDDDDD">��slo ot�zky:&nbsp;</font>
                  <input type=text size=5 name="Edit">
          </th></tr>        
          <tr><th>
                  <input type=submit value="         Potvrdit         ">
          </th></tr>
        </table>
     </form>
<? else:
     require "./otvdatab.php";
     $dotaz="SELECT * FROM Otazka WHERE ID_Otazka=".$Edit;
     @$vysledek = MySQL_Query($dotaz);  // na�ten� p��slu�n� polo�ky
     if(!$vysledek):
        echo "Zadan�mu krit�riu nevyhovuje ��dn� z�znam.\n";
     else:
        $zaznam = MySQL_Fetch_Array($vysledek);
     endif;
     MySQL_Close($spojeni);
?>
    <form action="aktualizovat.php" method="post">
      <table frame="box" rules="none" border=1 cellpadding=7 align="center" bgcolor="#483D8B">
      <tr><td><input type=submit value="   Aktualizuj   "></td></tr>
      </table>
      <br>
      <table frame="box" rules="none" border=2 cellpadding=7 align="center" bgcolor="#483D8B">
        <tr><th colspan=2>
          <fieldset>
          Identifika�n� ��slo:
          <input name="ID_Otazka" size=5 value="<? echo $zaznam["ID_Otazka"] ?>">
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          Spr�vn� odpov�� ��slo:<input name="Spravne" value="<? echo $zaznam["Spravne"] ?>" size=2>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          Skupina:<input name="Skupina" value="<? echo $zaznam["Skupina"] ?>" size=10>
          </fieldset>
        </th></tr>  
        <tr align="right"><th>Zn�n� ot�zky:</th><td><textarea name="Otazka"  rows=2 cols=60><? echo $zaznam["Otazka"] ?></textarea></td>
        </tr>
        <tr align="right"><th>Povinn� mo�nost odpov�di (1):</th><td><textarea bgcolor="#DDDDDD" name="OdpovedA" rows=2 cols=60 wrap="virtual"><? echo $zaznam["OdpovedA"] ?></textarea></td>
        </tr> 
        <tr align="right"><th>Povinn� mo�nost odpov�di (2):</th><td><textarea name="OdpovedB" rows=2 cols=60 wrap="virtual"><? echo $zaznam["OdpovedB"] ?></textarea></td>
        </tr>
        <tr align="right"><th>Nepovinn� mo�nost odpov�di (3):</th><td><textarea name="OdpovedC" rows=2 cols=60 wrap="virtual"><? echo $zaznam["OdpovedC"] ?></textarea></td>
        </tr>
        <tr align="right"><th>Nepovinn� mo�nost odpov�di (4):</th><td><textarea name="OdpovedD" rows=2 cols=60 wrap="virtual"><? echo $zaznam["OdpovedD"] ?></textarea></td>
        </tr>
        <tr align="right"><th>Nepovinn� mo�nost odpov�di (5):</th><td><textarea name="OdpovedE" rows=2 cols=60 wrap="virtual"><? echo $zaznam["OdpovedE"] ?></textarea></td>
        </tr> 
        <tr align="right"><th>Nepovinn� mo�nost odpov�di (6):</th><td><textarea name="OdpovedF" rows=2 cols=60 wrap="virtual"><? echo $zaznam["OdpovedF"] ?></textarea></td>
        </tr>
        <tr align="right"><th>Cesta k p�ipojen�mu zvuku:</th><td align="left"><input name="Zvuk" value="<? echo $zaznam["Zvuk"] ?>" size=60 disabled></td>
        </tr>
        <tr align="right"><th>Cesta k p�ipojen�mu obr�zku:</th><td align="left"><input name="Obrazek" value="<? echo $zaznam["Obrazek"] ?>" size=60 disabled></td>
        </tr>
      </table>
    </form>
<? endif; ?>

<? require "./address.php"; ?>

</body>
</html>
