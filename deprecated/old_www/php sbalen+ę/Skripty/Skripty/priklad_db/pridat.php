<!-- pridat.php - slou�� k z�sk�n� �daj� nov� ot�zky, ulo�en� do datab�ze provede
     skript vlozit.php -->
  <?
     require "./otvdatab.php";
     $dotaz="SELECT * FROM Otazka ORDER BY ID_Otazka DESC";
     @$vysledek = MySQL_Query($dotaz);                     // zji�t�n� nov�ho indexu
     if(!$vysledek):
       echo "Chyba p�i pr�ce s datab�z�<BR>";
       break;
     endif;

     if($zaznam=MySQL_Fetch_Array($vysledek))          // p�e�ten� nov�ho ��sla
       $Cislo=$zaznam["ID_Otazka"]+1;
     else
       $Cislo=1;
     MySQL_Close($spojeni);
  ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
          <title>P�id�n� nov� ot�zky</title>
          <link rel="stylesheet" href="styl.css">
          <SCRIPT language="javascript" SRC="./skripty/javascript/functions.js"></SCRIPT>
     </head>
<body>
    <table width="100%"><tr>
      <td width="10%">
        <!-- Prvn� sloupec - pr�zdn� -->
      </td>  
      <td width="80%">
        <center><img src="./obr/pridani.gif"></center>
        <?echo "<h1 class=NADPIS>(Celkem ot�zek: ".MySQL_Num_Rows($vysledek).")</h1>";?>
      </td>  
      <td width="10%"><b><h1 class=NADPIS>
        <SCRIPT LANGUAGE="JavaScript">
          document.write(dnes());
        </SCRIPT></h1></b>
      </td></tr>  
    </table>
    <form action="vlozit.php" method="post" enctype="multipart/form-data">
      <table frame="box" rules="none" border=1 cellpadding=7 align="center" bgcolor="#483D8B">
      <tr><td><input type=submit value="   Ulo�it ot�zku   "></td></tr>
      </table>
      <br>
      <table frame="box" rules="none" border=2 cellpadding=7 align="center" bgcolor="#483D8B">
        <tr><th colspan=2>
          <fieldset>
          Identifika�n� ��slo:<input name="ID_Otazka" size=5 value="<? echo $Cislo ?>">
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          Spr�vn� odpov�� ��slo:<input name="Spravne" size=2 value="1">
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          Skupina:<input name="Skupina" size=10 value="Neza�azeno">
          </fieldset>
        </th>  
        </tr>  
        <tr align="right"><th>Zn�n� ot�zky:</th><td>
                        <textarea name="Otazka" rows=2 cols=60  wrap="virtual"></textarea>
        </td></tr>                
        <tr align="right"><th>Povinn� mo�nost odpov�di (1):</th><td>
          <textarea bgcolor="#DDDDDD" name="OdpovedA" rows=2 cols=60 wrap="virtual"></textarea>
        </td>
        </tr>  
        <tr align="right"><th>Povinn� mo�nost odpov�di (2):</th><td>
          <textarea name="OdpovedB" rows=2 cols=60 wrap="virtual"></textarea>
        </td>
        </tr>  
        <tr align="right"><th>Nepovinn� mo�nost odpov�di (3):</th><td>
          <textarea name="OdpovedC" rows=2 cols=60 wrap="virtual"></textarea>
        </td>
        </tr>  
        <tr align="right"><th>Nepovinn� mo�nost odpov�di (4):</th><td>
          <textarea name="OdpovedD" rows=2 cols=60 wrap="virtual"></textarea>
        </td>
        </tr>  
        <tr align="right"><th>Nepovinn� mo�nost odpov�di (5):</th><td>
          <textarea name="OdpovedE" rows=2 cols=60 wrap="virtual"></textarea>
        </td>
        </tr>  
        <tr align="right"><th>Nepovinn� mo�nost odpov�di (6):</th><td>
          <textarea name="OdpovedF" rows=2 cols=60 wrap="virtual"></textarea>
        </td>
        </tr>  
        <tr align="right"><th>Cesta k p�ipojen�mu zvuku:</th><td align="left">
          <input type=file name="Zvuk" size=60 accept="image/*,text/plain">
        </td>
        </tr>  
        <tr align="right"><th>Cesta k p�ipojen�mu obr�zku:</th><td align=left>
          <input type=file name="Obrazek" size=60 accept="image/*,text/plain">
        </td>
        </tr>  
      </table>
    </form>

<? require "./address.php"; ?>

</body>
</html>
