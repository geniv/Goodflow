/* Odesila jednoduche prikazy */
function smajlik(cislo) {
  send(cislo);
}
/* odesila parove tagy a obrazky */
function tagy(type,info) {
  if(type=='img'||type=='flash') {
    org='http://';
    error='ok';
  } else {
    org='';
    error='';
  }
  var nametag=window.prompt(info,org);
  if(nametag!=''&&nametag!=null&&nametag!='http://') {
    send('['+type+']'+nametag+'[/'+type+']');
  } else {
    if(error=='ok'||nametag=='http://'||nametag=='') {
    window.alert('©patný formát adresy');}
  }
}
/* odesila abbr */
function abbr(text,title) {
  var text=window.prompt(text);
  var title=window.prompt(title);
  if(text!=''&&text!=null&&title!=''&&title!=null) {
    send('[abbr title='+title+']'+text+'[/abbr]');
  } else {
    window.alert('Nebyl vyplnìn text nebo title textu');
  }
}
/* odesila url adresy */
function adresa(info1,info2) {
  var adresa=window.prompt(info1,'http://');
  var nazev=window.prompt(info2);
  if(adresa!=''&&adresa!=null&&adresa!='http://'&&nazev!=''&&nazev!=null) {
    send('[a href='+adresa+']'+nazev+'[/a]');
  } else {
    window.alert('©patný formát adresy nebo nebyl napsán název');
  }
}
/* odesila obr */
function img(adresa,align) {
  var adresa=window.prompt(adresa,'http://');
  var align=window.prompt(align,'center');
  if(adresa!=''&&adresa!=null&&adresa!='http://') {
    if(align=='left') {
      align=' l';
      odeslat=true;
    } else if(align=='right') {
      align=' r';
      odeslat=true;
    } else if(align=='center') {
      align='';
      odeslat=true;
    } else {
      window.alert('Nebylo napsáno umístìní obrázku');
    }
    if(odeslat==true) {
      send('[img'+align+']'+adresa+'[/img]');
    }
  } else {
    window.alert('©patný formát adresy');
  }
}
/* odesila obr s textem */
function imgtext(adresa,title,align) {
  var adresa=window.prompt(adresa,'http://');
  var title=window.prompt(title);
  var align=window.prompt(align,'center');
  if(adresa!=''&&adresa!=null&&adresa!='http://'&&title!=''&&title!=null) {
    if(align=='left') {
      align=' l';
      odeslat=true;
    } else if(align=='right') {
      align=' r';
      odeslat=true;
    } else if(align=='center') {
      align='';
      odeslat=true;
    } else {
      window.alert('Nebylo napsáno umístìní obrázku');
    }
    if(odeslat==true) {
      send('[img'+align+'='+title+']'+adresa+'[/img]');
    }
  } else {
    window.alert('Nìkde jste udìlali chybu');
  }
}
/* odesle do textarey */
function send(format) {
  document.forms.vzkaz.text_gb.focus();
  document.forms.vzkaz.text_gb.value=
  document.forms.vzkaz.text_gb.value+format
}
/* Preklikavac */
function zobrazit(co) {
  if(co=='prvni') {
    el=document.getElementById('prvni').style;
    el.display='none';
    ela=document.getElementById('druhy').style;
    ela.display='block';
  } else {
    if(co='druhy') {
      el=document.getElementById('prvni').style;
      el.display='block';
      ela=document.getElementById('druhy').style;
      ela.display='none';
    } else {
    el=document.getElementById(co).style;
    el.display=(el.display == 'block')?'none':'block';
    }
  }
}