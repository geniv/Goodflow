//------------------
// Kódovací funkce
//------------------
// Zakóduje parametry do výsledné adresy
function EncodeString (Url){
  // Tato promìnná bude obsahovat výslednou adresu
  Str = new String();

  // Forcyklus pøes všechny argumenty funkce
  for (var i=1; i<EncodeString.arguments.length; i++){
    // Pokud se zpracovává první parametr,
    // prøidá se do adresy znak '?' oddìlující parametrickou
    // èást adresy, jinak pøidáme znak '&'
    // oddìlující jednotlivé parametry
    if (i==1)
      Str = Str + '?';
    else
        Str = Str + '&';

    // Do øetìzce se uloží název parametru a jeho hodnota
    // Na tu se ještì pøedtím volá funkce escape(), která
    // pøevede "nebezpeèné znaky"
    Str = Str + 'Arg' + (i-1) + '=' +
      escape (EncodeString.arguments[i]);
  }

  // Výsledná adresa je adresa cílové stránky, které se
  // budou parametry pøedávat a vlastních parametrù
  Str = Url + Str;
  return (Str);
}


//---------------------
// Dekódovací funkce
//---------------------
// Pøevádí URL na pole parametrù
function DecodeString (Url){
  // Vysledné pole parametrù
  Args=new Array();

  // Pomocné pole pro uložení èástí URL
  var DecodeUrl;

  var PomUrl, PomArgs, PomArg;

  // Ziskání èásti adresy s parametry
  Url = Url.toString();
  // Adresa se rozdìlí do pole podle znaku '?'
  DecodeUrl = Url.split ('?');
  // Pokud za znakem '?' byl nìjaký text
  if (DecodeUrl.length>1 && DecodeUrl[1].length>0){
    // Do promìnné PomUrl se uloží èást adresy s parametry
    PomUrl = DecodeUrl[1];
    // Rozdìlí se podle znaku '&' na dvojice Parametr=Hodnota
      PomArgs = PomUrl.split ('&');
    for (var i=0; i<PomArgs.length; i++){
      // Pro každý parametr se získá jeho hodnta
      // (øetìzec se tentokráte rozdìlí podle znaku '=')
        PomArg = PomArgs[i].split('=');
      Args[i] = unescape(PomArg[1]);
    }
  }
  // Vrátí se výsledné pole hodnot
  return (Args);
}

