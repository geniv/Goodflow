<HTML>
<TITLE>Login Page</TITLE>
<BODY>
<FONT FACE="arial, helvetica" SIZE=2>
<P><FONT COLOR="red"><B>Špatné už. jméno, nebo heslo!</B><BR>Prosím zkuste znovu.</FONT></P>

<FORM METHOD=post ACTION="<? echo $PHP_SELF ?>?action=login">
<B>Uživatelské jméno:</B><BR>
<INPUT TYPE=text SIZE=30 NAME=loginname><BR>

<B>heslo:</B><BR>
<INPUT TYPE=password SIZE=30 NAME=password><BR>

<INPUT TYPE=submit VALUE="Login!">
</FORM>

</BODY>
</HTML>
