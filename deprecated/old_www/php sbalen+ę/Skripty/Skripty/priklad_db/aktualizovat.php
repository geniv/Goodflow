<!--
     aktualizovat.php - slouží k uložení aktualizovaných dat (upravit.php) do databáze
                        a zpětnému přesměrování na výpis, tj. otazka.php
-->

<?
$status=true;           // podařilo-li se vložit
if(!IsSet($ID_Otazka)){
   $status=false;
}else{
   require "./otvdatab.php";
   // musí být dlouhý řádek, jinak nepremáva
 $dotaz="UPDATE Otazka SET ID_Otazka=$ID_Otazka,Skupina='$Skupina',Otazka='$Otazka',OdpovedA='$OdpovedA',OdpovedB='$OdpovedB',OdpovedC='$OdpovedC',OdpovedD='$OdpovedD',OdpovedE='$OdpovedE',OdpovedF='$OdpovedF', Spravne=$Spravne WHERE ID_Otazka=$ID_Otazka";
 @$vysledek = MySQL_Query($dotaz);
   if(!$vysledek):
     $status=false;
   endif;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
     <head>
          <title>aktualizovat.php</title>
          <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
     </head>
     <body>
  <SCRIPT LANGUAGE="JavaScript"> location.href="otazka.php"  </SCRIPT>
     </body>
</html>
