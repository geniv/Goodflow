<?
if($hs=="heslo") 
{
header("location:str1.php");
}
else
{
echo "<center><br><br><br><br><br><br>";
echo "�patn� heslo<br>";
echo "<b onclick='javascript:history.go(-1);' style='cursor: hand;'>Zp�t</b></center>";
}
/*
<form method=post action="log.php">
<input type="password" name="hs">
<input type="submit" value="potvr�">
</form>
*/
?>
