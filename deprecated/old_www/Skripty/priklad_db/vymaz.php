<!--
    vymaz.php - slou�� ke smaz�n� na�ten�ch dat (smazat.php) do datab�ze a zp�tn�mu
                 p�esm�rov�n� na v�pis, tj. otazka.php
-->
<?
$status=true;           // poda�ilo-li se vlo�it
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
?>     <SCRIPT language="javascript">alert("Ot�zky 1 a� 10 jsou sou��st� demonstra�n�ho testu a nelze je smazat...");</SCRIPT>
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
