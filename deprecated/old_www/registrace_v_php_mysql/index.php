<?
include("config.php");
$spojeni=mysql_connect($MySQL_server,$MySQL_user,$MySQL_user_password);
$spojenidb=mysql_select_db($MySQL_db);
if (!$spojeni)
{
echo"Nepodarilo se navazat spojeni se serverem.";
exit;
}

$prihlasen="";
if($co=="logout"){
MySQL_Query("UPDATE $MySQL_tabulka SET ip='' WHERE id='$id';");
$code="";
$error="<b>Nyní jste byl odhlášen.</b><br>Pokud budete chtít dále pokraèovat v režimu pro registrované, musíte se znova pøihlásit<br><br>";
}
if($nick!=""){
$bb = MySQL_Query("SELECT * FROM $MySQL_tabulka  WHERE nick='$nick';");
echo MySQL_Error();
$aa=MySQL_Fetch_Array($bb);

if(($aa[heslo]==$heslo) and ($heslo!="")){
$IP=$REMOTE_ADDR;
MySQL_Query("UPDATE $MySQL_tabulka  SET ip='$IP' WHERE nick='$nick';");
$time=time();
MySQL_Query("UPDATE $MySQL_tabulka  SET posledni_akce='$time' WHERE nick='$nick';");
$kod=MD5($time.$REMOTE_ADDR);
MySQL_Query("UPDATE $MySQL_tabulka  SET kod='$kod' WHERE nick='$nick';");
$url="id=".$aa[id]."&code=".$kod;
$prihlasen=$aa[id];
} else {$error="Pøihlášení se nepodaøilo. Špatné uživatelské jméno, nebo heslo.<br><br>";}
}

if($code!=""){
$bb = MySQL_Query("SELECT * FROM $MySQL_tabulka  WHERE id='$id';");
$aa=MySQL_Fetch_Array($bb);
$rozdil = time() - $aa[posledni_akce];
if($rozdil>300 or $rozdil<0) $povol="ne";
if(($aa[kod]==$code)and($aa[ip]==$REMOTE_ADDR) and ($povol=="")){
$time=time();
MySQL_Query("UPDATE $MySQL_tabulka  SET posledni_akce='$time' WHERE id='$id';");
$url="id=".$id."&code=".$code;
$prihlasen=$id;
} else {$str="";MySQL_Query("UPDATE $MySQL_tabulka  SET ip='' WHERE id='$id';"); $error="<b>Nejste pøihlášen</b><BR>Buï nesouhlasí IP, nebo se provedlo automatické odhlášení, kvùli neaktivitì delší než 5 minut. Pøihlaste se proto prosím znovu.<br><br>";}
}
?>
<!-- zacatek - nejaka stranka -->
<HTML>
<HEAD>
<META name="resource-type" content="document">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=windows-1250">
<META HTTP-EQUIV="pragma" CONTENT="no-cache">
<TITLE>Moje stranka</TITLE>
</HEAD>
<BODY>
<table>
<tr><TD width="150">
<!-- konec - nejaka stranka -->

<!-- zacatek - prihlasovaci okno/okno pro registrovane -->
<TABLE><tr><td align="center">
<?if($prihlasen==""){?>
<TABLE  width="165"><tr><td align="center">
<TABLE  width="100%"><tr><TD align="center" width="100%"><b>Login</b></table>
<table><FORM method="post" action="index.php">
<tr><td valign="top">&nbsp;<td valign="top">&nbsp;
<tr><td valign="top">Nick:<td valign="top"><INPUT type="text" name="nick" size="10">
<tr><TD valign="top">Heslo:<td valign="top" ><INPUT type="password" name="heslo" size="10">
<tr><th colspan="2"><INPUT type="submit" value="LOGIN">
<tr><th colspan="2"><a href="registrace.php"><FONT size="2">REGISTRACE</FONT></a>
</FORM>
</table></table>
<?}else{
$bb = MySQL_Query("SELECT * FROM $MySQL_tabulka WHERE id='$prihlasen';");
$aa=MySQL_Fetch_Array($bb);
$kredit=$aa[kredit];
echo'<TABLE width="165"><tr><td align="center">';
echo'<TABLE width="100%"><tr><TD align="center" width="100%"><b>Uživatel</b></table>';
echo "<table><tr><TD align=\"right\"><b>Pøihlášen:</b><td>$aa[jmeno]</table>";
echo "<A href=\"index.php?$url\">Hlavní strana</A><br>";
echo "<A href=\"neco.php?$url\">Nìco pro registrované</A><br>";
echo "<A href=\"index.php?co=logout&$url\">ODHLÁSIT</A>";
echo'</table>';

}
?>
</table>
<!-- konec - prihlasovaci okno/okno pro registrovane -->

<!-- zacatek - nejaka stranka -->
<TD width="*">
<?
// vypis chyb pri logoani do nejake stranky
echo $error;
?>

</body>
</html>
<!-- konec - nejaka stranka -->
<?MySQL_close();?>
