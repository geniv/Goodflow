/*
	reflection.js for mootools v1.42
	(c) 2006-2008 Christophe Beyls <http://www.digitalia.be>
	MIT-style license.
	
  upravovano na:
    height:0.25,opacity:0.25
	jakakoliv zmena v height se musi dodatecne dopsat ve stylech:
    #obal_layout #obal_obsah #vypis_sekce_uvod #obsah_velky #nejnovejsi_reference ...
*/
Element.implement({reflect:function(b){var a=this;if(a.get("tag")=="img"){b=$extend({height:0.25,opacity:0.25},b);a.unreflect();function c(){var i,f=Math.floor(a.height*b.height),j,d,h;if(Browser.Engine.trident){i=new Element("img",{src:a.src,styles:{width:a.width,height:a.height,marginBottom:-a.height+f,filter:"flipv progid:DXImageTransform.Microsoft.Alpha(opacity="+(b.opacity*100)+", style=1, finishOpacity=0, startx=0, starty=0, finishx=0, finishy="+(b.height*100)+")"}})}else{i=new Element("canvas");if(!i.getContext){return}try{d=i.setProperties({width:a.width,height:f}).getContext("2d");d.save();d.translate(0,a.height-1);d.scale(1,-1);d.drawImage(a,0,0,a.width,a.height);d.restore();d.globalCompositeOperation="destination-out";h=d.createLinearGradient(0,0,0,f);h.addColorStop(0,"rgba(255, 255, 255, "+(1-b.opacity)+")");h.addColorStop(1,"rgba(255, 255, 255, 1.0)");d.fillStyle=h;d.rect(0,0,a.width,f);d.fill()}catch(g){return}};j=new Element(($(a.parentNode).get("tag")=="a")?"span":"span").injectAfter(a).adopt(a,i);j.className=a.className;a.store("reflected",a.style.cssText);a.className="reflected"}if(a.complete){c()}else{a.onload=c}}return a},unreflect:function(){var b=this,a=this.retrieve("reflected"),c;b.onload=$empty;if(a!==null){c=b.parentNode;b.className=c.className;b.style.cssText=a;b.store("reflected",null);c.parentNode.replaceChild(b,c)}return b}});

// AUTOLOAD CODE BLOCK (MAY BE CHANGED OR REMOVED)
window.addEvent("domready", function() {
	$$("img").filter(function(img) { return img.hasClass("reflect"); }).reflect({/* Put custom options here */});
});