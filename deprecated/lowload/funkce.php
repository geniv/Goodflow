<?
function ZobrazGalerii()
{
  $cesta = "upload";
  $adresar = OpenDir($cesta); /* otevre adresar*/
  $soubor = Array();
  /* zinicializuje pole*/
  while ($zaznam = ReadDir($adresar))
  {
    /*nacte nazev souboru*/
    if (!Is_Dir("{$cesta}/{$zaznam}"))
    {
      $roz = explode(".", $zaznam);
      $koncovka = $roz[count($roz) - 1];

      if ($koncovka != "php" || $koncovka != "css")
      {
        $soubor[] = $zaznam;
      }
    }
  }
  CloseDir($adresar); /*/ uzavre adresar*/
  rsort($soubor); /*/ srovna nazvy souboru pospatku */

  echo "<table border=\"0\">\n";

  $obrazek_cislo = 0; /*/ ktery obrazek bude prvni*/

  foreach ($soubor as $polozka)
  {
    $roz = explode(".", $polozka);
    $koncovka = $roz[count($roz) - 1];
    $vel=round(filesize("{$cesta}/{$polozka}")/1024);

    echo "<tr><td><img src=\"image/{$koncovka}.gif\">
    </td><td style=\"width: 250px;\"><a href=\"?down={$cesta}/{$polozka}\">
    {$polozka}
    </a></td><td>{$vel} kB
    </td>\n";
  }
  echo "</tr></table>\n";
}
?>


