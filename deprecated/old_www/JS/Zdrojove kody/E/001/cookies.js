//---------------
// Zápis Cookie
//---------------
function WriteCookie (Name, Value, Expire, Path, Domain, Secure){
  // Name je jediný povinný parametr
  if (Name=='') return;

  // Spojení názvu a hodnoty cookie
  var Cookie = Name + '=' + escape (Value);

  // Pokud je zadáno datum expirace
  if (Expire){
    // Zjistí se aktuální datum a èas a posune se o dobu expirace
    var D = new Date((new Date()).getTime() + Expire*3600000);
    // Výsledkem je datum, kdy vyprší platnost cookie
    // a ta se pøevede na pásmo GMT a zapíše do výsledku
    Cookie += '; expires=' + D.toGMTString();
  }

  // Pokud je zadána cesta, zapíše se do výsledného øetìzce
  if (Path)
    Cookie += '; path=' + Path;

  // Pokud je zadána doména, zapíše se do výsledného øetìzce
  if (Domain)
    Cookie += '; domain=' + Domain;

  // Pokud je zadáno zda se jedná o zabezpeèený cookie,
  // zapíše se do výsledného øetìzce
  if (Secure)
    Cookie += '; secure';

  // Nakonec se zapíše výsledný øetìzec do vlastnosti cookie
  document.cookie = Cookie;
}


//---------------
// Ètení Cookie
//---------------
function ReadCookie (Name, DefValue){
  // Získá se seznam všech cookies, na které má tato stránka práva
  var Cookies = document.cookie;

  // Pokud je výsledek prázdný, vrátí se výchozí hodnota
  if (Cookies == "") return (DefValue);

  // Najde se cookie podle názvu
  var Start = Cookies.indexOf (Name+'=');

  // pokud nebyl nalezen, vrátí se výchozí hodnota
  if (Start == -1) return DefValue;

  // Start je pozice, kde se v øetìzci
  // nachází zaèátek hodnoty cookie
  Start += Name.length + 1;

  // End je pozice, kde se v øetìzci
  // nachází konec hodnoty cookie
  var End = Cookies.indexOf(';', Start);
  if (End == -1) End = Cookies.length;

  // Nakonec se z øetìzce vysekne hodnota cookie
  return (unescape (Cookies.substring(Start, End)));
}


