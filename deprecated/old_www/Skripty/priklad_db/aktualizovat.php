<!--
     aktualizovat.php - slou�� k ulo�en� aktualizovan�ch dat (upravit.php) do datab�ze
                        a zp�tn�mu p�esm�rov�n� na v�pis, tj. otazka.php
-->

<?
$status=true;           // poda�ilo-li se vlo�it
if(!IsSet($ID_Otazka)){
   $status=false;
}else{
   require "./otvdatab.php";
   // mus� b�t dlouh� ��dek, jinak neprem�va
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
