<HTML>
<TITLE>Login Page</TITLE>
<BODY>
<FONT FACE="arial, helvetica" SIZE=2>
<FORM METHOD=post ACTION="<? echo $PHP_SELF ?>?action=login">
<B>U�ivatelsk� jm�no:</B><BR>
<INPUT TYPE=text SIZE=30 NAME=loginname><BR>

<B>Heslo:</B><BR>
<INPUT TYPE=password SIZE=30 NAME=password><BR>
<? if (substr($PHP_SELF,-9) == "login.php") { echo "<P>Nelze zobrazit soubor, soubor je chr�n�n� heslem!</P>"; } else { echo "<INPUT TYPE=submit VALUE=\"Login!\">"; } ?>
</FORM>
<em>pro test je uz. jmeno: "Jan" a heslo: "Novak"</em>
</BODY>
</HTML>
