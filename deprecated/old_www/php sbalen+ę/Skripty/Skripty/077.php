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
     return "Volána Fce1().";
   }
   function Fce2($text){
     return "Volána Fce2(). Obsah parametru: \"$text\".";
   }

   $promenna1="Fce1";                     // názvy funkcí do proměnných
   $promenna2="Fce2";

   $vysledek=$promenna1();                // volání odkazem na funkci
   echo $vysledek."<br>";
   $vysledek=$promenna2("Přidaný text");  // volání s parametrem
   echo $vysledek;
?>
     </body>
</html>
