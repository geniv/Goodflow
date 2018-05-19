<!--
// Pocet obrazku
PicCount = 5;

// Pole komentaru k jednotlivym obrazkum
Info = new Array (
  'Duha nedaleko Vidnavy.',
  'Tak to je nase Dagmar (cistokrevny orisek).',
  'Dagmar a Cinda, nasi verni hlidaci psi.',
  'Nase kocka na scaneru (ani chvili nepostala na miste).',
  'Zapad slunce.'
);

 // Funkce pro vygenerovani cele stranky
function generate (Num){
  // Otevreni dokumentu
  document.open();
  // Kompletni vygenerovani zdrojoveho textu stranky
  // Hlavicka
  document.writeln ('<html>');
  document.writeln ('<head>');
  // Nazev stranky
  document.writeln ('  <title>SlideShow, snimek '+Num+'</title>');
  // Vlozeni odkazu na tento soubor se skriptem
  document.writeln ('  <script language="javascript"'+
    ' src="slide.js"></script>');
  document.writeln ('</head>');
  // Telo
  document.writeln ('<body>');
  document.writeln ('  <p align="center">');

  // Odkaz na predchozi snimek (pokud existuje)
  if (Num > 1)
    document.writeln ('  <a href="javascript:generate ('+
      (Num-1)+');">&lt;&lt;</a>');
  else
    document.writeln ('&lt;&lt;');

  // Cislo aktualniho snimku
  document.writeln ('  ['+Num+']');

  // Odkaz na nasledujici snimek, pokud existuje
  if (Num < PicCount)
    document.writeln ('  <a href="javascript:generate ('+
      (Num+1)+');">&gt;&gt;</a>');
  else
    document.writeln ('&gt;&gt;');

  document.writeln ('  <br>');

  // Vlastni obrazke
  document.writeln ('  <img src="'+Num+'.jpg"><br>');
  document.writeln (Info[Num-1]);
  document.writeln ('  </p>');

  // Konec stranky
  document.writeln ('</body>');
  document.writeln ('</html>');

  // Uzavreni dokumentu
  document.close();
}

// -->
