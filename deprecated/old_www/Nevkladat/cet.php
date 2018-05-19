<script language="JavaScript">
var a=0;
function obnov()
{
a++;
aa.innerText=a;

if(a==max.value)
{
a=0;
location.reload();
}
var tim=setTimeout("obnov()",1000);
}
</script>

<body onload="obnov()"></body>

<table border=1>
<tr>
<td><div style="width:500px;height:350px"><span id=aa></span></div></td>
<td><div style="width:200px;height:350px"></div></td>
</tr>
<tr>
<td><input type=text size=60><input type=submit value="Odepiš"></td>
<td>Obnov každých: <input type=text name=max value=20 size=5> s</td>
</tr>
</table>

<?

?>
