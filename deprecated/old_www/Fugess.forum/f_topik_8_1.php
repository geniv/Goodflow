--ZPR--SMD blikaè øízený procesorem ATtiny12--ZPR--Zapojení s mikroprocesory jsou velice jednoduchá protože odpadá mnoho desítek souèástek, které v klasickém zapojení byli zapotøebí. Mluvím zde o øadì mikroprocesorù (dále již MCU) ATMEL AVR ([url=:http://www.atmel.com/products/:]http://www.atmel.com/products/[/url]), které se mi skvìle osvìdèily. Jen malá odboèka, chtìl jsem pùvodnì zaèít s MCU typu PIC 16Fxx, jelikož jsem v té dobì nechápal programovací algoritmy a nedokázal splašit levný a spolehlivý programátor tak jsem se letošní vánoce vrhl na MCU øady AVR. Jedná se o novou øadu, která již [b]nevychází[/b] z øady x51. Tato nová øada má dost interních periferií které se dají s úspìchem používat. 
Tedy k tomu blikaèi. Je zde použit MCU typu ATtiny12 SMD, cena je asi 26Kè, MCU má jednu necelou bránu tzn. že má jen 5 I/O pinù. Je v pouzdøe SOIC 8, má tudíž 8 nožièek... Je zde zapojených 5 LED smd ve velikosti 1206 zemí do MCU. Tyto MCU dokážou tímto zpùsobem spínat mnohem vìtší proudy, tzn. spínají na log0 oproti spínání na log1.
Schéma jak vidíte je velice jednoduché...funkce neomezená!

[img]http://geniv.ic.cz/blik_AT12.gif[/img]

pozn.: ta propojka je tam z dùvodu aby bylo možné MCU naprogramovat pøímo v aplikaci; diody mohou bát libovolné barvy a velikosti; kondík na napájení je tam kvùli rušení.
Ovšem samotné zapojení když ho složíte nebude dìlat nic! Proè? Protože každý MCU se musí naprogramovat k tomu tam jsou ty konektory bokem.
Aby vám to "nìco dìlalo" taj je zapotøebí MCU naprogramovat...
program pro nìjakou obsluhu 5 LED pro toto zapojení je:

[code].NOLIST
.include "tn12def.inc"
.LIST

.def ce1	=r16
.def ce2	=r17
.def ce3	=r19
.def temp	=r18
.def poc	=r20
.equ max	=2
.equ doin	=0
.equ pred	=5
.cseg
clr poc
ser temp
out osccal,temp
ldi temp,31
out ddrB,temp
out portB,temp
ldi ce3,max
ldi temp,1

hc:
dec ce1
brne hc
dec ce2
brne hc
dec ce3
brne hc
ldi ce3,max
inc poc		;++
cpi poc,2
breq hc1
cpi poc,4
breq hc2
cpi poc,6
breq hc3
cpi poc,8
breq hc4
cpi poc,10
breq hc5
cpi poc,12
breq hc6
cpi poc,14
breq hc7
cpi poc,16
breq hc8
rjmp hc

hc1:
ldi temp,27	;2
out portB,temp
rjmp hc

hc2:
ldi temp,29	;1
out portB,temp
rjmp hc

hc3:
ldi temp,30	;0
out portB,temp
rjmp hc

hc4:
ldi temp,15	;4
out portB,temp
rjmp hc

hc5:
ldi temp,23	;3
out portB,temp
rjmp hc

hc6:
ldi temp,15	;4
out portB,temp
rjmp hc

hc7:
ldi temp,30	;0
out portB,temp
rjmp hc

hc8:
ldi temp,29	;1
out portB,temp
clr poc
rjmp hc
[/code]
Programátor je k dispozici na: [url=:http://www.lancos.com/siprogsch.html:]http://www.lancos.com/siprogsch.html[/url]
Ještì abych nezapomnìl tak tady je schéma rozložení pinù na MCU typu ATtiny12:

[img]http://geniv.ic.cz/ATtiny12_rozl.gif[/img]--ZPR--0--ZPR--Fugess--ZPR--64516415111111454611251150211--ZPR--127.0.0.1--ZPR--1.5.--ZPR--pondìlí, 30 duben, 2007 15:25--ZPR--fotky--ZPR--A tady pár fotek realizovaného blikaèe

Ve standardním provedení
[img]http://www.multipics.net/img/P3234486kopie.jpg[/img]

Procesor ATtiny12 v SMD
[img]http://www.multipics.net/img/P3234482kopie.jpg[/img]

Realizovaný blikaè v SMD
[img]http://www.multipics.net/img/P3174447kopie.jpg[/img]

v porovnání s korunou
[img]http://www.multipics.net/img/P3174448kopie.jpg[/img]

to samé, akorát ve svitu bílé SMD
[img]http://www.multipics.net/img/P3174450kopie.jpg[/img]

svit SMD diod ve tmì
[img]http://www.multipics.net/img/P3174463kopie.jpg[/img]

po výmìnì SMD procesoru ATtiny12
[img]http://www.multipics.net/img/P4074646kopie.jpg[/img]

to samé se svitem skoro všech diod
[img]http://www.multipics.net/img/P4074621kopie.jpg[/img]

ve tmì bílá SMD ledka
[img]http://www.multipics.net/img/P4074592kopie.jpg[/img]

v tmavém prostøedí se svitem tøí SMD diod
[img]http://www.multipics.net/img/P4074585kopie.jpg[/img]

Pøi dalším naprogramování jsme testovali písmena, a fungovalo to pìknì  :)
[img]http://www.multipics.net/img/P3174456kopie.jpg[/img]

ještì jsem i testoval podržení závìrky
[img]http://www.multipics.net/img/P3174455kopie.jpg[/img]

Na tìchto fotkách byl SMD blikaè nìkolikrát naprogramován a pokaždé jinak.--ZPR--0--ZPR--Fugess--ZPR--64516415111111454611251150211--ZPR--127.0.0.1--ZPR--1.5.--ZPR--pondìlí, 30 duben, 2007 15:25--ZPR----ZPR--(èlánky výše jsem psal já...) Nyní pracuju s bratrem na digitálních hodinách s LED displeji kreré má ovládat ATtiny12, je to neuvìøitelné, ale je to tak.
Vše závisí na IO 74HC595 (shift registr s latenèní pamìtí) a FW mcu. Schéma je navržené, teï jen aby to brácha postavil a já to s toho oživil. 8) --ZPR--0--ZPR--Geniv--ZPR--032171593710662699158008258787825872--ZPR--194.213.231.195--ZPR--2.5.--ZPR--støeda, 2 kvìten, 2007 05:19