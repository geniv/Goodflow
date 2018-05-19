<?php
class Administrace
{
  public $var, $menu, $submenu, $subsubmenu, $pole;
//******************************************************************************
  function __construct(&$var)
  {
    $this->var = $var;

    $this->menu = array(array($this->var->pristup["uvod"][""], "uvod"), //menu
                        array($this->var->pristup["zamestnanci"][""], "zamestnanci"),
                        array($this->var->pristup["partneri"][""], "partneri"),
                        array($this->var->pristup["zakaznici"][""], "zakaznici"),
                        array($this->var->pristup["management"][""], "management"),
                        array($this->var->pristup["procesy"][""], "procesy"),
                        array($this->var->pristup["terminy"][""], "terminy"),
                        array($this->var->pristup["archiv"][""], "archiv"),
                        array($this->var->pristup["admin"][""], "admin"),
                        );

    $this->submenu = array(1 => array(array($this->var->pristup["zamestnanci"]["all"], "all_zamestnanec"),  //submenu
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
      //mezera
                           8 => array(array($this->var->pristup["admin"]["prava"], "pristup_admin"),
                                      array($this->var->pristup["admin"]["zamprava"], "prava_admin"),
                                      array($this->var->pristup["admin"]["zamzeme"], "zeme_admin"),
                                      array($this->var->pristup["admin"]["zamvzdela"], "vzde_admin"),
                                      array($this->var->pristup["admin"]["zamstatus"], "stat_admin"),
                                      array($this->var->pristup["admin"]["zamjazyk"], "jazyk_admin"),
                                      array($this->var->pristup["admin"]["zamhobby"], "hobby_admin"),
                                      array($this->var->pristup["admin"]["zamsport"], "sport_admin"),
                                      array($this->var->pristup["admin"]["zamvyska"], "vyska_admin"),
                                      array($this->var->pristup["admin"]["strankovani"], "stran_admin")),
                           );

    $this->subsubmenu = array(1 => array(1 => array(array($this->var->pristup["izam"]["log"], "zam_log"), //sub sub menu zamestnanci
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

                                   array(1 => array(array($this->var->pristup["ipar"]["naz"], "par_nazev"), //partneri
                                                    //array($this->var->pristup["ipar"]["kon"], "par_kontakt"),
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
                                                    //array($this->var->pristup["apar"]["kon"], "par_kontakt"),
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
                                                    //array($this->var->pristup["epar"]["kon"], "par_kontakt"),
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

                                   array(1 => array(array($this->var->pristup["izak"]["naz"], "zak_nazev"), //zakaznici
                                                    array($this->var->pristup["izak"]["jme"], "zak_jmeno"),
                                                    array($this->var->pristup["izak"]["pri"], "zak_prijmeni"),
                                                    array($this->var->pristup["izak"]["uli"], "zak_ulice"),
                                                    array($this->var->pristup["izak"]["cp"], "zak_cp"),
                                                    array($this->var->pristup["izak"]["psc"], "zak_psc"),
                                                    array($this->var->pristup["izak"]["mes"], "zak_mesto"),
                                                    array($this->var->pristup["izak"]["zem"], "zak_zeme"),
                                                    array($this->var->pristup["izak"]["te1"], "zak_tel"),
                                                    array($this->var->pristup["izak"]["te2"], "zak_tel1"),
                                                    array($this->var->pristup["izak"]["ema"], "zak_email"),
                                                    array($this->var->pristup["izak"]["jaz"], "zak_jazyk"),
                                                    array($this->var->pristup["izak"]["poh"], "zak_pohlavi"),
                                                    array($this->var->pristup["izak"]["dos"], "zak_datumosloveni"),
                                                    array($this->var->pristup["izak"]["dka"], "zak_datumkalkulace"),
                                                    array($this->var->pristup["izak"]["dpo"], "zak_datumpohovoru"),
                                                    array($this->var->pristup["izak"]["dza"], "zak_datumzacatek"),
                                                    array($this->var->pristup["izak"]["dod"], "zak_datumodmitnuti"),
                                                    array($this->var->pristup["izak"]["dko"], "zak_datumkonec"),
                                                    array($this->var->pristup["izak"]["sta"], "zak_status"),
                                                    array($this->var->pristup["izak"]["csp"], "zak_celkovaspokojenost"),
                                                    array($this->var->pristup["izak"]["kom"], "zak_komentar"),
                                                    array($this->var->pristup["izak"]["exi"], "zak_existfoto")),

                                              array(array($this->var->pristup["azak"]["naz"], "zak_nazev"),
                                                    array($this->var->pristup["azak"]["jme"], "zak_jmeno"),
                                                    array($this->var->pristup["azak"]["pri"], "zak_prijmeni"),
                                                    array($this->var->pristup["azak"]["uli"], "zak_ulice"),
                                                    array($this->var->pristup["azak"]["cp"], "zak_cp"),
                                                    array($this->var->pristup["azak"]["psc"], "zak_psc"),
                                                    array($this->var->pristup["azak"]["mes"], "zak_mesto"),
                                                    array($this->var->pristup["azak"]["zem"], "zak_zeme"),
                                                    array($this->var->pristup["azak"]["te1"], "zak_tel"),
                                                    array($this->var->pristup["azak"]["te2"], "zak_tel1"),
                                                    array($this->var->pristup["azak"]["ema"], "zak_email"),
                                                    array($this->var->pristup["azak"]["jaz"], "zak_jazyk"),
                                                    array($this->var->pristup["azak"]["poh"], "zak_pohlavi"),
                                                    array($this->var->pristup["azak"]["dos"], "zak_datumosloveni"),
                                                    array($this->var->pristup["azak"]["dka"], "zak_datumkalkulace"),
                                                    array($this->var->pristup["azak"]["dpo"], "zak_datumpohovoru"),
                                                    array($this->var->pristup["azak"]["dza"], "zak_datumzacatek"),
                                                    array($this->var->pristup["azak"]["dod"], "zak_datumodmitnuti"),
                                                    array($this->var->pristup["azak"]["dko"], "zak_datumkonec"),
                                                    array($this->var->pristup["azak"]["sta"], "zak_status"),
                                                    array($this->var->pristup["azak"]["csp"], "zak_celkovaspokojenost"),
                                                    array($this->var->pristup["azak"]["kom"], "zak_komentar"),
                                                    array($this->var->pristup["azak"]["exi"], "zak_existfoto")),

                                              array(array($this->var->pristup["ezak"]["naz"], "zak_nazev"),
                                                    array($this->var->pristup["ezak"]["jme"], "zak_jmeno"),
                                                    array($this->var->pristup["ezak"]["pri"], "zak_prijmeni"),
                                                    array($this->var->pristup["ezak"]["uli"], "zak_ulice"),
                                                    array($this->var->pristup["ezak"]["cp"], "zak_cp"),
                                                    array($this->var->pristup["ezak"]["psc"], "zak_psc"),
                                                    array($this->var->pristup["ezak"]["mes"], "zak_mesto"),
                                                    array($this->var->pristup["ezak"]["zem"], "zak_zeme"),
                                                    array($this->var->pristup["ezak"]["te1"], "zak_tel"),
                                                    array($this->var->pristup["ezak"]["te2"], "zak_tel1"),
                                                    array($this->var->pristup["ezak"]["ema"], "zak_email"),
                                                    array($this->var->pristup["ezak"]["jaz"], "zak_jazyk"),
                                                    array($this->var->pristup["ezak"]["poh"], "zak_pohlavi"),
                                                    array($this->var->pristup["ezak"]["dos"], "zak_datumosloveni"),
                                                    array($this->var->pristup["ezak"]["dka"], "zak_datumkalkulace"),
                                                    array($this->var->pristup["ezak"]["dpo"], "zak_datumpohovoru"),
                                                    array($this->var->pristup["ezak"]["dza"], "zak_datumzacatek"),
                                                    array($this->var->pristup["ezak"]["dod"], "zak_datumodmitnuti"),
                                                    array($this->var->pristup["ezak"]["dko"], "zak_datumkonec"),
                                                    array($this->var->pristup["ezak"]["sta"], "zak_status"),
                                                    array($this->var->pristup["ezak"]["csp"], "zak_celkovaspokojenost"),
                                                    array($this->var->pristup["ezak"]["kom"], "zak_komentar"),
                                                    array($this->var->pristup["ezak"]["exi"], "zak_existfoto")),
                                         ),
      /*
                                   array(1 => array(array($this->var->pristup["izak"]["naz"], "zak_nazev"), //zakaznici
                                                    array($this->var->pristup["izak"]["jme"], "zak_jmeno"),
                                                    array($this->var->pristup["izak"]["pri"], "zak_prijmeni"),
                                                    array($this->var->pristup["izak"]["uli"], "zak_ulice"),
                                                    array($this->var->pristup["izak"]["cp"], "zak_cp"),
                                                    array($this->var->pristup["izak"]["psc"], "zak_psc"),
                                                    array($this->var->pristup["izak"]["mes"], "zak_mesto"),
                                                    array($this->var->pristup["izak"]["zem"], "zak_zeme"),
                                                    array($this->var->pristup["izak"]["te1"], "zak_tel"),
                                                    array($this->var->pristup["izak"]["te2"], "zak_tel1"),
                                                    array($this->var->pristup["izak"]["ema"], "zak_email"),
                                                    array($this->var->pristup["izak"]["jaz"], "zak_jazyk"),
                                                    array($this->var->pristup["izak"]["poh"], "zak_pohlavi"),
                                                    array($this->var->pristup["izak"]["dos"], "zak_datumosloveni"),
                                                    array($this->var->pristup["izak"]["dka"], "zak_datumkalkulace"),
                                                    array($this->var->pristup["izak"]["dpo"], "zak_datumpohovoru"),
                                                    array($this->var->pristup["izak"]["dza"], "zak_datumzacatek"),
                                                    array($this->var->pristup["izak"]["dod"], "zak_datumodmitnuti"),
                                                    array($this->var->pristup["izak"]["dko"], "zak_datumkonec"),
                                                    array($this->var->pristup["izak"]["sta"], "zak_status"),
                                                    array($this->var->pristup["izak"]["csp"], "zak_celkovaspokojenost"),
                                                    array($this->var->pristup["izak"]["kom"], "zak_komentar"),
                                                    array($this->var->pristup["izak"]["exi"], "zak_existfoto")),
                                         ),*/
                              );
  }
//******************************************************************************
  function ZamestnanecEditDelPrava()  //výpis prav + edit, del
  {
    if ($res = @$this->var->mysqli->query("SELECT id, prava FROM prava ORDER BY prava ASC"))
    {
      if ($res->num_rows != 0)
      {
        $result = //výpis zemí
        "
<div class=\"menu_zakaznici_centralni_background central_menu_bok\">
  <span class=\"bokmenu_top\"></span>
    <div>
      <p class=\"text_polozka_central polozka_central_zahlavi\">{$this->var->jazyk["zam_prava"]}</p>
      <p class=\"text_akce_central_upravit upravit_v_zahlavi\">{$this->var->jazyk["edit"]}</p>
      <p class=\"text_akce_central_smazat smazat_v_zahlavi\">{$this->var->jazyk["del"]}</p>
          ";
        while ($data = $res->fetch_object())
        {
          $result .=
          "
      <p class=\"text_polozka_central\">$data->prava</p>
      <p class=\"text_akce_central_upravit\"><a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}&amp;co=edit&amp;cislo=$data->id\" title=\"{$this->var->jazyk["edit"]}\"></a></p>
      <p class=\"text_akce_central_smazat\">".($data->id == $this->var->superadmin ? $this->var->emptypol : "<a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}&amp;co=del&amp;cislo=$data->id\" title=\"{$this->var->jazyk["del"]}\"></a>")."</p>
          ";
        }
        $result .=
        "
    </div>
  <span class=\"bokmenu_bottom\"></span>
</div>
        ";
      }
        else
      {
        $result = $this->var->main->EmptyLine();
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
    }

    return $result;
  }
//******************************************************************************
  function ZamestnanecPridatPrava() //přidání přáv změstnance
  {
    $result .= include "{$this->var->form}/add_prava_zamestnanec.php";

    if (!Empty($_POST["addprava"]) &&
        !Empty($_POST["tlacitko"]))
    {
      $nazev = stripslashes(htmlspecialchars($_POST["addprava"]));
      if (@$this->var->mysqli->multi_query("INSERT INTO prava (id, prava) VALUES(NULL, '$nazev');"))
      {
        $result = include "{$this->var->form}/add_true.php";
        $this->var->main->AutoClick(1, "?action={$_GET["action"]}&akce={$_GET["akce"]}");  //auto kliknutí
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
      }
    }

    return $result;
  }
//******************************************************************************
  function ZamestnanecUpravitPrava()  //uprava prav zaměstance
  {
    $id = $_GET["cislo"];
    settype($id, "integer");

    if (!Empty($id) && $id != 0)
    {
      if ($res = @$this->var->mysqli->query("SELECT prava FROM prava WHERE id=$id"))
      {
        $data = $res->fetch_object();
        $result .= include "{$this->var->form}/edit_prava_zamestnanec.php";
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
      }
    }
    
    if (!Empty($_POST["editprava"]) &&
        !Empty($_POST["tlacitko"]) &&
        !Empty($id) &&
        $id != 0)
    {
      $nazev = stripslashes(htmlspecialchars($_POST["editprava"]));
      if (@$this->var->mysqli->multi_query("UPDATE prava SET prava='$nazev' WHERE id=$id;"))
      {
        $result = include "{$this->var->form}/edit_true.php";
        $this->var->main->AutoClick(1, "?action={$_GET["action"]}&akce={$_GET["akce"]}");  //auto kliknutí
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
      }
    }

    return $result;
  }
//******************************************************************************
  function ZamestnanecSmazatPrava() //smazaní prav zamestnance
  {
    $id = $_GET["cislo"];
    settype($id, "integer");

    if (!Empty($id) && $id != 0)
    {
      if ($res = @$this->var->mysqli->query("SELECT prava FROM prava WHERE id=$id"))
      {
        $data = $res->fetch_object();
        $result .= include "{$this->var->form}/del_prava_zamestnanec.php";
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
      }
    }

    if (!Empty($_POST["ano"]) &&
        !Empty($id) &&
        $id != 0)
    {
      $nazev = stripslashes(htmlspecialchars($_POST["delprava"]));
      if (@$this->var->mysqli->multi_query("DELETE FROM prava WHERE id=$id;"))
      {
        $result = include "{$this->var->form}/del_true.php";
        $this->var->main->AutoClick(1, "?action={$_GET["action"]}&akce={$_GET["akce"]}");  //auto kliknutí
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
      }
    }
      else
    {
      if (!Empty($_POST["ne"]))
      {
        $result = include "{$this->var->form}/del_false.php";
        $this->var->main->AutoClick(1, "?action={$_GET["action"]}&akce={$_GET["akce"]}");  //auto kliknutí
      }
    }

    return $result;
  }
//******************************************************************************
  function ZamestnanecEditDelZeme() //vypis zemi zamestance + edit, del
  {
    if ($res = @$this->var->mysqli->query("SELECT id, zeme FROM zeme ORDER BY zeme ASC"))
    {
      if ($res->num_rows != 0)//include "{$this->var->form}/add_true.php";
      {
        $result = //výpis zemí
        "
<div class=\"menu_zakaznici_centralni_background central_menu_bok\">
  <span class=\"bokmenu_top\"></span>
    <div>
      <p class=\"text_polozka_central polozka_central_zahlavi\">{$this->var->jazyk["zam_zeme"]}</p>
      <p class=\"text_akce_central_upravit upravit_v_zahlavi\">{$this->var->jazyk["edit"]}</p>
      <p class=\"text_akce_central_smazat smazat_v_zahlavi\">{$this->var->jazyk["del"]}</p>
          ";
        while ($data = $res->fetch_object())
        {
          $result .=
          "
      <p class=\"text_polozka_central\">$data->zeme</p>
      <p class=\"text_akce_central_upravit\"><a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}&amp;co=edit&amp;cislo=$data->id\" title=\"{$this->var->jazyk["edit"]}\"></a></p>
      <p class=\"text_akce_central_smazat\"><a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}&amp;co=del&amp;cislo=$data->id\" title=\"{$this->var->jazyk["del"]}\"></a></p>
          ";
        }
        $result .=
        "
    </div>
  <span class=\"bokmenu_bottom\"></span>
</div>
        ";
      }
        else
      {
        $result = $this->var->main->EmptyLine();
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
    }

    return $result;
  }
//******************************************************************************
  function ZamestnanecPridatZeme()  //pridat zemi zamestnance
  {
    $result .= include "{$this->var->form}/add_zeme_zamestnanec.php";

    if (!Empty($_POST["addzeme"]) &&
        !Empty($_POST["tlacitko"]))
    {
      $nazev = stripslashes(htmlspecialchars($_POST["addzeme"]));
      if (@$this->var->mysqli->multi_query("INSERT INTO zeme (id, zeme) VALUES(NULL, '$nazev');"))
      {
        $result = include "{$this->var->form}/add_true.php";
        $this->var->main->AutoClick(1, "?action={$_GET["action"]}&akce={$_GET["akce"]}");  //auto kliknutí
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
      }
    }

    return $result;
  }
//******************************************************************************
  function ZamestnanecUpravitZeme() //upravit zemi zamestnance
  {
    $id = $_GET["cislo"];
    settype($id, "integer");

    if (!Empty($id) && $id != 0)
    {
      if ($res = @$this->var->mysqli->query("SELECT zeme FROM zeme WHERE id=$id"))
      {
        $data = $res->fetch_object();
        $result .= include "{$this->var->form}/edit_zeme_zamestnanec.php";
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
      }
    }

    if (!Empty($_POST["editzeme"]) &&
        !Empty($_POST["tlacitko"]) &&
        !Empty($id) &&
        $id != 0)
    {
      $nazev = stripslashes(htmlspecialchars($_POST["editzeme"]));
      if (@$this->var->mysqli->multi_query("UPDATE zeme SET zeme='$nazev' WHERE id=$id;"))
      {
        $result = include "{$this->var->form}/edit_true.php";
        $this->var->main->AutoClick(1, "?action={$_GET["action"]}&akce={$_GET["akce"]}");  //auto kliknutí
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
      }
    }

    return $result;
  }
//******************************************************************************
  function ZamestnanecSmazatZeme()  //smazat zemi zamestnance
  {
    $id = $_GET["cislo"];
    settype($id, "integer");

    if (!Empty($id) && $id != 0)
    {
      if ($res = @$this->var->mysqli->query("SELECT zeme FROM zeme WHERE id=$id"))
      {
        $data = $res->fetch_object();
        $result .= include "{$this->var->form}/del_zeme_zamestnanec.php";
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
      }
    }

    if (!Empty($_POST["ano"]) &&
        !Empty($id) &&
        $id != 0)
    {
      $nazev = stripslashes(htmlspecialchars($_POST["delzeme"]));
      if (@$this->var->mysqli->multi_query("DELETE FROM zeme WHERE id=$id;"))
      {
        $result = include "{$this->var->form}/del_true.php";
        $this->var->main->AutoClick(1, "?action={$_GET["action"]}&akce={$_GET["akce"]}");  //auto kliknutí
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
      }
    }
      else
    {
      if (!Empty($_POST["ne"]))
      {
        $result = include "{$this->var->form}/del_false.php";
        $this->var->main->AutoClick(1, "?action={$_GET["action"]}&akce={$_GET["akce"]}");  //auto kliknutí
      }
    }

    return $result;
  }
//******************************************************************************
  function ZamestnanecEditDelVzdelani() //vypis zemi zamestance + edit, del
  {
    if ($res = @$this->var->mysqli->query("SELECT id, vzdelani FROM vzdelani ORDER BY id ASC"))
    {
      if ($res->num_rows != 0)//include "{$this->var->form}/add_true.php";
      {
        $result = //výpis zemí
        "
<div class=\"menu_zakaznici_centralni_background central_menu_bok\">
  <span class=\"bokmenu_top\"></span>
    <div>
      <p class=\"text_polozka_central polozka_central_zahlavi\">{$this->var->jazyk["zam_vzdelani"]}</p>
      <p class=\"text_akce_central_upravit upravit_v_zahlavi\">{$this->var->jazyk["edit"]}</p>
      <p class=\"text_akce_central_smazat smazat_v_zahlavi\">{$this->var->jazyk["del"]}</p>
          ";
        while ($data = $res->fetch_object())
        {
          $result .=
          "
      <p class=\"text_polozka_central\">$data->vzdelani</p>
      <p class=\"text_akce_central_upravit\"><a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}&amp;co=edit&amp;cislo=$data->id\" title=\"{$this->var->jazyk["edit"]}\"></a></p>
      <p class=\"text_akce_central_smazat\"><a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}&amp;co=del&amp;cislo=$data->id\" title=\"{$this->var->jazyk["del"]}\"></a></p>
          ";
        }
        $result .=
        "
    </div>
  <span class=\"bokmenu_bottom\"></span>
</div>
        ";
      }
        else
      {
        $result = $this->var->main->EmptyLine();
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
    }

    return $result;
  }
//******************************************************************************
  function ZamestnanecPridatVzdelani()  //pridat zemi zamestnance
  {
    $result .= include "{$this->var->form}/add_vzde_zamestnanec.php";

    if (!Empty($_POST["addvzde"]) &&
        !Empty($_POST["tlacitko"]))
    {
      $nazev = stripslashes(htmlspecialchars($_POST["addvzde"]));
      if (@$this->var->mysqli->multi_query("INSERT INTO vzdelani (id, vzdelani) VALUES(NULL, '$nazev');"))
      {
        $result = include "{$this->var->form}/add_true.php";
        $this->var->main->AutoClick(1, "?action={$_GET["action"]}&akce={$_GET["akce"]}");  //auto kliknutí
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
      }
    }

    return $result;
  }
//******************************************************************************
  function ZamestnanecUpravitVzdelani() //upravit zemi zamestnance
  {
    $id = $_GET["cislo"];
    settype($id, "integer");

    if (!Empty($id) && $id != 0)
    {
      if ($res = @$this->var->mysqli->query("SELECT vzdelani FROM vzdelani WHERE id=$id"))
      {
        $data = $res->fetch_object();
        $result .= include "{$this->var->form}/edit_vzde_zamestnanec.php";
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
      }
    }

    if (!Empty($_POST["editvzde"]) &&
        !Empty($_POST["tlacitko"]) &&
        !Empty($id) &&
        $id != 0)
    {
      $nazev = stripslashes(htmlspecialchars($_POST["editvzde"]));
      if (@$this->var->mysqli->multi_query("UPDATE vzdelani SET vzdelani='$nazev' WHERE id=$id;"))
      {
        $result = include "{$this->var->form}/edit_true.php";
        $this->var->main->AutoClick(1, "?action={$_GET["action"]}&akce={$_GET["akce"]}");  //auto kliknutí
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
      }
    }

    return $result;
  }
//******************************************************************************
  function ZamestnanecSmazatVzdelani()  //smazat zemi zamestnance
  {
    $id = $_GET["cislo"];
    settype($id, "integer");

    if (!Empty($id) && $id != 0)
    {
      if ($res = @$this->var->mysqli->query("SELECT vzdelani FROM vzdelani WHERE id=$id"))
      {
        $data = $res->fetch_object();
        $result .= include "{$this->var->form}/del_vzde_zamestnanec.php";
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
      }
    }

    if (!Empty($_POST["ano"]) &&
        !Empty($id) &&
        $id != 0)
    {
      $nazev = stripslashes(htmlspecialchars($_POST["delvzde"]));
      if (@$this->var->mysqli->multi_query("DELETE FROM vzdelani WHERE id=$id;"))
      {
        $result = include "{$this->var->form}/del_true.php";
        $this->var->main->AutoClick(1, "?action={$_GET["action"]}&akce={$_GET["akce"]}");  //auto kliknutí
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
      }
    }
      else
    {
      if (!Empty($_POST["ne"]))
      {
        $result = include "{$this->var->form}/del_false.php";
        $this->var->main->AutoClick(1, "?action={$_GET["action"]}&akce={$_GET["akce"]}");  //auto kliknutí
      }
    }

    return $result;
  }
//******************************************************************************
  function ZamestnanecEditDelStatus() //vypis zemi zamestance + edit, del
  {
    if ($res = @$this->var->mysqli->query("SELECT id, status FROM status ORDER BY id ASC"))
    {
      if ($res->num_rows != 0)//include "{$this->var->form}/add_true.php";
      {
        $result = //výpis zemí
        "
<div class=\"menu_zakaznici_centralni_background central_menu_bok\">
  <span class=\"bokmenu_top\"></span>
    <div>
      <p class=\"text_polozka_central polozka_central_zahlavi\">{$this->var->jazyk["zam_status"]}</p>
      <p class=\"text_akce_central_upravit upravit_v_zahlavi\">{$this->var->jazyk["edit"]}</p>
      <p class=\"text_akce_central_smazat smazat_v_zahlavi\">{$this->var->jazyk["del"]}</p>
          ";
        while ($data = $res->fetch_object())
        {
          $result .=
          "
      <p class=\"text_polozka_central\">$data->status</p>
      <p class=\"text_akce_central_upravit\"><a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}&amp;co=edit&amp;cislo=$data->id\" title=\"{$this->var->jazyk["edit"]}\"></a></p>
      <p class=\"text_akce_central_smazat\"><a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}&amp;co=del&amp;cislo=$data->id\" title=\"{$this->var->jazyk["del"]}\"></a></p>
          ";
        }
        $result .=
        "
    </div>
  <span class=\"bokmenu_bottom\"></span>
</div>
        ";
      }
        else
      {
        $result = $this->var->main->EmptyLine();
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
    }

    return $result;
  }
//******************************************************************************
  function ZamestnanecPridatStatus()  //pridat zemi zamestnance
  {
    $result .= include "{$this->var->form}/add_stat_zamestnanec.php";

    if (!Empty($_POST["addstat"]) &&
        !Empty($_POST["tlacitko"]))
    {
      $nazev = stripslashes(htmlspecialchars($_POST["addstat"]));
      if (@$this->var->mysqli->multi_query("INSERT INTO status (id, status) VALUES(NULL, '$nazev');"))
      {
        $result = include "{$this->var->form}/add_true.php";
        $this->var->main->AutoClick(1, "?action={$_GET["action"]}&akce={$_GET["akce"]}");  //auto kliknutí
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
      }
    }

    return $result;
  }
//******************************************************************************
  function ZamestnanecUpravitStatus() //upravit zemi zamestnance
  {
    $id = $_GET["cislo"];
    settype($id, "integer");

    if (!Empty($id) && $id != 0)
    {
      if ($res = @$this->var->mysqli->query("SELECT status FROM status WHERE id=$id"))
      {
        $data = $res->fetch_object();
        $result .= include "{$this->var->form}/edit_stat_zamestnanec.php";
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
      }
    }

    if (!Empty($_POST["editstat"]) &&
        !Empty($_POST["tlacitko"]) &&
        !Empty($id) &&
        $id != 0)
    {
      $nazev = stripslashes(htmlspecialchars($_POST["editstat"]));
      if (@$this->var->mysqli->multi_query("UPDATE status SET status='$nazev' WHERE id=$id;"))
      {
        $result = include "{$this->var->form}/edit_true.php";
        $this->var->main->AutoClick(1, "?action={$_GET["action"]}&akce={$_GET["akce"]}");  //auto kliknutí
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
      }
    }

    return $result;
  }
//******************************************************************************
  function ZamestnanecSmazatStatus()  //smazat zemi zamestnance
  {
    $id = $_GET["cislo"];
    settype($id, "integer");

    if (!Empty($id) && $id != 0)
    {
      if ($res = @$this->var->mysqli->query("SELECT status FROM status WHERE id=$id"))
      {
        $data = $res->fetch_object();
        $result .= include "{$this->var->form}/del_stat_zamestnanec.php";
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
      }
    }

    if (!Empty($_POST["ano"]) &&
        !Empty($id) &&
        $id != 0)
    {
      $nazev = stripslashes(htmlspecialchars($_POST["delstat"]));
      if (@$this->var->mysqli->multi_query("DELETE FROM status WHERE id=$id;"))
      {
        $result = include "{$this->var->form}/del_true.php";
        $this->var->main->AutoClick(1, "?action={$_GET["action"]}&akce={$_GET["akce"]}");  //auto kliknutí
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
      }
    }
      else
    {
      if (!Empty($_POST["ne"]))
      {
        $result = include "{$this->var->form}/del_false.php";
        $this->var->main->AutoClick(1, "?action={$_GET["action"]}&akce={$_GET["akce"]}");  //auto kliknutí
      }
    }

    return $result;
  }
//******************************************************************************
  function ZamestnanecEditDelJazyk()  //vypis jazyku + edit, del
  {
    if ($res = @$this->var->mysqli->query("SELECT id, jazyk FROM jazyk ORDER BY jazyk ASC"))
    {
      if ($res->num_rows != 0)
      {
        $result = //výpis jazyka
        "
<div class=\"menu_zakaznici_centralni_background central_menu_bok\">
  <span class=\"bokmenu_top\"></span>
    <div>
      <p class=\"text_polozka_central polozka_central_zahlavi\">{$this->var->jazyk["zam_jazyk"]}</p>
      <p class=\"text_akce_central_upravit upravit_v_zahlavi\">{$this->var->jazyk["edit"]}</p>
      <p class=\"text_akce_central_smazat smazat_v_zahlavi\">{$this->var->jazyk["del"]}</p>
          ";
        while ($data = $res->fetch_object())
        {
          $result .=
          "
      <p class=\"text_polozka_central\">$data->jazyk</p>
      <p class=\"text_akce_central_upravit\"><a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}&amp;co=edit&amp;cislo=$data->id\" title=\"{$this->var->jazyk["edit"]}\"></a></p>
      <p class=\"text_akce_central_smazat\"><a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}&amp;co=del&amp;cislo=$data->id\" title=\"{$this->var->jazyk["del"]}\"></a></p>
          ";
        }
        $result .=
        "
    </div>
  <span class=\"bokmenu_bottom\"></span>
</div>
        ";
      }
        else
      {
        $result = $this->var->main->EmptyLine();
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
    }

    return $result;
  }
//******************************************************************************
  function ZamestnanecPridatJazyk() //pridani jazyku zamestnance
  {
    $result .= include "{$this->var->form}/add_jazyk_zamestnanec.php";

    if (!Empty($_POST["addjazyk"]) &&
        !Empty($_POST["tlacitko"]))
    {
      $nazev = stripslashes(htmlspecialchars($_POST["addjazyk"]));
      if (@$this->var->mysqli->multi_query("INSERT INTO jazyk (id, jazyk) VALUES(NULL, '$nazev');"))
      {
        $result = include "{$this->var->form}/add_true.php";
        $this->var->main->AutoClick(1, "?action={$_GET["action"]}&akce={$_GET["akce"]}");  //auto kliknutí
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
      }
    }

    return $result;
  }
//******************************************************************************
  function  ZamestnanecUpravitJazyk()  //uprava jazyku zamestnance
  {
    $id = $_GET["cislo"];
    settype($id, "integer");

    if (!Empty($id) && $id != 0)
    {
      if ($res = @$this->var->mysqli->query("SELECT jazyk FROM jazyk WHERE id=$id"))
      {
        $data = $res->fetch_object();
        $result .= include "{$this->var->form}/edit_jazyk_zamestnanec.php";
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
      }
    }

    if (!Empty($_POST["editjazyk"]) &&
        !Empty($_POST["tlacitko"]) &&
        !Empty($id) &&
        $id != 0)
    {
      $nazev = stripslashes(htmlspecialchars($_POST["editjazyk"]));
      if (@$this->var->mysqli->multi_query("UPDATE jazyk SET jazyk='$nazev' WHERE id=$id;"))
      {
        $result = include "{$this->var->form}/edit_true.php";
        $this->var->main->AutoClick(1, "?action={$_GET["action"]}&akce={$_GET["akce"]}");  //auto kliknutí
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
      }
    }

    return $result;
  }
//******************************************************************************
  function ZamestnanecSmazatJazyk() //smazani jazyku zamestnance
  {
    $id = $_GET["cislo"];
    settype($id, "integer");

    if (!Empty($id) && $id != 0)
    {
      if ($res = @$this->var->mysqli->query("SELECT jazyk FROM jazyk WHERE id=$id"))
      {
        $data = $res->fetch_object();
        $result .= include "{$this->var->form}/del_jazyk_zamestnanec.php";
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
      }
    }

    if (!Empty($_POST["ano"]) &&
        !Empty($id) &&
        $id != 0)
    {
      $nazev = stripslashes(htmlspecialchars($_POST["deljazyk"]));
      if (@$this->var->mysqli->multi_query("DELETE FROM jazyk WHERE id=$id;"))
      {
        $result = include "{$this->var->form}/del_true.php";
        $this->var->main->AutoClick(1, "?action={$_GET["action"]}&akce={$_GET["akce"]}");  //auto kliknutí
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
      }
    }
      else
    {
      if (!Empty($_POST["ne"]))
      {
        $result = include "{$this->var->form}/del_false.php";
        $this->var->main->AutoClick(1, "?action={$_GET["action"]}&akce={$_GET["akce"]}");  //auto kliknutí
      }
    }

    return $result;
  }
//******************************************************************************
  function ZamestnanecEditDelHobby()  //vypis hobby + edit, del
  {
    if ($res = @$this->var->mysqli->query("SELECT id, hobby FROM hobby ORDER BY hobby ASC"))
    {
      if ($res->num_rows != 0)
      {
        $result = //výpis hobby
        "
<div class=\"menu_zakaznici_centralni_background central_menu_bok\">
  <span class=\"bokmenu_top\"></span>
    <div>
      <p class=\"text_polozka_central polozka_central_zahlavi\">{$this->var->jazyk["zam_hobby"]}</p>
      <p class=\"text_akce_central_upravit upravit_v_zahlavi\">{$this->var->jazyk["edit"]}</p>
      <p class=\"text_akce_central_smazat smazat_v_zahlavi\">{$this->var->jazyk["del"]}</p>
          ";
        while ($data = $res->fetch_object())
        {
          $result .=
          "
      <p class=\"text_polozka_central\">$data->hobby</p>
      <p class=\"text_akce_central_upravit\"><a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}&amp;co=edit&amp;cislo=$data->id\" title=\"{$this->var->jazyk["edit"]}\"></a></p>
      <p class=\"text_akce_central_smazat\"><a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}&amp;co=del&amp;cislo=$data->id\" title=\"{$this->var->jazyk["del"]}\"></a></p>
          ";
        }
        $result .=
        "
    </div>
  <span class=\"bokmenu_bottom\"></span>
</div>
        ";
      }
        else
      {
        $result = $this->var->main->EmptyLine();
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
    }

    return $result;
  }
//******************************************************************************
  function ZamestnanecPridatHobby() //pridani hobby zamestnanci
  {
    $result .= include "{$this->var->form}/add_hobby_zamestnanec.php";

    if (!Empty($_POST["addhobby"]) &&
        !Empty($_POST["tlacitko"]))
    {
      $nazev = stripslashes(htmlspecialchars($_POST["addhobby"]));
      if (@$this->var->mysqli->multi_query("INSERT INTO hobby (id, hobby) VALUES(NULL, '$nazev');"))
      {
        $result = include "{$this->var->form}/add_true.php";
        $this->var->main->AutoClick(1, "?action={$_GET["action"]}&akce={$_GET["akce"]}");  //auto kliknutí
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
      }
    }

    return $result;
  }
//******************************************************************************
  function ZamestnanecUpravitHobby()  //uprava hobby zamestancum
  {
    $id = $_GET["cislo"];
    settype($id, "integer");

    if (!Empty($id) && $id != 0)
    {
      if ($res = @$this->var->mysqli->query("SELECT hobby FROM hobby WHERE id=$id"))
      {
        $data = $res->fetch_object();
        $result = include "{$this->var->form}/edit_hobby_zamestnanec.php";
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
      }
    }

    if (!Empty($_POST["edithobby"]) &&
        !Empty($_POST["tlacitko"]) &&
        !Empty($id) &&
        $id != 0)
    {
      $nazev = stripslashes(htmlspecialchars($_POST["edithobby"]));
      if (@$this->var->mysqli->multi_query("UPDATE hobby SET hobby='$nazev' WHERE id=$id;"))
      {
        $result = include "{$this->var->form}/edit_true.php";
        $this->var->main->AutoClick(1, "?action={$_GET["action"]}&akce={$_GET["akce"]}");  //auto kliknutí
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
      }
    }

    return $result;
  }
//******************************************************************************
  function ZamestnanecSmazatHobby() //smazani hobby zamestancum
  {
    $id = $_GET["cislo"];
    settype($id, "integer");

    if (!Empty($id) && $id != 0)
    {
      if ($res = @$this->var->mysqli->query("SELECT hobby FROM hobby WHERE id=$id"))
      {
        $data = $res->fetch_object();
        $result = include "{$this->var->form}/del_hobby_zamestnanec.php";
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
      }
    }

    if (!Empty($_POST["ano"]) &&
        !Empty($id) &&
        $id != 0)
    {
      $nazev = stripslashes(htmlspecialchars($_POST["delhobby"]));
      if (@$this->var->mysqli->multi_query("DELETE FROM hobby WHERE id=$id;"))
      {
        $result = include "{$this->var->form}/del_true.php";
        $this->var->main->AutoClick(1, "?action={$_GET["action"]}&akce={$_GET["akce"]}");  //auto kliknutí
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
      }
    }
      else
    {
      if (!Empty($_POST["ne"]))
      {
        $result = include "{$this->var->form}/del_false.php";
        $this->var->main->AutoClick(1, "?action={$_GET["action"]}&akce={$_GET["akce"]}");  //auto kliknutí
      }
    }

    return $result;
  }
//******************************************************************************
  function ZamestnanecEditDelSport()  //vypis sportu + edit, del
  {
    if ($res = @$this->var->mysqli->query("SELECT id, sport FROM sport ORDER BY sport ASC"))
    {
      if ($res->num_rows != 0)
      {
        $result = //výpis sport
        "
<div class=\"menu_zakaznici_centralni_background central_menu_bok\">
  <span class=\"bokmenu_top\"></span>
    <div>
      <p class=\"text_polozka_central polozka_central_zahlavi\">{$this->var->jazyk["zam_sport"]}</p>
      <p class=\"text_akce_central_upravit upravit_v_zahlavi\">{$this->var->jazyk["edit"]}</p>
      <p class=\"text_akce_central_smazat smazat_v_zahlavi\">{$this->var->jazyk["del"]}</p>
          ";
        while ($data = $res->fetch_object())
        {
          $result .=
          "
      <p class=\"text_polozka_central\">$data->sport</p>
      <p class=\"text_akce_central_upravit\"><a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}&amp;co=edit&amp;cislo=$data->id\" title=\"{$this->var->jazyk["edit"]}\"></a></p>
      <p class=\"text_akce_central_smazat\"><a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}&amp;co=del&amp;cislo=$data->id\" title=\"{$this->var->jazyk["del"]}\"></a></p>
          ";
        }
        $result .=
        "
    </div>
  <span class=\"bokmenu_bottom\"></span>
</div>
        ";
      }
        else
      {
        $result = $this->var->main->EmptyLine();
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
    }

    return $result;
  }
//******************************************************************************
  function ZamestnanecPridatSport() //pridani sportu zamestnance
  {
    $result .= include "{$this->var->form}/add_sport_zamestnanec.php";

    if (!Empty($_POST["addsport"]) &&
        !Empty($_POST["tlacitko"]))
    {
      $nazev = stripslashes(htmlspecialchars($_POST["addsport"]));
      if (@$this->var->mysqli->multi_query("INSERT INTO sport (id, sport) VALUES(NULL, '$nazev');"))
      {
        $result = include "{$this->var->form}/add_true.php";
        $this->var->main->AutoClick(1, "?action={$_GET["action"]}&akce={$_GET["akce"]}");  //auto kliknutí
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
      }
    }

    return $result;
  }
//******************************************************************************
  function ZamestnanecUpravitSport()  //uprava sportu zamestnance
  {
    $id = $_GET["cislo"];
    settype($id, "integer");

    if (!Empty($id) && $id != 0)
    {
      if ($res = @$this->var->mysqli->query("SELECT sport FROM sport WHERE id=$id"))
      {
        $data = $res->fetch_object();
        $result .= include "{$this->var->form}/edit_sport_zamestnanec.php";
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
      }
    }

    if (!Empty($_POST["editsport"]) &&
        !Empty($_POST["tlacitko"]) &&
        !Empty($id) &&
        $id != 0)
    {
      $nazev = stripslashes(htmlspecialchars($_POST["editsport"]));
      if (@$this->var->mysqli->multi_query("UPDATE sport SET sport='$nazev' WHERE id=$id;"))
      {
        $result = include "{$this->var->form}/edit_true.php";
        $this->var->main->AutoClick(1, "?action={$_GET["action"]}&akce={$_GET["akce"]}");  //auto kliknutí
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
      }
    }

    return $result;
  }
//******************************************************************************
  function ZamestnanecSmazatSport() //smazani sportu zamestance
  {
    $id = $_GET["cislo"];
    settype($id, "integer");

    if (!Empty($id) && $id != 0)
    {
      if ($res = @$this->var->mysqli->query("SELECT sport FROM sport WHERE id=$id"))
      {
        $data = $res->fetch_object();
        $result .= include "{$this->var->form}/del_sport_zamestnanec.php";
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
      }
    }

    if (!Empty($_POST["ano"]) &&
        !Empty($id) &&
        $id != 0)
    {
      $nazev = stripslashes(htmlspecialchars($_POST["delsport"]));
      if (@$this->var->mysqli->multi_query("DELETE FROM sport WHERE id=$id;"))
      {
        $result = include "{$this->var->form}/del_true.php";
        $this->var->main->AutoClick(1, "?action={$_GET["action"]}&akce={$_GET["akce"]}");  //auto kliknutí
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
      }
    }
      else
    {
      if (!Empty($_POST["ne"]))
      {
        $result = include "{$this->var->form}/del_false.php";
        $this->var->main->AutoClick(1, "?action={$_GET["action"]}&akce={$_GET["akce"]}");  //auto kliknutí
      }
    }

    return $result;
  }
//******************************************************************************
  function ZamestnanecEditDelVyska()  //vypis vysky + edit, del
  {
    if ($res = @$this->var->mysqli->query("SELECT id, typ FROM typvysoke ORDER BY typ ASC"))
    {
      if ($res->num_rows != 0)
      {
        $result = //výpis sport
        "
<div class=\"menu_zakaznici_centralni_background central_menu_bok\">
  <span class=\"bokmenu_top\"></span>
    <div>
      <p class=\"text_polozka_central polozka_central_zahlavi\">{$this->var->jazyk["zam_typvyska"]}</p>
      <p class=\"text_akce_central_upravit upravit_v_zahlavi\">{$this->var->jazyk["edit"]}</p>
      <p class=\"text_akce_central_smazat smazat_v_zahlavi\">{$this->var->jazyk["del"]}</p>
          ";
        while ($data = $res->fetch_object())
        {
          $result .=
          "
      <p class=\"text_polozka_central\">$data->typ</p>
      <p class=\"text_akce_central_upravit\"><a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}&amp;co=edit&amp;cislo=$data->id\" title=\"{$this->var->jazyk["edit"]}\"></a></p>
      <p class=\"text_akce_central_smazat\"><a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}&amp;co=del&amp;cislo=$data->id\" title=\"{$this->var->jazyk["del"]}\"></a></p>
          ";
        }
        $result .=
        "
    </div>
  <span class=\"bokmenu_bottom\"></span>
</div>
        ";
      }
        else
      {
        $result = $this->var->main->EmptyLine();
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
    }

    return $result;
  }
//******************************************************************************
  function ZamestnanecPridatVyska() //pridani vyska zamestnance
  {
    $result .= include "{$this->var->form}/add_vyska_zamestnanec.php";
    
    if (!Empty($_POST["addvyska"]) &&
        !Empty($_POST["tlacitko"]))
    {
      $nazev = stripslashes(htmlspecialchars($_POST["addvyska"]));
      if (@$this->var->mysqli->multi_query("INSERT INTO typvysoke (id, typ) VALUES(NULL, '$nazev');"))
      {
        $result = include "{$this->var->form}/add_true.php";
        $this->var->main->AutoClick(1, "?action={$_GET["action"]}&akce={$_GET["akce"]}");  //auto kliknutí
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
      }
    }

    return $result;
  }
//******************************************************************************
  function ZamestnanecUpravitVyska()  //uprava vyska zamestnance
  {
    $id = $_GET["cislo"];
    settype($id, "integer");

    if (!Empty($id) && $id != 0)
    {
      if ($res = @$this->var->mysqli->query("SELECT typ FROM typvysoke WHERE id=$id"))
      {
        $data = $res->fetch_object();
        $result .= include "{$this->var->form}/edit_vyska_zamestnanec.php";
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
      }
    }

    if (!Empty($_POST["editvyska"]) &&
        !Empty($_POST["tlacitko"]) &&
        !Empty($id) &&
        $id != 0)
    {
      $nazev = stripslashes(htmlspecialchars($_POST["editvyska"]));
      if (@$this->var->mysqli->multi_query("UPDATE typvysoke SET typ='$nazev' WHERE id=$id;"))
      {
        $result = include "{$this->var->form}/edit_true.php";
        $this->var->main->AutoClick(1, "?action={$_GET["action"]}&akce={$_GET["akce"]}");  //auto kliknutí
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
      }
    }

    return $result;
  }
//******************************************************************************
  function ZamestnanecSmazatVyska() //smazani vysky zamestnance
  {
    $id = $_GET["cislo"];
    settype($id, "integer");
    
    if (!Empty($id) && $id != 0)
    {
      if ($res = @$this->var->mysqli->query("SELECT typ FROM typvysoke WHERE id=$id"))
      {
        $data = $res->fetch_object();
        $result .= include "{$this->var->form}/del_vyska_zamestnanec.php";
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
      }
    }

    if (!Empty($_POST["ano"]) &&
        !Empty($id) &&
        $id != 0)
    {
      $nazev = stripslashes(htmlspecialchars($_POST["delvyska"]));
      if (@$this->var->mysqli->multi_query("DELETE FROM typvysoke WHERE id=$id;"))
      {
        $result = include "{$this->var->form}/del_true.php";
        $this->var->main->AutoClick(1, "?action={$_GET["action"]}&akce={$_GET["akce"]}");  //auto kliknutí
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
      }
    }
      else
    {
      if (!Empty($_POST["ne"]))
      {
        $result = include "{$this->var->form}/del_false.php";
        $this->var->main->AutoClick(1, "?action={$_GET["action"]}&akce={$_GET["akce"]}");  //auto kliknutí
      }
    }

    return $result;
  }
//******************************************************************************
  function VypisPrava() //vypise prava zamestnance
  {
    if ($res = @$this->var->mysqli->query("SELECT id, prava FROM prava ORDER BY prava ASC"))
    {
      if ($res->num_rows != 0)
      {
        $result = //výpis zemí
        "
<div class=\"menu_zakaznici_centralni_background prava_zvlast_menu\">
  <span class=\"bokmenu_top\"></span>
    <div>
      <p class=\"text_polozka_prava polozka_v_zahlavi\">{$this->var->jazyk["zam_prava"]}</p>
      <p class=\"text_akce_prava akce_v_zahlavi\">{$this->var->jazyk["edit"]}</p>
          ";

        while ($data = $res->fetch_object())
        {
          $result .=
          "
      <p class=\"text_polozka_prava\">$data->prava</p>
      <p class=\"text_akce_prava\">".($data->id != $this->var->superadmin ? "<a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}&amp;cislo={$data->id}\" title=\"{$this->var->jazyk["edit"]}\"></a>" : $this->var->emptypol)."</p>
          ";//?action={$_GET["action"]}&amp;akce={$_GET["akce"]}&amp;co=edit&amp;cislo=$data->id  onclick=\"AjaxMenu($data->id, '', '', '', '', '', '');\"
        }
        $result .=
        "
    </div>
  <span class=\"bokmenu_bottom\"></span>
</div>
        ";
      }
        else
      {
        $result = $this->var->main->EmptyLine();
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
    }

    return $result;
  }
//******************************************************************************
  function VypisEditStrankovani() //vypise strankovani
  {
    if ($res = @$this->var->mysqli->query("SELECT id, sekce, pocet FROM strankovani ORDER BY id ASC"))
    {
      if ($res->num_rows != 0)
      {
        $result = //výpis zemí
        "<form method=\"post\" action=\"\">
        <fieldset>
        <table border=\"1\">
          <tr>
            <td>{$this->var->jazyk["stran_admin"]}</td>
            <td>{$this->var->jazyk["hodnota"]}</td>
          </tr>";

        $preklad = array ("zamestnanec" => "zamestnanci",
                          "partner" => "partneri",
                          "zakaznik" => "zakaznici");

        while ($data = $res->fetch_object())
        {
          $result .=
          "
          <tr>
            <td>{$this->var->jazyk[$preklad[$data->sekce]]}</td>
            <td><input type=\"text\" name=\"sek{$data->id}\" value=\"{$data->pocet}\" /></td>
          </tr>
          ";
        }

        $result .=
        "</table>
        <input type=\"submit\" name=\"tlacitko\" value=\"{$this->var->jazyk["edit"]}\" />
        </fieldset>
        </form>";

        if (!Empty($_POST["tlacitko"]) &&
            !Empty($_POST["sek1"]) &&
            !Empty($_POST["sek2"]) &&
            !Empty($_POST["sek3"]))
        {
          $h1 = $_POST["sek1"]; //prevedeni na cisla
          settype($h1, "integer");
          $h2 = $_POST["sek2"];
          settype($h2, "integer");
          $h3 = $_POST["sek3"];
          settype($h3, "integer");

          $this->var->mysqli->multi_query("UPDATE strankovani SET pocet=$h1 WHERE id=1;");
          $this->var->mysqli->multi_query("UPDATE strankovani SET pocet=$h2 WHERE id=2;");
          $this->var->mysqli->multi_query("UPDATE strankovani SET pocet=$h3 WHERE id=3;");
          $nazev = $this->var->jazyk["stran_admin"];
          $result = include "{$this->var->form}/edit_true.php";
          $this->var->main->AutoClick(1, "?action={$_GET["action"]}&akce={$_GET["akce"]}");  //auto kliknutí
        }
      }
        else
      {
        $result = $this->var->main->EmptyLine();
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
    }

    return $result;
  }
//******************************************************************************
  function ObsahPristup()
  {
    $cislo = $_GET["cislo"];
    settype($cislo, "integer");

    if (!Empty($cislo) && $cislo != 0)
    {
      if ($res = @$this->var->mysqli->query("SELECT idpristup as id
                                            FROM prava_ma_pristup WHERE
                                            idprava={$cislo};"))
      {
        while($data = $res->fetch_object()) //nacitaci algoritmus
        {
          $this->pole[$data->id] = true;
        }

        $adminmenu =  //zacatek seznamu
        "
        ";

/*
<ul>
  <li>prvni</li>
  <li>prvni</li>
  <li>prvni</li>
  <li>
    <ul>
      <li>druhy</li>
      <li>druhy</li>
      <li>druhy</li>
      <li>
        <ul>
          <li>treti</li>
          <li>treti</li>
          <li>treti</li>
        </ul>
      </li>
      <li>druhy</li>
      <li>druhy</li>
    </ul>
  </li>
  <li>prvni</li>
  <li>prvni</li>
</ul>

<dl>
<dt>checkbox</dt>
<dd>text</dd>
<dt>checkbox</dt>
<dd>text</dd>
</dl>

*/

        for($i = 0; $i < count($this->menu); $i++)
        {
          $adminmenu .=
          "
        <li>
          <dl>
            <dt>
              ".(!Empty($this->submenu[$i][0][0]) ? "<a href=\"#\" id=\"fobr{$i}\" onclick=\"RozbalPlus('prvnizanoreni{$i}', this, 'obr{$i}', '{$this->var->web}', '{$this->var->jazyk[menu_mini]}', '{$this->var->jazyk[menu_full]}');\" title=\"{$this->var->jazyk[menu_mini]} / {$this->var->jazyk[menu_full]}\" ></a>" : "")."
              <input type=\"checkbox\" id=\"h{$i}\" name=\"pris[{$this->menu[$i][0]}]\" value=\"{$this->menu[$i][0]}\" ".($this->pole[$this->menu[$i][0]] ? "checked=\"checked\"" : "")." />
            </dt>
            <dd>
              {$this->var->jazyk[$this->menu[$i][1]]} ".(!Empty($this->submenu[$i][0][0]) ? "<a href=\"#\" id=\"obr{$i}\" onclick=\"Rozbalit('prvnizanoreni{$i}', this, 'fobr{$i}', '{$this->var->jazyk[menu_mini]}', '{$this->var->jazyk[menu_full]}', '{$this->var->web}');\" title=\"{$this->var->jazyk[menu_mini]} / {$this->var->jazyk[menu_full]}\" >{$this->var->jazyk[menu_mini]}<span></span></a>" : "")."
            </dd>
          </dl>
          <!-- zacatek prvni vnoreni -->
            ".(!Empty($this->submenu[$i][0][0]) ? $this->Sub($i) : "")."
          <!-- konec prvni vnoreni -->
        </li>
          ";  // onclick=\"AjaxMenu({$cislo}, {$menu[$i][0]});\"  $_GET["menu"] == $i ".(!Empty($submenu[$i][0][0]) ? "<a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}&amp;cislo={$cislo}&amp;menu={$i}\">{$this->var->jazyk[$menu[$i][1]]}</a>" :)."
        }

        $adminmenu .= //konec seznamu
        "

        ";

        if ($r = @$this->var->mysqli->query("SELECT prava FROM prava WHERE id=$cislo;"))  //nacteni nazvu
        {
          $d = $r->fetch_object();
        }
          else
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
        }

        $edit =
        "
<div id=\"nastaveni_prav_admin\">
  <p>
  {$this->var->jazyk["upravuje"]}: {$d->prava}
  </p>
  <form action=\"\" method=\"get\">
    <fieldset>
      <ul>
        {$adminmenu}
      </ul>
      <input type=\"hidden\" name=\"action\" value=\"{$_GET["action"]}\" />
      <input type=\"hidden\" name=\"akce\" value=\"{$_GET["akce"]}\" />
      <input type=\"hidden\" name=\"cislo\" value=\"{$_GET["cislo"]}\" />
      <input type=\"submit\" name=\"tlacitko\" value=\"{$this->var->jazyk["edit"]}\" />
    </fieldset>
  </form>
</div>
        ";
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
      }
      
      if (!Empty($_GET["tlacitko"]) && count($_GET["pris"]) != 0) //ulozeni
      {
        $this->var->mysqli->multi_query("DELETE FROM prava_ma_pristup WHERE idprava={$cislo};");  //smaze podle aktualniho prava
        $hodnoty = array_values($_GET["pris"]);
        for ($i = 0; $i < count($hodnoty); $i++)
        {
          $this->var->mysqli->multi_query("INSERT INTO prava_ma_pristup (id, idprava, idpristup) VALUES(NULL, {$cislo}, {$hodnoty[$i]});");
        }
        $result = "upraveno"; //vypis nad menu
        $this->var->main->AutoClick(1, "?action={$_GET["action"]}&akce={$_GET["akce"]}&cislo={$cislo}");  //auto kliknutí
      }

      if (!Empty($_GET["tlacitko"]) && count($_GET["pris"]) == 0)
      {
        $this->var->main->ErrorMsg($this->var->jazyk["novalue"]);	//chyba do globální proměnné
      }
    }

    $result .=
    "

      {$this->var->jazyk["pristup_admin"]}


      {$this->VypisPrava()}
      {$edit}
    ";

    return $result;
  } // die rechte fur website - {$this->var->jazyk["pristup_admin"]}
//******************************************************************************
  function Sub($cislo)
  {
    $result =
    "
            <ul class=\"prvni_zanoreni\" id=\"prvnizanoreni{$cislo}\">
    ";
    
    /*
".(!Empty($this->subsubmenu[$cislo][$i][0][0]) ? "" : "")."
    */

    for($i = 0; $i < count($this->submenu[$cislo]); $i++)
    {
      $link = "";
      for($j = 0; $j < count($this->subsubmenu[$cislo][$i]); $j++)  //generovani funkce oznaceni
      {
        $link .= "OznacElement('hs{$cislo}{$i}{$j}', document.getElementById('all{$cislo}{$i}').checked);";
      }
      $all = (!Empty($this->subsubmenu[$cislo][$i][0][0]) ? "(<input type=\"checkbox\" id=\"all{$cislo}{$i}\" onclick=\"OznacElement('h{$cislo}', true);OznacElement('h{$cislo}{$i}', document.getElementById('all{$cislo}{$i}').checked);{$link}\" /> {$this->var->jazyk[select_all]})" : ""); //oznaceni jen kdyz existuje subsubmenu

      $result .=
      "
              <li".($i == (count($this->submenu[$cislo]) - 1) ? " class=\"posledni_polozka_prava\"" : "").">
                <dl>
                  <dt>
                    ".(!Empty($this->subsubmenu[$cislo][$i][0][0]) ? "<a href=\"#\" id=\"fobr{$cislo}{$i}\" onclick=\"RozbalPlus('druhezanoreni{$cislo}{$i}', this, 'obr{$cislo}{$i}', '{$this->var->web}', '{$this->var->jazyk[menu_mini]}', '{$this->var->jazyk[menu_full]}');\" title=\"{$this->var->jazyk[menu_mini]} / {$this->var->jazyk[menu_full]}\" ></a>" : "")."
                    <input type=\"checkbox\" id=\"h{$cislo}{$i}\" onclick=\"OznacElement('h{$cislo}', true);\" name=\"pris[{$this->submenu[$cislo][$i][0]}]\" value=\"{$this->submenu[$cislo][$i][0]}\" ".($this->pole[$this->submenu[$cislo][$i][0]] ? "checked=\"checked\"" : "")." />
                  </dt>
                  <dd>
                    {$this->var->jazyk[$this->submenu[$cislo][$i][1]]} <em>{$all}</em> ".(!Empty($this->subsubmenu[$cislo][$i][0][0]) ? "<a href=\"#\" id=\"obr{$cislo}{$i}\" onclick=\"Rozbalit('druhezanoreni{$cislo}{$i}', this, 'fobr{$cislo}{$i}', '{$this->var->jazyk[menu_mini]}', '{$this->var->jazyk[menu_full]}', '{$this->var->web}');\" title=\"{$this->var->jazyk[menu_mini]} / {$this->var->jazyk[menu_full]}\" >{$this->var->jazyk[menu_mini]}<span></span></a>" : "")."
                  </dd>
                </dl>
                <!-- zacatek druhe vnoreni -->
                  ".(!Empty($this->subsubmenu[$cislo][$i][0][0]) ? $this->SubSub($cislo, $i) : "")."
                <!-- konec druhe vnoreni -->
              </li>
      ";  // onclick=\"AjaxMenu({$cislo}, {$submenu[$_GET["menu"]][$i][0]});\"  $_GET["submenu"] == $i  ".(!Empty($subsubmenu[$_GET["menu"]][$i][0][0]) ? "<a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}&amp;cislo={$cislo}&amp;menu={$_GET["menu"]}&amp;submenu={$i}\">{$this->var->jazyk[$submenu[$_GET["menu"]][$i][1]]}</a>" :)."
    }

    $result .=
    "
            </ul>
    ";

    return $result;
  }
//******************************************************************************
  function SubSub($cislo, $subcislo)
  {
    $result =
    "
                  <ul class=\"druhe_zanoreni\" id=\"druhezanoreni{$cislo}{$subcislo}\">
    ";

    for($i = 0; $i < count($this->subsubmenu[$cislo][$subcislo]); $i++)
    {
      $result .=
      "
                    <li".($i == (count($this->subsubmenu[$cislo][$subcislo]) - 1) ? " class=\"posledni_polozka_prava\"" : "").">
                      <dl>
                        <dt>
                          <input type=\"checkbox\" id=\"hs{$cislo}{$subcislo}{$i}\" onclick=\"OznacElement('h{$cislo}{$subcislo}', true);OznacElement('h{$cislo}', true);\" name=\"pris[{$this->subsubmenu[$cislo][$subcislo][$i][0]}]\" value=\"{$this->subsubmenu[$cislo][$subcislo][$i][0]}\" ".($this->pole[$this->subsubmenu[$cislo][$subcislo][$i][0]] ? "checked=\"checked\"" : "")." />
                        </dt>
                        <dd>
                          {$this->var->jazyk[$this->subsubmenu[$cislo][$subcislo][$i][1]]}
                        </dd>
                      </dl>
                    </li>
      ";  // onclick=\"AjaxMenu({$cislo}, {$subsubmenu[$_GET["menu"]][$_GET["submenu"]][$i][0]});\"
    }

    $result .=
    "
                  </ul>
    ";

    return $result;
  }
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
/*
  //<input type=\"submit\" name=\"tlacitko\" value=\"{$this->var->jazyk["edit"]}\" />
  //onmouseout=\"AjaxMenu({$this->cislo}, '{$this->cismen}', true, '{$this->cissub}', true, '', '');\" onclick=\"AjaxMenu({$this->cislo}, '{$this->cismen}', true, '{$this->cissub}', true, '{$subsubmenu[$this->cismen][$this->cissub][$i][0]}', 'click');\"
  //onclick=\"AjaxMenu({$this->cislo}, '{$this->cismen}', true, '', false, '{$submenu[$this->cismen][$i][0]}', 'click');\" onmouseout=\"AjaxMenu({$this->cislo}, '{$this->cismen}', true, '', false, '', '');\" onclick=\"AjaxMenu({$this->cislo}, '{$this->cismen}', true, '{$i}', true, '', '', '');\"
//".($_GET["submenu"] == $i ? $subsub : "")."
 //onclick=\"AjaxMenu({$this->cislo}, '{$i}', false, '', false, {$menu[$i][0]}, 'click');\" onmouseout=\"AjaxMenu({$this->cislo}, '', false, '', false, '', '');\" onclick=\"AjaxMenu({$this->cislo}, '{$i}', true, '', false, '', '');\"
 //".($_GET["menu"] == $i ? $sub : "")."
//ukládání!!, přidat jména, přidat id do menu a do sub, přidat kontrolovbací JS,

      if (!Empty($_POST["tlacitko"])) //ulozeni
      {
        $this->var->mysqli->multi_query("DELETE FROM prava_ma_pristup WHERE idprava=$cislo;");
        $hodnoty = array_values($_POST["pris"]);
        for ($i = 0; $i < count($hodnoty); $i++)
        {
          //$this->var->mysqli->multi_query("DELETE FROM prava_ma_pristup WHERE idprava=$cislo AND idpristup={$hodnoty[$i]};");
          $this->var->mysqli->multi_query("INSERT INTO prava_ma_pristup (id, idprava, idpristup) VALUES(NULL, $cislo, {$hodnoty[$i]});");
        }
        $result = "upraveno";
        $this->var->main->AutoClick(1, "?action={$_GET["action"]}&akce={$_GET["akce"]}&cislo=$cislo&menu={$_GET["menu"]}&submenu={$_GET["submenu"]}");  //auto kliknutí
      }

SELECT prava_ma_pristup.idpristup as id
                                            FROM prava, prava_ma_pristup WHERE
                                            prava.id=prava_ma_pristup.idprava AND
                                            prava.id=$cislo;

<ol>
              <li><input type=\"checkbox\" id=\"h1\" name=\"pris[{$this->var->pristup["uvod"][""]}]\" ".($pole[$this->var->pristup["uvod"][""]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["uvod"][""]}\" /> {$this->var->jazyk["uvod"]}</li>
              <li><input type=\"checkbox\" id=\"h2\" name=\"pris[{$this->var->pristup["zamestnanci"][""]}]\" ".($pole[$this->var->pristup["zamestnanci"][""]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["zamestnanci"][""]}\" /> {$this->var->jazyk["zamestnanci"]}
                <ol>
                  <li><input type=\"checkbox\" onclick=\"OznacElement('h2', true);\" id=\"hp21\" name=\"pris[{$this->var->pristup["zamestnanci"]["all"]}]\" ".($pole[$this->var->pristup["zamestnanci"]["all"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["zamestnanci"]["all"]}\" /> {$this->var->jazyk["all_zamestnanec"]}</li>
                  <li><input type=\"checkbox\" onclick=\"OznacElement('h2', true);\" id=\"hp22\" name=\"pris[{$this->var->pristup["zamestnanci"]["info"]}]\" ".($pole[$this->var->pristup["zamestnanci"]["info"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["zamestnanci"]["info"]}\" /> <a href=\"?action={$_GET["action"]}&amp;akce={$_GET["akce"]}&amp;co={$_GET["co"]}&amp;cislo={$_GET["cislo"]}".($_GET["roz"] != "hp22" ? "&amp;roz=hp22" : "")."\">{$this->var->jazyk["info"]}</a>
                  ".($_GET["roz"] == "hp22" ? "
                    <ol>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp22', true);\" name=\"pris[{$this->var->pristup["izam"]["log"]}]\" ".($pole[$this->var->pristup["izam"]["log"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["izam"]["log"]}\" /> {$this->var->jazyk["zam_log"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp22', true);\" name=\"pris[{$this->var->pristup["izam"]["hes"]}]\" ".($pole[$this->var->pristup["izam"]["hes"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["izam"]["hes"]}\" /> {$this->var->jazyk["zam_hes"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp22', true);\" name=\"pris[{$this->var->pristup["izam"]["jme"]}]\" ".($pole[$this->var->pristup["izam"]["jme"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["izam"]["jme"]}\" /> {$this->var->jazyk["zam_jmeno"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp22', true);\" name=\"pris[{$this->var->pristup["izam"]["pri"]}]\" ".($pole[$this->var->pristup["izam"]["pri"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["izam"]["pri"]}\" /> {$this->var->jazyk["zam_prim"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp22', true);\" name=\"pris[{$this->var->pristup["izam"]["pra"]}]\" ".($pole[$this->var->pristup["izam"]["pra"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["izam"]["pra"]}\" /> {$this->var->jazyk["zam_prava"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp22', true);\" name=\"pris[{$this->var->pristup["izam"]["uli"]}]\" ".($pole[$this->var->pristup["izam"]["uli"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["izam"]["uli"]}\" /> {$this->var->jazyk["zam_ulice"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp22', true);\" name=\"pris[{$this->var->pristup["izam"]["cp"]}]\" ".($pole[$this->var->pristup["izam"]["cp"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["izam"]["cp"]}\" /> {$this->var->jazyk["zam_cp"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp22', true);\" name=\"pris[{$this->var->pristup["izam"]["psc"]}]\" ".($pole[$this->var->pristup["izam"]["psc"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["izam"]["psc"]}\" /> {$this->var->jazyk["zam_psc"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp22', true);\" name=\"pris[{$this->var->pristup["izam"]["mes"]}]\" ".($pole[$this->var->pristup["izam"]["mes"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["izam"]["mes"]}\" /> {$this->var->jazyk["zam_mesto"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp22', true);\" name=\"pris[{$this->var->pristup["izam"]["zem"]}]\" ".($pole[$this->var->pristup["izam"]["zem"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["izam"]["zem"]}\" /> {$this->var->jazyk["zam_zeme"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp22', true);\" name=\"pris[{$this->var->pristup["izam"]["te1"]}]\" ".($pole[$this->var->pristup["izam"]["te1"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["izam"]["te1"]}\" /> {$this->var->jazyk["zam_tel1"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp22', true);\" name=\"pris[{$this->var->pristup["izam"]["te2"]}]\" ".($pole[$this->var->pristup["izam"]["te2"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["izam"]["te2"]}\" /> {$this->var->jazyk["zam_tel2"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp22', true);\" name=\"pris[{$this->var->pristup["izam"]["ema"]}]\" ".($pole[$this->var->pristup["izam"]["ema"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["izam"]["ema"]}\" /> {$this->var->jazyk["zam_email"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp22', true);\" name=\"pris[{$this->var->pristup["izam"]["dna"]}]\" ".($pole[$this->var->pristup["izam"]["dna"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["izam"]["dna"]}\" /> {$this->var->jazyk["zam_datnar"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp22', true);\" name=\"pris[{$this->var->pristup["izam"]["jaz"]}]\" ".($pole[$this->var->pristup["izam"]["jaz"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["izam"]["jaz"]}\" /> {$this->var->jazyk["zam_jazyk"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp22', true);\" name=\"pris[{$this->var->pristup["izam"]["vzd"]}]\" ".($pole[$this->var->pristup["izam"]["vzd"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["izam"]["vzd"]}\" /> {$this->var->jazyk["zam_vzdelani"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp22', true);\" name=\"pris[{$this->var->pristup["izam"]["rid"]}]\" ".($pole[$this->var->pristup["izam"]["rid"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["izam"]["rid"]}\" /> {$this->var->jazyk["zam_ridicak"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp22', true);\" name=\"pris[{$this->var->pristup["izam"]["poh"]}]\" ".($pole[$this->var->pristup["izam"]["poh"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["izam"]["poh"]}\" /> {$this->var->jazyk["zam_pohlavi"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp22', true);\" name=\"pris[{$this->var->pristup["izam"]["dos"]}]\" ".($pole[$this->var->pristup["izam"]["dos"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["izam"]["dos"]}\" /> {$this->var->jazyk["zam_datosloveni"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp22', true);\" name=\"pris[{$this->var->pristup["izam"]["dzi"]}]\" ".($pole[$this->var->pristup["izam"]["dzi"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["izam"]["dzi"]}\" /> {$this->var->jazyk["zam_datzivot"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp22', true);\" name=\"pris[{$this->var->pristup["izam"]["dpo"]}]\" ".($pole[$this->var->pristup["izam"]["dpo"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["izam"]["dpo"]}\" /> {$this->var->jazyk["zam_datpoh"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp22', true);\" name=\"pris[{$this->var->pristup["izam"]["dza"]}]\" ".($pole[$this->var->pristup["izam"]["dza"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["izam"]["dza"]}\" /> {$this->var->jazyk["zam_datzac"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp22', true);\" name=\"pris[{$this->var->pristup["izam"]["dod"]}]\" ".($pole[$this->var->pristup["izam"]["dod"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["izam"]["dod"]}\" /> {$this->var->jazyk["zam_datodmit"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp22', true);\" name=\"pris[{$this->var->pristup["izam"]["dko"]}]\" ".($pole[$this->var->pristup["izam"]["dko"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["izam"]["dko"]}\" /> {$this->var->jazyk["zam_konprac"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp22', true);\" name=\"pris[{$this->var->pristup["izam"]["sta"]}]\" ".($pole[$this->var->pristup["izam"]["sta"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["izam"]["sta"]}\" /> {$this->var->jazyk["zam_status"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp22', true);\" name=\"pris[{$this->var->pristup["izam"]["exi"]}]\" ".($pole[$this->var->pristup["izam"]["exi"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["izam"]["exi"]}\" /> {$this->var->jazyk["zam_existfoto"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp22', true);\" name=\"pris[{$this->var->pristup["izam"]["hob"]}]\" ".($pole[$this->var->pristup["izam"]["hob"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["izam"]["hob"]}\" /> {$this->var->jazyk["zam_hobby"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp22', true);\" name=\"pris[{$this->var->pristup["izam"]["spo"]}]\" ".($pole[$this->var->pristup["izam"]["spo"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["izam"]["spo"]}\" /> {$this->var->jazyk["zam_sport"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp22', true);\" name=\"pris[{$this->var->pristup["izam"]["rod"]}]\" ".($pole[$this->var->pristup["izam"]["rod"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["izam"]["rod"]}\" /> {$this->var->jazyk["zam_rodiste"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp22', true);\" name=\"pris[{$this->var->pristup["izam"]["mze"]}]\" ".($pole[$this->var->pristup["izam"]["mze"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["izam"]["mze"]}\" /> {$this->var->jazyk["zam_zemenaroz"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp22', true);\" name=\"pris[{$this->var->pristup["izam"]["mja"]}]\" ".($pole[$this->var->pristup["izam"]["mja"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["izam"]["mja"]}\" /> {$this->var->jazyk["zam_matjazyk"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp22', true);\" name=\"pris[{$this->var->pristup["izam"]["jot"]}]\" ".($pole[$this->var->pristup["izam"]["jot"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["izam"]["jot"]}\" /> {$this->var->jazyk["zam_jmotce"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp22', true);\" name=\"pris[{$this->var->pristup["izam"]["pro"]}]\" ".($pole[$this->var->pristup["izam"]["pro"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["izam"]["pro"]}\" /> {$this->var->jazyk["zam_prijotce"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp22', true);\" name=\"pris[{$this->var->pristup["izam"]["pot"]}]\" ".($pole[$this->var->pristup["izam"]["pot"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["izam"]["pot"]}\" /> {$this->var->jazyk["zam_povotce"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp22', true);\" name=\"pris[{$this->var->pristup["izam"]["jma"]}]\" ".($pole[$this->var->pristup["izam"]["jma"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["izam"]["jma"]}\" /> {$this->var->jazyk["zam_jmmatky"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp22', true);\" name=\"pris[{$this->var->pristup["izam"]["prm"]}]\" ".($pole[$this->var->pristup["izam"]["prm"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["izam"]["prm"]}\" /> {$this->var->jazyk["zam_prijmatky"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp22', true);\" name=\"pris[{$this->var->pristup["izam"]["pma"]}]\" ".($pole[$this->var->pristup["izam"]["pma"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["izam"]["pma"]}\" /> {$this->var->jazyk["zam_povmatky"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp22', true);\" name=\"pris[{$this->var->pristup["izam"]["pob"]}]\" ".($pole[$this->var->pristup["izam"]["pob"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["izam"]["pob"]}\" /> {$this->var->jazyk["zam_pocbrat"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp22', true);\" name=\"pris[{$this->var->pristup["izam"]["pos"]}]\" ".($pole[$this->var->pristup["izam"]["pos"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["izam"]["pos"]}\" /> {$this->var->jazyk["zam_pocsest"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp22', true);\" name=\"pris[{$this->var->pristup["izam"]["sso"]}]\" ".($pole[$this->var->pristup["izam"]["sso"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["izam"]["sso"]}\" /> {$this->var->jazyk["zam_sumsour"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp22', true);\" name=\"pris[{$this->var->pristup["izam"]["mat"]}]\" ".($pole[$this->var->pristup["izam"]["mat"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["izam"]["mat"]}\" /> {$this->var->jazyk["zam_mat"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp22', true);\" name=\"pris[{$this->var->pristup["izam"]["str"]}]\" ".($pole[$this->var->pristup["izam"]["str"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["izam"]["str"]}\" /> {$this->var->jazyk["zam_stredni"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp22', true);\" name=\"pris[{$this->var->pristup["izam"]["tst"]}]\" ".($pole[$this->var->pristup["izam"]["tst"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["izam"]["tst"]}\" /> {$this->var->jazyk["zam_typstredni"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp22', true);\" name=\"pris[{$this->var->pristup["izam"]["vys"]}]\" ".($pole[$this->var->pristup["izam"]["vys"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["izam"]["vys"]}\" /> {$this->var->jazyk["zam_vyska"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp22', true);\" name=\"pris[{$this->var->pristup["izam"]["tvy"]}]\" ".($pole[$this->var->pristup["izam"]["tvy"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["izam"]["tvy"]}\" /> {$this->var->jazyk["zam_typvyska"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp22', true);\" name=\"pris[{$this->var->pristup["izam"]["obo"]}]\" ".($pole[$this->var->pristup["izam"]["obo"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["izam"]["obo"]}\" /> {$this->var->jazyk["zam_obor"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp22', true);\" name=\"pris[{$this->var->pristup["izam"]["tyt"]}]\" ".($pole[$this->var->pristup["izam"]["tyt"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["izam"]["tyt"]}\" /> {$this->var->jazyk["zam_tytul"]}</li>
                    </ol>" : "")."
                  </li>
                  <li><input type=\"checkbox\" onclick=\"OznacElement('h2', true);\" id=\"hp23\" name=\"pris[{$this->var->pristup["zamestnanci"]["add"]}]\" ".($pole[$this->var->pristup["zamestnanci"]["add"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["zamestnanci"]["add"]}\" /> {$this->var->jazyk["add_zamestnanec"]}
                    <ol>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp23', true);\" name=\"pris[{$this->var->pristup["azam"]["log"]}]\" ".($pole[$this->var->pristup["azam"]["log"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["azam"]["log"]}\" /> {$this->var->jazyk["zam_log"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp23', true);\" name=\"pris[{$this->var->pristup["azam"]["hes"]}]\" ".($pole[$this->var->pristup["azam"]["hes"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["azam"]["hes"]}\" /> {$this->var->jazyk["zam_hes"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp23', true);\" name=\"pris[{$this->var->pristup["azam"]["hre"]}]\" ".($pole[$this->var->pristup["azam"]["hre"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["azam"]["hre"]}\" /> {$this->var->jazyk["zam_hesrep"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp23', true);\" name=\"pris[{$this->var->pristup["azam"]["jme"]}]\" ".($pole[$this->var->pristup["azam"]["jme"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["azam"]["jme"]}\" /> {$this->var->jazyk["zam_jmeno"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp23', true);\" name=\"pris[{$this->var->pristup["azam"]["pri"]}]\" ".($pole[$this->var->pristup["azam"]["pri"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["azam"]["pri"]}\" /> {$this->var->jazyk["zam_prim"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp23', true);\" name=\"pris[{$this->var->pristup["azam"]["pra"]}]\" ".($pole[$this->var->pristup["azam"]["pra"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["azam"]["pra"]}\" /> {$this->var->jazyk["zam_prava"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp23', true);\" name=\"pris[{$this->var->pristup["azam"]["uli"]}]\" ".($pole[$this->var->pristup["azam"]["uli"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["azam"]["uli"]}\" /> {$this->var->jazyk["zam_ulice"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp23', true);\" name=\"pris[{$this->var->pristup["azam"]["cp"]}]\" ".($pole[$this->var->pristup["azam"]["cp"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["azam"]["cp"]}\" /> {$this->var->jazyk["zam_cp"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp23', true);\" name=\"pris[{$this->var->pristup["azam"]["psc"]}]\" ".($pole[$this->var->pristup["azam"]["psc"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["azam"]["psc"]}\" /> {$this->var->jazyk["zam_psc"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp23', true);\" name=\"pris[{$this->var->pristup["azam"]["mes"]}]\" ".($pole[$this->var->pristup["azam"]["mes"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["azam"]["mes"]}\" /> {$this->var->jazyk["zam_mesto"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp23', true);\" name=\"pris[{$this->var->pristup["azam"]["zem"]}]\" ".($pole[$this->var->pristup["azam"]["zem"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["azam"]["zem"]}\" /> {$this->var->jazyk["zam_zeme"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp23', true);\" name=\"pris[{$this->var->pristup["azam"]["te1"]}]\" ".($pole[$this->var->pristup["azam"]["te1"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["azam"]["te1"]}\" /> {$this->var->jazyk["zam_tel1"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp23', true);\" name=\"pris[{$this->var->pristup["azam"]["te2"]}]\" ".($pole[$this->var->pristup["azam"]["te2"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["azam"]["te2"]}\" /> {$this->var->jazyk["zam_tel2"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp23', true);\" name=\"pris[{$this->var->pristup["azam"]["ema"]}]\" ".($pole[$this->var->pristup["azam"]["ema"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["azam"]["ema"]}\" /> {$this->var->jazyk["zam_email"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp23', true);\" name=\"pris[{$this->var->pristup["azam"]["dna"]}]\" ".($pole[$this->var->pristup["azam"]["dna"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["azam"]["dna"]}\" /> {$this->var->jazyk["zam_datnar"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp23', true);\" name=\"pris[{$this->var->pristup["azam"]["jaz"]}]\" ".($pole[$this->var->pristup["azam"]["jaz"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["azam"]["jaz"]}\" /> {$this->var->jazyk["zam_jazyk"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp23', true);\" name=\"pris[{$this->var->pristup["azam"]["vzd"]}]\" ".($pole[$this->var->pristup["azam"]["vzd"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["azam"]["vzd"]}\" /> {$this->var->jazyk["zam_vzdelani"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp23', true);\" name=\"pris[{$this->var->pristup["azam"]["rid"]}]\" ".($pole[$this->var->pristup["azam"]["rid"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["azam"]["rid"]}\" /> {$this->var->jazyk["zam_ridicak"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp23', true);\" name=\"pris[{$this->var->pristup["azam"]["poh"]}]\" ".($pole[$this->var->pristup["azam"]["poh"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["azam"]["poh"]}\" /> {$this->var->jazyk["zam_pohlavi"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp23', true);\" name=\"pris[{$this->var->pristup["azam"]["dos"]}]\" ".($pole[$this->var->pristup["azam"]["dos"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["azam"]["dos"]}\" /> {$this->var->jazyk["zam_datosloveni"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp23', true);\" name=\"pris[{$this->var->pristup["azam"]["dzi"]}]\" ".($pole[$this->var->pristup["azam"]["dzi"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["azam"]["dzi"]}\" /> {$this->var->jazyk["zam_datzivot"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp23', true);\" name=\"pris[{$this->var->pristup["azam"]["dpo"]}]\" ".($pole[$this->var->pristup["azam"]["dpo"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["azam"]["dpo"]}\" /> {$this->var->jazyk["zam_datpoh"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp23', true);\" name=\"pris[{$this->var->pristup["azam"]["dza"]}]\" ".($pole[$this->var->pristup["azam"]["dza"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["azam"]["dza"]}\" /> {$this->var->jazyk["zam_datzac"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp23', true);\" name=\"pris[{$this->var->pristup["azam"]["dod"]}]\" ".($pole[$this->var->pristup["azam"]["dod"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["azam"]["dod"]}\" /> {$this->var->jazyk["zam_datodmit"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp23', true);\" name=\"pris[{$this->var->pristup["azam"]["dko"]}]\" ".($pole[$this->var->pristup["azam"]["dko"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["azam"]["dko"]}\" /> {$this->var->jazyk["zam_konprac"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp23', true);\" name=\"pris[{$this->var->pristup["azam"]["sta"]}]\" ".($pole[$this->var->pristup["azam"]["sta"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["azam"]["sta"]}\" /> {$this->var->jazyk["zam_status"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp23', true);\" name=\"pris[{$this->var->pristup["azam"]["exi"]}]\" ".($pole[$this->var->pristup["azam"]["exi"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["azam"]["exi"]}\" /> {$this->var->jazyk["zam_existfoto"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp23', true);\" name=\"pris[{$this->var->pristup["azam"]["hob"]}]\" ".($pole[$this->var->pristup["azam"]["hob"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["azam"]["hob"]}\" /> {$this->var->jazyk["zam_hobby"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp23', true);\" name=\"pris[{$this->var->pristup["azam"]["spo"]}]\" ".($pole[$this->var->pristup["azam"]["spo"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["azam"]["spo"]}\" /> {$this->var->jazyk["zam_sport"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp23', true);\" name=\"pris[{$this->var->pristup["azam"]["rod"]}]\" ".($pole[$this->var->pristup["azam"]["rod"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["azam"]["rod"]}\" /> {$this->var->jazyk["zam_rodiste"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp23', true);\" name=\"pris[{$this->var->pristup["azam"]["mze"]}]\" ".($pole[$this->var->pristup["azam"]["mze"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["azam"]["mze"]}\" /> {$this->var->jazyk["zam_zemenaroz"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp23', true);\" name=\"pris[{$this->var->pristup["azam"]["mja"]}]\" ".($pole[$this->var->pristup["azam"]["mja"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["azam"]["mja"]}\" /> {$this->var->jazyk["zam_matjazyk"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp23', true);\" name=\"pris[{$this->var->pristup["azam"]["jot"]}]\" ".($pole[$this->var->pristup["azam"]["jot"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["azam"]["jot"]}\" /> {$this->var->jazyk["zam_jmotce"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp23', true);\" name=\"pris[{$this->var->pristup["azam"]["pro"]}]\" ".($pole[$this->var->pristup["azam"]["pro"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["azam"]["pro"]}\" /> {$this->var->jazyk["zam_prijotce"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp23', true);\" name=\"pris[{$this->var->pristup["azam"]["pot"]}]\" ".($pole[$this->var->pristup["azam"]["pot"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["azam"]["pot"]}\" /> {$this->var->jazyk["zam_povotce"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp23', true);\" name=\"pris[{$this->var->pristup["azam"]["jma"]}]\" ".($pole[$this->var->pristup["azam"]["jma"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["azam"]["jma"]}\" /> {$this->var->jazyk["zam_jmmatky"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp23', true);\" name=\"pris[{$this->var->pristup["azam"]["prm"]}]\" ".($pole[$this->var->pristup["azam"]["prm"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["azam"]["prm"]}\" /> {$this->var->jazyk["zam_prijmatky"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp23', true);\" name=\"pris[{$this->var->pristup["azam"]["pma"]}]\" ".($pole[$this->var->pristup["azam"]["pma"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["azam"]["pma"]}\" /> {$this->var->jazyk["zam_povmatky"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp23', true);\" name=\"pris[{$this->var->pristup["azam"]["pob"]}]\" ".($pole[$this->var->pristup["azam"]["pob"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["azam"]["pob"]}\" /> {$this->var->jazyk["zam_pocbrat"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp23', true);\" name=\"pris[{$this->var->pristup["azam"]["pos"]}]\" ".($pole[$this->var->pristup["azam"]["pos"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["azam"]["pos"]}\" /> {$this->var->jazyk["zam_pocsest"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp23', true);\" name=\"pris[{$this->var->pristup["azam"]["sso"]}]\" ".($pole[$this->var->pristup["azam"]["sso"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["azam"]["sso"]}\" /> {$this->var->jazyk["zam_sumsour"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp23', true);\" name=\"pris[{$this->var->pristup["azam"]["mat"]}]\" ".($pole[$this->var->pristup["azam"]["mat"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["azam"]["mat"]}\" /> {$this->var->jazyk["zam_mat"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp23', true);\" name=\"pris[{$this->var->pristup["azam"]["str"]}]\" ".($pole[$this->var->pristup["azam"]["str"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["azam"]["str"]}\" /> {$this->var->jazyk["zam_stredni"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp23', true);\" name=\"pris[{$this->var->pristup["azam"]["tst"]}]\" ".($pole[$this->var->pristup["azam"]["tst"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["azam"]["tst"]}\" /> {$this->var->jazyk["zam_typstredni"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp23', true);\" name=\"pris[{$this->var->pristup["azam"]["vys"]}]\" ".($pole[$this->var->pristup["azam"]["vys"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["azam"]["vys"]}\" /> {$this->var->jazyk["zam_vyska"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp23', true);\" name=\"pris[{$this->var->pristup["azam"]["tvy"]}]\" ".($pole[$this->var->pristup["azam"]["tvy"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["azam"]["tvy"]}\" /> {$this->var->jazyk["zam_typvyska"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp23', true);\" name=\"pris[{$this->var->pristup["azam"]["obo"]}]\" ".($pole[$this->var->pristup["azam"]["obo"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["azam"]["obo"]}\" /> {$this->var->jazyk["zam_obor"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp23', true);\" name=\"pris[{$this->var->pristup["azam"]["tyt"]}]\" ".($pole[$this->var->pristup["azam"]["tyt"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["azam"]["tyt"]}\" /> {$this->var->jazyk["zam_tytul"]}</li>
                    </ol>
                  </li>
                  <li><input type=\"checkbox\" onclick=\"OznacElement('h2', true);\" id=\"hp24\" name=\"pris[{$this->var->pristup["zamestnanci"]["edit"]}]\" ".($pole[$this->var->pristup["zamestnanci"]["edit"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["zamestnanci"]["edit"]}\" /> {$this->var->jazyk["edit_zamestnanec"]}
                    <ol>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp24', true);\" name=\"pris[{$this->var->pristup["ezam"]["log"]}]\" ".($pole[$this->var->pristup["ezam"]["log"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["ezam"]["log"]}\" /> {$this->var->jazyk["zam_log"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp24', true);\" name=\"pris[{$this->var->pristup["ezam"]["hes"]}]\" ".($pole[$this->var->pristup["ezam"]["hes"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["ezam"]["hes"]}\" /> {$this->var->jazyk["zam_hes"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp24', true);\" name=\"pris[{$this->var->pristup["ezam"]["hre"]}]\" ".($pole[$this->var->pristup["ezam"]["hre"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["ezam"]["hre"]}\" /> {$this->var->jazyk["zam_hesrep"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp24', true);\" name=\"pris[{$this->var->pristup["ezam"]["jme"]}]\" ".($pole[$this->var->pristup["ezam"]["jme"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["ezam"]["jme"]}\" /> {$this->var->jazyk["zam_jmeno"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp24', true);\" name=\"pris[{$this->var->pristup["ezam"]["pri"]}]\" ".($pole[$this->var->pristup["ezam"]["pri"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["ezam"]["pri"]}\" /> {$this->var->jazyk["zam_prim"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp24', true);\" name=\"pris[{$this->var->pristup["ezam"]["pra"]}]\" ".($pole[$this->var->pristup["ezam"]["pra"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["ezam"]["pra"]}\" /> {$this->var->jazyk["zam_prava"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp24', true);\" name=\"pris[{$this->var->pristup["ezam"]["uli"]}]\" ".($pole[$this->var->pristup["ezam"]["uli"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["ezam"]["uli"]}\" /> {$this->var->jazyk["zam_ulice"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp24', true);\" name=\"pris[{$this->var->pristup["ezam"]["cp"]}]\" ".($pole[$this->var->pristup["ezam"]["cp"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["ezam"]["cp"]}\" /> {$this->var->jazyk["zam_cp"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp24', true);\" name=\"pris[{$this->var->pristup["ezam"]["psc"]}]\" ".($pole[$this->var->pristup["ezam"]["psc"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["ezam"]["psc"]}\" /> {$this->var->jazyk["zam_psc"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp24', true);\" name=\"pris[{$this->var->pristup["ezam"]["mes"]}]\" ".($pole[$this->var->pristup["ezam"]["mes"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["ezam"]["mes"]}\" /> {$this->var->jazyk["zam_mesto"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp24', true);\" name=\"pris[{$this->var->pristup["ezam"]["zem"]}]\" ".($pole[$this->var->pristup["ezam"]["zem"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["ezam"]["zem"]}\" /> {$this->var->jazyk["zam_zeme"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp24', true);\" name=\"pris[{$this->var->pristup["ezam"]["te1"]}]\" ".($pole[$this->var->pristup["ezam"]["te1"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["ezam"]["te1"]}\" /> {$this->var->jazyk["zam_tel1"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp24', true);\" name=\"pris[{$this->var->pristup["ezam"]["te2"]}]\" ".($pole[$this->var->pristup["ezam"]["te2"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["ezam"]["te2"]}\" /> {$this->var->jazyk["zam_tel2"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp24', true);\" name=\"pris[{$this->var->pristup["ezam"]["ema"]}]\" ".($pole[$this->var->pristup["ezam"]["ema"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["ezam"]["ema"]}\" /> {$this->var->jazyk["zam_email"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp24', true);\" name=\"pris[{$this->var->pristup["ezam"]["dna"]}]\" ".($pole[$this->var->pristup["ezam"]["dna"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["ezam"]["dna"]}\" /> {$this->var->jazyk["zam_datnar"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp24', true);\" name=\"pris[{$this->var->pristup["ezam"]["jaz"]}]\" ".($pole[$this->var->pristup["ezam"]["jaz"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["ezam"]["jaz"]}\" /> {$this->var->jazyk["zam_jazyk"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp24', true);\" name=\"pris[{$this->var->pristup["ezam"]["vzd"]}]\" ".($pole[$this->var->pristup["ezam"]["vzd"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["ezam"]["vzd"]}\" /> {$this->var->jazyk["zam_vzdelani"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp24', true);\" name=\"pris[{$this->var->pristup["ezam"]["rid"]}]\" ".($pole[$this->var->pristup["ezam"]["rid"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["ezam"]["rid"]}\" /> {$this->var->jazyk["zam_ridicak"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp24', true);\" name=\"pris[{$this->var->pristup["ezam"]["poh"]}]\" ".($pole[$this->var->pristup["ezam"]["poh"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["ezam"]["poh"]}\" /> {$this->var->jazyk["zam_pohlavi"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp24', true);\" name=\"pris[{$this->var->pristup["ezam"]["dos"]}]\" ".($pole[$this->var->pristup["ezam"]["dos"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["ezam"]["dos"]}\" /> {$this->var->jazyk["zam_datosloveni"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp24', true);\" name=\"pris[{$this->var->pristup["ezam"]["dzi"]}]\" ".($pole[$this->var->pristup["ezam"]["dzi"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["ezam"]["dzi"]}\" /> {$this->var->jazyk["zam_datzivot"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp24', true);\" name=\"pris[{$this->var->pristup["ezam"]["dpo"]}]\" ".($pole[$this->var->pristup["ezam"]["dpo"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["ezam"]["dpo"]}\" /> {$this->var->jazyk["zam_datpoh"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp24', true);\" name=\"pris[{$this->var->pristup["ezam"]["dza"]}]\" ".($pole[$this->var->pristup["ezam"]["dza"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["ezam"]["dza"]}\" /> {$this->var->jazyk["zam_datzac"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp24', true);\" name=\"pris[{$this->var->pristup["ezam"]["dod"]}]\" ".($pole[$this->var->pristup["ezam"]["dod"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["ezam"]["dod"]}\" /> {$this->var->jazyk["zam_datodmit"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp24', true);\" name=\"pris[{$this->var->pristup["ezam"]["dko"]}]\" ".($pole[$this->var->pristup["ezam"]["dko"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["ezam"]["dko"]}\" /> {$this->var->jazyk["zam_konprac"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp24', true);\" name=\"pris[{$this->var->pristup["ezam"]["sta"]}]\" ".($pole[$this->var->pristup["ezam"]["sta"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["ezam"]["sta"]}\" /> {$this->var->jazyk["zam_status"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp24', true);\" name=\"pris[{$this->var->pristup["ezam"]["exi"]}]\" ".($pole[$this->var->pristup["ezam"]["exi"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["ezam"]["exi"]}\" /> {$this->var->jazyk["zam_existfoto"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp24', true);\" name=\"pris[{$this->var->pristup["ezam"]["hob"]}]\" ".($pole[$this->var->pristup["ezam"]["hob"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["ezam"]["hob"]}\" /> {$this->var->jazyk["zam_hobby"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp24', true);\" name=\"pris[{$this->var->pristup["ezam"]["spo"]}]\" ".($pole[$this->var->pristup["ezam"]["spo"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["ezam"]["spo"]}\" /> {$this->var->jazyk["zam_sport"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp24', true);\" name=\"pris[{$this->var->pristup["ezam"]["rod"]}]\" ".($pole[$this->var->pristup["ezam"]["rod"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["ezam"]["rod"]}\" /> {$this->var->jazyk["zam_rodiste"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp24', true);\" name=\"pris[{$this->var->pristup["ezam"]["mze"]}]\" ".($pole[$this->var->pristup["ezam"]["mze"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["ezam"]["mze"]}\" /> {$this->var->jazyk["zam_zemenaroz"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp24', true);\" name=\"pris[{$this->var->pristup["ezam"]["mja"]}]\" ".($pole[$this->var->pristup["ezam"]["mja"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["ezam"]["mja"]}\" /> {$this->var->jazyk["zam_matjazyk"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp24', true);\" name=\"pris[{$this->var->pristup["ezam"]["jot"]}]\" ".($pole[$this->var->pristup["ezam"]["jot"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["ezam"]["jot"]}\" /> {$this->var->jazyk["zam_jmotce"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp24', true);\" name=\"pris[{$this->var->pristup["ezam"]["pro"]}]\" ".($pole[$this->var->pristup["ezam"]["pro"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["ezam"]["pro"]}\" /> {$this->var->jazyk["zam_prijotce"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp24', true);\" name=\"pris[{$this->var->pristup["ezam"]["pot"]}]\" ".($pole[$this->var->pristup["ezam"]["pot"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["ezam"]["pot"]}\" /> {$this->var->jazyk["zam_povotce"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp24', true);\" name=\"pris[{$this->var->pristup["ezam"]["jma"]}]\" ".($pole[$this->var->pristup["ezam"]["jma"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["ezam"]["jma"]}\" /> {$this->var->jazyk["zam_jmmatky"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp24', true);\" name=\"pris[{$this->var->pristup["ezam"]["prm"]}]\" ".($pole[$this->var->pristup["ezam"]["prm"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["ezam"]["prm"]}\" /> {$this->var->jazyk["zam_prijmatky"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp24', true);\" name=\"pris[{$this->var->pristup["ezam"]["pma"]}]\" ".($pole[$this->var->pristup["ezam"]["pma"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["ezam"]["pma"]}\" /> {$this->var->jazyk["zam_povmatky"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp24', true);\" name=\"pris[{$this->var->pristup["ezam"]["pob"]}]\" ".($pole[$this->var->pristup["ezam"]["pob"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["ezam"]["pob"]}\" /> {$this->var->jazyk["zam_pocbrat"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp24', true);\" name=\"pris[{$this->var->pristup["ezam"]["pos"]}]\" ".($pole[$this->var->pristup["ezam"]["pos"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["ezam"]["pos"]}\" /> {$this->var->jazyk["zam_pocsest"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp24', true);\" name=\"pris[{$this->var->pristup["ezam"]["sso"]}]\" ".($pole[$this->var->pristup["ezam"]["sso"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["ezam"]["sso"]}\" /> {$this->var->jazyk["zam_sumsour"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp24', true);\" name=\"pris[{$this->var->pristup["ezam"]["mat"]}]\" ".($pole[$this->var->pristup["ezam"]["mat"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["ezam"]["mat"]}\" /> {$this->var->jazyk["zam_mat"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp24', true);\" name=\"pris[{$this->var->pristup["ezam"]["str"]}]\" ".($pole[$this->var->pristup["ezam"]["str"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["ezam"]["str"]}\" /> {$this->var->jazyk["zam_stredni"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp24', true);\" name=\"pris[{$this->var->pristup["ezam"]["tst"]}]\" ".($pole[$this->var->pristup["ezam"]["tst"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["ezam"]["tst"]}\" /> {$this->var->jazyk["zam_typstredni"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp24', true);\" name=\"pris[{$this->var->pristup["ezam"]["vys"]}]\" ".($pole[$this->var->pristup["ezam"]["vys"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["ezam"]["vys"]}\" /> {$this->var->jazyk["zam_vyska"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp24', true);\" name=\"pris[{$this->var->pristup["ezam"]["tvy"]}]\" ".($pole[$this->var->pristup["ezam"]["tvy"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["ezam"]["tvy"]}\" /> {$this->var->jazyk["zam_typvyska"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp24', true);\" name=\"pris[{$this->var->pristup["ezam"]["obo"]}]\" ".($pole[$this->var->pristup["ezam"]["obo"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["ezam"]["obo"]}\" /> {$this->var->jazyk["zam_obor"]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp24', true);\" name=\"pris[{$this->var->pristup["ezam"]["tyt"]}]\" ".($pole[$this->var->pristup["ezam"]["tyt"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["ezam"]["tyt"]}\" /> {$this->var->jazyk["zam_tytul"]}</li>
                    </ol>
                  </li>
                  <li><input type=\"checkbox\" onclick=\"OznacElement('h2', true);\" id=\"hp25\" name=\"pris[{$this->var->pristup["zamestnanci"]["del"]}]\" ".($pole[$this->var->pristup["zamestnanci"]["del"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["zamestnanci"]["del"]}\" /> {$this->var->jazyk["del_zamestnanec"]}</li>
                  <li><input type=\"checkbox\" onclick=\"OznacElement('h2', true);\" id=\"hp26\" name=\"pris[{$this->var->pristup["zamestnanci"]["search"]}]\" ".($pole[$this->var->pristup["zamestnanci"]["search"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["zamestnanci"]["search"]}\" /> {$this->var->jazyk["search_zamestnanec"]}</li>
                  <li><input type=\"checkbox\" onclick=\"OznacElement('h2', true);\" id=\"hp27\" name=\"pris[{$this->var->pristup["zamestnanci"]["kompetence"]}]\" ".($pole[$this->var->pristup["zamestnanci"]["kompetence"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["zamestnanci"]["kompetence"]}\" /> {$this->var->jazyk["kompetence_zamestnanec"]}</li>
                  <li><input type=\"checkbox\" onclick=\"OznacElement('h2', true);\" id=\"hp28\" name=\"pris[{$this->var->pristup["zamestnanci"]["foto"]}]\" ".($pole[$this->var->pristup["zamestnanci"]["foto"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["zamestnanci"]["foto"]}\" /> {$this->var->jazyk["fotografie_zamestnanec"]}</li>
                  <li><input type=\"checkbox\" onclick=\"OznacElement('h2', true);\" id=\"hp29\" name=\"pris[{$this->var->pristup["zamestnanci"]["doba"]}]\" ".($pole[$this->var->pristup["zamestnanci"]["doba"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["zamestnanci"]["doba"]}\" /> {$this->var->jazyk["doba_zamestnanec"]}</li>
                  <li><input type=\"checkbox\" onclick=\"OznacElement('h2', true);\" id=\"hp210\" name=\"pris[{$this->var->pristup["zamestnanci"]["terminy"]}]\" ".($pole[$this->var->pristup["zamestnanci"]["terminy"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["zamestnanci"]["terminy"]}\" /> {$this->var->jazyk["terminy_zamestnanec"]}</li>
                  <li><input type=\"checkbox\" onclick=\"OznacElement('h2', true);\" id=\"hp211\" name=\"pris[{$this->var->pristup["zamestnanci"]["statistika"]}]\" ".($pole[$this->var->pristup["zamestnanci"]["statistika"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["zamestnanci"]["statistika"]}\" /> {$this->var->jazyk["statistika_zamestnanec"]}</li>
                  <li><input type=\"checkbox\" onclick=\"OznacElement('h2', true);\" id=\"hp212\" name=\"pris[{$this->var->pristup["zamestnanci"]["naklady"]}]\" ".($pole[$this->var->pristup["zamestnanci"]["naklady"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["zamestnanci"]["naklady"]}\" /> {$this->var->jazyk["naklady_zamestnanec"]}</li>
                  <li><input type=\"checkbox\" onclick=\"OznacElement('h2', true);\" id=\"hp213\" name=\"pris[{$this->var->pristup["zamestnanci"]["prava"]}]\" ".($pole[$this->var->pristup["zamestnanci"]["prava"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["zamestnanci"]["prava"]}\" /> {$this->var->jazyk["prava_zamestnanec"]}??????????</li>
                  <li><input type=\"checkbox\" onclick=\"OznacElement('h2', true);\" id=\"hp214\" name=\"pris[{$this->var->pristup["zamestnanci"]["protokoly"]}]\" ".($pole[$this->var->pristup["zamestnanci"]["protokoly"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["zamestnanci"]["protokoly"]}\" /> {$this->var->jazyk["protokoly_zamestnanec"]}</li>
                </ol>
              </li>
              <li><input type=\"checkbox\" id=\"h3\" name=\"pris[{$this->var->pristup["partneri"][""]}]\" ".($pole[$this->var->pristup["partneri"][""]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["partneri"][""]}\" /> {$this->var->jazyk["partneri"]}
                <ol>
                  <li><input type=\"checkbox\" onclick=\"OznacElement('h3', true);\" id=\"hp31\" name=\"pris[{$this->var->pristup["partneri"]["all"]}]\" ".($pole[$this->var->pristup["partneri"]["all"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["partneri"]["all"]}\" /> {$this->var->jazyk["all_partner"]}</li>
                  <li><input type=\"checkbox\" onclick=\"OznacElement('h3', true);\" id=\"hp32\" name=\"pris[{$this->var->pristup["partneri"]["info"]}]\" ".($pole[$this->var->pristup["partneri"]["info"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["partneri"]["info"]}\" /> {$this->var->jazyk["info"]}
                    <ol>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp32', true);\" name=\"pris[{$this->var->pristup[""][""]}]\" ".($pole[$this->var->pristup[""][""]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup[""][""]}\" /> {$this->var->jazyk[""]}</li>
                      <li><input type=\"checkbox\" onclick=\"OznacElement('hp32', true);\" name=\"pris[{$this->var->pristup[""][""]}]\" ".($pole[$this->var->pristup[""][""]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup[""][""]}\" /> {$this->var->jazyk[""]}</li>
                    </ol>
                  </li>
                  <li><input type=\"checkbox\" onclick=\"OznacElement('h3', true);\" id=\"hp33\" name=\"pris[{$this->var->pristup["partneri"]["add"]}]\" ".($pole[$this->var->pristup["partneri"]["add"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["partneri"]["add"]}\" /> {$this->var->jazyk["add_partner"]}</li>
                  <li><input type=\"checkbox\" onclick=\"OznacElement('h3', true);\" id=\"hp34\" name=\"pris[{$this->var->pristup["partneri"]["edit"]}]\" ".($pole[$this->var->pristup["partneri"]["edit"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["partneri"]["edit"]}\" /> {$this->var->jazyk["edit_partner"]}</li>
                  <li><input type=\"checkbox\" onclick=\"OznacElement('h3', true);\" id=\"hp35\" name=\"pris[{$this->var->pristup["partneri"]["del"]}]\" ".($pole[$this->var->pristup["partneri"]["del"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["partneri"]["del"]}\" /> {$this->var->jazyk["del_partner"]}</li>
                  <li><input type=\"checkbox\" onclick=\"OznacElement('h3', true);\" id=\"hp36\" name=\"pris[{$this->var->pristup["partneri"]["search"]}]\" ".($pole[$this->var->pristup["partneri"]["search"]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup["partneri"]["search"]}\" /> {$this->var->jazyk["search_partner"]}</li>
                </ol>
              </li>
              <li><input type=\"checkbox\" id=\"h4\" name=\"pris[{$this->var->pristup[""][""]}]\" ".($pole[$this->var->pristup[""][""]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup[""][""]}\" /> {$this->var->jazyk[""]}
                <ol>
                  <li><input type=\"checkbox\" onclick=\"OznacElement('h4', true);\" name=\"pris[{$this->var->pristup[""][""]}]\" ".($pole[$this->var->pristup[""][""]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup[""][""]}\" /> {$this->var->jazyk[""]}</li>
                  <li><input type=\"checkbox\" onclick=\"OznacElement('h4', true);\" name=\"pris[{$this->var->pristup[""][""]}]\" ".($pole[$this->var->pristup[""][""]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup[""][""]}\" /> {$this->var->jazyk[""]}</li>
                  <li><input type=\"checkbox\" onclick=\"OznacElement('h4', true);\" name=\"pris[{$this->var->pristup[""][""]}]\" ".($pole[$this->var->pristup[""][""]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup[""][""]}\" /> {$this->var->jazyk[""]}</li>
                  <li><input type=\"checkbox\" onclick=\"OznacElement('h4', true);\" name=\"pris[{$this->var->pristup[""][""]}]\" ".($pole[$this->var->pristup[""][""]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup[""][""]}\" /> {$this->var->jazyk[""]}</li>
                  <li><input type=\"checkbox\" onclick=\"OznacElement('h4', true);\" name=\"pris[{$this->var->pristup[""][""]}]\" ".($pole[$this->var->pristup[""][""]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup[""][""]}\" /> {$this->var->jazyk[""]}</li>
                  <li><input type=\"checkbox\" onclick=\"OznacElement('h4', true);\" name=\"pris[{$this->var->pristup[""][""]}]\" ".($pole[$this->var->pristup[""][""]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup[""][""]}\" /> {$this->var->jazyk[""]}</li>
                  <li><input type=\"checkbox\" onclick=\"OznacElement('h4', true);\" name=\"pris[{$this->var->pristup[""][""]}]\" ".($pole[$this->var->pristup[""][""]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup[""][""]}\" /> {$this->var->jazyk[""]}</li>
                  <li><input type=\"checkbox\" onclick=\"OznacElement('h4', true);\" name=\"pris[{$this->var->pristup[""][""]}]\" ".($pole[$this->var->pristup[""][""]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup[""][""]}\" /> {$this->var->jazyk[""]}</li>
                  <li><input type=\"checkbox\" onclick=\"OznacElement('h4', true);\" name=\"pris[{$this->var->pristup[""][""]}]\" ".($pole[$this->var->pristup[""][""]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup[""][""]}\" /> {$this->var->jazyk[""]}</li>
                </ol>
              </li>
              <li><input type=\"checkbox\" id=\"h5\" name=\"pris[{$this->var->pristup[""][""]}]\" ".($pole[$this->var->pristup[""][""]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup[""][""]}\" /> {$this->var->jazyk[""]}
                <ol>
                  <li><input type=\"checkbox\" onclick=\"OznacElement('h5', true);\" name=\"pris[{$this->var->pristup[""][""]}]\" ".($pole[$this->var->pristup[""][""]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup[""][""]}\" /> {$this->var->jazyk[""]}</li>
                  <li><input type=\"checkbox\" onclick=\"OznacElement('h5', true);\" name=\"pris[{$this->var->pristup[""][""]}]\" ".($pole[$this->var->pristup[""][""]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup[""][""]}\" /> {$this->var->jazyk[""]}</li>
                  <li><input type=\"checkbox\" onclick=\"OznacElement('h5', true);\" name=\"pris[{$this->var->pristup[""][""]}]\" ".($pole[$this->var->pristup[""][""]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup[""][""]}\" /> {$this->var->jazyk[""]}</li>
                  <li><input type=\"checkbox\" onclick=\"OznacElement('h5', true);\" name=\"pris[{$this->var->pristup[""][""]}]\" ".($pole[$this->var->pristup[""][""]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup[""][""]}\" /> {$this->var->jazyk[""]}</li>
                  <li><input type=\"checkbox\" onclick=\"OznacElement('h5', true);\" name=\"pris[{$this->var->pristup[""][""]}]\" ".($pole[$this->var->pristup[""][""]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup[""][""]}\" /> {$this->var->jazyk[""]}</li>
                  <li><input type=\"checkbox\" onclick=\"OznacElement('h5', true);\" name=\"pris[{$this->var->pristup[""][""]}]\" ".($pole[$this->var->pristup[""][""]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup[""][""]}\" /> {$this->var->jazyk[""]}</li>
                  <li><input type=\"checkbox\" onclick=\"OznacElement('h5', true);\" name=\"pris[{$this->var->pristup[""][""]}]\" ".($pole[$this->var->pristup[""][""]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup[""][""]}\" /> {$this->var->jazyk[""]}</li>
                  <li><input type=\"checkbox\" onclick=\"OznacElement('h5', true);\" name=\"pris[{$this->var->pristup[""][""]}]\" ".($pole[$this->var->pristup[""][""]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup[""][""]}\" /> {$this->var->jazyk[""]}</li>
                  <li><input type=\"checkbox\" onclick=\"OznacElement('h5', true);\" name=\"pris[{$this->var->pristup[""][""]}]\" ".($pole[$this->var->pristup[""][""]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup[""][""]}\" /> {$this->var->jazyk[""]}</li>
                </ol>
              </li>
              <li><input type=\"checkbox\" name=\"pris[{$this->var->pristup[""][""]}]\" ".($pole[$this->var->pristup[""][""]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup[""][""]}\" /> {$this->var->jazyk[""]}</li>
              <li><input type=\"checkbox\" name=\"pris[{$this->var->pristup[""][""]}]\" ".($pole[$this->var->pristup[""][""]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup[""][""]}\" /> {$this->var->jazyk[""]}</li>
              <li><input type=\"checkbox\" name=\"pris[{$this->var->pristup[""][""]}]\" ".($pole[$this->var->pristup[""][""]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup[""][""]}\" /> {$this->var->jazyk[""]}</li>
              <li><input type=\"checkbox\" name=\"pris[{$this->var->pristup[""][""]}]\" ".($pole[$this->var->pristup[""][""]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup[""][""]}\" /> {$this->var->jazyk[""]}</li>
              <li><input type=\"checkbox\" name=\"pris[{$this->var->pristup[""][""]}]\" ".($pole[$this->var->pristup[""][""]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup[""][""]}\" /> {$this->var->jazyk[""]}</li>
              <li><input type=\"checkbox\" name=\"pris[{$this->var->pristup[""][""]}]\" ".($pole[$this->var->pristup[""][""]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup[""][""]}\" /> {$this->var->jazyk[""]}</li>
              <li><input type=\"checkbox\" name=\"pris[{$this->var->pristup[""][""]}]\" ".($pole[$this->var->pristup[""][""]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup[""][""]}\" /> {$this->var->jazyk[""]}</li>
              <li><input type=\"checkbox\" name=\"pris[{$this->var->pristup[""][""]}]\" ".($pole[$this->var->pristup[""][""]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup[""][""]}\" /> {$this->var->jazyk[""]}</li>
              <li><input type=\"checkbox\" name=\"pris[{$this->var->pristup[""][""]}]\" ".($pole[$this->var->pristup[""][""]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup[""][""]}\" /> {$this->var->jazyk[""]}</li>
              <li><input type=\"checkbox\" name=\"pris[{$this->var->pristup[""][""]}]\" ".($pole[$this->var->pristup[""][""]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup[""][""]}\" /> {$this->var->jazyk[""]}</li>
              <li><input type=\"checkbox\" name=\"pris[{$this->var->pristup[""][""]}]\" ".($pole[$this->var->pristup[""][""]] ? "checked=\"checked\"" : "")." value=\"{$this->var->pristup[""][""]}\" /> {$this->var->jazyk[""]}</li>
            </ol>
//******************************************************************************
/*
// p r á v a *******************************************************************
              case "addprava":
                $out = include "{$this->var->form}/add_prava_zamestnanec.php";

                if (!Empty($_POST["addprava"]) &&
                    !Empty($_POST["tlacitko"]))
                {
                  $out = $this->ZamestnanecPridatPrava();
                }

                $result .= $out;
              break;
              //****************************************************************
              case "editdelprava":
                $id = $_GET["cislo"];
                settype($id, "integer");
                if ($res = @$this->var->mysqli->query("SELECT prava FROM prava WHERE id=$id"))
                {
                  $data = $res->fetch_object();
                }
                  else
                {
                  $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
                }

                switch($_GET["subco"])
                {
                  //************************************************************
                  case "edit":
                    if (!Empty($id))
                    {
                      $out = include "{$this->var->form}/edit_prava_zamestnanec.php";
                    }

                    if (!Empty($_POST["editprava"]) &&
                        !Empty($_POST["tlacitko"]) &&
                        !Empty($id))
                    {
                      $out = $this->ZamestnanecUpravitPrava($id);
                    }
                  break;
                  //************************************************************
                  case "del":
                    if (!Empty($id))
                    {
                      $out = include "{$this->var->form}/del_prava_zamestnanec.php";
                    }

                    if (!Empty($_POST["ano"]) &&
                        !Empty($id))
                    {
                      $out = $this->ZamestnanecSmazatPrava($id);
                    }
                      else
                    {
                      if (!Empty($_POST["ne"]))
                      {
                        $out = include "{$this->var->form}/del_false.php";
                      }
                    }
                  break;
                  //************************************************************
                }

                $result .= include "{$this->var->form}/editdel_prava_zamestnanec.php";
              break;
// z e m  e ********************************************************************
              case "addzeme":
                $out = include "{$this->var->form}/add_zeme_zamestnanec.php";

                if (!Empty($_POST["addzeme"]) &&
                    !Empty($_POST["tlacitko"]))
                {
                  $out = $this->ZamestnanecPridatZeme();
                }

                $result .= $out;
              break;
              //****************************************************************
              case "editdelzeme":
                $id = $_GET["cislo"];
                settype($id, "integer");
                if ($res = @$this->var->mysqli->query("SELECT zeme FROM zeme WHERE id=$id"))
                {
                  $data = $res->fetch_object();
                }
                  else
                {
                  $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
                }

                switch($_GET["subco"])
                {
                  //************************************************************
                  case "edit":
                    if (!Empty($id))
                    {
                      $out = include "{$this->var->form}/edit_zeme_zamestnanec.php";
                    }

                    if (!Empty($_POST["editzeme"]) &&
                        !Empty($_POST["tlacitko"]) &&
                        !Empty($id))
                    {
                      $out = $this->ZamestnanecUpravitZeme($id);
                    }
                  break;
                  //************************************************************
                  case "del":
                    if (!Empty($id))
                    {
                      $out = include "{$this->var->form}/del_zeme_zamestnanec.php";
                    }

                    if (!Empty($_POST["ano"]) &&
                        !Empty($id))
                    {
                      $out = $this->ZamestnanecSmazatZeme($id);
                    }
                      else
                    {
                      if (!Empty($_POST["ne"]))
                      {
                        $out = include "{$this->var->form}/del_false.php";
                      }
                    }
                  break;
                  //************************************************************
                }

                $result .= include "{$this->var->form}/editdel_zeme_zamestnanec.php";
              break;
// j a z y k *******************************************************************
              case "addjazyk":
                $out = include "{$this->var->form}/add_jazyk_zamestnanec.php";

                if (!Empty($_POST["addjazyk"]) &&
                    !Empty($_POST["tlacitko"]))
                {
                  $out = $this->ZamestnanecPridatJazyk();
                }

                $result .= $out;
              break;
              //****************************************************************
              case "editdeljazyk":
                $id = $_GET["cislo"];
                settype($id, "integer");
                if ($res = @$this->var->mysqli->query("SELECT jazyk FROM jazyk WHERE id=$id"))
                {
                  $data = $res->fetch_object();
                }
                  else
                {
                  $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
                }

                switch($_GET["subco"])
                {
                  //************************************************************
                  case "edit":
                    if (!Empty($id))
                    {
                      $out = include "{$this->var->form}/edit_jazyk_zamestnanec.php";
                    }

                    if (!Empty($_POST["editjazyk"]) &&
                        !Empty($_POST["tlacitko"]) &&
                        !Empty($id))
                    {
                      $out = $this->ZamestnanecUpravitJazyk($id);
                    }
                  break;
                  //************************************************************
                  case "del":
                    if (!Empty($id))
                    {
                      $out = include "{$this->var->form}/del_jazyk_zamestnanec.php";
                    }

                    if (!Empty($_POST["ano"]) &&
                        !Empty($id))
                    {
                      $out = $this->ZamestnanecSmazatJazyk($id);
                    }
                      else
                    {
                      if (!Empty($_POST["ne"]))
                      {
                        $out = include "{$this->var->form}/del_false.php";
                      }
                    }
                  break;
                  //************************************************************
                }

                $result .= include "{$this->var->form}/editdel_jazyk_zamestnanec.php";
              break;
// h o b b y *******************************************************************
              case "addhobby":
                $out = include "{$this->var->form}/add_hobby_zamestnanec.php";

                if (!Empty($_POST["addhobby"]) &&
                    !Empty($_POST["tlacitko"]))
                {
                  $out = $this->ZamestnanecPridatHobby();
                }

                $result .= $out;
              break;
              //****************************************************************
              case "editdelhobby":
                $id = $_GET["cislo"];
                settype($id, "integer");
                if ($res = @$this->var->mysqli->query("SELECT hobby FROM hobby WHERE id=$id"))
                {
                  $data = $res->fetch_object();
                }
                  else
                {
                  $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
                }

                switch($_GET["subco"])
                {
                  //************************************************************
                  case "edit":
                    if (!Empty($id))
                    {
                      $out = include "{$this->var->form}/edit_hobby_zamestnanec.php";
                    }

                    if (!Empty($_POST["edithobby"]) &&
                        !Empty($_POST["tlacitko"]) &&
                        !Empty($id))
                    {
                      $out = $this->ZamestnanecUpravitHobby($id);
                    }
                  break;
                  //************************************************************
                  case "del":
                    if (!Empty($id))
                    {
                      $out = include "{$this->var->form}/del_hobby_zamestnanec.php";
                    }

                    if (!Empty($_POST["ano"]) &&
                        !Empty($id))
                    {
                      $out = $this->ZamestnanecSmazatHobby($id);
                    }
                      else
                    {
                      if (!Empty($_POST["ne"]))
                      {
                        $out = include "{$this->var->form}/del_false.php";
                      }
                    }
                  break;
                  //************************************************************
                }

                $result .= include "{$this->var->form}/editdel_hobby_zamestnanec.php";
              break;
//s p o r t ********************************************************************
              case "addsport":
                $out = include "{$this->var->form}/add_sport_zamestnanec.php";

                if (!Empty($_POST["addsport"]) &&
                    !Empty($_POST["tlacitko"]))
                {
                  $out = $this->ZamestnanecPridatSport();
                }

                $result .= $out;
              break;
              //****************************************************************
              case "editdelsport":
                $id = $_GET["cislo"];
                settype($id, "integer");
                if ($res = @$this->var->mysqli->query("SELECT sport FROM sport WHERE id=$id"))
                {
                  $data = $res->fetch_object();
                }
                  else
                {
                  $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
                }

                switch($_GET["subco"])
                {
                  //************************************************************
                  case "edit":
                    if (!Empty($id))
                    {
                      $out = include "{$this->var->form}/edit_sport_zamestnanec.php";
                    }

                    if (!Empty($_POST["editsport"]) &&
                        !Empty($_POST["tlacitko"]) &&
                        !Empty($id))
                    {
                      $out = $this->ZamestnanecUpravitSport($id);
                    }
                  break;
                  //************************************************************
                  case "del":
                    if (!Empty($id))
                    {
                      $out = include "{$this->var->form}/del_sport_zamestnanec.php";
                    }

                    if (!Empty($_POST["ano"]) &&
                        !Empty($id))
                    {
                      $out = $this->ZamestnanecSmazatSport($id);
                    }
                      else
                    {
                      if (!Empty($_POST["ne"]))
                      {
                        $out = include "{$this->var->form}/del_false.php";
                      }
                    }
                  break;
                  //************************************************************
                }

                $result .= include "{$this->var->form}/editdel_sport_zamestnanec.php";
              break;
// v y s k a *******************************************************************
              case "addvyska":
                $out = include "{$this->var->form}/add_vyska_zamestnanec.php";

                if (!Empty($_POST["addvyska"]) &&
                    !Empty($_POST["tlacitko"]))
                {
                  $out = $this->ZamestnanecPridatVyska();
                }

                $result .= $out;
              break;
              //****************************************************************
              case "editdelvyska":
                $id = $_GET["cislo"];
                settype($id, "integer");
                if ($res = @$this->var->mysqli->query("SELECT typ FROM typvysoke WHERE id=$id"))
                {
                  $data = $res->fetch_object();
                }
                  else
                {
                  $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
                }

                switch($_GET["subco"])
                {
                  //************************************************************
                  case "edit":
                    if (!Empty($id))
                    {
                      $out = include "{$this->var->form}/edit_vyska_zamestnanec.php";
                    }

                    if (!Empty($_POST["editvyska"]) &&
                        !Empty($_POST["tlacitko"]) &&
                        !Empty($id))
                    {
                      $out = $this->ZamestnanecUpravitVyska($id);
                    }
                  break;
                  //************************************************************
                  case "del":
                    if (!Empty($id))
                    {
                      $out = include "{$this->var->form}/del_vyska_zamestnanec.php";
                    }

                    if (!Empty($_POST["ano"]) &&
                        !Empty($id))
                    {
                      $out = $this->ZamestnanecSmazatVyska($id);
                    }
                      else
                    {
                      if (!Empty($_POST["ne"]))
                      {
                        $out = include "{$this->var->form}/del_false.php";
                      }
                    }
                  break;
                  //************************************************************
                }

                $result .= include "{$this->var->form}/editdel_vyska_zamestnanec.php";
              break;
              //****************************************************************
              
                (<a href=\"?action=zamestnanci&amp;akce=add&amp;co=addprava\">{$this->var->jazyk["add"]}</a>)<-bude přesunuto do adminu
                (<a href=\"?action=zamestnanci&amp;akce=add&amp;co=editdelprava\">{$this->var->jazyk["edit"]} / {$this->var->jazyk["del"]})</a><br /><br />

                (<a href=\"?action=zamestnanci&amp;akce=add&amp;co=addzeme\">{$this->var->jazyk["add"]}</a>)
                (<a href=\"?action=zamestnanci&amp;akce=add&amp;co=editdelzeme\">{$this->var->jazyk["edit"]} / {$this->var->jazyk["del"]})</a><br /><br />
                
                (<a href=\"?action=zamestnanci&amp;akce=add&amp;co=addjazyk\">{$this->var->jazyk["add"]}</a>)
                (<a href=\"?action=zamestnanci&amp;akce=add&amp;co=editdeljazyk\">{$this->var->jazyk["edit"]} / {$this->var->jazyk["del"]})</a><br /><br />

                (<a href=\"?action=zamestnanci&amp;akce=add&amp;co=addhobby\">{$this->var->jazyk["add"]}</a>)
                (<a href=\"?action=zamestnanci&amp;akce=add&amp;co=editdelhobby\">{$this->var->jazyk["edit"]} / {$this->var->jazyk["del"]})</a><br /><br />

                (<a href=\"?action=zamestnanci&amp;akce=add&amp;co=addsport\">{$this->var->jazyk["add"]}</a>)
                (<a href=\"?action=zamestnanci&amp;akce=add&amp;co=editdelsport\">{$this->var->jazyk["edit"]} / {$this->var->jazyk["del"]})</a><br /><br />

                (<a href=\"?action=zamestnanci&amp;akce=add&amp;co=addvyska\">{$this->var->jazyk["add"]}</a>)
                (<a href=\"?action=zamestnanci&amp;akce=add&amp;co=editdelvyska\">{$this->var->jazyk["edit"]} / {$this->var->jazyk["del"]})</a><br /><br />


*/
}
?>
