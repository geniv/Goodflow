<?
header("Content-type: text/xml");
if ($_POST["menu"] == "1")
  $polozkymenu = array('Párek', 'Kuře', 'Steak');
if ($_POST["menu"] == "2")
  $polozkymenu = array('Rajče', 'Okurek', 'Rýže');

echo '<?xml version="1.0" ?>';
echo '<menu>';
foreach ($polozkymenu as $polozka)
{
  echo '<polozkamenu>';
  echo $polozka;
  echo '</polozkamenu>';
}
echo '</menu>';
?>
