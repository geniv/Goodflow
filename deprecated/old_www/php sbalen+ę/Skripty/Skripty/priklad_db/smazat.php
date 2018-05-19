<!-- smazat.php - načtení a potvrzení položky pro smazání, smazání provede skript
     vymaz.php -->

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
    <title>Smazání otázky</title>
    <link rel="stylesheet" href="styl.css">
    <SCRIPT language="javascript" SRC="./skripty/javascript/functions.js"></SCRIPT>
</head>

<body>
    <table width="100%"><tr>
      <td width="10%">
        <!-- První sloupec - prázdný -->
      </td>  
      <td width="80%">
        <center><img src="./obr/smazat.gif"></center>
      </td>  
      <td width="10%"><b><h1 class=NADPIS>
        <SCRIPT LANGUAGE="JavaScript">
          document.write(dnes());
        </SCRIPT></h1></b>
      </td>
      </tr>  
    </table>
<?
   if(!$Vymaz):
?>
     <form action="smazat.php">
        <table frame="box" rules="none" border=2 cellpadding=7 align="center" bgcolor="#483D8B">
          <tr><th>&nbsp;<font color="#DDDDDD">Číslo otázky:&nbsp;</font>
                  <input type=text size=5 name="Vymaz">
          </th></tr>        
          <tr><th><input type=submit value="         Potvrdit         "></th></tr>
        </table>
     </form>
<? else:
     require "./otvdatab.php";
     $dotaz="SELECT * FROM Otazka WHERE ID_Otazka=".$Vymaz;
     @$vysledek = MySQL_Query($dotaz);  // načtení příslušné položky
     if(!$vysledek):
        echo "Zadanému kritériu nevyhovuje žádný záznam.\n";
     else:
        $zaznam = MySQL_Fetch_Array($vysledek);
     endif;
     MySQL_Close($spojeni);
?>
    <form action="vymaz.php" method=post>
      <table frame="box" rules="none" border=1 cellpadding=7 align="center" bgcolor="#483D8B">
      <tr><td><input type=submit value="   Smazat otázku   ">
      </td></tr>
      </table>
      <br>
      <table frame="box" rules="none" border=2 cellpadding=7 align="center" bgcolor="#483D8B">
        <tr><th colspan=2>
          <fieldset>
            Identifikační číslo:
            <input name="ID_Otazka" size=5 value="<? echo $zaznam["ID_Otazka"] ?>">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            Správná odpověď číslo:
            <input name="Spravne" value="<? echo $zaznam["Spravne"] ?>" size=2>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            Skupina:<input name="Skupina" value="<? echo $zaznam["Skupina"] ?>" size=10>
          </fieldset>
        </th></tr>  
        <tr align="right"><th>Znění otázky:</th><td>
          <textarea name="Otazka"  rows=2 cols=60>
            <? echo $zaznam["Otazka"] ?>
          </textarea>
        </td></tr>  
        <tr align="right"><th>Povinná možnost odpovědi (1):</th><td>
          <textarea bgcolor="#DDDDDD" name="OdpovedA" rows=2 cols=60 wrap="virtual">
            <? echo $zaznam["OdpovedA"] ?>
          </textarea>
        </td></tr>  
        <tr align="right"><th>Povinná možnost odpovědi (2):</th><td>
          <textarea name="OdpovedB" rows=2 cols=60 wrap="virtual">
            <? echo $zaznam["OdpovedB"] ?>
          </textarea>
        </td></tr>  
        <tr align="right"><th>Nepovinná možnost odpovědi (3):</th><td>
          <textarea name="OdpovedC" rows=2 cols=60 wrap="virtual">
            <? echo $zaznam["OdpovedC"] ?>
          </textarea>
        </td></tr>  
        <tr align="right"><th>Nepovinná možnost odpovědi (4):</th><td>
          <textarea name="OdpovedD" rows=2 cols=60 wrap="virtual">
            <? echo $zaznam["OdpovedD"] ?>
          </textarea>
        </td></tr>  
        <tr align="right"><th>Nepovinná možnost odpovědi (5):</th><td>
          <textarea name="OdpovedE" rows=2 cols=60 wrap="virtual">
            <? echo $zaznam["OdpovedE"] ?>
          </textarea>
        </td></tr>  
        <tr align="right"><th>Nepovinná možnost odpovědi (6):</th><td>
          <textarea name="OdpovedF" rows=2 cols=60 wrap="virtual">
            <? echo $zaznam["OdpovedF"] ?>
          </textarea>
        </td></tr>  
        <tr align="right"><th>Připojený zvuk:</th><td align="left">
          <input name="Zvuk" value="<? echo $zaznam["Zvuk"] ?>" size=60>
        </td></tr>  
        <tr align="right"><th>Připojený obrázek:</th><td align="left">
          <input name="Obrazek" value="<? echo $zaznam["Obrazek"] ?>" size=60>
        </td></tr>  
      </table>
    </form>
<? endif; ?>

<? require "./address.php"; ?>

</body>
</html>
