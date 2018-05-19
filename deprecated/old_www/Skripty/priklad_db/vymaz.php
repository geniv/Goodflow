<!--
    vymaz.php - slouží ke smazání načtených dat (smazat.php) do databáze a zpětnému
                 přesměrování na výpis, tj. otazka.php
-->
<?
$status=true;           // podařilo-li se vložit
if(!IsSet($ID_Otazka)){
   $status=false;
}else{
   require "./otvdatab.php";
   if($ID_Otazka>10):
     $dotaz = "DELETE FROM Otazka WHERE ID_Otazka=$ID_Otazka";
     if($Obrazek!="none" && $Obrazek!=""){
       $cesta="./obr_test/".$Obrazek;
       unlink($cesta);
     }
     if($Zvuk!="none" && $Zvuk!=""){
       $cesta="./zvuk_test/".$Zvuk;
       unlink($cesta);
     }
     @$vysledek = MySQL_Query($dotaz);
   else:
?>     <SCRIPT language="javascript">alert("Otázky 1 až 10 jsou součástí demonstračního testu a nelze je smazat...");</SCRIPT>
<? endif;
   if(!$vysledek):
     $status=false;
   endif;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>vymaz.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
     </head>
     <body>
  <SCRIPT LANGUAGE="JavaScript"> location.href="otazka.php"  </SCRIPT>
     </body>
</html>
