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

class StatickeStrankovani //extends DefaultModule
{
  private $var;
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
 * @return [0]=>strankovaci odkazy; typ=limit,[1]=>dotaz do databaze pro dany vypis polozek; typ=array,[1]=>pole minimum a maximum
 */
  public function Strankovani($na_stranku, $pocet_radku, $adresa, $typ = "limit")
  {
    $strana = $_GET[$this->get_str];
    settype($strana, "integer");

    settype($na_stranku, "integer");
    $pocetstran = ceil($pocet_radku / $na_stranku);  //vypocteny pocet stran podle strankovani

    $mezai = false;
    if ($pocetstran > 7)
    {
      for ($i = 0; $i < 3; $i++)  //prvni trojicka
      {
        $str = $i * $na_stranku; //stranka do DB
        $poc = $i + 1;  //predvipocotani poctu

        if ($i == 0 && $strana != 0)  //predchozi
        {
          $prev = $strana - $na_stranku;
          $jdi .= "<a href=\"{$adresa}&amp;str={$prev}\" title=\"\">předchozí</a> ";
        }

        if ($str == $strana)  //detekce oznacene stranky
        {
          $jdi .= "{$poc}, ";
          $aktualni = $poc;
        }
          else
        {
          $jdi .= "<a href=\"{$adresa}&amp;str={$str}\" title=\"\">{$poc}</a>, ";
        }
      }

      if (($strana / $na_stranku) >= 2 && ($strana / $na_stranku) <= ($pocetstran - 3))
      {
        $mezi = true;
      }
        else
      {
        $jdi .= "..., ";
      }

      for ($i = $pocetstran - 3; $i < $pocetstran; $i++)  //posledni trojicka
      {
        $str = $i * $na_stranku; //stranka do DB
        $poc = $i + 1;  //predvipocotani poctu

        if ($str == $strana)  //detekce oznacene stranky
        {
          $jdi .= "{$poc}, ";
          $aktualni = $poc;
        }
          else
        {
          $jdi .= "<a href=\"{$adresa}&amp;str={$str}\" title=\"\">{$poc}</a>, ";
        }

        if ($i == ($pocetstran - 1) && $aktualni != $poc) //dalsi
        {
          $jdi = substr($jdi, 0, -2); //odebrani carky
          $next = $strana + $na_stranku;
          $jdi .= " <a href=\"{$adresa}&amp;str={$next}\" title=\"\">další</a>, ";
        }
      }
    }
      else
    {
      for ($i = 0; $i < $pocetstran; $i++)
      {
        $str = $i * $na_stranku; //stranka do DB
        $poc = $i + 1;  //predvipocotani poctu

        if ($i == 0 && $strana != 0)  //predchozi
        {
          $prev = $strana - $na_stranku;
          $jdi .= "<a href=\"{$adresa}&amp;str={$prev}\" title=\"\">předchozí</a> ";
        }

        if ($str == $strana)  //detekce oznacene stranky
        {
          $jdi .= "{$poc}, ";
          $aktualni = $poc;
        }
          else
        {
          $jdi .= "<a href=\"{$adresa}&amp;str={$str}\" title=\"\">{$poc}</a>, ";
        }

        if ($i == ($pocetstran - 1) && $aktualni != $poc) //dalsi
        {
          $jdi = substr($jdi, 0, -2); //odebrani carky

          $next = $strana + $na_stranku;
          $jdi .= " <a href=\"{$adresa}&amp;str={$next}\" title=\"\">další</a>, ";
        }
      }
    }

    if ($mezi)
    {
      $prev = $strana - $na_stranku;  //predchozi
      $pred = "<a href=\"{$adresa}&amp;str={$prev}\" title=\"\">předchozí</a> ";

      $i = 0;
      $str = $i * $na_stranku; //stranka do DB
      $poc = $i + 1;  //predvipocotani poctu
      $jdi = "{$pred}<a href=\"{$adresa}&amp;str={$str}\" title=\"\">{$poc}</a>, ..., ";

      $i = ($strana / $na_stranku) - 1;
      $str = $i * $na_stranku; //stranka do DB
      $poc = $i + 1;  //predvipocotani poctu
      $jdi .= "<a href=\"{$adresa}&amp;str={$str}\" title=\"\">{$poc}</a>, ";

      $i = ($strana / $na_stranku);
      $str = $i * $na_stranku; //stranka do DB
      $poc = $i + 1;  //predvipocotani poctu
      $jdi .= "{$poc}</a>, ";

      $aktualni = $poc; //prostedni clen

      $i = ($strana / $na_stranku) + 1;
      $str = $i * $na_stranku; //stranka do DB
      $poc = $i + 1;  //predvipocotani poctu
      $jdi .= "<a href=\"{$adresa}&amp;str={$str}\" title=\"\">{$poc}</a>, ..., ";

      $i = $pocetstran - 1;
      $str = $i * $na_stranku; //stranka do DB
      $poc = $i + 1;  //predvipocotani poctu
      $jdi .= "<a href=\"{$adresa}&amp;str={$str}\" title=\"\">{$poc}</a>, ";

      $jdi = substr($jdi, 0, -2); //odebrani carky
      $next = $strana + $na_stranku;  //dalsi
      $jdi .= " <a href=\"{$adresa}&amp;str={$next}\" title=\"\">další</a>, ";
    }

    $jdi = substr($jdi, 0, -2); //odebrani carky

    $result[0] =
    "
    <div id=\"strankovani\">
      {$jdi}
      <p id=\"vpravo\">
        Strana: {$aktualni} z {$pocetstran}
      </p>
    </div>
    ";

    switch ($typ)
    {
      case "limit":
        $result[1] = "LIMIT {$strana}, {$na_stranku}"; //dodatecny dotaz do DB
      break;

      case "array":
        $result[1][0] = $strana;
        $result[1][1] = $strana + $na_stranku;
      break;
    }

    return $result;
  }
}
?>
