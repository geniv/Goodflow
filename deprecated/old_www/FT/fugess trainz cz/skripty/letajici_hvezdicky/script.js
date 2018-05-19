var pf;
if (ie) pf = star0.style;
else pf = document.layers["star0"];
var W,H;
var sL=0, sT=0;
var divW = 47 + 2, divH = 46 + 3; //divW = parseInt(pf.width) + 2; divH; = parseInt(pf.height) + 3;
var X=-1, Y=-1;
var f;
function buffer(n) {
   for (var i = 1; i <= n; i++) {
     this[i] = -100;
   }
   return this; }
var bufa;
var bufp = 0;
var bufc = 3;
var bufd = -1;
var bufmax = 50;  //bufc*pocet hvezd musi < velikost buff
var bufX = new buffer(bufmax);
var bufY = new buffer(bufmax);
var sx, sy;
var ra;
var r;
var t;
var sp = 4;
var rap = sp/r;
var maxr = 200;
var PI2 = Math.PI*2;
var rnd;


function isin() {
  return ( (X>=0) && (X<=W-divW) && (Y>=0) && (Y<=H-divH) );
  }


function circleBox() {
  sL = parseInt(ie ? document.body.scrollLeft : pageXOffset);
  sT = parseInt(ie ? document.body.scrollTop : pageYOffset);
  if (!ie) {
    W=innerWidth;
    H=innerHeight;
  }
    X = sx + r*Math.cos(ra);
    Y = sy + r*Math.sin(ra);
    if (!isin()) {
	rap = -rap;
	ra += 2*rap;
        X = sx + r*Math.cos(ra);
        Y = sy + r*Math.sin(ra);
    }
    if (!isin()) resize();
    t -= Math.abs(rap);
    if (t<0) {
	rnd = maxr/2 - (Math.random()*maxr);
	if ((rnd>-10) && (rnd<10)) rnd = 10;
	sx = X - Math.cos(ra)*rnd;
	sy = Y - Math.sin(ra)*rnd;
	r = Math.abs(rnd);
	if (rnd<0) {
		if (ra < Math.PI) ra+=Math.PI;
		else ra-=Math.PI;
		if (rap<0) rap = sp/r; else rap = -sp/r;
		//rap = Math.random()*10 + 10;
	} else if (rap<0) rap = -sp/r; else rap = sp/r;
	rap = rap*(Math.random()*3+2)
	t=Math.random()*(Math.PI/2);
    }
    ra += rap;
    while (ra>PI2) ra -= PI2;
    while (ra<PI2) ra += PI2;
    pf.left = (X + sL); //+3*Math.random());
    pf.top = (Y + sT); //+3*Math.random());
    bufX[bufp] = (X + sL);
    bufY[bufp] = (Y + sT);
    bufp++;
    if (bufp>bufmax) bufp = 0;
    for (f=1; f<5; f++) {
      bufa = bufp - 1 - (bufc*f);
      if (bufa<0) bufa += bufmax + 1;
      if ( (bufX[bufa]>sL+W-divW) || (bufY[bufa]>sT+H-divH) )
        for (g=0; g<bufc; g++) {
          bufX[bufa-g<0?bufa-g+bufmax+1:bufa-g]=-100;
          bufY[bufa-g<0?bufa-g+bufmax+1:bufa-g]=-100;
        }
      if (ie) {
        eval('star'+f+'.style.left=bufX[bufa] + (f*5)');
        eval('star'+f+'.style.top=bufY[bufa] + (f*5)');
      } else {
        eval('window.document.layers["star'+f+'"].left=bufX[bufa] + (f*5)');
        eval('window.document.layers["star'+f+'"].top=bufY[bufa] + (f*5)');
      }
    }
    setTimeout((ie ? 'circleBox();' : circleBox),20);
}
function resize() {
  W = ie ? document.body.clientWidth : innerWidth;
  H = ie ? document.body.clientHeight : innerHeight;
    if (!isin()) {
      sx=W/2; sy=H/2;
      r=Math.random()*(W<H?sx:sy);
      if (r<10) r=10;
      ra=Math.random()*PI2;
      rap = sp/r;
      rap = rap*(Math.random()*3+2)
      t=Math.random()*PI2;
   }
}
function start() {
  if (ie) window.onresize = resize;
  resize();
  circleBox();
}