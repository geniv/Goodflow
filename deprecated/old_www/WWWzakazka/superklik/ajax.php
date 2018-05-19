<?php
  include_once "funkce.php";
  include_once "login.php";
  include_once "promenne.php";

class Ajax
{
  public $var;

/* konstuktor ajaxu stranky s tiskem
 *
 * name: __construct
 * @param void
 * @return tisk vysledku dane funkce
 */
  function __construct()
  {
    $this->var = new Promenne();  //vytvoření objektu proměnných
    $this->var->login = new Login(); //vytvoření objektu login
    $this->var->main = new HlavniFunkce($this->var); //vytvoření objektu vytvoření hlavní funkce
    $this->var->main->StartCas();

    if ($con = $this->var->main->OtevriMySQLi())//$this->var,$this->login$this->var,
    {
      echo $this->VyberFunkci();

      $this->var->main->ZavriMySQLi(); //uzávěr databáze
    }
      else
    {
      echo $this->var->chyba; //návrat chyby
    }
  }

/* vybere provadenou akci ajaxu pres dane parmetry
 *
 * name: VyberFunkci
 * @param void
 * @return dana akce
 */
  function VyberFunkci()  //vybere volanou funkci
  {
    //$action = (!Empty($_POST["action"]) ? $_POST["action"] : $_GET["action"]);
    //$web = "http://{$_SERVER["SERVER_NAME"]}{$this->var->temp}";
    //print_r($_GET);
    //print_r($_POST);
    //print_r($_SESSION);

    $result = "";

    //vypis pro GET
    if (!Empty($_GET["action"]))
    {
      switch ($_GET["action"])
      {
        case "admin": //get - adminstrace
          $result = include "{$this->var->form}/admin_on.php";
        break;
      }
    }

    //vypis pro POST
    if (!Empty($_POST["action"]))
    {
      switch ($_POST["action"])
      {
        case "login": //post - zalogovani uzivatele
          $login = $_POST["login"];
          $heslo = $_POST["heslo"];

          if (!Empty($login) &&
              !Empty($heslo))
          {
            $pristup = $this->var->main->LoginUser($login, $heslo);

            $this->var->main->PridejLogovani($login, $heslo, $pristup, $_POST["w"], $_POST["h"], $_POST["d"]);

            if ($pristup)
            {
              $result = include "{$this->var->form}/log_in.php";  //prihlasen
            }
              else
            {
              $result = include "{$this->var->form}/log_err.php"; //chyba prihlaseni
            }
          }
            else
          {
            $result = include "{$this->var->form}/reg_log.php"; //rozcestnik - registrace, prihlaseni
          }
        break;

        case "logoff":  //post - odlhlaseni uzivatele
          $_SESSION["SLOGIN"] = "";
          $_SESSION["SHESLO"] = "";
          $_SESSION["SACTIVE"] = false;
          $_SESSION["IDUSER"] = 0;
          $result = include "{$this->var->form}/reg_log.php"; //rozcestnik - registrace, prihlaseni
        break;


        //uzivatele
        case "vypisuser": //post - vypisuje uzivatele
          $result = $this->var->main->VypisAdmiUzivatele($_POST["str"]);
        break;

        case "infouser": //post - informace o uzivateli
          $result = $this->var->main->InfoAdminUser($_POST["id"]);
        break;

        case "edituser": //post - dialog upravit uzivatele
          $result = $this->var->main->EditAdminUser($_POST["id"], false);
        break;

        case "yesedituser": //post - ulozeni upravenych hodnot
          $result = $this->var->main->EditAdminUser($_POST["id"], true);
        break;

        case "deluser": //post - dialog smazat uzivatele
          $result = $this->var->main->DelAdminUser($_POST["id"], false);
        break;

        case "yesdeluser": //post - smaze uzivatele
          $result = $this->var->main->DelAdminUser($_POST["id"], true);
        break;

        case "vypislide":  //post - vypise strucny vypis
          $result = $this->var->main->VypisAdminLide($_POST["str"]);
        break;


        //bubny
        case "vypisbuben":  //post - vypisuje buben
          $result = $this->var->main->VypisAdminBuben();
        break;

        case "poradibuben": //post - meni poradi obrazku
          $result = $this->var->main->PoradiAminBuben($_POST["id"], $_POST["posunna"]);
        break;

        case "toceno":  //post - preda info ze si uzivatel kliknul tedy se zaloguji vytocene data
          $this->var->main->LogovaniVytocenychDat();
        break;


        //pravidla
        case "vypispravidla": //post - vypise pravidla
          $result = $this->var->main->VypisAdminPravidla();
        break;

        case "addpravidla":  //post - otazka pridani pravidla
          $result = $this->var->main->PridejAdminPravidla($_POST["id"], $_POST["typ"], false);
        break;

        case "yesaddpravidla":  //post - pridani pravidla
          $result = $this->var->main->PridejAdminPravidla($_POST["id"], $_POST["typ"], true);
        break;

        case "editpravidla":  //post - formular pro upravu pravidel
          $result = $this->var->main->EditAdminPravidla($_POST["id"], $_POST["typ"], false);
        break;

        case "yeseditpravidla": //post - edituje pravidla
          $result = $this->var->main->EditAdminPravidla($_POST["id"], $_POST["typ"], true);
        break;

        case "delpravidla":  //post - otazka smazani pravidla
          $result = $this->var->main->SmazAdminPravidla($_POST["id"], $_POST["typ"], false);
        break;

        case "yesdelpravidla":  //post - smazani pravidla
          $result = $this->var->main->SmazAdminPravidla($_POST["id"], $_POST["typ"], true);
        break;


        //vyhry
        case "vypisvyhry":  //post - vypisuje vyhry
          $result = $this->var->main->VypisAdminVyhry();
        break;

        case "addvyhry": //post - otazka na pridani polozky vyhry
          $result = $this->var->main->PridejAdminVyhru(false);
        break;

        case "yesaddvyhry": //post - prida polozku vyhry
          $result = $this->var->main->PridejAdminVyhru(true);
        break;
/*
        case "editvyhry": //post - otazka na editaci textu vyhry
          $result = $this->var->main->EditAdmiVyhry($_POST["id"], $_POST);
        break;

        case "yeseditvyhry":  //post - editace textu vyhry
          $result = $this->var->main->EditAdmiVyhry($_POST["id"], true, $_POST);
        break;
*/
        case "delvyhry":  //post - otazka na smazani polozky vyhry
          $result = $this->var->main->SmazAdminVyhru($_POST["id"], false);
        break;

        case "yesdelvyhry": //post - smazani polozky vyhry
          $result = $this->var->main->SmazAdminVyhru($_POST["id"], true);
        break;


        //vyherci
        case "vypisvyh":  //post - vypis vyhercu
          $result = $this->var->main->VypisAdminVyherci($_POST["str"]);
        break;


        //dotaznik
        case "vypisdot":  //post - vypis vysledku dotazniku
          $result = $this->var->main->VypisAdminDotaznik($_POST["str"]);
        break;


        //faq
        case "vypisfaq":  //post - vypisuje faq
          $result = $this->var->main->VypisAdminFAQ();
        break;

        case "addfaqsekce": //post - otazka pridani sekce faq
          $result = $this->var->main->PridejAdminFAQSekce(false);
        break;

        case "yesaddfaqsekce":  //post - pridani sekce faq
          $result = $this->var->main->PridejAdminFAQSekce(true);
        break;

        case "editfaqsekce":  //post - otazka upravy sekce faq
          $result = $this->var->main->EditAdmiFAQSekce($_POST["id"], false);
        break;

        case "yeseditfaqsekce": //post - uprava sekce faq
          $result = $this->var->main->EditAdmiFAQSekce($_POST["id"], true);
        break;

        case "delfaqsekce": //post - otazka smazani sekce faq
          $result = $this->var->main->SmazAdminFAQSekce($_POST["id"], false);
        break;

        case "yesdelfaqsekce":  //post - smazani sekce faq
          $result = $this->var->main->SmazAdminFAQSekce($_POST["id"], true);
        break;

        case "addfaqradek":  //post - otazka pridani radku faq
          $result = $this->var->main->PridejAdminFAQRadek($_POST["id"], false);
        break;

        case "yesaddfaqradek":  //post - pridani radku faq
          $result = $this->var->main->PridejAdminFAQRadek($_POST["id"], true);
        break;

        case "editfaqradek":  //post - otazka upravy radku faq
          $result = $this->var->main->EditAdmiFAQRadek($_POST["id"], false);
        break;

        case "yeseditfaqradek":  //post - uprava radku faq
          $result = $this->var->main->EditAdmiFAQRadek($_POST["id"], true);
        break;

        case "delfaqradek":  //post - otazka smazani radku faq
          $result = $this->var->main->SmazAdminFAQRadek($_POST["id"], false);
        break;

        case "yesdelfaqradek":  //post - smazani radku faq
          $result = $this->var->main->SmazAdminFAQRadek($_POST["id"], true);
        break;


        //cenik
        case "vypiscenik":  //post - vypisuje cenik
          $result = $this->var->main->VypisAdminCenik();
        break;

        case "addceniksekce": //post- otazka na pridani nove sekce
          $result = $this->var->main->PridejAdminCenikSekce(false);
        break;

        case "yesaddceniksekce":  //post - pridani nove sekce
          $result = $this->var->main->PridejAdminCenikSekce(true);
        break;

        case "editceniksekce":  //post -formular pro upraveni sekce ceniku
          $result = $this->var->main->EditAdmiCenikSekce($_POST["id"], false);
        break;

        case "yeseditceniksekce":  //post - upravi sekci ceniku
          $result = $this->var->main->EditAdmiCenikSekce($_POST["id"], true);
        break;

        case "delceniksekce":  //post - otazka pro smazani sekce ceniku
          $result = $this->var->main->SmazAdminCenikSekce($_POST["id"], false);
        break;

        case "yesdelceniksekce":  //post - smazani sekce ceniku
          $result = $this->var->main->SmazAdminCenikSekce($_POST["id"], true);
        break;
/*
        case "addcenikradek":  //post - otazka na novy radek
          //$result = $this->var->main->
        break;

        case "yesaddcenikradek": //post - prida novy radek
          //$result = $this->var->main->
        break;

        case "editcenikradek":  //post -
          //$result = $this->var->main->EditAdmiCenikRadek
        break;

        case "yeseditcenikradek":  //post -
          //$result = $this->var->main->EditAdmiCenikRadek
        break;
*/
        case "delcenikradek":  //post - otazka na smazani radku ceniku
          $result = $this->var->main->SmazAdminCenikRadek($_POST["id"], false);
        break;

        case "yesdelcenikradek":  //post - smazani radku ceniku
          $result = $this->var->main->SmazAdminCenikRadek($_POST["id"], true);
        break;

        case "addobjednavkacenik":  //post - zaloguje objednavku z ceniku
          $result = $this->var->main->PridejObjednavkuCeniku();
        break;

        case "delobjednavka": //post - otazka na smazani objednavky
          $result = $this->var->main->SmazAdminObjednavku($_POST["id"], false);
        break;

        case "yesdelobjednavka":  //post - smazani objednavky
          $result = $this->var->main->SmazAdminObjednavku($_POST["id"], true);
        break;


        //banner
        case "vypisbaner":  //post - vypise banery
          $result = $this->var->main->VypisAdminBaner();
        break;

        case "addbaner":  //post - otazka pridani baneru
          $result = $this->var->main->PridejAdminBaner(false);
        break;

        case "yesaddbaner":  //post - pridani baneru
          $result = $this->var->main->PridejAdminBaner(true);
        break;

        case "editbaner":  //post - otazka editace baneru
          $result = $this->var->main->EditAdmiBaner($_POST["id"], false);
        break;

        case "yeseditbaner":  //post - editace baneru
          $result = $this->var->main->EditAdmiBaner($_POST["id"], true);
        break;

        case "delbaner":  //post - otazka smazani baneru
          $result = $this->var->main->SmazAdminBaner($_POST["id"], false);
        break;

        case "yesdelbaner":  //post - smazani baneru
          $result = $this->var->main->SmazAdminBaner($_POST["id"], true);
        break;


        //promenne
        case "editvar": //post - formaular pro upravu promenne
          $result = $this->var->main->SetNastaveni($_POST["var"], $_POST["info"], $_POST["out"], false);
        break;

        case "yeseditvar":  //post - uprava promenne
          $result = $this->var->main->SetNastaveni($_POST["var"], $_POST["info"], $_POST["out"], true);
        break;


        //zeme
        case "zjistizemi":  //post - zjisteni zeme
          $result = $this->var->main->ZjistiZemi($_POST["id"]);
        break;


        //pocitadlo
        case "vypispoc":  //post - vypis pocitadla
          $result = $this->var->main->VypisAdminPocitadlo($_POST["str"]);
        break;


        //logovani
        case "vypislog":  //post - vypise logovani
          $result = $this->var->main->VypisAdminLogovani($_POST["str"]);
        break;


        //losovani
        case "vypislos":  //post - vypise losovani
          $result = $this->var->main->VypisAdminLosovani($_POST["str"]);
        break;


        //texty
        case "edittex":  //post - unverzalni formular pro upravu textu
          $result = $this->var->main->SetTexty($_POST["var"], $_POST["info"], $_POST["out"], false);
        break;

        case "yesedittex":  //post - upraveni textu
          $result = $this->var->main->SetTexty($_POST["var"], $_POST["info"], $_POST["out"], true);
        break;

        case "edittexbool":  //post - unverzalni formular pro upravu textu, bool format
          $result = $this->var->main->SetTextyBool($_POST["var"], $_POST["info"], $_POST["out"], false);
        break;

        case "yesedittexbool":  //post - upraveni textu, bool format
          $result = $this->var->main->SetTextyBool($_POST["var"], $_POST["info"], $_POST["out"], true);
        break;





/*
        case "":  //post -
          //$result = $this->var->main->
        break;

        case "":  //post -
          //$result = $this->var->main->
        break;

        case "":  //post -
          //$result = $this->var->main->
        break;

        case "":  //post -
          //$result = $this->var->main->
        break;

        case "":  //post -
          //$result = $this->var->main->
        break;

        case "":  //post -
          //$result = $this->var->main->
        break;
*/

        case "web":  //post - vykresleni obsahu stranek
          $result = $this->var->main->ObsahStranky($_POST["kam"]);
          $this->var->main->PridejPocitadlo($_POST["w"], $_POST["h"], $_POST["d"]);
        break;

        case "buben": //post - zobrazeni daneho bubnu
          $result = $this->var->main->Buben($_POST["typ"]);
        break;

        case "registrace": //post - preneseni promennych do funkce
          $result = $this->var->main->Registrace();
        break;

        case "edit":  //post - editace uzivatele
          $result = $this->var->main->EditUser($_SESSION["IDUSER"]);
        break;

        case "sendauthuser":  //post - znovu poslani autorizace
          $result = $this->var->main->ZnovuPoslaniAutorzace($_POST["id"], false);
        break;

        case "yessendauthuser": //post - povoleni poslani autorizace
          $result = $this->var->main->ZnovuPoslaniAutorzace($_POST["id"], true);
        break;

        case "show_obchodpodm": //ukaze obchodni podminky
          $result = include "{$this->var->form}/obchodni_podminky.php";
        break;

/*
        case "inputtext": //post - preneseni zprany do vetsiho prostoru
          $result = stripslashes($_POST["text"]); //+odstaneni zpetnych lomitek
        break;
*/

        case "zprava": //post - zobrazi vybranou zpravu
          $result = $this->var->main->ShowObsahZpravy($_POST["cislo"], $_POST["typ"]);
        break;

        case "horoskop": //post - zobrazi vybrany horoskop
          $result = $this->var->main->ShowObsahHoroskopu($_POST["typ"]);
        break;
      }
    }

    $result .= $this->var->chyba; //pridava na konec pripadnou hlasku chyby

    return $result;
  }
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
}
  //header('Content-type: text/html; charset=UTF-8');
  $web = new Ajax();
?>
