<HTML>
<TITLE>Login Page</TITLE>
<BODY>
<FONT FACE="arial, helvetica" SIZE=2>
<FORM METHOD=post ACTION="<? echo $PHP_SELF ?>?action=login">
<B>Uživatelské jméno:</B><BR>
<INPUT TYPE=text SIZE=30 NAME=loginname><BR>

<B>Heslo:</B><BR>
<INPUT TYPE=password SIZE=30 NAME=password><BR>
<? if (substr($PHP_SELF,-9) == "login.php") { echo "<P>Nelze zobrazit soubor, soubor je chránìný heslem!</P>"; } else { echo "<INPUT TYPE=submit VALUE=\"Login!\">"; } ?>
</FORM>
<em>pro test je uz. jmeno: "Jan" a heslo: "Novak"</em>
</BODY>
</HTML>
