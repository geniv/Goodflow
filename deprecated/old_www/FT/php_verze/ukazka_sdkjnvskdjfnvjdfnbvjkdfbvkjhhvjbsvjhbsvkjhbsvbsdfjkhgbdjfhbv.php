<?
$s_vobr="obr_eskkaejnpkjwsmroigjhniqwfoipvjdfbokjndobjndokjfnboidnboihrnbv.php";
$uk=fopen($s_vobr,"r");
$ukob=fread($uk,10000);
fclose($uk);
echo 
"<html>
<head>
<title>Obrázek</title>
</head>
<style>
body,table,center
{
background: #A8ACB8;
}
</style>
<body>
<table border=0 align=center valign=top cellspacing=0 cellpadding=0>
 <tr>
  <td align=center><img src=\"$ukob\"></td>
 </tr>
 <tr>
  <td align=center>&nbsp;</td>
 </tr>
 <tr>
  <td align=center><input type=image src=\"zpatky_tlacitko.gif\" onclick=\"window.close();\"></td>
 </tr>
 <tr>
  <td align=center>&nbsp;</td>
 </tr>
</table>
</body>
</html>";
?>
