<?php
//$x = $_GET ['x']; // prijme data x
$x = (!empty($_GET['x']) ? $_GET['x'] : 0);
$y = (!empty($_GET['y']) ? $_GET['y'] : 0); // prijme data y
$op = (!empty($_GET['op'])? $_GET['op'] : 0); // prijme data op
var_dump($_GET['op'] ? : 0);

/*
  if ($op == "+") { $vysledek = $x + $y; }  // scitani
  else if (($op == "-")) { $vysledek = $x - $y; } // odcitano
  else if (($op == "*") || ($op == "x")) { $vysledek = $x * $y; } // nasobeni
  else if (($op == "/") || ($op == ":") || ($op == "÷")) { $vysledek = $x / $y; } // deleni
  else { $vysledek = chyba; }
*/

  switch ($op) {
    case "+":
      $vysledek = $x + $y;
    break;

    case "-":
      $vysledek = $x - $y;
    break;

    //atd..


    default:
      $vysledek = "chyba";
    break;
  }



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="cs">
<head profile="http://gmpg.org/xfn/11">

<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
</head>

<body>
<center>
<div id=stred>
           <form action='?' method='GET'>
           <input type='text' value='' name='x'>

          <select name="op">
            <option value="+" selected="selected">+</option>
            <option value="-">-</option>
            <option value="*">*</option>
            <option value="/">/</option>
          </select>

           <input type='text' value='' name='y'><br><br>
           <input type='submit' value='Vypocitej!'>
           </form> <p>
</div>

<div id=podstred>
<h3>Vysledek je:
<?php echo $vysledek; ?>
</h3>

<?php echo PHP_VERSION  ?>

</div>

</center>
</body>

</html>
