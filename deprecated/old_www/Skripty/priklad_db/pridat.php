<!-- pridat.php - slouží k získání údajů nové otázky, uložení do databáze provede
     skript vlozit.php -->
  <?
     require "./otvdatab.php";
     $dotaz="SELECT * FROM Otazka ORDER BY ID_Otazka DESC";
     @$vysledek = MySQL_Query($dotaz);                     // zjištění nového indexu
     if(!$vysledek):
       echo "Chyba při práce s databází<BR>";
       break;
     endif;

     if($zaznam=MySQL_Fetch_Array($vysledek))          // přečtení nového čísla
       $Cislo=$zaznam["ID_Otazka"]+1;
     else
       $Cislo=1;
     MySQL_Close($spojeni);
  ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
          <title>Přidání nové otázky</title>
          <link rel="stylesheet" href="styl.css">
          <SCRIPT language="javascript" SRC="./skripty/javascript/functions.js"></SCRIPT>
     </head>
<body>
    <table width="100%"><tr>
      <td width="10%">
        <!-- První sloupec - prázdný -->
      </td>  
      <td width="80%">
        <center><img src="./obr/pridani.gif"></center>
        <?echo "<h1 class=NADPIS>(Celkem otázek: ".MySQL_Num_Rows($vysledek).")</h1>";?>
      </td>  
      <td width="10%"><b><h1 class=NADPIS>
        <SCRIPT LANGUAGE="JavaScript">
          document.write(dnes());
        </SCRIPT></h1></b>
      </td></tr>  
    </table>
    <form action="vlozit.php" method="post" enctype="multipart/form-data">
      <table frame="box" rules="none" border=1 cellpadding=7 align="center" bgcolor="#483D8B">
      <tr><td><input type=submit value="   Uložit otázku   "></td></tr>
      </table>
      <br>
      <table frame="box" rules="none" border=2 cellpadding=7 align="center" bgcolor="#483D8B">
        <tr><th colspan=2>
          <fieldset>
          Identifikační číslo:<input name="ID_Otazka" size=5 value="<? echo $Cislo ?>">
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          Správná odpověď číslo:<input name="Spravne" size=2 value="1">
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          Skupina:<input name="Skupina" size=10 value="Nezařazeno">
          </fieldset>
        </th>  
        </tr>  
        <tr align="right"><th>Znění otázky:</th><td>
                        <textarea name="Otazka" rows=2 cols=60  wrap="virtual"></textarea>
        </td></tr>                
        <tr align="right"><th>Povinná možnost odpovědi (1):</th><td>
          <textarea bgcolor="#DDDDDD" name="OdpovedA" rows=2 cols=60 wrap="virtual"></textarea>
        </td>
        </tr>  
        <tr align="right"><th>Povinná možnost odpovědi (2):</th><td>
          <textarea name="OdpovedB" rows=2 cols=60 wrap="virtual"></textarea>
        </td>
        </tr>  
        <tr align="right"><th>Nepovinná možnost odpovědi (3):</th><td>
          <textarea name="OdpovedC" rows=2 cols=60 wrap="virtual"></textarea>
        </td>
        </tr>  
        <tr align="right"><th>Nepovinná možnost odpovědi (4):</th><td>
          <textarea name="OdpovedD" rows=2 cols=60 wrap="virtual"></textarea>
        </td>
        </tr>  
        <tr align="right"><th>Nepovinná možnost odpovědi (5):</th><td>
          <textarea name="OdpovedE" rows=2 cols=60 wrap="virtual"></textarea>
        </td>
        </tr>  
        <tr align="right"><th>Nepovinná možnost odpovědi (6):</th><td>
          <textarea name="OdpovedF" rows=2 cols=60 wrap="virtual"></textarea>
        </td>
        </tr>  
        <tr align="right"><th>Cesta k připojenému zvuku:</th><td align="left">
          <input type=file name="Zvuk" size=60 accept="image/*,text/plain">
        </td>
        </tr>  
        <tr align="right"><th>Cesta k připojenému obrázku:</th><td align=left>
          <input type=file name="Obrazek" size=60 accept="image/*,text/plain">
        </td>
        </tr>  
      </table>
    </form>

<? require "./address.php"; ?>

</body>
</html>
