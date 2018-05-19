<!--WZ-REKLAMA-1.0IZ--><div align="center"><table width="496" border="0"
cellspacing="0" cellpadding="0"><tr><td><a href="http://www.webzdarma.cz/"><img
src="http://i.wz.cz/banner/nudle03.gif" width="28" height="60" 
style="margin: 0; padding: 0; border-width: 0" alt="WebZdarma.cz" /></a></td><td>
<script type="text/javascript">
<!-- /* (c) 2001 AdCycle.com All Rights Reserved.*/ 
var id=494; var jar=new Date();var s=jar.getSeconds();var m=jar.getMinutes();
var flash=s*m+id;var cgi='http://ad.wz.cz';
var p='<iframe src="'+cgi+'/ad.cgi?gid=30&amp;t=_top&amp;id='+flash+'&amp;type=iframe" ';
p+='height="60" width="468" border="0" marginwidth="0" marginheight="0" hspace="0" ';
p+='vspace="0" frameborder="0" scrolling="no">';
p+='<a href="'+cgi+'/click.cgi?gid=30&amp;id='+flash+'" target="_top">';
p+='<img src="'+cgi+'/ad.cgi?gid=30&amp;id='+flash+'" width="468" height="60" ';
p+='border="0" alt="Klikni" /></'+'a></'+'ifra'+'me>'; document.write(p); // -->
</script><noscript><div><a href="http://ad.wz.cz/click.cgi?gid=30&amp;id=494"><img
src="http://ad.wz.cz/ad.cgi?gid=30&amp;id=494"
width="468" height="60" style="margin: 0; padding: 0; border-width: 0" alt="Klikni" /></a></div></noscript>
</td></tr></table></div>
<!--WZ-REKLAMA-1.0IK--><?
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
<title>Nový vzhled Geniv web's - Vstup</title>
</head>
<br><br><br><br><br>
<br><br><br><br><br>
<center>
<form>
<input type=button value="Vstupte prosím dále" style='FONT-WEIGHT: bold; FONT-SIZE: 30px; WIDTH: 400px; FONT-FAMILY: sans-serif; HEIGHT: 90px; BACKGROUND-COLOR: cornflowerblue' size=30 onclick="location.href='_.php';">
<?
$logs="Vstup v: ".Date("H:i:s j.m. Y")." z IP: <b>".$REMOTE_ADDR."</b><br>\n";
$lg="log_vst_rjfhvvjhoiwjfvoiuwrhgowririjhgjvoirehgoiwgoijhwegw.php";
$zaz=fopen($lg,"a+"); //bez ovìøení existence
fwrite($zaz,$logs);
fclose($zaz);
?>
</form>
</center>
</body>
</html>
