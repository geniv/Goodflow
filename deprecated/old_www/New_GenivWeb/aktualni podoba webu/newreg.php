<?
$sou_ban="ban_weicuweiuvhoihnqpodwkjvnsjfnbvnqwiufehwiujefgvizuddkjsfh.php";
$u=fopen($sou_ban,"r");
$ban=explode("*--ban--*",fread($u,10000));
fclose($u);
for($p=0;$p<count($ban);$p++)
{
if($ban[$p]==$REMOTE_ADDR)
 { print "<br><br><br><br><br><h2 align=center>Na tyto stránky máte zákaz vstupu!!</h2>";
 exit;}
}
?>
<br><br><br><br><br>
<form method=post>
<table border=0 align=center>
<tr>
<td>Jméno:</td>
<td><input type=text name=regjmen>*</td>
</tr>
<tr>
<td>Email:</td>
<td><input type=text value="@" name=regem>*</td>
</tr>
<tr>
<td>Heslo:</td>
<td><input type=password name=reghes1>*</td>
</tr>
<tr>
<td>Kontrola hesla:</td> 
<td><input type=password name=reghes2>*</td>
</tr>

<tr>
<td>WWW stránky:</td>
<td><input type=text name=webs></td>
</tr>

<tr>
<td>ICQ:</td>
<td><input type=text name=icqs></td>
</tr>

<tr>
<th colspan=2><input type=submit value="Zaregistruj se...!"></th>
</tr>
</table>
</form>
<center>* =povinné udaje!!</center>
<?
if(!Empty($regjmen) and !Empty($reghes1) and !Empty($reghes2) and !Empty($regem))
{
if($reghes1<>$reghes2)
{
print "<h2 align=center>Špatné kontrolní heslo</h2>";
}
else
{
$uklhs="Zaregistroval se: <b>".$regjmen."</b>, s Emailem: <b>".$regem."</b> , s heslem: <b>".$reghes1."</b> , dále má: ".$webs." , ".$icqs." ,  z IP adresy: ".$REMOTE_ADDR." , v: ".Date("H:i:s j.m. Y")."<br>\n";
$novh="now_hes_esjkhfceisjfiuehfoihwoidhwdaqwfpojovijhrfvwevolj.php";
$uns=fopen($novh,"a+");
fwrite($uns,$uklhs);
fclose($uns);

$sb_hes="hes_sdcjaiuaiudfkkjdvoisdjvoisdjoisoisfoiassoiessdfsdfghsoihzfafoaiufauihcd.php";             
$u=fopen($sb_hes,"r");
$reg=explode("*---*",fread($u,10000));
fclose($u);
$noj=count($reg)+1;//dosazení pozice
$noh=count($reg)+2;
$reg[$noj]=$regjmen;//dosazení promìnných
$reg[$noh]=$reghes1;
$sb_hes="hes_sdcjaiuaiudfkkjdvoisdjvoisdjoisoisfoiassoiessdfsdfghsoihzfafoaiufauihcd.php";
$u=fopen($sb_hes,"w");
fwrite($u,implode($reg,"*---*"));
fclose($u);
print "<h2 align=center>Váš požadavek byl odeslán a zpracován. O registraci budete informováni e-mailem.</h2>";
mail($regem,"Potvrzení registrace","Jste zaregistrováni pod jménem: ".$regjmen."\nHeslem: ".$reghes1."\na Emailem: ".$regem);
mail("geniv@centrum.cz","Registrace klienta","Zaregistroval se klient: ".$regjmen." , \ns emailem: ".$regem."\ns heslem: ".$reghes1."\nv: ".Date("H:i:s j.m. Y")." \nz IP: ".$REMOTE_ADDR);
}//end if hes1=hes2
}//end empty
?>
