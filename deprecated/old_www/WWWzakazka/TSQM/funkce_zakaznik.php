<?php
class Zakaznik
{
  public $var;
//******************************************************************************
  function __construct(&$var) //konstruktor
  {
    $this->var = $var;
  }
//******************************************************************************
  function ZakaznikEditDel() //vypis zakaznik + edit, del
  {
    $strankovani = $this->var->main->Strankovani("zakaznik", $od, $poc);

    if ($res = @$this->var->mysqli->query("SELECT id, nazev, jmeno, prijmeni, ulice, cp, psc, mesto, predvolba, telefon
                                          FROM zakaznik
                                          ORDER BY prijmeni ASC, jmeno ASC
                                          LIMIT {$od}, {$poc};"))
    {
      if ($res->num_rows != 0)
      {
        $result = //výpis zemí
        "{$strankovani}
        <table border=\"1\">
          <tr>
            <td>{$this->var->jazyk["zak_nazev"]}</td>
            <td>{$this->var->jazyk["zak_jmeno"]} {$this->var->jazyk["zak_prijmeni"]}</td>
            <td>{$this->var->jazyk["zak_foto"]}</td>
            <td>{$this->var->jazyk["zak_ulice"]}</td>
            <td>{$this->var->jazyk["zak_cp"]}</td>
            <td>{$this->var->jazyk["zak_psc"]}</td>
            <td>{$this->var->jazyk["zak_mesto"]}</td>
            <td>{$this->var->jazyk["zak_tel"]}</td>
            ".($this->var->main->PristupOdkaz("zakaznici", "info") ? "<td>{$this->var->jazyk["info"]}</td>": "")."
            ".($this->var->main->PristupOdkaz("zakaznici", "edit") ? "<td>{$this->var->jazyk["edit"]}</td>": "")."
            ".($this->var->main->PristupOdkaz("zakaznici", "del") ? "<td>{$this->var->jazyk["del"]}</td>": "")."
          </tr>";

        while ($data = $res->fetch_object())
        {
          $result .=
          "
          <tr>
            <td>".(!Empty($data->nazev) ? "{$data->nazev}" : $this->var->emptypol)."</td>
            <td>{$data->jmeno} {$data->prijmeni}</td>
            <td><img src=\"foto.php?sekce=zakaznicimini&amp;id={$data->id}\" alt=\"\" /></td>
            <td>".(!Empty($data->ulice) ? "{$data->ulice}" : $this->var->emptypol)."</td>
            <td>{$data->cp}</td>
            <td>".(!Empty($data->psc) ? "{$data->psc}" : $this->var->emptypol)."</td>
            <td>".(!Empty($data->mesto) ? "{$data->mesto}" : $this->var->emptypol)."</td>
            <td>".(!Empty($data->telefon) ? "{$data->predvolba} {$data->telefon}" : $this->var->emptypol)."</td>
            ".($this->var->main->PristupOdkaz("zakaznici", "info") ? "<td><a href=\"?action={$_GET["action"]}&amp;akce=info&amp;cislo={$data->id}\">{$this->var->jazyk["info"]}</a></td>": "")."
            ".($this->var->main->PristupOdkaz("zakaznici", "edit") ? "<td><a href=\"?action={$_GET["action"]}&amp;akce=edit&amp;cislo={$data->id}\">{$this->var->jazyk["edit"]}</a></td>": "")."
            ".($this->var->main->PristupOdkaz("zakaznici", "del") ? "<td><a href=\"?action={$_GET["action"]}&amp;akce=del&amp;cislo={$data->id}\">{$this->var->jazyk["del"]}</a></td>": "")."
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
  function ZakaznikInfoAll() //vypíše kompletni informace o zakaznikovy
  {
    $cislo = $_GET["cislo"];
    settype($cislo, "integer");

    if (!Empty($cislo) && $cislo != 0)
    {
      if ($res = $this->var->mysqli->query("SELECT zakaznik.id, nazev, jmeno, prijmeni,
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
                                            status.status, celkovaspokojenost, komentar
                                            FROM zakaznik, zeme, status
                                            WHERE idzeme=zeme.id AND
                                            idstatus=status.id AND
                                            zakaznik.id=$cislo;"))
      {
        $data = $res->fetch_object();
        $result = include "{$this->var->form}/info_zakaznik.php";
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);
      }
    }

    return $result;
  }
//******************************************************************************
  function ZakaznikPridat()  //prida zakaznika
  {
    $datum = date("d.m.Y");
    $result .= include "{$this->var->form}/add_zakaznik.php";

    if (!Empty($_POST["zak_nazev"]) &&
        !Empty($_POST["zak_jmeno"]) &&
        !Empty($_POST["tlacitko"]))
    {
      $zak_nazev = stripslashes(htmlspecialchars($_POST["zak_nazev"]));
      $zak_jmeno = stripslashes(htmlspecialchars($_POST["zak_jmeno"]));
      $zak_prijmeni = stripslashes(htmlspecialchars($_POST["zak_prijmeni"]));
      $zak_ulice = stripslashes(htmlspecialchars($_POST["zak_ulice"]));
      $zak_cp = $_POST["zak_cp"];
      settype($zak_cp, "integer");
      $zak_psc = $_POST["zak_psc"];
      settype($zak_psc, "integer");
      $zak_mesto = stripslashes(htmlspecialchars($_POST["zak_mesto"]));
      $zak_zeme = $_POST["zak_zeme"];
      settype($zak_zeme, "integer");
      $zak_pred = stripslashes(htmlspecialchars($_POST["zak_pred"]));
      $zak_tel = stripslashes(htmlspecialchars($_POST["zak_tel"]));
      $zak_pred1 = stripslashes(htmlspecialchars($_POST["zak_pred1"]));
      $zak_tel1 = stripslashes(htmlspecialchars($_POST["zak_tel1"]));
      $zak_email = stripslashes(htmlspecialchars($_POST["zak_email"]));
      $zak_jazyk = $_POST["zak_jazyk"]; //array
      $zak_pohlavi = $this->var->main->BoolToInt($_POST["zak_pohlavi"]);
      settype($zak_pohlavi, "integer");
      $zak_datumosloveni = (!Empty($_POST["zak_datumosloveni"]) ? date("Y-m-d", strtotime($_POST["zak_datumosloveni"])) : "");
      $zak_datumkalkulace = (!Empty($_POST["zak_datumkalkulace"]) ? date("Y-m-d", strtotime($_POST["zak_datumkalkulace"])) : "");
      $zak_datumpohovoru = (!Empty($_POST["zak_datumpohovoru"]) ? date("Y-m-d", strtotime($_POST["zak_datumpohovoru"])) : "");
      $zak_datumzacatek = (!Empty($_POST["zak_datumzacatek"]) ? date("Y-m-d", strtotime($_POST["zak_datumzacatek"])) : "");
      $zak_datumodmitnuti = (!Empty($_POST["zak_datumodmitnuti"]) ? date("Y-m-d", strtotime($_POST["zak_datumodmitnuti"])) : "");
      $zak_datumkonec = (!Empty($_POST["zak_datumkonec"]) ? date("Y-m-d", strtotime($_POST["zak_datumkonec"])) : "");
      $zak_status = $_POST["zak_status"];
      settype($zak_status, "integer");
      $zak_celkovaspokojenost = $_POST["zak_celkovaspokojenost"];
      settype($zak_celkovaspokojenost, "integer");
      $zak_komentar = stripslashes(htmlspecialchars($_POST["zak_komentar"]));

      $zak_existfoto = $this->var->main->BoolToInt($_POST["zak_existfoto"]);

      if ($this->var->mysqli->multi_query("INSERT INTO zakaznik (
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
                                          komentar
                                          ) VALUES(
                                          NULL,
                                          '$zak_nazev',
                                          '$zak_jmeno',
                                          '$zak_prijmeni',
                                          '$zak_ulice',
                                          $zak_cp,
                                          $zak_psc,
                                          '$zak_mesto',
                                          $zak_zeme,
                                          '$zak_pred',
                                          '$zak_tel',
                                          '$zak_pred1',
                                          '$zak_tel1',
                                          '$zak_email',
                                          $zak_pohlavi,
                                          '$zak_datumosloveni',
                                          '$zak_datumkalkulace',
                                          '$zak_datumpohovoru',
                                          '$zak_datumzacatek',
                                          '$zak_datumodmitnuti',
                                          '$zak_datumkonec',
                                          $zak_status,
                                          $zak_celkovaspokojenost,
                                          '$zak_komentar'
                                          );"))
      {
        $idzak = $this->var->mysqli->insert_id;

        if (count($zak_jazyk) != 0)
        {
          $this->PridatNekolikJazyk($idzak);
        }

        if ($zak_existfoto == 1)
        {
          $this->PridatFotku($idzak);
        }

        $nazev = $zak_nazev;
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
        if (Empty($_POST["zak_nazev"])){$result .= "$chybnepole: {$this->var->jazyk["zak_nazev"]} $zpet";}
        if (Empty($_POST["zak_jmeno"])){$result .= "$chybnepole: {$this->var->jazyk["zak_jmeno"]} $zpet";}
        if (Empty($_POST["zak_prijmeni"])){$result .= "$chybnepole: {$this->var->jazyk["zak_prijmeni"]} $zpet";}
        if (Empty($_POST["zak_ulice"])){$result .= "$chybnepole: {$this->var->jazyk["zak_ulice"]} $zpet";}
        if (Empty($_POST["zak_cp"])){$result .= "$chybnepole: {$this->var->jazyk["zak_cp"]} $zpet";}
        if (Empty($_POST["zak_psc"])){$result .= "$chybnepole: {$this->var->jazyk["zak_psc"]} $zpet";}
        if (Empty($_POST["zak_mesto"])){$result .= "$chybnepole: {$this->var->jazyk["zak_mesto"]} $zpet";}
        if (Empty($_POST["zak_zeme"])){$result .= "$chybnepole: {$this->var->jazyk["zak_zeme"]} $zpet";}
        if (Empty($_POST["zak_pred"])){$result .= "$chybnepole: {$this->var->jazyk["zak_pred"]} $zpet";}
        if (Empty($_POST["zak_tel"])){$result .= "$chybnepole: {$this->var->jazyk["zak_tel"]} $zpet";}
        //if (Empty($_POST["zak_pred1"])){$result .= "$chybnepole: {$this->var->jazyk["zak_pred1"]} $zpet";}
        //if (Empty($_POST["zak_tel1"])){$result .= "$chybnepole: {$this->var->jazyk["zak_tel1"]} $zpet";}
        if (Empty($_POST["zak_email"])){$result .= "$chybnepole: {$this->var->jazyk["zak_email"]} $zpet";}
        if (Empty($_POST["zak_jazyk"])){$result .= "$chybnepole: {$this->var->jazyk["zak_jazyk"]} $zpet";}
        if (Empty($_POST["zak_pohlavi"])){$result .= "$chybnepole: {$this->var->jazyk["zak_pohlavi"]} $zpet";}
        if (Empty($_POST["zak_datumosloveni"])){$result .= "$chybnepole: {$this->var->jazyk["zak_datumosloveni"]} $zpet";}
        if (Empty($_POST["zak_datumkalkulace"])){$result .= "$chybnepole: {$this->var->jazyk["zak_datumkalkulace"]} $zpet";}
        if (Empty($_POST["zak_datumpohovoru"])){$result .= "$chybnepole: {$this->var->jazyk["zak_datumpohovoru"]} $zpet";}
        if (Empty($_POST["zak_datumzacatek"])){$result .= "$chybnepole: {$this->var->jazyk["zak_datumzacatek"]} $zpet";}
        if (Empty($_POST["zak_datumodmitnuti"])){$result .= "$chybnepole: {$this->var->jazyk["zak_datumodmitnuti"]} $zpet";}
        if (Empty($_POST["zak_datumkonec"])){$result .= "$chybnepole: {$this->var->jazyk["zak_datumkonec"]} $zpet";}
        if (Empty($_POST["zak_status"])){$result .= "$chybnepole: {$this->var->jazyk["zak_status"]} $zpet";}
        if (Empty($_POST["zak_celkovaspokojenost"])){$result .= "$chybnepole: {$this->var->jazyk["zak_celkovaspokojenost"]} $zpet";}
        //if (Empty($_POST["zak_komentar"])){$result .= "$chybnepole: {$this->var->jazyk["zak_komentar"]} $zpet";}
      }//případně buď ke kazdemu a nebo na konec
    }

    return $result;
  }
//******************************************************************************
  function ZakaznikUpravit() //upravi zakaznika
  {
    $id = $_GET["cislo"];
    settype($id, "integer");

    if (!Empty($id) && $id != 0)
    {
      if ($res = @$this->var->mysqli->query("SELECT zakaznik.id, nazev, jmeno, prijmeni,
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
                                            idstatus, celkovaspokojenost, komentar
                                            FROM zakaznik
                                            WHERE id=$id;"))
      {
        $data = $res->fetch_object();
        $result .= include "{$this->var->form}/edit_zakaznik.php";
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
      }
    }

    if (!Empty($_POST["zak_nazev"]) &&
        !Empty($_POST["zak_jmeno"]) &&
        !Empty($_POST["tlacitko"]))
    {
      $zak_nazev = stripslashes(htmlspecialchars($_POST["zak_nazev"]));
      $zak_jmeno = stripslashes(htmlspecialchars($_POST["zak_jmeno"]));
      $zak_prijmeni = stripslashes(htmlspecialchars($_POST["zak_prijmeni"]));
      $zak_ulice = stripslashes(htmlspecialchars($_POST["zak_ulice"]));
      $zak_cp = $_POST["zak_cp"];
      settype($zak_cp, "integer");
      $zak_psc = $_POST["zak_psc"];
      settype($zak_psc, "integer");
      $zak_mesto = stripslashes(htmlspecialchars($_POST["zak_mesto"]));
      $zak_zeme = $_POST["zak_zeme"];
      settype($zak_zeme, "integer");
      $zak_pred = stripslashes(htmlspecialchars($_POST["zak_pred"]));
      $zak_tel = stripslashes(htmlspecialchars($_POST["zak_tel"]));
      $zak_pred1 = stripslashes(htmlspecialchars($_POST["zak_pred1"]));
      $zak_tel1 = stripslashes(htmlspecialchars($_POST["zak_tel1"]));
      $zak_email = stripslashes(htmlspecialchars($_POST["zak_email"]));
      $zak_jazyk = $_POST["zak_jazyk"]; //array
      $zak_pohlavi = $this->var->main->BoolToInt($_POST["zak_pohlavi"]);
      settype($zak_pohlavi, "integer");
      $zak_datumosloveni = (!Empty($_POST["zak_datumosloveni"]) ? date("Y-m-d", strtotime($_POST["zak_datumosloveni"])) : "");
      $zak_datumkalkulace = (!Empty($_POST["zak_datumkalkulace"]) ? date("Y-m-d", strtotime($_POST["zak_datumkalkulace"])) : "");
      $zak_datumpohovoru = (!Empty($_POST["zak_datumpohovoru"]) ? date("Y-m-d", strtotime($_POST["zak_datumpohovoru"])) : "");
      $zak_datumzacatek = (!Empty($_POST["zak_datumzacatek"]) ? date("Y-m-d", strtotime($_POST["zak_datumzacatek"])) : "");
      $zak_datumodmitnuti = (!Empty($_POST["zak_datumodmitnuti"]) ? date("Y-m-d", strtotime($_POST["zak_datumodmitnuti"])) : "");
      $zak_datumkonec = (!Empty($_POST["zak_datumkonec"]) ? date("Y-m-d", strtotime($_POST["zak_datumkonec"])) : "");
      $zak_status = $_POST["zak_status"];
      settype($zak_status, "integer");
      $zak_celkovaspokojenost = $_POST["zak_celkovaspokojenost"];
      settype($zak_celkovaspokojenost, "integer");
      $zak_komentar = stripslashes(htmlspecialchars($_POST["zak_komentar"]));

      $zak_existfoto = $this->var->main->BoolToInt($_POST["zak_existfoto"]);

      $this->var->mysqli->multi_query("UPDATE zakaznik SET nazev='$zak_nazev' WHERE id=$id;");
      $this->var->mysqli->multi_query("UPDATE zakaznik SET jmeno='$zak_jmeno' WHERE id=$id;");
      $this->var->mysqli->multi_query("UPDATE zakaznik SET prijmeni='$zak_prijmeni' WHERE id=$id;");
      $this->var->mysqli->multi_query("UPDATE zakaznik SET ulice='$zak_ulice' WHERE id=$id;");
      $this->var->mysqli->multi_query("UPDATE zakaznik SET cp=$zak_cp WHERE id=$id;");
      $this->var->mysqli->multi_query("UPDATE zakaznik SET psc=$zak_psc WHERE id=$id;");
      $this->var->mysqli->multi_query("UPDATE zakaznik SET mesto='$zak_mesto' WHERE id=$id;");
      $this->var->mysqli->multi_query("UPDATE zakaznik SET idzeme=$zak_zeme WHERE id=$id;");
      $this->var->mysqli->multi_query("UPDATE zakaznik SET predvolba='$zak_pred' WHERE id=$id;");
      $this->var->mysqli->multi_query("UPDATE zakaznik SET telefon='$zak_tel' WHERE id=$id;");
      $this->var->mysqli->multi_query("UPDATE zakaznik SET predvolba1='$zak_pred1' WHERE id=$id;");
      $this->var->mysqli->multi_query("UPDATE zakaznik SET telefon1='$zak_tel1' WHERE id=$id;");
      $this->var->mysqli->multi_query("UPDATE zakaznik SET email='$zak_email' WHERE id=$id;");
      $this->var->mysqli->multi_query("UPDATE zakaznik SET pohlavi=$zak_pohlavi WHERE id=$id;");
      $this->var->mysqli->multi_query("UPDATE zakaznik SET datumosloveni='$zak_datumosloveni' WHERE id=$id;");
      $this->var->mysqli->multi_query("UPDATE zakaznik SET datumkalkulace='$zak_datumkalkulace' WHERE id=$id;");
      $this->var->mysqli->multi_query("UPDATE zakaznik SET datumpohovoru='$zak_datumpohovoru' WHERE id=$id;");
      $this->var->mysqli->multi_query("UPDATE zakaznik SET datumzacatek='$zak_datumzacatek' WHERE id=$id;");
      $this->var->mysqli->multi_query("UPDATE zakaznik SET datumodmitnuti='$zak_datumodmitnuti' WHERE id=$id;");
      $this->var->mysqli->multi_query("UPDATE zakaznik SET datumkonec='$zak_datumkonec' WHERE id=$id;");
      $this->var->mysqli->multi_query("UPDATE zakaznik SET idstatus=$zak_status WHERE id=$id;");
      $this->var->mysqli->multi_query("UPDATE zakaznik SET celkovaspokojenost=$zak_celkovaspokojenost WHERE id=$id;");
      $this->var->mysqli->multi_query("UPDATE zakaznik SET komentar='$zak_komentar' WHERE id=$id;");
      $this->var->mysqli->multi_query("UPDATE zakaznik SET pratelsky=$zak_pratelsky WHERE id=$id;");
      $this->var->mysqli->multi_query("UPDATE zakaznik SET presnost=$zak_presnost WHERE id=$id;");
      $this->var->mysqli->multi_query("UPDATE zakaznik SET kompetence=$zak_kompetence WHERE id=$id;");
      $this->var->mysqli->multi_query("UPDATE zakaznik SET komunikace=$zak_komunikace WHERE id=$id;");
      $this->var->mysqli->multi_query("UPDATE zakaznik SET vystupovani=$zak_vystupovani WHERE id=$id;");
      $this->var->mysqli->multi_query("UPDATE zakaznik SET infodostatek=$zak_infodostatek WHERE id=$id;");
      $this->var->mysqli->multi_query("UPDATE zakaznik SET infosrozumitelne=$zak_infosruzumitelne WHERE id=$id;");
      $this->var->mysqli->multi_query("UPDATE zakaznik SET infoustnisrozumitelne=$zak_infoustnisrozumitelne WHERE id=$id;");
      $this->var->mysqli->multi_query("UPDATE zakaznik SET infohodnoceni=$zak_infohodnoceni WHERE id=$id;");
      $this->var->mysqli->multi_query("UPDATE zakaznik SET terminkalkulace=$zak_terminkalkulace WHERE id=$id;");
      $this->var->mysqli->multi_query("UPDATE zakaznik SET termindodani=$zak_termindodani WHERE id=$id;");
      $this->var->mysqli->multi_query("UPDATE zakaznik SET rozpocet=$zak_rozpocet WHERE id=$id;");
      $this->var->mysqli->multi_query("UPDATE zakaznik SET odchylka=$zak_odchylka WHERE id=$id;");
      $this->var->mysqli->multi_query("UPDATE zakaznik SET spokojenost=$zak_spokojenost WHERE id=$id;");

      if (count($zak_jazyk) != 0)
      {
        $this->UpravitNekolikJazyk($id);
      }

      if (!Empty($_FILES["fotka"]["tmp_name"]) && $zak_existfoto == 1) //nepovinné
      {
        $this->UpravitFotku($id); //přidá foto dle id
      }

      if ($zak_existfoto == 0)
      {
        $this->SmazatFotku($id);  //smaže fotku
      }

      $nazev = $zak_nazev;
      $result = include "{$this->var->form}/edit_true.php";
      $this->var->main->AutoClick(1, "?action={$_GET["action"]}&akce={$_GET["akce"]}");  //auto kliknutí
    }
      else
    {
      if (!Empty($_POST["tlacitko"]))
      {
        $zpet = "{$this->var->main->OdkazZ5()}<br />";
        $chybnepole = $this->var->jazyk["chybapole"];
        if (Empty($_POST["zak_nazev"])){$result .= "$chybnepole: {$this->var->jazyk["zak_nazev"]} $zpet";}
        if (Empty($_POST["zak_jmeno"])){$result .= "$chybnepole: {$this->var->jazyk["zak_jmeno"]} $zpet";}
        if (Empty($_POST["zak_prijmeni"])){$result .= "$chybnepole: {$this->var->jazyk["zak_prijmeni"]} $zpet";}
        if (Empty($_POST["zak_ulice"])){$result .= "$chybnepole: {$this->var->jazyk["zak_ulice"]} $zpet";}
        if (Empty($_POST["zak_cp"])){$result .= "$chybnepole: {$this->var->jazyk["zak_cp"]} $zpet";}
        if (Empty($_POST["zak_psc"])){$result .= "$chybnepole: {$this->var->jazyk["zak_psc"]} $zpet";}
        if (Empty($_POST["zak_mesto"])){$result .= "$chybnepole: {$this->var->jazyk["zak_mesto"]} $zpet";}
        if (Empty($_POST["zak_zeme"])){$result .= "$chybnepole: {$this->var->jazyk["zak_zeme"]} $zpet";}
        if (Empty($_POST["zak_pred"])){$result .= "$chybnepole: {$this->var->jazyk["zak_pred"]} $zpet";}
        if (Empty($_POST["zak_tel"])){$result .= "$chybnepole: {$this->var->jazyk["zak_tel"]} $zpet";}
        //if (Empty($_POST["zak_pred1"])){$result .= "$chybnepole: {$this->var->jazyk["zak_pred1"]} $zpet";}
        //if (Empty($_POST["zak_tel1"])){$result .= "$chybnepole: {$this->var->jazyk["zak_tel1"]} $zpet";}
        if (Empty($_POST["zak_email"])){$result .= "$chybnepole: {$this->var->jazyk["zak_email"]} $zpet";}
        if (Empty($_POST["zak_jazyk"])){$result .= "$chybnepole: {$this->var->jazyk["zak_jazyk"]} $zpet";}
        if (Empty($_POST["zak_pohlavi"])){$result .= "$chybnepole: {$this->var->jazyk["zak_pohlavi"]} $zpet";}
        if (Empty($_POST["zak_datumosloveni"])){$result .= "$chybnepole: {$this->var->jazyk["zak_datumosloveni"]} $zpet";}
        if (Empty($_POST["zak_datumkalkulace"])){$result .= "$chybnepole: {$this->var->jazyk["zak_datumkalkulace"]} $zpet";}
        if (Empty($_POST["zak_datumpohovoru"])){$result .= "$chybnepole: {$this->var->jazyk["zak_datumpohovoru"]} $zpet";}
        if (Empty($_POST["zak_datumzacatek"])){$result .= "$chybnepole: {$this->var->jazyk["zak_datumzacatek"]} $zpet";}
        if (Empty($_POST["zak_datumodmitnuti"])){$result .= "$chybnepole: {$this->var->jazyk["zak_datumodmitnuti"]} $zpet";}
        if (Empty($_POST["zak_datumkonec"])){$result .= "$chybnepole: {$this->var->jazyk["zak_datumkonec"]} $zpet";}
        if (Empty($_POST["zak_status"])){$result .= "$chybnepole: {$this->var->jazyk["zak_status"]} $zpet";}
        if (Empty($_POST["zak_celkovaspokojenost"])){$result .= "$chybnepole: {$this->var->jazyk["zak_celkovaspokojenost"]} $zpet";}
        //if (Empty($_POST["zak_komentar"])){$result .= "$chybnepole: {$this->var->jazyk["zak_komentar"]} $zpet";}
      }//případně buď ke kazdemu a nebo na konec
    }

    return $result;
  }
//******************************************************************************
  function ZakaznikSmazat()  //smazat zakaznika
  {
    $id = $_GET["cislo"];
    settype($id, "integer");

    if (!Empty($id) && $id != 0)
    {
      if ($res = @$this->var->mysqli->query("SELECT nazev
                                            FROM zakaznik
                                            WHERE id=$id"))
      {
        $data = $res->fetch_object();
        $result .= include "{$this->var->form}/del_zakaznik.php";
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
      $this->var->mysqli->multi_query("DELETE FROM zakaznik WHERE id=$id;");
      $this->var->mysqli->multi_query("DELETE FROM zakaznik_umi_jazyk WHERE idzakaznik=$id;");
      $this->var->mysqli->multi_query("DELETE FROM fotozakaznikmini WHERE id=$id;");
      $this->var->mysqli->multi_query("DELETE FROM fotozakaznikfull WHERE id=$id;");

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
    $hodnoty = $_POST["zak_jazyk"];

    for($i = 0; $i < count($hodnoty); $i++)
    {
      if (!@$this->var->mysqli->multi_query("INSERT INTO zakaznik_umi_jazyk (id, idzakaznik, idjazyk) VALUES(NULL, $pridaneid, {$hodnoty[$i]});"))
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
      }
    }
  }
//******************************************************************************
  function UpravitNekolikJazyk($pridaneid)  //upraví data do spojovací tabulky jazyka
  {
    if (!@$this->var->mysqli->multi_query("DELETE FROM zakaznik_umi_jazyk WHERE idzakaznik=$pridaneid;"))
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
    }

    $hodnoty = $_POST["zak_jazyk"];

    for($i = 0; $i < count($hodnoty); $i++)
    {
      if (!@$this->var->mysqli->multi_query("INSERT INTO zakaznik_umi_jazyk (id, idzakaznik, idjazyk) VALUES(NULL, $pridaneid, {$hodnoty[$i]});"))
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
      }
    }
  }
//******************************************************************************
  function ZakaznikOznacenyEditPohlavi($id)  //vypíši označené pohlaví v editavi
  {
    $oznac[$id] = "checked=\"checked\"";

    $result =
    "
    <input type=\"radio\" name=\"zak_pohlavi\" value=\"true\" {$oznac[1]} />{$this->var->jazyk["muz"]}<br />
    <input type=\"radio\" name=\"zak_pohlavi\" value=\"false\" {$oznac[0]} />{$this->var->jazyk["zena"]}
    ";

    return $result;
  }
//******************************************************************************
  function ZakaznikOznacenyEditExistFoto($id) //vypíše označený radiobutton edit exist foto
  {
    if ($res = @$this->var->mysqli->query("SELECT id FROM fotozakaznikmini WHERE id=$id"))
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
    <input type=\"radio\" name=\"zak_existfoto\" value=\"true\" onclick=\"ZablokovaniElementu('fot', false);\" {$oznac[1]} />{$this->var->jazyk["ano"]}
    <input type=\"radio\" name=\"zak_existfoto\" value=\"false\" onclick=\"ZablokovaniElementu('fot', true);\" {$oznac[0]} />{$this->var->jazyk["ne"]}
    ";

    return $result;
  }
//******************************************************************************
  function IntToFoto($id)  //zjistí jestli existuje hlavní fotka zakaznika
  {
    if ($res = @$this->var->mysqli->query("SELECT id FROM fotozakaznikmini WHERE id=$id"))
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
  function PridatFotku($id)  //přidá fotku k zakaznikovy z jeho id
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

      $obr = $this->var->dnzam;
      $u = fopen($obr, "r");  //otevře
      $stream1 = base64_encode(addslashes(fread($u, filesize($obr))));  //odělá '' a zakoduje
      fclose($u); //zavře

      $this->ZmensiObrazekNaFull($tmp);

      $obr = $this->var->dnzaf;
      $u = fopen($obr, "r");  //otevře
      $stream2 = base64_encode(addslashes(fread($u, filesize($obr))));  //odělá '' a zakoduje
      fclose($u); //zavře

      if (!@$this->var->mysqli->multi_query("INSERT INTO fotozakaznikmini (id, foto, nazev, typ) VALUES($id, '$stream1', '$jmeno', '$typ');"))
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);	//chyba do globální proměnné
      }

      if (!@$this->var->mysqli->multi_query("INSERT INTO fotozakaznikfull (id, foto, nazev, typ) VALUES($id, '$stream2', '$jmeno', '$typ');"))
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

      $obr = $this->var->dnzam;
      $u = fopen($obr, "r");  //otevře
      $stream1 = base64_encode(addslashes(fread($u, filesize($obr))));  //odělá '' a zakoduje
      fclose($u); //zavře

      $this->ZmensiObrazekNaFull($tmp);

      $obr = $this->var->dnzaf;
      $u = fopen($obr, "r");  //otevře
      $stream2 = base64_encode(addslashes(fread($u, filesize($obr))));  //odělá '' a zakoduje
      fclose($u); //zavře

      $this->var->mysqli->multi_query("DELETE FROM fotozakaznikmini WHERE id=$id;");
      $this->var->mysqli->multi_query("DELETE FROM fotozakaznikfull WHERE id=$id;");
      $this->var->mysqli->multi_query("INSERT INTO fotozakaznikmini (id, foto, nazev, typ) VALUES($id, '$stream1', '$jmeno', '$typ');");
      $this->var->mysqli->multi_query("INSERT INTO fotozakaznikfull (id, foto, nazev, typ) VALUES($id, '$stream2', '$jmeno', '$typ');");
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
      $this->var->mysqli->multi_query("DELETE FROM fotozakaznikmini WHERE id=$id;");
      $this->var->mysqli->multi_query("DELETE FROM fotozakaznikfull WHERE id=$id;");
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
				imagejpeg($res, $this->var->dnzam);
			break;

			case 3:	//png
				$source = @imagecreatefrompng($stream);
				@imagecopyresampled($res, $source, 0, 0, 0, 0, $newwidth, $newheight, $w, $h);
				imagepng($res, $this->var->dnzam);
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
				imagejpeg($res, $this->var->dnzaf);
			break;

			case 3:	//png
				$source = @imagecreatefrompng($stream);
				@imagecopyresampled($res, $source, 0, 0, 0, 0, $newwidth, $newheight, $w, $h);
				imagepng($res, $this->var->dnzaf);
			break;
		}
  }
//******************************************************************************
  function HledaniZakaznik()
  {
    $prek = array("nazev" => "zak_nazev",
                  "jmeno" => "zak_jmeno",
                  "prijmeni" => "zak_prijmeni",
                  "ulice" => "zak_ulice",
                  "cp" => "zak_cp",
                  "psc" => "zak_psc",
                  "mesto" => "zak_mesto",
                  "predvolba" => "zak_tel_p",
                  "telefon" => "zak_tel",
                  "predvolba1" => "zak_tel1_p",
                  "telefon1" => "zak_tel1",
                  "email" => "zak_email",
                  "datumosloveni" => "zak_datumosloveni",
                  "datumkalkulace" => "zak_datumkalkulace",
                  "datumpohovoru" => "zak_datumpohovoru",
                  "datumzacatek" => "zak_datumzacatek",
                  "datumodmitnuti" => "zak_datumodmitnuti",
                  "datumkonec" => "zak_datumkonec",
                  "celkovaspokojenost" => "zak_celkovaspokojenost",
                  "komentar" => "zak_komentar"
                  );

//value[0], jazykový ekvyvalent[1], obsah povolení[2], propojovaci id[3], oznaceni v html formě[4], datový typ[5]; (pripojne tabulky[6], zobrazeni pripojne tabulky[7])  pri jine DB se pouziva id z aktualni
    $pridpole = array(array("idzeme", "zak_zeme", "{$this->var->main->OznacenyEditZeme($_POST["search_zeme"], "search_zeme")}", "idzeme", "search_zeme", "int"),
                      array("pohlavi", "zak_pohlavi", "{$this->var->main->RadioButton("search_pohlavi", $this->var->main->BoolToInt($_POST["search_pohlavi"]), "muz", "zena")}", "pohlavi", "search_pohlavi", "bool"),
                      array("idstatus", "zak_status", "{$this->var->main->OznacenyEditStatus($_POST["search_status"], "search_status")}", "idstatus", "search_status", "int"),
                      );

    for($i = 0; $i < count($pridpole); $i++)
    {
      $pridavek .=
      "<input type=\"checkbox\" name=\"pridavek[{$i}]\" value=\"{$pridpole[$i][0]}\" ".(!Empty($_POST[pridavek]) && in_array($pridpole[$i][0], $_POST[pridavek]) ? "checked=\"checked\"" : "")." /> {$this->var->jazyk[$pridpole[$i][1]]}: {$pridpole[$i][2]}<br />
      ";
    }

    if ($res = @$this->var->mysqli->query("SELECT nazev, jmeno, prijmeni, ulice, cp, psc, mesto, predvolba, telefon, predvolba1, telefon1, email, datumosloveni, datumkalkulace, datumpohovoru, datumzacatek, datumodmitnuti, datumkonec, celkovaspokojenost, komentar FROM zakaznik;"))
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

    $result .= include "{$this->var->form}/hledani_zakaznik.php";

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
              $kde .= "{$pridpole[$i][3]} AND {$arr} ".($pocarray == $a ? "GROUP BY zakaznik.id {$_POST["logicky"]} " : "{$_POST["logicky"]} "); //zamerne doplneno AND
              $dotaz .= "{$pridpole[$i][7]}, ";
              $arr = "";  //vynulování
            break;
          } //end case
        } //end if
      } //end for

      $dotaz = substr($dotaz, 0, -2); //odstraneni posledniho prebytecneho clenu
      $kde = substr($kde, 0, -(strlen($_POST["logicky"]) + 2));

      $sql = "SELECT zakaznik.id, {$dotaz} FROM zakaznik{$from} WHERE {$kde} ORDER BY zakaznik.prijmeni ASC, zakaznik.jmeno ASC;";
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
}
?>
