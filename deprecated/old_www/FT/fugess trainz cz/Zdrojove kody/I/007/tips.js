// Funkce pro n�hodn� vybr�n� cit�tu z pole
function TipOfTheDay(){
  return (Tips[Math.floor (Math.random()*Tips.length)]);
}

// Pole s jednotliv�mi cit�ty
var Tips=new Array(
  'Management je "jemn� um�n�, jak odd�lit lidi od jejich pen�z".',
  'Pokud jsem na n�co zapomn�l, nen� to z�m�r, ale bordel.',
  'Ten kdo chce, tak hled� zp�sob, ten kdo nechce, hled� d�vod.',
  'Probl�m je v�dy mezi �idl� a kl�vesnic�.'
);

