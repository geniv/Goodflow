--ZPR--SMD blika� ��zen� procesorem ATtiny12--ZPR--Zapojen� s mikroprocesory jsou velice jednoduch� proto�e odpad� mnoho des�tek sou��stek, kter� v klasick�m zapojen� byli zapot�eb�. Mluv�m zde o �ad� mikroprocesor� (d�le ji� MCU) ATMEL AVR ([url=:http://www.atmel.com/products/:]http://www.atmel.com/products/[/url]), kter� se mi skv�le osv�d�ily. Jen mal� odbo�ka, cht�l jsem p�vodn� za��t s MCU typu PIC 16Fxx, jeliko� jsem v t� dob� nech�pal programovac� algoritmy a nedok�zal spla�it levn� a spolehliv� program�tor tak jsem se leto�n� v�noce vrhl na MCU �ady AVR. Jedn� se o novou �adu, kter� ji� [b]nevych�z�[/b] z �ady x51. Tato nov� �ada m� dost intern�ch periferi� kter� se daj� s �sp�chem pou��vat. 
Tedy k tomu blika�i. Je zde pou�it MCU typu ATtiny12 SMD, cena je asi 26K�, MCU m� jednu necelou br�nu tzn. �e m� jen 5 I/O pin�. Je v pouzd�e SOIC 8, m� tud� 8 no�i�ek... Je zde zapojen�ch 5 LED smd ve velikosti 1206 zem� do MCU. Tyto MCU dok�ou t�mto zp�sobem sp�nat mnohem v�t�� proudy, tzn. sp�naj� na log0 oproti sp�n�n� na log1.
Sch�ma jak vid�te je velice jednoduch�...funkce neomezen�!

[img]http://geniv.ic.cz/blik_AT12.gif[/img]

pozn.: ta propojka je tam z d�vodu aby bylo mo�n� MCU naprogramovat p��mo v aplikaci; diody mohou b�t libovoln� barvy a velikosti; kond�k na nap�jen� je tam kv�li ru�en�.
Ov�em samotn� zapojen� kdy� ho slo��te nebude d�lat nic! Pro�? Proto�e ka�d� MCU se mus� naprogramovat k tomu tam jsou ty konektory bokem.
Aby v�m to "n�co d�lalo" taj je zapot�eb� MCU naprogramovat...
program pro n�jakou obsluhu 5 LED pro toto zapojen� je:

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
Program�tor je k dispozici na: [url=:http://www.lancos.com/siprogsch.html:]http://www.lancos.com/siprogsch.html[/url]
Je�t� abych nezapomn�l tak tady je sch�ma rozlo�en� pin� na MCU typu ATtiny12:

[img]http://geniv.ic.cz/ATtiny12_rozl.gif[/img]--ZPR--0--ZPR--Fugess--ZPR--64516415111111454611251150211--ZPR--127.0.0.1--ZPR--1.5.--ZPR--pond�l�, 30 duben, 2007 15:25--ZPR--fotky--ZPR--A tady p�r fotek realizovan�ho blika�e

Ve standardn�m proveden�
[img]http://www.multipics.net/img/P3234486kopie.jpg[/img]

Procesor ATtiny12 v SMD
[img]http://www.multipics.net/img/P3234482kopie.jpg[/img]

Realizovan� blika� v SMD
[img]http://www.multipics.net/img/P3174447kopie.jpg[/img]

v porovn�n� s korunou
[img]http://www.multipics.net/img/P3174448kopie.jpg[/img]

to sam�, akor�t ve svitu b�l� SMD
[img]http://www.multipics.net/img/P3174450kopie.jpg[/img]

svit SMD diod ve tm�
[img]http://www.multipics.net/img/P3174463kopie.jpg[/img]

po v�m�n� SMD procesoru ATtiny12
[img]http://www.multipics.net/img/P4074646kopie.jpg[/img]

to sam� se svitem skoro v�ech diod
[img]http://www.multipics.net/img/P4074621kopie.jpg[/img]

ve tm� b�l� SMD ledka
[img]http://www.multipics.net/img/P4074592kopie.jpg[/img]

v tmav�m prost�ed� se svitem t�� SMD diod
[img]http://www.multipics.net/img/P4074585kopie.jpg[/img]

P�i dal��m naprogramov�n� jsme testovali p�smena, a fungovalo to p�kn�  :)
[img]http://www.multipics.net/img/P3174456kopie.jpg[/img]

je�t� jsem i testoval podr�en� z�v�rky
[img]http://www.multipics.net/img/P3174455kopie.jpg[/img]

Na t�chto fotk�ch byl SMD blika� n�kolikr�t naprogramov�n a poka�d� jinak.--ZPR--0--ZPR--Fugess--ZPR--64516415111111454611251150211--ZPR--127.0.0.1--ZPR--1.5.--ZPR--pond�l�, 30 duben, 2007 15:25--ZPR----ZPR--(�l�nky v��e jsem psal j�...) Nyn� pracuju s bratrem na digit�ln�ch hodin�ch s LED displeji krer� m� ovl�dat ATtiny12, je to neuv��iteln�, ale je to tak.
V�e z�vis� na IO 74HC595 (shift registr s laten�n� pam�t�) a FW mcu. Sch�ma je navr�en�, te� jen aby to br�cha postavil a j� to s toho o�ivil. 8) --ZPR--0--ZPR--Geniv--ZPR--032171593710662699158008258787825872--ZPR--194.213.231.195--ZPR--2.5.--ZPR--st�eda, 2 kv�ten, 2007 05:19