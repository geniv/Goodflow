<?

// Skript, ktery otestuje spojeni s MySQL databazi. Do skriptu je potreba
// doplnit pristupove udaje Vasi databaze ( login, heslo, server a nazev 
// databaze ). Tyto udaje obdrzite pri objednani MySQL databaze na kontaktni
// email.

$conn_user="login";
$conn_pass="heslo";
$conn_server="server";
$database="nazev databaze";
$spojeni=MYSQL_connect($conn_server,$conn_user,$conn_pass);
 if (!$spojeni) {

 echo "Nepripojeno k databazi: " . mysql_error();

exit; }

mysql_select_db($database);

 echo "Pripojeno OK";

?>