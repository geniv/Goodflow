<?
if(!Empty($prikaz))
{
if($prikaz=="nacti_na")
{
print "Editována Návštìvní kniha (otevøeno)";
$dot_s="navstevni_kniha.php";
$doss=fopen($dot_s,"r");
$obsah=fread($doss,50000);
fclose($doss);
}//end if nacti

if($prikaz=="uloz_na" and !$edttxt=="")
{
print "Editována Návštìvní kniha (uloženo)";
$dot_s="navstevni_kniha.php";
$doss=fopen($dot_s,"w");
fwrite($doss,$edttxt);
$doss=fopen($dot_s,"r");
$obsah=fread($doss,50000);
fclose($doss);
}
else
{
if($prikaz=="uloz_na" and $edttxt==""){$obsah="";}
}//end if uloz

if($prikaz=="nacti_hl")
{
print "Editován hlavní logovací soubor (otevøeno)";
$dot_s="log_chod.php";
$doss=fopen($dot_s,"r");
$obsah=fread($doss,50000);
fclose($doss);
}//end if nacti

if($prikaz=="uloz_hl" and !$edttxt=="")
{
print "Editována hlavní logovací soubor (uloženo)";
$dot_s="log_chod.php";
$doss=fopen($dot_s,"w");
fwrite($doss,$edttxt);
$doss=fopen($dot_s,"r");
$obsah=fread($doss,50000);
fclose($doss);
}
else
{
if($prikaz=="uloz_hl" and $edttxt==""){$obsah="";}
}//end if uloz

if($prikaz=="nacti_pr")
{
print "Editován logovací soubor pøihlašování (otevøeno)";
$dot_s="log_ost.php";
$doss=fopen($dot_s,"r");
$obsah=fread($doss,50000);
fclose($doss);
}//end if nacti

if($prikaz=="uloz_pr" and !$edttxt=="")
{
print "Editována logovací soubor pøihlašování (uloženo)";
$dot_s="log_ost.php";
$doss=fopen($dot_s,"w");
fwrite($doss,$edttxt);
$doss=fopen($dot_s,"r");
$obsah=fread($doss,50000);
fclose($doss);
}
else
{
if($prikaz=="uloz_pr" and $edttxt==""){$obsah="";}
}//end if uloz

if($prikaz=="nacti_vs")
{
print "Editován logovací soubor vstupù (otevøeno)";
$dot_s="log_vst.php";
$doss=fopen($dot_s,"r");
$obsah=fread($doss,50000);
fclose($doss);
}//end if nacti

if($prikaz=="uloz_vs" and !$edttxt=="")
{
print "Editován logovací soubor vstupù (uloženo)";
$dot_s="log_vst.php";
$doss=fopen($dot_s,"w");
fwrite($doss,$edttxt);
$doss=fopen($dot_s,"r");
$obsah=fread($doss,50000);
fclose($doss);
}
else
{
if($prikaz=="uloz_vs" and $edttxt==""){$obsah="";}
}//end if uloz

if($prikaz=="nacti_nu")
{
print "Editován logovací soubor nových uživatelù (otevøeno)";
$dot_s="now_hes.php";
$doss=fopen($dot_s,"r");
$obsah=fread($doss,50000);
fclose($doss);
}//end if nacti

if($prikaz=="uloz_nu" and !$edttxt=="")
{
print "Editován logovací soubor nových uživatelù (uloženo)";
$dot_s="now_hes.php";
$doss=fopen($dot_s,"w");
fwrite($doss,$edttxt);
$doss=fopen($dot_s,"r");
$obsah=fread($doss,50000);
fclose($doss);
}
else
{
if($prikaz=="uloz_nu" and $edttxt==""){$obsah="";}
}//end if uloz

if($prikaz=="nacti_po")
{
print "Editován soubor poznámek (otevøeno)";
$dot_s="po_zn_am_ky.php";
$doss=fopen($dot_s,"r");
$obsah=fread($doss,50000);
fclose($doss);
}//end if nacti

if($prikaz=="uloz_po" and !$edttxt=="")
{
print "Editován soubor poznámek (uloženo)";
$dot_s="po_zn_am_ky.php";
$doss=fopen($dot_s,"w");
fwrite($doss,$edttxt);
$doss=fopen($dot_s,"r");
$obsah=fread($doss,50000);
fclose($doss);
}
else
{
if($prikaz=="uloz_po" and $edttxt==""){$obsah="";}
}//end if uloz

if($prikaz=="posl_mejl")
{
if(!Empty($emm) and !Empty($emp) and !Empty($emz))
{
mail($emm,$emp,$emz);
print "Email odeslán!";
}//end empty
$obsah="";
}//end pøíkaz

}
else
{
$obsah="";
}
?>
<form method=post name=fom>
<textarea rows=20 cols=100 name=memo>
<? print $obsah; ?>
</textarea>
<br>
<center>

<b>Hlavni logovací soubor</b><br>
<input type=submit value="Otevøít" onclick="fom.prikaz.value='nacti_hl';">
<input type=submit value="Uložit" onclick="fom.prikaz.value='uloz_hl';fom.edttxt.value=memo.innerText;"><br><br>
<b>Pøihlašovací logovací soubor</b><br>
<input type=submit value="Otevøít" onclick="fom.prikaz.value='nacti_pr';">
<input type=submit value="Uložit" onclick="fom.prikaz.value='uloz_pr';fom.edttxt.value=memo.innerText;"><br><br>
<b>Vstupní logovací soubor</b><br>
<input type=submit value="Otevøít" onclick="fom.prikaz.value='nacti_vs';">
<input type=submit value="Uložit" onclick="fom.prikaz.value='uloz_vs';fom.edttxt.value=memo.innerText;"><br><br>
<b>Nový uživatelé - logovací soubor</b><br>
<input type=submit value="Otevøít" onclick="fom.prikaz.value='nacti_nu';">
<input type=submit value="Uložit" onclick="fom.prikaz.value='uloz_nu';fom.edttxt.value=memo.innerText;"><br><br>
<b>soubor návštìv</b><br>
<input type=submit value="Otevøít" onclick="fom.prikaz.value='nacti_na';">
<input type=submit value="Uložit" onclick="fom.prikaz.value='uloz_na';fom.edttxt.value=memo.innerText;"><br><br>
<b>Poznámky admina</b><br>
<input type=submit value="Otevøít" onclick="fom.prikaz.value='nacti_po';">
<input type=submit value="Uložit" onclick="fom.prikaz.value='uloz_po';fom.edttxt.value=memo.innerText;"><br><br>
<input type=submit value="Smaž Obsah" onclick="fom.memo.innerText='';fom.edttxt.value='';"><br>
<hr>
<input type=text name=emm title="Email" value="..nìèí mejl.." onclick="emm.value='';"><br>
<input type=text name=emp title="Pøedmìt" value="..nìjaký pøedmìt.." onclick="emp.value='';"><br>
<textarea name=emz cols=40 rows=10 title="Zpráva"></textarea><br>
<input type=submit value="Poslat mejl" onclick="fom.prikaz.value='posl_mejl';">
<hr>
<br><a href="navstevni_kniha.php" title="Návštìvy" target=_blank>Prohlídnout obsah návštìv</a>
<br><a href="log_chod.php" title="Logovací soubor" target="_blank">Prohlídnout logovací soubor</a>
<br><a href="log_ost.php" title="Pøihlašovací soubor" target="_blank">Prohlídnout ostatní logovací soubor</a>
<br><a href="now_hes.php" title="Nový uživatelé" target="_blank">Prohlídnout žadatele o zaregistrování</a>
<br><a href="log_vst.php" title="Vstupování na stránky" target="_blank">Kdo a kdy vstoupil na stránky tohoto webu</a>
<br><a href="po_zn_am_ky.php" title="Poznámky" target="_blank">Poznámky</a>
</center>
<input type=hidden name=prikaz>
<input type=hidden name=edttxt>
</form>
