<?

// Skript, ktery odesle email z Vaseho webhostingu dle zadanych parametru.
// Do skriptu je nutne pred odeslanim doplnit emailovou adresu odesilatele
// a emailovou adresu prijemce.

$to = 'adresa@prijemce';
$subject = 'mail test - php';
$message = 'test';
$headers = 'from: adresa@odesilatele';

if( mail($to, $subject, $message, $headers) )

    {echo 'OK';}

else

    {echo 'CHYBA';}

?>