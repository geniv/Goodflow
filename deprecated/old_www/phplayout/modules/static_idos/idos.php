<?php

/**
 *
 * Blok staticky hledaneho spojeni skrz idos
 *
 * public funkce:\n
 * construct: StaticIdos - hlavni konstruktor tridy\n
 * NacteniAkci() - hlavni nacitani dat pro select: akce\n
 * Idos() - hlavni vypis formy\n
 *
 * dokumentace: http://www.chaps.cz/idos-moznost-vyuziti-odkazu.asp
 *
 */

class StaticIdos extends DefaultModule
{
  private $var, $dirpath, $absolutni_url, $dostupneakce, $unikatni;

  private $vyhledavaciurl = "http://www.idos.cz/%%0%%/?f=%%1%%&amp;t=%%2%%&amp;date=%%3%%&amp;time=%%4%%&amp;byarr=true&amp;lng=C&amp;submit=true";  //dopsat dle webu

  private $cas = "20:00";
  private $cil = "Moravská Nová Ves";

  private $vychozi = array ("Břeclav",
                            "...");

  private $doprava = array ("autobusy" => "Bus",
                            "klic" => "hodnota"
                            );

/**
 *
 * Konstruktor menu
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
    $this->absolutni_url = $this->var->main[0]->NactiFunkci("Funkce", "AbsoluteUrl");

    $this->vyhledavaciurl = $this->NactiUnikatniObsah($this->unikatni["set_vyhledavaciurl"]);
    $this->vychozi = $this->NactiUnikatniObsah($this->unikatni["set_vychozi"]);
    $this->doprava = $this->NactiUnikatniObsah($this->unikatni["set_doprava"]);
  }

/**
 *
 * Korekce datumu z databaze
 *
 * @param datum vstupni datum
 * @param oddelovac odelovaci znaky pro datum
 * @papam poradi poradi datumu v textu
 * @return regulerni datum
 */
  private function DekodujDatum($datum, $oddelovac = " ", $poradi = 1)
  {
    $result = "";
    $dat = explode($oddelovac, $datum);

    if (is_array($poradi))
    {
      for ($i = 0; $i < count($poradi); $i++)
      {
        $result .= $dat[$poradi[$i]];
      }

      if (count($poradi) == 2)  //pokud jsou jen 2 elementy tak prida 3 tj aktualni rok
      {
        $result .= date("Y");
      }
    }
      else
    {
      $result = $dat[$poradi];
    }

    return $result;
  }

/**
 *
 * Nacita obsah akci
 *
 * @param obsahakci vstupni pole akci
 * @param datumpolozka cislo polozky datumu
 * @param nazevpolozka cislo polozky nazvu
 * @param format format datumu
 * @param oddelovac oddelovac do textu datumu
 * @param poradi cislo polozky datumu (i pole)
 * @param format format vystupniho data
 */
  public function NacteniAkci($obsahakci, $datumpolozka = 0, $nazevpolozka = 1, $format = "j.n.Y", $oddelovac = " ", $poradi)
  {
    if (is_array($obsahakci))
    {
      for ($i = 0; $i < count($obsahakci["obsah"]); $i++)
      {
        $obsahpole = explode("|-x-|", $obsahakci["obsah"][$i]);

        $this->dostupneakce["datum"][] = date($format, strtotime($this->DekodujDatum($obsahpole[$datumpolozka], $oddelovac, $poradi)));
        $this->dostupneakce["nazev"][] = $obsahpole[$nazevpolozka];
      }
    }
  }

/**
 *
 * Vypise seznam akci
 *
 * @return html select
 */
  private function VyberAkce()
  {
    $result = $this->NactiUnikatniObsah($this->unikatni["normal_datum_select_begin"]);
    for ($i = 0; $i < count($this->dostupneakce["nazev"]); $i++)
    {
      $result .= $this->NactiUnikatniObsah($this->unikatni["normal_datum_select"],
                                          $this->dostupneakce["datum"][$i],
                                          $this->dostupneakce["nazev"][$i]);
    }
    $result .= $this->NactiUnikatniObsah($this->unikatni["normal_datum_select_end"]);

    return $result;
  }

/**
 *
 * Vypise seznam typu dopravy
 *
 * @return html select
 */
  private function VyberDopravy()
  {
    $result = $this->NactiUnikatniObsah($this->unikatni["normal_doprava_select_begin"]);
    $klice = array_keys($this->doprava);
    for ($i = 0; $i < count($this->doprava); $i++)
    {
      $result .= $this->NactiUnikatniObsah($this->unikatni["normal_doprava_select"],
                                          $klice[$i],
                                          $this->doprava[$klice[$i]]);
    }
    $result .= $this->NactiUnikatniObsah($this->unikatni["normal_doprava_select_end"]);

    return $result;
  }

/**
 *
 * Vypise seznam startu cesty
 *
 * @return html select
 */
  private function VyberStartu()
  {
    $result = $this->NactiUnikatniObsah($this->unikatni["normal_start_select_begin"]);
    for ($i = 0; $i < count($this->vychozi); $i++)
    {
      $result .= $this->NactiUnikatniObsah($this->unikatni["normal_start_select"],
                                          $this->vychozi[$i],
                                          $this->vychozi[$i]);
    }
    $result .= $this->NactiUnikatniObsah($this->unikatni["normal_start_select_end"]);

    return $result;
  }

/**
 *
 * Generovani samotneho statickeho menu
 *
 * pouziti: <strong>$text = $this->var->main[0]->NactiFunkci("StaticIdos", "Idos"[, 1]);</strong>
 *
 * @param tvar cislo tvaru
 * @return vygenerovane menu
 */
  public function Idos($tvar = 1)
  {
    $this->cas = $this->NactiUnikatniObsah($this->unikatni["set_cas_{$tvar}"]);
    $this->cil = $this->NactiUnikatniObsah($this->unikatni["set_cil_{$tvar}"]);

    $result = $this->NactiUnikatniObsah($this->unikatni["normal_vypis_obsah_{$tvar}"],
                                        $this->VyberAkce(),
                                        $this->VyberStartu(),
                                        $this->cil,
                                        $this->VyberDopravy(),
                                        $this->cas,
                                        " name=\"tlacitko\"");

    if (!Empty($_POST["tlacitko"]) && //pokud se splni dane podminky
        !Empty($_POST["datum"]) &&
        !Empty($_POST["start"]) &&
        !Empty($_POST["doprava"]))
    {
      $vstup[] = $_POST["doprava"];
      $vstup[] = $_POST["start"];
      $vstup[] = $this->cil;
      $vstup[] = $_POST["datum"];
      $vstup[] = $this->cas;

      $redirect = $this->vyhledavaciurl;
      for ($i = 0; $i < 5; $i++)
      {
        $redirect = str_replace("%%{$i}%%", $vstup[$i], $redirect);
      }

      $this->var->main[0]->AutoClick(1, $redirect);  //auto kliknuti a vyhledani spoje
    }

    return $result;
  }
}
?>
