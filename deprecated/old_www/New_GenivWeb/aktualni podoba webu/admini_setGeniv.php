<?
if(!Empty($prikaz))
{
if($prikaz=="nacti_na")
{
print "Editov�na N�v�t�vn� kniha (otev�eno)";
$dot_s="navstevni_kniha.php";
$doss=fopen($dot_s,"r");
$obsah=fread($doss,50000);
fclose($doss);
}//end if nacti

if($prikaz=="uloz_na" and !$edttxt=="")
{
print "Editov�na N�v�t�vn� kniha (ulo�eno)";
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
print "Editov�n hlavn� logovac� soubor (otev�eno)";
$dot_s="log_chod.php";
$doss=fopen($dot_s,"r");
$obsah=fread($doss,50000);
fclose($doss);
}//end if nacti

if($prikaz=="uloz_hl" and !$edttxt=="")
{
print "Editov�na hlavn� logovac� soubor (ulo�eno)";
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
print "Editov�n logovac� soubor p�ihla�ov�n� (otev�eno)";
$dot_s="log_ost.php";
$doss=fopen($dot_s,"r");
$obsah=fread($doss,50000);
fclose($doss);
}//end if nacti

if($prikaz=="uloz_pr" and !$edttxt=="")
{
print "Editov�na logovac� soubor p�ihla�ov�n� (ulo�eno)";
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
print "Editov�n logovac� soubor vstup� (otev�eno)";
$dot_s="log_vst.php";
$doss=fopen($dot_s,"r");
$obsah=fread($doss,50000);
fclose($doss);
}//end if nacti

if($prikaz=="uloz_vs" and !$edttxt=="")
{
print "Editov�n logovac� soubor vstup� (ulo�eno)";
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
print "Editov�n logovac� soubor nov�ch u�ivatel� (otev�eno)";
$dot_s="now_hes.php";
$doss=fopen($dot_s,"r");
$obsah=fread($doss,50000);
fclose($doss);
}//end if nacti

if($prikaz=="uloz_nu" and !$edttxt=="")
{
print "Editov�n logovac� soubor nov�ch u�ivatel� (ulo�eno)";
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
print "Editov�n soubor pozn�mek (otev�eno)";
$dot_s="po_zn_am_ky.php";
$doss=fopen($dot_s,"r");
$obsah=fread($doss,50000);
fclose($doss);
}//end if nacti

if($prikaz=="uloz_po" and !$edttxt=="")
{
print "Editov�n soubor pozn�mek (ulo�eno)";
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
print "Email odesl�n!";
}//end empty
$obsah="";
}//end p��kaz

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

<b>Hlavni logovac� soubor</b><br>
<input type=submit value="Otev��t" onclick="fom.prikaz.value='nacti_hl';">
<input type=submit value="Ulo�it" onclick="fom.prikaz.value='uloz_hl';fom.edttxt.value=memo.innerText;"><br><br>
<b>P�ihla�ovac� logovac� soubor</b><br>
<input type=submit value="Otev��t" onclick="fom.prikaz.value='nacti_pr';">
<input type=submit value="Ulo�it" onclick="fom.prikaz.value='uloz_pr';fom.edttxt.value=memo.innerText;"><br><br>
<b>Vstupn� logovac� soubor</b><br>
<input type=submit value="Otev��t" onclick="fom.prikaz.value='nacti_vs';">
<input type=submit value="Ulo�it" onclick="fom.prikaz.value='uloz_vs';fom.edttxt.value=memo.innerText;"><br><br>
<b>Nov� u�ivatel� - logovac� soubor</b><br>
<input type=submit value="Otev��t" onclick="fom.prikaz.value='nacti_nu';">
<input type=submit value="Ulo�it" onclick="fom.prikaz.value='uloz_nu';fom.edttxt.value=memo.innerText;"><br><br>
<b>soubor n�v�t�v</b><br>
<input type=submit value="Otev��t" onclick="fom.prikaz.value='nacti_na';">
<input type=submit value="Ulo�it" onclick="fom.prikaz.value='uloz_na';fom.edttxt.value=memo.innerText;"><br><br>
<b>Pozn�mky admina</b><br>
<input type=submit value="Otev��t" onclick="fom.prikaz.value='nacti_po';">
<input type=submit value="Ulo�it" onclick="fom.prikaz.value='uloz_po';fom.edttxt.value=memo.innerText;"><br><br>
<input type=submit value="Sma� Obsah" onclick="fom.memo.innerText='';fom.edttxt.value='';"><br>
<hr>
<input type=text name=emm title="Email" value="..n��� mejl.." onclick="emm.value='';"><br>
<input type=text name=emp title="P�edm�t" value="..n�jak� p�edm�t.." onclick="emp.value='';"><br>
<textarea name=emz cols=40 rows=10 title="Zpr�va"></textarea><br>
<input type=submit value="Poslat mejl" onclick="fom.prikaz.value='posl_mejl';">
<hr>
<br><a href="navstevni_kniha.php" title="N�v�t�vy" target=_blank>Prohl�dnout obsah n�v�t�v</a>
<br><a href="log_chod.php" title="Logovac� soubor" target="_blank">Prohl�dnout logovac� soubor</a>
<br><a href="log_ost.php" title="P�ihla�ovac� soubor" target="_blank">Prohl�dnout ostatn� logovac� soubor</a>
<br><a href="now_hes.php" title="Nov� u�ivatel�" target="_blank">Prohl�dnout �adatele o zaregistrov�n�</a>
<br><a href="log_vst.php" title="Vstupov�n� na str�nky" target="_blank">Kdo a kdy vstoupil na str�nky tohoto webu</a>
<br><a href="po_zn_am_ky.php" title="Pozn�mky" target="_blank">Pozn�mky</a>
</center>
<input type=hidden name=prikaz>
<input type=hidden name=edttxt>
</form>
