<?
if (!Empty($_COOKIE["R_jmeno"]) and !Empty($_COOKIE["R_heslo"]) and !Empty($_COOKIE["R_ID"]) and LogAdmin(".", $_COOKIE["R_jmeno"], $_COOKIE["R_heslo"], 0) == "true1" and LoginVzkazy(".", $_COOKIE["R_jmeno"], $_COOKIE["R_heslo"], $_COOKIE["R_ID"]) == "true1")
{
  echo
  "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\" height=\"10px\"></td>
  </tr>
  <tr>
    <td align=\"center\" class=\"sekce_nadpis\">Úvodní strana</td>
  </tr>
  <tr>
    <td align=\"center\" height=\"10px\"></td>
  </tr>
  <tr>
    <td align=\"center\" valign=\"center\" colspan=\"3\" height=\"20px\"><hr></td>
  </tr>
  <tr>
    <td align=\"center\" height=\"10px\"></td>
  </tr>
  <tr>
    <td align=\"center\" class=\"sekce_podnadpis\">Vítej {$_COOKIE["R_jmeno"]}</td>
  </tr>
  <tr>
    <td align=\"center\" height=\"10px\"></td>
  </tr>
  <tr>
    <td align=\"center\" class=\"sekce_text\">Tato úvodní strana Vás informuje o velikosti <u>stránek</u> a o velikosti složky <u>Upload</u>.</td>
  </tr>
  <tr>
    <td align=\"center\" height=\"10px\"></td>
  </tr>
  <tr>
    <td align=\"center\" class=\"sekce_text\">Jestli chcete přidat obrázky do sekcí <u>Fotografie</u> nebo <u>Akce</u>, tak musíte obrázky nahrát pomocí FTP manažera do složky <u>Upload</u>.</td>
  </tr>
  <tr>
    <td align=\"center\" height=\"10px\"></td>
  </tr>
  <tr>
    <td align=\"center\" class=\"sekce_text\">Velikost <u>stránek</u> je pro Vás podstatná, jelikož máte velikostní limit <u>150 MB</u></td>
  </tr>
  <tr>
    <td align=\"center\" height=\"10px\"></td>
  </tr>
  <tr>
    <td align=\"center\" class=\"sekce_text\">Kontrolujte hodnotu <u>Celková velikost stránek</u>, aby jste nepřekročily limit <u>150 MB</u></td>
  </tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\" height=\"20px\"></td>
  </tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"30%\">
  <tr>
    <td align=\"right\" class=\"sekce_podnadpis\">Celková&nbsp;velikost&nbsp;stránek:</td>
    <td align=\"center\">&nbsp;&nbsp;</td>
    <td align=\"left\" class=\"sekce_podnadpis\">".CelkovaVelikost()."</td>
  </tr>
  <tr>
    <td align=\"center\" height=\"10px\" colspan=\"3\"></td>
  </tr>
  <tr>
    <td align=\"right\" class=\"sekce_podnadpis\">Velikost&nbsp;složky&nbsp;Upload:</td>
    <td align=\"center\">&nbsp;&nbsp;</td>
    <td align=\"left\" class=\"sekce_podnadpis\">".velikost_adresare("../Upload", true)."</td>
  </tr>
  <tr>
    <td align=\"center\" height=\"10px\" colspan=\"3\"></td>
  </tr>
  <tr>
    <td align=\"right\" class=\"sekce_podnadpis\">Zbývá&nbsp;Vám&nbsp;využitelný&nbsp;prostor:</td>
    <td align=\"center\">&nbsp;&nbsp;</td>
    <td align=\"left\" class=\"sekce_podnadpis\">".ZbyvaVelikost()."</td>
  </tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\" height=\"40px\"></td>
  </tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\" class=\"sekce_text\"><font color=\"darkred\">V případě nefunkčností sekci, se nesmíte divit,
    tyto stránky byly vystavěny na systému PHP4.2.3 a nyní jsou používány na verzi PHP5.
    <br />
    <u>EDIT: Kompletni oprava funkce provedena!! Toto je jen docasne reseni, dokud se neuvede nova verze,
    ktera bude skytat mnohem vice moznosti.
    Tato verze poskytuje pouze vylepseni konfortu oproti minule verzi, z ktere je castecne upravena.</u>
    </font></td>
  </tr>
  <tr>
    <td align=\"center\" height=\"10px\"></td>
  </tr>
</table>

<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\" height=\"20px\"></td>
  </tr>
</table>";//".DostaveniDelkyOtvirani(".", "true")."
}
  else
{
  echo HlaskaVypadni(".");
}
?>
