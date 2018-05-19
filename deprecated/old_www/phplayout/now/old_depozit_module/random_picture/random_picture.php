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

class RandomPicture
{
  private $var;
  private $zdrojobr = "image"; //zdrojova cesta obrazku
  private $dirpath;

  private $obr = array (array("src" => "hu1.jpg", //nadefinovane obrazky
                              "alt" => "",
                              "id" => "",
                              "class" => "",
                              "width" => "",
                              "height" => "",
                              "href" => ""),

                        array("src" => "hu2.jpg",
                              "alt" => "",
                              "id" => "",
                              "class" => "",
                              "width" => "",
                              "height" => "",
                              "href" => ""),

                        array("src" => "hu3.jpg",
                              "alt" => "",
                              "id" => "",
                              "class" => "",
                              "width" => "",
                              "height" => "",
                              "href" => ""),

                        array("src" => "hu4.jpg",
                              "alt" => "",
                              "id" => "",
                              "class" => "",
                              "width" => "",
                              "height" => "",
                              "href" => ""),

                        array("src" => "hu5.png",
                              "alt" => "",
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
  }

/**
 *
 * Generovani samotneho obrazku
 *
 * @return nahodny obrazek
 */
  public function Obrazek()
  {
    $nahoda = rand(0, count($this->obr) - 1);

    $path = "{$this->dirpath}/{$this->zdrojobr}";
    $cesta = (!Empty($this->obr[$nahoda]["src"]) && file_exists("{$path}/{$this->obr[$nahoda]["src"]}") ? " src=\"{$path}/{$this->obr[$nahoda]["src"]}\"" : "");
    $alt = (!Empty($this->obr[$nahoda]["alt"]) ? " alt=\"{$this->obr[$nahoda]["alt"]}\"" : "");
    $id = (!Empty($this->obr[$nahoda]["id"]) ? " id=\"{$this->obr[$nahoda]["id"]}\"" : "");
    $class = (!Empty($this->obr[$nahoda]["class"]) ? " class=\"{$this->obr[$nahoda]["class"]}\"" : "");

    $width = (!Empty($this->obr[$nahoda]["width"]) ? " width=\"{$this->obr[$nahoda]["width"]}\"" : "");
    $height = (!Empty($this->obr[$nahoda]["height"]) ? " height=\"{$this->obr[$nahoda]["height"]}\"" : "");

    $href = (!Empty($this->obr[$nahoda]["href"]) ? "<a href=\"{$path}/{$this->obr[$nahoda]["href"]}\" title=\"{$this->obr[$nahoda]["alt"]}\" class=\"highslide\" onclick=\"return hs.expand(this)\">" : "");
    $href_end = (!Empty($this->obr[$nahoda]["href"]) ? "</a>" : "");

    $result =
    "{$href}
                    <img{$cesta}{$alt}{$id}{$class}{$width}{$height} />
                    <span></span>
                  {$href_end}
                  <em class=\"highslide-caption\">
                    {$this->obr[$nahoda]["alt"]}
                  </em>";

    return $result;
  }
}
?>
