<?
$sou_ban="ban_weicuweiuvhoihnqpodwkjvnsjfnbvnqwiufehwiujefgvizuddkjsfh.php";
$u=fopen($sou_ban,"r");
$ban=explode("*--ban--*",fread($u,10000));
fclose($u);
for($p=0;$p<count($ban);$p++)
{
if($ban[$p]==$REMOTE_ADDR)
 { print "<br><br><br><br><br><h2 align=center>Na tyto str�nky m�te z�kaz vstupu!!</h2>";
 exit;}
}
?>
Provozuji programovac� jazyky: <b>Object Pascal , Html, Java Script, PHP, C++, Max script a Assembler</b><br>
Kdy� to tak vezmu tak Pascal m� u� sv� dny sl�vy za sebou, tak� na n�m firma Borland dob�e vyd�lala a
jej� kompil�tor Pascalu se stal i z�kladem pro object pascal (tedy grafick� verze pascalu) zn�m� sp�e
pod n�zvem Delphi. To je vlastn� novodob� n�drada stareho pascalu. Mezi za��naj�c�mi program�tory je Delphi
pom�rn� obl�ben� proto�e je jednoduch�. Samozd�ejm� kdy� zn�te tro�i�ku alespo� styl z�pisu.<br>
<hr>
<b><u>N�kolik program� na st�hnut�: (Z Delphi 6)</u></b><br>
<ul type=square>
<li><img src="new.gif"><input type=image src="jedn.gif" onclick="location.href='Prepocet.rar';"> �ikovn� progr�mek pro v�po�et hodnot p�i bytov�m p��stupu na br�ny u MCU AT...</li>
<li><input type=image src="blok.gif" onclick="location.href='notespad.rar';"> Je to eqivalent Notepadu z Win XP, kdo nem� Win XP nebo 2000 tak jej ocen�.</li>
<li><input type=image src="bat.gif" onclick="location.href='NBBaterie.rar';"> Tohle je programek pro zji�t�n� aktu�ln�ho stavu baterie.</li>
<li><input type=image src="bud.gif" onclick="location.href='Budik.rar';"> Takov� mal� di�� pro zaznamen�v�n� va��ch pozn�mek.</li>
<li><input type=image src="prev.gif" onclick="location.href='prevod_meritek.rar';"> P�ev�d� a p�epo��t�v� zadan� velikosti v ur�it�m m���tku.</li>
<li><input type=image src="rozv.gif" onclick="location.href='Rozvrh.rar';"> Programek pro zaps�n� rozvrhu do PC.</li>
<li><input type=image src="genv.gif" onclick="location.href='Geniv_Config_creator.rar';"> Config cre�tor pro tvorbu config� pro Trainz.</li>
<li><img src="new.gif"><input type=image src="jedn.gif" onclick="location.href='http://geniv.ic.cz/alfa_verze.rar';"><i>Alfa verze</i> <b>nov�ho</b> Geniv Config Creatoru</li>
<li><input type=image src="slzk.gif" onclick="location.href='lpt.rar';"> Slo�ka obsahuje d�le�it� ovlada�e pro LPT.</li>
<li><input type=image src="jedn.gif" onclick="location.href='Nahoda.rar';"> Je to generov�n� n�hodn�ch ��sel pro hru Vari�tor.</li>
<li><input type=image src="jedn.gif" onclick="location.href='Prevod.rar';"> Pomocn� p�i kreslen� se v�m m��e v�dy k n��emu hodit.</li>
<li><input type=image src="sedm.gif" onclick="location.href='Prevod_z_bin.rar';"> Jednodu�e p�evede Dekadick� ��slo na Bin�rn�.</li>
<li><input type=image src="lpti.gif" onclick="location.href='Programovatelne_LPT1.rar';"> Pro ty co si r�di hraj� s porty je tu programovateln� LPT.</li>
<li><input type=image src="jedn.gif" onclick="location.href='printscreen.rar';"> Print screen je jednoduch� fot�c� program, vyfot� a ulo��.</li>
<li><input type=image src="jedn.gif" onclick="location.href='zvoneni.rar';"> Program pro v�po�et rozestupu zvon�n� a p�est�vek ve �kole.</li>
</ul>

<hr>
<img src="new.gif"><b><u>N�kolik java skrypt� co jsem d�lal:</u></b><br>
<ul type=square>
<li><a href="mzda.html" target="_blank">Skrypt na v�po�et �ist� mzdy</a></li>
<li><a href="odpocitavani.htm" target="_blank">Skrypt na odpo�et �asu</a></li>
<li><a href="Vypocty_elektroniky.htm" target="_blank">Skrypt na v�po�et n�jak�ch elektrick�ch veli�in</a></li>
</ul>

<hr>
<img src="new.gif"><b><u>N�kolik Max skrypt� co jsem tvo�il pro 3Ds max:</u></b><br>
<ul type=square>
<li><a href="reklama.ms" target="_blank">Postupn� ot��en� tabule bilbordu</a></li>
<li><a href="jednoduchy_dum_-_navod.rar" target="_blank">Pokus o max-script tutori�l, byl by kompletn� kdyby br�cha vid�l jedo v�hody!!</a></li>
<li><a href="info dialog.ms" target="_blank">Uk�zka dialogu</a></li>
<li><a href="komplet_dumny.ms" target="_blank">Ot��en� dummy</a></li>
<li><a href="dum.ms" target="_blank">Postaven� pokusn�ho domu (je dost na hrubo)</a></li>
<li><a href="moznosti.rar" target="_blank">Jen n�kolik mo�nost� max scriptu na uk�zku</a></li>
<li><a href="vytvoreni_planu.ms" target="_blank">N�jak� pokus o vytvo�en� planu...</a></li>
</ul>

<hr>
<img src="new.gif"><b><u>N�kolik program� z assembleru:</u></b><br>
<ul type=square>
<li><a href="geniv_vystupy.rar" target="_blank">Prvn� testovac� verze programu na ovl�d�n� vstup� br�n A..D p�es br�nu E</a></li>
<li><a href="posuv.rar" target="_blank">Takov� hr�tka s v�stupy (nedo�asovan�)</a></li>
</ul>
