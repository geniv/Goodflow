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
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<?
$tit="";
if(!Empty($okd))
{
switch ($okd)
{
 case "uvod";
  {$tit="�vod";}
  break;
  
 case "programovani";
  {$tit="Programov�n�";}
  break;
  
 case "elektro";
  {$tit="Elektro";}
  break;
  
 case "zeleznice";
  {$tit="�eleznice";}
  break;
  
 case "kontakt";
  {$tit="Kontakt";}
  break;
  
 case "skola";
  {$tit="�kola";}
  break;
  
 case "navsteva";
  {$tit="N�v�t�vn� kniha";}
  break;
 }  //end switch
  } //end if
   else
 {
 $tit="�vod";
 }
echo "<title>Geniv web - $tit</title>\n";
//<div id=kry style="position:absolute; top:0px; left:0px; height:50px; background-color:white; z-index:25;"></div>
/*<SCRIPT LANGUAGE="javascript">
function vst()
{
var r=screen.width;
kry.style.width=r;
}
</SCRIPT>
 onload="vst();"
*/
?>
<META http-equiv="Content-Type" content="text/html; charset=windows-1250">
<style type="text/css">
#menu
{
position: absolute;
left: 0;
top: 100;
}
#lhs
{
height: 670;
width: 600;
background: CornflowerBlue;
position: absolute;
left: 200;
top: 100;
}
#vni
{
height: 670;
width: 600;
background: White;
position: absolute;
left: 0;
top: 0;
}
#ndp
{
height: 100;
width: 800;
background: White;
position: absolute;
top: 0;
left: 0;
z-index:30;
}
a
{
text-decoration:none;
}
</style>
</head>
<body>
<div id=ndp>
<center>
<img src="nadpis.gif">
</center>
</div>
<div id=lhs>
<div id=vni>
<?
if(!Empty($okd))
{
require $okd.".php";
require "konec.php";
}
else
{
require "uvod.php";
}
?>
</div>
</div>
<?
if(!Empty($okd)) 
{
$logs="Kliknuto na: <b>".$okd."</b> v: ".Date("H:i:s j.m. Y")." z IP: ".$REMOTE_ADDR."<br>\n";
$lg="log_chod_sdvjhshviuashfoiuashvoeifhqoeifhafoihjegoih.php";
$zaz=fopen($lg,"a+"); //bez ov��en� existence
fwrite($zaz,$logs);
fclose($zaz);
}

if(!Empty($logjm) and !Empty($loghe))
{
$lgo="P�ihla�ov�n�: <b>".$logjm."</b> s heslem: <b>".$loghe."</b> v: ".Date("H:i:s j.m. Y")." z IP: ".$REMOTE_ADDR."<br>\n";
$lgs="log_ost_eafzujgwusiuiiufhoqihagweggoiiheviusdvciweuefwe.php";
$ulg=fopen($lgs,"a+");
fwrite($ulg,$lgo);
fclose($ulg);
}
?>
