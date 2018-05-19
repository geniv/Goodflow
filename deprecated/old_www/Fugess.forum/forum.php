<?
if(!Empty($Jmeno_r) and !Empty($Heslo_r) and login($Jmeno_r,$Heslo_r)=="true" and !Empty($cis))
{
// action=\"viewforum.php?f=1&amp;start=0\"
//<span class=\"gensmall\"><a href=\"viewforum.php?f=1&amp;mark=topics\">Oznaèit všechna témata jako pøeètená</a></span>
//&nbsp;&nbsp;&nbsp;<a href=\"index.php\" class=\"nav\">Obsah fóra Fugessovo fórum</a> -> <a class=\"nav\" href=\"viewforum.php?f=1\">Struèný popis fóra</a></span>
//<a class=\"maintitle\" href=\"viewforum.php?f=1\">
//print "fórum èíslo: $cis<br>";
$pravo=prava_uzivatele($Jmeno_r,$ID_uz);
$zamk=stav_zamku_vlakna($cis);
$tema=temata_fora($cis);

if($zamk=="true")
{$novtop="<a href=\"index.php?kam=novy_topik&cis=$cis&str=1\"><img src=\"images/tlacitka/post.gif\" border=\"0\" alt=\"Pøidat nové téma\"></a>";}
else
{$novtop="<img src=\"images/tlacitka/reply-locked.gif\" border=\"0\" alt=\"Zablokované pøidávání topiku\" align=\"middle\">";}

echo
"<form method=\"get\">
<table width=\"100%\" cellspacing=\"2\" cellpadding=\"2\" border=\"0\" align=\"center\">
<tr>
<td align=\"left\" valign=\"bottom\" colspan=\"3\"><span class=\"maintitle\">$tema</span><br><br></td>
</tr>
<tr>
<td align=\"left\" valign=\"middle\" width=\"50\">$novtop</td>
</tr>
</table>

<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\">
<tr>
<td width=\"0%\" class=\"mainboxLefttop\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
<td width=\"100%\" class=\"mainboxTop\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
<td width=\"0%\" class=\"mainboxRighttop\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
</tr>
<tr>
<td width=\"0%\" class=\"mainboxLeft\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
<td width=\"100%\" class=\"folderIconBox\">

<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\">
<tr>
<td class=\"folderIconBoxStart\">

<table border=\"0\" cellpadding=\"4\" cellspacing=\"1\" width=\"100%\" class=\"forumline\">
<tr>
<th colspan=\"2\" align=\"center\" height=\"25\" class=\"thCornerL\" nowrap>&nbsp;Témata&nbsp;</th>
<th width=\"50\" align=\"center\" class=\"thTop\" nowrap>&nbsp;Odpovìdi&nbsp;</th>
<th width=\"100\" align=\"center\" class=\"thTop\" nowrap>&nbsp;Autor&nbsp;</th>
<th width=\"50\" align=\"center\" class=\"thTop\" nowrap>&nbsp;Zhlédnuto&nbsp;</th>
<th align=\"center\" class=\"thCornerR\" nowrap>&nbsp;Poslední pøíspìvek&nbsp;</th>
</tr>
<!--- opakování --->";

//odeber_zhlednuti(1,2);
//odeber_odpoved(1,2);
//pridej_odpoved($cis,1);
//print "$i: {$nadpis[($i*$poct)-4]}<br>"; NOVÝ vzorec!!!!!
//print $nadpis[($i*$poct)-2];
//print ($zobrmin==$i)."<br>";
//print ($zobrmax==$i)."<br>";
//print "$zobrmin, $zobrmax";
//for($i=$zobrmax;$i>$zobrmin-1;$i--)
//$i1=$i1+$poct;
//$pocpr++;
//$pocpr=0;
//print "Na stránce max: $zobstr zobrazených pøípìvkù, celkem je zde: $pocpris<br>";

$delkasoub=delka_souboru();
$nazev="naz_topik_{$cis}.php";
if(file_exists($nazev)=="true")
{
$poct=delka_nadpisu();
$u=fopen($nazev,"r");
$nadpis=explode("--TPK--",fread($u,$delkasoub));
fclose($u);
$zobstr=pocet_topiku_na_strance();
$pocpris=(count($nadpis)-1)/$poct;//poèet pøíspìvkù
}

if(Empty($str))
{$str=1;}

if(!Empty($nadpis) and $pocpris!=0)
{
$i1=0;
$zobrmin=0;
$zobrmax=0;
$zobrmin=($pocpris+1)-($zobstr*$str);
$zobrmax=($zobrmin+$zobstr)-1;
$stran=ceil($pocpris/$zobstr);//poèet stran,zaokrouhluje nahoru!
$celkem=0;

for($i=$pocpris;$i>0;$i--)
{
$nazev1="f_topik_{$cis}_{$i}.php";
$u=fopen($nazev1,"r");
$pris=explode("--ZPR--",fread($u,$delkasoub));
fclose($u);
$del=delka_obsahu();
$datum=$pris[count($pris)-2];

$nazev2="f_topik_{$cis}_{$i}_novota.php";
if(file_exists($nazev2)=="true")
{
$u=fopen($nazev2,"r");
$nov=fread($u,$delkasoub);
fclose($u);
}
else
{$nov="";}

//$nadpis[($i*$poct)]
$obrz=obrazky_prispevku($nadpis[($i*$poct)-3],$nadpis[($i*$poct)-2],$nov);

if($nadpis[($i*$poct)-1]>pocet_prispevku_na_strance())
{
$pocstrn=ceil(($nadpis[($i*$poct)-1]+1)/pocet_prispevku_na_strance());
if($pocstrn==2)
{$jdina="<span class=\"gensmall\">Jdi na stánku: <a href=\"index.php?kam=obsah_tema&cis=$cis&pris=$i&str=1\">1</a>, <a href=\"index.php?kam=obsah_tema&cis=$cis&pris=$i&str=2\">2</a></span>";}
if($pocstrn==3)
{$jdina="<span class=\"gensmall\">Jdi na stánku: <a href=\"index.php?kam=obsah_tema&cis=$cis&pris=$i&str=1\">1</a>, <a href=\"index.php?kam=obsah_tema&cis=$cis&pris=$i&str=2\">2</a>, <a href=\"index.php?kam=obsah_tema&cis=$cis&pris=$i&str=3\">3</a></span>";}
if($pocstrn==4)
{$jdina="<span class=\"gensmall\">Jdi na stánku: <a href=\"index.php?kam=obsah_tema&cis=$cis&pris=$i&str=1\">1</a>, <a href=\"index.php?kam=obsah_tema&cis=$cis&pris=$i&str=2\">2</a>, <a href=\"index.php?kam=obsah_tema&cis=$cis&pris=$i&str=3\">3</a>, <a href=\"index.php?kam=obsah_tema&cis=$cis&pris=$i&str=4\">4</a></span>";}
if($pocstrn==5)
{$jdina="<span class=\"gensmall\">Jdi na stánku: <a href=\"index.php?kam=obsah_tema&cis=$cis&pris=$i&str=1\">1</a>, <a href=\"index.php?kam=obsah_tema&cis=$cis&pris=$i&str=2\">2</a>, <a href=\"index.php?kam=obsah_tema&cis=$cis&pris=$i&str=3\">3</a>, <a href=\"index.php?kam=obsah_tema&cis=$cis&pris=$i&str=4\">4</a>, <a href=\"index.php?kam=obsah_tema&cis=$cis&pris=$i&str=5\">5</a></span>";}
if($pocstrn==6)
{$jdina="<span class=\"gensmall\">Jdi na stánku: <a href=\"index.php?kam=obsah_tema&cis=$cis&pris=$i&str=1\">1</a>, <a href=\"index.php?kam=obsah_tema&cis=$cis&pris=$i&str=2\">2</a>, <a href=\"index.php?kam=obsah_tema&cis=$cis&pris=$i&str=3\">3</a>, <a href=\"index.php?kam=obsah_tema&cis=$cis&pris=$i&str=4\">4</a>, <a href=\"index.php?kam=obsah_tema&cis=$cis&pris=$i&str=5\">5</a>, <a href=\"index.php?kam=obsah_tema&cis=$cis&pris=$i&str=6\">6</a></span>";}
if($pocstrn>7)//poslední 4
{$jdina="<span class=\"gensmall\">Jdi na stánku: <a href=\"index.php?kam=obsah_tema&cis=$cis&pris=$i&str=1\">1</a>, <a href=\"index.php?kam=obsah_tema&cis=$cis&pris=$i&str=2\">2</a>, <a href=\"index.php?kam=obsah_tema&cis=$cis&pris=$i&str=3\">3</a> ... <a href=\"index.php?kam=obsah_tema&cis=$cis&pris=$i&str=".($pocstrn-3)."\">".($pocstrn-3)."</a>, <a href=\"index.php?kam=obsah_tema&cis=$cis&pris=$i&str=".($pocstrn-2)."\">".($pocstrn-2)."</a>, <a href=\"index.php?kam=obsah_tema&cis=$cis&pris=$i&str=".($pocstrn-1)."\">".($pocstrn-1)."</a>, <a href=\"index.php?kam=obsah_tema&cis=$cis&pris=$i&str=$pocstrn\">$pocstrn</a></span>";}
//$jdina="<span class=\"gensmall\">Jdi na stánku: <a href=\"index.php?kam=obsah_tema&cis=$cis&pris=$i&str=1\">1</a> ... <a href=\"index.php?kam=obsah_tema&cis=$cis&pris=$i&str=$pocstrn\">$pocstrn</a></span>";
}
else
{$jdina="";}

if(($i>=$zobrmin and $i<=$zobrmax))
{
echo 
"<tr>
<td class=\"row1\" align=\"center\" valign=\"middle\" width=\"20\">$obrz</td>
<td class=\"row1\" width=\"100%\"><span class=\"topictitle\"><a href=\"index.php?kam=obsah_tema&cis=$cis&pris=$i&str=1\" class=\"topictitle\">{$nadpis[($i*$poct)-6]}</a></span><span class=\"gensmall\"><br>$jdina</span></td>
<td class=\"row2\" align=\"center\" valign=\"middle\"><span class=\"postdetails\">{$nadpis[($i*$poct)-1]}</span></td>
<td class=\"row3\" align=\"center\" valign=\"middle\"><span class=\"name\"><a href=\"index.php?kam=info_user&kdo={$nadpis[($i*$poct)-5]}&idic={$nadpis[($i*$poct)-4]}\">{$nadpis[($i*$poct)-5]}</a></span></td>
<td class=\"row2\" align=\"center\" valign=\"middle\"><span class=\"postdetails\">{$nadpis[($i*$poct)]}</span></td>
<td class=\"row3Right\" align=\"center\" valign=\"middle\" nowrap>
<span class=\"postdetails\">".posledni_prispevek_v_topiku($cis,$i)."</span></td>
</tr>";
}
/**/
}//end for

}//end if
else
{
if(Empty($stran)){$stran=1;}
echo
"<tr>
<td align=\"center\" colspan=\"6\"><b>Toto téma je prázdné.</b></td>
</tr>";
}
echo "          <!--- opakování --->

<tr>
<td class=\"catBottom\" align=\"center\" valign=\"middle\" colspan=\"6\" height=\"28\"><span class=\"genmed\"></td>
</tr>

</table>
</td>
</tr>
</table>

</td>
<td width=\"0%\" class=\"mainboxRight\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
</tr>
<tr>
<td width=\"0%\" class=\"mainboxLeftbottom\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
<td width=\"100%\" valign=\"top\" class=\"mainboxBottom\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
<td width=\"0%\" class=\"mainboxRightbottom\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
</tr>
</table>
<table width=\"100%\" cellspacing=\"2\" border=\"0\" align=\"center\" cellpadding=\"2\">
<tr>
<td align=\"left\" valign=\"middle\" width=\"50\" class=\"tdPostImgBottom\">$novtop</td>
<td align=\"right\" valign=\"top\" class=\"nav\">".jdi_na_stranku($str,$cis,"",$stran,"forum")."</td>
</td>
</tr>
<tr>
<td align=\"left\" class=\"nav\">Strana $str z $stran</td>
</tr>
<tr>
<td align=\"left\" valign=\"bottom\">";

if($pravo==3)
{
if($zamk=="true")
{$jk="false";}
else
{$jk="true";}

print "<a href=\"index.php?kam=zamek_vlakna&cis=$cis&jak=$jk\"><img src=\"images/topic_lock.gif\" alt=\"Zamknout/Odemknout toto téma\" title=\"Zamknout/Odemknout toto téma\" border=\"0\"></a>";
}
echo
"<!-----<span class=\"gensmall\">Uživatelé prohlížející toto fórum: nikdo není pøítomen<br>Moderátoøi: nikdo není pøítomen<br>Administrátoøi: nikdo není pøítomen</span>-----></td>
</tr>
</table>
</form>
<table width=\"100%\" cellspacing=\"0\" border=\"0\" align=\"center\" cellpadding=\"0\">
<tr>
<td align=\"left\" valign=\"top\">

<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
<tr>
<td width=\"5\" class=\"mainboxLefttop\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
<td class=\"mainboxTop\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
<td width=\"5\" class=\"mainboxRighttop\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
</tr>
<tr>
<td width=\"5\" class=\"mainboxLeft\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
<td class=\"folderIconBox\">

<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
<tr>
<td class=\"folderIconBoxStart\">

<table cellspacing=\"3\" cellpadding=\"0\" border=\"0\">
<tr>
<td width=\"23\" align=\"left\" nowrap><img src=\"images/folder_new.gif\" alt=\"Nové pøíspìvky\" width=\"23\" height=\"23\"></td>
<td class=\"genmed\" nowrap>Nové pøíspìvky</td>
<td>&nbsp;&nbsp;</td>
<td width=\"23\" align=\"center\" nowrap><img src=\"images/folder.gif\" alt=\"Žádné nové pøíspìvky\" width=\"23\" height=\"23\"></td>
<td class=\"genmed\" nowrap>Žádné nové pøíspìvky</td>
<td>&nbsp;&nbsp;</td>
<td width=\"23\" align=\"center\" nowrap><img src=\"images/folder_announce.gif\" alt=\"Oznámení\" width=\"23\" height=\"23\"></td>
<td class=\"genmed\" nowrap>Oznámení</td>
</tr>
<tr>
<td width=\"23\" align=\"center\" nowrap><img src=\"images/folder_lock_new.gif\" alt=\"\" width=\"23\" height=\"23\"></td>
<td class=\"genmed\" nowrap>Nové pøíspìvky [zamknuto]</td>
<td>&nbsp;&nbsp;</td>
<td width=\"23\" align=\"center\" nowrap><img src=\"images/folder_lock.gif\" alt=\"\" width=\"23\" height=\"23\"></td>
<td class=\"genmed\" nowrap>Žádné nové pøíspìvky [zamknuto]</td>
<td>&nbsp;&nbsp;</td>
<td width=\"23\" align=\"center\" nowrap><img src=\"images/folder_sticky.gif\" alt=\"Dùležité\" width=\"23\" height=\"23\"></td>
<td class=\"genmed\" nowrap>Dùležité</td>
</tr>
</table>
</td>

</tr>
</table>

</td>
<td width=\"5\" class=\"mainboxRight\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
</tr>
<tr>
<td width=\"5\" class=\"mainboxLeftbottom\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
<td width=\"400\" valign=\"top\" class=\"mainboxBottom\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
<td width=\"5\" class=\"mainboxRightbottom\"><img src=\"images/spacer.gif\" width=\"6\" height=\"6\"></td>
</tr>
</table>
</td>

</tr>
</table>";
//<td align=\"right\"><span class=\"gensmall\"><b>Mùžete</b> pøidat nové téma do tohoto fóra.<br><b>Mùžete</b> odpovídat na témata v tomto fóru.<br><b>Mùžete</b> upravovat své pøíspìvky v tomto fóru.<br><b>Mùžete</b> mazat své pøíspìvky v tomto fóru.<br><b>Mùžete</b> hlasovat v tomto fóru.<br><b>Mùžete</b> <a href=\"modcp.php?f=1&amp;start=0&amp;sid=3779e72d1eb3c9287f390a413cfb19af\">moderovat toto fórum</a>.</span></td>
}
else
{echo "<body onload=\"nalog.click();\"><a name=\"nalog\" href=\"index.php?kam=login\"></a></body>";}

//print $datum;
//2: nazev
//3: jmeno
//4: typ topik
//5: blok (true: volne)
//6: odpovìdi
//7: zhlédnuto
//print $nadpis[(($i1-($poct+1))-($i*2))+3];

//------------------------------------------------------------------------------
//$obrz=obrazky_prispevku_v($i,$i1,$cis);

//function obrazky_prispevku_v($cislo1,$cislo2,$csl)
//{

/*
print ;
if($nadpis[(($i1-($poct+1))-($i*2))+4]==0 and >Date("d.m.Y"))
{
if(=="true")
{$obrz="<img src=\"images/folder_new.gif\" alt=\"Nové pøíspìvky\" width=\"23\" height=\"23\">";}
else
{$obrz="<img src=\"images/folder_lock_new.gif\" alt=\"\" width=\"23\" height=\"23\">";}
}
else
{
if($nadpis[(($i1-($poct+1))-($i*2))+5]=="true")
{$obrz="<img src=\"images/folder.gif\" alt=\"Žádné nové pøíspìvky\" width=\"23\" height=\"23\">";}
else
{$obrz="<img src=\"images/folder_lock.gif\" alt=\"\" width=\"23\" height=\"23\">";}

if($nadpis[(($i1-($poct+1))-($i*2))+4]==1){"<img src=\"images/folder_sticky.gif\" alt=\"Dùležité\" width=\"23\" height=\"23\">";}
if($nadpis[(($i1-($poct+1))-($i*2))+4]==2){$obrz="<img src=\"images/folder_announce.gif\" alt=\"Oznámení\" width=\"23\" height=\"23\">";}
}*/
//}

//------------------------------------------------------------------------------

//print $nadpis[(($i1-($poct+1))-($i*2))+6];
/*
if($nadpis[(($i1-($poct+1))-($i*2))+4]==0 and $nadpis[(($i1-($poct+1))-($i*2))+5]>Date("j.n.Y"))
{
if($nadpis[(($i1-($poct+1))-($i*2))+6]=="true")
{$obrz="<img src=\"images/folder_new.gif\" alt=\"Nové pøíspìvky\" width=\"23\" height=\"23\">";}
else
{$obrz="<img src=\"images/folder_lock_new.gif\" alt=\"\" width=\"23\" height=\"23\">";}
}
else
{
if($nadpis[(($i1-($poct+1))-($i*2))+6]=="true")
{$obrz="<img src=\"images/folder.gif\" alt=\"Žádné nové pøíspìvky\" width=\"23\" height=\"23\">";}
else
{$obrz="<img src=\"images/folder_lock.gif\" alt=\"\" width=\"23\" height=\"23\">";}
}

if($nadpis[(($i1-($poct+1))-($i*2))+4]==1){$obrz="<img src=\"images/folder_sticky.gif\" alt=\"Dùležité\" width=\"23\" height=\"23\">";}
if($nadpis[(($i1-($poct+1))-($i*2))+4]==2){$obrz="<img src=\"images/folder_announce.gif\" alt=\"Oznámení\" width=\"23\" height=\"23\">";}
*/
?>
