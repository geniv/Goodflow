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

<?
/*  testing!!!
SetCookie ("nazev_cookie", "hodnota");
echo "Tato stránka Vám poslala cookie!";

SetCookie ("nazev_cookie", "hodnota", time()+10*60);
echo "Tato stránka Vám poslala cookie!";

echo "<p>Hodnota naší cookie je ".$_COOKIE["nazev_cookie"];
*/
?> 

<h3><u>Projekty a úlohy z hodin Informaèní a Komunikaèní techniky (IKT)</u></h3>
Programy respektive zdrojáky, které tu budou tak jsou psané 
v Delhpi 6 ( <i>{$APPTYPE CONSOLE}</i> ) no a také podle možností i v TP.<br><br>
<table border=2 align=center>
<tr>
<th colspan=7>Úlohy</th>
</tr>

<tr>
<th>Úloha</th>
<th>Delphi - zdoják</th>
<th>Delphi - EXE</th>
<th>TPascal - zdroj</th>
<th>TPascal - EXE</th>
<th>Vylepšená verze</th>
<th>Funkce</th>
</tr>

<tr>
<td>01</td>
<td><input type=image src="zdroj.gif" onclick="location.href='Delphi/uloha01_dpr.rar'"></td>
<td><input type=image src="exec.gif" onclick="location.href='Delphi/uloha01_exec.rar'"></td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta01_pas.rar'"></td>
<td><input type=image src="exec.gif" onclick="location.href='TP/frysta01_exec.rar'"></td>
<td>------</td>
<td>Vypsání textu</td>
</tr>

<tr>
<td>02</td>
<td><input type=image src="zdroj.gif" onclick="location.href='Delphi/uloha02_dpr.rar'"></td>
<td><input type=image src="exec.gif" onclick="location.href='Delphi/uloha02_exec.rar'"></td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta02_pas.rar'"></td>
<td><input type=image src="exec.gif" onclick="location.href='TP/frysta02_exec.rar'"></td>
<td>------</td>
<td>Souèet dvou èísel</td>
</tr>

<tr>
<td>03</td>
<td><input type=image src="zdroj.gif" onclick="location.href='Delphi/uloha03_dpr.rar'"></td>
<td><input type=image src="exec.gif" onclick="location.href='Delphi/uloha03_exec.rar'"></td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta03_pas.rar'"></td>
<td><input type=image src="exec.gif" onclick="location.href='TP/frysta03_exec.rar'"></td>
<td>------</td>
<td>Výpoèet obsahu a obvodu ètverce</td>
</tr>

<tr>
<td>04</td>
<td><input type=image src="zdroj.gif" onclick="location.href='Delphi/uloha04_dpr.rar'"></td>
<td><input type=image src="exec.gif" onclick="location.href='Delphi/uloha04_exec.rar'"></td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta04_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>Výpoèet obsahu a obvodu obdelníku</td>
</tr>

<tr>
<td>05</td>
<td><input type=image src="zdroj.gif" onclick="location.href='Delphi/uloha05_dpr.rar'"></td>
<td><input type=image src="exec.gif" onclick="location.href='Delphi/uloha05_exec.rar'"></td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta05_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>Výpoèet obsahu a obvodu kruhu</td>
</tr>

<tr>
<td>06</td>
<td>------</td>
<td>------</td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta06_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>Výpoèet obsahu a obvodu trojùhelníku</td>
</tr>

<tr>
<td>07</td>
<td>------</td>
<td>------</td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta07_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>Pøevod z m na cm,mm,dm,km</td>
</tr>

<tr>
<td>08</td>
<td>------</td>
<td>------</td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta08_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>Pøevod znaku</td>
</tr>

<tr>
<td>09</td>
<td>------</td>
<td>------</td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta09_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>Poèítání zvíøat</td>
</tr>

<tr>
<td>10</td>
<td>------</td>
<td>------</td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta10_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>Posun znaku o urèitý èíslo</td>
</tr>

<tr>
<td>11</td>
<td>------</td>
<td>------</td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta11_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>Celoèíselný dìlení</td>
</tr>

<tr>
<td>12</td>
<td>------</td>
<td>------</td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta12_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>Porovnání dvou èísel</td>
</tr>

<tr>
<td>13</td>
<td>------</td>
<td>------</td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta13_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>Zjištìní kladnosti èísla</td>
</tr>

<tr>
<td>14</td>
<td>------</td>
<td>------</td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta14_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>...</td>
</tr>

<tr>
<td>15</td>
<td>------</td>
<td>------</td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta15_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>...</td>
</tr>

<tr>
<td>16</td>
<td>------</td>
<td>------</td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta16_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>...</td>
</tr>

<tr>
<td>17</td>
<td>------</td>
<td>------</td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta17_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>...</td>
</tr>

<tr>
<td>18</td>
<td>------</td>
<td>------</td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta18_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>...</td>
</tr>

<tr>
<td>19</td>
<td>------</td>
<td>------</td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta19_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>...</td>
</tr>

<tr>
<td>20</td>
<td>------</td>
<td>------</td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta20_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>Kalkulaèka</td>
</tr>

<tr>
<td>21</td>
<td>------</td>
<td>------</td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta21_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>Denní doba</td>
</tr>

<tr>
<td>22</td>
<td>------</td>
<td>------</td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta22_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>Rozlišení znaku</td>
</tr>

<tr>
<td>23</td>
<td>------</td>
<td>------</td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta23_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>Ètvrtletí</td>
</tr>

<tr>
<td>24</td>
<td>------</td>
<td>------</td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta24_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>BMI</td>
</tr>

<tr>
<td>25</td>
<td>------</td>
<td>------</td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta25_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>Rodne cislo</td>
</tr>

<tr>
<td>26</td>
<td>------</td>
<td>------</td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta26_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>Geometrické útvary</td>
</tr>

<tr>
<td>Test</td>
<td>------</td>
<td>------</td>
<td><input type=image src="pas.gif" onclick="location.href='TP/test1_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>1.Test</td>
</tr>

<tr>
<td>27</td>
<td>------</td>
<td>------</td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta27_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>Vypsání èísel 1..N</td>
</tr>

<tr>
<td>28</td>
<td>------</td>
<td>------</td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta28_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>Vypsání èísel 1..N</td>
</tr>

<tr>
<td>29</td>
<td>------</td>
<td>------</td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta29_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>Vypsání èísel 1..N</td>
</tr>

<tr>
<td>30</td>
<td>------</td>
<td>------</td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta30_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>Kladnost èísla</td>
</tr>

<tr>
<td>31</td>
<td>------</td>
<td>------</td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta31_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>Násobilka</td>
</tr>

<tr>
<td>32</td>
<td>------</td>
<td>------</td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta32_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>Násobení bez násobení</td>
</tr>

<tr>
<td>33</td>
<td>------</td>
<td>------</td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta33_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>Dìlitelé èísla</td>
</tr>

<tr>
<td>34</td>
<td>------</td>
<td>------</td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta34_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>Vypsání èísla 1..N</td>
</tr>

<tr>
<td>35</td>
<td>------</td>
<td>------</td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta35_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>Prvoèísla</td>
</tr>

<tr>
<td>36</td>
<td>------</td>
<td>------</td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta36_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>Prùmìr poslopnosti</td>
</tr>

<tr>
<td>37</td>
<td>------</td>
<td>------</td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta37_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>Prùmer N èísel</td>
</tr>

<tr>
<td>38</td>
<td>------</td>
<td>------</td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta38_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>Posloupnost 4 èísel</td>
</tr>

<tr>
<td>40</td>
<td>------</td>
<td>------</td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta40_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>Známky na vysvìdèení</td>
</tr>

<tr>
<td>41</td>
<td>------</td>
<td>------</td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta41_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>16x pozdrav</td>
</tr>

<tr>
<td>42</td>
<td>------</td>
<td>------</td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta42_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>Spoøiè</td>
</tr>

<tr>
<td>43</td>
<td>------</td>
<td>------</td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta43_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>Jezdící text</td>
</tr>

<tr>
<td>44</td>
<td>------</td>
<td>------</td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta44_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>Metrix</td>
</tr>

<tr>
<td>45</td>
<td>------</td>
<td>------</td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta45_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>Sazka</td>
</tr>

<tr>
<td>46</td>
<td>------</td>
<td>------</td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta46_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>Rámeèek kolem obrazovky</td>
</tr>

<tr>
<td>47</td>
<td>------</td>
<td>------</td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta47_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>Okno</td>
</tr>

<tr>
<td>48</td>
<td>------</td>
<td>------</td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta48_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>Poèítání 10-ti èísel</td>
</tr>

<tr>
<td>49</td>
<td>------</td>
<td>------</td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta49_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>Odpoèítávání</td>
</tr>

<tr>
<td>50</td>
<td>------</td>
<td>------</td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta50_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>Hádání jednoho èísla (x pokusù)</td>
</tr>

<tr>
<td>51</td>
<td>------</td>
<td>------</td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta51_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>Hádání jednoho èísla (10 pokusù)</td>
</tr>

<tr>
<td colspan=7>&nbsp;</td>
</tr>
<tr>
<td><input type=image src="Turbo.gif" onclick="location.href='tp55.rar'"></td>
<td colspan=6>Zde je na stáhnutí Turbo Pascal verze 5.5</td>
</tr>
<tr>
<td><input type=image src="Turbo.gif" onclick="location.href='TP70.rar'"></td>
<td colspan=6>Zde je na stáhnutí Turbo Pascal verze 7.0</td>
</tr>
</table>
<?
$sb_hes="fsecky_udaja_ijsdvhishfoiqwporeioruiosjghjksgjhjkhjdhfjhdkjhsdhgrpouztrwtzuriredufzgthrdbfvgchxjcvjhbgffgdhjkmdssdewerdjuuurh.php";             
$u=fopen($sb_hes,"r");
$udaj=explode("*-*-*",fread($u,1000000));
fclose($u);

if($pristp!=0)
{
$s_pucc="puc".$pristp."_sedikjvsezuiviuqwpkefjsiheufhvuhsgv.php";
$u=fopen($s_pucc,"r");
$cuuz=fread($u,100);
fclose($u);
}
else
{$cuuz=0;}

if($cuuz!=0 and $udaj[$cuuz]=="Geniv")
{
echo 
"<center><br>
<br><a href='admini_set".$udaj[$cuuz]."_aecihieufisudeoiapsgjwsoigjsrgaoifujaedoifjh.php' title='Udajù na stránkách' target=_blank>Editace souboru...</a>
</center>
";
}
?>
