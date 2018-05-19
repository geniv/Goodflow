<?php

/*
  $a = $b = 0;  //definice

  $a = 4; //zadej ...
  $b = 2;

  if ($b > 0) //podminka
  { //++ vetev
    $c = $a / $b;

    echo "výsledek je: $c";
  }
    else
  { //-- vetev
    echo "nelze dělit nulou";
  }
*/

$a= $b = $c = $d = 0;

$a= 2;
$b= 6;
$c= 4;

$d= ($b*$b) - 4* $a* $c;

if ($d<0)
{ echo" nula řešení";}
else {
  if ( $d ==0)
  {

    $x= -$b/ (2*$a);
    echo" řešení je : $x";                           }
  else
  {
    $x1 = (-$b-sqrt($d))/(2*$a);
    $x2 = (-$b+sqrt($d))/(2*$a);
echo" řešení 1 je : $x1 řešení2 : $x2<br />";
//if (řešěení$g=$x);

echo $d;


  }}




?>
