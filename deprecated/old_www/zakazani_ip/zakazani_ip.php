<?php
$nezadouci_ip=array("127.0.0.1","","","","","","","");              //Pole ne��douc�ch ip adres (jsou d�le�it� i mezery)

$pocet_ip=count($nezadouci_ip);                                     //Po�et ne��douc�ch ip adres
$ip=$REMOTE_ADDR;                                                   //Ip adresa aktu�ln�ho n�v�t�vn�ka

for ($i=0;$i<$pocet_ip;$i++)
 {     //Cyklus, kter� porovn�v� ip adresu se v�emi ne��douc�mi ip adresami
if ($nezadouci_ip[$i]==$ip) 
{     //Pokud se ip adresa shoduje, bude vyps�no hl�en�
echo "Jste tu ne��douc�";
exit;                                                               //Tento ��dek nutn� jinak se vyp�e v�e
}
}                                                                   //N�sleduje  zbytek HTML str�nky
?>
Text, kter� se zobraz� v�tan�m n�v�t�vn�k�m.