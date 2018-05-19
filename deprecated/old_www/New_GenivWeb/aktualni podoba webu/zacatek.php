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
  {$tit="Úvod";}
  break;
  
 case "programovani";
  {$tit="Programování";}
  break;
  
 case "elektro";
  {$tit="Elektro";}
  break;
  
 case "zeleznice";
  {$tit="Železnice";}
  break;
  
 case "kontakt";
  {$tit="Kontakt";}
  break;
  
 case "skola";
  {$tit="Škola";}
  break;
  
 case "navsteva";
  {$tit="Návštěvní kniha";}
  break;
 }  //end switch
  } //end if
   else
 {
 $tit="Úvod";
 }
echo "<title>Nový vzhled Geniv web's - $tit</title>\n";
?>
<META http-equiv="Content-Type"content="text/html; charset=windows-1250">
<SCRIPT LANGUAGE="javascript">
function vst()
{}
</SCRIPT>
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
height: 660;
width: 590;
background: White;
position: absolute;
left: 5;
top: 5;
}
#ndp
{
height: 100;
width: 800;
background: White;
position: absolute;
top: 0;
left: 0;
}
a
{
text-decoration:none;
}
</style>
</head>
<body onload="vst();"><? print "\n"; ?>
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
$zaz=fopen($lg,"a+"); //bez ověření existence
fwrite($zaz,$logs);
fclose($zaz);
}

if(!Empty($logjm) and !Empty($loghe))
{
$lgo="Přihlašování: <b>".$logjm."</b> s heslem: <b>".$loghe."</b> v: ".Date("H:i:s j.m. Y")." z IP: ".$REMOTE_ADDR."<br>\n";
$lgs="log_ost_eafzujgwusiuiiufhoqihagweggoiiheviusdvciweuefwe.php";
$ulg=fopen($lgs,"a+");
fwrite($ulg,$lgo);
fclose($ulg);
}
?>
