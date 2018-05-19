<?php

/**
 *
 * Blok Flash headeru
 *
 * public funkce:\n
 * construct: FlashHeader - hlavni konstruktor tridy\n
 * Flash() - hlavni vypis flashu\n
 *
 */

class FlashHeader extends DefaultModule
{
  private $var, $dirpath, $absolutni_url, $unikatni;
  private $flash = "header.swf";

/**
 *
 * Konstruktor flashu
 *
 * @param var pruchodova struktura
 * @param index prideleny index pri generovani
 */
  public function __construct(&$var, $index) //konstruktor
  {
    $this->var = $var;
    $this->dirpath = dirname($this->var->moduly[$index]["include"]);

    //includovani unikatniho obsahu
    $this->unikatni = $this->NactiObsahSouboru("{$this->dirpath}/.unikatni_obsah.php");

    $this->flash = $this->NactiUnikatniObsah($this->unikatni["set_flash"]);

    $this->absolutni_url = $this->var->main[0]->NactiFunkci("Funkce", "AbsoluteUrl");
  }

/**
 *
 * Staticky flash header
 *
 * @return flash header
 */
  public function Flash($tvar = 1)
  {
    $result = $this->NactiUnikatniObsah($this->unikatni["normal_flash_{$tvar}"],
                                        "{$this->absolutni_url}{$this->flash}");

      return $result;
    }
}
?>
