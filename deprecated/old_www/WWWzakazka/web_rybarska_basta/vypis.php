<?php
echo
"<style type=\"text/css\">
<!--
body {
	background-color: #000000;
	margin-top : 0px ! important;
	margin-left : 0px ! important;
	color: white;
}

font,th,td,p { font-family: Verdana, Arial, Helvetica, sans-serif }
p, td, a { font-size : 14px; color: white;}
h1 { font-family: Trebuchet MS, Verdana, Arial, Helvetica, sans-serif; font-size : 12px; font-weight : bold; text-decoration : none; line-height : 120%; }
h2 { font-family: Trebuchet MS, Verdana, Arial, Helvetica, sans-serif; font-size : 13px; font-weight : bold; text-decoration : none; line-height : 120%; }
h3 { font-family: Trebuchet MS, Verdana, Arial, Helvetica, sans-serif; font-size : 14px; font-weight : bold; text-decoration : none; line-height : 120%; }

-->
</style>";

$aktualni_soubor=basename(__FILE__);

$pol=".";
$i=0;
$cesta[]="";
$handle=opendir($pol);
while($soub=readdir($handle))
{
$i++;
$cesta[$i]=$soub;
}
closedir($handle);
sort($cesta);//seřazení
reset($cesta);

print
"<table cellpadding=\"6\" cellspacing=\"0\" border=\"1\" style=\"border-collapse: collapse\" bordercolor=\"#091194\">
<tr>
<td>Odkaz</td>
<td>Link</td>
<td>Velikost</td>
</tr>";

if(count($cesta)!=3)
{

for($i=3;$i<count($cesta);$i++)
{
$vel=filesize("$pol/{$cesta[$i]}");
if($vel>=1048576)
{$velikost=sprintf("%.2f MB",$vel/1048576);}
else
if($vel>=1024)
{$velikost=sprintf("%.2f KB",$vel/1024);}
else
{$velikost=sprintf("%.2f Bytes",$vel);}
//------------------------------------------------------------
$link="$pol/{$cesta[$i]}";
echo
"<tr>
<td><a href=\"$pol/{$cesta[$i]}\" target=\"_blank\" class=\"odkaz\">{$cesta[$i]}</a></td>
<td>$link</td>
<td>$velikost</td>
</tr>";
}//end for

}
else
{print
"<tr>
<th colspan=\"4\">Žádné soubory</th>
</tr>";}

print
"</table>";
?>
