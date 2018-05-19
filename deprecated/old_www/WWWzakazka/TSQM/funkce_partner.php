<?php
class Partner
{
  public $var;
//******************************************************************************
  function __construct(&$var) //konstruktor
  {
    $this->var = $var;
  }
//******************************************************************************
  function PartnerEditDel() //vypis partnera + edit, del
  {
    $strankovani = $this->var->main->Strankovani("partner", $od, $poc);

    if ($res = @$this->var->mysqli->query("SELECT id, nazev, jmeno, prijmeni, ulice, cp, psc, mesto, predvolba, telefon
                                          FROM partner
                                          ORDER BY prijmeni ASC, jmeno ASC
                                          LIMIT {$od}, {$poc};"))
    {
      if ($res->num_rows != 0)
      {
        $result = //výpis zemí
        "{$strankovani}
        <table border=\"1\">
          <tr>
            <td>{$this->var->jazyk["par_nazev"]}</td>
            <td>{$this->var->jazyk["par_jmeno"]}</td>
            <td>{$this->var->jazyk["par_prijmeni"]}</td>
            <td>{$this->var->jazyk["par_foto"]}</td>
            <td>{$this->var->jazyk["par_ulice"]}</td>
            <td>{$this->var->jazyk["par_cp"]}</td>
            <td>{$this->var->jazyk["par_psc"]}</td>
            <td>{$this->var->jazyk["par_mesto"]}</td>
            <td>{$this->var->jazyk["par_tel"]}</td>
            ".($this->var->main->PristupOdkaz("partneri", "info") ? "<td>{$this->var->jazyk["info"]}</td>": "")."
            ".($this->var->main->PristupOdkaz("partneri", "edit") ? "<td>{$this->var->jazyk["edit"]}</td>": "")."
            ".($this->var->main->PristupOdkaz("partneri", "del") ? "<td>{$this->var->jazyk["del"]}</td>": "")."
          </tr>";

        while ($data = $res->fetch_object())
        {
          $result .=
          "
          <tr>
            <td>".(!Empty($data->nazev) ? "{$data->nazev}" : $this->var->emptypol)."</td>
            <td>{$data->jmeno} {$data->prijmeni}</td>
            <td></td>
            <td><img src=\"foto.php?sekce=partnerimini&amp;id={$data->id}\" alt=\"\" /></td>
            <td>".(!Empty($data->ulice) ? "{$data->ulice}" : $this->var->emptypol)."</td>
            <td>{$data->cp}</td>
            <td>".(!Empty($data->psc) ? "{$data->psc}" : $this->var->emptypol)."</td>
            <td>".(!Empty($data->mesto) ? "{$data->mesto}" : $this->var->emptypol)."</td>
            <td>".(!Empty($data->telefon) ? "{$data->predvolba} {$data->telefon}" : $this->var->emptypol)."</td>
            ".($this->var->main->PristupOdkaz("partneri", "info") ? "<td><a href=\"?action={$_GET["action"]}&amp;akce=info&amp;cislo={$data->id}\">{$this->var->jazyk["info"]}</a></td>": "")."
            ".($this->var->main->PristupOdkaz("partneri", "edit") ? "<td><a href=\"?action={$_GET["action"]}&amp;akce=edit&amp;cislo={$data->id}\">{$this->var->jazyk["edit"]}</a></td>": "")."
            ".($this->var->main->PristupOdkaz("partneri", "del") ? "<td><a href=\"?action={$_GET["action"]}&amp;akce=del&amp;cislo={$data->id}\">{$this->var->jazyk["del"]}</a></td>": "")."
          </tr>
          ";
        }
        $result .=
        "</table>
        {$strankovani}";
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
  function PartnerInfoAll() //vypíše kompletní informace o partnerovy
  {
    $cislo = $_GET["cislo"];
    settype($cislo, "integer");

    if (!Empty($cislo) && $cislo != 0)
    {
      if ($res = $this->var->mysqli->query("SELECT partner.id, nazev, jmeno, prijmeni,
                                            ulice, cp, psc, mesto, zeme,
                                            predvolba, telefon, predvolba1,
                                            telefon1, email, pohlavi,
                                            DATE_FORMAT(datumosloveni, '{$this->var->mysqlden}') as dendatumosloveni,
                                            DATE_FORMAT(datumosloveni, '{$this->var->mysqldatum}') as datumosloveni,
                                            DATE_FORMAT(datumkalkulace, '{$this->var->mysqlden}') as dendatumkalkulace,
                                            DATE_FORMAT(datumkalkulace, '{$this->var->mysqldatum}') as datumkalkulace,
                                            DATE_FORMAT(datumpohovoru, '{$this->var->mysqlden}') as dendatumpohovoru,
                                            DATE_FORMAT(datumpohovoru, '{$this->var->mysqldatum}') as datumpohovoru,
                                            DATE_FORMAT(datumzacatek, '{$this->var->mysqlden}') as dendatumzacatek,
                                            DATE_FORMAT(datumzacatek, '{$this->var->mysqldatum}') as datumzacatek,
                                            DATE_FORMAT(datumodmitnuti, '{$this->var->mysqlden}') as dendatumodmitnuti,
                                            DATE_FORMAT(datumodmitnuti, '{$this->var->mysqldatum}') as datumodmitnuti,
                                            DATE_FORMAT(datumkonec, '{$this->var->mysqlden}') as dendatumkonec,
                                            DATE_FORMAT(datumkonec, '{$this->var->mysqldatum}') as datumkonec,
                                            status.status, celkovaspokojenost, komentar,
                                            pratelsky, presnost, kompetence,
                                            komunikace, vystupovani, infodostatek,
                                            infosrozumitelne, infoustnisrozumitelne,
                                            infohodnoceni, terminkalkulace, termindodani,
                                            rozpocet, odchylka, spokojenost
                                            FROM partner, zeme, status
                                            WHERE idzeme=zeme.id AND
                                            idstatus=status.id AND
                                            partner.id=$cislo;"))
      {
        $data = $res->fetch_object();
        $result = include "{$this->var->form}/info_partner.php";
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);
      }
    }

    return $result;
  }
//******************************************************************************
  function PartnerPridat()  //přidá partnera
  {
    $datum = date("d.m.Y");
    $result .= include "{$this->var->form}/add_partner.php";
/*
!Empty($_POST["par_nazev"]) &&
!Empty($_POST["par_jmeno"]) &&
!Empty($_POST["par_prijmeni"]) &&
!Empty($_POST["par_ulice"]) &&
!Empty($_POST["par_cp"]) &&
!Empty($_POST["par_psc"]) &&
!Empty($_POST["par_mesto"]) &&
!Empty($_POST["par_zeme"]) &&
!Empty($_POST["par_pred"]) &&
!Empty($_POST["par_tel"]) &&
!Empty($_POST["par_pred1"]) &&
!Empty($_POST["par_tel1"]) &&
!Empty($_POST["par_email"]) &&
!Empty($_POST["par_jazyk"]) &&
!Empty($_POST["par_pohlavi"]) &&
!Empty($_POST["par_datumosloveni"]) &&
!Empty($_POST["par_datumkalkulace"]) &&
!Empty($_POST["par_datumpohovoru"]) &&
!Empty($_POST["par_datumzacatek"]) &&
!Empty($_POST["par_datumodmitnuti"]) &&
!Empty($_POST["par_datumkonec"]) &&
!Empty($_POST["par_status"]) &&
!Empty($_POST["par_celkovaspokojenost"]) &&
!Empty($_POST["par_komentar"]) &&

$_POST["par_existfoto"]-B
fotka-F

$_POST["par_pratelsky"]
$_POST["par_presnost"]
$_POST["par_kompetence"]
$_POST["par_komunikace"]
$_POST["par_vystupovani"]
$_POST["par_infodostatek"]-B
$_POST["par_infosruzumitelne"]
$_POST["par_infoustnisrozumitelne"]
$_POST["par_infohodnoceni"]
$_POST["par_terminkalkulace"]-B
$_POST["par_termindodani"]-B
$_POST["par_rozpocet"]-B
$_POST["par_odchylka"]
$_POST["par_spokojenost"]

!Empty($_POST["tlacitko"]) &&
*/
    if (!Empty($_POST["par_nazev"]) &&
        !Empty($_POST["par_jmeno"]) &&
        //!Empty($_POST["par_prijmeni"]) &&
        //!Empty($_POST["par_ulice"]) &&
        //!Empty($_POST["par_cp"]) &&
        //!Empty($_POST["par_psc"]) &&
        //!Empty($_POST["par_mesto"]) &&
        //!Empty($_POST["par_zeme"]) &&
        //!Empty($_POST["par_pred"]) &&
        //!Empty($_POST["par_tel"]) &&
        //!Empty($_POST["par_pred1"]) &&
        //!Empty($_POST["par_tel1"]) &&
        //!Empty($_POST["par_email"]) &&
        //!Empty($_POST["par_jazyk"]) &&
        //!Empty($_POST["par_pohlavi"]) &&
        //!Empty($_POST["par_datumosloveni"]) &&
        //!Empty($_POST["par_datumkalkulace"]) &&
        //!Empty($_POST["par_datumpohovoru"]) &&
        //!Empty($_POST["par_datumzacatek"]) &&
        //!Empty($_POST["par_datumodmitnuti"]) &&
        //!Empty($_POST["par_datumkonec"]) &&
        //!Empty($_POST["par_status"]) &&
        //!Empty($_POST["par_spokojenost"]) &&
        //!Empty($_POST["par_komentar"]) &&
        !Empty($_POST["tlacitko"]))
    {
      $par_nazev = stripslashes(htmlspecialchars($_POST["par_nazev"]));
      $par_jmeno = stripslashes(htmlspecialchars($_POST["par_jmeno"]));
      $par_prijmeni = stripslashes(htmlspecialchars($_POST["par_prijmeni"]));
      $par_ulice = stripslashes(htmlspecialchars($_POST["par_ulice"]));
      $par_cp = $_POST["par_cp"];
      settype($par_cp, "integer");
      $par_psc = $_POST["par_psc"];
      settype($par_psc, "integer");
      $par_mesto = stripslashes(htmlspecialchars($_POST["par_mesto"]));
      $par_zeme = $_POST["par_zeme"];
      settype($par_zeme, "integer");
      $par_pred = stripslashes(htmlspecialchars($_POST["par_pred"]));
      $par_tel = stripslashes(htmlspecialchars($_POST["par_tel"]));
      $par_pred1 = stripslashes(htmlspecialchars($_POST["par_pred1"]));
      $par_tel1 = stripslashes(htmlspecialchars($_POST["par_tel1"]));
      $par_email = stripslashes(htmlspecialchars($_POST["par_email"]));
      $par_jazyk = $_POST["par_jazyk"]; //array
      $par_pohlavi = $this->var->main->BoolToInt($_POST["par_pohlavi"]);
      settype($par_pohlavi, "integer");
      $par_datumosloveni = (!Empty($_POST["par_datumosloveni"]) ? date("Y-m-d", strtotime($_POST["par_datumosloveni"])) : "");
      $par_datumkalkulace = (!Empty($_POST["par_datumkalkulace"]) ? date("Y-m-d", strtotime($_POST["par_datumkalkulace"])) : "");
      $par_datumpohovoru = (!Empty($_POST["par_datumpohovoru"]) ? date("Y-m-d", strtotime($_POST["par_datumpohovoru"])) : "");
      $par_datumzacatek = (!Empty($_POST["par_datumzacatek"]) ? date("Y-m-d", strtotime($_POST["par_datumzacatek"])) : "");
      $par_datumodmitnuti = (!Empty($_POST["par_datumodmitnuti"]) ? date("Y-m-d", strtotime($_POST["par_datumodmitnuti"])) : "");
      $par_datumkonec = (!Empty($_POST["par_datumkonec"]) ? date("Y-m-d", strtotime($_POST["par_datumkonec"])) : "");
      $par_status = $_POST["par_status"];
      settype($par_status, "integer");
      $par_celkovaspokojenost = $_POST["par_celkovaspokojenost"];
      settype($par_celkovaspokojenost, "integer");
      $par_komentar = stripslashes(htmlspecialchars($_POST["par_komentar"]));

      $par_existfoto = $this->var->main->BoolToInt($_POST["par_existfoto"]);

      $par_pratelsky = $_POST["par_pratelsky"]; //int
      settype($par_pratelsky, "integer");
      $par_presnost = $_POST["par_presnost"]; //int
      settype($par_presnost, "integer");
      $par_kompetence = $_POST["par_kompetence"]; //int
      settype($par_kompetence, "integer");
      $par_komunikace = $_POST["par_komunikace"]; //int
      settype($par_komunikace, "integer");
      $par_vystupovani = $_POST["par_vystupovani"]; //int
      settype($par_vystupovani, "integer");
      $par_infodostatek = $this->var->main->BoolToInt($_POST["par_infodostatek"]);
      $par_infosruzumitelne = $_POST["par_infosruzumitelne"]; //int
      settype($par_infosruzumitelne, "integer");
      $par_infoustnisrozumitelne = $_POST["par_infoustnisrozumitelne"]; //int
      settype($par_infoustnisrozumitelne, "integer");
      $par_infohodnoceni = $_POST["par_infohodnoceni"]; //int
      settype($par_infohodnoceni, "integer");
      $par_terminkalkulace = $this->var->main->BoolToInt($_POST["par_terminkalkulace"]);
      $par_termindodani = $this->var->main->BoolToInt($_POST["par_termindodani"]);
      $par_rozpocet = $this->var->main->BoolToInt($_POST["par_rozpocet"]);
      $par_odchylka = $_POST["par_odchylka"]; //float
      settype($par_odchylka, "float");
      $par_spokojenost = $_POST["par_spokojenost"]; //int
      settype($par_spokojenost, "integer");

      if ($this->var->mysqli->multi_query("INSERT INTO partner (
                                          id,
                                          nazev,
                                          jmeno,
                                          prijmeni,
                                          ulice,
                                          cp,
                                          psc,
                                          mesto,
                                          idzeme,
                                          predvolba,
                                          telefon,
                                          predvolba1,
                                          telefon1,
                                          email,
                                          pohlavi,
                                          datumosloveni,
                                          datumkalkulace,
                                          datumpohovoru,
                                          datumzacatek,
                                          datumodmitnuti,
                                          datumkonec,
                                          idstatus,
                                          celkovaspokojenost,
                                          komentar,
                                          pratelsky,
                                          presnost,
                                          kompetence,
                                          komunikace,
                                          vystupovani,
                                          infodostatek,
                                          infosrozumitelne,
                                          infoustnisrozumitelne,
                                          infohodnoceni,
                                          terminkalkulace,
                                          termindodani,
                                          rozpocet,
                                          odchylka,
                                          spokojenost
                                          ) VALUES(
                                          NULL,
                                          '$par_nazev',
                                          '$par_jmeno',
                                          '$par_prijmeni',
                                          '$par_ulice',
                                          $par_cp,
                                          $par_psc,
                                          '$par_mesto',
                                          $par_zeme,
                                          '$par_pred',
                                          '$par_tel',
                                          '$par_pred1',
                                          '$par_tel1',
                                          '$par_email',
                                          $par_pohlavi,
                                          '$par_datumosloveni',
                                          '$par_datumkalkulace',
                                          '$par_datumpohovoru',
                                          '$par_datumzacatek',
                                          '$par_datumodmitnuti',
                                          '$par_datumkonec',
                                          $par_status,
                                          $par_celkovaspokojenost,
                                          '$par_komentar',
                                          $par_pratelsky,
                                          $par_presnost,
                                          $par_kompetence,
                                          $par_komunikace,
                                          $par_vystupovani,
                                          $par_infodostatek,
                                          $par_infosruzumitelne,
                                          $par_infoustnisrozumitelne,
                                          $par_infohodnoceni,
                                          $par_terminkalkulace,
                                          $par_termindodani,
                                          $par_rozpocet,
                                          $par_odchylka,
                                          $par_spokojenost
                                          );"))
      {
        $idpar = $this->var->mysqli->insert_id;

        if (count($par_jazyk) != 0)
        {
          $this->PridatNekolikJazyk($idpar);
        }
        
        if (!Empty($_FILES["fotka"]["name"]) && $par_existfoto == 1)
        {
          $this->PridatFotku($idpar);
        }

        $nazev = $par_nazev;
        $result = include "{$this->var->form}/add_true.php";
        $this->var->main->AutoClick(1, "?action={$_GET["action"]}&akce={$_GET["akce"]}");  //auto kliknutí
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
      }
    }
      else
    {
      if (!Empty($_POST["tlacitko"]))
      {
        $zpet = "{$this->var->main->OdkazZ5()}<br />";
        $chybnepole = $this->var->jazyk["chybapole"];
        if (Empty($_POST["par_nazev"])){$result .= "$chybnepole: {$this->var->jazyk["par_nazev"]} $zpet";}
        if (Empty($_POST["par_jmeno"])){$result .= "$chybnepole: {$this->var->jazyk["par_jmeno"]} $zpet";}
        if (Empty($_POST["par_prijmeni"])){$result .= "$chybnepole: {$this->var->jazyk["par_prijmeni"]} $zpet";}
        if (Empty($_POST["par_ulice"])){$result .= "$chybnepole: {$this->var->jazyk["par_ulice"]} $zpet";}
        if (Empty($_POST["par_cp"])){$result .= "$chybnepole: {$this->var->jazyk["par_cp"]} $zpet";}
        if (Empty($_POST["par_psc"])){$result .= "$chybnepole: {$this->var->jazyk["par_psc"]} $zpet";}
        if (Empty($_POST["par_mesto"])){$result .= "$chybnepole: {$this->var->jazyk["par_mesto"]} $zpet";}
        if (Empty($_POST["par_zeme"])){$result .= "$chybnepole: {$this->var->jazyk["par_zeme"]} $zpet";}
        if (Empty($_POST["par_pred"])){$result .= "$chybnepole: {$this->var->jazyk["par_pred"]} $zpet";}
        if (Empty($_POST["par_tel"])){$result .= "$chybnepole: {$this->var->jazyk["par_tel"]} $zpet";}
        //if (Empty($_POST["par_pred1"])){$result .= "$chybnepole: {$this->var->jazyk["par_pred1"]} $zpet";}
        //if (Empty($_POST["par_tel1"])){$result .= "$chybnepole: {$this->var->jazyk["par_tel1"]} $zpet";}
        if (Empty($_POST["par_email"])){$result .= "$chybnepole: {$this->var->jazyk["par_email"]} $zpet";}
        if (Empty($_POST["par_jazyk"])){$result .= "$chybnepole: {$this->var->jazyk["par_jazyk"]} $zpet";}
        if (Empty($_POST["par_pohlavi"])){$result .= "$chybnepole: {$this->var->jazyk["par_pohlavi"]} $zpet";}
        if (Empty($_POST["par_datumosloveni"])){$result .= "$chybnepole: {$this->var->jazyk["par_datumosloveni"]} $zpet";}
        if (Empty($_POST["par_datumkalkulace"])){$result .= "$chybnepole: {$this->var->jazyk["par_datumkalkulace"]} $zpet";}
        if (Empty($_POST["par_datumpohovoru"])){$result .= "$chybnepole: {$this->var->jazyk["par_datumpohovoru"]} $zpet";}
        if (Empty($_POST["par_datumzacatek"])){$result .= "$chybnepole: {$this->var->jazyk["par_datumzacatek"]} $zpet";}
        if (Empty($_POST["par_datumodmitnuti"])){$result .= "$chybnepole: {$this->var->jazyk["par_datumodmitnuti"]} $zpet";}
        if (Empty($_POST["par_datumkonec"])){$result .= "$chybnepole: {$this->var->jazyk["par_datumkonec"]} $zpet";}
        if (Empty($_POST["par_status"])){$result .= "$chybnepole: {$this->var->jazyk["par_status"]} $zpet";}
        if (Empty($_POST["par_celkovaspokojenost"])){$result .= "$chybnepole: {$this->var->jazyk["par_celkovaspokojenost"]} $zpet";}
        //if (Empty($_POST["par_komentar"])){$result .= "$chybnepole: {$this->var->jazyk["par_komentar"]} $zpet";}
      }//případně buď ke kazdemu a nebo na konec
    }

    return $result;
  }
//******************************************************************************
  function PartnerUpravit() //upraví partnera
  {
    $id = $_GET["cislo"];
    settype($id, "integer");

    if (!Empty($id) && $id != 0)
    {
      if ($res = @$this->var->mysqli->query("SELECT partner.id, nazev, jmeno, prijmeni,
                                            ulice, cp, psc, mesto, idzeme,
                                            predvolba, telefon, predvolba1,
                                            telefon1, email, pohlavi,
                                            DATE_FORMAT(datumosloveni, '{$this->var->mysqlden}') as dendatumosloveni,
                                            DATE_FORMAT(datumosloveni, '{$this->var->mysqldatum}') as datumosloveni,
                                            DATE_FORMAT(datumkalkulace, '{$this->var->mysqlden}') as dendatumkalkulace,
                                            DATE_FORMAT(datumkalkulace, '{$this->var->mysqldatum}') as datumkalkulace,
                                            DATE_FORMAT(datumpohovoru, '{$this->var->mysqlden}') as dendatumpohovoru,
                                            DATE_FORMAT(datumpohovoru, '{$this->var->mysqldatum}') as datumpohovoru,
                                            DATE_FORMAT(datumzacatek, '{$this->var->mysqlden}') as dendatumzacatek,
                                            DATE_FORMAT(datumzacatek, '{$this->var->mysqldatum}') as datumzacatek,
                                            DATE_FORMAT(datumodmitnuti, '{$this->var->mysqlden}') as dendatumodmitnuti,
                                            DATE_FORMAT(datumodmitnuti, '{$this->var->mysqldatum}') as datumodmitnuti,
                                            DATE_FORMAT(datumkonec, '{$this->var->mysqlden}') as dendatumkonec,
                                            DATE_FORMAT(datumkonec, '{$this->var->mysqldatum}') as datumkonec,
                                            idstatus, celkovaspokojenost, komentar,
                                            pratelsky, presnost, kompetence,
                                            komunikace, vystupovani, infodostatek,
                                            infosrozumitelne, infoustnisrozumitelne,
                                            infohodnoceni, terminkalkulace, termindodani,
                                            rozpocet, odchylka, spokojenost
                                            FROM partner
                                            WHERE id=$id;"))
      {
        $data = $res->fetch_object();
        $result .= include "{$this->var->form}/edit_partner.php";
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
      }
    }

    if (!Empty($_POST["par_nazev"]) &&
        !Empty($_POST["par_jmeno"]) &&
        //!Empty($_POST["par_prijmeni"]) &&
        //!Empty($_POST["par_ulice"]) &&
        //!Empty($_POST["par_cp"]) &&
        //!Empty($_POST["par_psc"]) &&
        //!Empty($_POST["par_mesto"]) &&
        //!Empty($_POST["par_zeme"]) &&
        //!Empty($_POST["par_pred"]) &&
        //!Empty($_POST["par_tel"]) &&
        //!Empty($_POST["par_pred1"]) &&
        //!Empty($_POST["par_tel1"]) &&
        //!Empty($_POST["par_email"]) &&
        //!Empty($_POST["par_jazyk"]) &&
        //!Empty($_POST["par_pohlavi"]) &&
        //!Empty($_POST["par_datumosloveni"]) &&
        //!Empty($_POST["par_datumkalkulace"]) &&
        //!Empty($_POST["par_datumpohovoru"]) &&
        //!Empty($_POST["par_datumzacatek"]) &&
        //!Empty($_POST["par_datumodmitnuti"]) &&
        //!Empty($_POST["par_datumkonec"]) &&
        //!Empty($_POST["par_status"]) &&
        //!Empty($_POST["par_celkovaspokojenost"]) &&
        //!Empty($_POST["par_komentar"]) &&
        !Empty($_POST["tlacitko"]))
    {
      $par_nazev = stripslashes(htmlspecialchars($_POST["par_nazev"]));
      $par_jmeno = stripslashes(htmlspecialchars($_POST["par_jmeno"]));
      $par_prijmeni = stripslashes(htmlspecialchars($_POST["par_prijmeni"]));
      $par_ulice = stripslashes(htmlspecialchars($_POST["par_ulice"]));
      $par_cp = $_POST["par_cp"];
      settype($par_cp, "integer");
      $par_psc = $_POST["par_psc"];
      settype($par_psc, "integer");
      $par_mesto = stripslashes(htmlspecialchars($_POST["par_mesto"]));
      $par_zeme = $_POST["par_zeme"];
      settype($par_zeme, "integer");
      $par_pred = stripslashes(htmlspecialchars($_POST["par_pred"]));
      $par_tel = stripslashes(htmlspecialchars($_POST["par_tel"]));
      $par_pred1 = stripslashes(htmlspecialchars($_POST["par_pred1"]));
      $par_tel1 = stripslashes(htmlspecialchars($_POST["par_tel1"]));
      $par_email = stripslashes(htmlspecialchars($_POST["par_email"]));
      $par_jazyk = $_POST["par_jazyk"]; //array
      $par_pohlavi = $this->var->main->BoolToInt($_POST["par_pohlavi"]);
      settype($par_pohlavi, "integer");
      $par_datumosloveni = (!Empty($_POST["par_datumosloveni"]) ? date("Y-m-d", strtotime($_POST["par_datumosloveni"])) : "");
      $par_datumkalkulace = (!Empty($_POST["par_datumkalkulace"]) ? date("Y-m-d", strtotime($_POST["par_datumkalkulace"])) : "");
      $par_datumpohovoru = (!Empty($_POST["par_datumpohovoru"]) ? date("Y-m-d", strtotime($_POST["par_datumpohovoru"])) : "");
      $par_datumzacatek = (!Empty($_POST["par_datumzacatek"]) ? date("Y-m-d", strtotime($_POST["par_datumzacatek"])) : "");
      $par_datumodmitnuti = (!Empty($_POST["par_datumodmitnuti"]) ? date("Y-m-d", strtotime($_POST["par_datumodmitnuti"])) : "");
      $par_datumkonec = (!Empty($_POST["par_datumkonec"]) ? date("Y-m-d", strtotime($_POST["par_datumkonec"])) : "");
      $par_status = $_POST["par_status"];
      settype($par_status, "integer");
      $par_celkovaspokojenost = $_POST["par_celkovaspokojenost"];
      settype($par_celkovaspokojenost, "integer");
      $par_komentar = stripslashes(htmlspecialchars($_POST["par_komentar"]));

      $par_existfoto = $this->var->main->BoolToInt($_POST["par_existfoto"]);

      $par_pratelsky = $_POST["par_pratelsky"]; //int
      settype($par_pratelsky, "integer");
      $par_presnost = $_POST["par_presnost"]; //int
      settype($par_presnost, "integer");
      $par_kompetence = $_POST["par_kompetence"]; //int
      settype($par_kompetence, "integer");
      $par_komunikace = $_POST["par_komunikace"]; //int
      settype($par_komunikace, "integer");
      $par_vystupovani = $_POST["par_vystupovani"]; //int
      settype($par_vystupovani, "integer");
      $par_infodostatek = $this->var->main->BoolToInt($_POST["par_infodostatek"]);
      $par_infosruzumitelne = $_POST["par_infosruzumitelne"]; //int
      settype($par_infosruzumitelne, "integer");
      $par_infoustnisrozumitelne = $_POST["par_infoustnisrozumitelne"]; //int
      settype($par_infoustnisrozumitelne, "integer");
      $par_infohodnoceni = $_POST["par_infohodnoceni"]; //int
      settype($par_infohodnoceni, "integer");
      $par_terminkalkulace = $this->var->main->BoolToInt($_POST["par_terminkalkulace"]);
      $par_termindodani = $this->var->main->BoolToInt($_POST["par_termindodani"]);
      $par_rozpocet = $this->var->main->BoolToInt($_POST["par_rozpocet"]);
      $par_odchylka = $_POST["par_odchylka"]; //float
      settype($par_odchylka, "float");
      $par_spokojenost = $_POST["par_spokojenost"]; //int
      settype($par_spokojenost, "integer");

      $this->var->mysqli->multi_query("UPDATE partner SET nazev='$par_nazev' WHERE id=$id;");
      $this->var->mysqli->multi_query("UPDATE partner SET jmeno='$par_jmeno' WHERE id=$id;");
      $this->var->mysqli->multi_query("UPDATE partner SET prijmeni='$par_prijmeni' WHERE id=$id;");
      $this->var->mysqli->multi_query("UPDATE partner SET ulice='$par_ulice' WHERE id=$id;");
      $this->var->mysqli->multi_query("UPDATE partner SET cp=$par_cp WHERE id=$id;");
      $this->var->mysqli->multi_query("UPDATE partner SET psc=$par_psc WHERE id=$id;");
      $this->var->mysqli->multi_query("UPDATE partner SET mesto='$par_mesto' WHERE id=$id;");
      $this->var->mysqli->multi_query("UPDATE partner SET idzeme=$par_zeme WHERE id=$id;");
      $this->var->mysqli->multi_query("UPDATE partner SET predvolba='$par_pred' WHERE id=$id;");
      $this->var->mysqli->multi_query("UPDATE partner SET telefon='$par_tel' WHERE id=$id;");
      $this->var->mysqli->multi_query("UPDATE partner SET predvolba1='$par_pred1' WHERE id=$id;");
      $this->var->mysqli->multi_query("UPDATE partner SET telefon1='$par_tel1' WHERE id=$id;");
      $this->var->mysqli->multi_query("UPDATE partner SET email='$par_email' WHERE id=$id;");
      $this->var->mysqli->multi_query("UPDATE partner SET pohlavi=$par_pohlavi WHERE id=$id;");
      $this->var->mysqli->multi_query("UPDATE partner SET datumosloveni='$par_datumosloveni' WHERE id=$id;");
      $this->var->mysqli->multi_query("UPDATE partner SET datumkalkulace='$par_datumkalkulace' WHERE id=$id;");
      $this->var->mysqli->multi_query("UPDATE partner SET datumpohovoru='$par_datumpohovoru' WHERE id=$id;");
      $this->var->mysqli->multi_query("UPDATE partner SET datumzacatek='$par_datumzacatek' WHERE id=$id;");
      $this->var->mysqli->multi_query("UPDATE partner SET datumodmitnuti='$par_datumodmitnuti' WHERE id=$id;");
      $this->var->mysqli->multi_query("UPDATE partner SET datumkonec='$par_datumkonec' WHERE id=$id;");
      $this->var->mysqli->multi_query("UPDATE partner SET idstatus=$par_status WHERE id=$id;");
      $this->var->mysqli->multi_query("UPDATE partner SET celkovaspokojenost=$par_celkovaspokojenost WHERE id=$id;");
      $this->var->mysqli->multi_query("UPDATE partner SET komentar='$par_komentar' WHERE id=$id;");
      $this->var->mysqli->multi_query("UPDATE partner SET pratelsky=$par_pratelsky WHERE id=$id;");
      $this->var->mysqli->multi_query("UPDATE partner SET presnost=$par_presnost WHERE id=$id;");
      $this->var->mysqli->multi_query("UPDATE partner SET kompetence=$par_kompetence WHERE id=$id;");
      $this->var->mysqli->multi_query("UPDATE partner SET komunikace=$par_komunikace WHERE id=$id;");
      $this->var->mysqli->multi_query("UPDATE partner SET vystupovani=$par_vystupovani WHERE id=$id;");
      $this->var->mysqli->multi_query("UPDATE partner SET infodostatek=$par_infodostatek WHERE id=$id;");
      $this->var->mysqli->multi_query("UPDATE partner SET infosrozumitelne=$par_infosruzumitelne WHERE id=$id;");
      $this->var->mysqli->multi_query("UPDATE partner SET infoustnisrozumitelne=$par_infoustnisrozumitelne WHERE id=$id;");
      $this->var->mysqli->multi_query("UPDATE partner SET infohodnoceni=$par_infohodnoceni WHERE id=$id;");
      $this->var->mysqli->multi_query("UPDATE partner SET terminkalkulace=$par_terminkalkulace WHERE id=$id;");
      $this->var->mysqli->multi_query("UPDATE partner SET termindodani=$par_termindodani WHERE id=$id;");
      $this->var->mysqli->multi_query("UPDATE partner SET rozpocet=$par_rozpocet WHERE id=$id;");
      $this->var->mysqli->multi_query("UPDATE partner SET odchylka=$par_odchylka WHERE id=$id;");
      $this->var->mysqli->multi_query("UPDATE partner SET spokojenost=$par_spokojenost WHERE id=$id;");

      if (count($par_jazyk) != 0)
      {
        $this->UpravitNekolikJazyk($id);
      }

      if (!Empty($_FILES["fotka"]["tmp_name"]) && $par_existfoto == 1) //nepovinné
      {
        $this->UpravitFotku($id); //přidá foto dle id
      }

      if ($par_existfoto == 0)
      {
        $this->SmazatFotku($id);  //smaže fotku
      }

      $nazev = $par_nazev;
      $result = include "{$this->var->form}/edit_true.php";
      $this->var->main->AutoClick(1, "?action={$_GET["action"]}&akce={$_GET["akce"]}");  //auto kliknutí
    }
      else
    {
      if (!Empty($_POST["tlacitko"]))
      {
        $zpet = "{$this->var->main->OdkazZ5()}<br />";
        $chybnepole = $this->var->jazyk["chybapole"];
        if (Empty($_POST["par_nazev"])){$result .= "$chybnepole: {$this->var->jazyk["par_nazev"]} $zpet";}
        if (Empty($_POST["par_jmeno"])){$result .= "$chybnepole: {$this->var->jazyk["par_jmeno"]} $zpet";}
        if (Empty($_POST["par_prijmeni"])){$result .= "$chybnepole: {$this->var->jazyk["par_prijmeni"]} $zpet";}
        if (Empty($_POST["par_ulice"])){$result .= "$chybnepole: {$this->var->jazyk["par_ulice"]} $zpet";}
        if (Empty($_POST["par_cp"])){$result .= "$chybnepole: {$this->var->jazyk["par_cp"]} $zpet";}
        if (Empty($_POST["par_psc"])){$result .= "$chybnepole: {$this->var->jazyk["par_psc"]} $zpet";}
        if (Empty($_POST["par_mesto"])){$result .= "$chybnepole: {$this->var->jazyk["par_mesto"]} $zpet";}
        if (Empty($_POST["par_zeme"])){$result .= "$chybnepole: {$this->var->jazyk["par_zeme"]} $zpet";}
        if (Empty($_POST["par_pred"])){$result .= "$chybnepole: {$this->var->jazyk["par_pred"]} $zpet";}
        if (Empty($_POST["par_tel"])){$result .= "$chybnepole: {$this->var->jazyk["par_tel"]} $zpet";}
        //if (Empty($_POST["par_pred1"])){$result .= "$chybnepole: {$this->var->jazyk["par_pred1"]} $zpet";}
        //if (Empty($_POST["par_tel1"])){$result .= "$chybnepole: {$this->var->jazyk["par_tel1"]} $zpet";}
        if (Empty($_POST["par_email"])){$result .= "$chybnepole: {$this->var->jazyk["par_email"]} $zpet";}
        if (Empty($_POST["par_jazyk"])){$result .= "$chybnepole: {$this->var->jazyk["par_jazyk"]} $zpet";}
        if (Empty($_POST["par_pohlavi"])){$result .= "$chybnepole: {$this->var->jazyk["par_pohlavi"]} $zpet";}
        if (Empty($_POST["par_datumosloveni"])){$result .= "$chybnepole: {$this->var->jazyk["par_datumosloveni"]} $zpet";}
        if (Empty($_POST["par_datumkalkulace"])){$result .= "$chybnepole: {$this->var->jazyk["par_datumkalkulace"]} $zpet";}
        if (Empty($_POST["par_datumpohovoru"])){$result .= "$chybnepole: {$this->var->jazyk["par_datumpohovoru"]} $zpet";}
        if (Empty($_POST["par_datumzacatek"])){$result .= "$chybnepole: {$this->var->jazyk["par_datumzacatek"]} $zpet";}
        if (Empty($_POST["par_datumodmitnuti"])){$result .= "$chybnepole: {$this->var->jazyk["par_datumodmitnuti"]} $zpet";}
        if (Empty($_POST["par_datumkonec"])){$result .= "$chybnepole: {$this->var->jazyk["par_datumkonec"]} $zpet";}
        if (Empty($_POST["par_status"])){$result .= "$chybnepole: {$this->var->jazyk["par_status"]} $zpet";}
        if (Empty($_POST["par_celkovaspokojenost"])){$result .= "$chybnepole: {$this->var->jazyk["par_celkovaspokojenost"]} $zpet";}
        //if (Empty($_POST["par_komentar"])){$result .= "$chybnepole: {$this->var->jazyk["par_komentar"]} $zpet";}
      }//případně buď ke kazdemu a nebo na konec
    }

    return $result;
  }
//******************************************************************************
  function PartnerSmazat()  //smazat partnera
  {
    $id = $_GET["cislo"];
    settype($id, "integer");

    if (!Empty($id) && $id != 0)
    {
      if ($res = @$this->var->mysqli->query("SELECT nazev
                                            FROM partner
                                            WHERE id=$id"))
      {
        $data = $res->fetch_object();
        $result .= include "{$this->var->form}/del_partner.php";
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
      $this->var->mysqli->multi_query("DELETE FROM partner WHERE id=$id;");
      $this->var->mysqli->multi_query("DELETE FROM partner_umi_jazyk WHERE idpartner=$id;");
      $this->var->mysqli->multi_query("DELETE FROM fotopartnermini WHERE id=$id;");
      $this->var->mysqli->multi_query("DELETE FROM fotopartnerfull WHERE id=$id;");

      $nazev = $data->nazev;
      $result = include "{$this->var->form}/del_true.php";
      $this->var->main->AutoClick(1, "?action={$_GET["action"]}&akce={$_GET["akce"]}");  //auto kliknutí
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
  function PridatNekolikJazyk($pridaneid) //přidá data do spojovací tabulky jazyka
  {
    $hodnoty = $_POST["par_jazyk"];

    for($i = 0; $i < count($hodnoty); $i++)
    {
      if (!@$this->var->mysqli->multi_query("INSERT INTO partner_umi_jazyk (id, idpartner, idjazyk) VALUES(NULL, $pridaneid, {$hodnoty[$i]});"))
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
      }
    }
  }
//******************************************************************************
  function UpravitNekolikJazyk($pridaneid)  //upraví data do spojovací tabulky jazyka
  {
    if (!@$this->var->mysqli->multi_query("DELETE FROM partner_umi_jazyk WHERE idpartner=$pridaneid;"))
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
    }

    $hodnoty = $_POST["par_jazyk"];

    for($i = 0; $i < count($hodnoty); $i++)
    {
      if (!@$this->var->mysqli->multi_query("INSERT INTO partner_umi_jazyk (id, idpartner, idjazyk) VALUES(NULL, $pridaneid, {$hodnoty[$i]});"))
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
      }
    }
  }
//******************************************************************************
  function PartnerOznacenyEditInfoDostatek($id) //vypíše označený radiobutton
  {
    $oznac[$id] = "checked=\"checked\"";

    $result =
    "
    <input type=\"radio\" name=\"par_infodostatek\" value=\"true\" {$oznac[1]} />{$this->var->jazyk["ano"]}<br />
    <input type=\"radio\" name=\"par_infodostatek\" value=\"false\" {$oznac[0]} />{$this->var->jazyk["ne"]}<br />
    ";

    return $result;
  }
//******************************************************************************
  function PartnerOznacenyEditTerminKalkulace($id) //vypíše označený radiobutton
  {
    $oznac[$id] = "checked=\"checked\"";

    $result =
    "
    <input type=\"radio\" name=\"par_terminkalkulace\" value=\"true\" {$oznac[1]} />{$this->var->jazyk["ano"]}<br />
    <input type=\"radio\" name=\"par_terminkalkulace\" value=\"false\" {$oznac[0]} />{$this->var->jazyk["ne"]}<br />
    ";

    return $result;
  }
//******************************************************************************
  function PartnerOznacenyEditTerminDodani($id) //vypíše označený radiobutton
  {
    $oznac[$id] = "checked=\"checked\"";

    $result =
    "
    <input type=\"radio\" name=\"par_termindodani\" value=\"true\" {$oznac[1]} />{$this->var->jazyk["ano"]}<br />
    <input type=\"radio\" name=\"par_termindodani\" value=\"false\" {$oznac[0]} />{$this->var->jazyk["ne"]}<br />
    ";

    return $result;
  }
//******************************************************************************
  function PartnerOznacenyEditRozpocet($id) //vypíše označený radiobutton
  {
    $oznac[$id] = "checked=\"checked\"";

    $result =
    "
    <input type=\"radio\" name=\"par_rozpocet\" value=\"true\" {$oznac[1]} />{$this->var->jazyk["ano"]}<br />
    <input type=\"radio\" name=\"par_rozpocet\" value=\"false\" {$oznac[0]} />{$this->var->jazyk["ne"]}<br />
    ";

    return $result;
  }
//******************************************************************************
  function PartnerOznacenyEditExistFoto($zamid) //vypíše označený radiobutton edit exist foto
  {
    if ($res = @$this->var->mysqli->query("SELECT id FROM fotopartnermini WHERE id=$zamid"))
    {
      if ($res->num_rows != 0)
      {
        $oznac[1] = "checked=\"checked\"";
      }
        else
      {
        $oznac[0] = "checked=\"checked\"";
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
    }

    $result =
    "
    <input type=\"radio\" name=\"par_existfoto\" value=\"true\" onclick=\"ZablokovaniElementu('fot', false);\" {$oznac[1]} />{$this->var->jazyk["ano"]}
    <input type=\"radio\" name=\"par_existfoto\" value=\"false\" onclick=\"ZablokovaniElementu('fot', true);\" {$oznac[0]} />{$this->var->jazyk["ne"]}
    ";

    return $result;
  }
//******************************************************************************
  function IntToFoto($id)  //zjistí jestli existuje hlavní fotka partnera
  {
    if ($res = @$this->var->mysqli->query("SELECT id FROM fotopartnermini WHERE id=$id"))
    {
      if ($res->num_rows != 0)
      {
        $oznac = 1;
      }
        else
      {
        $oznac = 0;
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->mysqli->error);	//chyba do globální proměnné
    }

    $result = $this->var->main->IntToBool($oznac);

    return $result;
  }
//******************************************************************************
  function PridatFotku($id)  //přidá fotku k partnerovy z jeho id
  {
    $jmeno = $this->var->main->KontrolaNazvu($_FILES["fotka"]["name"]);  //jméno
    $tmp = $_FILES["fotka"]["tmp_name"];  //source
    $typ = $_FILES["fotka"]["type"];  //typ
    $size = $_FILES["fotka"]["size"]; //velikost

    list($w, $h, $t) = getimagesize($tmp);  //šířka, výška

    if (($t == 3 || $t == 2) &&
        ($size <= $this->var->maxsize))
    {
      $this->ZmensiObrazekNaMini($tmp);

      $obr = $this->var->dnpm;
      $u = fopen($obr, "r");  //otevře
      $stream1 = base64_encode(addslashes(fread($u, filesize($obr))));  //odělá '' a zakoduje
      fclose($u); //zavře

      $this->ZmensiObrazekNaFull($tmp);

      $obr = $this->var->dnpf;
      $u = fopen($obr, "r");  //otevře
      $stream2 = base64_encode(addslashes(fread($u, filesize($obr))));  //odělá '' a zakoduje
      fclose($u); //zavře

      if (!@$this->var->mysqli->multi_query("INSERT INTO fotopartnermini (id, foto, nazev, typ) VALUES($id, '$stream1', '$jmeno', '$typ');"))
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
      }

      if (!@$this->var->mysqli->multi_query("INSERT INTO fotopartnerfull (id, foto, nazev, typ) VALUES($id, '$stream2', '$jmeno', '$typ');"))
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->jazyk["foto_err"]);
    }
  }
//******************************************************************************
  function UpravitFotku($id) //upraví fotku s jeho id
  {
    $jmeno = $this->var->main->KontrolaNazvu($_FILES["fotka"]["name"]);  //jméno
    $tmp = $_FILES["fotka"]["tmp_name"];  //source
    $typ = $_FILES["fotka"]["type"];  //typ
    $size = $_FILES["fotka"]["size"]; //velikost

    list($w, $h, $t) = getimagesize($tmp);  //šířka, výška

    if (($t == 3 || $t == 2) &&
        ($size <= $this->var->maxsize))
    {
      $this->ZmensiObrazekNaMini($tmp);

      $obr = $this->var->dnpm;
      $u = fopen($obr, "r");  //otevře
      $stream1 = base64_encode(addslashes(fread($u, filesize($obr))));  //odělá '' a zakoduje
      fclose($u); //zavře

      $this->ZmensiObrazekNaFull($tmp);

      $obr = $this->var->dnpf;
      $u = fopen($obr, "r");  //otevře
      $stream2 = base64_encode(addslashes(fread($u, filesize($obr))));  //odělá '' a zakoduje
      fclose($u); //zavře

      $this->var->mysqli->multi_query("DELETE FROM fotopartnermini WHERE id=$id;");
      $this->var->mysqli->multi_query("DELETE FROM fotopartnerfull WHERE id=$id;");
      $this->var->mysqli->multi_query("INSERT INTO fotopartnermini (id, foto, nazev, typ) VALUES($id, '$stream1', '$jmeno', '$typ');");
      $this->var->mysqli->multi_query("INSERT INTO fotopartnerfull (id, foto, nazev, typ) VALUES($id, '$stream2', '$jmeno', '$typ');");
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->jazyk["foto_err"]);
    }
  }
//******************************************************************************
  function SmazatFotku($id)  //smaze fotku
  {
    if (!Empty($id) && $id != 0)
    {
      $this->var->mysqli->multi_query("DELETE FROM fotopartnermini WHERE id=$id;");
      $this->var->mysqli->multi_query("DELETE FROM fotopartnerfull WHERE id=$id;");
    }
  }
//******************************************************************************
  function ZmensiObrazekNaMini($stream)  //zmenší fotku na požadovany rozmer
  {
		$obr = getimagesize($stream);

		list ($w, $h, $t) = $obr;

		if ($w <= $this->var->miniw)  //když je menší zanechat velikost
		{
      $newwidth = $w;
      $newheight = $h;
    }
      else
    {
      $newwidth = $this->var->miniw; //daná šířka
      $newheight = round($h / ($w / $this->var->miniw)); //výpočet výšky
    }

		$res = @imagecreatetruecolor($newwidth, $newheight);

		switch ($t)
		{
			case 2:	//jpg
				$source = @imagecreatefromjpeg($stream);
				@imagecopyresampled($res, $source, 0, 0, 0, 0, $newwidth, $newheight, $w, $h);
				imagejpeg($res, $this->var->dnpm);
			break;

			case 3:	//png
				$source = @imagecreatefrompng($stream);
				@imagecopyresampled($res, $source, 0, 0, 0, 0, $newwidth, $newheight, $w, $h);
				imagepng($res, $this->var->dnpm);
			break;
		}
  }
//******************************************************************************
  function ZmensiObrazekNaFull($stream)  //zmenší fotku na požadovany rozmer
  {
		$obr = getimagesize($stream);

		list ($w, $h, $t) = $obr;

		if ($w <= $this->var->largw)
		{
      $newwidth = $w;
      $newheight = $h;
    }
      else
    {
      $newwidth = $this->var->largw; //daná šířka
		  $newheight = round($h / ($w / $this->var->largw)); //výpočet výšky
    }

		$res = @imagecreatetruecolor($newwidth, $newheight);

		switch ($t)
		{
			case 2:	//jpg
				$source = @imagecreatefromjpeg($stream);
				@imagecopyresampled($res, $source, 0, 0, 0, 0, $newwidth, $newheight, $w, $h);
				imagejpeg($res, $this->var->dnpf);
			break;

			case 3:	//png
				$source = @imagecreatefrompng($stream);
				@imagecopyresampled($res, $source, 0, 0, 0, 0, $newwidth, $newheight, $w, $h);
				imagepng($res, $this->var->dnpf);
			break;
		}
  }
//******************************************************************************
  function PartnerOznacenyEditPohlavi($id)  //vypíši označené pohlaví v editavi
  {
    $oznac[$id] = "checked=\"checked\"";

    $result =
    "
    <input type=\"radio\" name=\"par_pohlavi\" value=\"true\" {$oznac[1]} />{$this->var->jazyk["muz"]}<br />
    <input type=\"radio\" name=\"par_pohlavi\" value=\"false\" {$oznac[0]} />{$this->var->jazyk["zena"]}
    ";

    return $result;
  }
//******************************************************************************
  function HledaniPartner()
  { 
    $prek = array("nazev" => "par_nazev",
                  "jmeno" => "par_kontakt",
                  "prijmeni" => "par_prijmeni",
                  "ulice" => "par_ulice",
                  "cp" => "par_cp",
                  "psc" => "par_psc",
                  "mesto" => "par_mesto",
                  "predvolba" => "par_tel_p",
                  "telefon" => "par_tel",
                  "predvolba1" => "par_tel1_p",
                  "telefon1" => "par_tel1",
                  "email" => "par_email",
                  "datumosloveni" => "par_datumosloveni",
                  "datumkalkulace" => "par_datumkalkulace",
                  "datumpohovoru" => "par_datumpohovoru",
                  "datumzacatek" => "par_datumzacatek",
                  "datumodmitnuti" => "par_datumodmitnuti",
                  "datumkonec" => "par_datumkonec",
                  "celkovaspokojenost" => "par_celkovaspokojenost",
                  "komentar" => "par_komentar",
                  "pratelsky" => "par_pratelsky",
                  "presnost" => "par_presnost",
                  "kompetence" => "par_kompetence",
                  "komunikace" => "par_komunikace",
                  "vystupovani" => "par_vystupovani",
                  "infosrozumitelne" => "par_infosruzumitelne",
                  "infoustnisrozumitelne" => "par_infoustnisrozumitelne",
                  "infohodnoceni" => "par_infohodnoceni",
                  "odchylka" => "par_odchylka",
                  "spokojenost" => "par_spokojenost"
                  );

//value[0], jazykový ekvyvalent[1], obsah povolení[2], propojovaci id[3], oznaceni v html formě[4], datový typ[5]; (pripojne tabulky[6], zobrazeni pripojne tabulky[7])  pri jine DB se pouziva id z aktualni
    $pridpole = array(array("idzeme", "par_zeme", "{$this->var->main->OznacenyEditZeme($_POST["search_zeme"], "search_zeme")}", "idzeme", "search_zeme", "int"),
                      array("jazyk.id", "par_jazyk", "<br />{$this->var->main->OznacenyEditJazykHledani("search_jazyk")}", "(partner.id=partner_umi_jazyk.idpartner AND partner_umi_jazyk.idjazyk=jazyk.id)", "search_jazyk", "array", ", partner_umi_jazyk, jazyk", "jazyk.jazyk"),
                      array("pohlavi", "par_pohlavi", "{$this->var->main->RadioButton("search_pohlavi", $this->var->main->BoolToInt($_POST["search_pohlavi"]), "muz", "zena")}", "pohlavi", "search_pohlavi", "bool"),
                      array("idstatus", "par_status", "{$this->var->main->OznacenyEditStatus($_POST["search_status"], "search_status")}", "idstatus", "search_status", "int"),
                      array("infodostatek", "par_infodostatek", "{$this->var->main->RadioButton("search_infodostatek", $this->var->main->BoolToInt($_POST["search_infodostatek"]))}", "infodostatek", "search_infodostatek", "bool"),
                      array("terminkalkulace", "par_terminkalkulace", "{$this->var->main->RadioButton("search_terminkalkulace", $this->var->main->BoolToInt($_POST["search_terminkalkulace"]))}", "terminkalkulace", "search_terminkalkulace", "bool"),
                      array("termindodani", "par_termindodani", "{$this->var->main->RadioButton("search_termindodani", $this->var->main->BoolToInt($_POST["search_termindodani"]))}", "termindodani", "search_termindodani", "bool"),
                      array("rozpocet", "par_rozpocet", "{$this->var->main->RadioButton("search_rozpocet", $this->var->main->BoolToInt($_POST["search_rozpocet"]))}", "rozpocet", "search_rozpocet", "bool")
                      );

    for($i = 0; $i < count($pridpole); $i++)
    {
      $pridavek .=
      "<input type=\"checkbox\" name=\"pridavek[{$i}]\" value=\"{$pridpole[$i][0]}\" ".(!Empty($_POST[pridavek]) && in_array($pridpole[$i][0], $_POST[pridavek]) ? "checked=\"checked\"" : "")." /> {$this->var->jazyk[$pridpole[$i][1]]}: {$pridpole[$i][2]}<br />
      ";
    }

    if ($res = @$this->var->mysqli->query("SELECT nazev, jmeno, prijmeni, ulice, cp, psc, mesto, predvolba, telefon, predvolba1, telefon1, email, datumosloveni, datumkalkulace, datumpohovoru, datumzacatek, datumodmitnuti, datumkonec, celkovaspokojenost, komentar, pratelsky, presnost, kompetence, komunikace, vystupovani, infosrozumitelne, infoustnisrozumitelne, infohodnoceni, odchylka, spokojenost FROM partner;"))
    {
      $forma =
      "<form method=\"post\" action=\"\">
      <fieldset>";
      $i = 0;
      while ($data = $res->fetch_field()) //nacteni hlavicky tabulky, pro dalsi dotaz
      {
        $i++;
        $hlavicka .=                                                                                                                                                                                                             //pocet sloupcu
        "<input type=\"checkbox\" name=\"header[]\" value=\"{$data->name}\" ".(!Empty($_POST["header"]) && in_array($data->name, $_POST["header"]) ? "checked=\"checked\"" : "")." /> {$this->var->jazyk[$prek[$data->name]]}".(fmod($i ,2) == 0 ? "<br />" : "&nbsp;&nbsp;&nbsp;")."
        ";
        $telicko .=
        "<input type=\"checkbox\" name=\"body[]\" value=\"{$data->name}\" ".(!Empty($_POST["body"]) && in_array($data->name, $_POST["body"]) ? "checked=\"checked\"" : "")." /> {$this->var->jazyk[$prek[$data->name]]}".(fmod($i ,2) == 0 ? "<br />" : "&nbsp;&nbsp;&nbsp;")."
        ";
      }
      $forma .=
      "{$this->var->jazyk["showcolumn"]}:<br />
      {$hlavicka}
      <br /><br />

      {$this->var->jazyk["searchcolumn"]}:<br />
      {$telicko}
      <br /><br />
      {$pridavek}<br />

      {$this->var->jazyk["zpusobhledani"]}:<br />
      <input type=\"radio\" name=\"zpusob\" value=\"like\" ".(Empty($_POST["zpusob"]) || $_POST["zpusob"] == "like" ? "checked=\"checked\"" : "")." />{$this->var->jazyk["priblizny"]}<br />
      <input type=\"radio\" name=\"zpusob\" value=\"equal\" ".($_POST["zpusob"] == "equal" ? "checked=\"checked\"" : "")." />{$this->var->jazyk["presny"]}<br />
      <input type=\"radio\" name=\"zpusob\" value=\"notequal\" ".($_POST["zpusob"] == "notequal" ? "checked=\"checked\"" : "")." />{$this->var->jazyk["nepresny"]}<br />
      <br />
      {$this->var->jazyk["logickyhledani"]}:<br />
      <input type=\"radio\" name=\"logicky\" value=\"OR\" ".(Empty($_POST["logicky"]) || $_POST["logicky"] == "OR" ? "checked=\"checked\"" : "")." />{$this->var->jazyk["search_or"]}<br />
      <input type=\"radio\" name=\"logicky\" value=\"AND\" ".($_POST["logicky"] == "AND" ? "checked=\"checked\"" : "")." />{$this->var->jazyk["search_and"]}<br />
      <br />
      {$this->var->jazyk["hledane"]}: <input type=\"text\" id=\"id_vyraz\" name=\"vyraz\" value=\"{$_POST["vyraz"]}\" /><br />
      <br />
      <input type=\"submit\" name=\"tlacitko\" value=\"{$this->var->jazyk["search"]}\" />
      </fieldset>
      </form>";
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
    }

    $result .= include "{$this->var->form}/hledani_partner.php";

    if (count($_POST["header"]) > 0 &&
        ((count($_POST["body"]) > 0 &&      //vyplneno: body, pridavek, vyraz
        count($_POST["pridavek"]) > 0 &&
        !Empty($_POST["vyraz"])) ||
        (count($_POST["pridavek"]) > 0) ||  //vyplneno: pridavek
        (count($_POST["body"]) > 0 &&       //vyplneno: body, vyraz
        !Empty($_POST["vyraz"]))) &&
        !Empty($_POST["tlacitko"]))
    {
      for ($i = 0; $i < count($_POST["header"]); $i++)  //slozeni hlavicky
      {
        if (strpos($_POST["header"][$i], "datum") === 0)
        {
          $dotaz .= "DATE_FORMAT({$_POST["header"][$i]}, '{$this->var->mysqldatum}') as {$_POST["header"][$i]}, ";
        }
          else
        {
          $dotaz .= "{$_POST["header"][$i]}, ";
        }
      }

      for ($i = 0; $i < count($_POST["body"]); $i++)  //slozeni telicka
      {
        if (strpos($_POST["body"][$i], "datum") === 0)
        {
          switch ($_POST["zpusob"]) //datumove
          {
            case "like":
              $kde .= "({$_POST["body"][$i]} LIKE ('%".date("Y-m-d", strtotime($_POST["vyraz"]))."%')) {$_POST["logicky"]} ";
            break;

            case "equal":
              $kde .= "{$_POST["body"][$i]}='".date("Y-m-d", strtotime($_POST["vyraz"]))."' {$_POST["logicky"]} ";
            break;

            case "notequal":
              $kde .= "{$_POST["body"][$i]}!='".date("Y-m-d", strtotime($_POST["vyraz"]))."' {$_POST["logicky"]} ";
            break;
          }
        }
          else
        {
          switch ($_POST["zpusob"]) //nedatumove
          {
            case "like":
              $kde .= "({$_POST["body"][$i]} LIKE ('%{$_POST["vyraz"]}%')) {$_POST["logicky"]} ";
            break;

            case "equal":
              $kde .= "{$_POST["body"][$i]}='{$_POST["vyraz"]}' {$_POST["logicky"]} ";
            break;

            case "notequal":
              $kde .= "{$_POST["body"][$i]}!='{$_POST["vyraz"]}' {$_POST["logicky"]} ";
            break;
          }
        }
      }

      if (!Empty($_POST["pridavek"]))
      {
        $j = 0; //cyklus pocitajici pole
        for ($i = 0; $i < count($pridpole); $i++)
        {
          if ($pridpole[$i][0] == $_POST["pridavek"][$i])
          {
            $array[$j] = $pridpole[$i][5];
            $j++;
          }
        }
        $array = array_count_values($array);
        $pocarray = $array["array"];
      }

      $from = "";
      $a = 0;
      for ($i = 0; $i < count($pridpole); $i++) //slozeni telicka 2
      {
        if ($_POST["pridavek"][$i] == $pridpole[$i][0]) //vybrani jen povolenych dotazu
        {
          switch($pridpole[$i][5])
          {
            case "int": //cislo
              $kde .= "{$pridpole[$i][3]}={$_POST[$pridpole[$i][4]]} {$_POST["logicky"]} ";
            break;

            case "bool":  //bool
              $kde .= "{$pridpole[$i][3]}={$this->var->main->BoolToInt($_POST[$pridpole[$i][4]])} {$_POST["logicky"]} ";
            break;

            case "array": //array
              for ($j = 0; $j < count($_POST[$pridpole[$i][4]]); $j++)
              {
                $arr .= ($j == 0 ? "(" : "")."{$pridpole[$i][0]}={$_POST[$pridpole[$i][4]][$j]}".($j == (count($_POST[$pridpole[$i][4]]) - 1) ? ")" : "").($j != (count($_POST[$pridpole[$i][4]]) - 1) ? " OR " : "");
              }
              $a++;
              $from .= $pridpole[$i][6];
              $kde .= "{$pridpole[$i][3]} AND {$arr} ".($pocarray == $a ? "GROUP BY partner.id {$_POST["logicky"]} " : "{$_POST["logicky"]} "); //zamerne doplneno AND
              $dotaz .= "{$pridpole[$i][7]}, ";
              $arr = "";  //vynulování
            break;
          } //end case
        } //end if
      } //end for

      $dotaz = substr($dotaz, 0, -2); //odstraneni posledniho prebytecneho clenu
      $kde = substr($kde, 0, -(strlen($_POST["logicky"]) + 2));

      $sql = "SELECT partner.id, {$dotaz} FROM partner{$from} WHERE {$kde} ORDER BY partner.prijmeni ASC, partner.jmeno ASC;";
      if ($res = @$this->var->mysqli->query($sql))
      {
        if ($res->num_rows != 0)  //kdyz neni 0 radku
        {
          $hlavicka =
          "{$this->var->jazyk["vyhledano"]}: {$res->num_rows} {$this->var->jazyk["polozek"]}
          <table border=\"1\">
          <tr>
          ";

          $i = $j = 0;
          while ($data = $res->fetch_field()) //nacteni hlavicky tabulky, pro dalsi dotaz
          {
            $jmeno = $data->name;
            if ($jmeno != "id")
            {
              $hlavicka .=
              "<td>{$this->var->jazyk[$prek[$jmeno]]}</td>
              ";
              $hlava[$i] = $jmeno;  //nacteni zobrazovane hlavicky
              $i++;
            }
            $alljmeno[$j] = $jmeno; //nacteni cele hlavicky
            $j++;
          }

          $hlavicka .=  //doplneni hlavicky o info, edit a del
          "<td>{$this->var->jazyk["info"]}</td>
          <td>{$this->var->jazyk["edit"]}</td>
          <td>{$this->var->jazyk["del"]}</td>
          </tr>
          ";

          $result .=
          "{$hlavicka}";

          while ($data = $res->fetch_object())  //nacten hlavni tabulky
          {
            $result .=  //radky
            "<tr>
            ";
            for ($i = 0; $i < count($hlava) + 3; $i++)  //skladani hlavniho obsahu hledani + odkaz info a edit
            {
              if ($i < count($hlava)) //sloupce
              { //normalni spoupec
                $result .=
                "<td>{$data->$hlava[$i]}</td>
                ";
              }
                else
              { //systemovy slopec, superadmin se nesmi dat smazat
                $result .=
                "<td>
                  ".($i == count($hlava) ? "<a href=\"?action={$_GET["action"]}&amp;akce=info&amp;cislo={$data->id}\">{$this->var->jazyk["info"]}</a>" : ($i == (count($hlava) + 1) ? "<a href=\"?action={$_GET["action"]}&amp;akce=edit&amp;cislo={$data->id}\">{$this->var->jazyk["edit"]}</a>" : "<a href=\"?action={$_GET["action"]}&amp;akce=del&amp;cislo={$data->id}\">{$this->var->jazyk["del"]}</a>"))."
                </td>
                ";
              }
            }
            $result .=
            "</tr>
            ";
          }
          $result .=
          "</table>
          ";
        }
          else
        {
          $result .= $this->var->main->EmptyLine(); //tady jen prida prazdny zadek
        }
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
      }
    }

    return $result;
  }
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
}
?>
