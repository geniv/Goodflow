<?
echo
"<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"740px\">
<tr>
<td height=\"10px\"></td>
</tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"600px\">
<tr>
<td align=\"center\">

<table border=\"0\" cellspacing=\"0\" cellpadding=\"6\" align=\"center\">
<tr>
<td class=\"centralni_nadpis\">Registrace</td>
</tr>
</table>
<br>
<u>Pokud chcete přidávat vzkazy či inzeráty, tak se zde prosím zaregistrujte.</u><br><br>
</td>
</tr>
</table>

<form method=\"post\">
<table border=\"0\" align=\"center\" cellspacing=\"0\" cellpadding=\"0\">
  <tr>
    <td align=right>Uživatel:</td>
    <td>&nbsp;</td>
    <td><input type=text name=\"jme\" class=\"prechod_tabulka_input\"></td>
  </tr>
  <tr>
    <td align=right>Heslo:</td>
    <td>&nbsp;</td>
    <td><input type=password name=\"hes\" class=\"prechod_tabulka_input\"></td>
  </tr>
  <tr>
    <td colspan=\"3\">&nbsp;</td>
  </tr>
  <tr>
    <td align=right>Jméno:</td>
    <td>&nbsp;</td>
    <td><input type=text name=\"jmeno\" class=\"prechod_tabulka_input\"></td>
  </tr>
    <td align=right>Příjmení:</td>
    <td>&nbsp;</td>
    <td><input type=text name=\"prijmeni\" class=\"prechod_tabulka_input\"></td>
  </tr>
    <td align=right>Bydliště:</td>
    <td>&nbsp;</td>
    <td><input type=text name=\"bydliste\" class=\"prechod_tabulka_input\"></td>
  </tr>
    <td align=right>E-mail:</td>
    <td>&nbsp;</td>
    <td><input type=text name=\"email\" value=\"@\" class=\"prechod_tabulka_input\"></td>
  </tr>
    <td align=right>Telefon:</td>
    <td>&nbsp;</td>
    <td><input type=text name=\"telefon\" class=\"prechod_tabulka_input\"></td>
  </tr>
    <td align=right>Mobil:</td>
    <td>&nbsp;</td>
    <td><input type=text name=\"mobil\" class=\"prechod_tabulka_input\"></td>
  </tr>
    <tr>
    <td colspan=\"3\">&nbsp;</td>
  </tr>
    <tr>
    <td align=\"center\" colspan=\"3\"><input type=\"submit\" value=\"Zaregistrovat\"></td>
  </tr>
</table>
</form>
<center>
<br>Všechny údaje jsou povinné.<br>Vypisujte je prosím pečlivě, kvůli pozdějšímu přidávání inzerátů a vzkazů.<br>
</center>";

if (!Empty($_POST["jme"]) && !Empty($_POST["hes"]) && !Empty($_POST["jmeno"]) && !Empty($_POST["prijmeni"]) && !Empty($_POST["bydliste"]) && !Empty($_POST["email"]) && !Empty($_POST["telefon"]) && !Empty($_POST["mobil"]))
{
  echo Registrace("administrace", $_POST["jme"], $_POST["hes"], $_POST["jmeno"], $_POST["prijmeni"], $_POST["bydliste"], $_POST["email"], $_POST["telefon"], $_POST["mobil"]);
}

/*
text PO - NE: 10.00 - 24.00 hod. se bude upravovat v adminu
jidelnicek: <a href=\"menu.doc\">Menu</a><br> se bude uploadovat a mazat !!!

borderColorDark=black borderColorLight=black style="border-left-color:black; border-bottom-color:black; border-top-color:black; border-right-color:black;"
*/
?>
