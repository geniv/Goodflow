<?php

/**
 *
 * Blok strankovani
 *
 */

class StatickeStrankovani extends DefaultModule
{
  private $var, $dirpath, $absolutni_url, $unikatni;
  public $mount = array("");
  public $generated = array(""); //soubory co generuje modul
  public $support = array(NODATA);  //modulem podporovane databeze
  private $get_str = "str";

/**
 *
 * Konstruktor obsahu
 *
 * @param var pruchodova struktura
 * @param index prideleny index pri generovani
 */
  public function __construct(&$var = NULL, $index = -1) //konstruktor
  {
    if (!Empty($var))
    {
      $this->var = $var;
      $this->dirpath = dirname($this->var->moduly[$index]["include"]);

      //includovani unikatniho obsahu
      $this->unikatni = $this->NactiObsahSouboru("{$this->dirpath}/.unikatni_obsah.php");
      $this->absolutni_url = $this->AbsolutniUrl();
    }
  }

/**
 *
 * Strankuje hlavni vypis, definovano na promenny pocet stranek, radkove strankovani, eshop ma vlastni kvuli radkovani do tabulky
 *
 * pouziti: <strong>list($str, $limit) = $this->var->main[0]->NactiFunkci("StatickeStrankovani", "Strankovani", 10, $pocet_radku, "url_adresa", "limit");</strong>
 *
 * @param na_stranku cislo urcujici pocet polozek na stranku
 * @param pocet_radku pocet radku (polozek) v cele databazi (ci dane sekci!!)
 * @param adresa text adresy pro zachovani funkcnosti odkazu
 * @param typ urcuje typ vystupu pres parametr limit - limit/array
 * @param tvar cislo tvaru
 * @return [0]=>strankovaci odkazy; typ=limit,[1]=>dotaz do databaze pro dany vypis polozek; typ=array,[1]=>pole minimum a maximum
 */
  public function Strankovani($na_stranku, $pocet_radku, $adresa = "", $typ = "limit", $tvar = 1)
  {
    $this->get_str = $this->unikatni["set_get_str_{$tvar}"];

    $strana = (!Empty($_GET[$this->get_str]) ? $_GET[$this->get_str] : 1);
    settype($strana, "integer");
    $strana = (!Empty($strana) ? $strana : 1); //proti nulove strane

    if ($pocet_radku <= 0)
    {
      $this->ErrorMsg("Není zadáno: pocet_radku!", array(__LINE__, __METHOD__));
    }

    settype($na_stranku, "integer");
    $pocetstran = 0;
    if ($na_stranku > 0)
    {
      $pocetstran = ceil($pocet_radku / $na_stranku); //vypocteny pocet stran podle strankovani
      settype($pocetstran, "integer");
    }
      else
    {
      $this->ErrorMsg("Není zadáno: na_stranku. Dělit nulou umí jen Chuck Norris!", array(__LINE__, __METHOD__));
    }

    $plus = 0;
    $poc = 0;
    $od = 0;
    $do = 0;
    $outtyp = 0;
    $jdi = "";
    $pole_stran = "";
    $pred = "";
    $za = "";
    $prev = 0;
    $next = 0;
    $typ_vypisu = $this->unikatni["set_typ_vypisu_{$tvar}"];

    //dynamicke prepinani typu strankovani
    if ($this->unikatni["set_active_pole_prechodu_{$tvar}"])
    {
      $pole_prechodu_typu = $this->unikatni["set_pole_prechodu_typu_{$tvar}"];
      //ziskani klicu
      $klice = array_keys($pole_prechodu_typu);
      $c_prechod = count($pole_prechodu_typu);
      for ($i = 0; $i < $c_prechod; $i++)
      {
        if ($pole_prechodu_typu[$klice[$i]] == 0) //kdyz detekuje infinite
        {
          $typ_vypisu = $klice[$i];
          break;
        }

        if ($pole_prechodu_typu[$klice[$i]] >= $pocetstran) //pokud je max>=pocetstran
        {
          $typ_vypisu = $klice[$i];
          break;
        }
      }
    }

    $strana = ($strana > $pocetstran ? $pocetstran : $strana);  //kontrola preteceni

//var_dump($typ_vypisu, $pocetstran);
//var_dump($pocetstran);
    switch ($typ_vypisu)
    {
      default:
      case "lowclassic":  //zkracovany klasicky: << 1,2,3 ... 5,6,7 ... 9,10,11 >>
        if ($pocetstran > 0)
        {
          $prvni = abs($this->unikatni["normal_lowclassic_prvni_{$tvar}"]);  //delka prvniho
          $prostredni = abs($this->unikatni["normal_lowclassic_prostredni_{$tvar}"]); //delka prostrednino, liche cislo
          $posledni = abs($this->unikatni["normal_lowclassic_posledni_{$tvar}"]); //delka posledniho

          $dot = $this->unikatni["normal_lowclassic_dot_{$tvar}"];
          $sep = $this->unikatni["normal_lowclassic_sep_{$tvar}"];

          if ($strana != 1) //prev page, kdyz neni prvni
          {
            $prev = $strana - 1;
            $jdi .= $this->NactiUnikatniObsah($this->unikatni["normal_lowclassic_prev_{$tvar}"],
                                              "{$this->absolutni_url}{$adresa}{$prev}",
                                              "{$this->absolutni_url}{$adresa}1");
          }

          $outtyp = 0;
          //cislo v 1/3
          if ($strana >= $prvni && $strana < ($prvni + $prostredni))
          {
            $outtyp = 1;
          }

          //cislo v 2/3
          if ($strana >= ($prvni + $prostredni) && $strana <= ($pocetstran - $posledni - $prostredni + 1))
          {
            $outtyp = 2;
          }

          //cislo v 3/3
          if ($strana > ($pocetstran - $posledni - $prostredni + 1) && $strana <= ($pocetstran - $posledni + 1))
          {
            $outtyp = 3;
          }

          //prvni skupinka
          for ($i = 0; $i < $prvni; $i++)
          {
            $poc = $i + 1;
            if ($poc == $strana)
            {
              $pole_stran_begin[] = $this->NactiUnikatniObsah($this->unikatni["normal_lowclassic_current_{$tvar}"],
                                                              $poc);
            }
              else
            {
              $pole_stran_begin[] = $this->NactiUnikatniObsah($this->unikatni["normal_lowclassic_page_{$tvar}"],
                                                              "{$this->absolutni_url}{$adresa}{$poc}",
                                                              $poc);
            }
          }

          $pred = $sep;
          $za = $dot;
          switch ($outtyp)
          {
            case 1: //zacatek
              for ($i = $prvni; $i < ($prvni + $prostredni); $i++)
              {
                $poc = $i + 1;
                if ($poc == $strana)
                {
                  $pole_stran[] = $this->NactiUnikatniObsah($this->unikatni["normal_lowclassic_current_{$tvar}"],
                                                            $poc);
                }
                  else
                {
                  $pole_stran[] = $this->NactiUnikatniObsah($this->unikatni["normal_lowclassic_page_{$tvar}"],
                                                            "{$this->absolutni_url}{$adresa}{$poc}",
                                                            $poc);
                }
              }

              //$pred = $sep;
              //$za = $dot;
            break;

            case 2: //prostredek
              $pulvysek = floor($prostredni / 2);
              settype($pulvysek, "integer");

              for ($i = ($strana - $pulvysek) - 1; $i < ($strana + $pulvysek); $i++)
              {
                $poc = $i + 1;
                if ($poc == $strana)
                {
                  $pole_stran[] = $this->NactiUnikatniObsah($this->unikatni["normal_lowclassic_current_{$tvar}"],
                                                            $poc);
                }
                  else
                {
                  $pole_stran[] = $this->NactiUnikatniObsah($this->unikatni["normal_lowclassic_page_{$tvar}"],
                                                            "{$this->absolutni_url}{$adresa}{$poc}",
                                                            $poc);
                }
              }

              $pred = $dot;
              $za = $dot;
            break;

            case 3:
              for ($i = ($pocetstran - $posledni - $prostredni); $i < ($pocetstran - $posledni); $i++)
              {
                $poc = $i + 1;
                if ($poc == $strana)
                {
                  $pole_stran[] = $this->NactiUnikatniObsah($this->unikatni["normal_lowclassic_current_{$tvar}"],
                                                            $poc);
                }
                  else
                {
                  $pole_stran[] = $this->NactiUnikatniObsah($this->unikatni["normal_lowclassic_page_{$tvar}"],
                                                            "{$this->absolutni_url}{$adresa}{$poc}",
                                                            $poc);
                }
              }

              $pred = $dot;
              $za = $sep;
            break;
          }

          //posledni skupinka
          for ($i = ($pocetstran - $posledni); $i < $pocetstran; $i++)
          {
            $poc = $i + 1;
            if ($poc == $strana)
            {
              $pole_stran_end[] = $this->NactiUnikatniObsah($this->unikatni["normal_lowclassic_current_{$tvar}"],
                                                            $poc);
            }
              else
            {
              $pole_stran_end[] = $this->NactiUnikatniObsah($this->unikatni["normal_lowclassic_page_{$tvar}"],
                                                            "{$this->absolutni_url}{$adresa}{$poc}",
                                                            $poc);
            }
          }

          $jdi .= implode($sep, $pole_stran_begin);

          $jdi .= $pred;

          $jdi .= (is_array($pole_stran) ? implode($sep, $pole_stran) : "");

          $jdi .= $za;

          $jdi .= implode($sep, $pole_stran_end);

          if ($strana != $pocetstran) //next page, kdyz neni posledni
          {
            $next = $strana + 1;
            $jdi .= $this->NactiUnikatniObsah($this->unikatni["normal_lowclassic_next_{$tvar}"],
                                              "{$this->absolutni_url}{$adresa}{$next}",
                                              "{$this->absolutni_url}{$adresa}{$pocetstran}");
          }
        }
      break;


      case "fullclassic": //plny klasicky: << 1, 2, 3, 4, 5, 6, 7 >>
        if ($pocetstran > 0)
        {
          if ($strana != 1) //prev page, kdyz neni prvni
          {
            $prev = $strana - 1;
            $jdi .= $this->NactiUnikatniObsah($this->unikatni["normal_fullclassic_prev_{$tvar}"],
                                              "{$this->absolutni_url}{$adresa}{$prev}",
                                              "{$this->absolutni_url}{$adresa}1");
          }

          //cyklus generovani pole stranek
          for ($i = 0; $i < $pocetstran; $i++)
          {
            $poc = $i + 1;
            if ($strana == $poc)  //prepis aktivni stranky
            {
              $pole_stran[] = $this->NactiUnikatniObsah($this->unikatni["normal_fullclassic_current_{$tvar}"],
                                                        $poc);
            }
              else
            {
              $pole_stran[] = $this->NactiUnikatniObsah($this->unikatni["normal_fullclassic_page_{$tvar}"],
                                                        "{$this->absolutni_url}{$adresa}{$poc}",
                                                        $poc);
            }
          }

          $jdi .= implode($this->unikatni["normal_fullclassic_sep_{$tvar}"], $pole_stran); //slouceni pole stran

          if ($strana != $pocetstran) //next page, kdyz neni posledni
          {
            $next = $strana + 1;
            $jdi .= $this->NactiUnikatniObsah($this->unikatni["normal_fullclassic_next_{$tvar}"],
                                              "{$this->absolutni_url}{$adresa}{$next}",
                                              "{$this->absolutni_url}{$adresa}{$pocetstran}");
          }
        }
      break;


      case "lowgroups":  //skupinovy: << [1..10] [11..20] ... [21..30] [31..40] >>
        if ($pocetstran > 0)
        {
          $prvni = abs($this->unikatni["normal_lowgroups_prvni_{$tvar}"]);
          $prostredni = abs($this->unikatni["normal_lowgroups_prostredni_{$tvar}"]);
          $posledni = abs($this->unikatni["normal_lowgroups_posledni_{$tvar}"]);
          $sep = $this->unikatni["normal_lowgroups_sep_{$tvar}"];
          $dot = $this->unikatni["normal_lowgroups_dot_{$tvar}"];

          if ($strana != 1) //prev page, kdyz neni prvni
          {
            $prev = $strana - 1;
            $jdi .= $this->NactiUnikatniObsah($this->unikatni["normal_lowgroups_prev_{$tvar}"],
                                              "{$this->absolutni_url}{$adresa}{$prev}",
                                              "{$this->absolutni_url}{$adresa}1");
          }

          //prvni skupina
          for ($i = 0; $i < $prvni; $i++)
          {
            $poc = $i + 1;  //poradi polozky
            $od = ($i * $na_stranku) + 1;  //od polozky
            $do = ($od + $na_stranku) - 1; //do polozky

            if ($strana == $poc)  //oznaceni aktivniho
            {
              $jdi .= $this->NactiUnikatniObsah($this->unikatni["normal_lowgroups_current_{$tvar}"],
                                                $od,
                                                $do);
            }
              else
            {
              $jdi .= $this->NactiUnikatniObsah($this->unikatni["normal_lowgroups_page_{$tvar}"],
                                                "{$this->absolutni_url}{$adresa}{$poc}",
                                                $od,
                                                $do);
            }
          }

          $outtyp = 0;
          //cislo v 1/3
          if ($strana >= $prvni && $strana < ($prvni + $prostredni))
          {
            $outtyp = 1;
          }

          //cislo v 2/3
          if ($strana >= ($prvni + $prostredni) && $strana <= ($pocetstran - $posledni - $prostredni + 1))
          {
            $outtyp = 2;
          }

          //cislo v 3/3
          if ($strana > ($pocetstran - $posledni - $prostredni + 1) && $strana <= ($pocetstran - $posledni + 1))
          {
            $outtyp = 3;
          }

          $pred = $sep;
          $za = $dot;
          switch ($outtyp)
          {
            case 1: //zacatek
              for ($i = $prvni; $i < ($prvni + $prostredni); $i++)
              {
                $poc = $i + 1;  //poradi polozky
                $od = ($i * $na_stranku) + 1;  //od polozky
                $do = ($od + $na_stranku) - 1; //do polozky

                if ($strana == $poc)  //oznaceni aktivniho
                {
                  $pole_stran[] = $this->NactiUnikatniObsah($this->unikatni["normal_lowgroups_current_{$tvar}"],
                                                            $od,
                                                            $do);
                }
                  else
                {
                  $pole_stran[] = $this->NactiUnikatniObsah($this->unikatni["normal_lowgroups_page_{$tvar}"],
                                                            "{$this->absolutni_url}{$adresa}{$poc}",
                                                            $od,
                                                            $do);
                }
              }

              //$pred = $sep;
              //$za = $dot;
            break;

            case 2: //prostredek
              $pulvysek = floor($prostredni / 2);
              settype($pulvysek, "integer");

              for ($i = ($strana - $pulvysek) - 1; $i < ($strana + $pulvysek); $i++)
              {
                $poc = $i + 1;  //poradi polozky
                $od = ($i * $na_stranku) + 1;  //od polozky
                $do = ($od + $na_stranku) - 1; //do polozky

                if ($strana == $poc)  //oznaceni aktivniho
                {
                  $pole_stran[] = $this->NactiUnikatniObsah($this->unikatni["normal_lowgroups_current_{$tvar}"],
                                                            $od,
                                                            $do);
                }
                  else
                {
                  $pole_stran[] = $this->NactiUnikatniObsah($this->unikatni["normal_lowgroups_page_{$tvar}"],
                                                            "{$this->absolutni_url}{$adresa}{$poc}",
                                                            $od,
                                                            $do);
                }
              }

              $pred = $dot;
              //$za = $dot;
            break;

            case 3:
              for ($i = ($pocetstran - $posledni - $prostredni); $i < ($pocetstran - $posledni); $i++)
              {
                $poc = $i + 1;  //poradi polozky
                $od = ($i * $na_stranku) + 1;  //od polozky
                $do = ($od + $na_stranku) - 1; //do polozky

                if ($strana == $poc)  //oznaceni aktivniho
                {
                  $pole_stran[] = $this->NactiUnikatniObsah($this->unikatni["normal_lowgroups_current_{$tvar}"],
                                                            $od,
                                                            $do);
                }
                  else
                {
                  $pole_stran[] = $this->NactiUnikatniObsah($this->unikatni["normal_lowgroups_page_{$tvar}"],
                                                            "{$this->absolutni_url}{$adresa}{$poc}",
                                                            $od,
                                                            $do);
                }
              }

              $pred = $dot;
              $za = $sep;
            break;
          }

          $jdi .= $pred;

          $jdi .= (is_array($pole_stran) ? implode($sep, $pole_stran) : "");

          $jdi .= $za;

          //posledni skupina
          for ($i = ($pocetstran - $posledni); $i < $pocetstran; $i++)
          {
            $poc = $i + 1;  //poradi polozky
            $od = ($i * $na_stranku) + 1;  //od polozky
            $do = ($od + $na_stranku) - 1; //do polozky

            if ($strana == $poc)  //oznaceni aktivniho
            {
              $jdi .= $this->NactiUnikatniObsah($this->unikatni["normal_lowgroups_current_{$tvar}"],
                                                $od,
                                                $do);
            }
              else
            {
              $jdi .= $this->NactiUnikatniObsah($this->unikatni["normal_lowgroups_page_{$tvar}"],
                                                "{$this->absolutni_url}{$adresa}{$poc}",
                                                $od,
                                                $do);
            }
          }

          if ($strana != $pocetstran) //next page, kdyz neni posledni
          {
            $next = $strana + 1;
            $jdi .= $this->NactiUnikatniObsah($this->unikatni["normal_lowgroups_next_{$tvar}"],
                                              "{$this->absolutni_url}{$adresa}{$next}",
                                              "{$this->absolutni_url}{$adresa}{$pocetstran}");
          }
        }
      break;


      case "fullgroups":  //skupinovy: << [1..10] [11..20] [21..30] >>
        if ($pocetstran > 0)
        {
          if ($strana != 1) //prev page, kdyz neni prvni
          {
            $prev = $strana - 1;
            $jdi .= $this->NactiUnikatniObsah($this->unikatni["normal_fullgroups_prev_{$tvar}"],
                                              "{$this->absolutni_url}{$adresa}{$prev}",
                                              "{$this->absolutni_url}{$adresa}1");
          }

          for ($i = 0; $i < $pocetstran; $i++)
          {
            $poc = $i + 1;  //poradi polozky
            $od = ($i * $na_stranku) + 1;  //od polozky
            $do = ($od + $na_stranku) - 1; //do polozky

            if ($strana == $poc)  //oznaceni aktivniho
            {
              $jdi .= $this->NactiUnikatniObsah($this->unikatni["normal_fullgroups_current_{$tvar}"],
                                                $od,
                                                $do);
            }
              else
            {
              $jdi .= $this->NactiUnikatniObsah($this->unikatni["normal_fullgroups_page_{$tvar}"],
                                                "{$this->absolutni_url}{$adresa}{$poc}",
                                                $od,
                                                $do);
            }
          }

          if ($strana != $pocetstran) //next page, kdyz neni posledni
          {
            $next = $strana + 1;
            $jdi .= $this->NactiUnikatniObsah($this->unikatni["normal_fullgroups_next_{$tvar}"],
                                              "{$this->absolutni_url}{$adresa}{$next}",
                                              "{$this->absolutni_url}{$adresa}{$pocetstran}");
          }
        }
      break;


      case "once":  //jednociselny: << 2 >>
        if ($pocetstran > 0)
        {
          if ($strana != 1) //prev page, kdyz neni prvni
          {
            $prev = $strana - 1;
            $jdi .= $this->NactiUnikatniObsah($this->unikatni["normal_once_prev_{$tvar}"],
                                              "{$this->absolutni_url}{$adresa}{$prev}",
                                              "{$this->absolutni_url}{$adresa}1");
          }

          //hlavni cislo
          $jdi .= $this->NactiUnikatniObsah($this->unikatni["normal_once_current_{$tvar}"],
                                            $strana);

          if ($strana != $pocetstran) //next page, kdyz neni posledni
          {
            $next = $strana + 1;
            $jdi .= $this->NactiUnikatniObsah($this->unikatni["normal_once_next_{$tvar}"],
                                              "{$this->absolutni_url}{$adresa}{$next}",
                                              "{$this->absolutni_url}{$adresa}{$pocetstran}");
          }
        }
      break;


      case "cuting":  //vysek stranek: << 1, 2, 3, 4, 5 ... >>
        if ($pocetstran > 0)
        {
          $vysek = $this->unikatni["normal_cuting_vysek_{$tvar}"];
          $pulvysek = floor($vysek / 2);
          settype($pulvysek, "integer");

          if ($strana != 1) //prev page, kdyz neni prvni
          {
            $prev = $strana - 1;
            $jdi .= $this->NactiUnikatniObsah($this->unikatni["normal_cuting_prev_{$tvar}"],
                                              "{$this->absolutni_url}{$adresa}{$prev}",
                                              "{$this->absolutni_url}{$adresa}1");
          }

          $outtyp = 0;
          if ($strana < $vysek) //prepnuti zacatek, prvnich N
          {
            $outtyp = 1;
          }

          if ($strana > ($pocetstran - $vysek + 1)) //prepnuti na konec, poslednich N
          {
            $outtyp = 2;
          }

          $dot = $this->unikatni["normal_cuting_dot_{$tvar}"];

          $pred = "";
          $za = "";
          switch ($outtyp)
          {
            case 1: //zacatek
              for ($i = 0; $i < $vysek; $i++)
              {
                $poc = $i + 1;
                if ($poc == $strana)
                {
                  $pole_stran[] = $this->NactiUnikatniObsah($this->unikatni["normal_cuting_current_{$tvar}"],
                                                            $poc);
                }
                  else
                {
                  $pole_stran[] = $this->NactiUnikatniObsah($this->unikatni["normal_cuting_page_{$tvar}"],
                                                            "{$this->absolutni_url}{$adresa}{$poc}",
                                                            $poc);
                }
              }

              $za = $dot;
            break;

            default:  //prostredek
            case 0:
              $pred = $dot;

              for ($i = ($strana - $pulvysek); $i <= ($strana + $pulvysek); $i++)
              {
                if ($i == $strana)
                {
                  $pole_stran[] = $this->NactiUnikatniObsah($this->unikatni["normal_cuting_current_{$tvar}"],
                                                            $i);
                }
                  else
                {
                  $pole_stran[] = $this->NactiUnikatniObsah($this->unikatni["normal_cuting_page_{$tvar}"],
                                                            "{$this->absolutni_url}{$adresa}{$i}",
                                                            $i);
                }
              }

              $za = $dot;
            break;

            case 2: //konec
              $pred = $this->unikatni["normal_cuting_dot_{$tvar}"];

              for ($i = ($pocetstran - $vysek); $i < $pocetstran; $i++)
              {
                $poc = $i + 1;
                if ($poc == $strana)
                {
                  $pole_stran[] = $this->NactiUnikatniObsah($this->unikatni["normal_cuting_current_{$tvar}"],
                                                            $poc);
                }
                  else
                {
                  $pole_stran[] = $this->NactiUnikatniObsah($this->unikatni["normal_cuting_page_{$tvar}"],
                                                            "{$this->absolutni_url}{$adresa}{$poc}",
                                                            $poc);
                }
              }
            break;
          }

          //pridani obsahu pred
          $jdi .= $pred;

          //slouceni pole stran
          $jdi .= implode($this->unikatni["normal_cuting_sep_{$tvar}"], $pole_stran);

          //pridani obsahu za
          $jdi .= $za;

          if ($strana != $pocetstran) //next page, kdyz neni posledni
          {
            $next = $strana + 1;
            $jdi .= $this->NactiUnikatniObsah($this->unikatni["normal_cuting_next_{$tvar}"],
                                              "{$this->absolutni_url}{$adresa}{$next}",
                                              "{$this->absolutni_url}{$adresa}{$pocetstran}");
          }
        }
      break;


      case "selpage": //vyber stranky << --select-- >> (na onchange)
        if ($pocetstran > 0)
        {
          if ($strana != 1) //prev page, kdyz neni prvni
          {
            $prev = $strana - 1;
            $jdi .= $this->NactiUnikatniObsah($this->unikatni["normal_selpage_prev_{$tvar}"],
                                              "{$this->absolutni_url}{$adresa}{$prev}",
                                              "{$this->absolutni_url}{$adresa}1");
          }

          $jdi .= $this->NactiUnikatniObsah($this->unikatni["normal_selpage_select_begin_{$tvar}"],
                                            "{$this->absolutni_url}{$adresa}");

          for ($i = 0; $i < $pocetstran; $i++)
          {
            $poc = $i + 1;
            $jdi .= $this->NactiUnikatniObsah($this->unikatni["normal_selpage_select_{$tvar}"],
                                              ($poc == $strana ? " selected=\"selected\"" : ""),
                                              $poc);

          }

          $jdi .= $this->unikatni["normal_selpage_select_end_{$tvar}"];

          if ($strana != $pocetstran) //next page, kdyz neni posledni
          {
            $next = $strana + 1;
            $jdi .= $this->NactiUnikatniObsah($this->unikatni["normal_selpage_next_{$tvar}"],
                                              "{$this->absolutni_url}{$adresa}{$next}",
                                              "{$this->absolutni_url}{$adresa}{$pocetstran}");
          }
        }
      break;


      case "center":  //drzi centrovane cislo: << 1, 2, 3, 4, 5, 6, 7, 8, 9 >>
        if ($pocetstran > 0)
        {
          if ($strana != 1) //prev page, kdyz neni prvni
          {
            $prev = $strana - 1;
            $jdi .= $this->NactiUnikatniObsah($this->unikatni["normal_center_prev_{$tvar}"],
                                              "{$this->absolutni_url}{$adresa}{$prev}",
                                              "{$this->absolutni_url}{$adresa}1");
          }

          //vypocet stredu
          $pocet = $this->unikatni["normal_center_count_{$tvar}"];
          $pulka = floor($pocet / 2);
          settype($pulka, "integer");

          $min_plus = 0;
          if ($strana <= $pulka)
          {
            $min = 0;
            $min_plus = ($pocet <= $pocetstran ? $pocet - ($pulka + $strana) : 0);  //korekce pro max
          }
            else
          {
            $min = ($strana - $pulka - 1);
          }

          $max_plus = 0;
          if ($strana > ($pocetstran - $pulka))
          {
            $max = $pocetstran;//($pocet <= $pocetstran ? $pocetstran : );
            $max_plus = ($pocet <= $pocetstran ? ($pulka + $strana) - $pocetstran : 0); //korekce pro min
          }
            else
          {
            $max = ($strana + $pulka);
          }

          for ($i = ($min - $max_plus); $i < ($max + $min_plus); $i++)
          {
            $poc = $i + 1;
            if ($poc == $strana)
            {
              $pole_stran[] = $this->NactiUnikatniObsah($this->unikatni["normal_center_current_{$tvar}"],
                                                        $poc);
            }
              else
            {
              $pole_stran[] = $this->NactiUnikatniObsah($this->unikatni["normal_center_page_{$tvar}"],
                                                        "{$this->absolutni_url}{$adresa}{$poc}",
                                                        $poc);
            }
          }

          $jdi .= implode($this->unikatni["normal_center_sep_{$tvar}"], $pole_stran);

          if ($strana != $pocetstran) //next page, kdyz neni posledni
          {
            $next = $strana + 1;
            $jdi .= $this->NactiUnikatniObsah($this->unikatni["normal_center_next_{$tvar}"],
                                              "{$this->absolutni_url}{$adresa}{$next}",
                                              "{$this->absolutni_url}{$adresa}{$pocetstran}");
          }
        }
      break;


      case "paginate":  //jquery strankovani: http://tympanus.net/jPaginate/
        $jdi .= $this->NactiUnikatniObsah($this->unikatni["normal_paginate_{$tvar}"],
                                          $this->absolutni_url,
                                          $this->dirpath,
                                          $strana,
                                          $pocetstran,
                                          $adresa);
      break;


      case "text":  //textovy vypis stran: #1 #2 #3 ...
        if ($pocetstran > 0)
        {
          for ($i = 0; $i < $pocetstran; $i++)
          {
            $poc = $i + 1;
            $pole_stran[] = $this->NactiUnikatniObsah($this->unikatni["normal_text_{$tvar}"],
                                              $poc);
          }

          $jdi .= implode($this->unikatni["normal_text_sep_{$tvar}"], $pole_stran);
        }
      break;
    }

    $result[0] = $this->NactiUnikatniObsah($this->unikatni["normal_strankovani_{$tvar}"],
                                          $jdi,
                                          $strana,
                                          ($pocetstran == 0 ? 1 : $pocetstran));

    //vystupni typ pro sql dotaz nebo rozsah pole
    $num_od = ($strana - 1) * $na_stranku;
    switch ($typ)
    {
      default:
      case "limit":
        $od = $num_od;
        $result[1] = "LIMIT {$od}, {$na_stranku}"; //dodatecny dotaz do DB
      break;

      case "array":
        $result[1] = array($num_od,
                          $num_od + $na_stranku - 1);
      break;
    }

    return $result;
  }


}
?>
