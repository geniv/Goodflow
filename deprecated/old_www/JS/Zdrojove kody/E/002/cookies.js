//---------------
// Z�pis Cookie
//---------------
function WriteCookie (Name, Value, Expire, Path, Domain, Secure){
  // Name je jedin� povinn� parametr
  if (Name=='') return;

  // Spojen� n�zvu a hodnoty cookie
  var Cookie = Name + '=' + escape (Value);

  // Pokud je zad�no datum expirace
  if (Expire){
    // Zjist� se aktu�ln� datum a �as a posune se o dobu expirace
    var D = new Date((new Date()).getTime() + Expire*3600000);
    // V�sledkem je datum, kdy vypr�� platnost cookie
    // a ta se p�evede na p�smo GMT a zap�e do v�sledku
    Cookie += '; expires=' + D.toGMTString();
  }

  // Pokud je zad�na cesta, zap�e se do v�sledn�ho �et�zce
  if (Path)
    Cookie += '; path=' + Path;

  // Pokud je zad�na dom�na, zap�e se do v�sledn�ho �et�zce
  if (Domain)
    Cookie += '; domain=' + Domain;

  // Pokud je zad�no zda se jedn� o zabezpe�en� cookie,
  // zap�e se do v�sledn�ho �et�zce
  if (Secure)
    Cookie += '; secure';

  // Nakonec se zap�e v�sledn� �et�zec do vlastnosti cookie
  document.cookie = Cookie;
}


//---------------
// �ten� Cookie
//---------------
function ReadCookie (Name, DefValue){
  // Z�sk� se seznam v�ech cookies, na kter� m� tato str�nka pr�va
  var Cookies = document.cookie;

  // Pokud je v�sledek pr�zdn�, vr�t� se v�choz� hodnota
  if (Cookies == "") return (DefValue);

  // Najde se cookie podle n�zvu
  var Start = Cookies.indexOf (Name+'=');

  // pokud nebyl nalezen, vr�t� se v�choz� hodnota
  if (Start == -1) return DefValue;

  // Start je pozice, kde se v �et�zci
  // nach�z� za��tek hodnoty cookie
  Start += Name.length + 1;

  // End je pozice, kde se v �et�zci
  // nach�z� konec hodnoty cookie
  var End = Cookies.indexOf(';', Start);
  if (End == -1) End = Cookies.length;

  // Nakonec se z �et�zce vysekne hodnota cookie
  return (unescape (Cookies.substring(Start, End)));
}


