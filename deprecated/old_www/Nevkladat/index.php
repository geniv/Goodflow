<? include "nadpis.php"; 


echo "Te� je asi tak: ";
echo Date("G:i");

echo " serverov�ho �asu, PHP se \"lep��\" n� JS,<br>\n �e jo??<br>\n "; 
echo "Vase IP adresa je: ".$REMOTE_ADDR;
echo "<br>";
echo "<br>";
$te=$REMOTE_ADDR;
 
echo "M�te-li windows cement klapn�te na obr�zek:<br>";
echo "<a href='uvod.php'><img src='cement.jpg'></a>";

echo "<br><br>";
echo "<a href='menu.php'>n�jak� odkaz</a>";

include "podpis.php";
?>