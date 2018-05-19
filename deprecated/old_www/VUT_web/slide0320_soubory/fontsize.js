function winH() {
   if (window.innerHeight)
      /* NN4 a kompatibiln� prohl�e�e */
      return window.innerHeight;
   else if
   (document.documentElement &&
   document.documentElement.clientHeight)
      /* MSIE6 v std. re�imu - Opera a Mozilla
      ji� usp�ly s window.innerHeight */
      return document.documentElement.clientHeight;
   else if
   (document.body && document.body.clientHeight)
      /* star�� MSIE + MSIE6 v quirk re�imu */
      return document.body.clientHeight;
   else
      return null;
}

function winW() {
   if (window.innerWidth)
      return window.innerWidth;
   else if
   (document.documentElement &&
   document.documentElement.clientHeight)
      return document.documentElement.clientWidth;
   else if
   (document.body && document.body.clientWidth)
      return document.body.clientWidth;
   else
      return null;
}

function newSize()
{
	var fsizeh = winW() / 35;  /* vyladeno pro pomer stran 4:3 */
	var fsizev = winH() / 25;
	var fsize = (fsizev < fsizeh) ? fsizev : fsizeh;
	var slw = winW();
	var slh = winH();
	document.write('<style type="text/css">');
	document.write('body { font-size: '+fsize+'px; }');
	document.write('.slide { width: '+slw+'px; height: '+slh+'px; }');
	document.write('</style>');
}
newSize();
