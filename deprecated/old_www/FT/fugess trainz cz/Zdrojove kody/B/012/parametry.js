//------------------
// K�dovac� funkce
//------------------
// Zak�duje parametry do v�sledn� adresy
function EncodeString (Url){
  // Tato prom�nn� bude obsahovat v�slednou adresu
  Str = new String();

  // Forcyklus p�es v�echny argumenty funkce
  for (var i=1; i<EncodeString.arguments.length; i++){
    // Pokud se zpracov�v� prvn� parametr,
    // pr�id� se do adresy znak '?' odd�luj�c� parametrickou
    // ��st adresy, jinak p�id�me znak '&'
    // odd�luj�c� jednotliv� parametry
    if (i==1)
      Str = Str + '?';
    else
        Str = Str + '&';

    // Do �et�zce se ulo�� n�zev parametru a jeho hodnota
    // Na tu se je�t� p�edt�m vol� funkce escape(), kter�
    // p�evede "nebezpe�n� znaky"
    Str = Str + 'Arg' + (i-1) + '=' +
      escape (EncodeString.arguments[i]);
  }

  // V�sledn� adresa je adresa c�lov� str�nky, kter� se
  // budou parametry p�ed�vat a vlastn�ch parametr�
  Str = Url + Str;
  return (Str);
}


//---------------------
// Dek�dovac� funkce
//---------------------
// P�ev�d� URL na pole parametr�
function DecodeString (Url){
  // Vysledn� pole parametr�
  Args=new Array();

  // Pomocn� pole pro ulo�en� ��st� URL
  var DecodeUrl;

  var PomUrl, PomArgs, PomArg;

  // Zisk�n� ��sti adresy s parametry
  Url = Url.toString();
  // Adresa se rozd�l� do pole podle znaku '?'
  DecodeUrl = Url.split ('?');
  // Pokud za znakem '?' byl n�jak� text
  if (DecodeUrl.length>1 && DecodeUrl[1].length>0){
    // Do prom�nn� PomUrl se ulo�� ��st adresy s parametry
    PomUrl = DecodeUrl[1];
    // Rozd�l� se podle znaku '&' na dvojice Parametr=Hodnota
      PomArgs = PomUrl.split ('&');
    for (var i=0; i<PomArgs.length; i++){
      // Pro ka�d� parametr se z�sk� jeho hodnta
      // (�et�zec se tentokr�te rozd�l� podle znaku '=')
        PomArg = PomArgs[i].split('=');
      Args[i] = unescape(PomArg[1]);
    }
  }
  // Vr�t� se v�sledn� pole hodnot
  return (Args);
}

