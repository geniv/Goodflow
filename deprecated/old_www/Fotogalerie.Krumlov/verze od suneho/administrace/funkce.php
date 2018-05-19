<?
//print_r($_SERVER);
//PHPInfo();
//---------------------------------------------------------------------
function DelkaOteviraniSouboru($Kde)
{
$soubr="$Kde/delka_otvira_ni_qpfcmsfiovnapjcosfknvpsskdjcvsfhbvnjmvsfnviosnvoinfmsbv.php";
$u=fopen($soubr,"r");
return fread($u,1000);
fclose($u);
}
//---------------------------------------------------------------------
function DelkaPoleGalerie($Kde)
{
$soubr="$Kde/delka_pole_galerie_qwefgvomcoiriwjnvoinviujowjnrvwejjklponuhgvrtdreqervsdfokjfn.php";
$u=fopen($soubr,"r");
return fread($u,1000);
fclose($u);
}
//---------------------------------------------------------------------
function DelkaPoleFotek($Kde)
{
$soubr="$Kde/delka_pole_fotek_kjhsbdncpoqskpoqkpondbwvoakdnqwqqfvowjvhnsfvijnvjmsvons.php";
$u=fopen($soubr,"r");
return fread($u,1000);
fclose($u);
}
//---------------------------------------------------------------------
function DelkaPoleOdkazu($Kde)
{
$soubr="$Kde/delka_pole_odkaz_psdgvjaoijdiovjhdbjvhhjdbvjhbdvkjdbvkjbjbvjdsbvjbdjhv.php";
$u=fopen($soubr,"r");
return fread($u,1000);
fclose($u);
}
//---------------------------------------------------------------------
function HlavniKonfigurace($Kde,$cislo)
{
$soubr="$Kde/hlavni_konfigurace_oishbvuoihboiuqcouimnijbiuodscvpojvnsifnvkdjjcvclkjsd.php";
$u=fopen($soubr,"r");
$udaj=explode("--KON--",fread($u,DelkaOteviraniSouboru($Kde)));
fclose($u);

return $udaj[$cislo];
}
//---------------------------------------------------------------------
function UlozitKonfiguraci($vyska,$sirka,$radku,$sloupcu)
{
$udaj[0]="<?php";
$udaj[1]=$vyska;
$udaj[2]=$sirka;
$udaj[3]=$radku;
$udaj[4]=$sloupcu;

$soubr="hlavni_konfigurace_oishbvuoihboiuqcouimnijbiuodscvpojvnsifnvkdjjcvclkjsd.php";
$u=fopen($soubr,"w");
fwrite($u,implode($udaj,"--KON--"));
fclose($u);

return "Konfigurace usp�n� ulo�ena <a href=\"index.php?kam=hlavni\">Pokra�uj zde</a>";
}
//---------------------------------------------------------------------
function PristupoveFtpUdaje($Kde,$cislo)
{
$soubr="$Kde/ftp_uda_je_qwwdsffghgklkhjsdoiuvhfvjohpojnikbhvcretwawertzhgjhhsfsjfhbvsfvjhvdcvswdvjfhb.php";
$u=fopen($soubr,"r");
$udaj=explode("--FTP--",fread($u,DelkaOteviraniSouboru($Kde)));
fclose($u);

return $udaj[$cislo];
}
//---------------------------------------------------------------------

/*
function delka_souboru($kde)
{
$soubr="$Kde/obsah_galerii_alcknasdjcnisdjnniudasbvoesdjvsojhnviwruohnboiweunbfvweoiv.php";
$u=fopen($soubr,"r");
return fread($u,1000);
fclose($u);

$u=fopen($nazev,"r");
$udaj=explode("--GAL--",fread($u,DelkaOteviraniSouboru("administrace")));
fclose($u);
}
1:n�zev
2:popis
3:n�zev adres��e
4:datum vytvo�en�

//<?php--FOT--PC023066.JPG--FOT--PC023067.JPG--FOT--PC023068.JPG--FOT--PC023069.JPG--FOT--PC023070.JPG--FOT--PC023071.JPG--FOT--PC023072.JPG--FOT--PC023081.JPG--FOT--PC023082.JPG--FOT--PC023086.JPG--FOT--PC023088.JPG--FOT--PC023093.JPG--FOT--PC023094.JPG--FOT--PC023095.JPG--FOT--PC023096.JPG
*/
//---------------------------------------------------------------------
function ExtrahujKoncovku($Nazev)
{
$c1=explode(".",$Nazev);
return $c1[1];
}
//---------------------------------------------------------------------
function ObrazekFotky($galerie,$miniatura,$slozka,$cislo)
{
$nazev="administrace/foto_{$galerie}_qowiifhnisvjnsofvnisfcnoadihcnidfjnvoiadhviosfjfiweuhnvjsoiddfhnisdvjodfhviujdffvisujhcvqiecnviedjwfnvijwednviuqedfbv.php";
$u=fopen($nazev,"r");
$foto=explode("--FOT--",fread($u,DelkaOteviraniSouboru("administrace")));
fclose($u);

$del1=DelkaPoleFotek("administrace");

if(!Empty($foto[($cislo*$del1)-1]))
{
if(ExtrahujKoncovku($foto[($cislo*$del1)-1])=="jpg")//fotka
{
return
"<table align=\"left\" border=\"1\" cellpadding=\"4\" cellspacing=\"0\" style=\"border-collapse: collapse\" bordercolor=\"#091194\">
<tr>
<td width=\"".HlavniKonfigurace("administrace",1)."px\">
<a href=\"$slozka/{$foto[($cislo*$del1)-1]}\" target=\"_blank\"><center><img src=\"$miniatura/{$foto[($cislo*$del1)-2]}\" border=\"0\"></a></center><span class=\"f12\">{$foto[($cislo*$del1)]}</span>
</td>
</tr>
</table>";
}
else//p��loha
{
return
"<table align=\"left\" border=\"1\" cellpadding=\"4\" cellspacing=\"0\" style=\"border-collapse: collapse\" bordercolor=\"#091194\">
<tr>
<td width=\"".HlavniKonfigurace("administrace",1)."px\">
<center><img src=\"$miniatura/{$foto[($cislo*$del1)-2]}\" border=\"0\"></center><span class=\"f12\">{$foto[($cislo*$del1)]}</span>
</td>
</tr>
</table>";
}
}
else
{return "";}
}
//---------------------------------------------------------------------
function PocetFotek($Cislo,$Kde,$ciselne)//mus� existovat soubor!!
{
$nazev="$Kde/foto_{$Cislo}_qowiifhnisvjnsofvnisfcnoadihcnidfjnvoiadhviosfjfiweuhnvjsoiddfhnisdvjodfhviujdffvisujhcvqiecnviedjwfnvijwednviuqedfbv.php";
$u=fopen($nazev,"r");
$foto=explode("--FOT--",fread($u,DelkaOteviraniSouboru($Kde)));
fclose($u);

$del1=DelkaPoleFotek($Kde);

if($ciselne=="true")
{return (count($foto)-1)/$del1;}
else
{
if((count($foto)-1)!=0)
{return (count($foto)-1)/$del1;}
else
{return "Pr�zdn� galerie";}
}
}
//---------------------------------------------------------------------
function jdinastranu($stranka,$cislo,$pocet_stran,$sekce) 
{ 
$dalstr=$stranka+1; 
$predstr=$stranka-1; 
if($pocet_stran<6) 
{ 
if($stranka>1) 
{$pred="( <a href=\"index.php?kam=$sekce&cis=$cislo&str=$predstr\" class=\"odkaz\">P�edchoz�</a> ) ";} 
else 
{$pred="";} 
 
$zc=""; 
for($i=1;$i<=$pocet_stran;$i++) 
{ 
if($i!=$pocet_stran) 
{ 
if($i==$stranka)//ru�� a href 
{$zc.="$i, ";}//za��tek 
else 
{$zc.="<a href=\"index.php?kam=$sekce&cis=$cislo&str=$i\"><u>$i</u></a>, ";} 
} 
else 
{ 
if($pocet_stran==$stranka)//dohl�� na dal�� 
{$kn="$i";}//konec 
else 
{$kn="<a href=\"index.php?kam=$sekce&cis=$cislo&str=$i\"><u>$i</u></a> ( <a href=\"index.php?kam=$sekce&cis=$cislo&str=$dalstr\" class=\"odkaz\">Dal��</a> )";} 
} 
}//end for 
 
return "Jdi na str�nku: {$pred}{$zc}{$kn}"; 
} 
else 
{ 
$str2=$stranka+1; 
$str3=$stranka+2; 
$str4=$pocet_stran-1; 
$str5=$pocet_stran-2; 
 
if($stranka>1) 
{$pred1="( <a href=\"index.php?kam=$sekce&cis=$cislo&str=$predstr\" class=\"odkaz\">P�edchoz�</a> ) <a href=\"index.php?kam=$sekce&cis=$cislo&str=1\"><u>1</u></a> ... ";} 
else 
{$pred1="";} 
 
if($stranka<$pocet_stran-2) 
{ 
if($pocet_stran==1) 
{$zc1=$stranka;} 
else 
{$zc1="";} 
 
if($pocet_stran==2) 
{$zc1="$stranka, <a href=\"index.php?kam=$sekce&cis=$cislo&str=$str2\"><u>$str2</u></a>";} 
else 
{$zc1="";} 
 
if($pocet_stran>3) 
{$zc1=" $stranka, <a href=\"index.php?kam=$sekce&cis=$cislo&str=$str2\"><u>$str2</u></a>, <a href=\"index.php?kam=$sekce&cis=$cislo&str=$str3\"><u>$str3</u></a>";} 
else 
{$zc1="";} 
 
if($pocet_stran-2==$stranka)//dohl�� na dal�� 
{$kn1="";}//konec 
else 
{$kn1=" ... <a href=\"index.php?kam=$sekce&cis=$cislo&str=$pocet_stran\"><u>$pocet_stran</u></a> ( <a href=\"index.php?kam=$sekce&cis=$cislo&str=$dalstr\" class=\"odkaz\">Dal��</a> )";} 
 
} 
else 
{ 
if($stranka==$str5) 
{$zc1="$str5, <a href=\"index.php?kam=$sekce&cis=$cislo&str=$str4\"><u>$str4</u></a>, <a href=\"index.php?kam=$sekce&cis=$cislo&str=$pocet_stran\"><u>$pocet_stran</u></a> ( <a href=\"index.php?kam=$sekce&cis=$cislo&str=$dalstr\" class=\"odkaz\">Dal��</a> )";} 
 
if($stranka==$str4) 
{$zc1="<a href=\"index.php?kam=$sekce&cis=$cislo&str=$str5\"><u>$str5</u></a>, $str4, <a href=\"index.php?kam=$sekce&cis=$cislo&str=$pocet_stran\"><u>$pocet_stran</u></a> ( <a href=\"index.php?kam=$sekce&cis=$cislo&str=$dalstr\" class=\"odkaz\">Dal��</a> )";} 
 
if($pocet_stran==$stranka) 
{$zc1="<a href=\"index.php?kam=$sekce&cis=$cislo&str=$str5\"><u>$str5</u></a>, <a href=\"index.php?kam=$sekce&cis=$cislo&str=$str4\"><u>$str4</u></a>, $pocet_stran";} 
 
$kn1=""; 
} 
return "Jdi na str�nku: {$pred1}{$zc1}{$kn1}"; 
}//... 
}
//---------------------------------------------------------------------
function LoginDoAdminu($Jmeno,$Heslo)
{
$nazev="administrace/pri_udj_uzv_qpwjfibvoisussijvasdfiovbohbjodbfvkjjnskkjcjnksjdnc.php";
$u=fopen($nazev,"r");
$udaj=explode("--PR--",fread($u,DelkaOteviraniSouboru("administrace")));
fclose($u);

$poc=0;
for($i=1;$i<count($udaj);$i++)
{
if($udaj[$i]==$Jmeno and $udaj[$i+1]==$Heslo){$poc++;}
}//end for

if($poc!=0)
{return "<a href=\"administrace\" class=\"odkaz\">Vstoupit</a>";}
else
{return "Nepovolen� p��stup";}

}
//---------------------------------------------------------------------
function LoginAdmin($Jmeno,$Heslo,$Kde)
{
$nazev="$Kde/pri_udj_uzv_qpwjfibvoisussijvasdfiovbohbjodbfvkjjnskkjcjnksjdnc.php";
$u=fopen($nazev,"r");
$udaj=explode("--PR--",fread($u,DelkaOteviraniSouboru($Kde)));
fclose($u);

$poc=0;
for($i=1;$i<count($udaj);$i++)
{
if($udaj[$i]==$Jmeno and $udaj[$i+1]==$Heslo){$poc++;}
}//end for

if($poc!=0)
{return "true";}
else
{return "false";}
}
//---------------------------------------------------------------------
function ZmenseniObrazku($Slozka,$Nazev,$ZdrojObrazku,$Sirka,$Vyska)
{
//var_dump($Slozka,$Nazev,$ZdrojObrazku,$Sirka,$Vyska);
$soubor="$Slozka/$Nazev";
$novy="$Slozka/miniatury/nahled_{$Nazev}";
$vel=GetImageSize($soubor);
$quality=100;
$zdroj=imagecreatefromjpeg($soubor);
$cil=imagecreatetruecolor($Sirka,$Vyska);
imagecopyresized($cil,$zdroj,0,0,0,0,$Sirka,$Vyska,$vel[0],$vel[1]);
imageJPEG($cil,$novy,$quality);
ImageDestroy($zdroj);
ImageDestroy($cil);
}
//---------------------------------------------------------------------
/*
function VytvorAdresar($Jmeno)//mus� b�t p�es FPT!!!!
{
if(ftp_mkdir($conn_id,$Jmeno)=="true")//prvn� hlavn� slo�ku
{
if(ftp_mkdir($conn_id,"$Jmeno/miniatury")=="true")//pak podslo�ku
{return "Adres�� �sp�n� vytvo�en!";}
else
{return "Nepoda�ilo se vytvo�it adres��! (Mo�n� p��stupov� pr�va na FTP)";}//kdy� sel�e i druh�
}
else
{return "Nepoda�ilo se vytvo�it adres��! (Mo�n� p��stupov� pr�va na FTP)";}//kdy� sel�e prvn�
}
//---------------------------------------------------------------------
function SmazAdresar($Jmeno)//do�asn�!!! mus� b�t p�es FPT!!!!
{
if(rmdir("$Jmeno/miniatury")=="true")
{
if(rmdir($Jmeno)=="true")
{return "Adres�� �sp�n� smaz�n!";}
else
{return "Nepoda�ilo se smazat adres��! (Mo�n� p��stupov� pr�va na FTP)";}
}
else
{return "Nepoda�ilo se smazat adres��! (Mo�n� p��stupov� pr�va na FTP)";}
}
*/
//---------------------------------------------------------------------
function VygenerujNazev()
{
$poc=0;
for($i=0;$i<10;$i++)
{
$poc.=rand(10,50000);
}//end for
return $poc;
}
//---------------------------------------------------------------------
function VygenerujMalyNazev()
{
$poc=0;
for($i=0;$i<5;$i++)
{
$poc.=rand(1,500);
}//end for
return $poc;
}
//---------------------------------------------------------------------
function VygenerujNazevObrazku($Typ)
{
switch($Typ)
{
case 1:{$konc=".gif";break;}
case 2:{$konc=".jpg";break;}
case 3:{$konc=".png";break;}
case 4:{$konc=".swf";break;}
case 5:{$konc=".psd";break;}
case 6:{$konc=".bmp";break;}
case 7:{$konc=".tiff";break;}
case 8:{$konc=".tiff";break;}
case 9:{$konc=".jpc";break;}
case 10:{$konc=".jp2";break;}
case 11:{$konc=".jpx";break;}
}

$poc=0;
for($i=1;$i<10;$i++)
{
$poc.=rand(5,50000);
}//end for
return "{$poc}{$konc}";
}
//---------------------------------------------------------------------
//---------------------------------------------------------------------
function ExtrahujNazevZOdkazu($odkaz)
{
$c1=explode("<",$odkaz);
$c2=explode("\"",$c1[1]);
return $c2[1];
}
//---------------------------------------------------------------------
function PridatGalerii($Nazev,$Popis,$NazevSlozky)
{
$soubor="obsah_galerii_alcknasdjcnisdjnniudasbvoesdjvsojhnviwruohnboiweunbfvweoiv.php";
$u=fopen($soubor,"r");
$udaj=explode("--GAL--",fread($u,DelkaOteviraniSouboru(".")));
fclose($u);

$del=DelkaPoleGalerie(".");

$poc=0;
for($i=1;$i<count($udaj)-1;$i++)//kontrola opakov�n�
{
if($udaj[$i]==$Nazev){$poc++;}
}//end for

if($poc==0)
{//n�zev p��mo v p�idat..
$cislo=((count($udaj)-1)/$del)+1;
$udaj[count($udaj)+1]=$Nazev;
$udaj[count($udaj)+2]=$Popis;
$udaj[count($udaj)+3]=$NazevSlozky;
$udaj[count($udaj)+4]=Date("j.n. Y");

$udaj[0]="<?php";//ochrana
$u=fopen($soubor,"w");
fwrite($u,implode($udaj,"--GAL--"));
fclose($u);

//do administrace
$soubor="foto_{$cislo}_qowiifhnisvjnsofvnisfcnoadihcnidfjnvoiadhviosfjfiweuhnvjsoiddfhnisdvjodfhviujdffvisujhcvqiecnviedjwfnvijwednviuqedfbv.php";
$u=fopen($soubor,"w");
fwrite($u,"<?php");
fclose($u);
/*
//vytvo�� pr�zdn� index.php
$soubor="../$NazevSlozky/index.php";//ochrana proti prohl�en�
$u=fopen($soubor,"w");
fwrite($u,"<?php");
fclose($u);

$soubor="../$NazevSlozky/miniatury/index.php";//ochrana proti prohl�en�
$u=fopen($soubor,"w");
fwrite($u,"<?php");
fclose($u);
*/
return "Galerie s n�zvem: <b>$Nazev</b>, po�adov�m ��slem: $cislo byla �sp�n� vytvo�ena! <a href=\"index.php?kam=pridat_galerii\">Pokra�uj zde</a>";
}
else
{return "N�zev: <b>$Nazev</b> ji� existuje! <a href=\"index.php?kam=pridat_galerii\">Pokra�uj zde</a>";}
}
//---------------------------------------------------------------------
function UpravitGalerii($Nazev,$Popis,$Slozka,$Datum,$Cislo)
{
$soubor="obsah_galerii_alcknasdjcnisdjnniudasbvoesdjvsojhnviwruohnboiweunbfvweoiv.php";
$u=fopen($soubor,"r");
$udaj=explode("--GAL--",fread($u,DelkaOteviraniSouboru(".")));
fclose($u);

$del=DelkaPoleGalerie(".");

$udaj[0]="<?php";//ochrana
$udaj[($Cislo*$del)-3]=$Nazev;
$udaj[($Cislo*$del)-2]=$Popis;
$udaj[($Cislo*$del)-1]=$Slozka;
$udaj[($Cislo*$del)]=$Datum;

$u=fopen($soubor,"w");
fwrite($u,implode($udaj,"--GAL--"));
fclose($u);

return "Galerie: <b>$Nazev</b> byla �sp�n� upravena! <a href=\"index.php?kam=upravit_galerii\">Pokra�uj zde</a>";
}
//---------------------------------------------------------------------
function SmazatGalerii($cislo)
{
$soubor="obsah_galerii_alcknasdjcnisdjnniudasbvoesdjvsojhnviwruohnboiweunbfvweoiv.php";
$u=fopen($soubor,"r");
$udaj=explode("--GAL--",fread($u,DelkaOteviraniSouboru(".")));
fclose($u);

$del=DelkaPoleGalerie(".");
$pz=($cislo*$del)-($del-1);
$nazev=$udaj[($cislo*$del)-3];
$slozka=$udaj[($cislo*$del)-1];

$poc=0;
$nove[]="";
for($i=1;$i<$pz;$i++)//1 ze 2
{
$poc++;
$nove[$poc]=$udaj[$i];
}//end for

for($i1=$pz+$del;$i1<count($udaj);$i1++)//2 ze 2
{
$poc++;
$nove[$poc]=$udaj[$i1];
}//end for

/*
mus� b�t p�es FTP!!!!
sma�e soubor: ftp_delete ( resource ftp_stream, string path)
vytvo�� Dir: ftp_mkdir ( resource ftp_stream, string directory)
sma�e Dir: ftp_rmdir ( resource ftp_stream, string directory)

unlink("foto_{$cislo}_qowiifhnisvjnsofvnisfcnoadihcnidfjnvoiadhviosfjfiweuhnvjsoiddfhnisdvjodfhviujdffvisujhcvqiecnviedjwfnvijwednviuqedfbv.php");//do�asn�!!
unlink("../$slozka/miniatury/index.php");//do�asn�!!
unlink("../$slozka/index.php");//do�asn�!!
SmazAdresar("../$slozka");//do�asn�!!
*/
//----------------------------------------------
//p�ejmenov�n� soubor�
$poc=0;
for($i=1;$i<count($udaj)/$del;$i++)
{
$nov="foto_{$i}_qowiifhnisvjnsofvnisfcnoadihcnidfjnvoiadhviosfjfiweuhnvjsoiddfhnisdvjodfhviujdffvisujhcvqiecnviedjwfnvijwednviuqedfbv.php";
$str="foto_{$i}_qowiifhnisvjnsofvnisfcnoadihcnidfjnvoiadhviosfjfiweuhnvjsoiddfhnisdvjodfhviujdffvisujhcvqiecnviedjwfnvijwednviuqedfbv.php";

if($cislo==$i)
{
for($i1=$i;$i1<(count($udaj)/$del)-1;$i1++)
{
$poc=$i1+1;
$str="foto_{$poc}_qowiifhnisvjnsofvnisfcnoadihcnidfjnvoiadhviosfjfiweuhnvjsoiddfhnisdvjodfhviujdffvisujhcvqiecnviedjwfnvijwednviuqedfbv.php";
$nov="foto_{$i1}_qowiifhnisvjnsofvnisfcnoadihcnidfjnvoiadhviosfjfiweuhnvjsoiddfhnisdvjodfhviujdffvisujhcvqiecnviedjwfnvijwednviuqedfbv.php";
rename($str,$nov);
}//end for
}//end if cislo==i
}//end for
//----------------------------------------------
$nove[0]="<?php";//ochrana
$u=fopen($soubor,"w");
fwrite($u,implode($nove,"--GAL--"));
fclose($u);

/*
smazat:
foto_{$cislo}_qowiifh...
index.php-galerie
index.php-galerie-miniatury
slo�ku miniatury
slo�ku galerie
....mus� b�t bez fotek!!
*/

return "Galerie: <b>$nazev</b> byly �sp�n� smaz�na! <a href=\"index.php?kam=smazat_galerii\">Pokra�uj zde</a>";
}
//---------------------------------------------------------------------
function PridatObrazek($galerie,$slozka,$nazev,$fotka,$komentar)
{
$soubor="foto_{$galerie}_qowiifhnisvjnsofvnisfcnoadihcnidfjnvoiadhviosfjfiweuhnvjsoiddfhnisdvjodfhviujdffvisujhcvqiecnviedjwfnvijwednviuqedfbv.php";
$u=fopen($soubor,"r");
$udaj=explode("--FOT--",fread($u,DelkaOteviraniSouboru(".")));
fclose($u);

$udaj[0]="<?php";//ochrana
$udaj[count($udaj)+1]="nahled_{$nazev}";
$udaj[count($udaj)+2]=$nazev;
$udaj[count($udaj)+3]=$komentar;

$u=fopen($soubor,"w");
fwrite($u,implode($udaj,"--FOT--"));
fclose($u);

$sirka=HlavniKonfigurace(".",1);
$vyska=HlavniKonfigurace(".",2);
ZmenseniObrazku($slozka,$nazev,$fotka,$sirka,$vyska);

return "Fotka <b>$nazev</b> byla �sp�n� p�id�na! <a href=\"index.php?kam=pridat_obrazek&galerie=$galerie\">Pokra�uj zde</a>";
}
//---------------------------------------------------------------------
function ZjistiTypAVyberObr($Nazev)
{
$c1=explode(".",$Nazev);

switch(strtolower($c1[1]))//v�b�r a konvert na mal�
{
case "cdp":$typ="../administrace/cdp.png";
break;
case "htm":$typ="../administrace/htm_html_php.png";
break;
case "html":$typ="../administrace/htm_html_php.png";
break;
case "rar":$typ="../administrace/rar_zip.png";
break;
case "zip":$typ="../administrace/rar_zip.png";
break;
case "txt":$typ="../administrace/txt.png";
break;
case "gif":$typ="../administrace/gif.png";
break;
case "png":$typ="../administrace/png.png";
break;
case "tiff":$typ="../administrace/tiff.png";
break;
case "psd":$typ="../administrace/psd.png";
break;
case "bmp":$typ="../administrace/bmp.png";
break;
case "jpg":$typ="../administrace/jpg_jpeg.png";
break;
case "jpeg":$typ="../administrace/jpg_jpeg.png";
break;
case "tga":$typ="../administrace/tga.png";
break;
case "exe":$typ="../administrace/exe_msi.png";
break;
case "msi":$typ="../administrace/exe_msi.png";
break;
case "mp3":$typ="../administrace/mp3_wav_mid.png";
break;
case "wav":$typ="../administrace/mp3_wav_mid.png";
break;
case "mid":$typ="../administrace/mp3_wav_mid.png";
break;
case "xls":$typ="../administrace/xls.png";
break;
case "doc":$typ="../administrace/doc.png";
break;

default:$typ="../administrace/neznamy.png";
}

return $typ;
}
//---------------------------------------------------------------------
function PridejKomentar($galerie,$nazev)
{
$soubor="foto_{$galerie}_qowiifhnisvjnsofvnisfcnoadihcnidfjnvoiadhviosfjfiweuhnvjsoiddfhnisdvjodfhviujdffvisujhcvqiecnviedjwfnvijwednviuqedfbv.php";
$u=fopen($soubor,"r");
$udaj=explode("--FOT--",fread($u,DelkaOteviraniSouboru(".")));
fclose($u);

//$koncovka=explode(".",$priloha);
//$nazev="$slozka/".VygenerujNazev().".".$koncovka[count($koncovka)-1];

$komentar="<center><a href=\"$nazev\" target=\"_blank\" class=\"odkaz\">Download</a></center>";
$obr=ZjistiTypAVyberObr($nazev);


$udaj[0]="<?php";//ochrana
$udaj[count($udaj)+1]="../../$obr";//nahled
$udaj[count($udaj)+2]=$obr;//obr�zek - to je jedno
$udaj[count($udaj)+3]=stripslashes($komentar);

$u=fopen($soubor,"w");
fwrite($u,implode($udaj,"--FOT--"));
fclose($u);

return "Soubor <b>$nazev</b> byl usp�n� ulo�en <a href=\"index.php?kam=pridat_obrazek&galerie=$galerie\">Pokra�uj zde</a>";
}
//---------------------------------------------------------------------
function UpravitObrazek($cislo,$galerie,$nahled,$nazev,$komentar)
{
$soubor="foto_{$galerie}_qowiifhnisvjnsofvnisfcnoadihcnidfjnvoiadhviosfjfiweuhnvjsoiddfhnisdvjodfhviujdffvisujhcvqiecnviedjwfnvijwednviuqedfbv.php";
$u=fopen($soubor,"r");
$udaj=explode("--FOT--",fread($u,DelkaOteviraniSouboru(".")));
fclose($u);

$del1=DelkaPoleFotek(".");

$udaj[0]="<?php";//ochrana
$udaj[($cislo*$del1)-2]=$nahled;
$udaj[($cislo*$del1)-1]=$nazev;
$udaj[($cislo*$del1)]=$komentar;

$u=fopen($soubor,"w");
fwrite($u,implode($udaj,"--FOT--"));
fclose($u);

return "Koment�� fotky: <b>$nazev</b> byl �sp�n� upraven! <a href=\"index.php?kam=upravit_obrazek&galerie=$galerie\">Pokra�uj zde</a>";
}
//---------------------------------------------------------------------
function SmazatObrazek($cislo,$galerie)
{
$soubor="foto_{$galerie}_qowiifhnisvjnsofvnisfcnoadihcnidfjnvoiadhviosfjfiweuhnvjsoiddfhnisdvjodfhviujdffvisujhcvqiecnviedjwfnvijwednviuqedfbv.php";
$u=fopen($soubor,"r");
$udaj=explode("--FOT--",fread($u,DelkaOteviraniSouboru(".")));
fclose($u);

$del=DelkaPoleFotek(".");
$pz=($cislo*$del)-($del-1);
$nazev=$udaj[($cislo*$del)-1];

$poc=0;
$nove[]="";
for($i=1;$i<$pz;$i++)//1 ze 2
{
$poc++;
$nove[$poc]=$udaj[$i];
}//end for

for($i1=$pz+$del;$i1<count($udaj);$i1++)//2 ze 2
{
$poc++;
$nove[$poc]=$udaj[$i1];
}//end for

$nove[0]="<?php";//ochrana


$u=fopen($soubor,"w");
fwrite($u,implode($nove,"--FOT--"));
fclose($u);

//---------------do�asn� �e�en� (ftp delete!)------------------
$soubor="obsah_galerii_alcknasdjcnisdjnniudasbvoesdjvsojhnviwruohnboiweunbfvweoiv.php";
$u=fopen($soubor,"r");
$gal=explode("--GAL--",fread($u,DelkaOteviraniSouboru(".")));
fclose($u);

$del1=DelkaPoleGalerie(".");

//"../{$udaj[($galerie*$del)-1]}/miniatury/nahled_{$foto[$i]}"

return "Fotka: <b>$nazev</b> byla smaz�na! <a href=\"index.php?kam=smazat_obrazek&galerie=$galerie\">Pokra�uj zde</a>";
}
//---------------------------------------------------------------------
function PridatOdkaz($Popis,$Link)
{
$soubor="odkazy_poiucvcdskjhvkjvbsijhvjkvnjkhjfosibvdhfbhjvdhgvjydbvjhdbvjdsbvjhdsbvhjsdbvhjsdbvvlkanhsbvshvuvuifubghsjbshvs.php";
$u=fopen($soubor,"r");
$udaj=explode("--ODK--",fread($u,DelkaOteviraniSouboru(".")));
fclose($u);

$udaj[0]="<?php";//ochrana
$udaj[count($udaj)+1]=$Popis;//dodat n�jak� obr�zek
$udaj[count($udaj)+2]=$Link;

$u=fopen($soubor,"w");
fwrite($u,implode($udaj,"--ODK--"));
fclose($u);

return "Odkaz <a href=\"$Link\" target=\"_blank\">$Popis</a> byl usp�n� ulo�en <a href=\"index.php?kam=pridat_odkaz\">Pokra�uj zde</a>";
}
//---------------------------------------------------------------------
function UpravitOdkaz($Cislo,$Popis,$Link)
{
$soubor="odkazy_poiucvcdskjhvkjvbsijhvjkvnjkhjfosibvdhfbhjvdhgvjydbvjhdbvjdsbvjhdsbvhjsdbvhjsdbvvlkanhsbvshvuvuifubghsjbshvs.php";
$u=fopen($soubor,"r");
$udaj=explode("--ODK--",fread($u,DelkaOteviraniSouboru(".")));
fclose($u);

$del=DelkaPoleOdkazu(".");

$udaj[0]="<?php";//ochrana
$udaj[($Cislo*$del)-1]=$Popis;
$udaj[($Cislo*$del)]=$Link;

$u=fopen($soubor,"w");
fwrite($u,implode($udaj,"--ODK--"));
fclose($u);

return "Odkaz <a href=\"$Link\" target=\"_blank\">$Popis</a> byl �sp�n� upraven! <a href=\"index.php?kam=upravit_odkaz\">Pokra�uj zde</a>";
}
//---------------------------------------------------------------------
function SmazatOdkaz($Cislo)
{
$soubor="odkazy_poiucvcdskjhvkjvbsijhvjkvnjkhjfosibvdhfbhjvdhgvjydbvjhdbvjdsbvjhdsbvhjsdbvhjsdbvvlkanhsbvshvuvuifubghsjbshvs.php";
$u=fopen($soubor,"r");
$udaj=explode("--ODK--",fread($u,DelkaOteviraniSouboru(".")));
fclose($u);

$del=DelkaPoleOdkazu(".");
$pz=($Cislo*$del)-($del-1);
$nazev=$udaj[($Cislo*$del)-1];
$link=$udaj[($Cislo*$del)];

$poc=0;
$nove[]="";
for($i=1;$i<$pz;$i++)//1 ze 2
{
$poc++;
$nove[$poc]=$udaj[$i];
}//end for

for($i1=$pz+$del;$i1<count($udaj);$i1++)//2 ze 2
{
$poc++;
$nove[$poc]=$udaj[$i1];
}//end for

$nove[0]="<?php";//ochrana
$u=fopen($soubor,"w");
fwrite($u,implode($nove,"--ODK--"));
fclose($u);

return "Odkaz <a href=\"$link\" target=\"_blank\">$nazev</a> byla smaz�na! <a href=\"index.php?kam=smazat_odkaz\">Pokra�uj zde</a>";
}
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//---------------------------------------------------------------------

/*
if(!Empty($pro) and $pro=="del" and !Empty($cislo))
{
$ftp_server="cz-sk-trainz-tutorial.ic.cz";
$ftp_user_name="cz-sk-trainz-tutorial";
$ftp_user_pass="3Dgtutczskftp";
$conn_id=ftp_ssl_connect($ftp_server);
$login_result=ftp_login($conn_id,$ftp_user_name,$ftp_user_pass);//mus�
ftp_delete($conn_id,$odk[($cislo*$del)-7]);
ftp_close($conn_id);
print smazat_navod($cislo);
}


*/
//---------------------------------------------------------------------
function pocet_souboru($cesta)
{
$handle=opendir($cesta);
$poc=0;
while($soub=readdir($handle))
{
$poc+=1;
}
closedir($handle);

return $poc-2;
}
//---------------------------------------------------------------------
function velikost_adresare($jmeno,$koncovka)
{

if (!File_Exists($jmeno)) return 0;

$handle=opendir($jmeno);
$vel=0;
while($soub=readdir($handle))
{
$vel+=filesize("$jmeno/$soub");
}
closedir($handle);

if($koncovka=="true")
{
if($vel>=1048576)
{return sprintf("%.2f&nbsp;MB",round($vel/1048576*100)/100);}
else
if($vel>=1024)
{return sprintf("%.2f&nbsp;KB",round($vel/1024*100)/100);}
else
{return sprintf("%.2f&nbsp;Bytes",$vel);}
}
else//else koncovka
{return $vel;}
}
//---------------------------------------------------------------------
function velikost_stranek()
{
$vs[0]=velikost_adresare(".",false);//admin
$vs[1]=velikost_adresare("../",false);//ko�en
$vs[2]=velikost_adresare("../img",false);//obr
$vs[3]=velikost_adresare("../Upload",false);//upload

$soubor="obsah_galerii_alcknasdjcnisdjnniudasbvoesdjvsojhnviwruohnboiweunbfvweoiv.php";
$u=fopen($soubor,"r");
$udaj=explode("--GAL--",fread($u,DelkaOteviraniSouboru(".")));
fclose($u);

$del=DelkaPoleGalerie(".");

$zak=4;
for($i=1;$i<((count($udaj)-1)/$del)+1;$i++)
{
$vs[$zak]=velikost_adresare("../{$udaj[($i*$del)-1]}",false);//origin�l
$vs[$zak+1]=velikost_adresare("../{$udaj[($i*$del)-1]}/miniatury",false);//mini
$zak+=2;
}

$vel=0;
for($i=0;$i<count($vs);$i++)
{
$vel+=$vs[$i];
}//end for

if($vel>=1048576)
{return sprintf("%.2f&nbsp;MB",$vel/1048576);}
else
if($vel>=1024)
{return sprintf("%.2f&nbsp;KB",$vel/1024);}
else
{return sprintf("%.2f&nbsp;Bytes",$vel);}
}
//---------------------------------------------------------------------
function VelikostGalerie($Cesta)
{
$vs[0]=velikost_adresare("../$Cesta/miniatury",false);
$vs[1]=velikost_adresare("../$Cesta",false);

$vel=$vs[0]+$vs[1];

if($vel>=1048576)
{return sprintf("%.2f&nbsp;MB",$vel/1048576);}
else
if($vel>=1024)
{return sprintf("%.2f&nbsp;KB",$vel/1024);}
else
{return sprintf("%.2f&nbsp;Bytes",$vel);}
}
//---------------------------------------------------------------------
function DostaveniDelkyOtvirani($info)//auto kontrola d�lky
{
$delka=DelkaOteviraniSouboru(".");

$soubor="odkazy_poiucvcdskjhvkjvbsijhvjkvnjkhjfosibvdhfbhjvdhgvjydbvjhdbvjdsbvjhdsbvhjsdbvhjsdbvvlkanhsbvshvuvuifubghsjbshvs.php";
$u=fopen($soubor,"r");
$odkaz=fread($u,$delka);
fclose($u);

$soub="obsah_galerii_alcknasdjcnisdjnniudasbvoesdjvsojhnviwruohnboiweunbfvweoiv.php";
$u=fopen($soub,"r");
$gal_pole=explode("--GAL--",fread($u,$delka));
fclose($u);

$u=fopen($soub,"r");
$gal=fread($u,$delka);
fclose($u);

$dl=DelkaPoleGalerie(".");

$min=500;//minim�ln� rozd�l
$plus=500;//p����tat p�i poklesu

$poc=0;
for($i=1;$i<((count($gal_pole)-1)/$dl)+1;$i++)
{
$soub="foto_{$i}_qowiifhnisvjnsofvnisfcnoadihcnidfjnvoiadhviosfjfiweuhnvjsoiddfhnisdvjodfhviujdffvisujhcvqiecnviedjwfnvijwednviuqedfbv.php";
$u=fopen($soub,"r");
$fot[$i]=strlen(fread($u,$delka))+2;
fclose($u);
if($delka-$fot[$i]<$min){$poc++;}
}

if($poc!=0)
{$pridej="true";}
else
{$pridej="false";}

if($delka-(strlen($gal)+2)<$min or $pridej=="true" or $delka-(strlen($odkaz)+2)<$min)
{
$del=$delka+$plus;
$soub="delka_otvira_ni_qpfcmsfiovnapjcosfknvpsskdjcvsfhbvnjmvsfnviosnvoinfmsbv.php";
$u=fopen($soub,"w");
fwrite($u,$del);
fclose($u);
}

if($info="true")
{
$cast[1]="<table cellpadding=\"6\" cellspacing=\"0\" border=\"1\" style=\"border-collapse: collapse\" bordercolor=\"#091194\">
<tr>
<td>D�lka obsahu galerie:</td>
<td><b>".(strlen($gal)+2)."</b></td>
</tr>

<tr>
<td>Rozd�l obsahu galerie:</td>
<td><b>".($delka-(strlen($gal)+2))."</b></td>
</tr>

<tr>
<td>D�lka obsahu odkaz�:</td>
<td><b>".(strlen($odkaz)+2)."</b></td>
</tr>

<tr>
<td>Rozd�l obsahu odkaz�:</td>
<td><b>".($delka-(strlen($odkaz)+2))."</b></td>
</tr>";

$cast[2]="";
for($i=1;$i<((count($gal_pole)-1)/$dl)+1;$i++)
{
$cast[2].="<tr>
<td>D�lka fotogalerie <b>{$gal_pole[($i*$dl)-3]}</b>:</td>
<td><b>{$fot[$i]}</b></td>
</tr>

<tr>
<td>Rozd�l d�lky fotogalerie <b>{$gal_pole[($i*$dl)-3]}</b>:</td>
<td><b>".($delka-$fot[$i])."</b></td>
</tr>";
}//end for

$cast[3]="<tr>
<td>D�lka otev�r�n� soubor�:</td>
<td><b>$delka</b></td>
</tr>

<tr>
<td>Nastaven� minimum rozd�lu:</td>
<td>$min</td>
</tr>

<tr>
<td>Nastaven� p�i��t�n� p�i poklesu pod minimum:</td>
<td>$plus</td>
</tr>

<tr>
<td>Velikost str�nek:</td>
<td>".velikost_stranek()."</td>
</tr>

<tr>
<td>Velikost intern�ho uploadu: </td>
<td>".velikost_adresare("../Upload",true)."</td>
</tr>
</table>";

return "{$cast[1]}{$cast[2]}{$cast[3]}";
}
else
{
return "";
}

}
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//---------------------------------------------------------------------

?>
