<?
require "funkce.php";

echo
"<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">
<html>
<head>
<title>Fórum</title>
<META http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1250\">
</head>
<body>
<table border=1>

<tr>
<td>hl. (obrázek)</td>
</tr>

<tr>
<td>
Hl.menu:<br>
<a href=\"index.php\">index</a><br>
<a href=\"index.php?kam=registrace\">registrace</a><br>
<a href=\"index.php?kam=login\">login</a><br>
<a href=\"index.php?kam=uzivatele&str=1\">uživatelé</a><br>
<a href=\"index.php?kam=profil\">profil</a>
</td>
</tr>

<tr>
<td>";

if(Empty($kam))
{include "hlavni.php";}
else
{include "$kam.php";}
echo 
"</td>
</table>
</body>
</html>";

//else
//{

/*
if(Empty($pod))
{
if()
echo "<table border=1>";
$ppm=0;
for($i=0;$i<count($podtm);$i++)
{
$ppm++;
echo 
"<tr>
<td><a href=\"index.php?kam=$kam&pod=$ppm\">{$podtm[$i]}</a></td>
</tr>";
}
echo "</table>";
}
else
{
echo "<table border=1>";
for($i=0;$i<count($prisp);$i++)
{
echo 
"<tr>
<td><a href=\"index.php?kam=$kam&pod=$pod\">{$prisp[$i]}</a></td>
</tr>";
}
echo "</table>";
}

}
*/

/*

$prisp[0]="pispevky k tema 1";
$prisp[1]="pispevky k tema 2";
$prisp[2]="pispevky k tema 3";
$prisp[3]="pispevky k tema 4";
*/

?>

