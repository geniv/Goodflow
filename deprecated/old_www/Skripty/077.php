<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>077.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
     </head>
     <body>
<!-- 077.php -->
<?
   function Fce1(){
     return "Vol�na Fce1().";
   }
   function Fce2($text){
     return "Vol�na Fce2(). Obsah parametru: \"$text\".";
   }

   $promenna1="Fce1";                     // n�zvy funkc� do prom�nn�ch
   $promenna2="Fce2";

   $vysledek=$promenna1();                // vol�n� odkazem na funkci
   echo $vysledek."<br>";
   $vysledek=$promenna2("P�idan� text");  // vol�n� s parametrem
   echo $vysledek;
?>
     </body>
</html>
