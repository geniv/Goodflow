//�Xara Ltd
if(typeof(loc)=="undefined"||loc==""){var loc="";if(document.body&&document.body.innerHTML){var tt=document.body.innerHTML;var ml=tt.match(/["']([^'"]*)menu_.js["']/i);if(ml && ml.length > 1) loc=ml[1];}}

var bd=0
document.write("<style type=\"text/css\">");
document.write("\n<!--\n");
document.write(".menu__menu {z-index:999;border-color:#000000;border-style:solid;border-width:"+bd+"px 0px "+bd+"px 0px;background-color:#ff7f00;position:absolute;left:0px;top:0px;visibility:hidden;}");
document.write(".menu__plain, a.menu__plain:link, a.menu__plain:visited{text-align:left;background-color:#ff7f00;color:#ffffff;text-decoration:none;border-color:#000000;border-style:solid;border-width:0px "+bd+"px 0px "+bd+"px;padding:2px 0px 2px 0px;cursor:hand;display:block;font-size:8pt;font-family:Arial, Helvetica, sans-serif;}");
document.write("a.menu__plain:hover, a.menu__plain:active{background-color:#d30903;color:#ffffff;text-decoration:none;border-color:#000000;border-style:solid;border-width:0px "+bd+"px 0px "+bd+"px;padding:2px 0px 2px 0px;cursor:hand;display:block;font-size:8pt;font-family:Arial, Helvetica, sans-serif;}");
document.write("\n-->\n");
document.write("</style>");

var fc=0xffffff;
var bc=0xd30903;
if(typeof(frames)=="undefined"){var frames=0;}

startMainMenu("",0,0,1,0,0)
mainMenuItem("menu__b1",".png",27,120,loc+"aaaaaaaaaaa","bbbbbbbbbbbbbbbbbb","Aktuality",2,2,"menu__plain");
mainMenuItem("menu__b2",".png",27,120,"javascript:;","","Z�kladn� �daje",2,2,"menu__plain");
mainMenuItem("menu__b3",".png",27,120,"javascript:;","","Historie",2,2,"menu__plain");
mainMenuItem("menu__b4",".png",27,120,"javascript:;","","Obecn� ��ad",1,2,"menu__plain");
mainMenuItem("menu__b5",".png",27,120,"javascript:;","","Kutura",1,2,"menu__plain");
mainMenuItem("menu__b6",".png",27,120,"javascript:;","","Doprava",2,2,"menu__plain");
mainMenuItem("menu__b7",".png",27,120,"javascript:;","","Fotogalerie",1,2,"menu__plain");
mainMenuItem("menu__b8",".png",27,120,"javascript:;","","Hasi�i",2,2,"menu__plain");
mainMenuItem("menu__b9",".png",27,120,"javascript:;","","Adres��",2,2,"menu__plain");
mainMenuItem("menu__b10",".png",27,120,"javascript:;","","F�rum",2,2,"menu__plain");
mainMenuItem("menu__b11",".png",27,120,"javascript:;","","Turistika",1,2,"menu__plain");
mainMenuItem("menu__b12",".png",27,120,"javascript:;","","U�ite�n� odkazy",2,2,"menu__plain");
mainMenuItem("menu__b13",".png",27,120,"javascript:;","","Internet",2,2,"menu__plain");
mainMenuItem("menu__b14",".png",27,120,"javascript:;","","Obecn� knihovna",2,2,"menu__plain");
endMainMenu("",0,0);

startSubmenu("menu__b11","menu__menu",83);
submenuItem("Cyklostezky","javascript:;","","menu__plain");
submenuItem("Okoln� hrady","javascript:;","","menu__plain");
submenuItem("Zaj�mav� m�sta","javascript:;","","menu__plain");
endSubmenu("menu__b11");

startSubmenu("menu__b7","menu__menu",75);
submenuItem("Hlup�n v zim�","javascript:;","","menu__plain");
endSubmenu("menu__b7");

startSubmenu("menu__b5","menu__menu",93);
submenuItem("Hry pro v�echny","javascript:;","","menu__plain");
submenuItem("Fotbal","javascript:;","","menu__plain");
submenuItem("Hasi�sk� klub","javascript:;","","menu__plain");
endSubmenu("menu__b5");

startSubmenu("menu__b4","menu__menu",75);
submenuItem("Kontakty","javascript:;","","menu__plain");
submenuItem("Povinn� info","javascript:;","","menu__plain");
submenuItem("��edn� deska","javascript:;","","menu__plain");
submenuItem("Zastupitel�","javascript:;","","menu__plain");
submenuItem("Z�pisy","javascript:;","","menu__plain");
submenuItem("Vyhl�ky","javascript:;","","menu__plain");
endSubmenu("menu__b4");

loc="";
