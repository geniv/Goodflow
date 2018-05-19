<?php
  include_once "login.php"; //vložení tříd
  include_once "funkce_promenne.php";
  include_once "funkce.php";
  include_once "funkce_zamestnanec.php";
  include_once "funkce_partner.php";
  include_once "funkce_zakaznik.php";
  
  include_once "funkce_admin.php";
  include_once "funkce_pdf.php";

class TSQM  //hlavní skládací třída
{
  public $var;
  //****************************************************************************
  function __construct()
  {
    $this->var = new Promenne();  //vytvoření objektu proměnných
    $this->var->login = new Login(); //vytvoření objektu login
    $this->var->main = new HlavniFunkce($this->var); //vytvoření objektu vytvoření hlavní funkce
    $this->var->zam = new Zamestnanec($this->var); //vytvoření objektu zaměstnance
    $this->var->par = new Partner($this->var);  //vytvoří objekt partnerů
    $this->var->zak = new Zakaznik($this->var); //vytvori tridu zakazniku
    
    $this->var->admin = new Administrace($this->var);  //vytvoření objektu administrace

    $this->var->main->StartCas();
    $jazyk = $this->var->main->VolbaJazyka(); //inicializace jazyka

    if ($con = $this->var->main->OtevriMySQLi())//$this->var,$this->login$this->var,
    {
      $this->var->main->InstalaceMySQLi();//$this->var, $this->login

      if (!Empty($_POST["jmeno"]) && !Empty($_POST["heslo"])) //přihlášení
      {
        if ($this->var->main->KontrolaLogin($_POST["jmeno"], $_POST["heslo"])) //heslo správně
        { //správně
          SetCookie("TSQM_JMENO", $_POST["jmeno"], Time() + 31536000); //zápis do cookie
          SetCookie("TSQM_HESLO", $_POST["heslo"], Time() + 31536000);
          $prih = include "{$this->var->form}/log_on.php";  //vkládají se
          $this->var->main->AutoClick(1, "./");  //auto kliknuti
        }
        	else
        { //špatně
          $prih = include "{$this->var->form}/log_err.php"; //vkládají se, heslo špatně
        }
      }

      if(!Empty($_GET["action"]) && $_GET["action"] == "logoff")  //odhláření
      {
        SetCookie("TSQM_JMENO", "", 0); //vymazání cookie
        SetCookie("TSQM_HESLO", "", 0);
        $prih = include "{$this->var->form}/log_off.php"; //vkládají se
        $this->var->main->AutoClick(1, "./");  //auto kliknuti
      }

      if (!Empty($_COOKIE["TSQM_JMENO"]) && !Empty($_COOKIE["TSQM_HESLO"]) && $this->var->main->KontrolaLogin($_COOKIE["TSQM_JMENO"], $_COOKIE["TSQM_HESLO"]))  //kontrola havního přístupu
      {
        $obsah = $this->var->main->ObsahStanky(); //obstarává veškerý obsah skránek

        if ($this->var->main->Pristup() || $this->var->kam == "uvod")  //osetreni pristupu, vzdy se musi zobrazit uvod!
        { //má práva
          $result = include "{$this->var->form}/index_on.php";  //s hlavičkou, přístup OK
        }
          else
        { //nemá práva
          $result = include "{$this->var->form}/index_off.php"; //s hlavičkou, přístup NEE
        }
      }
        else
      { //zalogování do stránek
        $result = include "{$this->var->form}/log_log.php"; //s hlavičkou
      }
      $this->var->main->ZavriMySQLi(); //uzávěr databáze
    }
      else
    {
      $result = $this->var->chyba; //návrat chyby
    }

    echo $result;
  }
}

$web = new TSQM();  //vytvoření hlavního objektu
?>
