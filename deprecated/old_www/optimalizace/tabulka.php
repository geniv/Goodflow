<?php 

$nazev[0]="Toulky po depech";
$nazev[1]="Toulky po depech";
$nazev[2]="Toulky po depech";
$nazev[3]="Toulky po depech";

$poc[0]="2";
$poc[1]="2";
$poc[2]="2";
$poc[3]="2";

$pop[0]="Brno Horn� Her�pice 9.8.2007";
$pop[1]="Brno Horn� Her�pice 9.8.2007";
$pop[2]="Brno Horn� Her�pice 9.8.2007sfasfwqrrgfefqwfwfwewrrbrjhfbwkefkjwflkwje";
$pop[3]="Brno Horn� Her�pice 9.8.2007";

$zal[0]="25.11. 2007";
$zal[1]="25.11. 2007";
$zal[2]="25.11. 2007";
$zal[3]="25.11. 2007";

$pis = 10; //d�lka p�smena

$r1=strlen("N�zev galerie:")*$pis;
$r2=strlen("Po�et fotek:")*$pis;
$r3=strlen("Popis:")*$pis;
$r4=strlen("Zalo�eno:")*$pis;


for ($i = 0; $i < count($nazev); $i++)
{
if (strlen($nazev[$i])*$pis > $r1){$r1=strlen($nazev[$i])*$pis;}
if (strlen($poc[$i])*$pis > $r2){$r2=strlen($poc[$i])*$pis;}
if (strlen($pop[$i])*$pis > $r3){$r3=strlen($pop[$i])*$pis;}
if (strlen($zal[$i])*$pis > $r4){$r4=strlen($zal[$i])*$pis;}
}

$celkem =$r1 + $r2 + $r3 + $r4 + 20;

$styl = "width:";
$obsah = "";
for ($i = 0; $i < count($nazev); $i++)
{
$obsah .=
"  <div class=\"zarovnani\" style=\"$styl {$celkem}px;\">
    <div style=\"$styl {$r1}px;\">
      <p>{$nazev[$i]}</p>
    </div>
    <div style=\"$styl {$r2}px;\">
      <p>{$poc[$i]}</p>
    </div>
    <div style=\"$styl {$r3}px;\">
      <p>{$pop[$i]}</p>
    </div>
    <div style=\"$styl {$r4}px;\">
      <p>{$zal[$i]}</p>
    </div>
  </div>";
}  
  
print
"<div class=\"obalvsech\" >
  <div class=\"zarovnani\" style=\"$styl {$celkem}px;\">
    <div style=\"$styl {$r1}px;\">
      <p>N�zev galerie:</p>
    </div>
    <div style=\"$styl {$r2}px;\">
      <p>Po�et fotek:</p>
    </div>
    <div style=\"$styl {$r3}px;\">
      <p>Popis:</p>
    </div>
    <div style=\"$styl {$r4}px;\">
      <p>Zalo�eno:</p>
    </div>
  </div>
$obsah
</div>";

/*
<div class=\"zarovnani\">
    <div>
      <p>Toulky po depech</p>
    </div>
    <div>
      <p>2</p>
    </div>
    <div>
      <p>Brno Horn� Her�pice 9.8.2007</p>
    </div>
    <div>
      <p>25.11. 2007</p>
    </div>
  </div>
  <div class=\"zarovnani\">
    <div>
      <p>N�zev galerie:</p>
    </div>
    <div>
      <p>Po�et fotek:</p>
    </div>
    <div>
      <p>Popis:</p>
    </div>
    <div>
      <p>Zalo�eno:</p>
    </div>
  </div>
*/

?>
