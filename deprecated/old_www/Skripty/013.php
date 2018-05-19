<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>013.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
     </head>
     <body>
<!-- 013.php -->
<?
  // definice konstanty NAZEV = jmeno firmy
  define("NAZEV"," <B>Vochmelka&nbsp;&&nbsp;spol.</B>");
  // definice konstantu pro konec řádku
  define("NR","<br>\n");

  echo "Firma".NAZEV.NR;      // vypíše "Firma Vochmelka & spol."
                              // a odřádkuje
  // nefunkční konstanty - uvnitř uvozovek
  // se chovají jako obyčejný text
  echo "Firma NAZEV NR";      // vypíše "Firma NAZEV NR"
?>
     </body>
</html>
