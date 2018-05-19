<? include("protection.php"); ?>

<HTML>
<TITLE>Chránìná stránka</TITLE>
<BODY>

<FONT FACE="arial, helvetica" SIZE=2>Toto je chránìná stránka heslem!<BR>
<A HREF="page2.php">Pøechod na další chránìnou stránku</A><P>




<A HREF="<? echo $PHP_SELF ?>?action=logout">Odhlásit</A>

</FONT>
</BODY>
</HTML>