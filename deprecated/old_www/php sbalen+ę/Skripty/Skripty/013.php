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
  // definice konstantu pro konec ��dku
  define("NR","<br>\n");

  echo "Firma".NAZEV.NR;      // vyp�e "Firma Vochmelka & spol."
                              // a od��dkuje
  // nefunk�n� konstanty - uvnit� uvozovek
  // se chovaj� jako oby�ejn� text
  echo "Firma NAZEV NR";      // vyp�e "Firma NAZEV NR"
?>
     </body>
</html>
