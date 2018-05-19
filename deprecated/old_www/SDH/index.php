<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
<title>Hasiči Mutěnice</title>
<link href="Files/layout.css" rel="stylesheet" type="text/css">
</head>
<body>
<table border=1 align=center valign=top>
<tr>
<td colspan=2><img src="Files/Images/horni.gif"></td>
</tr>
<tr>
<td valign=top>
<? include "menu.php"; ?>
</td>
<td valign=top>
<?
if(!Empty($kam))
{include "$kam.php";}
else
{include "hlavni.php";}

echo 
"</td>
</tr>
</table>";

include "spodek.php";

echo 
"</body>
</html>";
?>

<?
/*
		<div id="mBody">
			
			<div id="cLeft">

	padding-left: 2em; 

#mHeader
{
	margin-top: 10px;
	margin-left: 1px;
	margin-right: 1px;
	margin-bottom: 5px;
	height: 132px;
	background:url(Images/horni_01.gif);
	color: #ffff00;
}

id="mHeader"

<script src="embed.js"></script><script type="text/javascript" language="JavaScript">obj = new Object;obj.clockfile = "5007-red.swf";obj.TimeZone = "GMT0100";obj.width = 180;obj.height = 22;obj.wmode = "transparent";showClock(obj);</script>

#Content:	background: url(Images/black_01.gif);

#ContentHead: background: url(Images/red.gif);

#SideC:  background: url(Images/black.gif);

#CHeader:	background: url(Images/red.gif);

#CHeader2:	background: url(Images/red.gif);

*/ 
//$im = @imagecreate (50, 100)
//imagesetpixel(2,2,1);

/*
	<center>			<!-- BLUEBOARD POCITADLO -->
<script src="http://www.blueboard.cz/counter_0.php?id=185679" language="JavaScript" type="text/javascript"></script>
<!-- BLUEBOARD POCITADLO KONEC-->

<a href="http://www.toplist.cz/stat/294871"><script language="JavaScript" type="text/javascript">
<!--
document.write ('<img src="http://toplist.cz/dot.asp?id=294871&http='+escape(document.referrer)+'&wi='+escape(window.screen.width)+'&he='+escape(window.screen.height)+'&t='+escape(document.title)+'" width="1" height="1" border=0 alt="TOPlist" />'); 
//--></script><noscript><img src="http://toplist.cz/dot.asp?id=294871" border="0"
alt="TOPlist" width="1" height="1" /></noscript></a><br />

<!-- BLUEBOARD ONLINEMONITOR -->
<script src="http://www.blueboard.cz/omonitor.php?id=71081"  type="text/javascript" ></script>
<!-- BLUEBOARD ONLINEMONITOR KONEC--></center>
*/
?>				
