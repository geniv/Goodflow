<?php

/**
 *
 * Blok strankovani
 *
 * public funkce:\n
 * construct: StatickeStrankovani - hlavni konstruktor tridy\n
 * Strankovani() - hlavni funkce ktera vraci vygeverovane strankovani\n
 *
 */

class StatickeStrankovani extends DefaultModule
{
  private $var, $dirpath, $absolutni_url, $unikatni;
  private $get_str = "str";

/**
 *
 * Konstruktor obsahu
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
  }

/**
 *
 * Strankuje hlavni vypis, definovano na promenny pocet stranek, radkove strankovani, eshop ma vlastni kvuli radkovani do tabulky
 *
 * pouziti: <strong>list($str, $limit) = $this->var->main[0]->NactiFunkci("StatickeStrankovani", "Strankovani", 10, $pocet_radku, "moje_adresa", "limit");</strong>
 *
 * @param na_stranku cislo urcujici pocet polozek na stranku
 * @param pocet_radku pocet radku (polozek) v cele databazi (ci dane sekci!!)
 * @param adresa text adresy pro maximalni zachovani funkcnosti odkazu
 * @param typ urcuje typ vystupu pres parametr limit - limit/array
 * @param tvar cislo tvaru
 * @return [0]=>strankovaci odkazy; typ=limit,[1]=>dotaz do databaze pro dany vypis polozek; typ=array,[1]=>pole minimum a maximum
 */
  public function Strankovani($na_stranku, $pocet_radku, $adresa, $typ = "limit", $tvar = 1)
  {
    $strana = (!Empty($_GET[$this->get_str]) ? $_GET[$this->get_str] : 1);
    settype($strana, "integer");

    settype($na_stranku, "integer");
    $pocetstran = ceil($pocet_radku / $na_stranku);  //vypocteny pocet stran podle strankovani

    $mezi = false;
    if ($pocetstran > 7)
    {
      for ($i = 0; $i < 3; $i++)  //prvni trojicka
      {
        $poc = $i + 1;  //predvipocotani poctu

        if ($i == 0 && $strana > 1)  //predchozi
        {
          $prev = $strana - 1;
          $jdi .= $this->NactiUnikatniObsah($this->unikatni["normal_prev_{$tvar}"],
                                            ($this->var->htaccess ? "{$this->absolutni_url}{$adresa}{$prev}" : "{$adresa}&amp;str={$prev}"));
        }

        if ($poc == $strana)  //detekce oznacene stranky
        {
          $jdi .= $this->NactiUnikatniObsah($this->unikatni["normal_curr_act_{$tvar}"], $poc);
          $aktualni = $poc;
        }
          else
        {
          $jdi .= $this->NactiUnikatniObsah($this->unikatni["normal_curr_{$tvar}"],
                                            ($this->var->htaccess ? "{$this->absolutni_url}{$adresa}{$poc}" : "{$adresa}&amp;str={$poc}"),
                                            $poc);
        }
      }

      //vypocet povoleni mezi kusu
      if ($strana > 2 && $strana <= ($pocetstran - 2))
      {
        $mezi = true;
      }
        else
      {
        $jdi = substr($jdi, 0, -2)." "; //odebrani carky <- carka za 3
        $jdi .= $this->NactiUnikatniObsah($this->unikatni["normal_dotted_{$tvar}"]);
      }

      for ($i = $pocetstran - 3; $i < $pocetstran; $i++)  //posledni trojicka
      {
        $poc = $i + 1;  //predvipocotani poctu

        if ($poc == $strana)  //detekce oznacene stranky
        {
          $jdi .= $this->NactiUnikatniObsah($this->unikatni["normal_curr_act_{$tvar}"], $poc);
          $aktualni = $poc;
        }
          else
        {
          $jdi .= $this->NactiUnikatniObsah($this->unikatni["normal_curr_{$tvar}"],
                                            ($this->var->htaccess ? "{$this->absolutni_url}{$adresa}{$poc}" : "{$adresa}&amp;str={$poc}"),
                                            $poc);
        }

        if ($poc == $pocetstran && $aktualni != $poc) //dalsi
        {
          $jdi = substr($jdi, 0, -2); //odebrani carky
          $next = $aktualni + 1;
          $jdi .= $this->NactiUnikatniObsah($this->unikatni["normal_next_{$tvar}"],
                                            ($this->var->htaccess ? "{$this->absolutni_url}{$adresa}{$next}" : "{$adresa}&amp;str={$next}"));
        }
      }
    }
      else
    {
      for ($i = 0; $i < $pocetstran; $i++)
      {
        $poc = $i + 1;  //predvipocotani poctu, posun z 0 indexu

        if ($i == 0 && $strana > 1)  //predchozi
        {
          $prev = $strana - 1;
          $jdi .= $this->NactiUnikatniObsah($this->unikatni["normal_prev_{$tvar}"],
                                            ($this->var->htaccess ? "{$this->absolutni_url}{$adresa}{$prev}" : "{$adresa}&amp;str={$prev}"));
        }

        if ($poc == $strana)  //detekce oznacene stranky, $str == $strana
        {
          $jdi .= $this->NactiUnikatniObsah($this->unikatni["normal_curr_act_{$tvar}"], $poc);
          $aktualni = $poc;
        }
          else
        {
          $jdi .= $this->NactiUnikatniObsah($this->unikatni["normal_curr_{$tvar}"],
                                            ($this->var->htaccess ? "{$this->absolutni_url}{$adresa}{$poc}" : "{$adresa}&amp;str={$poc}"),
                                            $poc);
        }

        if ($i == ($pocetstran - 1) && $aktualni != $poc) //dalsi
        {
          $jdi = substr($jdi, 0, -2); //odebrani carky

          $next = $aktualni + 1;
          $jdi .= $this->NactiUnikatniObsah($this->unikatni["normal_next_{$tvar}"],
                                            ($this->var->htaccess ? "{$this->absolutni_url}{$adresa}{$next}" : "{$adresa}&amp;str={$next}"));
        }
      }
    }

    if ($mezi)
    {
      $prev = $strana - 1;  //predchozi
      $pred = $this->NactiUnikatniObsah($this->unikatni["normal_prev_{$tvar}"],
                                        ($this->var->htaccess ? "{$this->absolutni_url}{$adresa}{$prev}" : "{$adresa}&amp;str={$prev}"));

      $i = 0;
      $poc = $i + 1;  //prvni
      $jdi = $this->NactiUnikatniObsah($this->unikatni["normal_mezi_prev_{$tvar}"],
                                      $pred,
                                      ($this->var->htaccess ? "{$this->absolutni_url}{$adresa}{$poc}" : "{$adresa}&amp;str={$poc}"),
                                      $poc);

      $poc = $strana - 1;  //prostredni - 1
      $jdi .= $this->NactiUnikatniObsah($this->unikatni["normal_curr_{$tvar}"],
                                        ($this->var->htaccess ? "{$this->absolutni_url}{$adresa}{$poc}" : "{$adresa}&amp;str={$poc}"),
                                        $poc);

      $poc = $strana;  //prostredni
      $jdi .= $this->NactiUnikatniObsah($this->unikatni["normal_curr_act_{$tvar}"], $poc);

      $aktualni = $strana;  //prostedni clen

      $poc = $strana + 1;  //prostredni + 1
      $jdi .= $this->NactiUnikatniObsah($this->unikatni["normal_mezi_prev_{$tvar}"],
                                      "",
                                      ($this->var->htaccess ? "{$this->absolutni_url}{$adresa}{$poc}" : "{$adresa}&amp;str={$poc}"),
                                      $poc);

      $poc = $pocetstran;  //posledni
      $jdi .= $this->NactiUnikatniObsah($this->unikatni["normal_curr_{$tvar}"],
                                        ($this->var->htaccess ? "{$this->absolutni_url}{$adresa}{$poc}" : "{$adresa}&amp;str={$poc}"),
                                        $poc);

      $jdi = substr($jdi, 0, -2); //odebrani carky

      $next = $aktualni + 1;  //dalsi
      $jdi .= $this->NactiUnikatniObsah($this->unikatni["normal_next_{$tvar}"],
                                        ($this->var->htaccess ? "{$this->absolutni_url}{$adresa}{$next}" : "{$adresa}&amp;str={$next}"));
    }

    $jdi = substr($jdi, 0, -2); //odebrani carky

    $result[0] = $this->NactiUnikatniObsah($this->unikatni["normal_strankovani_{$tvar}"],
                                          $jdi,
                                          $strana,
                                          $pocetstran);

    switch ($typ)
    {
      case "limit":
        $od = ($strana - 1) * $na_stranku;
        $result[1] = "LIMIT {$od}, {$na_stranku}"; //dodatecny dotaz do DB
      break;

      case "array":
        $result[1][0] = ($strana - 1) * $na_stranku;
        $result[1][1] = (($strana - 1) * $na_stranku) + $na_stranku - 1;
      break;
    }

    return $result;
  }
}
?>
