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

<?
/*  testing!!!
SetCookie ("nazev_cookie", "hodnota");
echo "Tato str�nka V�m poslala cookie!";

SetCookie ("nazev_cookie", "hodnota", time()+10*60);
echo "Tato str�nka V�m poslala cookie!";

echo "<p>Hodnota na�� cookie je ".$_COOKIE["nazev_cookie"];
*/
?> 

<h3><u>Projekty a �lohy z hodin Informa�n� a Komunika�n� techniky (IKT)</u></h3>
Programy respektive zdroj�ky, kter� tu budou tak jsou psan� 
v Delhpi 6 ( <i>{$APPTYPE CONSOLE}</i> ) no a tak� podle mo�nost� i v TP.<br><br>
<table border=2 align=center>
<tr>
<th colspan=7>�lohy</th>
</tr>

<tr>
<th>�loha</th>
<th>Delphi - zdoj�k</th>
<th>Delphi - EXE</th>
<th>TPascal - zdroj</th>
<th>TPascal - EXE</th>
<th>Vylep�en� verze</th>
<th>Funkce</th>
</tr>

<tr>
<td>01</td>
<td><input type=image src="zdroj.gif" onclick="location.href='Delphi/uloha01_dpr.rar'"></td>
<td><input type=image src="exec.gif" onclick="location.href='Delphi/uloha01_exec.rar'"></td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta01_pas.rar'"></td>
<td><input type=image src="exec.gif" onclick="location.href='TP/frysta01_exec.rar'"></td>
<td>------</td>
<td>Vyps�n� textu</td>
</tr>

<tr>
<td>02</td>
<td><input type=image src="zdroj.gif" onclick="location.href='Delphi/uloha02_dpr.rar'"></td>
<td><input type=image src="exec.gif" onclick="location.href='Delphi/uloha02_exec.rar'"></td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta02_pas.rar'"></td>
<td><input type=image src="exec.gif" onclick="location.href='TP/frysta02_exec.rar'"></td>
<td>------</td>
<td>Sou�et dvou ��sel</td>
</tr>

<tr>
<td>03</td>
<td><input type=image src="zdroj.gif" onclick="location.href='Delphi/uloha03_dpr.rar'"></td>
<td><input type=image src="exec.gif" onclick="location.href='Delphi/uloha03_exec.rar'"></td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta03_pas.rar'"></td>
<td><input type=image src="exec.gif" onclick="location.href='TP/frysta03_exec.rar'"></td>
<td>------</td>
<td>V�po�et obsahu a obvodu �tverce</td>
</tr>

<tr>
<td>04</td>
<td><input type=image src="zdroj.gif" onclick="location.href='Delphi/uloha04_dpr.rar'"></td>
<td><input type=image src="exec.gif" onclick="location.href='Delphi/uloha04_exec.rar'"></td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta04_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>V�po�et obsahu a obvodu obdeln�ku</td>
</tr>

<tr>
<td>05</td>
<td><input type=image src="zdroj.gif" onclick="location.href='Delphi/uloha05_dpr.rar'"></td>
<td><input type=image src="exec.gif" onclick="location.href='Delphi/uloha05_exec.rar'"></td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta05_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>V�po�et obsahu a obvodu kruhu</td>
</tr>

<tr>
<td>06</td>
<td>------</td>
<td>------</td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta06_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>V�po�et obsahu a obvodu troj�heln�ku</td>
</tr>

<tr>
<td>07</td>
<td>------</td>
<td>------</td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta07_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>P�evod z m na cm,mm,dm,km</td>
</tr>

<tr>
<td>08</td>
<td>------</td>
<td>------</td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta08_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>P�evod znaku</td>
</tr>

<tr>
<td>09</td>
<td>------</td>
<td>------</td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta09_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>Po��t�n� zv��at</td>
</tr>

<tr>
<td>10</td>
<td>------</td>
<td>------</td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta10_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>Posun znaku o ur�it� ��slo</td>
</tr>

<tr>
<td>11</td>
<td>------</td>
<td>------</td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta11_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>Celo��seln� d�len�</td>
</tr>

<tr>
<td>12</td>
<td>------</td>
<td>------</td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta12_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>Porovn�n� dvou ��sel</td>
</tr>

<tr>
<td>13</td>
<td>------</td>
<td>------</td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta13_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>Zji�t�n� kladnosti ��sla</td>
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
<td>Kalkula�ka</td>
</tr>

<tr>
<td>21</td>
<td>------</td>
<td>------</td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta21_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>Denn� doba</td>
</tr>

<tr>
<td>22</td>
<td>------</td>
<td>------</td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta22_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>Rozli�en� znaku</td>
</tr>

<tr>
<td>23</td>
<td>------</td>
<td>------</td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta23_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>�tvrtlet�</td>
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
<td>Geometrick� �tvary</td>
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
<td>Vyps�n� ��sel 1..N</td>
</tr>

<tr>
<td>28</td>
<td>------</td>
<td>------</td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta28_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>Vyps�n� ��sel 1..N</td>
</tr>

<tr>
<td>29</td>
<td>------</td>
<td>------</td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta29_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>Vyps�n� ��sel 1..N</td>
</tr>

<tr>
<td>30</td>
<td>------</td>
<td>------</td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta30_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>Kladnost ��sla</td>
</tr>

<tr>
<td>31</td>
<td>------</td>
<td>------</td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta31_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>N�sobilka</td>
</tr>

<tr>
<td>32</td>
<td>------</td>
<td>------</td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta32_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>N�soben� bez n�soben�</td>
</tr>

<tr>
<td>33</td>
<td>------</td>
<td>------</td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta33_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>D�litel� ��sla</td>
</tr>

<tr>
<td>34</td>
<td>------</td>
<td>------</td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta34_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>Vyps�n� ��sla 1..N</td>
</tr>

<tr>
<td>35</td>
<td>------</td>
<td>------</td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta35_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>Prvo��sla</td>
</tr>

<tr>
<td>36</td>
<td>------</td>
<td>------</td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta36_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>Pr�m�r poslopnosti</td>
</tr>

<tr>
<td>37</td>
<td>------</td>
<td>------</td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta37_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>Pr�mer N ��sel</td>
</tr>

<tr>
<td>38</td>
<td>------</td>
<td>------</td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta38_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>Posloupnost 4 ��sel</td>
</tr>

<tr>
<td>40</td>
<td>------</td>
<td>------</td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta40_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>Zn�mky na vysv�d�en�</td>
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
<td>Spo�i�</td>
</tr>

<tr>
<td>43</td>
<td>------</td>
<td>------</td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta43_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>Jezd�c� text</td>
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
<td>R�me�ek kolem obrazovky</td>
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
<td>Po��t�n� 10-ti ��sel</td>
</tr>

<tr>
<td>49</td>
<td>------</td>
<td>------</td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta49_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>Odpo��t�v�n�</td>
</tr>

<tr>
<td>50</td>
<td>------</td>
<td>------</td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta50_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>H�d�n� jednoho ��sla (x pokus�)</td>
</tr>

<tr>
<td>51</td>
<td>------</td>
<td>------</td>
<td><input type=image src="pas.gif" onclick="location.href='TP/frysta51_pas.rar'"></td>
<td>------</td>
<td>------</td>
<td>H�d�n� jednoho ��sla (10 pokus�)</td>
</tr>

<tr>
<td colspan=7>&nbsp;</td>
</tr>
<tr>
<td><input type=image src="Turbo.gif" onclick="location.href='tp55.rar'"></td>
<td colspan=6>Zde je na st�hnut� Turbo Pascal verze 5.5</td>
</tr>
<tr>
<td><input type=image src="Turbo.gif" onclick="location.href='TP70.rar'"></td>
<td colspan=6>Zde je na st�hnut� Turbo Pascal verze 7.0</td>
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
<br><a href='admini_set".$udaj[$cuuz]."_aecihieufisudeoiapsgjwsoigjsrgaoifujaedoifjh.php' title='Udaj� na str�nk�ch' target=_blank>Editace souboru...</a>
</center>
";
}
?>
