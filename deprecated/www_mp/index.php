<?php

/**
 *
 * Centralni trida index projektu a hlavni nalinkovani funkce a promennych
 *
 */

include_once "default_modul.php";
class Layout extends DefaultModule
{
  private $var, $unikatni, $absolutni_url, $funkce_web, $info_web;
  public $prenos;

/**
 *
 * Konstruktor hlavni tridy
 *
 */
  public function __construct()
  {
    $this->var = new Promenne();  //vytvoreni promennych
    $this->var->main[0] = new Funkce($this->var, 0);  //vytvoreni funkce
    $this->var->main[0]->StartCas();  //zacatek mereni generovani stranky
    $this->funkce_web = $this->var->main[0]->InicializaceModulu($this->info_web);  //hlavni incializace dalsich definovanych modulu
    $this->prenos = $this->var; //prenos do unikatnich a duplikatnich

    $this->absolutni_url = $this->AbsolutniUrl();
    $this->unikatni = $this->NactiObsahSouboru(".unikatni_index.php");
  }

/**
 *
 * Hlavni vykreslovaci funkce
 *
 * @return index laoyutu
 */
  public function __toString()
  {
    $metainformace = $this->var->main[0]->NactiFunkci("DynamicConfig", "ObjectConfigGroup", "meta-informace");

    $info_blok = $this->var->main[0]->BlokaceInfo($this->funkce_web);

    $linkadmin = $this->var->main[0]->BackLinkAdmin();
    $backadmin = ($this->var->main[0]->ZobrazitLinkAdmin() ? "<a href=\"{$this->absolutni_url}?{$linkadmin}\" title=\"Vstup bez přihlašování\" id=\"ad_prejit_odkaz\"><!-- --></a>" : "<!-- -->");

    $this->var->main[0]->VypisVsechnyChyby();

    $podminka = "main";
    if (!Empty($_GET[$this->var->get_kam]))
    {
      if ($_GET[$this->var->get_kam] == $this->var->adresaadminu &&
          $this->var->aktivniadmin)
      {
        $podminka = "admin";
      }
        else
      {
        if ($this->var->waitindex)
        {
          $podminka = "wait";
        }
      }
    }

    if ($this->funkce_web)
    {
      $podminka = "blok";
    }
//dodelat!!! chyby prenaset jinak!
    $zakladnipole = array("absolutni_url" => $this->absolutni_url,
                          "nazev_webu" => $this->var->nazevwebu,
                          "chyba" => $this->var->chyba,
                          "adminlogin" => $this->var->adminlogin,
                          "jquerycore_web" => $this->var->jquerycore_web,
                          "jqueryui_web" => $this->var->jqueryui_web,
                          "ajax_admin" => $this->var->main[0]->generated[0],
                          "jquerycore_admin" => $this->var->jquerycore,
                          "jqueryui_admin" => $this->var->jqueryui,

                          "meta_author" => $metainformace->meta_author,
                          "meta_copyright" => $metainformace->meta_copyright,
                          "meta_keywords" => $metainformace->meta_keywords,

                          "info_web" => $this->info_web,
                          "info_blok" => $info_blok,
                          "endtime" => $this->var->main[0]->KonecCas(),

                          "backadmin" => $backadmin,
                          );
//dodelat!! osetrit zakaz vstupu IE! s novou verzi to zdrejme nejak zhavarovalo?!
    $result = "";
    switch ($podminka)
    {
      case "main":  //hlavni index
        $logadvolani = ($this->var->main[0]->AkceptujProhlizece() ? "<span id=\"odkaz_ad\">--- admin ---<!-- --></span>" : "<!-- -->");

        $pole = array("logadvolani" => $logadvolani,
                      );

        $result = $this->UniqObject($this->unikatni["index_main"], array_merge($zakladnipole, $pole));
      break;

      case "admin": //admin index
        $pole = array("title_admin" => $this->var->main[0]->GenerovaniAdminTitle(),
                      "menu_admin" => $this->var->main[0]->GenerovaniAdminMenu(),
                      "obsah_admin" => $this->var->main[0]->GenerovaniAdminObsah(),
                      "timeupdate" => $this->var->main[0]->CasAktualizace(),
                      "jmeno_admin" => $this->var->main[0]->GetUserName(),
                      "admin_styles" => $this->var->main[0]->AdminNacitaniCssModulu(),
                      "cestatematu" => $this->var->current_theme_dir);

        $result = $this->UniqObject($this->unikatni["index_admin"], array_merge($zakladnipole, $pole));
      break;

      case "wait":  //wait index
        $logadvolanirc = ($this->var->main[0]->NactiFunkci("Funkce", "AkceptujProhlizece") ? "<span id=\"odkaz_ad\"><!-- --></span>" : "<!-- -->");

        $pole = array("login_admin" => $this->var->adminlogin,
                      "logadvolanirc" => $logadvolanirc);

        $result = $this->UniqObject($this->unikatni["index_wait"], array_merge($zakladnipole, $pole));
      break;

      case "blok":  //blok index
        $pole = array("" => "",
                      );

        $result = $this->UniqObject($this->unikatni["index_blok"], array_merge($zakladnipole, $pole));
      break;
    }

    $this->LastError(get_class($this));

    return $result;
  }


}

$web = new Layout();
echo $web;

?>
