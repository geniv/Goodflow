<!--
 vlozit.php - slouží k uložení naètených dat (pridat.php) do databáze a zpìtnému
              pøesmìrování na výpis, tj. otazka.php
-->
<?
$UZIV="Otazka";
$status=true;           // podaøilo-li se vložit
if(!IsSet($ID_Otazka)){
   $status=false;
}else{
   require "./otvdatab.php";
   if($Obrazek_name){
     $Obrazek_name=$UZIV."_".$Obrazek_name;
     Copy($Obrazek,"./obr_test/$Obrazek_name");
     $Obrazek=$Obrazek_name;
   }
   if($Zvuk_name){
     $Zvuk_name=$UZIV."_".$Zvuk_name;
     Copy($Zvuk,"./zvuk_test/$Zvuk_name");
     $Zvuk=$Zvuk_name;
   }
   $dotaz="INSERT INTO ".$UZIV." VALUES($ID_Otazka,'$Skupina','$Obrazek','$Zvuk','$Otazka','$OdpovedA','$OdpovedB','$OdpovedC','$OdpovedD','$OdpovedE','$OdpovedF',$Spravne,0,0)";
   @$vysledek = MySQL_Query($dotaz);
   if(!$vysledek):
     $status=false;
   endif;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>vlozit.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
     </head>
     <body>
  <SCRIPT LANGUAGE="JavaScript"> location.href="otazka.php"  </SCRIPT>
     </body>
</html>
