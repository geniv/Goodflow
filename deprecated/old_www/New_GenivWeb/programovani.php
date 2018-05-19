<?
$sou_ban="ban_weicuweiuvhoihnqpodwkjvnsjfnbvnqwiufehwiujefgvizuddkjsfh.php";
$u=fopen($sou_ban,"r");
$ban=explode("*--ban--*",fread($u,10000));
fclose($u);
for($p=0;$p<count($ban);$p++)
{
if($ban[$p]==$REMOTE_ADDR)
 { print "<br><br><br><br><br><h2 align=center>Na tyto stránky máte zákaz vstupu!!</h2>";
 exit;}
}
?>
Provozuji programovací jazyky: <b>Object Pascal , Html, Java Script, PHP, C++, Max script a Assembler</b><br>
Když to tak vezmu tak Pascal má už své dny slávy za sebou, také na nìm firma Borland dobøe vydìlala a
její kompilátor Pascalu se stal i základem pro object pascal (tedy grafická verze pascalu) známý spíše
pod názvem Delphi. To je vlastnì novodobá nádrada stareho pascalu. Mezi zaèínajícími programátory je Delphi
pomìrnì oblíbený protože je jednoduchý. Samozdøejmì když znáte trošièku alespoò styl zápisu.<br>
<hr>
<b><u>Nìkolik programù na stáhnutí: (Z Delphi 6)</u></b><br>
<ul type=square>
<li><img src="new.gif"><input type=image src="jedn.gif" onclick="location.href='Prepocet.rar';"> Šikovný prográmek pro výpoèet hodnot pøi bytovém pøístupu na brány u MCU AT...</li>
<li><input type=image src="blok.gif" onclick="location.href='notespad.rar';"> Je to eqivalent Notepadu z Win XP, kdo nemá Win XP nebo 2000 tak jej ocení.</li>
<li><input type=image src="bat.gif" onclick="location.href='NBBaterie.rar';"> Tohle je programek pro zjištìní aktuálního stavu baterie.</li>
<li><input type=image src="bud.gif" onclick="location.href='Budik.rar';"> Takový malý diáø pro zaznamenávání vaších poznámek.</li>
<li><input type=image src="prev.gif" onclick="location.href='prevod_meritek.rar';"> Pøevádí a pøepoèítává zadané velikosti v urèitém mìøítku.</li>
<li><input type=image src="rozv.gif" onclick="location.href='Rozvrh.rar';"> Programek pro zapsání rozvrhu do PC.</li>
<li><input type=image src="genv.gif" onclick="location.href='Geniv_Config_creator.rar';"> Config creátor pro tvorbu configù pro Trainz.</li>
<li><img src="new.gif"><input type=image src="jedn.gif" onclick="location.href='http://geniv.ic.cz/alfa_verze.rar';"><i>Alfa verze</i> <b>nového</b> Geniv Config Creatoru</li>
<li><input type=image src="slzk.gif" onclick="location.href='lpt.rar';"> Složka obsahuje dùležité ovladaèe pro LPT.</li>
<li><input type=image src="jedn.gif" onclick="location.href='Nahoda.rar';"> Je to generování náhodných èísel pro hru Variátor.</li>
<li><input type=image src="jedn.gif" onclick="location.href='Prevod.rar';"> Pomocní pøi kreslení se vám mùže vždy k nìèemu hodit.</li>
<li><input type=image src="sedm.gif" onclick="location.href='Prevod_z_bin.rar';"> Jednoduše pøevede Dekadické èíslo na Binární.</li>
<li><input type=image src="lpti.gif" onclick="location.href='Programovatelne_LPT1.rar';"> Pro ty co si rádi hrají s porty je tu programovatelné LPT.</li>
<li><input type=image src="jedn.gif" onclick="location.href='printscreen.rar';"> Print screen je jednoduchý fotící program, vyfotí a uloží.</li>
<li><input type=image src="jedn.gif" onclick="location.href='zvoneni.rar';"> Program pro výpoèet rozestupu zvonìní a pøestávek ve škole.</li>
</ul>

<hr>
<img src="new.gif"><b><u>Nìkolik java skryptù co jsem dìlal:</u></b><br>
<ul type=square>
<li><a href="mzda.html" target="_blank">Skrypt na výpoèet èisté mzdy</a></li>
<li><a href="odpocitavani.htm" target="_blank">Skrypt na odpoèet èasu</a></li>
<li><a href="Vypocty_elektroniky.htm" target="_blank">Skrypt na výpoèet nìjakých elektrických velièin</a></li>
</ul>

<hr>
<img src="new.gif"><b><u>Nìkolik Max skryptù co jsem tvoøil pro 3Ds max:</u></b><br>
<ul type=square>
<li><a href="reklama.ms" target="_blank">Postupné otáèení tabule bilbordu</a></li>
<li><a href="jednoduchy_dum_-_navod.rar" target="_blank">Pokus o max-script tutoriál, byl by kompletní kdyby brácha vidìl jedo výhody!!</a></li>
<li><a href="info dialog.ms" target="_blank">Ukázka dialogu</a></li>
<li><a href="komplet_dumny.ms" target="_blank">Otáèení dummy</a></li>
<li><a href="dum.ms" target="_blank">Postavení pokusného domu (je dost na hrubo)</a></li>
<li><a href="moznosti.rar" target="_blank">Jen nìkolik možností max scriptu na ukázku</a></li>
<li><a href="vytvoreni_planu.ms" target="_blank">Nìjaký pokus o vytvoøení planu...</a></li>
</ul>

<hr>
<img src="new.gif"><b><u>Nìkolik programù z assembleru:</u></b><br>
<ul type=square>
<li><a href="geniv_vystupy.rar" target="_blank">První testovací verze programu na ovládání vstupù brán A..D pøes bránu E</a></li>
<li><a href="posuv.rar" target="_blank">Taková hrátka s výstupy (nedoèasovaná)</a></li>
</ul>
