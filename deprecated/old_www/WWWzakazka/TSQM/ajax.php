<?php
include_once "login.php";
include_once "funkce.php";
include_once "funkce_promenne.php";

class Ajax
{
  public $var, $cislo, $box;
//******************************************************************************
  function __construct()
  {
    $this->var = new Promenne();
    $this->var->login = new Login();
    $this->var->main = new HlavniFunkce($this->var);
    $this->var->main->VolbaJazyka();

    if ($this->var->main->OtevriMySQLi())
    {
      //echo $this->AjaxMenu();
      $this->var->main->ZavriMySQLi();
    }
  }
//******************************************************************************
/*
  function AjaxMenu()
  {
    $this->cislo = $_GET["cislo"];  //cislo prava
    $this->box = $_GET["box"];  //cislo boxu

    if ($res = @$this->var->mysqli->query("SELECT idpristup as id
                                          FROM prava_ma_pristup WHERE
                                          idprava={$this->cislo};"))
    {
      while($data = $res->fetch_object()) //nacitaci algoritmus
      {
        $pole[$data->id] = true;
      }

      if (!Empty($this->box)) //uprava v DB
      {
        if (!Empty($pole))
        {
          if (array_key_exists($this->box, $pole))
          {
            $this->var->mysqli->multi_query("DELETE FROM prava_ma_pristup WHERE idprava={$this->cislo} AND idpristup={$this->box};");  //smaze 1 prstup
          }
            else
          {
            $this->var->mysqli->multi_query("INSERT INTO prava_ma_pristup (id, idprava, idpristup) VALUES(NULL, {$this->cislo}, {$this->box});");  //prida 1 pristup
          }
        }
          else
        {
          $this->var->mysqli->multi_query("INSERT INTO prava_ma_pristup (id, idprava, idpristup) VALUES(NULL, {$this->cislo}, {$this->box});");  //prida 1 pristup
        }
        $result = "upraveno: {$this->box}";
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
    }

    return $result;
  }


//    $this->akce = $_GET["akce"];  //nazev akce
//    $this->cismen = $_GET["cismen"];  //cislo menu
//    $this->men = $_GET["men"];  //menu true/false
//    $this->cissub = $_GET["cissub"];  //cislo submenu
//    $this->sub = $_GET["sub"];  //submenu true/false
    $menu = array(array($this->var->pristup["uvod"][""], "uvod"), //menu
                  array($this->var->pristup["zamestnanci"][""], "zamestnanci"),
                  array($this->var->pristup["partneri"][""], "partneri"),
                  array($this->var->pristup["zakaznici"][""], "zakaznici"),
                  array($this->var->pristup["management"][""], "management"),
                  array($this->var->pristup["procesy"][""], "procesy"),
                  array($this->var->pristup["terminy"][""], "terminy"),
                  array($this->var->pristup["archiv"][""], "archiv"),
                  array($this->var->pristup["admin"][""], "admin"),
                  );

    $submenu = array(1 => array(array($this->var->pristup["zamestnanci"]["all"], "all_zamestnanec"),  //submenu
                                array($this->var->pristup["zamestnanci"]["info"], "info"),
                                array($this->var->pristup["zamestnanci"]["add"], "add_zamestnanec"),
                                array($this->var->pristup["zamestnanci"]["edit"], "edit_zamestnanec"),
                                array($this->var->pristup["zamestnanci"]["del"], "del_zamestnanec"),
                                array($this->var->pristup["zamestnanci"]["search"], "search_zamestnanec"),
                                array($this->var->pristup["zamestnanci"]["kompetence"], "kompetence_zamestnanec"),
                                array($this->var->pristup["zamestnanci"]["foto"], "fotografie_zamestnanec"),
                                array($this->var->pristup["zamestnanci"]["doba"], "doba_zamestnanec"),
                                array($this->var->pristup["zamestnanci"]["terminy"], "terminy_zamestnanec"),
                                array($this->var->pristup["zamestnanci"]["statistika"], "statistika_zamestnanec"),
                                array($this->var->pristup["zamestnanci"]["naklady"], "naklady_zamestnanec"),
                                array($this->var->pristup["zamestnanci"]["prava"], "prava_zamestnanec"),
                                array($this->var->pristup["zamestnanci"]["protokoly"], "protokoly_zamestnanec")),

                          array(array($this->var->pristup["partneri"]["all"], "all_partner"),
                                array($this->var->pristup["partneri"]["info"], "info"),
                                array($this->var->pristup["partneri"]["add"], "add_partner"),
                                array($this->var->pristup["partneri"]["edit"], "edit_partner"),
                                array($this->var->pristup["partneri"]["del"], "del_partner"),
                                array($this->var->pristup["partneri"]["search"], "search_partner")),

                          array(array($this->var->pristup["zakaznici"]["all"], "all_zakaznik"),
                                array($this->var->pristup["zakaznici"]["info"], "info"),
                                array($this->var->pristup["zakaznici"]["add"], "add_zakaznik"),
                                array($this->var->pristup["zakaznici"]["edit"], "edit_zakaznik"),
                                array($this->var->pristup["zakaznici"]["del"], "del_zakaznik"),
                                array($this->var->pristup["zakaznici"]["search"], "search_zakaznik")),
                     );

    $subsubmenu = array(1 => array(1 => array(array($this->var->pristup["izam"]["log"], "zam_log"), //sub sub menu
                                              array($this->var->pristup["izam"]["hes"], "zam_hes"),
                                              array($this->var->pristup["izam"]["jme"], "zam_jmeno"),
                                              array($this->var->pristup["izam"]["pri"], "zam_prim"),
                                              array($this->var->pristup["izam"]["pra"], "zam_prava"),
                                              array($this->var->pristup["izam"]["uli"], "zam_ulice"),
                                              array($this->var->pristup["izam"]["cp"], "zam_cp"),
                                              array($this->var->pristup["izam"]["psc"], "zam_psc"),
                                              array($this->var->pristup["izam"]["mes"], "zam_mesto"),
                                              array($this->var->pristup["izam"]["zem"], "zam_zeme"),
                                              array($this->var->pristup["izam"]["te1"], "zam_tel1"),
                                              array($this->var->pristup["izam"]["te2"], "zam_tel2"),
                                              array($this->var->pristup["izam"]["ema"], "zam_email"),
                                              array($this->var->pristup["izam"]["dna"], "zam_datnar"),
                                              array($this->var->pristup["izam"]["jaz"], "zam_jazyk"),
                                              array($this->var->pristup["izam"]["vzd"], "zam_vzdelani"),
                                              array($this->var->pristup["izam"]["rid"], "zam_ridicak"),
                                              array($this->var->pristup["izam"]["poh"], "zam_pohlavi"),
                                              array($this->var->pristup["izam"]["dos"], "zam_datosloveni"),
                                              array($this->var->pristup["izam"]["dzi"], "zam_datzivot"),
                                              array($this->var->pristup["izam"]["dpo"], "zam_datpoh"),
                                              array($this->var->pristup["izam"]["dza"], "zam_datzac"),
                                              array($this->var->pristup["izam"]["dod"], "zam_datodmit"),
                                              array($this->var->pristup["izam"]["dko"], "zam_konprac"),
                                              array($this->var->pristup["izam"]["sta"], "zam_status"),
                                              array($this->var->pristup["izam"]["exi"], "zam_existfoto"),
                                              array($this->var->pristup["izam"]["hob"], "zam_hobby"),
                                              array($this->var->pristup["izam"]["spo"], "zam_sport"),
                                              array($this->var->pristup["izam"]["rod"], "zam_rodiste"),
                                              array($this->var->pristup["izam"]["mze"], "zam_zemenaroz"),
                                              array($this->var->pristup["izam"]["mja"], "zam_matjazyk"),
                                              array($this->var->pristup["izam"]["jot"], "zam_jmotce"),
                                              array($this->var->pristup["izam"]["pro"], "zam_prijotce"),
                                              array($this->var->pristup["izam"]["pot"], "zam_povotce"),
                                              array($this->var->pristup["izam"]["jma"], "zam_jmmatky"),
                                              array($this->var->pristup["izam"]["prm"], "zam_prijmatky"),
                                              array($this->var->pristup["izam"]["pma"], "zam_povmatky"),
                                              array($this->var->pristup["izam"]["pob"], "zam_pocbrat"),
                                              array($this->var->pristup["izam"]["pos"], "zam_pocsest"),
                                              array($this->var->pristup["izam"]["sso"], "zam_sumsour"),
                                              array($this->var->pristup["izam"]["mat"], "zam_mat"),
                                              array($this->var->pristup["izam"]["str"], "zam_stredni"),
                                              array($this->var->pristup["izam"]["tst"], "zam_typstredni"),
                                              array($this->var->pristup["izam"]["vys"], "zam_vyska"),
                                              array($this->var->pristup["izam"]["tvy"], "zam_typvyska"),
                                              array($this->var->pristup["izam"]["obo"], "zam_obor"),
                                              array($this->var->pristup["izam"]["tyt"], "zam_tytul")),

                                        array(array($this->var->pristup["azam"]["log"], "zam_log"),
                                              array($this->var->pristup["azam"]["hes"], "zam_hes"),
                                              array($this->var->pristup["azam"]["hre"], "zam_hesrep"),
                                              array($this->var->pristup["azam"]["jme"], "zam_jmeno"),
                                              array($this->var->pristup["azam"]["pri"], "zam_prim"),
                                              array($this->var->pristup["azam"]["pra"], "zam_prava"),
                                              array($this->var->pristup["azam"]["uli"], "zam_ulice"),
                                              array($this->var->pristup["azam"]["cp"], "zam_cp"),
                                              array($this->var->pristup["azam"]["psc"], "zam_psc"),
                                              array($this->var->pristup["azam"]["mes"], "zam_mesto"),
                                              array($this->var->pristup["azam"]["zem"], "zam_zeme"),
                                              array($this->var->pristup["azam"]["te1"], "zam_tel1"),
                                              array($this->var->pristup["azam"]["te2"], "zam_tel2"),
                                              array($this->var->pristup["azam"]["ema"], "zam_email"),
                                              array($this->var->pristup["azam"]["dna"], "zam_datnar"),
                                              array($this->var->pristup["azam"]["jaz"], "zam_jazyk"),
                                              array($this->var->pristup["azam"]["vzd"], "zam_vzdelani"),
                                              array($this->var->pristup["azam"]["rid"], "zam_ridicak"),
                                              array($this->var->pristup["azam"]["poh"], "zam_pohlavi"),
                                              array($this->var->pristup["azam"]["dos"], "zam_datosloveni"),
                                              array($this->var->pristup["azam"]["dzi"], "zam_datzivot"),
                                              array($this->var->pristup["azam"]["dpo"], "zam_datpoh"),
                                              array($this->var->pristup["azam"]["dza"], "zam_datzac"),
                                              array($this->var->pristup["azam"]["dod"], "zam_datodmit"),
                                              array($this->var->pristup["azam"]["dko"], "zam_konprac"),
                                              array($this->var->pristup["azam"]["sta"], "zam_status"),
                                              array($this->var->pristup["azam"]["exi"], "zam_existfoto"),
                                              array($this->var->pristup["azam"]["hob"], "zam_hobby"),
                                              array($this->var->pristup["azam"]["spo"], "zam_sport"),
                                              array($this->var->pristup["azam"]["rod"], "zam_rodiste"),
                                              array($this->var->pristup["azam"]["mze"], "zam_zemenaroz"),
                                              array($this->var->pristup["azam"]["mja"], "zam_matjazyk"),
                                              array($this->var->pristup["azam"]["jot"], "zam_jmotce"),
                                              array($this->var->pristup["azam"]["pro"], "zam_prijotce"),
                                              array($this->var->pristup["azam"]["pot"], "zam_povotce"),
                                              array($this->var->pristup["azam"]["jma"], "zam_jmmatky"),
                                              array($this->var->pristup["azam"]["prm"], "zam_prijmatky"),
                                              array($this->var->pristup["azam"]["pma"], "zam_povmatky"),
                                              array($this->var->pristup["azam"]["pob"], "zam_pocbrat"),
                                              array($this->var->pristup["azam"]["pos"], "zam_pocsest"),
                                              array($this->var->pristup["azam"]["sso"], "zam_sumsour"),
                                              array($this->var->pristup["azam"]["mat"], "zam_mat"),
                                              array($this->var->pristup["azam"]["str"], "zam_stredni"),
                                              array($this->var->pristup["azam"]["tst"], "zam_typstredni"),
                                              array($this->var->pristup["azam"]["vys"], "zam_vyska"),
                                              array($this->var->pristup["azam"]["tvy"], "zam_typvyska"),
                                              array($this->var->pristup["azam"]["obo"], "zam_obor"),
                                              array($this->var->pristup["azam"]["tyt"], "zam_tytul")),

                                        array(array($this->var->pristup["ezam"]["log"], "zam_log"),
                                              array($this->var->pristup["ezam"]["hes"], "zam_hes"),
                                              array($this->var->pristup["ezam"]["hre"], "zam_hesrep"),
                                              array($this->var->pristup["ezam"]["jme"], "zam_jmeno"),
                                              array($this->var->pristup["ezam"]["pri"], "zam_prim"),
                                              array($this->var->pristup["ezam"]["pra"], "zam_prava"),
                                              array($this->var->pristup["ezam"]["uli"], "zam_ulice"),
                                              array($this->var->pristup["ezam"]["cp"], "zam_cp"),
                                              array($this->var->pristup["ezam"]["psc"], "zam_psc"),
                                              array($this->var->pristup["ezam"]["mes"], "zam_mesto"),
                                              array($this->var->pristup["ezam"]["zem"], "zam_zeme"),
                                              array($this->var->pristup["ezam"]["te1"], "zam_tel1"),
                                              array($this->var->pristup["ezam"]["te2"], "zam_tel2"),
                                              array($this->var->pristup["ezam"]["ema"], "zam_email"),
                                              array($this->var->pristup["ezam"]["dna"], "zam_datnar"),
                                              array($this->var->pristup["ezam"]["jaz"], "zam_jazyk"),
                                              array($this->var->pristup["ezam"]["vzd"], "zam_vzdelani"),
                                              array($this->var->pristup["ezam"]["rid"], "zam_ridicak"),
                                              array($this->var->pristup["ezam"]["poh"], "zam_pohlavi"),
                                              array($this->var->pristup["ezam"]["dos"], "zam_datosloveni"),
                                              array($this->var->pristup["ezam"]["dzi"], "zam_datzivot"),
                                              array($this->var->pristup["ezam"]["dpo"], "zam_datpoh"),
                                              array($this->var->pristup["ezam"]["dza"], "zam_datzac"),
                                              array($this->var->pristup["ezam"]["dod"], "zam_datodmit"),
                                              array($this->var->pristup["ezam"]["dko"], "zam_konprac"),
                                              array($this->var->pristup["ezam"]["sta"], "zam_status"),
                                              array($this->var->pristup["ezam"]["exi"], "zam_existfoto"),
                                              array($this->var->pristup["ezam"]["hob"], "zam_hobby"),
                                              array($this->var->pristup["ezam"]["spo"], "zam_sport"),
                                              array($this->var->pristup["ezam"]["rod"], "zam_rodiste"),
                                              array($this->var->pristup["ezam"]["mze"], "zam_zemenaroz"),
                                              array($this->var->pristup["ezam"]["mja"], "zam_matjazyk"),
                                              array($this->var->pristup["ezam"]["jot"], "zam_jmotce"),
                                              array($this->var->pristup["ezam"]["pro"], "zam_prijotce"),
                                              array($this->var->pristup["ezam"]["pot"], "zam_povotce"),
                                              array($this->var->pristup["ezam"]["jma"], "zam_jmmatky"),
                                              array($this->var->pristup["ezam"]["prm"], "zam_prijmatky"),
                                              array($this->var->pristup["ezam"]["pma"], "zam_povmatky"),
                                              array($this->var->pristup["ezam"]["pob"], "zam_pocbrat"),
                                              array($this->var->pristup["ezam"]["pos"], "zam_pocsest"),
                                              array($this->var->pristup["ezam"]["sso"], "zam_sumsour"),
                                              array($this->var->pristup["ezam"]["mat"], "zam_mat"),
                                              array($this->var->pristup["ezam"]["str"], "zam_stredni"),
                                              array($this->var->pristup["ezam"]["tst"], "zam_typstredni"),
                                              array($this->var->pristup["ezam"]["vys"], "zam_vyska"),
                                              array($this->var->pristup["ezam"]["tvy"], "zam_typvyska"),
                                              array($this->var->pristup["ezam"]["obo"], "zam_obor"),
                                              array($this->var->pristup["ezam"]["tyt"], "zam_tytul")),
                                   ),

                             array(1 => array(array($this->var->pristup["ipar"]["naz"], "par_nazev"),
                                              array($this->var->pristup["ipar"]["kon"], "par_kontakt"),
                                              array($this->var->pristup["ipar"]["jme"], "par_jmeno"),
                                              array($this->var->pristup["ipar"]["pri"], "par_prijmeni"),
                                              array($this->var->pristup["ipar"]["uli"], "par_ulice"),
                                              array($this->var->pristup["ipar"]["cp"], "par_cp"),
                                              array($this->var->pristup["ipar"]["psc"], "par_psc"),
                                              array($this->var->pristup["ipar"]["mes"], "par_mesto"),
                                              array($this->var->pristup["ipar"]["zem"], "par_zeme"),
                                              array($this->var->pristup["ipar"]["te1"], "par_tel"),
                                              array($this->var->pristup["ipar"]["te2"], "par_tel1"),
                                              array($this->var->pristup["ipar"]["ema"], "par_email"),
                                              array($this->var->pristup["ipar"]["jaz"], "par_jazyk"),
                                              array($this->var->pristup["ipar"]["poh"], "par_pohlavi"),
                                              array($this->var->pristup["ipar"]["dos"], "par_datumosloveni"),
                                              array($this->var->pristup["ipar"]["dka"], "par_datumkalkulace"),
                                              array($this->var->pristup["ipar"]["dpo"], "par_datumpohovoru"),
                                              array($this->var->pristup["ipar"]["dza"], "par_datumzacatek"),
                                              array($this->var->pristup["ipar"]["dod"], "par_datumodmitnuti"),
                                              array($this->var->pristup["ipar"]["dko"], "par_datumkonec"),
                                              array($this->var->pristup["ipar"]["sta"], "par_status"),
                                              array($this->var->pristup["ipar"]["csp"], "par_celkovaspokojenost"),
                                              array($this->var->pristup["ipar"]["kom"], "par_komentar"),
                                              array($this->var->pristup["ipar"]["exi"], "par_existfoto"),
                                              array($this->var->pristup["ipar"]["pra"], "par_pratelsky"),
                                              array($this->var->pristup["ipar"]["pre"], "par_presnost"),
                                              array($this->var->pristup["ipar"]["kpt"], "par_kompetence"),
                                              array($this->var->pristup["ipar"]["kmk"], "par_komunikace"),
                                              array($this->var->pristup["ipar"]["vys"], "par_vystupovani"),
                                              array($this->var->pristup["ipar"]["ido"], "par_infodostatek"),
                                              array($this->var->pristup["ipar"]["isr"], "par_infosruzumitelne"),
                                              array($this->var->pristup["ipar"]["ius"], "par_infoustnisrozumitelne"),
                                              array($this->var->pristup["ipar"]["iho"], "par_infohodnoceni"),
                                              array($this->var->pristup["ipar"]["tka"], "par_terminkalkulace"),
                                              array($this->var->pristup["ipar"]["tdo"], "par_termindodani"),
                                              array($this->var->pristup["ipar"]["roz"], "par_rozpocet"),
                                              array($this->var->pristup["ipar"]["odc"], "par_odchylka"),
                                              array($this->var->pristup["ipar"]["spo"], "par_spokojenost")),

                                        array(array($this->var->pristup["apar"]["naz"], "par_nazev"),
                                              array($this->var->pristup["apar"]["kon"], "par_kontakt"),
                                              array($this->var->pristup["apar"]["jme"], "par_jmeno"),
                                              array($this->var->pristup["apar"]["pri"], "par_prijmeni"),
                                              array($this->var->pristup["apar"]["uli"], "par_ulice"),
                                              array($this->var->pristup["apar"]["cp"], "par_cp"),
                                              array($this->var->pristup["apar"]["psc"], "par_psc"),
                                              array($this->var->pristup["apar"]["mes"], "par_mesto"),
                                              array($this->var->pristup["apar"]["zem"], "par_zeme"),
                                              array($this->var->pristup["apar"]["te1"], "par_tel"),
                                              array($this->var->pristup["apar"]["te2"], "par_tel1"),
                                              array($this->var->pristup["apar"]["ema"], "par_email"),
                                              array($this->var->pristup["apar"]["jaz"], "par_jazyk"),
                                              array($this->var->pristup["apar"]["poh"], "par_pohlavi"),
                                              array($this->var->pristup["apar"]["dos"], "par_datumosloveni"),
                                              array($this->var->pristup["apar"]["dka"], "par_datumkalkulace"),
                                              array($this->var->pristup["apar"]["dpo"], "par_datumpohovoru"),
                                              array($this->var->pristup["apar"]["dza"], "par_datumzacatek"),
                                              array($this->var->pristup["apar"]["dod"], "par_datumodmitnuti"),
                                              array($this->var->pristup["apar"]["dko"], "par_datumkonec"),
                                              array($this->var->pristup["apar"]["sta"], "par_status"),
                                              array($this->var->pristup["apar"]["csp"], "par_celkovaspokojenost"),
                                              array($this->var->pristup["apar"]["kom"], "par_komentar"),
                                              array($this->var->pristup["apar"]["exi"], "par_existfoto"),
                                              array($this->var->pristup["apar"]["pra"], "par_pratelsky"),
                                              array($this->var->pristup["apar"]["pre"], "par_presnost"),
                                              array($this->var->pristup["apar"]["kpt"], "par_kompetence"),
                                              array($this->var->pristup["apar"]["kmk"], "par_komunikace"),
                                              array($this->var->pristup["apar"]["vys"], "par_vystupovani"),
                                              array($this->var->pristup["apar"]["ido"], "par_infodostatek"),
                                              array($this->var->pristup["apar"]["isr"], "par_infosruzumitelne"),
                                              array($this->var->pristup["apar"]["ius"], "par_infoustnisrozumitelne"),
                                              array($this->var->pristup["apar"]["iho"], "par_infohodnoceni"),
                                              array($this->var->pristup["apar"]["tka"], "par_terminkalkulace"),
                                              array($this->var->pristup["apar"]["tdo"], "par_termindodani"),
                                              array($this->var->pristup["apar"]["roz"], "par_rozpocet"),
                                              array($this->var->pristup["apar"]["odc"], "par_odchylka"),
                                              array($this->var->pristup["apar"]["spo"], "par_spokojenost")),

                                        array(array($this->var->pristup["epar"]["naz"], "par_nazev"),
                                              array($this->var->pristup["epar"]["kon"], "par_kontakt"),
                                              array($this->var->pristup["epar"]["jme"], "par_jmeno"),
                                              array($this->var->pristup["epar"]["pri"], "par_prijmeni"),
                                              array($this->var->pristup["epar"]["uli"], "par_ulice"),
                                              array($this->var->pristup["epar"]["cp"], "par_cp"),
                                              array($this->var->pristup["epar"]["psc"], "par_psc"),
                                              array($this->var->pristup["epar"]["mes"], "par_mesto"),
                                              array($this->var->pristup["epar"]["zem"], "par_zeme"),
                                              array($this->var->pristup["epar"]["te1"], "par_tel"),
                                              array($this->var->pristup["epar"]["te2"], "par_tel1"),
                                              array($this->var->pristup["epar"]["ema"], "par_email"),
                                              array($this->var->pristup["epar"]["jaz"], "par_jazyk"),
                                              array($this->var->pristup["epar"]["poh"], "par_pohlavi"),
                                              array($this->var->pristup["epar"]["dos"], "par_datumosloveni"),
                                              array($this->var->pristup["epar"]["dka"], "par_datumkalkulace"),
                                              array($this->var->pristup["epar"]["dpo"], "par_datumpohovoru"),
                                              array($this->var->pristup["epar"]["dza"], "par_datumzacatek"),
                                              array($this->var->pristup["epar"]["dod"], "par_datumodmitnuti"),
                                              array($this->var->pristup["epar"]["dko"], "par_datumkonec"),
                                              array($this->var->pristup["epar"]["sta"], "par_status"),
                                              array($this->var->pristup["epar"]["csp"], "par_celkovaspokojenost"),
                                              array($this->var->pristup["epar"]["kom"], "par_komentar"),
                                              array($this->var->pristup["epar"]["exi"], "par_existfoto"),
                                              array($this->var->pristup["epar"]["pra"], "par_pratelsky"),
                                              array($this->var->pristup["epar"]["pre"], "par_presnost"),
                                              array($this->var->pristup["epar"]["kpt"], "par_kompetence"),
                                              array($this->var->pristup["epar"]["kmk"], "par_komunikace"),
                                              array($this->var->pristup["epar"]["vys"], "par_vystupovani"),
                                              array($this->var->pristup["epar"]["ido"], "par_infodostatek"),
                                              array($this->var->pristup["epar"]["isr"], "par_infosruzumitelne"),
                                              array($this->var->pristup["epar"]["ius"], "par_infoustnisrozumitelne"),
                                              array($this->var->pristup["epar"]["iho"], "par_infohodnoceni"),
                                              array($this->var->pristup["epar"]["tka"], "par_terminkalkulace"),
                                              array($this->var->pristup["epar"]["tdo"], "par_termindodani"),
                                              array($this->var->pristup["epar"]["roz"], "par_rozpocet"),
                                              array($this->var->pristup["epar"]["odc"], "par_odchylka"),
                                              array($this->var->pristup["epar"]["spo"], "par_spokojenost")),
                                   ),
                        );
//asi neni dobrý nápad to cpat do ajaxu....!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

    if ($res = @$this->var->mysqli->query("SELECT prava.prava as pravo, prava_ma_pristup.idpristup as id
                                            FROM prava, prava_ma_pristup WHERE
                                            prava.id=prava_ma_pristup.idprava AND
                                            prava.id={$this->cislo};"))
    {
      while($data = $res->fetch_object()) //nacitaci algoritmus
      {
        $pole[$data->id] = true;
        $pravo = $data->pravo;
      }

      if ($this->akce == "click") //uprava v DB
      {
        if (!Empty($pole))
        {
          if (array_key_exists($this->box, $pole))
          {
            $this->var->mysqli->multi_query("DELETE FROM prava_ma_pristup WHERE idprava={$this->cislo} AND idpristup={$this->box};");  //smaze 1 prstup
          }
            else
          {
            $this->var->mysqli->multi_query("INSERT INTO prava_ma_pristup (id, idprava, idpristup) VALUES(NULL, {$this->cislo}, {$this->box});");  //prida 1 pristup
          }
        }
          else
        {
          $this->var->mysqli->multi_query("INSERT INTO prava_ma_pristup (id, idprava, idpristup) VALUES(NULL, {$this->cislo}, {$this->box});");  //prida 1 pristup
        }
      }

      if ($this->sub == "true") //sub sub menu
      {
        $subsub =
        "<ol>
        ";

        for($i = 0; $i < count($subsubmenu[$this->cismen][$this->cissub]); $i++)
        {
          $subsub .=
          "<li><input type=\"checkbox\" onclick=\"AjaxMenu({$this->cislo}, '{$this->cismen}', true, '{$this->cissub}', true, '{$subsubmenu[$this->cismen][$this->cissub][$i][0]}', 'click');\" ".($pole[$subsubmenu[$this->cismen][$this->cissub][$i][0]] ? "checked=\"checked\"" : "")." /> {$this->var->jazyk[$subsubmenu[$this->cismen][$this->cissub][$i][1]]}</li>
          ";  //onmouseout=\"AjaxMenu({$this->cislo}, '{$this->cismen}', true, '{$this->cissub}', true, '', '');\"
        }

        $subsub .=
        "</ol>
        ";
      }

      if ($this->men == "true") //sub menu
      {
        $sub =
        "<ol>
        ";

        for($i = 0; $i < count($submenu[$this->cismen]); $i++)
        {
          $sub .=
          "<li><input type=\"checkbox\" onclick=\"AjaxMenu({$this->cislo}, '{$this->cismen}', true, '', false, '{$submenu[$this->cismen][$i][0]}', 'click');\" onmouseout=\"AjaxMenu({$this->cislo}, '{$this->cismen}', true, '', false, '', '');\" ".($pole[$submenu[$this->cismen][$i][0]] ? "checked=\"checked\"" : "")." /> <a href=\"#\" onclick=\"AjaxMenu({$this->cislo}, '{$this->cismen}', true, '{$i}', true, '', '', '');\">{$this->var->jazyk[$submenu[$this->cismen][$i][1]]}</a>
          ".(($this->sub == "true") && $this->cissub == $i ? $subsub : "")."
          </li>
          ";
        }

        $sub .=
        "</ol>
        ";
      }

      $result =  //zacatek seznamu
      "upravuje se: $pravo ({$this->cislo})
      <ol>
      ";

      for($i = 0; $i < count($menu); $i++)
      {
        $result .=
        "<li><input type=\"checkbox\" onclick=\"AjaxMenu({$this->cislo}, '{$i}', false, '', false, {$menu[$i][0]}, 'click');\" onmouseout=\"AjaxMenu({$this->cislo}, '', false, '', false, '', '');\" ".($pole[$menu[$i][0]] ? "checked=\"checked\"" : "")." /> <a href=\"#\" onclick=\"AjaxMenu({$this->cislo}, '{$i}', true, '', false, '', '');\">{$this->var->jazyk[$menu[$i][1]]}</a>
        ".(($this->men == "true") && $this->cismen == $i ? $sub : "")."
        </li>
        ";
      }

      $result .= //konec seznamu
      "</ol>
      ";
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
    }

    return $result;
  }

<div id=\"ajax_menu\"></div>
//<span id=\"admin_ajax_menu\"></span>
*/
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
}

header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past

$web = new Ajax();
?>
