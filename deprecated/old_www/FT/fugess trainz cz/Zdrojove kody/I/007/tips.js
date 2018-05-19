// Funkce pro náhodné vybrání citátu z pole
function TipOfTheDay(){
  return (Tips[Math.floor (Math.random()*Tips.length)]);
}

// Pole s jednotlivými citáty
var Tips=new Array(
  'Management je "jemné umìní, jak oddìlit lidi od jejich penìz".',
  'Pokud jsem na nìco zapomnìl, není to zámìr, ale bordel.',
  'Ten kdo chce, tak hledá zpùsob, ten kdo nechce, hledá dùvod.',
  'Problém je vždy mezi židlí a klávesnicí.'
);

