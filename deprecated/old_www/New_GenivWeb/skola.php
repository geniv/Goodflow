<?
$sou_ban="ban_weicuweiuvhoihnqpodwkjvnsjfnbvnqwiufehwiujefgvizuddkjsfh.php";
$u=fopen($sou_ban,"r");
$ban=explode("*--ban--*",fread($u,10000));
fclose($u);
for($p=0;$p<count($ban);$p++)
{
if($ban[$p]==$REMOTE_ADDR)
 { print "<br><br><br><br><br><h2 align=center>Na tyto str�nky m�te z�kaz vstupu!!</h2>";
 exit;}
}

//udaje registrovan�ch ��astn�k�
$sb_hes="fsecky_udaja_ijsdvhishfoiqwporeioruiosjghjksgjhjkhjdhfjhdkjhsdhgrpouztrwtzuriredufzgthrdbfvgchxjcvjhbgffgdhjkmdssdewerdjuuurh.php";
$u=fopen($sb_hes,"r");
$udaj=explode("*-*-*",fread($u,1000000));
fclose($u);

//zji�t�n� ��sla dle IP
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
  "<b>V�tejte ".$udaj[$cuuz]."</b> na str�nk�ch Geniv web's v chr�n�n� sekci �kola.<br>
  Dobr� den ".$udaj[$cuuz+2].".";
  require "awetvetbfvkjasnmnrklvnfjsoijflsfnfiruhnykdmkcnfif.php";
}
else
{
 print "<br><br><br><br><br><br><br><br><h2 align=center>Bez hesla nem�te pr�vo pro p��stup na tuto str�nku!!</h2>";
}
?>
