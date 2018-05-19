<HTML>
<HEAD>
<META name="resource-type" content="document">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=windows-1250">
<META HTTP-EQUIV="pragma" CONTENT="no-cache">
<TITLE>Moje stranka - registrace</TITLE>
</HEAD>
<BODY>

<div align="center">
<FONT size="8">REGISTRACE</FONT>
<br><br><FONT color="RED" size="-2"><b>Povinné údaje jsou tučně červené</b></font>
</div>

<br>
<TABLE border="1" cellspacing="1" cellpadding="1" width="75%" align="center"><tr><TD align="center">
<?
include("config.php");
$spojeni=mysql_connect($MySQL_server,$MySQL_user,$MySQL_user_password);
$spojenidb=mysql_select_db($MySQL_db);
if (!$spojeni)
{
echo"Nepodarilo se navazat spojeni se serverem.";
exit;
}

$zob="ne";
if($odeslano=="ano"){

// test vyplnenych udaju
if($jmeno==""){
$zob="ano";
echo "<FONT color=\"FUCHSIA\"><b>Chyba: </b>Nebylo vyplňeno jméno</FONT><br>";
}

if($nick==""){
$zob="ano";
echo "<FONT color=\"FUCHSIA\"><b>Chyba: </b>Nebyl zvolen nick</FONT><br>";
}

if($heslo1==""){
$zob="ano";
echo "<FONT color=\"FUCHSIA\"><b>Chyba: </b>Zvol si heslo</FONT><br>";
}

if($heslo1!=$heslo2){
$zob="ano";
echo "<FONT color=\"FUCHSIA\"><b>Chyba: </b>Hesla nejsou stejná</FONT><br>";
}

if($mail=="" or $mail=="@"){
$zob="ano";
echo "<FONT color=\"FUCHSIA\"><b>Chyba: </b>Nebyl vyplněn e-mail</FONT><br>";
} 

@$bb = MySQL_Query("SELECT * FROM". $MySQL_tabulka . "WHERE nick='$nick';");
@$aa=MySQL_Fetch_Array($bb);
if($aa[id]!=""){
$zob="ano";
echo "<FONT color=\"FUCHSIA\"><b>Chyba: </b>Požadovaný nick již někdo používá. Zvolte si prosím jiný nick.</FONT><br>";
}

}else $zob="ano";


if($zob=="ano"){

?>
<br>
<TABLE align="center">
<tr>
<FORM method="post">
<?echo'<TD nowrap align="right"><FONT color="RED"><b>Jméno a Přijmení:</b></font><TD nowrap><INPUT type="text" name="jmeno" value="'.$jmeno.'" maxlength="30">';
echo'<tr>';
echo'<TD nowrap align="right"><FONT>Adresa:</font><TD nowrap><INPUT type="text" name="adresa" value="'.$adresa.'" maxlength="150">';
echo'<tr>';
echo'<TD nowrap align="right"><FONT color="RED"><b>Nick:</b></font><TD nowrap><INPUT type="text" name="nick" value="'.$nick.'" maxlength="20">';
echo'<tr>';
echo'<TD nowrap align="right"><FONT color="RED"><b>Heslo:</b></font><TD nowrap><INPUT type="password" name="heslo1" maxlength="25">';
echo'<tr>';
echo'<TD nowrap align="right"><FONT color="RED"><b>Opakuj heslo:</b></font><TD nowrap><INPUT type="password" name="heslo2" maxlength="25">';
echo'<tr>';
if($mail=="") $mail="@";
echo'<TD nowrap align="right"><FONT color="RED"><b>E-Mail:</b></font><TD nowrap><INPUT type="text" name="mail" value="'.$mail.'" maxlength="35">';
echo'<tr>';
if($mobil1=="") $mobil1="+420";
echo'<TD nowrap align="right"><FONT>Mobil:</font><TD nowrap><INPUT type="text" name="mobil1" value="'.$mobil1.'" size="4" maxlength="4"><INPUT type="text" name="mobil2" value="'.$mobil2.'" size="3" maxlength="3"><INPUT type="text" name="mobil3" size="6" maxlength="6" value="'.$mobil3.'">';
?>
<tr>
<th colspan="2">&nbsp;
<tr>
<th colspan="2"><INPUT type="submit" value=" R e g i s t r u j ">
<INPUT type="hidden" name="odeslano" value="ano">
</FORM>
</table><?}else{

MySQL_Query("INSERT INTO $MySQL_tabulka VALUES('','$jmeno','$adresa','$nick','$heslo1','$mail','$mobil1$mobil2$mobil3','','','0')");
echo MySQL_error();
echo"<FONT color=\"darkred\" size=\"+1\">Registrace dokončena</FONT>";
echo"<br><br>Poznamenejte si prosím Vámi zvolené uživatelské jméno a heslo na bezpečné místo(nejlépe zapamatovat). Pokud tyto 2 údaje zapomenete, nebudete moci se ke svému účtu přihlásit.";
echo"<br><br><br>Nyní se stačí v menu na <A href=\"index.php\">hlavní straně</A> přihlásit.";
}?></table>

</body>
</html>
<?MySQL_close();?>
