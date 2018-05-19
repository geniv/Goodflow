<?php
/*
-vyhledávání
-znovu exportovat instalaci tentokrát z lokálu
-napsat email s instrukcema na to že si stím už muže hrát, aby upozornila dotyčné na nolé loginy

otazka: maji byt stranky pristupne ve vyhledavacich ?
nevis jestli tam chce faviconu ?
ted je nastylovana kostra systemu - grafika se bude dosazovat postupne
pro jake prohlizece se to ma optimalizovat - vyslovne se ji zeptat na podporu IE6

ptat se na:
kompetence
fotogalerii
pdf? ... zacit imlementovat
prognozy
terminy
pracovní doba statistky
Nákladového účetnictví
protokoly
--vylepšit práva????
*/

class HlavniFunkce
{
  public $var;
//******************************************************************************
  function __construct(&$var) //konstruktor
  {
    $this->var = $var;

    $self = $_SERVER["PHP_SELF"];
    $soubor = explode("/", $self);
    $cesta = substr($self, 0, -strlen($soubor[count($soubor) - 1]));

    $this->var->web = "http://{$_SERVER["SERVER_NAME"]}{$cesta}";
  }
//******************************************************************************
  function ObsahStanky()  //kompletní obsah stránky
  {
    $menu = array("uvod", //menu
                  "zamestnanci",
                  "partneri",
                  "zakaznici",
                  "management",
                  "procesy",
                  "terminy",
                  "archiv",
                  "admin");

    if (!Empty($_GET["action"]))
    {
      $this->var->kam = (in_array($_GET["action"], $menu) ? $_GET["action"] : $this->var->default); //osetreni neexistujici cesty
    }
      else
    {
      $this->var->kam = $this->var->default;
    }

    switch ($this->var->kam)
    {
//******************************************************************************
      case "uvod":  //uvod stránek
        $result = include "{$this->var->form}/uvod.php";
      break;
// z a m e s t n a n e c *******************************************************
      case "zamestnanci": //sekce zaměstnanci
        $result = $this->var->zam->HlavniMenu();
        //include "{$this->var->form}/menu_zamestnanec.php";  //menu zamestnancu

        switch ($_GET["akce"])
        {
          //********************************************************************
          case "all": //výpis
            $result .= include "{$this->var->form}/editdel_zamestnanec.php";  //jen čistý výpis
          break;
          //********************************************************************
           case "info":
            $result .= $this->var->zam->ZamestnanecInfoAll(); //sama si načítá číslo
          break;
          //********************************************************************
           case "add":
            $result .= $this->var->zam->ZamestnanecPridat();
          break;
          //********************************************************************
          case "edit":
            $result .= $this->var->zam->ZamestnanecUpravit(); //výpis s upravou zam
          break;
          //********************************************************************
          case "del":
            $result .= $this->var->zam->ZamestnanecSmazat();
          break;
          //********************************************************************
          case "search":
            $result .= $this->var->zam->HledaniZamestnanec();
          break;
          //********************************************************************
          case "kompetence":
            $result .=
            "kompetence<br />
sublink<br>
KOMPETENZEN<br>
-kazdemu zamestanci budou prirazeny kompetence<br>
-nejlepe by bylo vytvorit prozesovou databazy.<br>
-aby bylo mozne priradit cloveku kompetenze jsou potrebne nasledujici kroky:<br>
skoleni, praxe a prezkouseni (Schulung, Praxis, Prüfung)<br>
-po uspesne slozenem prezkouseni budou tomu zamestnaci prirazene kompetence.<br>
-nejlepsi by bylo zobrazeni jednotlivych lidi s ruznymi prozesy - kde by se <br>
ke kazdemu udelal hacek.<br /><br />
--jak to bude s touto sekcí??<br />
--má se nějak rozvíjet nebo stačí admin??<br />
>>kompetence v rámci firmi - co zvládne ve firmě<br />
            ";
          break;
          //********************************************************************
          case "foto":
            $result .=
            "foto<br />

sublink<br>
FOTOGALERIE<br>
-tabulkovy format<br>
-s fotkou ve velikosti pasove<br>
-policka v teto tabulce by si clovek mohl sam editovat - to znamena nechat <br>
si zobrazit jenom ty co chce<br>
-jestli ze se klikne na to fotku dotycneho, tak se zobrazi pod sebou vsechny <br>
fotky ktere jsou ulozene pro toho dotycneho<br>
-vsechny fotky pod sebou ve velikosti 800 pixelu<br>
-kdyz se klikne na prijmeni, tak se zobrazi formular s vyplnenimi daty <br>
(takovy formular jako v zadavani)<br /><br />
--každý zaměstnannec může mít vlastní fotogalerii??<br />
&nbsp;&nbsp;--jestli jo tak kolik zhruba velikost a kolik místa či fotek? (ovlivňuje kapacitu)<br />
>>navolit data co mají být vidět a zobrazovat za data.
            ";
          break;
          //********************************************************************
          case "doba":
            $result .=
            "dočasné menu (nepřeloženo!!)
            <p>
              <a href=\"?action=zamestnanci&amp;akce=doba&amp;co=add\" title=\"\">přidat prognózu</a>
            </p>
            (edit del výpis)
            <p>
              <a href=\"?action=zamestnanci&amp;akce=doba&amp;co=info\" title=\"\">zobrazení prognóz</a>
            </p>
<br /><br />
--kdy zapsat skutečně odpracované hodiny prognozy?? do této samé databáze a nebo jinam???<----<br />
--zapsat text prognozy?<br />
--prognoza si bude pamatovat: DATUM (na kdy má být, kontrola na středu pulnoc aktuálního týdnu?, změna do aktuálního čtvrtku?), OD (časový udaj), DO (časový udaj), ZPRAVA (text prognozy)?<br />
--vypis odpracovaých hodin za týden/měsíc?<br />
--následující májí vidět jen super admini? (denní, týdenní a měsíční výpis)<br />
--vypis dennho plánu? (od-do má pracovat?)<br />
--výpis týdenního a měsíčního plánu co má pracovat?<br />
--omezit nějak delku dopředného přidávání do předu??<br />
--kam všude má přijít pdf generátor a jak mají data v něm vypadat??<br /><br />
>>až na další týden.<br />
>>v terminech pridelit pro prognozu termin<br />
>>dopředu neimezovat<br />
>>ve středu o pulnoc prostě zamknout<br />
>>v projektech podprojekty<br />
>>pridat možnost vidět zaměstnance něco mezi super adminem a uzivatelem!<br />
>>do terminu tabulku akci a obsah akci(edtovatelne z adminu) co se delelo v te akci.<br />
>>přidělovani terminu na prognozy<br />
>>přidělovat prácu po 30 minutach<br />
>>zobr: jmeno čas 7:00 7:30 ...<br />podle prijmeni a jmena << typ řazeni musí být neměcké!!<br />
            ";

            switch ($_GET["co"])
            {
              case "add":
                $result .=
                "přidat prognozu<br />
                <b>jméno a přijmení zaměstnance</b><br />
                <fieldset>
                  <form method=\"post\">
                    Předběžný průběh práce:<br />
                    datum: <input type=\"text\" value=\"".(date("d.m.Y"))."\" />[kalendář]<br />
                    od: <input type=\"text\" value=\"10:00\" />[0:00 - 23:00]<br />
                    do: <input type=\"text\" value=\"18:00\" />[0:00 - 23:00]<br />
                    Počet hodin: <b>8</b> (dopočítá se automaticky)<br />
                    zpráva: <textarea rows=\"5\" cols=\"50\">text prognozy</textarea><br />
                    (tlačítko přidat)
                  </form>
                </fieldset>
                ";
              break;
              
              case "info":
                $result .=
                "zobrazeni prognoz";
              break;
              //skutečně odpracováno, odpracovano tydeni, odpracovano mesicne;;  denni plan, tydeni plan, mescni plan

              default:
                $result .= "uvod prognoz";
              break;
            }
            $result .=
            "<br /><br /><br /><br />
            pracovní doba: Arbeitszeiten
<br />
\"Prognosen eintragen\" (zapisovani prognos)<br />
\"Prognosen anzeigen\" (ukazani prognos)<br />
\"Arbeitszeiten eintragen\" (zapsani odpracovanych hodin - ne vzdy totiz sedi<br />
prognosy - treba kdyz nekdo onemocnel  a nemohl prijit do prace)<br />
\"Arbeitszeiten anzeigen pro Woche<br />
Arbeitszeiten anzeigen pro Monat\" (ukazani odpracovanych hodin)<br />
\"Tagesplan anzeigen\" (ukazani denniho planu)<br />
\"Wochenplan anzeigen pro Mitarbeiter\" (ukazani tydeniho planu)<br />
\"Monatsplan anzeigen pro Mitarbeiter\" (ukazani mesicniho planu)<br />
<br /><br />
\"Prognosen eintragen\"<br />
-tady bude mit kazdy jednotlivy zamestnanec pristup na  zadavaci formular,<br />
kde<br />
bude moci do stredy do pulnoci zapsat svoje prognosy.<br />
-kazdy bude mit moznost zadava sve vlastni prognosy<br />
-kazdy bude moci svoje prognosy moci editovat  a menit - ale to do<br />
nejpozdeji do ctvrka do poledne!<br />
-pak uz nesmi mit moznost menit jednotlive veci.<br />
-mohou mit ale moznost zadavat prognosy na dalsi tydny a to neomezene do<br />
predu<br />
-proto tam musi byt definovane datumove pole.<br />
<br />
\"Tagesplan anzeigen\"<br />
-kazdy zamestnanec uvidi sve vlastni prognosy za den<br />
-vedeni a personalni oddeleni uvidi vsechny prognosy<br />
<br />
\"Wochenplan anzeigen pro Mitarbeiter\"<br />
-kazdy zamestnanec uvidi sve vlastni prognosy za tyden<br />
-vedeni a personalni oddeleni uvidi vsechny prognosy<br />
<br />
\"Monatsplan anzeigen pro Mitarbeiter\"<br />
-kazdy zamestnanec uvidi sve vlastni prognosy za mesic<br />
-vedeni a personalni oddeleni uvidi vsechny prognosy<br />
<br />
\"Arbeitszeiten anzeigen pro Tag\"<br />
-kazdy jednotlivy zamestnance bude zapisovat sve odpracovane hodiny sam.<br />
-kazdy vidi jen sam sebe<br />
-vedeni vidi vsechny<br />
<br />
\"Arbeitszeiten anzeigen pro Woche\"<br />
-to stejne co pred tim jenom za tyden<br />
<br />
\"Arbeitszeiten anzeigen pro Monat\"<br />
-to stejne co pred tim jenom za mesic<br />

<br />
\"Tagesplan anzeigen\"<br />
-ukazani celeho denniho planu vsech zamestnancu - vidi jenom vedeni<br />
<br />
\"Wochenplan anzeigen pro Mitarbeiter\"<br />
-vyber zamestnance a ukazani celeho tydne, jak bude pracovat<br />
<br />
\"Monatsplan anzeigen pro Mitarbeiter\"<br />
-ukazani celeho mesice a vyber zamestnance, jak bude cely mesic pracovat<br />

            ";
          break;
          //********************************************************************
          case "terminy":
            $result .=
            "terminy
<br />
sublink \"Termine\"´<br>
-kdyz pracuje nektery zamestnanec od 0900 - 1700 tak mu musi byt mozne <br>
priradit<br>
urcity termin - a to nejlepe v pul hodinovych intervalech<br>
<br>
-Datum: automaiticky format a den v tydnu<br>
-Uhrzeit von: 0900 (cas od)<br>
-Uhrzeit bis: 1100 (cas do)<br>
-Stunden: 2 - automaticky vypocet hodin<br>
-Teilnehmer:  Mitarbeiter, Partner, Kunden - toto jsou jednotlive databaze, <br>
kdyz se zaklikne mitarbeite, tak se zobrazi vsechny zamestnanci, kdyz se <br>
zaklikne i partner tak se zobrazi vsichni partneri <--- takze tabulka v DB s teminama 1 pro vsecny nebo pro kazdeho 1?!<br>
- ukazuje se vzdy jmeno a prijmeni - razeni podle prijmeni, ale na prvnim <br>
miste stoji jmeno!!<br>
-Medium: Post, Mail, persönliches Gespräch, etc.???????????????????<br>
-Protokoll: velke otevrene pole, kam se zapise protokol!<br>
-Status: abgeschlossen, in Arbeit<br>
-Abteilung????????<br>
-Branche??????????<br>
-musi to byt provazene s temi prognosami, ale maji s temi kompetenzemi<br /><br />
--v databázu se bude uchovávat: datum(datumový udaj), od(čas), do(čas), protokol(text), status ?(jen 2 stavy??) a co ty ostatní hodnoty<br />
--nemá se uchovávat i názvy projektů? a spojovat je s těmito termíny??<br />
--jak to je s přidělováním termínů?? budou se přidělovat na prognozy? s nějakým daným projektem?<br />
&nbsp;&nbsp;--jestli se má udělat i nějaká databáze projektů co by měla obsahovat?? (nazev(200znaků), popis(text))???<br />
  
            ";
          break;
          //********************************************************************
          case "statistika":
            $result .=
            "statistika
<br />
\"Arbeitszeitenstatistik\"<br>
-Tagestatistik - denni statistika pro zamestance - diagram - ten kdo bude <br>
mit nejvic hodin, bude uplne nahore, ten kdo nejmi bude dole (sestupne razene)<br>
-Wochenstatistik pro Mitarbeiter - je potreba vybrat urcity tyden a pak se <br>
nahore zobrazi diagram zase setupne razeny, podle<br>
celkoveho poctu odpracovanych hodin.<br>
-Jahresstatistik pro Mitarbeiter - zase moznost vyberu roku a zobrazeni <br>
diagramu<br>
<br>
- moznost vyberu roku, mesice, tydnu a dnu - a pak vsechny diagramy pod <br>
sebou<br>
-Zuverlässlichkeitsstatistik - to bude rozdil v odpracovanych hodinach a <br>
prognosach<br><br />
--jaký tvar diagramu?? grafický(nějaký graf?) či tabulkový?<br />
--u řazení bude vypsané jméno a přijmení?<br />
--výběr týdne z kalendáře?


kalendář pro vše asi takový:??<br />
<table border=\"1\">
  <tr>
    <td colspan=\"8\" align=\"center\">
      <a href=\"#\">&lt;&lt;</a>&nbsp;&nbsp;&nbsp;<a href=\"#\">08 / 2008</a>&nbsp;&nbsp;&nbsp;<a href=\"#\">&gt;&gt;</a>
    </td>
  </tr>
  <tr>
    <td>Tyden</td>
    <td>Po</td>
    <td>Út</td>
    <td>St</td>
    <td>Čt</td>
    <td>Pá</td>
    <td>So</td>
    <td>Ne</td>
  </tr>
  <tr>
    <td align=\"center\"><b><a href=\"#\">1</a></b></td><td align=\"center\">&nbsp;</td>
    <td align=\"center\">&nbsp;</td><td align=\"center\">&nbsp;</td>
    <td align=\"center\">&nbsp;</td><td align=\"center\"><a href=\"#\">1</a></td>
    <td align=\"center\"><a href=\"#\">2</a></td>
    <td align=\"center\"><a href=\"#\">3</a></td>
  </tr>
  <tr>
    <td align=\"center\"><b><a href=\"#\">2</a></b></td>
    <td align=\"center\"><a href=\"#\">4</a></td>
    <td align=\"center\"><a href=\"#\">5</a></td>
    <td align=\"center\"><a href=\"#\">6</a></td>
    <td align=\"center\"><a href=\"#\">7</a></td>
    <td align=\"center\"><a href=\"#\">8</a></td>
    <td align=\"center\"><a href=\"#\">9</a></td>
    <td align=\"center\"><a href=\"#\">10</a></td>
  </tr>
  <tr>
    <td align=\"center\"><b><a href=\"#\">3</a></b></td>
    <td align=\"center\"><a href=\"#\">11</a></td>
    <td align=\"center\"><a href=\"#\">12</a></td>
    <td align=\"center\"><a href=\"#\">13</a></td>
    <td align=\"center\"><a href=\"#\">14</a></td>
    <td align=\"center\"><a href=\"#\">15</a></td>
    <td align=\"center\"><a href=\"#\">16</a></td>
    <td align=\"center\"><a href=\"#\">17</a></td>
  </tr>
  <tr>
    <td align=\"center\"><b>4</b></td><td align=\"center\">18</td><td align=\"center\">19</td>
    <td align=\"center\">20</td><td align=\"center\">21</td><td align=\"center\">22</td>
    <td align=\"center\">23</td><td align=\"center\">24</td></tr><tr><td align=\"center\"><b>5</b></td>
    <td align=\"center\">25</td><td align=\"center\">26</td><td align=\"center\">27</td>
    <td align=\"center\">28</td><td align=\"center\">29</td><td align=\"center\">30</td>
    <td align=\"center\">31</td>
  </tr>
</table>
--výběr pro dané sekce stylem označí se políčko -> zobrazí se kalendář, navolí se daná den/měsíc/rok??<br />
--rozdíl zobrazovat s jménem, přijmením a rozdílem prognoz a termínu??<br />
            ";
          break;
          //********************************************************************
          case "naklady":
            $result .=
            "naklady
<br />
\"Kostenrechnung\"<br>
-tady bude mit pristup jenom vedeni<br>
-odkaz: Honorar eingeben (plat v eurech)<br>
-moznost vyberu z 300, 400, 500, 600, 700, 800, 900, 1000 Euro<br>
-kazdemu zamestananci se budou pocitat hodiny - od jedne do nekonecna:<br>
- honorar se bude pocitat na urcite hodiny:<br>
- ke kazdemu zamestanci se zapise kolik ma za 160 hodin a ty hodiny se mu <br>
celkem = 160 h.<br />
dni = 20<br />
hodinZaDen = 8<br />
odpracovano = X h.<br />
plat = ((vyber / dni) / hodinZaDen) * odpracovano;<br />
budou pocitat podle odpracovanych hodin.<br>
-nektery pracuji ale za zpracovany dotaznik - musi zpracovat 2000 kusu <br>
dotazniku, ktery jim pocita ale jiny system.<br>
Toto cislo bych jim musela nekam vzdy treba jednou tydne zapsat.<br>
<br>
-je potrabe udelat i statistika<br>
-kolik dosal dotycny zamestnanec za mesic, za rok<br>
-potom celkove kolik plati firma tsqm za tyden na honorarich<br>
-kolik za mesic vyplacime na honorarich<br>
a kolik za rok<br>
-jakmile budeme mit prirazene jednotlive lidi k projektum a prozessum, tak i <br>
statistiky kolik vyplacime za<br>
jednotlive projekty<br /><br />
--každý 1 zaměstnanec bude mít 1 nastavený plat?<br />
--v databázi má být jen: plat (z toho výběru), a hodiny jako číslo s plovouucí řádovou čárkou??<br />
--jak to bude s těmi co mají jiný systém hodnocení??<br />
--statistiky: grafické(graf) či tabulkové??<br />
--statistiky souhrně pro všechny?? nebo pro každého zaměstnance zvlášť??<br />
--jaká návaznost na projekty?? bude uvedena i cena projektu nebo něco podobného? nebo jen aktuální peníze vynaložené na realizaci projektu??<br />
--jak to tedy bude s tím přiřazováním projektů<->termínu<->procesů<->zaměstnanců??<br />
            ";
          break;
          //********************************************************************
          case "prava":
            $result .=
            "prava????????????????????????<br />
>>toto nema už smysl!!! smazat! udělat něco mezi super a zam.
BERECHTIGUNGEN (prava)<br>
-kazdy zamestnanec se dostane ke svemu<br>
-vedeni se dostane na vsechno<br>
-hesla muze davat vedeni a lidi s opravnenim zakladat nove lidi<br>
<br>
Prava 1:<br>
Vedeni - uvidi vsechno<br>
<br>
Prava 2:<br>
pridavani lidi, a editace vsech prognos - zbytek ale jenom svoje veci<br>
<br>
Prava 3:<br>
jenom svoje veci<br /><br />
--to samé co kompetence?<br />
--jaký je rozdíl mezi právama a kompetencemi??<br />
            ";
          break;
          //********************************************************************
          case "protokoly":
            $result .=
            "protokoly
<br />
asi pujde sloucit termin s protokolem...<br />
TAGESPROTOKOLLE<br>
-kazdy zamestnanec musi pul hodiny pred ukoncenim pracovni doby napsat <br>
protokol, co<br>
delal a co stihl<br>
-na to musi existovat v databazi policko, kam by to mohl zapsat.<br>
-musi tam byt datum. Pokud mel ale dotycny zamestnanec prirazene terminy a <br>
ukoly, kam<br>
jiz v te databazi napsal protokol, tak by mel mit automaticky moznost nechat <br>
zapsat do<br>
automaticky do toho denniho protokolu.<br>
-kdyz se klikne na vypis zamestnancu, tak by se mely tyto denni protokoly <br>
zobrazit pod sebou.
<br /><br />
--kam zapsat ten protokol?? do termínu či do prognoz??<br />
--jaký je rozdíl mezo termínama a prognozama?<br />
--jak je mysleno automatické zapsání do deního protoku? dení protokol v čem??<br />
--jak výps protokolu? všech co má dotyčný zaněstnanec? a admini vybrat jméno a zobrazit jeho protokoly??<br />
--omezit výpis na určitý výsek datumu? jaký??<br />
>>776641285<br />
>>formanz@formsoft.cz

stručný obsah:<br />
volano asi cca 20:25<br />
oznamena potíž s cookie<br />
a taky že to to na všech serverech kere používáme funguje uplně steně a bez problému<br />
zprvu udiv že cookie funguje i na serveru<br />
chtěl po mě icq a že nakoukne do zdrojáku, já že jo že neni problém,<br />
dal jsem mu svoje icq a že se asi do hodiny ozve.<br />
-další den: onluva ze se na to včera popodival, zasek ze prý a něčem jiným<br />
(11:40:29)  Geniv:  tak co tedy? už máte čas? <br />
(11:41:06)  Zdenek:  jj, mrknem se na to <br />
(11:41:28)  Zdenek:  take prosivas kde vam to hlasi chybu ve zdrojaku ? <br />
(11:44:06)  Zdenek:  nebo spis kde volate ty cookies <br />
(11:45:19)  Geniv:  no hází to chybu o nemožnosti modifikovat cookie z řádku 38 a 39 <br />
(11:45:46)  Zdenek:  piste prosim bez diakririky <br />
(11:45:58)  Geniv:  tj když se zadají správné logovací udaje..a ty se mají zpsat právě tu natomto řádku do cookie.. <br />
(11:46:10)  Geniv:  jj ok <br />
(11:46:32)  Geniv:  no hazi to chybu o nemoznosti modifikovat cookie zrádku 38 a 39 <br />
(11:46:57)  Geniv:  tj kdyz se zadají správné logovaci udaje..a ty se maji zpsat prave tu na tomto radku do cookie.. <br />
(11:49:58)  Zdenek:  mohu neco zmenit v tom vasem zdrojaku ?<br />
(11:49:58)  Zdenek:  mohu neco zmenit v tom vasem zdrojaku ? <br />
(11:53:03)  Geniv:  ...kdyz to bude fungovat.... original mam stejne na disku a jeste i najinem serveru... takze je <br />
(11:53:09)  Geniv:  jo <br />
(12:04:57)  Zdenek:  takze prosimva vy nez nastavujte to cookies tak neco vypisujete pres echo do stranky je to, tak ? <br />
(12:10:12)  Geniv:  nene... na to si davam hodne pozor... vsechno co je pred tim jsou vyid funkce a funkce ktere vraci svoje hodnoty do prommenych a vyuzivaji je jeste az o kus dal az daleko pod cookie<br /> 
(12:11:40)  Zdenek:  tak v tom pripade mi vysvetlete, proc ten index ktery tam je ted nehazi chybu, kdyz nasatvuje obe vase cookies ? <br />
(12:12:53)  Geniv:  to uz jste upravil nebo nez zasahu?? :) <br />
(12:13:27)  Zdenek:  no uz jsem do toho sahl je to na ftp <br />
(12:14:08)  Zdenek:  jen jsem tam udelal jednoduchy test <br />
(12:14:45)  Geniv:  no.... jinak samozny index se am vklada na radku 63 <br />
(12:15:03)  Geniv:  a vypisuje se na 81... <br />
(12:15:43)  Geniv:  funr se stejne ale nemuzu prihlasit.. neby vy se prihlasite? <br />
(12:17:50)  Zdenek:  mmt <br />
(12:19:20)  Geniv:  ok <br />
(12:22:38)  Zdenek:  take to co je na webu te tam me dovznitr pusti, ale vzapeti me to odhlasi, protoze se vam to asi necita nejak znova. <br />
(12:22:49)  Zdenek:  ten index nebo nejak kontrola ... <br />
(12:23:16)  Zdenek:  nekde se vam doopravdy musi darit neco vypisovat do webu. <br />
(12:29:35)  Geniv:  no teoreticky to muze byt mozny proakticky je to nemozny... prostoze je tam rozdl 40 radku ktere vrac return a ne echo <br />
(12:32:59)  Zdenek:  no to by klidn mohlo ono. <br />
(12:36:12)  Geniv:  no mozna... ale proc me to teda s naprosto stejnym kodem gunguje i na icu a nebo na tsqm.gfdesign.cz?? <br />
(12:36:31)  Geniv:  viz php info na kteram to ja provozuju: http://test.klenot.cz/php5/<br /> 
(12:38:06)  Geniv:  to me peorad nejde do hlavy... <br />
(12:58:31)  Zdenek:  ok, bude tam nejak ptakovina, proberu s kolegou co ma na starosti, upgrade serveru a mel by byt klid. <br />
(13:00:19)  Geniv:  jj dobra... budu verit ze se se vse s tim dorovna... a ze to bude behat jak ma...<br />
            ";
            
            
/*
  if((SetCookie("TSQM_JMENO", "kolo", Time() + 31536000)) && (SetCookie("TSQM_HESLO", "bagr", Time() + 31536000)) ) 
  {
    echo "KK";
  }
*/
            
/*
<script type=\"text/javascript\">
  function pokus(element)
  {
    document.getElementById(element).style.display = 'none';
  }

  function pokus1(element)
  {
    document.getElementById(element).style.display = 'block';
  }
</script>

<div id=\"ahoj\">

<ol>
  <li>uroven 1</li>
  <li>uroven 1</li>
  <li>uroven 1
    <ol>
      <li>uroven 2</li>
      <li>uroven 2
        <ol id=\"ur3\">
          <li>uroven 3</li>
          <li>uroven 3</li>
          <li>uroven 3</li>
          <li>uroven 3</li>
          <li>uroven 3</li>
        </ol>
      <li>uroven 2</li>
      <li>uroven 2</li>
      <li>uroven 2</li>
    </ol>
  <li>uroven 1</li>
  <li>uroven 1</li>
  <li>uroven 1</li>
</ol>

</div>

<input type=\"checkbox\" value=\"klik\" onclick=\"if(this.checked){pokus1('ahoj');}else{pokus('ahoj');};\">
<input type=\"checkbox\" value=\"klik\" onclick=\"if(this.checked){pokus1('ur3');}else{pokus('ur3');};\">

<input type=\"button\" value=\"klik\" onclick=\"pokus('ahoj');\">
<input type=\"button\" value=\"klik2\" onclick=\"pokus1('ahoj');\">
*/
          break;
          //********************************************************************
          case "pdf":
            $result .= $this->var->zam->VygenerujPDF(); //vypise PDF
          break;
          //********************************************************************
          default:
            $result .= include "{$this->var->form}/uvod_zamestnanec.php";
          break;
        }
      break;
//p a r t n e r i **************************************************************
      case "partneri":  //sekce partneři
        $result = include "{$this->var->form}/menu_partneri.php"; //menu partnerů

        switch ($_GET["akce"])
        {
          //********************************************************************
          case "all":
            $result .= include "{$this->var->form}/editdel_partner.php";
          break;
          //********************************************************************
          case "info":
            $result .= $this->var->par->PartnerInfoAll();
          break;
          //********************************************************************
          case "add":
            $result .= $this->var->par->PartnerPridat();
          break;
          //********************************************************************
          case "edit":
            $result .= $this->var->par->PartnerUpravit();
          break;
          //********************************************************************
          case "del":
            $result .= $this->var->par->PartnerSmazat();
          break;
          //********************************************************************
          case "search":
            $result .= $this->var->par->HledaniPartner();

          break;
          //********************************************************************
          case "hodnoceni":
            $result .= "hodnoceni";

          break;
          //********************************************************************
          default:
            $result .= include "{$this->var->form}/uvod_partner.php";
          break;
          //********************************************************************
        }
      break;
//z a k a z n i c i ************************************************************
      case "zakaznici": //sekce zakazníci
        $result = include "{$this->var->form}/menu_zakaznici.php";  //menu zakazniku

        switch ($_GET["akce"])
        {
          //********************************************************************
          case "all":
            $result .= include "{$this->var->form}/editdel_zakaznik.php";
          break;
          //********************************************************************
          case "info":
            $result .= $this->var->zak->ZakaznikInfoAll();
          break;
          //********************************************************************
          case "add":
            $result .= $this->var->zak->ZakaznikPridat();
          break;
          //********************************************************************
          case "edit":
            $result .=$this->var->zak->ZakaznikUpravit();
          break;
          //********************************************************************
          case "del":
            $result .= $this->var->zak->ZakaznikSmazat();
          break;
          //********************************************************************
          case "search":
            $result .= $this->var->zak->HledaniZakaznik();
          break;
          //********************************************************************
          default:
            $result .= include "{$this->var->form}/uvod_zakaznik.php";
          break;
          //********************************************************************
        }
      break;
//m a n g e m e n t ************************************************************
      case "management":  //sekce management
        $result =
        "management";
      break;
//p r o c e s y ****************************************************************
      case "procesy": //sekce prosesy
        $result =
        "procesy";
      break;
//t e r m i n y ****************************************************************
      case "terminy": //sekce termíny
        //$result =
        $result =
        "terminy
?????
        ";
      /*
 sublink \"Termine\"´
-kdyz pracuje nektery zamestnanec od 0900 - 1700 tak mu musi byt mozne
priradit
urcity termin - a to nejlepe v pul hodinovych intervalech

-Datum: automaiticky format a den v tydnu
-Uhrzeit von: 0900 (cas od)
-Uhrzeit bis: 1100 (cas do)
-Stunden: 2 - automaticky vypocet hodin
-Teilnehmer:  Mitarbeiter, Partner, Kunden - toto jsou jednotlive databaze,
kdyz se zaklikne mitarbeite, tak se zobrazi vsechny zamestnanci, kdyz se
zaklikne i partner tak se zobrazi vsichni partneri
- ukazuje se vzdy jmeno a prijmeni - razeni podle prijmeni, ale na prvnim
miste stoji jmeno!!
-Medium: Post, Mail, persönliches Gespräch, etc.
-Protokoll: velke otevrene pole, kam se zapise protokol!
-Status: abgeschlossen, in Arbeit
-Abteilung
-Branche
-musi to byt provazene s temi prognosami, ale aji s temi kompetenzemi
      */

      break;
//a r c h i v ******************************************************************
      case "archiv":  //sekce archív
        $result =
        "archiv";
      break;
//a d m i n i s t r a c e ******************************************************
      case "admin": //sekce admin
        //$result = include "{$this->var->form}/menu_admin.php";

        switch ($_GET["akce"])
        {
          //********************************************************************
          case "prava": //podsekce prava po stránkách
            $result .= $this->var->admin->ObsahPristup();
          break;
          //********************************************************************
          case "zamprava":  //podsekce práva zeměstnanců
            $result .= "{$this->var->jazyk["prava_admin"]}<br />";
            $result .= include "{$this->var->form}/add_link.php";
            switch ($_GET["co"])
            {
              //****************************************************************
              case "add":
                $result .= $this->var->admin->ZamestnanecPridatPrava();
              break;
              //****************************************************************
              case "edit":
                $result .= $this->var->admin->ZamestnanecUpravitPrava();
              break;
              //****************************************************************
              case "del":
                $result .= $this->var->admin->ZamestnanecSmazatPrava();
              break;
              //****************************************************************
            }
            $result .= $this->var->admin->ZamestnanecEditDelPrava();
          break;
          //********************************************************************
          case "zamzeme": //podsekce země zaměstnanců
            $result .= "{$this->var->jazyk["zeme_admin"]}<br />";
            $result .= include "{$this->var->form}/add_link.php";
            switch ($_GET["co"])
            {
              //****************************************************************
              case "add":
                $result .= $this->var->admin->ZamestnanecPridatZeme();
              break;
              //****************************************************************
              case "edit":
                $result .= $this->var->admin->ZamestnanecUpravitZeme();
              break;
              //****************************************************************
              case "del":
                $result .= $this->var->admin->ZamestnanecSmazatZeme();
              break;
              //****************************************************************
            }
            $result .= $this->var->admin->ZamestnanecEditDelZeme();
          break;
          //********************************************************************
          case "zamvzde": //podsekce vzdelani zamestnancu
            $result .= "{$this->var->jazyk["vzde_admin"]}<br />";
            $result .= include "{$this->var->form}/add_link.php";
            switch ($_GET["co"])
            {
              //****************************************************************
              case "add":
                $result .= $this->var->admin->ZamestnanecPridatVzdelani();
              break;
              //****************************************************************
              case "edit":
                $result .= $this->var->admin->ZamestnanecUpravitVzdelani();
              break;
              //****************************************************************
              case "del":
                $result .= $this->var->admin->ZamestnanecSmazatVzdelani();
              break;
              //****************************************************************
            }
            $result .= $this->var->admin->ZamestnanecEditDelVzdelani();
          break;
          //********************************************************************
          case "zamstat": //podsekce status zamestnancu
            $result .= "{$this->var->jazyk["stat_admin"]}<br />";
            $result .= include "{$this->var->form}/add_link.php";
            switch ($_GET["co"])
            {
              //****************************************************************
              case "add":
                $result .= $this->var->admin->ZamestnanecPridatStatus();
              break;
              //****************************************************************
              case "edit":
                $result .= $this->var->admin->ZamestnanecUpravitStatus();
              break;
              //****************************************************************
              case "del":
                $result .= $this->var->admin->ZamestnanecSmazatStatus();
              break;
              //****************************************************************
            }
            $result .= $this->var->admin->ZamestnanecEditDelStatus();
          break;
          //********************************************************************
          case "zamjazyk":  //podsekce jazyk zaměstnanců
            $result .= "{$this->var->jazyk["jazyk_admin"]}<br />";
            $result .= include "{$this->var->form}/add_link.php";
            switch ($_GET["co"])
            {
              //****************************************************************
              case "add":
                $result .= $this->var->admin->ZamestnanecPridatJazyk();
              break;
              //****************************************************************
              case "edit":
                $result .= $this->var->admin->ZamestnanecUpravitJazyk();
              break;
              //****************************************************************
              case "del":
                $result .= $this->var->admin->ZamestnanecSmazatJazyk();
              break;
              //****************************************************************
            }
            $result .= $this->var->admin->ZamestnanecEditDelJazyk();
          break;
          //********************************************************************
          case "zamhobby":  //podsekce hobby zaměstnanců
            $result .= "{$this->var->jazyk["hobby_admin"]}<br />";
            $result .= include "{$this->var->form}/add_link.php";
            switch ($_GET["co"])
            {
              //****************************************************************
              case "add":
                $result .= $this->var->admin->ZamestnanecPridatHobby();
              break;
              //****************************************************************
              case "edit":
                $result .= $this->var->admin->ZamestnanecUpravitHobby();
              break;
              //****************************************************************
              case "del":
                $result .= $this->var->admin->ZamestnanecSmazatHobby();
              break;
              //****************************************************************
            }
            $result .= $this->var->admin->ZamestnanecEditDelHobby();
          break;
          //********************************************************************
          case "zamsport":  //podsekce sport zaměstnanců
            $result .= "{$this->var->jazyk["sport_admin"]}<br />";
            $result .= include "{$this->var->form}/add_link.php";
            switch ($_GET["co"])
            {
              //****************************************************************
              case "add":
                $result .= $this->var->admin->ZamestnanecPridatSport();
              break;
              //****************************************************************
              case "edit":
                $result .= $this->var->admin->ZamestnanecUpravitSport();
              break;
              //****************************************************************
              case "del":
                $result .= $this->var->admin->ZamestnanecSmazatSport();
              break;
              //****************************************************************
            }
            $result .= $this->var->admin->ZamestnanecEditDelSport();
          break;
          //********************************************************************
          case "zamvyska":  //podsekce disciplíny zaměstnanců
            $result .= "{$this->var->jazyk["vyska_admin"]}<br />";
            $result .= include "{$this->var->form}/add_link.php";
            switch ($_GET["co"])
            {
              //****************************************************************
              case "add":
                $result .= $this->var->admin->ZamestnanecPridatVyska();
              break;
              //****************************************************************
              case "edit":
                $result .= $this->var->admin->ZamestnanecUpravitVyska();
              break;
              //****************************************************************
              case "del":
                $result .= $this->var->admin->ZamestnanecSmazatVyska();
              break;
              //****************************************************************
            }
            $result .= $this->var->admin->ZamestnanecEditDelVyska();
          break;
          //********************************************************************
          case "strankovani": //podsekce stránkování
            $result .=
            "{$this->var->jazyk["stran_admin"]}<br />
            {$this->var->admin->VypisEditStrankovani()}
            ";
          break;
          //********************************************************************
          default:
            $result = include "{$this->var->form}/menu_admin.php";  //menu bude v uvodu, uvod_admin smazan
            //include "{$this->var->form}/uvod_admin.php";
          break;
          //********************************************************************
        }
      break;
//******************************************************************************
    }

    return $result;
  } //end obsah
//******************************************************************************
//******************************************************************************
  function BoolToInt($hodnota)  //převedení "logické" na číselnou hodnotu
  {
    switch ($hodnota)
    {
      case "true":
        $result = 1;
      break;

      case "false":
        $result = 0;
      break;
    }

    return $result;
  }
//******************************************************************************
  function IntToBool($hodnota)  //převedení číselné hodnoty na tu polužku z jazyka
  {
    switch ($hodnota)
    {
      case 1:
        $result = $this->var->jazyk["exis_yes"];
      break;

      case 0:
        $result = $this->var->jazyk["exis_no"];
      break;
    }

    return $result;
  }
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
  function Kalendar() //neaplkováno!
  {
    $firstday = date("N", mktime(0,0,0,date("m"), 1, date("Y")));
    $endday = date("d", mktime(0,0,0,(date("m")+1), 0, date("Y")));

    $tabulka =
    "<table border=\"1\">
      <tr>";
    for ($i = 0; $i < 7; $i++)
    {
      $tabulka .= "<th>{$this->jazyk["den{$i}"]}</th>";
    }
    $tabulka .=
    "</tr>";

    $tabulka .=
    "<tr>";
    $poc = 1;
    for ($i = 1; $i <= 7; $i++)
    {
      if ($i >= $firstday)
      {
        $den1 = date("Y-m-d", mktime(0,0,0,date("m"), $poc, date("Y")));
        $poc++;
      }
        else
      {
        $den1 = "&nbsp;";
      }
      $tabulka .=
      "<td>$den1</td>";
    }
    $tabulka .=
    "</tr>";

    for ($i = 0; $i < 4; $i++)
    {
      $tabulka .=
      "<tr>";
      for ($j = 0; $j < 7; $j++)
      {
        $datum = date("Y-m-d", mktime(0, 0, 0, date("m"), $poc, date("Y")));
        $poc++;
        $tabulka .=
        "<td>$datum</td>";
      }
      $tabulka .=
      "</tr>";
    }
    $tabulka .=
    "</table>";

    $result =
    "
    $tabulka
    ";

    return $result;
  }
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
  function VolbaJazyka()  //formulář změny jazyka
  {
    $kolac = $_COOKIE["TSQM_LANG"];

    if (!Empty($kolac))
    {
      $cesta = $kolac;
    }
      else
    {
      $cesta = "deutsch"; //defaultne nemcina
    }
    
    $this->var->nowjazyk = $cesta;  //pouzivat pro globalni rozliseni jazyka   

    if (file_exists("{$cesta}.php"))
    {
      $this->var->jazyk = include "{$cesta}.php";
    }
      else
    {
      $this->var->jazyk = include "czech.php";
    }

    switch ($cesta)
    {
      case "czech":
        $ces[0] = "selected='selected'";
      break;

      case "deutsch":
        $ces[1] = "selected='selected'";
      break;
    }

    $result = include "{$this->var->form}/volba_jazyka.php";

    if (!Empty($_GET["setlang"]) &&
        !Empty($_GET["language"]))
    {
      SetCookie("TSQM_LANG", $_GET["language"], Time() + 31536000); //zápis do cookie
      $this->var->loadingjazyk = include "{$this->var->form}/volba_jazyka_nastaveni.php";  //auto klik!
      $this->AutoClick(1, "?action={$_GET["action"]}&akce={$_GET["akce"]}");  //auto kliknutí
    }

    return $result;
  }
//******************************************************************************
  function InstalaceMySQLi()  //instalace DB
  {
    if ($this->var->instalace)
    {
      if (!$this->ExistujeTabulka("prava")) //tabulka prav + instalace
      {
        if (!@$this->var->mysqli->multi_query("CREATE TABLE prava (
                                              id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
                                              prava VARCHAR(200) NULL,
                                              PRIMARY KEY(id),
                                              UNIQUE INDEX prava(prava));
                                              "))
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
        }
        @$this->var->mysqli->multi_query("INSERT INTO prava (id, prava) VALUES(NULL, 'SUPER Admin');");
        @$this->var->mysqli->multi_query("INSERT INTO prava (id, prava) VALUES(NULL, 'Mitarbeiter');");
        @$this->var->mysqli->multi_query("INSERT INTO prava (id, prava) VALUES(NULL, 'visitor');");
      }

      if (!$this->ExistujeTabulka("zamestnanec_umi_jazyk"))  //spojovací tabulka zam a jazyku
      {
        if (!@$this->var->mysqli->multi_query("CREATE TABLE zamestnanec_umi_jazyk (
                                              id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
                                              idzamestnanec INTEGER UNSIGNED NULL,
                                              idjazyk INTEGER UNSIGNED NULL,
                                              PRIMARY KEY(id));
                                              "))
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
        }
      }

      if (!$this->ExistujeTabulka("jazyk")) //tabulka jazyku + instalace
      {
        if (!@$this->var->mysqli->multi_query("CREATE TABLE jazyk (
                                              id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
                                              jazyk VARCHAR(100) NULL,
                                              PRIMARY KEY(id),
                                              UNIQUE INDEX jazyk(jazyk));
                                              "))
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
        }
        @$this->var->mysqli->multi_query("INSERT INTO jazyk (id, jazyk) VALUES(NULL, 'tschechisch');");
        @$this->var->mysqli->multi_query("INSERT INTO jazyk (id, jazyk) VALUES(NULL, 'deutsch');");
        @$this->var->mysqli->multi_query("INSERT INTO jazyk (id, jazyk) VALUES(NULL, 'englisch');");
      }

      if (!$this->ExistujeTabulka("zeme"))  //tabulka zeme + instalace
      {
        if (!@$this->var->mysqli->multi_query("CREATE TABLE zeme (
                                              id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
                                              zeme VARCHAR(100) NULL,
                                              PRIMARY KEY(id),
                                              UNIQUE INDEX zeme(zeme));
                                              "))
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
        }
        @$this->var->mysqli->multi_query("INSERT INTO zeme (id, zeme) VALUES(NULL, 'Tschechische Republik');");
        @$this->var->mysqli->multi_query("INSERT INTO zeme (id, zeme) VALUES(NULL, 'Deutschland');");
        @$this->var->mysqli->multi_query("INSERT INTO zeme (id, zeme) VALUES(NULL, 'Österreich');");
      }

      if (!$this->ExistujeTabulka("zamestnanec_ma_ridicak"))  //spojovací tabulka zam a ridicaku
      {
        if (!@$this->var->mysqli->multi_query("CREATE TABLE zamestnanec_ma_ridicak (
                                              id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
                                              idzamestnanec INTEGER UNSIGNED NULL,
                                              idridicak INTEGER UNSIGNED NULL,
                                              PRIMARY KEY(id));
                                              "))
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
        }
      }

      if (!$this->ExistujeTabulka("ridicak")) //ridicak + instalace
      {
        if (!@$this->var->mysqli->multi_query("CREATE TABLE ridicak (
                                              id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
                                              ridicak VARCHAR(100) NULL,
                                              PRIMARY KEY(id),
                                              UNIQUE INDEX ridicak(ridicak));"))
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
        }
        @$this->var->mysqli->multi_query("INSERT INTO ridicak (id, ridicak) VALUES(1, 'Motorrad');");
        @$this->var->mysqli->multi_query("INSERT INTO ridicak (id, ridicak) VALUES(2, 'PKW');");
        @$this->var->mysqli->multi_query("INSERT INTO ridicak (id, ridicak) VALUES(3, 'LKW');");
        @$this->var->mysqli->multi_query("INSERT INTO ridicak (id, ridicak) VALUES(4, 'Bus');");
      }

      if (!$this->ExistujeTabulka("zamestnanec_ma_hobby"))  //spojovací tabulka zam a hobby
      {
        if (!@$this->var->mysqli->multi_query("CREATE TABLE zamestnanec_ma_hobby (
                                              id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
                                              idzamestnanec INTEGER UNSIGNED NULL,
                                              idhobby INTEGER UNSIGNED NULL,
                                              PRIMARY KEY(id));
                                              "))
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
        }
      }

      if (!$this->ExistujeTabulka("hobby")) //tabulka hobby
      {
        if (!@$this->var->mysqli->multi_query("CREATE TABLE hobby (
                                              id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
                                              hobby VARCHAR(100) NULL,
                                              PRIMARY KEY(id),
                                              UNIQUE INDEX hobby(hobby));
                                              "))
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
        }
        @$this->var->mysqli->multi_query("INSERT INTO hobby (id, hobby) VALUES(NULL, 'PC');");
        @$this->var->mysqli->multi_query("INSERT INTO hobby (id, hobby) VALUES(NULL, 'malování');");
        @$this->var->mysqli->multi_query("INSERT INTO hobby (id, hobby) VALUES(NULL, 'zpěv');");
      }

      if (!$this->ExistujeTabulka("zamestnanec_ma_sport"))  //spojovací tabulka zam a sportu
      {
        if (!@$this->var->mysqli->multi_query("CREATE TABLE zamestnanec_ma_sport (
                                              id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
                                              idzamestnanec INTEGER UNSIGNED NULL,
                                              idsport INTEGER UNSIGNED NULL,
                                              PRIMARY KEY(id));
                                              "))
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
        }
      }

      if (!$this->ExistujeTabulka("sport")) //tabulka sportu
      {
        if (!@$this->var->mysqli->multi_query("CREATE TABLE sport (
                                              id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
                                              sport VARCHAR(200) NULL,
                                              PRIMARY KEY(id),
                                              UNIQUE INDEX sport(sport));
                                              "))
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
        }
        @$this->var->mysqli->multi_query("INSERT INTO sport (id, sport) VALUES(NULL, 'posilování');");
        @$this->var->mysqli->multi_query("INSERT INTO sport (id, sport) VALUES(NULL, 'fotbal');");
        @$this->var->mysqli->multi_query("INSERT INTO sport (id, sport) VALUES(NULL, 'tenis');");
      }

      if (!$this->ExistujeTabulka("zamestnanec_ma_typvysoke"))  //spojovací tabulka zam a vysky
      {
        if (!@$this->var->mysqli->multi_query("CREATE TABLE zamestnanec_ma_typvysoke (
                                              id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
                                              idzamestnanec INTEGER UNSIGNED NULL,
                                              idtypvysoke INTEGER UNSIGNED NULL,
                                              PRIMARY KEY(id));
                                              "))
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
        }
      }

      if (!$this->ExistujeTabulka("typvysoke")) //tabulka typu vysoke + instalace
      {
        if (!@$this->var->mysqli->multi_query("CREATE TABLE typvysoke (
                                              id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
                                              typ VARCHAR(100) NULL,
                                              PRIMARY KEY(id),
                                              UNIQUE INDEX typ(typ));
                                              "))
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
        }
        @$this->var->mysqli->multi_query("INSERT INTO typvysoke (id, typ) VALUES(NULL, 'výpočetní technika');");
        @$this->var->mysqli->multi_query("INSERT INTO typvysoke (id, typ) VALUES(NULL, 'matematika');");
        @$this->var->mysqli->multi_query("INSERT INTO typvysoke (id, typ) VALUES(NULL, 'sociologie');");
        @$this->var->mysqli->multi_query("INSERT INTO typvysoke (id, typ) VALUES(NULL, 'bussines');");
        @$this->var->mysqli->multi_query("INSERT INTO typvysoke (id, typ) VALUES(NULL, 'sociologie');");
      }

      if (!$this->ExistujeTabulka("zamestnanec")) //tabulak zamestnancu + instalace
      {
        if (!@$this->var->mysqli->multi_query("CREATE TABLE zamestnanec (
                                              id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
                                              loginjmeno VARCHAR(50) NOT NULL,
                                              loginheslo VARCHAR(50) NULL,
                                              jmeno VARCHAR(50) NULL,
                                              prijmeni VARCHAR(50) NULL,
                                              idprava INTEGER UNSIGNED NULL,
                                              ulice VARCHAR(100) NULL,
                                              cp INTEGER UNSIGNED NULL,
                                              psc INTEGER UNSIGNED NULL,
                                              mesto VARCHAR(100) NULL,
                                              idzeme INTEGER UNSIGNED NULL,
                                              predvolba VARCHAR(10) NULL,
                                              telefon VARCHAR(20) NULL,
                                              predvolba1 VARCHAR(10) NULL,
                                              telefon1 VARCHAR(20) NULL,
                                              email VARCHAR(50) NULL,
                                              datumnarozeni DATE NULL,
                                              idvzdelani INTEGER UNSIGNED NULL,
                                              ridicak BOOL NULL,
                                              pohlavi BOOL NULL,
                                              datumosloveni DATE NULL,
                                              datumzivotopisu DATE NULL,
                                              datumpohovoru DATE NULL,
                                              datumzacatek DATE NULL,
                                              datumodmitnuti DATE NULL,
                                              datumkonec DATE NULL,
                                              idstatus INTEGER UNSIGNED NULL,
                                              mistonarozeni VARCHAR(200) NULL,
                                              idzemenarozeni INTEGER UNSIGNED NULL,
                                              idrodnyjazyk INTEGER UNSIGNED NULL,
                                              jmenootce VARCHAR(50) NULL,
                                              prijmeniotce VARCHAR(50) NULL,
                                              povolaniotce VARCHAR(100) NULL,
                                              jmenomatky VARCHAR(50) NULL,
                                              prijmenimatky VARCHAR(50) NULL,
                                              povolanimatky VARCHAR(100) NULL,
                                              pocetbratru INTEGER UNSIGNED NULL,
                                              pocetsester INTEGER UNSIGNED NULL,
                                              maturita BOOL NULL,
                                              stredni BOOL NULL,
                                              nazevstredni VARCHAR(200) NULL,
                                              stredniod INTEGER UNSIGNED NULL,
                                              strednido INTEGER UNSIGNED NULL,
                                              vysoka BOOL NULL,
                                              nazevvysoke VARCHAR(200) NULL,
                                              vyskaod INTEGER UNSIGNED NULL,
                                              vyskado INTEGER UNSIGNED NULL,
                                              vystytul BOOL NULL,
                                              PRIMARY KEY(id),
                                              UNIQUE INDEX loginjmeno(loginjmeno));
                                              "))
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
        }
        @$this->var->mysqli->multi_query("INSERT INTO zamestnanec (id, loginjmeno, loginheslo, jmeno, prijmeni, idprava, idzeme, idvzdelani, pohlavi, idstatus, idzemenarozeni, idrodnyjazyk, ridicak, maturita, stredni, vysoka, vystytul) VALUES(NULL, 'Geniv', 'tsqmasus', 'Radek', 'Fryšták', {$this->var->superadmin}, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0);");
        @$this->var->mysqli->multi_query("INSERT INTO zamestnanec (id, loginjmeno, loginheslo, jmeno, prijmeni, idprava, idzeme, idvzdelani, pohlavi, idstatus, idzemenarozeni, idrodnyjazyk, ridicak, maturita, stredni, vysoka, vystytul) VALUES(NULL, 'Fugess', 'Mercury', 'Martin', 'Fryšták', {$this->var->superadmin}, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0);");
        @$this->var->mysqli->multi_query("INSERT INTO zamestnanec (id, loginjmeno, loginheslo, jmeno, prijmeni, idprava, idzeme, idvzdelani, pohlavi, idstatus, idzemenarozeni, idrodnyjazyk, ridicak, maturita, stredni, vysoka, vystytul) VALUES(NULL, 'tsqm', 'tsqm', 'Iveta', 'Kasalová', {$this->var->superadmin}, 1, 1, 0, 1, 1, 1, 0, 0, 0, 0, 0);");
      }

      if (!$this->ExistujeTabulka("prava_ma_pristup"))  //spojovací tabulka práv a pristupu
      {
        if (!@$this->var->mysqli->multi_query("CREATE TABLE prava_ma_pristup (
                                              id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
                                              idprava INTEGER UNSIGNED NULL,
                                              idpristup INTEGER UNSIGNED NULL,
                                              PRIMARY KEY(id));
                                              "))
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
        }
      }

      if (!$this->ExistujeTabulka("fotozamestnanecmini"))  //tabulka fotek mini (N)
      {
        if (!@$this->var->mysqli->multi_query("CREATE TABLE fotozamestnanecmini (
                                              id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
                                              foto MEDIUMBLOB NULL,
                                              nazev VARCHAR(100) NULL,
                                              typ VARCHAR(20) NULL,
                                              PRIMARY KEY(id));
                                              "))
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
        }
      }

      if (!$this->ExistujeTabulka("fotozamestnanecfull"))  //tabulka fotek full (1)
      {
        if (!@$this->var->mysqli->multi_query("CREATE TABLE fotozamestnanecfull (
                                              id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
                                              foto LONGBLOB NULL,
                                              nazev VARCHAR(100) NULL,
                                              typ VARCHAR(20) NULL,
                                              PRIMARY KEY(id));
                                              "))
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
        }
      }

      if (!$this->ExistujeTabulka("zamestnanec_ma_foto"))  //spojovací tabulka zamestnance a fotogalerie ??????????????????????????
      {
        if (!@$this->var->mysqli->multi_query("CREATE TABLE zamestnanec_ma_foto (
                                              id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
                                              idzamestnanec INTEGER UNSIGNED NULL,
                                              idfotogalerie INTEGER UNSIGNED NULL,
                                              PRIMARY KEY(id));
                                              "))
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
        }
      }

      if (!$this->ExistujeTabulka("fotogalerie"))  //tabulka fotogalerie  ??????????????????????????????????????????????????
      {
        if (!@$this->var->mysqli->multi_query("CREATE TABLE fotogalerie (
                                              id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
                                              foto LONGBLOB NULL,
                                              nazev VARCHAR(100) NULL,
                                              typ VARCHAR(20) NULL,
                                              PRIMARY KEY(id));
                                              "))
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
        }
      }

      if (!$this->ExistujeTabulka("partner"))  //tabulka partneru
      {
        if (!@$this->var->mysqli->multi_query("CREATE TABLE partner (
                                              id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
                                              nazev VARCHAR(200) NULL,
                                              jmeno VARCHAR(50) NULL,
                                              prijmeni VARCHAR(50) NULL,
                                              ulice VARCHAR(100) NULL,
                                              cp INTEGER UNSIGNED NULL,
                                              psc INTEGER UNSIGNED NULL,
                                              mesto VARCHAR(100) NULL,
                                              idzeme INTEGER UNSIGNED NULL,
                                              predvolba VARCHAR(10) NULL,
                                              telefon VARCHAR(20) NULL,
                                              predvolba1 VARCHAR(10) NULL,
                                              telefon1 VARCHAR(20) NULL,
                                              email VARCHAR(50) NULL,
                                              pohlavi BOOL NULL,
                                              datumosloveni DATE NULL,
                                              datumkalkulace DATE NULL,
                                              datumpohovoru DATE NULL,
                                              datumzacatek DATE NULL,
                                              datumodmitnuti DATE NULL,
                                              datumkonec DATE NULL,
                                              idstatus INTEGER UNSIGNED NULL,
                                              celkovaspokojenost INTEGER UNSIGNED NULL,
                                              komentar TEXT NULL,
                                              pratelsky INTEGER UNSIGNED NULL,
                                              presnost INTEGER UNSIGNED NULL,
                                              kompetence INTEGER UNSIGNED NULL,
                                              komunikace INTEGER UNSIGNED NULL,
                                              vystupovani INTEGER UNSIGNED NULL,
                                              infodostatek BOOL NULL,
                                              infosrozumitelne INTEGER UNSIGNED NULL,
                                              infoustnisrozumitelne INTEGER UNSIGNED NULL,
                                              infohodnoceni INTEGER UNSIGNED NULL,
                                              terminkalkulace BOOL NULL,
                                              termindodani BOOL NULL,
                                              rozpocet BOOL NULL,
                                              odchylka FLOAT NULL,
                                              spokojenost INTEGER UNSIGNED NULL,
                                              PRIMARY KEY(id));
                                              "))
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
        }
      }

      if (!$this->ExistujeTabulka("partner_umi_jazyk"))  //spojovací tabulka partneru a jazyku
      {
        if (!@$this->var->mysqli->multi_query("CREATE TABLE partner_umi_jazyk (
                                              id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
                                              idpartner INTEGER UNSIGNED NULL,
                                              idjazyk INTEGER UNSIGNED NULL,
                                              PRIMARY KEY(id));
                                              "))
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
        }
      }

      if (!$this->ExistujeTabulka("fotopartnermini"))  //tabulka fotek partneru mini (N)
      {
        if (!@$this->var->mysqli->multi_query("CREATE TABLE fotopartnermini (
                                              id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
                                              foto MEDIUMBLOB NULL,
                                              nazev VARCHAR(100) NULL,
                                              typ VARCHAR(20) NULL,
                                              PRIMARY KEY(id));
                                              "))
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
        }
      }

      if (!$this->ExistujeTabulka("fotopartnerfull"))  //tabulka fotek partneru full (1)
      {
        if (!@$this->var->mysqli->multi_query("CREATE TABLE fotopartnerfull (
                                              id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
                                              foto LONGBLOB NULL,
                                              nazev VARCHAR(100) NULL,
                                              typ VARCHAR(20) NULL,
                                              PRIMARY KEY(id));
                                              "))
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
        }
      }

      if (!$this->ExistujeTabulka("zakaznik")) //tabulka zakaznika
      {
        if (!@$this->var->mysqli->multi_query("CREATE TABLE zakaznik (
                                              id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
                                              nazev VARCHAR(200) NULL,
                                              jmeno VARCHAR(50) NULL,
                                              prijmeni VARCHAR(50) NULL,
                                              ulice VARCHAR(100) NULL,
                                              cp INTEGER UNSIGNED NULL,
                                              psc INTEGER UNSIGNED NULL,
                                              mesto VARCHAR(100) NULL,
                                              idzeme INTEGER UNSIGNED NULL,
                                              predvolba VARCHAR(10) NULL,
                                              telefon VARCHAR(20) NULL,
                                              predvolba1 VARCHAR(10) NULL,
                                              telefon1 VARCHAR(20) NULL,
                                              email VARCHAR(50) NULL,
                                              pohlavi BOOL NULL,
                                              datumosloveni DATE NULL,
                                              datumkalkulace DATE NULL,
                                              datumpohovoru DATE NULL,
                                              datumzacatek DATE NULL,
                                              datumodmitnuti DATE NULL,
                                              datumkonec DATE NULL,
                                              idstatus INTEGER UNSIGNED NULL,
                                              celkovaspokojenost INTEGER UNSIGNED NULL,
                                              komentar TEXT NULL,
                                              PRIMARY KEY(id));
                                              "))
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
        }
      }

      if (!$this->ExistujeTabulka("zakaznik_umi_jazyk")) //spojovací tabulka zakazniku a jazyku
      {
        if (!@$this->var->mysqli->multi_query("CREATE TABLE zakaznik_umi_jazyk (
                                              id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
                                              idzakaznik INTEGER UNSIGNED NULL,
                                              idjazyk INTEGER UNSIGNED NULL,
                                              PRIMARY KEY(id));
                                              "))
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
        }
      }

      if (!$this->ExistujeTabulka("fotozakaznikmini")) //tabulka fotek zakazniku mini (N)
      {
        if (!@$this->var->mysqli->multi_query("CREATE TABLE fotozakaznikmini (
                                              id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
                                              foto MEDIUMBLOB NULL,
                                              nazev VARCHAR(100) NULL,
                                              typ VARCHAR(20) NULL,
                                              PRIMARY KEY(id));
                                              "))
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
        }
      }

      if (!$this->ExistujeTabulka("fotozakaznikfull")) //tabulka fotek zakazniku full (1)
      {
        if (!@$this->var->mysqli->multi_query("CREATE TABLE fotozakaznikfull (
                                              id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
                                              foto LONGBLOB NULL,
                                              nazev VARCHAR(100) NULL,
                                              typ VARCHAR(20) NULL,
                                              PRIMARY KEY(id));
                                              "))
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
        }
      }

      if (!$this->ExistujeTabulka("vzdelani")) //tabulka vzdelani
      {
        if (!@$this->var->mysqli->multi_query("CREATE TABLE vzdelani (
                                              id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
                                              vzdelani VARCHAR(100) NULL,
                                              PRIMARY KEY(id));
                                              "))
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
        }
        @$this->var->mysqli->multi_query("INSERT INTO vzdelani (id, vzdelani) VALUES(NULL, 'Pflichtschule');");
        @$this->var->mysqli->multi_query("INSERT INTO vzdelani (id, vzdelani) VALUES(NULL, 'Berufsschule');");
        @$this->var->mysqli->multi_query("INSERT INTO vzdelani (id, vzdelani) VALUES(NULL, 'Lehre Mittlereschule');");
        @$this->var->mysqli->multi_query("INSERT INTO vzdelani (id, vzdelani) VALUES(NULL, 'Fachschule Matura');");
        @$this->var->mysqli->multi_query("INSERT INTO vzdelani (id, vzdelani) VALUES(NULL, 'Akademische Abschluss');");
      }

      if (!$this->ExistujeTabulka("status")) //tabulka statusu
      {
        if (!@$this->var->mysqli->multi_query("CREATE TABLE status (
                                              id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
                                              status VARCHAR(100) NULL,
                                              PRIMARY KEY(id));
                                              "))
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
        }
        @$this->var->mysqli->multi_query("INSERT INTO status (id, status) VALUES(NULL, 'aktiv');");
        @$this->var->mysqli->multi_query("INSERT INTO status (id, status) VALUES(NULL, 'derzeit inaktiv');");
        @$this->var->mysqli->multi_query("INSERT INTO status (id, status) VALUES(NULL, 'abgelehnt');");
        @$this->var->mysqli->multi_query("INSERT INTO status (id, status) VALUES(NULL, 'gekündigt');");
        @$this->var->mysqli->multi_query("INSERT INTO status (id, status) VALUES(NULL, 'nach Bewerbung nicht mehr gemeldet');");
      }

      if (!$this->ExistujeTabulka("strankovani")) //tabulka strankovani
      {
        if (!@$this->var->mysqli->multi_query("CREATE TABLE strankovani (
                                              id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
                                              sekce VARCHAR(50) NULL,
                                              pocet INTEGER UNSIGNED NULL,
                                              PRIMARY KEY(id));

                                              
                                              
                                              
                                              "))
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
        }
        @$this->var->mysqli->multi_query("INSERT INTO strankovani (id, sekce, pocet) VALUES(NULL, 'zamestnanec', 20);");
        @$this->var->mysqli->multi_query("INSERT INTO strankovani (id, sekce, pocet) VALUES(NULL, 'partner', 20);");
        @$this->var->mysqli->multi_query("INSERT INTO strankovani (id, sekce, pocet) VALUES(NULL, 'zakaznik', 20);");
        //@$this->var->mysqli->multi_query("");
      }
//probrat...!! specifikace neni jednoznacna!!
      if (!$this->ExistujeTabulka("prognoza")) //tabulka prognoza
      {
        if (!@$this->var->mysqli->multi_query("CREATE TABLE prognoza (
                                              id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
                                              datum DATETIME NULL,
                                              od TIME NULL,
                                              do TIME NULL,
                                              zprava TEXT NULL,
                                              PRIMARY KEY(id));
                                              "))
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
        }
      }

      if (!$this->ExistujeTabulka("zamestnanec_ma_prognozu")) //tabulka zamestnanec_ma_prognozu
      {
        if (!@$this->var->mysqli->multi_query("CREATE TABLE zamestnanec_ma_prognozu (
                                              id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
                                              idzamestnanec INTEGER UNSIGNED NULL,
                                              idprognoza INTEGER UNSIGNED NULL,
                                              PRIMARY KEY(id));
                                              "))
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
        }
      }

      if (!$this->ExistujeTabulka("termin")) //tabulka termin
      {
        if (!@$this->var->mysqli->multi_query("CREATE TABLE termin (
                                              id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
                                              projekt INTEGER UNSIGNED NULL,
                                              datum DATETIME NULL,
                                              od TIME NULL,
                                              do TIME NULL,
                                              protokol TEXT NULL,
                                              status BOOL NULL,
                                              PRIMARY KEY(id));
                                              "))
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
        }
      }

      if (!$this->ExistujeTabulka("zamestnanec_ma_termin")) //tabulka zamestnanec_ma_termin
      {
        if (!@$this->var->mysqli->multi_query("CREATE TABLE zamestnanec_ma_termin (
                                              id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
                                              idzamestnanec INTEGER UNSIGNED NULL,
                                              idtermin INTEGER UNSIGNED NULL,
                                              PRIMARY KEY(id));
                                              "))
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
        }
      }

      if (!$this->ExistujeTabulka("projekt")) //tabulka projekt
      {
        if (!@$this->var->mysqli->multi_query("CREATE TABLE projekt (
                                              id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
                                              nazev VARCHAR(200) NULL,
                                              popis TEXT NULL,
                                              PRIMARY KEY(id));
                                              "))
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
        }
      }

      if (!$this->ExistujeTabulka("naklady")) //tabulka naklady
      {
        if (!@$this->var->mysqli->multi_query("CREATE TABLE naklady (
                                              id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
                                              plat INTEGER UNSIGNED NULL,
                                              hodiny FLOAT NULL,
                                              PRIMARY KEY(id));
                                              "))
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
        }
      }
    }
  }
//******************************************************************************
  function OtevriMySQLi() //otvírání DB
  {
    $this->var->mysqli = @new mysqli($this->var->login->host, $this->var->login->username, $this->var->login->password, $this->var->login->databaze, $this->var->login->port);
    if (!mysqli_connect_errno())	//objektové připojení do DB mysqli_connect_errno()
    {
      if (@$this->var->mysqli->multi_query("SET CHARACTER SET UTF8"))	//bez návratu testuje jen chybu s negací, natavit i znakovou sadu porovnavani!!!
      {
        $result = true;
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->myslqi->error);
      }
    }
      else
    {
      $result = false;
      $this->var->main->ErrorMsg(mysqli_connect_error());
    }

    return $result;
  }
//******************************************************************************
  function ZavriMySQLi()  //zavírání DB
  {
    $this->var->mysqli->close();
  }
//******************************************************************************
  function ExistujeTabulka($nazev)  //ověření existence tabulky
  {
    if ($res = @$this->var->mysqli->query("SHOW TABLES"))
    {
      $pex = 0;
      $tab = "Tables_in_{$this->var->login->databaze}";

      while ($data = $res->fetch_object())
      {
        if ($data->$tab == $nazev)
        {
          $pex++;
        }
      }

      $result = ($pex == 1 ? true : false);
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
    }

    return $result;
  }
//******************************************************************************
  function OdkazZ5($zpet = 1) //vraceč historie
  {
    $result = include "{$this->var->form}/odkaz_z5.php";

    return $result;
  }
//******************************************************************************
  function EmptyLine()  //prázdné pole
  {
    $result = include "{$this->var->form}/empty_line.php";

    return $result;
  }
//******************************************************************************
  function ErrorMsg($chyba)  //proecdura chybové hlášky
  {
    $this->var->chyba = include "{$this->var->form}/error_msg.php";
  }
//******************************************************************************
	function AutoClick($cas, $cesta)	//auto kliknutí, procedůra
	{
		$this->var->meta = "<meta http-equiv=\"refresh\" content=\"$cas;URL=$cesta\" />";
	}
//******************************************************************************
  function KontrolaLogin($jmeno, $heslo)  //kontrola loginů a nastavení práva
  {
    if ($res = @$this->var->mysqli->query("SELECT id, loginjmeno, loginheslo, idprava FROM zamestnanec WHERE
                                          loginjmeno='$jmeno' AND
                                          loginheslo='$heslo';"))
    {
      $data = $res->fetch_object();
      $this->var->prava = $data->idprava;
      $this->var->idzam = $data->id;
      $result = ($res->num_rows == 1 ? true : false);
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
    }

    return $result;
  }
//******************************************************************************
  function PristupOdkaz($sekce = "", $podsekce = "")  //funkce pro povolení/zákaz odkazu pro různé práva
  {
    $cislo = $this->var->pristup[$sekce][$podsekce];
    $id = $_GET["cislo"];

    if (Empty($cislo))
    {
      $cislo = 0;
    }

    if ($res = @$this->var->mysqli->query("SELECT prava_ma_pristup.idpristup FROM prava_ma_pristup, prava WHERE
                                          prava.id=prava_ma_pristup.idprava AND
                                          prava_ma_pristup.idpristup={$cislo} AND
                                          prava.id={$this->var->prava};"))
    {
      $result = ($res->num_rows >= 1 ? true : false);
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
    }

    return ($this->var->prava == $this->var->superadmin ? true : (!Empty($id) ? ($this->var->idzam == $id ? $result : false) : $result));
  }
//******************************************************************************
  function Pristup()  //rpzhoduje o přístupi na stránky
  {
    $cislo = $this->var->pristup[$this->var->kam][$_GET["akce"]];
    $id = $_GET["cislo"];

    if (Empty($cislo))
    {
      $cislo = 0;
    }

    if ($res = @$this->var->mysqli->query("SELECT prava_ma_pristup.idpristup FROM prava_ma_pristup, prava WHERE
                                          prava.id=prava_ma_pristup.idprava AND
                                          prava_ma_pristup.idpristup={$cislo} AND
                                          prava.id={$this->var->prava};"))
    {
      $result = ($res->num_rows >= 1 ? true : false);
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
    }
//24 == povoleni uvodu! + jel jine id zamestnance zadane v rezimu zam. -> nepovoleno
    return (($this->var->prava == $this->var->superadmin) || ($cislo == 24) ? true : (!Empty($id) ? ($this->var->idzam == $id ? $result : false) : $result));
  }
//******************************************************************************
	public $start, $konec;
	function MeritCas() //funkce pro vrácení času
	{
	  $cas = explode(" ", microtime());
		$soucet = $cas[1] + $cas[0];

		return $soucet;
	}
//******************************************************************************
	function StartCas() //zapis začátku
	{
		$this->start = $this->MeritCas();
	}
//******************************************************************************
	function KonecCas() //zápis konce a finální vypis doby
	{
		$this->konec = $this->MeritCas();
		$cas = Abs(Round(($this->konec - $this->start) * 10000) / 10000); //Abs, výpočet

		return include "{$this->var->form}/vygenerovano.php";
	}
//******************************************************************************
  function KontrolaNazvu($jmeno) //vrací nové jméno
	{
	  $prevod = array("ä›" => "e",
                    "ĺˇ" => "s",
                    "äť" => "c",
                    "ĺ™" => "r",
                    "ĺľ" => "z",
                    "ă˝" => "y",
                    "ăˇ" => "a",
                    "ă"  => "i",
                    "ă©" => "e",
                    "ăş" => "u",
                    "ĺż" => "u",
                    "ăł" => "o");
    $text = iconv("Windows-1250", "UTF-8", $jmeno);
    return strtr($text, $prevod);
	}
//******************************************************************************
  function Zeme($sekce)  //vypise zeme
  {
    if ($res = @$this->var->mysqli->query("SELECT id, zeme FROM zeme ORDER BY zeme ASC"))
    {
      if ($res->num_rows != 0)
      {
        $result = //výpis zemí
        "<select name=\"{$sekce}\">";
        while ($data = $res->fetch_object())
        {
          $result .=
          "
          <option value=\"$data->id\">$data->zeme</option>
          ";
        }
        $result .=
        "</select>";
      }
        else
      {
        $result = $this->var->main->EmptyLine();
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
    }

    return $result;
  }
//******************************************************************************
  function OznacenyEditZeme($id, $sekce) //vypise oznaceny selekt zeme
  {
    if ($res = @$this->var->mysqli->query("SELECT id, zeme FROM zeme ORDER BY zeme ASC"))
    {
      if ($res->num_rows != 0)
      {
        $result = //výpis zemí
        "<select name=\"{$sekce}\">";
        while ($data = $res->fetch_object())
        {
          $result .=
          "
          <option value=\"$data->id\" ".($data->id == $id ? "selected=\"selected\"" : "").">$data->zeme</option>
          ";
        }
        $result .=
        "</select>";
      }
        else
      {
        $result = $this->var->main->EmptyLine();
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
    }

    return $result;
  }
//******************************************************************************
  function Jazyk($sekce) //vypíše dostupné jazyky
  {
    if ($res = @$this->var->mysqli->query("SELECT id, jazyk FROM jazyk ORDER BY jazyk ASC"))
    {
      if ($res->num_rows != 0)
      {
        while ($data = $res->fetch_object())
        {
          $result .=
          "
          <input type=\"checkbox\" name=\"{$sekce}[]\" value=\"$data->id\" />$data->jazyk<br />
          ";
        }
      }
        else
      {
        $result = $this->var->main->EmptyLine();
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
    }

    return $result;
  }
//******************************************************************************
  function OznacenyJazyk($id, $db)  //vypíše označený jazyk textově pro: zamestnanec, partner, zakaznik
  {
    if ($res = @$this->var->mysqli->query("SELECT jazyk FROM {$db}, {$db}_umi_jazyk, jazyk WHERE  {$db}.id={$db}_umi_jazyk.id{$db} AND jazyk.id={$db}_umi_jazyk.idjazyk AND {$db}.id=$id ORDER BY jazyk ASC"))
    {
      if ($res->num_rows != 0)
      {
        while ($data = $res->fetch_object())
        {
          $result .=
          "$data->jazyk, ";
        }
        $result = substr($result, 0, -2);
      }
        else
      {
        $result = $this->var->main->EmptyLine();
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
    }

    return $result;
  }
//******************************************************************************
  function OznacenyEditJazyk($id, $db, $sekce)  //vypíše označený jazyk checkboxama, jmeno db+sekce
  {
    if ($res = @$this->var->mysqli->query("SELECT id, jazyk FROM jazyk ORDER BY jazyk ASC"))
    {
      if ($res->num_rows != 0)
      {
        if ($r = @$this->var->mysqli->query("SELECT idjazyk FROM {$db}_umi_jazyk WHERE id{$db}=$id"))
        {
          while ($d = $r->fetch_object())
          {
            $oznac[$d->idjazyk] = "checked=\"checked\"";
          }
        }
          else
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
        }

        while ($data = $res->fetch_object())
        {
          $result .=
          "
          <input type=\"checkbox\" name=\"{$sekce}[]\" value=\"$data->id\" {$oznac[$data->id]} />$data->jazyk<br />
          ";
        }
      }
        else
      {
        $result = $this->var->main->EmptyLine();
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
    }

    return $result;
  }
//******************************************************************************
  function OznacenyEditJazykHledani($sekce)  //vypíše označený jazyk checkboxama, jmeno db+sekce
  {
    if ($res = @$this->var->mysqli->query("SELECT id, jazyk FROM jazyk ORDER BY jazyk ASC"))
    {
      if ($res->num_rows != 0)
      {
        while ($data = $res->fetch_object())
        {
          $result .=
          "
          <input type=\"checkbox\" name=\"{$sekce}[]\" value=\"{$data->id}\" ".(!Empty($_POST[$sekce]) && in_array($data->id, $_POST[$sekce]) ? "checked=\"checked\"" : "")." />{$data->jazyk}<br />
          ";
        }
      }
        else
      {
        $result = $this->var->main->EmptyLine();
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
    }

    return $result;
  }
//******************************************************************************
  function Status($sekce) //vypíše dostupné jazyky
  {
    if ($res = @$this->var->mysqli->query("SELECT id, status FROM status ORDER BY id ASC"))
    {
      if ($res->num_rows != 0)
      {
        $result = //výpis zemí
        "<select name=\"{$sekce}\">";
        while ($data = $res->fetch_object())
        {
          $result .=
          "
          <option value=\"$data->id\" ".($data->id == $id ? "selected=\"selected\"" : "").">$data->status</option>
          ";
        }
        $result .=
        "</select>";
      }
        else
      {
        $result = $this->var->main->EmptyLine();
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
    }

    return $result;
  }
//******************************************************************************
  function OznacenyEditStatus($id, $sekce) //vypise oznaceny selekt zeme
  {
    if ($res = @$this->var->mysqli->query("SELECT id, status FROM status ORDER BY id ASC"))
    {
      if ($res->num_rows != 0)
      {
        $result = //výpis zemí
        "<select name=\"{$sekce}\">";
        while ($data = $res->fetch_object())
        {
          $result .=
          "
          <option value=\"$data->id\" ".($data->id == $id ? "selected=\"selected\"" : "").">$data->status</option>
          ";
        }
        $result .=
        "</select>";
      }
        else
      {
        $result = $this->var->main->EmptyLine();
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
    }

    return $result;
  }
//******************************************************************************
  function Procenta($sekce)  //vypíše precentualni vyber s definovanym jmenem
  {
    $result =
    "
    <select name=\"$sekce\">
    ";

    for ($i = 0; $i < count($this->var->procenta); $i++)
    {
      $result .=
      "<option value=\"{$this->var->procenta[$i]}\">{$this->var->procenta[$i]}</option>
      ";
    }

    $result .=
    "
    </select>
    ";

    return $result;
  }
//******************************************************************************
  function OzancenyEditProcenta($id, $sekce)  //vypíše precentualni vyber s definovanym jmenem a def id
  {
    $result =
    "
    <select name=\"$sekce\">
    ";

    for ($i = 0; $i < count($this->var->procenta); $i++)
    {
      $result .=
      "<option value=\"{$this->var->procenta[$i]}\" ".($this->var->procenta[$i] == $id ? "selected=\"selected\"" : "").">{$this->var->procenta[$i]}</option>
      ";
    }

    $result .=
    "
    </select>
    ";

    return $result;
  }
//******************************************************************************
  function RadioButton($nazev, $default = false, $true = "ano", $false = "ne")
  {
    $result =
    "
    <input type=\"radio\" name=\"{$nazev}\" ".($default ? "checked=\"checked\"" : "")." value=\"true\" />{$this->var->jazyk[$true]}
    <input type=\"radio\" name=\"{$nazev}\" ".(!$default ? "checked=\"checked\"" : "")." value=\"false\" />{$this->var->jazyk[$false]}
    ";

    return $result;
  }
//******************************************************************************
  function DrobeckovaNavigace() //generuje drobeckovou navigaci
  {
    $result = "<a href=\"./\" title=\"{$this->var->jazyk["uvod"]}\">{$this->var->jazyk["uvod"]}</a>".(!Empty($_GET["action"]) && $_GET["action"] != "uvod" ?
                " <strong>&raquo;</strong> <a href=\"?action={$_GET["action"]}\" title=\"{$this->var->jazyk[$this->var->title[$_GET["action"]][""]]}\">{$this->var->jazyk[$this->var->title[$_GET["action"]][""]]}</a>".(!Empty($_GET["akce"]) ?
                  " <strong>&raquo;</strong> <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}\" title=\"{$this->var->jazyk[$this->var->title[$_GET["action"]][$_GET["akce"]]]}\">{$this->var->jazyk[$this->var->title[$_GET["action"]][$_GET["akce"]]]}</a>"
                    :
                  "")
                  :
                "");

    return $result;
  }
//******************************************************************************
//******************************************************************************
  function AbecedniStrankovani()  //neapikovani
  {
    $abeceda = array ("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z");
    
    for ($i = 0; $i < count($abeceda); $i++)
    {
      if ($res = @$this->var->mysqli->query("SELECT count(*) as pocet FROM zamestnanec WHERE (zamestnanec.prijmeni LIKE('{$abeceda[$i]}%')) ORDER BY zamestnanec.prijmeni ASC, zamestnanec.jmeno ASC;"))
      {
        while ($data = $res->fetch_object())
        {
          $result .=
          " {$abeceda[$i]}...: {$data->pocet},
          ";
        }
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
      }
    }

    return $result;
  }
//******************************************************************************
	function Strankovani($db, &$od, &$poc) //strankovani, odkazem vracet: od a pocet na str.
	{
    if ($res = @$this->var->mysqli->query("SELECT pocet FROM strankovani WHERE sekce='{$db}';"))
    {
      $polozek = $res->fetch_object()->pocet; //zjisteni polozek na jednotlvou sekci
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
    }

    if ($res = @$this->var->mysqli->query("SELECT count(*) as pocet FROM {$db};"))
    {
      $pocet = $res->fetch_object()->pocet; //zjiseni pocet polozek v jednotlive sekci
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
    }

		$strana = $_GET["str"]; //stranka
		settype($strana, "integer");

		if ($polozek > 0)
    {
      $pocstr = ceil($pocet / $polozek);  //vypocet poctu stranek
    }

		if (Empty($strana) || ($strana > $pocstr && $strana != 0))
		{
			$strana = 1;
		}

		$num_zpet = $strana - 1;
		$num_dal = $strana + 1;

		$od = ($strana * $polozek) - $polozek;	//výpočet stránkování
		$poc = $polozek;

		if ($strana > 1)
		{
			$adresa = "<span>(</span><a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}&amp;str={$num_zpet}\" title=\"{$this->var->jazyk["predchozi"]}\">{$this->var->jazyk["predchozi"]}</a><span>)</span> ";
		}
			else
		{
			$adresa = "";
		}

		if ($pocstr >= 7)
		{
			if ($strana <= 3)	//začátek
			{
				for ($i = 1; $i < 4; $i++)
				{
          if ($i != $strana)
					{
						$adresa .= "<a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}&amp;str={$i}\" title=\"$i\">$i</a>".($i != 3 ? ", " : "");
					}
						else
					{
						$adresa .= "{$i}".($i != 3 ? ", " : "");
					}
				}

				$adresa .=
				"... <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}&amp;str={$pocstr}\" title=\"$pocstr\">$pocstr</a>";
			}

			if ($strana > 3 && $strana <= ($pocstr - 2))	//stred
			{
				$adresa .=
				"<a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}&amp;str=1\" title=\"1\">1</a>
				...
				<a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}&amp;str=".($strana - 1)."\" title=\"".($strana - 1)."\">".($strana - 1)."</a>,
				$strana,
				<a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}&amp;str=".($strana + 1)."\" title=\"".($strana + 1)."\">".($strana + 1)."</a>
				...
				<a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}&amp;str={$pocstr}\" title=\"$pocstr\">$pocstr</a>";
			}

			if ($strana > ($pocstr - 2))	//konec
			{
				$adresa .=
				"<a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}&amp;str=1\" title=\"1\">1</a>,
				...";

				$inv = 2;
				for ($i = 1; $i < 4; $i++)
				{
					if ($strana != ($pocstr - $inv))
					{
						$adresa .= "<a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}&amp;str=".($pocstr - $inv)."\" title=\"".($pocstr - $inv)."\">".($pocstr - $inv)."</a>".(($pocstr - $inv) != $pocstr ? ", " : "");
					}
						else
					{
						$adresa .= ($pocstr - $inv).(($pocstr - $inv) != $pocstr ? ", " : "");
					}
					$inv--;
				}
			}
		}
			else
		{
			for ($i = 1; $i <= $pocstr; $i++)
			{
				if ($strana == $i)	//doplnění čísel
				{
					$adresa .= "{$i}".($i != $pocstr ? ", " : "");
				}
					else
				{
					$adresa .= "<a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}&amp;str={$i}\" title=\"$i\">$i</a>".($i != $pocstr ? ", " : "");
				}
			} //end for
		}

		if ($strana < $pocstr)
		{
			$adresa .= " <span>(</span><a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}&amp;str={$num_dal}\" title=\"{$this->var->jazyk["dalsi"]}\">{$this->var->jazyk["dalsi"]}</a><span>)</span>";
		}
			else
		{
			$adresa .= "";
		}

		if ($adresa != "1")
		{
      $jdi = "
      <p>
        {$this->var->jazyk["gostrana"]}: {$adresa}
      </p>
      ";
    }
  		else
		{
      $jdi = "";
    }

		$result =
    "
    <div id=\"strankovani\">
      {$jdi}
      <p id=\"vpravo\">
        {$this->var->jazyk["strana"]}: {$strana} {$this->var->jazyk["stranaz"]} {$pocstr}, {$this->var->jazyk["nastranu"]}: {$polozek}<br />
        {$this->var->jazyk["countpol"]}: {$pocet}
      </p>
    </div>";  //<br />{$this->var->main->AbecedniStrankovani()}

    return $result;
	}
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
/*


                                          INSERT INTO pristup (id, sekce, podsekce) VALUES(1,  'logoff', NULL);
                                          INSERT INTO pristup (id, sekce, podsekce) VALUES(2,  'uvod', NULL);
                                          INSERT INTO pristup (id, sekce, podsekce) VALUES(3,  'zamestnanci', 'all');
                                          INSERT INTO pristup (id, sekce, podsekce) VALUES(4,  'zamestnanci', 'add');
                                          INSERT INTO pristup (id, sekce, podsekce) VALUES(5,  'zamestnanci', 'search');
                                          INSERT INTO pristup (id, sekce, podsekce) VALUES(6,  'zamestnanci', 'kompetence');
                                          INSERT INTO pristup (id, sekce, podsekce) VALUES(7,  'zamestnanci', 'foto');
                                          INSERT INTO pristup (id, sekce, podsekce) VALUES(8,  'zamestnanci', 'doba');
                                          INSERT INTO pristup (id, sekce, podsekce) VALUES(9,  'zamestnanci', 'terminy');
                                          INSERT INTO pristup (id, sekce, podsekce) VALUES(10, 'zamestnanci', 'statistika');
                                          INSERT INTO pristup (id, sekce, podsekce) VALUES(11, 'zamestnanci', 'naklady');
                                          INSERT INTO pristup (id, sekce, podsekce) VALUES(12, 'zamestnanci', 'prava');
                                          INSERT INTO pristup (id, sekce, podsekce) VALUES(13, 'zamestnanci', 'protokoly');

                                          INSERT INTO pristup (id, sekce, podsekce) VALUES(14, 'partneri', NULL);

                                          INSERT INTO pristup (id, sekce, podsekce) VALUES(15, 'admin', NULL);
                                          INSERT INTO pristup (id, sekce, podsekce) VALUES(16, 'admin', 'prava');



                                          INSERT INTO prava_ma_pristup (id, idprava, idpristup) VALUES(NULL, 1, 1);
                                          INSERT INTO prava_ma_pristup (id, idprava, idpristup) VALUES(NULL, 1, 2);
                                          INSERT INTO prava_ma_pristup (id, idprava, idpristup) VALUES(NULL, 1, 3);
                                          INSERT INTO prava_ma_pristup (id, idprava, idpristup) VALUES(NULL, 1, 4);
                                          INSERT INTO prava_ma_pristup (id, idprava, idpristup) VALUES(NULL, 1, 5);
                                          INSERT INTO prava_ma_pristup (id, idprava, idpristup) VALUES(NULL, 1, 6);
                                          INSERT INTO prava_ma_pristup (id, idprava, idpristup) VALUES(NULL, 1, 7);
                                          INSERT INTO prava_ma_pristup (id, idprava, idpristup) VALUES(NULL, 1, 8);
                                          INSERT INTO prava_ma_pristup (id, idprava, idpristup) VALUES(NULL, 1, 9);
                                          INSERT INTO prava_ma_pristup (id, idprava, idpristup) VALUES(NULL, 1, 10);
                                          INSERT INTO prava_ma_pristup (id, idprava, idpristup) VALUES(NULL, 1, 11);
                                          INSERT INTO prava_ma_pristup (id, idprava, idpristup) VALUES(NULL, 1, 12);
                                          INSERT INTO prava_ma_pristup (id, idprava, idpristup) VALUES(NULL, 1, 13);
                                          INSERT INTO prava_ma_pristup (id, idprava, idpristup) VALUES(NULL, 1, 14);
                                          INSERT INTO prava_ma_pristup (id, idprava, idpristup) VALUES(NULL, 1, 15);
                                          INSERT INTO prava_ma_pristup (id, idprava, idpristup) VALUES(NULL, 1, 16);

  function ZamestnanecZeme()  //vypise zeme
  {
    if ($res = @$this->var->mysqli->query("SELECT id, zeme FROM zeme ORDER BY zeme ASC"))
    {
      if ($res->num_rows != 0)
      {
        $result = //výpis zemí
        "<select name=\"zam_zeme\">";
        while ($data = $res->fetch_object())
        {
          $result .=
          "
          <option value=\"$data->id\">$data->zeme</option>
          ";
        }
        $result .=
        "</select>";
      }
        else
      {
        $result = $this->var->main->EmptyLine();
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
    }

    return $result;
  }
//******************************************************************************
  function ZamestnanecOznacenyZeme($id) //vypise oznaceny selekt zeme
  {
    if ($res = @$this->var->mysqli->query("SELECT id, zeme FROM zeme ORDER BY zeme ASC"))
    {
      if ($res->num_rows != 0)
      {
        $result = //výpis zemí
        "<select name=\"zam_zeme\">";
        while ($data = $res->fetch_object())
        {
          $result .=
          "
          <option value=\"$data->id\" ".($data->id == $id ? "selected=\"selected\"" : "").">$data->zeme</option>
          ";
        }
        $result .=
        "</select>";
      }
        else
      {
        $result = $this->var->main->EmptyLine();
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
    }

    return $result;
  }
//******************************************************************************
  function ZamestnanecJazyk() //vypíše dostupné jazyky
  {
    if ($res = @$this->var->mysqli->query("SELECT id, jazyk FROM jazyk ORDER BY jazyk ASC"))
    {
      if ($res->num_rows != 0)
      {
        while ($data = $res->fetch_object())
        {
          $result .=
          "
          <input type=\"checkbox\" name=\"zam_jazyk[]\" value=\"$data->id\" />$data->jazyk<br />
          ";
        }
      }
        else
      {
        $result = $this->var->main->EmptyLine();
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
    }

    return $result;
  }
//******************************************************************************
  function ZamestnanecOznacenyJazyk($id)  //vypíše označený jazyk textově
  {
    if ($res = @$this->var->mysqli->query("SELECT jazyk FROM zamestnanec, zamestnanec_umi_jazyk, jazyk WHERE  zamestnanec.id=zamestnanec_umi_jazyk.idzamestnanec AND jazyk.id=zamestnanec_umi_jazyk.idjazyk AND zamestnanec.id=$id ORDER BY jazyk ASC"))
    {
      if ($res->num_rows != 0)
      {
        while ($data = $res->fetch_object())
        {
          $result .=
          "$data->jazyk, ";
        }
      }
        else
      {
        $result = $this->var->main->EmptyLine();
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
    }

    return $result;
  }
//******************************************************************************
  function ZamestnanecOznacenyEditJazyk($id)  //vypíše označený jazyk checkboxama
  {
    if ($res = @$this->var->mysqli->query("SELECT id, jazyk FROM jazyk ORDER BY jazyk ASC"))
    {
      if ($res->num_rows != 0)
      {
        if ($r = @$this->var->mysqli->query("SELECT idjazyk FROM zamestnanec_umi_jazyk WHERE idzamestnanec=$id"))
        {
          while ($d = $r->fetch_object())
          {
            $oznac[$d->idjazyk] = "checked=\"checked\"";
          }
        }
          else
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
        }

        while ($data = $res->fetch_object())
        {
          $result .=
          "
          <input type=\"checkbox\" name=\"zam_jazyk[]\" value=\"$data->id\" {$oznac[$data->id]} />$data->jazyk<br />
          ";
        }
      }
        else
      {
        $result = $this->var->main->EmptyLine();
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
    }

    return $result;
  }
        if (strpos($_POST["search"][$i], "datum") === 0)  //kontrola datumovych polozek
        {
          $dotaz.= ;
          //$kde .= ($_POST["zpusob"] == "true" ? "({$_POST["search"][$i]} LIKE ('%".date("Y-m-d", strtotime($_POST["vyraz"]))."%')) {$_POST["logicky"]} " : "{$_POST["search"][$i]}='".date("Y-m-d", strtotime($_POST["vyraz"]))."' {$_POST["logicky"]} ");
        }
          else
        {
          $dotaz.= "{$_POST["search"][$i]}, ";
          //$kde .= ($_POST["zpusob"] == "true" ? "({$_POST["search"][$i]} LIKE ('%{$_POST["vyraz"]}%')) {$_POST["logicky"]} " : "{$_POST["search"][$i]}='{$_POST["vyraz"]}' {$_POST["logicky"]} ");
        }

        if (strpos($_POST["search"][$i], "datum") === 0)  //kontrola datumovych polozek
        {
          //$dotaz.= "DATE_FORMAT({$_POST["search"][$i]}, '{$this->var->mysqldatum}') as {$_POST["search"][$i]}, ";
          $kde .= ($_POST["zpusob"] == "true" ? "({$_POST["search"][$i]} LIKE ('%".date("Y-m-d", strtotime($_POST["vyraz"]))."%')) {$_POST["logicky"]} " : "{$_POST["search"][$i]}='".date("Y-m-d", strtotime($_POST["vyraz"]))."' {$_POST["logicky"]} ");
        }
          else
        {
          //$dotaz.= "{$_POST["search"][$i]}, ";
          $kde .= ($_POST["zpusob"] == "true" ? "({$_POST["search"][$i]} LIKE ('%{$_POST["vyraz"]}%')) {$_POST["logicky"]} " : "{$_POST["search"][$i]}='{$_POST["vyraz"]}' {$_POST["logicky"]} ");
        }*/
/*
sublink
KOMPETENZEN
-kazdemu zamestanci budou prirazeny kompetence
-nejlepe by bylo vytvorit prozesovou databazy.
-aby bylo mozne priradit cloveku kompetenze jsou potrebne nasledujici kroky:
skoleni, praxe a prezkouseni (Schulung, Praxis, Prüfung)
-po uspesne slozenem prezkouseni budou tomu zamestnaci prirazene kompetence.
-nejlepsi by bylo zobrazeni jednotlivych lidi s ruznymi prozesy - kde by se
ke kazdemu udelal hacek.


--------------------------------------------------
sublink
FOTOGALERIE
-tabulkovy format
-s fotkou ve velikosti pasove
-policka v teto tabulce by si clovek mohl sam editovat - to znamena nechat
si zobrazit jenom ty co chce
-jestli ze se klikne na to fotku dotycneho, tak se zobrazi pod sebou vsechny
fotky ktere jsou ulozene pro toho dotycneho
-vsechny fotky pod sebou ve velikosti 800 pixelu
-kdyz se klikne na prijmeni, tak se zobrazi formular s vyplnenimi daty
(takovy formular jako v zadavani)
----------------------------------------------

sublink
"Mitarbeiter suchen"
- vyhledavaci formular - kde se da vyhledavat podle vsech veci jako v
zadavacim formulari.
- vyhledane veci se zobrazi v tabulce (v takove jaka je u fotogalerie)

----------------------------------------------------

sublink "Arbeitszeiten"
pak prijdou nasledujici odkazy:

"Prognosen eintragen" (zapisovani prognos)
"Prognosen anzeigen" (ukazani prognos)
"Arbeitszeiten eintragen" (zapsani odpracovanych hodin - ne vzdy totiz sedi
prognosy - treba kdyz nekdo onemocnel  a nemohl prijit do prace)
"Arbeitszeiten anzeigen pro Woche
Arbeitszeiten anzeigen pro Monat" (ukazani odpracovanych hodin)
"Tagesplan anzeigen" (ukazani denniho planu)
"Wochenplan anzeigen pro Mitarbeiter" (ukazani tydeniho planu)
"Monatsplan anzeigen pro Mitarbeiter" (ukazani mesicniho planu)
---------------------------------------------------------
\"Prognosen eintragen\"
-tady bude mit kazdy jednotlivy zamestnanec pristup na  zadavaci formular,
kde
bude moci do stredy do pulnoci zapsat svoje prognosy.
-kazdy bude mit moznost zadava sve vlastni prognosy
-kazdy bude moci svoje prognosy moci editovat  a menit - ale to do
nejpozdeji do ctvrka do poledne!
-pak uz nesmi mit moznost menit jednotlive veci.
-mohou mit ale moznost zadavat prognosy na dalsi tydny a to neomezene do
predu
-proto tam musi byt definovane datumove pole.

 \"Tagesplan anzeigen\"
-kazdy zamestnanec uvidi sve vlastni prognosy za den
-vedeni a personalni oddeleni uvidi vsechny prognosy

 \"Wochenplan anzeigen pro Mitarbeiter\"
-kazdy zamestnanec uvidi sve vlastni prognosy za tyden
-vedeni a personalni oddeleni uvidi vsechny prognosy

 \"Monatsplan anzeigen pro Mitarbeiter\"
-kazdy zamestnanec uvidi sve vlastni prognosy za mesic
-vedeni a personalni oddeleni uvidi vsechny prognosy

 \"Arbeitszeiten anzeigen pro Tag\"
-kazdy jednotlivy zamestnance bude zapisovat sve odpracovane hodiny sam.
-kazdy vidi jen sam sebe
-vedeni vidi vsechny

 \"Arbeitszeiten anzeigen pro Woche\"
-to stejne co pred tim jenom za tyden

 \"Arbeitszeiten anzeigen pro Monat\"
-to stejne co pred tim jenom za mesic


 \"Tagesplan anzeigen\"
-ukazani celeho denniho planu vsech zamestnancu - vidi jenom vedeni

 \"Wochenplan anzeigen pro Mitarbeiter\"
-vyber zamestnance a ukazani celeho tydne, jak bude pracovat

 \"Monatsplan anzeigen pro Mitarbeiter\"
-ukazani celeho mesice a vyber zamestnance, jak bude cely mesic pracovat
-----------------------------------------------------

"Arbeitszeitenstatistik"
-Tagestatistik - denni statistika pro zamestance - diagram - ten kdo bude
mit nejvic hodin, bude
uplne nahore, ten kdo nejmi bude dole (sestupne razene)
-Wochenstatistik pro Mitarbeiter - je potreba vybrat urcity tyden a pak se
nahore zobrazi diagram zase setupne razeny, podle
celkoveho poctu odpracovanych hodin.
-Jahresstatistik pro Mitarbeiter - zase moznost vyberu roku a zobrazeni
diagramu

- moznost vyberu roku, mesice, tydnu a dnu - a pak vsechny diagramy pod
sebou
-Zuverlässlichkeitsstatistik - to bude rozdil v odpracovanych hodinach a
prognosach
---------------------------------------------------------
"Kostenrechnung"
-tady bude mit pristup jenom vedeni
-odkaz: Honorar eingeben (plat v eurech)
-moznost vyberu z 300, 400, 500, 600, 700, 800, 900, 1000 Euro
-kazdemu zamestananci se budou pocitat hodiny - od jedne do nekonecna:
- honorar se bude pocitat na urcite hodiny:
- ke kazdemu zamestanci se zapise kolik ma za 160 hodin a ty hodiny se mu
budou pocitat podle
odpracovanych hodin.
-nektery pracuji ale za zpracovany dotaznik - musi zpracovat 2000 kusu
dotazniku, ktery jim pocita ale jiny system.
Toto cislo bych jim musela nekam vzdy treba jednou tydne zapsat.

-je potrabe udelat i statistika
-kolik dosal dotycny zamestnanec za mesic, za rok
-potom celkove kolk plati firma tsqm za tyden na honorarich
-kolik za mesic vyplacime na honorarich
a kolik za rok
-jakmile budeme mit prirazene jednotlive lidi k projektum a prozessum, tak i
statistiky kolik vyplacime za
jednotlive projekty

------------------------------------------------------------------

BERECHTIGUNGEN (prava)
-kazdy zamestnanec se dostane ke svemu
-vedeni se dostane na vsechno
-hesla muze davat vedeni a lidi s opravnenim zakladat nove lidi

Prava 1:
Vedeni - uvidi vsechno

Prava 2:
pridavani lidi, a editace vsech prognos - zbytek ale jenom svoje veci

Prava 3:
jenom svoje veci

--------------------------------------------------------------

TAGESPROTOKOLLE
-kazdy zamestnanec musi pul hodiny pred ukoncenim pracovni doby napsat
protokol, co
delal a co stihl
-na to musi existovat v databazi policko, kam by to mohl zapsat.
-musi tam byt datum. Pokud mel ale dotycny zamestnanec prirazene terminy a
ukoly, kam
jiz v te databazi napsal protokol, tak by mel mit automaticky moznost nechat
zapsat do
automaticky do toho denniho protokolu.
-kdyz se klikne na vypis zamestnancu, tak by se mely tyto denni protokoly
zobrazit pod sebou.
-------------------------------------------------------------
*/





/*
nic...
      case "add_progn":
        $datum = date("Y-m-d H:i:s");
        $result =
        "přidat
        <form action=\"\" method=\"post\">
          <fieldset>
            datum: <input type=\"text\" name=\"datum\" value=\"$datum\">YYYY-MM-DD HH:MM:SS<br />
            od: <input type=\"text\" name=\"oddatum\" value=\"$datum\"><br />
            do:<input type=\"text\" name=\"dodatum\" value=\"$datum\"><br />
            kalendář!! na další 3-5 týdny...<br />
            zámek nastavit dopředu<br />
            {$this->Kalendar()}
          </fieldset>
        </form>
        ";

      break;
//******************************************************************************
      case "edit_progn":
        $result =
        "upravit";

      break;
//******************************************************************************
      case "del_progn":
        $result =
        "smazat";

      break;
//******************************************************************************
*/
/*
    if ($res = @$this->mysqli->query(""))
    {
       $poc = $res->num_rows;
       while ($data = $res->fetch_object())
       {

       }
    }
      else
    {
      $this->chyba = $this->var->main->ErrorMsg($this->mysqli->error);	//chyba do globální proměnné
    }

    if (!@$this->mysqli->multi_query(""))
    {
      $this->chyba = $this->var->main->ErrorMsg($this->mysqli->error);	//chyba do globální proměnné
    }

    {$this->jazyk[""]}
*/
}
?>
