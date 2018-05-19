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
<title>Nový vzhled Geniv web's - Vstup</title>
</head>
<br><br><br><br><br>
<br><br><br><br><br>
<center>
<form>
<input type=button value="Stránky pøesmìrovány (kliknìte)" style='FONT-WEIGHT: bold; FONT-SIZE: 30px; FONT-FAMILY: sans-serif; HEIGHT: 90px; BACKGROUND-COLOR: cornflowerblue' size=30 onclick="location.href='http://geniv.wu.cz/';">
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
