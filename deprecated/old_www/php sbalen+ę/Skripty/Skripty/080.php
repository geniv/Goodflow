<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>080.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
     </head>
     <body>
<!-- 080.php -->
<?
   function obrat_rekurze($retezec){        // obrat pomocí rekurze
     if(strlen($retezec)>0)
       obrat_rekurze(substr($retezec,1));
     echo substr($retezec,0,1);
   }

   function obrat_iter($retezec){           // obrat pomocí cyklu
     for($i=1;$i<=strlen($retezec);$i++)
       echo substr($retezec,-$i,1);
   }

   $ret="Uvaří u protinožců vepřo-knedlo-zelo?";

   echo "<h3>Obrácení řetězce </h3>";
   echo "<b>Počáteční čas:&nbsp;</b>".MicroTime()."&nbsp;(mikrosekundy, sekundy)<br><br>";

   echo "<b>Pomocí rekurze:&nbsp;</b>";
   obrat_rekurze($ret);
   echo "<br><b>Čas:&nbsp;</b>".MicroTime()."&nbsp;(mikrosekundy, sekundy)";

   echo "<br><br><b>Pomocí cyklu:&nbsp;</b>";
   obrat_iter($ret);
   echo "<br><b>Čas:&nbsp;</b>".MicroTime()."&nbsp;(mikrosekundy, sekundy)";

   echo "<br><br><b>Pomocí vestavěné funkce StrRev():&nbsp;</b>";
   echo StrRev($ret);
   echo "<br><b>Čas:&nbsp;</b>".MicroTime()."&nbsp;(mikrosekundy, sekundy)";
?>
     </body>
</html>
