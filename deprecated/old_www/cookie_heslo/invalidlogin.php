<HTML>
<TITLE>Login Page</TITLE>
<BODY>
<FONT FACE="arial, helvetica" SIZE=2>
<P><FONT COLOR="red"><B>�patn� u�. jm�no, nebo heslo!</B><BR>Pros�m zkuste znovu.</FONT></P>

<FORM METHOD=post ACTION="<? echo $PHP_SELF ?>?action=login">
<B>U�ivatelsk� jm�no:</B><BR>
<INPUT TYPE=text SIZE=30 NAME=loginname><BR>

<B>heslo:</B><BR>
<INPUT TYPE=password SIZE=30 NAME=password><BR>

<INPUT TYPE=submit VALUE="Login!">
</FORM>

</BODY>
</HTML>
