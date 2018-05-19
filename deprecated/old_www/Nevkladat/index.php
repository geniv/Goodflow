<? include "nadpis.php"; 


echo "Teï je asi tak: ";
echo Date("G:i");

echo " serverového èasu, PHP se \"lepší\" nìž JS,<br>\n že jo??<br>\n "; 
echo "Vase IP adresa je: ".$REMOTE_ADDR;
echo "<br>";
echo "<br>";
$te=$REMOTE_ADDR;
 
echo "Máte-li windows cement klapnìte na obrázek:<br>";
echo "<a href='uvod.php'><img src='cement.jpg'></a>";

echo "<br><br>";
echo "<a href='menu.php'>nìjaký odkaz</a>";

include "podpis.php";
?>