<?
//DostaveniDelkyOtvirani("administrace", "false");
print
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
<td class=\"centralni_nadpis\">Vzkazy</td>
</tr>
</table>";

$cislo = $_GET["cislo"];
$akce = $_GET["akce"];
/*
print_r($HTTP_COOKIE_VARS);
print LoginVzkazy("administrace", $_COOKIE["R_jmeno"], $_COOKIE["R_heslo"], $_COOKIE["R_ID"]);
print LogAdmin("administrace", $_COOKIE["R_jmeno"], $_COOKIE["R_heslo"], 0);
*/
$blok = "false";
if (!Empty($_POST["jmeno"]) && !Empty($_POST["pass"]) && (LogAdmin("administrace", $_POST["jmeno"], $_POST["pass"], 0) == "true0" || LogAdmin("administrace", $_POST["jmeno"], $_POST["pass"], 0) == "true1"))
{
  print
  "<head>
   <meta http-equiv=\"refresh\" content=\"1;URL=index.php?kam=vzkazy\">
   </head>
   <br>
  <a href=\"index.php?kam=vzkazy\">".provadim_prihlasovani()."</a>";
  $blok = "true";
}

if (Empty($_POST["jmeno"]) && Empty($_POST["pass"]) and Empty($_COOKIE["R_ID"]))
{
print
"<br>
Zde mohou registrovaní uživatelé psát vzkazy.<br>
Pro soukromé dotazy na tým rybníku Balaton zasílejte na e-mail: <a href=\"mailto:rybarskabasta@centrum.cz\">rybarskabasta@centrum.cz</a><br>
Pokud nejste zaregistrováni, Vaše práva budou omezena jen pro čtení.<br>
Pro registraci <a href=\"index.php?kam=registrace\">klikněte zde</a>.
<br><br>

<form method=\"post\">
<table border=\"0\" align=\"center\" cellspacing=\"0\" cellpadding=\"0\">
<tr>
<td align=right>Uživatel:</td>
<td>&nbsp;</td>
<td><input type=\"text\" name=\"jmeno\" class=\"prechod_tabulka_input\"></td>
</tr>
<tr>
<td align=right>Heslo:</td>
<td>&nbsp;</td>
<td><input type=\"password\" name=\"pass\" class=\"prechod_tabulka_input\"></td>
</tr>
<tr>
<td colspan=\"3\" height=\"6px\"></td>
</tr>
<tr>
<td align=\"center\" colspan=\"3\"><input type=\"submit\" value=\"Přihlásit se\"></td>
</tr>
</table>
</form>";
}
  else
{
  if ((Empty($_POST["jmeno"]) or Empty($_POST["pass"])) and Empty($_COOKIE["R_ID"]))
  {
    print "<head>
  <meta http-equiv=\"refresh\" content=\"1;URL=index.php?kam=vzkazy\">
  </head>
   <br>
  <center><a href=\"index.php?kam=vzkazy\">".pristup_zamitnut()."</a></center>";
    $blok = "true";
  }
}

if (!Empty($_COOKIE["R_jmeno"]) and !Empty($_COOKIE["R_heslo"]) and !Empty($_COOKIE["R_ID"]) and (LoginVzkazy("administrace", $_COOKIE["R_jmeno"], $_COOKIE["R_heslo"], $_COOKIE["R_ID"]) == "true0" or LoginVzkazy("administrace", $_COOKIE["R_jmeno"], $_COOKIE["R_heslo"], $_COOKIE["R_ID"]) == "true1"))
{
  //if (!Empty($log))
  //{
  //  print $log;
  //}

  //print LoginVzkazy("administrace", $_COOKIE["R_jmeno"], $_COOKIE["R_heslo"], $_COOKIE["R_ID"]);

  if (!Empty($cislo) and !Empty($akce) and $akce == "uprav")
  {
    $tx[2] = VratHodnotuVzkazu("administrace", $cislo, 0);
    $tx[3] = "<input type=\"submit\" value=\"Upravit vzkaz\"><input type=\"hidden\" name=\"poslano\" value=\"true\">";
  }
    else
  {
    $tx[2] = ""; //text
    $tx[3] = "<input type=\"submit\" value=\"Přidat vzkaz\">";
  }

  print
  "<table border=\"0\" align=\"center\" cellspacing=\"0\" cellpadding=\"0\">
    <tr>
      <td align=\"center\" colspan=\"3\" height=\"20px\"></td>
    </tr>
    <tr>
      <td align=\"right\">Jste přihlášen:</td>
      <td>&nbsp;</td>
      <td align=\"left\">{$_COOKIE["R_jmeno"]}</td>
    </tr>
    <tr>
      <td colspan=\"3\" align=\"center\"><a href=\"index.php?kam=info&id={$_COOKIE["R_ID"]}\">Upravit mé kontaktní údaje</a></td>
    </tr>
    <tr>
      <td colspan=\"3\" align=\"center\"><a href=\"index.php?kam=vzkazy&akce=logoff\">Odhlásit se</a></td>
    </tr>
  </table>
  <form method=\"post\">
    <table border=\"0\" align=\"center\" cellspacing=\"0\" cellpadding=\"0\">
    <tr>
      <td align=\"center\" colspan=\"3\">Zde vložíte vzkaz:</td>
    </tr>
    <tr>
      <td align=\"center\" colspan=\"3\" height=\"6px\"></td>
    </tr>
    <tr>
      <td align=\"right\" valign=\"top\">Text vzkazu:</td>
      <td>&nbsp;</td>
      <td><textarea name=\"textik\" rows=\"6\" cols=\"40\">{$tx[2]}</textarea></td>
    </tr>
    <tr>
      <td align=\"center\" colspan=\"3\" height=\"6px\"></td>
    </tr>
  <tr>
  <td align=\"center\" colspan=\"3\">";
  if (Empty($_POST["textik"]))
  {
    print $tx[3];
  }
  print
  "</td>
  </tr>
  </table>
  </form>";

  if (!Empty($_POST["textik"]) && Empty($akce))
  {
    print PridejVzkaz("administrace", $_COOKIE["R_ID"], $_POST["textik"]);
  }

  if (!Empty($cislo) && !Empty($akce) && $akce == "uprav" && !Empty($_POST["poslano"]))
  {
    print UpravVzkaz("administrace", VratHodnotuVzkazu("administrace", $cislo, 2), $_POST["textik"], $cislo);
  }

/*
  if (!Empty($cislo) and !Empty($akce) and $akce == "smaz" and Empty($potvrzeni))
  {
    print
    "Opravdu chcete smazat příspěvek ze dne: <i>".VratHodnotuVzkazu("administrace", $cislo, 1)."</i> ?<br>
    <form method=\"post\">
    <input type=\"submit\" name=\"potvrzeni\" value=\"Ano\"> - <input type=\"submit\" name=\"potvrzeni\" value=\"Ne\">
    </form>";
  }
*/

  if (!Empty($cislo) && !Empty($akce) && $akce == "smaz" && !Empty($cislo))
  {
/*
    print
    "<head>
     <meta http-equiv=\"refresh\" content=\"1;URL=index.php?kam=vzkazy\">
     </head>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\">".nacitani_stranky()."</td>
  </tr>
</table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"100%\">
  <tr>
    <td align=\"center\" height=\"20px\"></td>
  </tr>
</table>";
*/

print SmazVzkaz("administrace", $_COOKIE["R_ID"], $cislo);
  }

  if (!Empty($potvrzeni) and $potvrzeni == "Ano")
  {
//    print SmazVzkaz("administrace", $_COOKIE["R_ID"], $cislo);
  }
}

if (!Empty($_COOKIE["R_jmeno"]) and !Empty($_COOKIE["R_heslo"]) and Empty($_COOKIE["R_ID"]) and Empty($jmeno))
{
  print "Špatné přihlášení!!";
  $blok = "true";
}

if (Empty($_COOKIE["R_ID"])){$_COOKIE["R_ID"] = "";}

print
"</td>
</tr>
</table>";
if ($blok == "false")
{
  echo VypisVzkazu("administrace", $_COOKIE["R_ID"]);
}




/*
<table border=\"1\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"600px\" borderColorDark=\"black\" borderColorLight=\"black\">
<tr><td>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"6\" align=\"center\" width=\"100%\">
<tr>
<td class=\"vzkazy_jmeno_email_uzivatel\">Milan</td>
<td align=\"right\" class=\"vzkazy_jmeno_email_uzivatel\">M.Prokes@seznam.cz</td>
</tr>
<tr>
<td colspan=\"2\" class=\"vzkazy_datum_cas_uzivatel\">1.Listopadu 2007&nbsp;&nbsp;&nbsp;13:51:02</td>
</tr>
<tr>
<td colspan=\"2\" class=\"vzkazy_text_uzivatel\">Ahoj kluci, byl jsem moc spokojený s úlovkem. Příště určit přijedem zase, mám jen dotaz, jestli bude možné rezervovat rybářskou povolenku pro 6 lidí na příští měsíc ?</td>
</tr>
</table>
</td>
</tr>
</table>
<hr>

<table border=\"1\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"600px\" borderColorDark=\"black\" borderColorLight=\"black\">
<tr><td>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"6\" align=\"center\" width=\"100%\">
<tr>
<td class=\"vzkazy_jmeno_email_admin\">Martin - Administrátor</td>
<td align=\"right\" class=\"vzkazy_jmeno_email_admin\">rybarskabasta@centrum.cz</td>
</tr>
<tr>
<td colspan=\"2\" class=\"vzkazy_datum_cas_admin\">2.Listopadu 2007&nbsp;&nbsp;&nbsp;16:36:01</td>
</tr>
<tr>
<td colspan=\"2\" class=\"vzkazy_text_admin\">Ahoj Milane, jsem moc rád, že se Vám tu líbilo. Co se týče povolenek, budou pro tebe rezervovány.</td>
</tr>
</table>
</td>
</tr>
</table>
<hr>


<table border=\"1\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"600px\" borderColorDark=\"black\" borderColorLight=\"black\">
<tr><td>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"6\" align=\"center\" width=\"100%\">
<tr>
<td class=\"vzkazy_jmeno_email_uzivatel\">Milan</td>
<td align=\"right\" class=\"vzkazy_jmeno_email_uzivatel\">M.Prokes@seznam.cz</td>
</tr>
<tr>
<td colspan=\"2\" class=\"vzkazy_datum_cas_uzivatel\">1.Listopadu 2007&nbsp;&nbsp;&nbsp;13:51:02</td>
</tr>
<tr>
<td colspan=\"2\" class=\"vzkazy_text_uzivatel\">Ahoj kluci, byl jsem moc spokojený s úlovkem. Příště určit přijedem zase, mám jen dotaz, jestli bude možné rezervovat rybářskou povolenku pro 6 lidí na příští měsíc ?</td>
</tr>
</table>
</td>
</tr>
</table>
<hr>

<table border=\"1\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" width=\"600px\" borderColorDark=\"black\" borderColorLight=\"black\">
<tr><td>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"6\" align=\"center\" width=\"100%\">
<tr>
<td class=\"vzkazy_jmeno_email_admin\">Martin - Administrátor</td>
<td align=\"right\" class=\"vzkazy_jmeno_email_admin\">rybarskabasta@centrum.cz</td>
</tr>
<tr>
<td colspan=\"2\" class=\"vzkazy_datum_cas_admin\">2.Listopadu 2007&nbsp;&nbsp;&nbsp;16:36:01</td>
</tr>
<tr>
<td colspan=\"2\" class=\"vzkazy_text_admin\">Ahoj Milane, jsem moc rád, že se Vám tu líbilo. Co se týče povolenek, budou pro tebe rezervovány.</td>
</tr>
</table>
</td>
</tr>
</table>
<hr>


*/
?>
