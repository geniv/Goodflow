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

//udaje registrovaných úèastníkù
$sb_hes="fsecky_udaja_ijsdvhishfoiqwporeioruiosjghjksgjhjkhjdhfjhdkjhsdhgrpouztrwtzuriredufzgthrdbfvgchxjcvjhbgffgdhjkmdssdewerdjuuurh.php";
$u=fopen($sb_hes,"r");
$udaj=explode("*-*-*",fread($u,1000000));
fclose($u);

//zjištìní èísla dle IP
if($pristp!=0)
{
$s_pucc="puc".$pristp."_sedikjvsezuiviuqwpkefjsiheufhvuhsgv.php";
$u=fopen($s_pucc,"r");
$cuuz=fread($u,100);
fclose($u);
}
else
{$cuuz=0;}

if($cuuz!=0)
{
  echo 
  "<b>Vítejte ".$udaj[$cuuz]."</b> na stránkách Geniv web's v chránìné sekci Škola.<br>
  Dobrý den ".$udaj[$cuuz+2].".";
  require "awetvetbfvkjasnmnrklvnfjsoijflsfnfiruhnykdmkcnfif.php";
}
else
{
 print "<br><br><br><br><br><br><br><br><h2 align=center>Bez hesla nemáte právo pro pøístup na tuto stránku!!</h2>";
}
?>
