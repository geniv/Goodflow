<?

// Skript, ktery otestuje, zda dochazi k ukladani sessions na Vasem
// webhostingu.

session_start();
?>

<html>
<head></head>
<body>
<?
    session_register("x");
        $x = 10;
?>
Promenna x je zaregistrovana a ma hodnotu <?echo $x?>. 
Podivejte se na <a href="session_dalsi.php">dalsi stranku</a>,
kde uvidite, zda zustane obsah promenne $x zachovan.
</body>
</html>
