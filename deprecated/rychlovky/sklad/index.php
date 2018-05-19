<?php
  $result = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"cs\" lang=\"cs\">
<head>
  <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
  <meta http-equiv=\"Content-Language\" content=\"cs\" />
<title>evidence skladu</title>
</head>
<body>
  
  <form method=\"post\">
  <table border=\"1\">
    <tr>
      <th>ID</th>
      <th>Zařazení</th>
      <th>Název</th>
      <th>cena bez DPH</th>
      <th>Počet</th>
    </tr>
  ";
  for ($i = 0; $i < 15; $i++) //0-14
  {
    $result .= "
    <tr>
      <td><input type=\"text\" name=\"idproduktu[]\" value=\"".($i + 1)."\" size=\"2\" /></td>
      <td>
        <select name=\"zarazeni[]\">
          <option value=\"0\">materiál</option>
          <option value=\"1\">zboží</option>
          <option value=\"2\">palivo</option>
        </select>
      </td>
      <td><input type=\"text\" name=\"nazev[]\" maxlength=\"150\" /></td>
      <td><input type=\"text\" name=\"cena[]\" /></td>
      <td><input type=\"text\" name=\"pocet[]\" size=\"3\" maxlength=\"3\" /></td>
    </tr>
    ";
  }
  $result .= "
  </table>
  <input type=\"submit\" name=\"tlacitko\" value=\"Vytisknout\" /><br />
  </form>
  
</body>
</html>";

  if (!Empty($_POST["tlacitko"])) //kdyz se zmackne tlacitko
  {
    $result = "";
    for ($i = 0; $i < count($_POST["idproduktu"]); $i++)  //cyklus na rozdeleni
    {
      switch ($_POST["zarazeni"][$i]) //rozdeleni id podle zarazeni
      {
        case 0:
          $zar0[] = $i;
        break;

        case 1:
          $zar1[] = $i;
        break;

        case 2:
          $zar2[] = $i;
        break;
      }
    }
//print_r($zar0);
//print_r($zar1);
//print_r($zar2);
/*
 Vytvořte www stránku s formulářem „evidence skladu“.
 * Formulář bude obsahovat 15 řádků, každý řádek bude obsahovat pole:
 * id produktu, zařazení ve skladu, název, cena bez DPH, počet kusů.
 * Id produktu může být jakékoli číslo a musí být jedinečné
 * (ve formuláři se nesmí opakovat). Zboží musí být zařazeno ve skladu do jedné ze
 * tří sekcí (materiál, zboží, palivo). Název může být jakýkoli do 150 znaků.
 * Cena bez DPH celé číslo. Počet kusů do 999.
Dále bude tlačítko „vytisknout“ po stlačení tohoto tlačítka se otevře nová stránka s
* tabulkou kde budou položky roztříděné podle zařazení ve skladu a to tak že první
* bude materiál potom zboží a nakonec palivo. Bude uvedeno id produktu i název produktu.
* U každé položky bude dále uvedena cena za ks bez DPH,
* cena za kus s DPH a cena za všechny kusy bez DPH a s DPH.
* A na konec bude uvedena cena s DPH za všechny položky ve skladu.
*/


    $dph = 20 / 100;  //%
    $pocty = array_count_values($_POST["zarazeni"]);  //spocitani radku podle zarazeni

    $result .= "
    <table border=\"1\">
      <tr>
        <th>ID</th>
        <th>název</th>
        <th>cena za ks bez DPH</th>
        <th>cena za ks s DPH</th>
        <th>celkem bez DPH</th>
        <th>celkem s DPH</th>
      </tr>
    ";
    $sum = 0;
    for ($i = 0; $i < $pocty[0]; $i++)  //vypis tabulky => material
    {
      $celkembezdph = $_POST["pocet"][$zar0[$i]] * $_POST["cena"][$zar0[$i]]; //pocet*cena
      $sum += $celkembezdph;  //soucet ceny
      $result .= "
      <tr>
        <td>{$_POST["idproduktu"][$zar0[$i]]}</td>
        <td>{$_POST["nazev"][$zar0[$i]]}</td>
        <td>{$_POST["cena"][$zar0[$i]]}</td>
        <td>".($_POST["cena"][$zar0[$i]] + ($_POST["cena"][$zar0[$i]] * $dph))."</td>
        <td>{$celkembezdph}</td>
        <td>".($celkembezdph + ($celkembezdph * $dph))."</td>
      </tr>
      ";
    }
    $result .= "</table>

    celkem s dph za material: ".($sum + ($sum * $dph))."

    <br /><br />

    <table border=\"1\">
      <tr>
        <th>ID</th>
        <th>název</th>
        <th>cena za ks bez DPH</th>
        <th>cena za ks s DPH</th>
        <th>celkem bez DPH</th>
        <th>celkem s DPH</th>
      </tr>
    ";
    $sum = 0;
    for ($i = 0; $i < $pocty[1]; $i++)  //vypis tabulky => zbozi
    {
      $celkembezdph = $_POST["pocet"][$zar1[$i]] * $_POST["cena"][$zar1[$i]]; //pocet*cena
      $sum += $celkembezdph;  //soucet ceny
      $result .= "
      <tr>
        <td>{$_POST["idproduktu"][$zar1[$i]]}</td>
        <td>{$_POST["nazev"][$zar1[$i]]}</td>
        <td>{$_POST["cena"][$zar1[$i]]}</td>
        <td>".($_POST["cena"][$zar1[$i]] + ($_POST["cena"][$zar1[$i]] * $dph))."</td>
        <td>{$celkembezdph}</td>
        <td>".($celkembezdph + ($celkembezdph * $dph))."</td>
      </tr>
      ";
    }
    $result .= "</table>

    celkem s dph za zbozi: ".($sum + ($sum * $dph))."

    <br /><br />
    <table border=\"1\">
      <tr>
        <th>ID</th>
        <th>název</th>
        <th>cena za ks bez DPH</th>
        <th>cena za ks s DPH</th>
        <th>celkem bez DPH</th>
        <th>celkem s DPH</th>
      </tr>
    ";
     $sum = 0;
    for ($i = 0; $i < $pocty[2]; $i++)  //vypis tabulky => palivo
    {
      $celkembezdph = $_POST["pocet"][$zar2[$i]] * $_POST["cena"][$zar2[$i]]; //pocet*cena
      $sum += $celkembezdph;  //soucet ceny
      $result .= "
      <tr>
        <td>{$_POST["idproduktu"][$zar2[$i]]}</td>
        <td>{$_POST["nazev"][$zar2[$i]]}</td>
        <td>{$_POST["cena"][$zar2[$i]]}</td>
        <td>".($_POST["cena"][$zar2[$i]] + ($_POST["cena"][$zar2[$i]] * $dph))."</td>
        <td>{$celkembezdph}</td>
        <td>".($celkembezdph + ($celkembezdph * $dph))."</td>
      </tr>
      ";
    }
    $result .= "</table>

    celkem s dph za palivo: ".($sum + ($sum * $dph))."

    ";
  }

  echo $result;
?>
