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
Provozuji programovac� jazyky: <b>Object Pascal, Html, Java Script, PHP a C++</b><br>
Kdy� to tak vezmu tak Pascal m� u� sv� dny sl�vy za sebou, tak� na n�m firma Borland dob�e vyd�lala a
jej� kompil�tor Pascalu se stal i z�kladem pro object pascal (tedy grafick� verze pascalu) zn�m� sp�e
pod n�zvem Delphi. To je vlastn� novodob� n�drada stareho pascalu. Mezi za��naj�c�mi program�tory je Delphi
pom�rn� obl�ben� proto�e je jednoduch�. Samozd�ejm� kdy� zn�te tro�i�ku alespo� styl z�pisu.<br>
<hr>
<b><u>N�kolik program� na st�hnut�: (Z Delphi 6)</u></b><br>
<ul type=square>
<li><input type=image src="blok.gif" onclick="location.href='notespad.rar';"> Je to eqivalent Notepadu z Win XP, kdo nem� Win XP nebo 2000 tak jej ocen�.</li>
<li><input type=image src="bat.gif" onclick="location.href='NBBaterie.rar';"> Tohle je programek pro zji�t�n� aktu�ln�ho stavu baterie.</li>
<li><input type=image src="bud.gif" onclick="location.href='Budik.rar';"> Takov� mal� di�� pro zaznamen�v�n� va��ch pozn�mek.</li>
<li><input type=image src="prev.gif" onclick="location.href='prevod_meritek.rar';"> P�ev�d� a p�epo��t�v� zadan� velikosti v ur�it�m m���tku.</li>
<li><input type=image src="rozv.gif" onclick="location.href='Rozvrh.rar';"> Programek pro zaps�n� rozvrhu do PC.</li>
<li><input type=image src="genv.gif" onclick="location.href='Geniv_Config_creator.rar';"> Config cre�tor pro tvorbu config� pro Trainz.</li>
<li><input type=image src="slzk.gif" onclick="location.href='lpt.rar';"> Slo�ka obsahuje d�le�it� ovlada�e pro LPT.</li>
<li><input type=image src="jedn.gif" onclick="location.href='Nahoda.rar';"> Je to generov�n� n�hodn�ch ��sel pro hru Vari�tor.</li>
<li><input type=image src="jedn.gif" onclick="location.href='Prevod.rar';"> Pomocn� p�i kreslen� se v�m m��e v�dy k n��emu hodit.</li>
<li><input type=image src="sedm.gif" onclick="location.href='Prevod_z_bin.rar';"> Jednodu�e p�evede Dekadick� ��slo na Bin�rn�.</li>
<li><input type=image src="lpti.gif" onclick="location.href='Programovatelne_LPT1.rar';"> Pro ty co si r�di hraj� s porty je tu programovateln� LPT.</li>
<li><input type=image src="jedn.gif" onclick="location.href='printscreen.rar';"> Print screen je jednoduch� fot�c� program, vyfot� a ulo��.</li>
<li><input type=image src="jedn.gif" onclick="location.href='zvoneni.rar';"> Program pro v�po�et rozestupu zvon�n� a p�est�vek ve �kole.</li>
</ul>
