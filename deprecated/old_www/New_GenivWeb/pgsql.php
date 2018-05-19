<?

// Skript, ktery otestuje spojeni s PosgreSQL databazi. Do skriptu je potreba
// doplnit pristupove udaje Vasi databaze ( login, heslo a nazev databaze ). 
// Tyto udaje obdrzite pri objednani PostgreSQL databaze na kontaktni email.

$conn_user="login";
$conn_pass="heslo";
$conn_server="postgresql.forpsi.com";
$conn_port="5433";
$conn_db="nazev databaze";
$spojeni=Pg_Connect("host=$conn_server port=$conn_port dbname=$conn_db user=$conn_user password=$conn_pass");
 if (!$spojeni) {

echo "Nepripojeno!";

exit; }

echo "Pripojeno";

?>