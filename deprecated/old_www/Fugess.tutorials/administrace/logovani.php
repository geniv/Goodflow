<table border="0" cellspacing="0" cellpadding="0" align="center" width="1%">
<tr>
<td width="0%" class="levy_vrsek"><img src="../images/spacer.gif" width="17px" height="17px"></td>
<td width="100%" class="vrsek" colspan="3"><img src="../images/spacer.gif" height="17px"></td>
<td width="0%" class="pravy_vrsek"><img src="../images/spacer.gif" width="17px" height="17px"></td>
</tr>
<tr>
<td width="0%" class="levy"><img src="../images/spacer.gif" width="17px"></td>
<td class="input"><img src="../images/spacer.gif" width="1px">&nbsp;</td>
<td class="input" align="center" width="100%"><strong>Výpis&nbsp;logování&nbsp;do&nbsp;administrace</strong></td>
<td class="input"><img src="../images/spacer.gif" width="1px">&nbsp;</td>
<td width="0%" class="pravy"><img src="../images/spacer.gif" width="17px"></td>
</tr>
<tr>
<td width="0%" class="levy_spodek"><img src="../images/spacer.gif" width="17px" height="18px"></td>
<td width="100%" class="spodek" colspan="3"><img src="../images/spacer.gif" height="18px"></td>
<td width="0%" class="pravy_spodek"><img src="../images/spacer.gif" width="17px" height="18px"></a></td>
</tr>
</table>
<table border="0" cellspacing="0" cellpadding="0" align="center" width="50%">
<tr>
<td height="6px"></td>
</tr>
</table>
<table border="0" cellspacing="0" cellpadding="0" align="center" width="86%">
<tr>
<td width="0%" class="levy_vrsek"><img src="../images/spacer.gif" width="17px" height="17px"></td>
<td width="100%" class="vrsek" colspan="3"><img src="../images/spacer.gif" height="17px"></td>
<td width="0%" class="pravy_vrsek"><img src="../images/spacer.gif" width="17px" height="17px"></td>
</tr>
<tr>
<td width="0%" class="levy"><img src="../images/spacer.gif" width="17px"></td>
<td><img src="images/spacer.gif" width="1px">&nbsp;</td>
<td align="center" width="100%">
<?
if(!Empty($admin_jmeno) and !Empty($admin_heslo) and login($admin_jmeno,$admin_heslo)=="true")
{
$delkasoub=delka_souboru(".");
$soub="../prihl_apqfnmsojvbhsivbsjvsiusiuvqwfpokfnisnvnsosijvnskjvsdfkjvbjbisujbdv.php";
$uk=fopen($soub,"r");
print fread($uk,$delkasoub);
fclose($uk);
}
else
{print "neoprávnìný pøístup!";}
?>
</td>
<td><img src="images/spacer.gif" width="1px">&nbsp;</td>
<td width="0%" class="pravy"><img src="../images/spacer.gif" width="17px"></td>
</tr>
<tr>
<td width="0%" class="levy_spodek"><img src="../images/spacer.gif" width="17px" height="18px"></td>
<td width="100%" class="spodek" colspan="3"><img src="../images/spacer.gif" height="18px"></td>
<td width="0%" class="pravy_spodek"><img src="../images/spacer.gif" width="17px" height="18px"></a></td>
</tr>
</table>
