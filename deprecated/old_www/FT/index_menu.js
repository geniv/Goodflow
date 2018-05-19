var p=0;
function ob(p)
{
switch(p)
{
case 1:uvod.src='button_uvod_a.gif';
break;
case 2:uvod.src='button_uvod_b.gif';
break;
case 3:uvodhtm();
break;
case 4:galerie.src='button_galerie_a.gif';
break;
case 5:galerie.src='button_galerie_b.gif';
break;
case 6:galeriehtm();
break;
case 7:download.src='button_download_a.gif';
break;
case 8:download.src='button_download_b.gif';
break;
case 9:downloadhtm();
break;
case 10:projekty.src='button_projekty_a.gif';
break;
case 11:projekty.src='button_projekty_b.gif';
break;
case 12:projektyhtm();
break;
case 13:navody.src='button_navody_a.gif';
break;
case 14:navody.src='button_navody_b.gif';
break;
case 15:navodyhtm();
break;
case 16:zajimavosti.src='button_zajimavosti_a.gif';
break;
case 17:zajimavosti.src='button_zajimavosti_b.gif';
break;
case 18:zajimavostihtm();
break;
case 19:odkazy.src='button_odkazy_a.gif';
break;
case 20:odkazy.src='button_odkazy_b.gif';
break;
case 21:odkazyhtm();
break;
case 22:ankety.src='button_ankety_a.gif';
break;
case 23:ankety.src='button_ankety_b.gif';
break;
case 24:anketyhtm();
break;
case 25:miniforum.src='button_miniforum_a.gif';
break;
case 26:miniforum.src='button_miniforum_b.gif';
break;
case 27:miniforumhtm();
break;
case 28:pocitadla.src='button_pocitadla_a.gif';
break;
case 29:pocitadla.src='button_pocitadla_b.gif';
break;
case 30:pocitadlahtm();
break;
case 31:napistemi.src='button_napistemi_a.gif';
break;
case 32:napistemi.src='button_napistemi_b.gif';
break;
case 33:napistemihtm();
break;
case 34:odpovedi.src='button_odpovedi_a.gif';
break;
case 35:odpovedi.src='button_odpovedi_b.gif';
break;
case 36:odpovedihtm();
break;
case 37:kontakt.src='button_kontakt_a.gif';
break;
case 38:kontakt.src='button_kontakt_b.gif';
break;
case 39:kontakthtm();
break;
case 40:nabizim.src='button_nabizim_a.gif';
break;
case 41:nabizim.src='button_nabizim_b.gif';
break;
case 42:nabizimhtm();
break;
}
}
function uvodhtm()
{
uvod.src='button_uvod_c.gif';
location.href='index.htm';
}
function galeriehtm()
{
galerie.src='button_galerie_c.gif';
location.href='galerie_htm.htm';
}
function downloadhtm()
{
download.src='button_download_c.gif';
location.href='download_htm.htm';
}
function projektyhtm()
{
projekty.src='button_projekty_c.gif';
location.href='projekty_htm.htm';
}
function navodyhtm()
{
navody.src='button_navody_c.gif';
location.href='navody_htm.htm';
}
function zajimavostihtm()
{
zajimavosti.src='button_zajimavosti_c.gif';
location.href='zajimavosti_htm.htm';
}
function odkazyhtm()
{
odkazy.src='button_odkazy_c.gif';
location.href='odkazy_htm.htm';
}
function anketyhtm()
{
ankety.src='button_ankety_c.gif';
location.href='ankety_htm.htm';
}
function miniforumhtm()
{
miniforum.src='button_miniforum_c.gif';
location.href='miniforum_htm.htm';
}
function pocitadlahtm()
{
pocitadla.src='button_pocitadla_c.gif';
location.href='pocitadla_htm.htm';
}
function napistemihtm()
{
napistemi.src='button_napistemi_c.gif';
location.href='napistemi_htm.htm';
}
function odpovedihtm()
{
odpovedi.src='button_odpovedi_c.gif';
location.href='odpovedi_htm.htm';
}
function kontakthtm()
{
kontakt.src='button_kontakt_c.gif';
location.href='kontakt_htm.htm';
}
function nabizimhtm()
{
nabizim.src='button_nabizim_c.gif';
location.href='nabizim_htm.htm';
}
function ob2()
{
if (screen.width<1024)
{
 clo.style.color="#711010";
}
else
{
 clo.style.color="#ffffff";
}
clo.innerText=screen.width+"x"+screen.height;
}