<?php

/**
 *
 * Blok dynamicky generovaneho htaccess-u
 *
 */

//verze modulu
define("v_DynamicHtaccess", "1.51");

class DynamicHtaccess extends DefaultModule
{
  private $var, $sqlite, $dirpath, $unikatni, $absolutni_url;
  public $idmodul = "dynhtcs";
  public $mount = array(".unikatni_obsah.php",
                        "ajax_form.php");
  public $generated = array(""); //soubory co generuje modul
  public $support = array(SQLITE, MYSQLI);  //modulem podporovane databeze
  public $permit; //pole odkazu pro permission
  public $adress; //mistni pole adres modulu
  public $namemodule; //nazvy pro modul
  public $convmeth = array("Ajax" => "DynamicHtaccess");

  private $localpermit;

  private $filehtaccess = ".htaccess";

/**
 *
 * Konstruktor menu
 *
 * @param var pruchodova struktura
 * @param index prideleny index pri generovani
 */
  public function __construct(&$var = NULL, $index = -1) //konstruktor
  {
    $this->adress = array($this->idmodul);

    if (!Empty($var))
    {
      $this->var = $var;
      $this->dirpath = dirname($this->var->moduly[$index]["include"]);

      //includovani unikatniho obsahu
      $this->unikatni = $this->NactiObsahSouboru("{$this->dirpath}/.unikatni_obsah.php");
      $this->absolutni_url = $this->AbsolutniUrl();

      //nacitani opravneni
      $this->permit = $this->NactiUnikatniObsah($this->unikatni["admin_permit"],
                                                $this->idmodul);

      $this->namemodule = $this->unikatni["name_module"];

      $this->dbpredpona = $this->NastavKomunikaci($this->var, $index, NULL, NULL, true);  //pripojeni defaultu

      $this->Instalace();

      //aplikace permission na nactene pole permission
      $this->localpermit = $this->AplikacePermission($this->var->moduly[$index]["class"], $this->permit);

      $this->NastavitAdresuMenu($this->NactiUnikatniObsah($this->unikatni["admin_menu"],
                                                          $this->idmodul));
    }
  }

/**
 *
 * Obsah adminu
 *
 * @return obsah adminu
 */
  public function AdminObsah()
  {
    if ($_GET[$this->var->get_kam] == $this->var->adresaadminu &&
        $this->var->aktivniadmin)
    {
      switch ($_GET[$this->var->get_idmodul])
      {
        case $this->idmodul:  //id modul
          $result = $this->AdministraceObsahu();
        break;
      }
    }

    return $result;
  }

/**
 *
 * Instalace databaze
 *
 */
  private function Instalace()
  {
    $this->InstalaceDatabaze("CREATE TABLE {$this->dbpredpona}htaccess (
                                id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                rewrite TEXT,
                                popis TEXT,
                                aktivni BOOL,
                                pridano DATETIME,
                                upraveno DATETIME,
                                poradi INTEGER UNSIGNED);");

    //preinstalace dat
    $this->ControlPreInstall($this->unikatni["control_preinstall"],
                            array($this->absolutni_url));
  }

/**
 *
 * Interne volana funkce pro zobrazovani administrace dynamickeho htaccessu
 *
 * @return adminstracni formular v html
 */
  private function AdministraceObsahu()
  {
    $result = $this->NactiUnikatniObsah($this->unikatni["admin_obsah"],
                                        ($this->localpermit[$_GET[$this->var->get_idmodul]]["add"] ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=add" : ""),
                                        ($this->localpermit[$_GET[$this->var->get_idmodul]]["generate"] ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=generate" : ""),
                                        (file_exists($this->filehtaccess) ? ($this->localpermit[$_GET[$this->var->get_idmodul]]["show"] ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=show" : "") : ""),
                                        $this->AdminVypisObsah());

    $co = $this->NotEmpty("get", "co");

    if (!Empty($co))
    {
      switch ($co)
      {
        case "add": //pridavani polozky
          $result = $this->NactiUnikatniObsah($this->unikatni["admin_addedit"],
                                              $this->unikatni["admin_addedit_add"],
                                              "", "", "",
                                              "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}");

          if ($this->ControlForm(array ("rewrite" => array("post", "string"),
                                        "popis" => array("post", "string"),
                                        "aktivni" => array("post", "boolean"),
                                        "pridano" => array("self", "date", "now"),
                                        //"upraveno" => array("self", "date", "now")),
                                        "poradi" => array("self", "integer", $this->VypisPocetRadku("poradi", "htaccess", 1))),
                                (!Empty($_POST["tlacitko"]) && !Empty($_POST["rewrite"])),
                                array("insert", "htaccess", NULL)))
          {
            $result = $this->Hlaska("add", $_POST["rewrite"]);
            $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
          }
        break;

        case "edit":  //editace polozky
          $id = $_GET["id"];
          settype($id, "integer");

          if ($data = $this->querySingleRow("SELECT rewrite, popis, aktivni FROM {$this->dbpredpona}htaccess WHERE id={$id};"))
          {
            $result = $this->NactiUnikatniObsah($this->unikatni["admin_addedit"],
                                                $this->unikatni["admin_addedit_edit"],
                                                $data->rewrite,
                                                $data->popis,
                                                ($data->aktivni ? " checked=\"checked\"" : ""),
                                                "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}");

            if ($this->ControlForm(array ("rewrite" => array("post", "string"),
                                          "popis" => array("post", "string"),
                                          "aktivni" => array("post", "boolean"),
                                          //"pridano" => array("self", "date", "now"),
                                          "upraveno" => array("self", "date", "now")),
                                  (!Empty($_POST["tlacitko"]) && !Empty($_POST["rewrite"]) && $id > 0),
                                  array("update", "htaccess", $id)))
            {
              $result = $this->Hlaska("edit", $_POST["rewrite"]);
              $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
            }
          }
        break;

        case "del": //mazani polozky
          $id = $_GET["id"];
          settype($id, "integer");

          if ($this->ControlDeleteForm(array("htaccess" => array("id", $id, "rewrite")), $nazev))
          {
            $result = $this->Hlaska("del", $nazev);
            $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
          }
        break;

        case "show":  //zobrazi nahled existujiciho htaccess-u
          if ($u = @fopen($this->filehtaccess, "r"))
          {
            $ret = fread($u, filesize($this->filehtaccess));
            fclose($u);

            $result = $this->NactiUnikatniObsah($this->unikatni["admin_show"],
                                                "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}",
                                                $ret);
          }
        break;

        case "generate":  //generovani htaccessu
          $out = "";
          if ($res = $this->queryMultiObjectSingle("SELECT rewrite, popis, aktivni FROM {$this->dbpredpona}htaccess ORDER BY poradi ASC;"))
          {
            foreach ($res as $data)
            {
              $out .= $this->NactiUnikatniObsah($this->unikatni["admin_generovani_htaccess"],
                                                $data->popis,
                                                ($data->aktivni ? $data->rewrite : "#{$data->rewrite}"));
            }

            if (is_writable($this->filehtaccess) &&
                $u = @fopen($this->filehtaccess, "w"))
            {
              fwrite($u, htmlspecialchars_decode(html_entity_decode($out)));
              fclose($u);

              $result = $this->Hlaska("info", "Byl vytvořen htaccess z konceptu.");
              $this->AutoClick(1, "?{$this->var->get_kam}={$this->var->adresaadminu}&{$this->var->get_idmodul}={$this->idmodul}");  //auto kliknuti
            }
          }
        break;
      }
    }

    return $result;
  }

/**
 *
 * Vypis administrace htaccessu
 *
 * @return vypis htaccesu v html
 */
  private function AdminVypisObsah()
  {
    $result = $this->NactiUnikatniObsah($this->unikatni["admin_vypis_obsah_begin"],
                                        $this->dirpath);

    if ($res = $this->queryMultiObjectSingle("SELECT id, aktivni, rewrite, popis, poradi FROM {$this->dbpredpona}htaccess ORDER BY poradi ASC;"))
    {
      foreach ($res as $data)
      {
        $result .= $this->NactiUnikatniObsah($this->unikatni["admin_vypis_obsah"],
                                            $data->id,
                                            $data->poradi,
                                            ($data->aktivni ? " checked=\"checked\"" : ""),
                                            ($data->aktivni ? $data->rewrite : "#{$data->rewrite}"),
                                            $data->popis,
                                            ($this->localpermit[$_GET[$this->var->get_idmodul]]["edit"] ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=edit&amp;id={$data->id}" : ""),
                                            ($this->localpermit[$_GET[$this->var->get_idmodul]]["del"] ? "?{$this->var->get_kam}={$this->var->adresaadminu}&amp;{$this->var->get_idmodul}={$this->idmodul}&amp;co=del&amp;id={$data->id}" : ""));
      }
    }

    $result .= $this->unikatni["admin_vypis_obsah_end"];

    return $result;
  }


}
?>
