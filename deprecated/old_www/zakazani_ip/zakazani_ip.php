<?php
$nezadouci_ip=array("127.0.0.1","","","","","","","");              //Pole nežádoucích ip adres (jsou dùležité i mezery)

$pocet_ip=count($nezadouci_ip);                                     //Poèet nežádoucích ip adres
$ip=$REMOTE_ADDR;                                                   //Ip adresa aktuálního návštìvníka

for ($i=0;$i<$pocet_ip;$i++)
 {     //Cyklus, který porovnává ip adresu se všemi nežádoucími ip adresami
if ($nezadouci_ip[$i]==$ip) 
{     //Pokud se ip adresa shoduje, bude vypsáno hlášení
echo "Jste tu nežádoucí";
exit;                                                               //Tento øádek nutný jinak se vypíše vše
}
}                                                                   //Následuje  zbytek HTML stránky
?>
Text, který se zobrazí vítaným návštìvníkùm.