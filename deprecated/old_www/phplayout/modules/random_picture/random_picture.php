<?php

/**
 *
 * Staticky blok nahodne vybraneho obrazku
 *
 * public funkce:\n
 * construct: RandomPicture - hlavni konstruktor tridy\n
 * Obrazek() - hlavni vypis obrazku\n
 *
 */

class RandomPicture extends DefaultModule
{
  private $var, $dirpath, $unikatni;
  private $zdrojobr = "image"; //zdrojova cesta obrazku

  private $obr = array (array("src" => "...", //nadefinovane obrazky
                              "alt" => "....",
                              "id" => "",
                              "class" => "",
                              "width" => "",
                              "height" => "",
                              "href" => ""),
                        );

/**
 *
 * Konstruktor nahodneho obrazku
 *
 * @param var pruchodova struktura
 * @param index prideleny index pri generovani
 */
  public function __construct(&$var, $index) //konstruktor
  {
    $this->var = $var;
    $this->dirpath = dirname($this->var->moduly[$index]["include"]);

    $this->unikatni = $this->NactiObsahSouboru("{$this->dirpath}/.unikatni_obsah.php");

    $this->zdrojobr = $this->NactiUnikatniObsah($this->unikatni["set_zdrojobr"]);
  }

/**
 *
 * Generovani samotneho obrazku
 *
 * @return nahodny obrazek
 */
  public function Obrazek($tvar = 1)
  {
    $this->obr = $this->NactiUnikatniObsah($this->unikatni["normal_set_obr_{$tvar}"]);

    $nahoda = rand(0, count($this->obr) - 1);

    $path = "{$this->dirpath}/{$this->zdrojobr}";
    $cesta = (!Empty($this->obr[$nahoda]["src"]) && file_exists("{$path}/{$this->obr[$nahoda]["src"]}") ? " src=\"{$path}/{$this->obr[$nahoda]["src"]}\"" : "");
    $alt = (!Empty($this->obr[$nahoda]["alt"]) ? " alt=\"{$this->obr[$nahoda]["alt"]}\"" : "");
    $id = (!Empty($this->obr[$nahoda]["id"]) ? " id=\"{$this->obr[$nahoda]["id"]}\"" : "");
    $class = (!Empty($this->obr[$nahoda]["class"]) ? " class=\"{$this->obr[$nahoda]["class"]}\"" : "");

    $width = (!Empty($this->obr[$nahoda]["width"]) ? " width=\"{$this->obr[$nahoda]["width"]}\"" : "");
    $height = (!Empty($this->obr[$nahoda]["height"]) ? " height=\"{$this->obr[$nahoda]["height"]}\"" : "");

    $href = (!Empty($this->obr[$nahoda]["href"]) ? $this->NactiUnikatniObsah($this->unikatni["normal_href_begin_{$tvar}"],
                                                                            "{$path}/{$this->obr[$nahoda]["href"]}",
                                                                            $this->obr[$nahoda]["alt"]) : "");

    $href_end = (!Empty($this->obr[$nahoda]["href"]) ? $this->NactiUnikatniObsah($this->unikatni["normal_href_end_{$tvar}"]) : "");

    $result = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_obr_{$tvar}"],
                                        $href,
                                        $href_end,
                                        $cesta,
                                        $alt,
                                        $id,
                                        $class,
                                        $width,
                                        $height,
                                        $this->obr[$nahoda]["alt"]);

    return $result;
  }
}
?>
