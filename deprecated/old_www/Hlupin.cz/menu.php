<?
/*
<table id=tab1 border=1 cellpadding=0 cellspacing=0 bgcolor=DarkOrange style=\"position:absolute;top:287;left:131;\">
<tr>
<td><input id=butmen type=submit value=\"Kontakty\" style=\"cursor:hand;\" onmousemove=\"style.fontWeight='bold';\" onmouseout=\"style.fontWeight='normal';\" onclick=\"men.kam.value='kontakty';men.poslat.click();\"></td>
</tr>
<tr>
<td><input id=butmen type=submit value=\"Povinné info\" style=\"cursor:hand;\" onmousemove=\"style.fontWeight='bold';\" onmouseout=\"style.fontWeight='normal';\" onclick=\"men.kam.value='povinneinfo';men.poslat.click();\"></td>
</tr>
<tr>
<td><input id=butmen type=submit value=\"Úøední deska\" style=\"cursor:hand;\" onmousemove=\"style.fontWeight='bold';\" onmouseout=\"style.fontWeight='normal';\" onclick=\"men.kam.value='urednideska';men.poslat.click();\"></td>
</tr>
<tr>
<td><input id=butmen type=submit value=\"Zastupitelé\" style=\"cursor:hand;\" onmousemove=\"style.fontWeight='bold';\" onmouseout=\"style.fontWeight='normal';\" onclick=\"men.kam.value='zastupitele';men.poslat.click();\"></td>
</tr>
<tr>
<td><input id=butmen type=submit value=\"Zápisy\" style=\"cursor:hand;\" onmousemove=\"style.fontWeight='bold';\" onmouseout=\"style.fontWeight='normal';\" onclick=\"men.kam.value='zapisy';men.poslat.click();\"></td>
</tr>
<tr>
<td><input id=butmen type=submit value=\"Vyhlášky\" style=\"cursor:hand;\" onmousemove=\"style.fontWeight='bold';\" onmouseout=\"style.fontWeight='normal';\" onclick=\"men.kam.value='vyhlasky';men.poslat.click();\"></td>
</tr>
</table>

<table id=tab2 border=1 cellpadding=0 cellspacing=0 bgcolor=DarkOrange style=\"position:absolute;top:311;left:131;\">
<tr>
<td><input id=butmen type=submit value=\"Hry pro všechny\" style=\"cursor:hand;\" onmousemove=\"style.fontWeight='bold';\" onmouseout=\"style.fontWeight='normal';\" onclick=\"men.kam.value='hryprovsechny';men.poslat.click();\"></td>
</tr>
<tr>
<td><input id=butmen type=submit value=\"Fotbal\" style=\"cursor:hand;\" onmousemove=\"style.fontWeight='bold';\" onmouseout=\"style.fontWeight='normal';\" onclick=\"men.kam.value='fotbal';men.poslat.click();\"></td>
</tr>
<tr>
<td><input id=butmen type=submit value=\"Hasièský klub\" style=\"cursor:hand;\" onmousemove=\"style.fontWeight='bold';\" onmouseout=\"style.fontWeight='normal';\" onclick=\"men.kam.value='hasicskyklub';men.poslat.click();\"></td>
</tr>

<table id=tab3 border=1 cellpadding=0 cellspacing=0 bgcolor=DarkOrange style=\"position:absolute;top:359;left:131;\">
<tr>
<td><input id=butmen type=submit value=\"Hlupín v zimì\" style=\"cursor:hand;\" onmousemove=\"style.fontWeight='bold';\" onmouseout=\"style.fontWeight='normal';\" onclick=\"men.kam.value='hlupinvzime';men.poslat.click();\"></td>
</tr>
</table>

<table id=tab4 border=1 cellpadding=0 cellspacing=0 bgcolor=DarkOrange style=\"position:absolute;top:455;left:131;\">
<tr>
<td><input id=butmen type=submit value=\"Cyklostezky\" style=\"cursor:hand;\" onmousemove=\"style.fontWeight='bold';\" onmouseout=\"style.fontWeight='normal';\" onclick=\"men.kam.value='cyklostezky';men.poslat.click();\"></td>
</tr>
<tr>
<td><input id=butmen type=submit value=\"Okolní hrady\" style=\"cursor:hand;\" onmousemove=\"style.fontWeight='bold';\" onmouseout=\"style.fontWeight='normal';\" onclick=\"men.kam.value='okolnihrady';men.poslat.click();\"></td>
</tr>
<tr>
<td><input id=butmen type=submit value=\"Zajímavá místa\" style=\"cursor:hand;\" onmousemove=\"style.fontWeight='bold';\" onmouseout=\"style.fontWeight='normal';\" onclick=\"men.kam.value='zajimavamista';men.poslat.click();\"></td>
</tr>
</table>

if(Empty($kam)){$kam="aktuality";}

if($kam=="aktuality")
{$bra[0]=" bgcolor=\"Yellow\"";}
else
{$bra[0]=" bgcolor=\"RoyalBlue\"";}

if($kam=="zakladniudaje")
{$bra[1]=" bgcolor=\"Yellow\"";}
else
{$bra[1]=" bgcolor=\"RoyalBlue\"";}

if($kam=="historie")
{$bra[2]=" bgcolor=\"Yellow\"";}
else
{$bra[2]=" bgcolor=\"RoyalBlue\"";}

if($kam=="kontakty" or $kam=="povinneinfo" or $kam=="urednideska")
{$bra[3]=" bgcolor=\"Yellow\"";}
else
{$bra[3]=" bgcolor=\"RoyalBlue\"";}

if($kam=="hryprovsechny" or $kam=="fotbal" or $kam=="hasicskyklub")
{$bra[4]=" bgcolor=\"Yellow\"";}
else
{$bra[4]=" bgcolor=\"RoyalBlue\"";}

if($kam=="doprava")
{$bra[5]=" bgcolor=\"Yellow\"";}
else
{$bra[5]=" bgcolor=\"RoyalBlue\"";}

if($kam=="hlupinvzime")
{$bra[6]=" bgcolor=\"Yellow\"";}
else
{$bra[6]=" bgcolor=\"RoyalBlue\"";}

if($kam=="hasici")
{$bra[7]=" bgcolor=\"Yellow\"";}
else
{$bra[7]=" bgcolor=\"RoyalBlue\"";}

if($kam=="adresar")
{$bra[8]=" bgcolor=\"Yellow\"";}
else
{$bra[8]=" bgcolor=\"RoyalBlue\"";}

if($kam=="forum")
{$bra[9]=" bgcolor=\"Yellow\"";}
else
{$bra[9]=" bgcolor=\"RoyalBlue\"";}

if($kam=="cyklostezky" or $kam=="okolnihrady" or $kam=="zajimavamista")
{$bra[10]=" bgcolor=\"Yellow\"";}
else
{$bra[10]=" bgcolor=\"RoyalBlue\"";}

if($kam=="uzitecneodkazy")
{$bra[11]=" bgcolor=\"Yellow\"";}
else
{$bra[11]=" bgcolor=\"RoyalBlue\"";}

if($kam=="internet")
{$bra[12]=" bgcolor=\"Yellow\"";}
else
{$bra[12]=" bgcolor=\"RoyalBlue\"";}

if($kam=="knihovna")
{$bra[13]=" bgcolor=\"Yellow\"";}
else
{$bra[13]=" bgcolor=\"RoyalBlue\"";}

//onclick=\"men(10);\"
//onclick=\"men(20);\"
//onclick=\"men(30);\"
//onclick=\"men(40);\"
*/

//if(Empty($ptx1)){$ptx1="";}
//if(Empty($ptx2)){$ptx2="";}

echo 
"<table id=tab1 class=tbb1 border=0 cellpadding=0 cellspacing=0 onmouseover=\"men.mnu1.src='menu__b4_over.png';menu(11);\" onmouseout=\"men.mnu1.src='menu__b4.png';menu(0);\">
<tr>
<td onmouseover=\"style.backgroundColor='red';\" onmouseout=\"style.backgroundColor='ff7f00';\"><a href=\"index.php?kam=kontakty\">&nbsp;Kontakty</a></td>
</tr>
<tr>
<td onmouseover=\"style.backgroundColor='red';\" onmouseout=\"style.backgroundColor='ff7f00';\"><a href=\"index.php?kam=povinneinfo\">&nbsp;Povinné info</a></td>
</tr>
<tr>
<td onmouseover=\"style.backgroundColor='red';\" onmouseout=\"style.backgroundColor='ff7f00';\"><a href=\"index.php?kam=urednideska\">&nbsp;Úøední deska</a></td>
</tr>
<tr>
<td onmouseover=\"style.backgroundColor='red';\" onmouseout=\"style.backgroundColor='ff7f00';\"><a href=\"index.php?kam=zastupitele\">&nbsp;Zastupitelé</a></td>
</tr>
<tr>
<td onmouseover=\"style.backgroundColor='red';\" onmouseout=\"style.backgroundColor='ff7f00';\"><a href=\"index.php?kam=zapisy\">&nbsp;Zápisy</a></td>
</tr>
<tr>
<td onmouseover=\"style.backgroundColor='red';\" onmouseout=\"style.backgroundColor='ff7f00';\"><a href=\"index.php?kam=vyhlasky\">&nbsp;Vyhlášky</a></td>
</tr>
</table>

<table id=tab2 class=tbb2 border=0 cellpadding=0 cellspacing=0 onmouseover=\"men.mnu2.src='menu__b5_over.png';menu(21);\" onmouseout=\"men.mnu2.src='menu__b5.png';menu(0);\">
<tr>
<td onmouseover=\"style.backgroundColor='red';\" onmouseout=\"style.backgroundColor='ff7f00';\"><a href=\"index.php?kam=hryprovsechny\">&nbsp;Hry pro všechny</a></td>
</tr>
<tr>
<td onmouseover=\"style.backgroundColor='red';\" onmouseout=\"style.backgroundColor='ff7f00';\"><a href=\"index.php?kam=fotbal\">&nbsp;Fotbal</a></td>
</tr>
<tr>
<td onmouseover=\"style.backgroundColor='red';\" onmouseout=\"style.backgroundColor='ff7f00';\"><a href=\"index.php?kam=hasicskyklub\">&nbsp;Hasièský klub</a></td>
</tr>
</table>

<table id=tab3 class=tbb3 border=0 cellpadding=0 cellspacing=0 onmouseover=\"men.mnu3.src='menu__b7_over.png';menu(31);\" onmouseout=\"men.mnu3.src='menu__b7.png';menu(0);\">
<tr>
<td onmouseover=\"style.backgroundColor='red';\" onmouseout=\"style.backgroundColor='ff7f00';\"><a href=\"index.php?kam=hlupinvzime\">&nbsp;Hlupín v zimì</a></td>
</tr>
</table>

<table id=tab4 class=tbb4 border=0 cellpadding=0 cellspacing=0 onmouseover=\"men.mnu4.src='menu__b11_over.png';menu(41);\" onmouseout=\"men.mnu4.src='menu__b11.png';menu(0);\">
<tr>
<td onmouseover=\"style.backgroundColor='red';\" onmouseout=\"style.backgroundColor='ff7f00';\"><a href=\"index.php?kam=cyklostezky\">&nbsp;Cyklostezky</a></td>
</tr>
<tr>
<td onmouseover=\"style.backgroundColor='red';\" onmouseout=\"style.backgroundColor='ff7f00';\"><a href=\"index.php?kam=okolnihrady\">&nbsp;Okolní hrady</a></td>
</tr>
<tr>
<td onmouseover=\"style.backgroundColor='red';\" onmouseout=\"style.backgroundColor='ff7f00';\"><a href=\"index.php?kam=zajimavamista\">&nbsp;Zajímavá místa</a></td>
</tr>
</table>

<form name=\"men\" method=\"get\">
<table border=0 valign=top cellpadding=0 cellspacing=0 bgcolor=\"#010080\">

<tr>
<th colspan=3 bgcolor=\"white\">
<span id=\"datum\">&nbsp;</span><br>
<span id=\"den\">&nbsp;</span></th>
</tr>

<tr>
<td><img src=\"hor1.jpg\"></td>
</tr>

<tr>
<td><a href=\"index.php?kam=aktuality\"><img border=0 id=mnu src=\"menu__b1.png\" onmouseover=\"src='menu__b1_over.png'\" onmouseout=\"src='menu__b1.png'\" name=\"kam\" value=\"aktuality\"></a></td>
</tr>

<tr>
<td><a href=\"index.php?kam=zakladniudaje\"><img border=0 id=mnu src=\"menu__b2.png\" onmouseover=\"src='menu__b2_over.png'\" onmouseout=\"src='menu__b2.png'\"></a></td>
</tr>

<tr>
<td><a href=\"index.php?kam=historie\"><img border=0 id=mnu src=\"menu__b3.png\" onmouseover=\"src='menu__b3_over.png'\" onmouseout=\"src='menu__b3.png'\"></a></td>
</tr>

<tr>
<td><img id=mnu1 src=\"menu__b4.png\" onmouseover=\"src='menu__b4_over.png';menu(11);\" onmouseout=\"src='menu__b4.png';menu(0);\"></td>
</tr>

<tr>
<td><img id=mnu2 src=\"menu__b5.png\" onmouseover=\"src='menu__b5_over.png';menu(21);\" onmouseout=\"src='menu__b5.png';menu(0);\"></td>
</tr>

<tr>
<td><a href=\"index.php?kam=doprava\"><img border=0 id=mnu src=\"menu__b6.png\" onmouseover=\"src='menu__b6_over.png'\" onmouseout=\"src='menu__b6.png'\"></a></td>
</tr>

<tr>
<td><img id=mnu3 src=\"menu__b7.png\" onmouseover=\"src='menu__b7_over.png';menu(31);\" onmouseout=\"src='menu__b7.png';menu(0);\"></td>
</tr>

<tr>
<td><a href=\"index.php?kam=hasici\"><img border=0 id=mnu src=\"menu__b8.png\" onmouseover=\"src='menu__b8_over.png'\" onmouseout=\"src='menu__b8.png'\"></a></td>
</tr>

<tr>
<td><a href=\"index.php?kam=adresar\"><img border=0 id=mnu src=\"menu__b9.png\" onmouseover=\"src='menu__b9_over.png'\" onmouseout=\"src='menu__b9.png'\"></a></td>
</tr>

<tr>
<td><a href=\"index.php?kam=forum\"><img border=0 id=mnu src=\"menu__b10.png\" onmouseover=\"src='menu__b10_over.png'\" onmouseout=\"src='menu__b10.png'\"></a></td>
</tr>

<tr>
<td><img id=mnu4 src=\"menu__b11.png\" onmouseover=\"src='menu__b11_over.png';menu(41);\" onmouseout=\"src='menu__b11.png';menu(0);\"></td>
</tr>

<tr>
<td><a href=\"index.php?kam=uzitecneodkazy\"><img border=0 id=mnu src=\"menu__b12.png\" onmouseover=\"src='menu__b12_over.png'\" onmouseout=\"src='menu__b12.png'\"></a></td>
</tr>

<tr>
<td><a href=\"index.php?kam=internet\"><img border=0 id=mnu src=\"menu__b13.png\" onmouseover=\"src='menu__b13_over.png'\" onmouseout=\"src='menu__b13.png'\"></a></td>
</tr>

<tr>
<td><a href=\"index.php?kam=knihovna&vstup=false\"><img border=0 id=mnu src=\"menu__b14.png\" onmouseover=\"src='menu__b14_over.png'\" onmouseout=\"src='menu__b14.png'\"></a></td>
</tr>


<tr>
<td colspan=3><a href=\"index.php?kam=tvurci\"><img border=0 id=mnu id=mnu src=\"webmasters_b1.png\" onmouseover=\"src='webmasters_b1_over.png'\" onmouseout=\"src='webmasters_b1.png'\"></a></td>
</tr>

<tr>
<td colspan=3><a href=\"index.php?kam=ajdimne&vstup=false\"><img border=0 src=\"dol1.jpg\"></a></td>
</tr>

<tr>
<td colspan=3 bgcolor=white>




</td>
</tr>

<tr>
<th colspan=3 bgcolor=\"white\"><a href=\"index.php?kam=mapa\"><img border=0 src=\"mapa.bmp\" style=\"cursor:hand;\"></a></th>
</tr>

<tr>
<td colspan=3 bgcolor=white>&nbsp;</td>
</tr>

<tr>
<th colspan=3 bgcolor=white>
<img src=\"http://toplist.cz/count.asp?id=404986&logo=bc\" alt=\"TOPlist\" width=\"88\" height=\"120\">
</th>
</tr>

</table>
</form>";
/*
onclick=\"men.kam.value='aktuality';men.poslat.click();\"

onclick=\"men.kam.value='zakladniudaje';men.poslat.click();\"

<input type=hidden name=kam>

<input type=hidden name=czkn>
<input type=hidden name=ptx0>
<input type=hidden name=ptx1 value=\"$ptx1\">
<input type=hidden name=ptx2 value=\"$ptx2\">
<input type=hidden name=ptx3>
<input type=hidden name=ptx4>
<input type=hidden name=pvas>
<input type=hidden name=ank>
<input type=hidden name=vyp>
<input type=hidden name=edttxt>
<input type=hidden name=zajm>
<input type=submit name=poslat value=\"\" style=\"visibility:hidden\">

 onclick=\"men.kam.value='';men.ptx1.value='';men.ptx2.value='';men.poslat.click();\"

<input type=hidden name=stvkn>
 alt=\"Poèítadlo pøístupù: pocitadlo.abz.cz\"
*/
?>
