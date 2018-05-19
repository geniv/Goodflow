<?php
class Zamestnanec
{
  public $var;
//******************************************************************************
  function __construct(&$var) //postará se o předání a vrácení proměnná $this->vat z indexu
  {
    $this->var = $var;
  }
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
//******************************************************************************
  function HlavniMenu()
  {
    $menu = array(array("all", "all_zamestnanec"),
                  array("add", "add_zamestnanec"),
                  array("search", "search_zamestnanec"),
                  array("kompetence", "kompetence_zamestnanec"),
                  array("foto", "fotografie_zamestnanec"),
                  array("doba", "doba_zamestnanec"),
                  array("terminy", "terminy_zamestnanec"),
                  array("statistika", "statistika_zamestnanec"),
                  array("naklady", "naklady_zamestnanec"),
                  array("prava", "prava_zamestnanec"),
                  array("protokoly", "protokoly_zamestnanec"));

    $result .=
"<div class=\"menu_zamestnanec_centralni_background\">
  <span class=\"bokmenu_top\"></span>
    <div>

    ";

    for ($i = 0; $i < count($menu); $i++)
    {
      $result .= ($this->var->main->PristupOdkaz("zamestnanci", $menu[$i][0]) ? "<p".($i == (count($menu) - 1) ? " class=\"posledni\"" : "").">\n<a href=\"?action=zamestnanci&amp;akce={$menu[$i][0]}\" title=\"{$this->var->jazyk[$menu[$i][1]]}\">{$this->var->jazyk[$menu[$i][1]]}</a>\n</p>\n" : "");
    }

    $result .=
"    </div>
  <span class=\"bokmenu_bottom\"></span>
</div>

    ";

    return $result;
  }
//******************************************************************************
  function ZamestnanecOznacenyEditPohlavi($id)  //vypíši označené pohlaví v editavi
  {
    $oznac[$id] = "checked=\"checked\"";

    $result =
    "
    <input type=\"radio\" name=\"zam_pohlavi\" value=\"true\" {$oznac[1]} />{$this->var->jazyk["muz"]}<br />
    <input type=\"radio\" name=\"zam_pohlavi\" value=\"false\" {$oznac[0]} />{$this->var->jazyk["zena"]}
    ";

    return $result;
  }
//******************************************************************************
  function ZamestnanecInfoAll() //vypíše kompletní vípis zaměstnanců
  {
    $cislo = $_GET["cislo"];
    settype($cislo, "integer");

    if (!Empty($cislo) && $cislo != 0)
    {
      if ($res = @$this->var->mysqli->query("SELECT zamestnanec.id as zamid, loginjmeno, loginheslo,
                                            jmeno, prijmeni, prava.prava as prava, ulice, cp, psc,
                                            mesto, zeme.zeme as zeme, predvolba, telefon, predvolba1,
                                            telefon1, email,
                                            DATE_FORMAT(datumnarozeni, '{$this->var->mysqlden}') as dendatumnarozeni,
                                            DATE_FORMAT(datumnarozeni, '{$this->var->mysqldatum}') as datumnarozeni,
                                            vzdelani.vzdelani, ridicak, pohlavi,
                                            DATE_FORMAT(datumosloveni, '{$this->var->mysqlden}') as dendatumosloveni,
                                            DATE_FORMAT(datumosloveni, '{$this->var->mysqldatum}') as datumosloveni,
                                            DATE_FORMAT(datumzivotopisu, '{$this->var->mysqlden}') as dendatumzivotopisu,
                                            DATE_FORMAT(datumzivotopisu, '{$this->var->mysqldatum}') as datumzivotopisu,
                                            DATE_FORMAT(datumpohovoru, '{$this->var->mysqlden}') as dendatumpohovoru,
                                            DATE_FORMAT(datumpohovoru, '{$this->var->mysqldatum}') as datumpohovoru,
                                            DATE_FORMAT(datumzacatek, '{$this->var->mysqlden}') as dendatumzacatek,
                                            DATE_FORMAT(datumzacatek, '{$this->var->mysqldatum}') as datumzacatek,
                                            DATE_FORMAT(datumodmitnuti, '{$this->var->mysqlden}') as dendatumodmitnuti,
                                            DATE_FORMAT(datumodmitnuti, '{$this->var->mysqldatum}') as datumodmitnuti,
                                            DATE_FORMAT(datumkonec, '{$this->var->mysqlden}') as dendatumkonec,
                                            DATE_FORMAT(datumkonec, '{$this->var->mysqldatum}') as datumkonec,
                                            status.status, mistonarozeni,
                                            zeme1.zeme zemenar, jazyk.jazyk as rodnyjazyk, jmenootce,
                                            prijmeniotce, povolaniotce, jmenomatky,
                                            prijmenimatky, povolanimatky, pocetbratru,
                                            pocetsester, maturita, stredni, nazevstredni,
                                            stredniod, strednido, vysoka, nazevvysoke,
                                            vyskaod, vyskado, vystytul
                                            FROM zamestnanec, prava, zeme, zeme as zeme1, jazyk, vzdelani, status
                                            WHERE
                                            zamestnanec.idprava=prava.id AND
                                            zamestnanec.idzeme=zeme.id AND
                                            zamestnanec.idzemenarozeni=zeme1.id AND
                                            zamestnanec.idrodnyjazyk=jazyk.id AND
                                            zamestnanec.idvzdelani=vzdelani.id AND
                                            zamestnanec.idstatus=status.id AND
                                            zamestnanec.id={$cislo};"))
      {
        $data = $res->fetch_object();
        $result = include "{$this->var->form}/info_zamestnanec.php";
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globální proměnné
      }
    }

    return $result;
  }
//******************************************************************************
  function ZamestnanecEditDel() //vypise tabulku se seznamem zamestnancu, nemecke razeni!!
  {
    $strankovani = $this->var->main->Strankovani("zamestnanec", $od, $poc);

    if ($res = @$this->var->mysqli->query("SELECT zamestnanec.id, loginjmeno, loginheslo, jmeno, prijmeni, email, predvolba, telefon, psc, cp, mesto, ulice, prava.prava, prava.id as idprava
                                          FROM zamestnanec, prava
                                          WHERE zamestnanec.idprava=prava.id ".($this->var->prava == $this->var->superadmin ? "ORDER BY zamestnanec.prijmeni ASC, zamestnanec.jmeno ASC" : "AND loginjmeno='{$_COOKIE["TSQM_JMENO"]}' AND loginheslo='{$_COOKIE["TSQM_HESLO"]}'")."
                                          LIMIT {$od}, {$poc};"))
    {
      if ($res->num_rows != 0)
      {
        $result = //výpis zemí
        ($this->var->prava == $this->var->superadmin ? "{$strankovani}" : "")."
        <!-- zahlavi vypisu (nejspis nebude)
        <table border=\"1\">
          <tr>
            <td>{$this->var->jazyk["zam_log"]}</td>
            ".($this->var->prava == $this->var->superadmin ? "<td>{$this->var->jazyk["zam_hes"]}</td>" : "")."
            <td>{$this->var->jazyk["zam_foto"]}</td>
            <td>{$this->var->jazyk["zam_jmeno"]}</td>
            <td>{$this->var->jazyk["zam_prim"]}</td>
            <td>{$this->var->jazyk["zam_email"]}</td>
            <td>{$this->var->jazyk["zam_tel1"]}</td>
            <td>{$this->var->jazyk["zam_psc"]}</td>
            <td>{$this->var->jazyk["zam_cp"]}</td>
            <td>{$this->var->jazyk["zam_mesto"]}</td>
            <td>{$this->var->jazyk["zam_ulice"]}</td>
            <td>{$this->var->jazyk["zam_prava"]}</td>
            ".($this->var->main->PristupOdkaz("zamestnanci", "info") ? "<td>{$this->var->jazyk["info"]}</td>" : "")."
            ".($this->var->main->PristupOdkaz("zamestnanci", "edit") ? "<td>{$this->var->jazyk["edit"]}</td>" : "")."
            ".($this->var->main->PristupOdkaz("zamestnanci", "del") ? "<td>{$this->var->jazyk["del"]}</td>" : "")."
          </tr>
          </table>
          -->
          ";

        while ($data = $res->fetch_object())
        {
          $result .=
          "
          <div class=\"vypis_zamestnancu\">
            <p>
              {$data->loginjmeno} [> <a href=\"?action={$_GET["action"]}&amp;akce=pdf&amp;cislo={$data->id}\" title=\"\" onclick=\"window.open(this.href); return false;\">{$this->var->jazyk["pdf_form"]}</a> <]
            </p>
            <p>
              ".($this->var->prava == $this->var->superadmin ? "<a href=\"javascript:alert('{$data->loginheslo}');\" title=\"{$this->var->jazyk["show_psw"]}\">{$this->var->jazyk["show_psw"]}</a>" : "")."
            </p>
            <p>
              <a href=\"?action={$_GET["action"]}&amp;akce=info&amp;cislo={$data->id}\" title=\"{$data->jmeno} {$data->prijmeni}\"><img src=\"foto.php?sekce=zamestnancimini&amp;id={$data->id}\" alt=\"{$data->jmeno} {$data->prijmeni}\" /></a>
            </p>
            <p>
              <a href=\"?action={$_GET["action"]}&amp;akce=info&amp;cislo={$data->id}\" title=\"{$data->jmeno} {$data->prijmeni}\">{$data->jmeno} {$data->prijmeni}</a>
            </p>
            <p>
              ".(!Empty($data->email) ? "{$data->email}" : $this->var->emptypol)."
            </p>
            <p>
              ".(!Empty($data->telefon) ? "{$data->predvolba} {$data->telefon}" : $this->var->emptypol)."
            </p>
            <p>
              ".(!Empty($data->psc) ? "{$data->psc}" : $this->var->emptypol)."
            </p>
            <p>
              {$data->cp}
            </p>
            <p>
              ".(!Empty($data->mesto) ? "{$data->mesto}" : $this->var->emptypol)."
            </p>
            <p>
              ".(!Empty($data->ulice) ? "{$data->ulice}" : $this->var->emptypol)."
            </p>
            <p>
              {$data->prava}
            </p>
            <p>
              ".($this->var->main->PristupOdkaz("zamestnanci", "info") ? "<a href=\"?action={$_GET["action"]}&amp;akce=info&amp;cislo={$data->id}\" title=\"{$this->var->jazyk["info"]}\">{$this->var->jazyk["info"]}</a>" : "")."
            </p>
            <p>
              ".($this->var->main->PristupOdkaz("zamestnanci", "edit") ? "<a href=\"?action={$_GET["action"]}&amp;akce=edit&amp;cislo={$data->id}\" title=\"{$this->var->jazyk["edit"]}\">{$this->var->jazyk["edit"]}</a>" : "")."
            </p>
            <p>
              ".($this->var->main->PristupOdkaz("zamestnanci", "del") ? ($data->idprava == $this->var->superadmin ? $this->var->emptypol : "<a href=\"?action={$_GET["action"]}&amp;akce=del&amp;cislo={$data->id}\" title=\"{$this->var->jazyk["del"]}\">{$this->var->jazyk["del"]}</a>") : "")."
            </p>
          </div>
          ";

/*
<!-- puvodni
            <td>$data->loginjmeno</td> mam
            ".($this->var->prava == $this->var->superadmin ? "<td><a href=\"javascript:alert('$data->loginheslo');\">{$this->var->jazyk["show_psw"]}</a></td>" : "")." mam
            <td><img src=\"foto.php?sekce=zamestnancimini&amp;id=$data->id\" alt=\"\" /></td> mam
            <td>$data->jmeno</td> mam
            <td>$data->prijmeni</td> mam
            <td>$data->email</td> mam
            <td>{$data->predvolba} {$data->telefon}</td> mam
            <td>$data->psc</td> mam
            <td>$data->cp</td> mam
            <td>$data->mesto</td> mam
            <td>$data->ulice</td> mam
            <td>$data->prava</td> mam
            ".($this->var->main->PristupOdkaz("zamestnanci", "info") ? "<td><a href=\"?action={$_GET["action"]}&amp;akce=info&amp;cislo=$data->id\">{$this->var->jazyk["info"]}</a></td>" : "")." mam
            ".($this->var->main->PristupOdkaz("zamestnanci", "edit") ? "<td><a href=\"?action={$_GET["action"]}&amp;akce=edit&amp;cislo=$data->id\">{$this->var->jazyk["edit"]}</a></td>" : "")." mam
            ".($this->var->main->PristupOdkaz("zamestnanci", "del") ? ($data->idprava == $this->var->superadmin ? "<td>$this->var->emptypol</td>" : "<td><a href=\"?action={$_GET["action"]}&amp;akce=del&amp;cislo=$data->id\">{$this->var->jazyk["del"]}</a></td>") : "")." mam
          </tr>
          -->
*/
        }
        $result .=
        "</table>
        ".($this->var->prava == $this->var->superadmin ? "{$strankovani}" : "");
      }
        else
      {
        $result = $this->var->main->EmptyLine();
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globální proměnné
    }

    return $result;
  }
//******************************************************************************
  function ZamestnanecPridat()  //přidá zaměstnance do DB
  {
    $datum = date("d.m.Y");
    $rok = date("Y");
    $result .= include "{$this->var->form}/add_zamestnanec.php";

    if (!Empty($_POST["zam_log"]) &&
        !Empty($_POST["zam_hes"])  &&
        !Empty($_POST["zam_hesrep"]) &&
        //!Empty($_POST["zam_jmeno"]) &&
        //!Empty($_POST["zam_prim"]) &&
        //!Empty($_POST["zam_prava"]) &&  //práva
        //!Empty($_POST["zam_ulice"]) &&
        //!Empty($_POST["zam_cp"]) &&
        //!Empty($_POST["zam_psc"]) &&
        //!Empty($_POST["zam_mesto"]) &&
        //!Empty($_POST["zam_zeme"]) &&   // stát vždy vybráno
        //!Empty($_POST["zam_pred1"]) &&
        //!Empty($_POST["zam_tel1"]) &&
        //!Empty($_POST["zam_pred2"]) &&  //nepovinný
        //!Empty($_POST["zam_tel2"]) &&   //nepovinný
        //!Empty($_POST["zam_email"]) &&
        //!Empty($_POST["zam_datnar"]) &&
        //count($_POST["zam_jazyk"]) != 0 && pole
        //!Empty($_POST["zam_vzdelani"]) && //vždy
        //!Empty($_POST["zam_existridicak"]) && //vždy
        //!Empty($_POST["zam_ridicak"]) &&  //pole  nepovinné
        //!Empty($_POST["zam_pohlavi"]) &&
        //!Empty($_POST["zam_datosloveni"]) &&
        //!Empty($_POST["zam_datzivot"]) &&
        //!Empty($_POST["zam_datpoh"]) &&
        //!Empty($_POST["zam_datzac"]) &&
        //!Empty($_POST["zam_datodmit"]) &&
        //!Empty($_POST["zam_konprac"]) &&
        //!Empty($_POST["zam_status"]) &&
        //!Empty($_POST["zam_existfoto"]) &&
        //!Empty($_FILES["fotka"]["name"]) &&     //nepovinné
        //!Empty($_POST["zam_hobby"]) &&  pole
        //!Empty($_POST["zam_sport"]) &&  pole
        //!Empty($_POST["zam_rodiste"]) &&
        //!Empty($_POST["zam_zemenaroz"]) &&  //země, vždy vybráno
        //!Empty($_POST["zam_matjazyk"]) && vždy vybrán
        //!Empty($_POST["zam_jmotce"]) &&
        //!Empty($_POST["zam_prijotce"]) &&
        //!Empty($_POST["zam_povotce"]) &&
        //!Empty($_POST["zam_jmmatky"]) &&
        //!Empty($_POST["zam_prijmatky"]) &&
        //!Empty($_POST["zam_povmatky"]) &&
        //!Empty($_POST["zam_pocbrat"]) &&
        //!Empty($_POST["zam_pocsest"]) &&
        //!Empty($_POST["zam_mat"]) && //vždy
        //!Empty($_POST["zam_vyuc"]) && //vždy
        //!Empty($_POST["zam_typstredni"]) &&
        //!Empty($_POST["zam_stredniod"]) &&
        //!Empty($_POST["zam_strednido"]) &&
        //!Empty($_POST["zam_vyska"]) && //vždy
        //!Empty($_POST["zam_typvyska"]) &&
        //!Empty($_POST["zam_vyskaod"]) &&
        //!Empty($_POST["zam_vyskado"]) &&
        //!Empty($_POST["zam_obor"]) && pole
        //!Empty($_POST["zam_tytul"]) && //vždy
        !Empty($_POST["tlacitko"]))
    {
      $zam_log = stripslashes(htmlspecialchars($_POST["zam_log"]));
      $zam_hes = stripslashes(htmlspecialchars($_POST["zam_hes"]));
      $zam_hesrep = stripslashes(htmlspecialchars($_POST["zam_hesrep"]));
      $zam_jmeno = stripslashes(htmlspecialchars($_POST["zam_jmeno"]));
      $zam_prim = stripslashes(htmlspecialchars($_POST["zam_prim"]));
      $zam_prava = $_POST["zam_prava"];  //práva
      settype($zam_prava, "integer");
      $zam_ulice = stripslashes(htmlspecialchars($_POST["zam_ulice"]));
      $zam_cp = $_POST["zam_cp"];
      settype($zam_cp, "integer");
      $zam_psc = $_POST["zam_psc"];
      settype($zam_psc, "integer");
      $zam_mesto = stripslashes(htmlspecialchars($_POST["zam_mesto"]));
      $zam_zeme = $_POST["zam_zeme"];   //stát/země narození
      settype($zam_zeme, "integer");

      $zam_pred1 = stripslashes(htmlspecialchars($_POST["zam_pred1"]));
      $zam_tel1 = stripslashes(htmlspecialchars($_POST["zam_tel1"]));
      $zam_pred2 = stripslashes(htmlspecialchars($_POST["zam_pred2"]));  //nepovinný
      $zam_tel2 = stripslashes(htmlspecialchars($_POST["zam_tel2"]));   //nepovinný
      $zam_email = stripslashes(htmlspecialchars($_POST["zam_email"]));
      $zam_datnar = (!Empty($_POST["zam_datnar"]) ? date("Y-m-d", strtotime($_POST["zam_datnar"])) : "");
      $zam_jazyk = $_POST["zam_jazyk"]; //array
      $zam_vzdelani = $_POST["zam_vzdelani"];
      settype($zam_vzdelani, "integer");

      $zam_existridicak = $this->var->main->BoolToInt($_POST["zam_existridicak"]);

      if ($zam_existridicak == 1)
      {
        $zam_ridicak = $_POST["zam_ridicak"]; //array
      }

      $zam_pohlavi = $this->var->main->BoolToInt($_POST["zam_pohlavi"]);
      $zam_datosloveni = (!Empty($_POST["zam_datosloveni"]) ? date("Y-m-d", strtotime($_POST["zam_datosloveni"])) : "");
      $zam_datzivot = (!Empty($_POST["zam_datzivot"]) ? date("Y-m-d", strtotime($_POST["zam_datzivot"])) : "");
      $zam_datpoh = (!Empty($_POST["zam_datpoh"]) ? date("Y-m-d", strtotime($_POST["zam_datpoh"])) : "");
      $zam_datzac = (!Empty($_POST["zam_datzac"]) ? date("Y-m-d", strtotime($_POST["zam_datzac"])) : "");
      $zam_datodmit = (!Empty($_POST["zam_datodmit"]) ? date("Y-m-d", strtotime($_POST["zam_datodmit"])) : "");
      $zam_konprac = (!Empty($_POST["zam_konprac"]) ? date("Y-m-d", strtotime($_POST["zam_konprac"])) : "");
      $zam_status = $_POST["zam_status"];
      settype($zam_status, "integer");
      $zam_existfoto = $this->var->main->BoolToInt($_POST["zam_existfoto"]);

      $zam_hobby = $_POST["zam_hobby"]; //array
      $zam_sport = $_POST["zam_sport"]; //array
      $zam_rodiste = stripslashes(htmlspecialchars($_POST["zam_rodiste"]));
      $zam_zemenaroz = $_POST["zam_zemenaroz"];
      settype($zam_zemenaroz, "integer");
      $zam_matjazyk = $_POST["zam_matjazyk"];
      settype($zam_matjazyk, "integer");
      $zam_jmotce = stripslashes(htmlspecialchars($_POST["zam_jmotce"]));
      $zam_prijotce = stripslashes(htmlspecialchars($_POST["zam_prijotce"]));
      $zam_povotce = stripslashes(htmlspecialchars($_POST["zam_povotce"]));
      $zam_jmmatky = stripslashes(htmlspecialchars($_POST["zam_jmmatky"]));
      $zam_prijmatky = stripslashes(htmlspecialchars($_POST["zam_prijmatky"]));
      $zam_povmatky = stripslashes(htmlspecialchars($_POST["zam_povmatky"]));
      $zam_pocbrat = stripslashes(htmlspecialchars($_POST["zam_pocbrat"]));
      $zam_pocsest = stripslashes(htmlspecialchars($_POST["zam_pocsest"]));
      $zam_mat = $this->var->main->BoolToInt($_POST["zam_mat"]);
      $zam_vyuc = $this->var->main->BoolToInt($_POST["zam_vyuc"]);

      $zam_typstredni = stripslashes(htmlspecialchars($_POST["zam_typstredni"]));

      $zam_stredniod = $_POST["zam_stredniod"];
      settype($zam_stredniod, "integer");

      $zam_strednido = $_POST["zam_strednido"];
      settype($zam_strednido, "integer");

      $zam_vyska = $this->var->main->BoolToInt($_POST["zam_vyska"]);

      $zam_typvyska = stripslashes(htmlspecialchars($_POST["zam_typvyska"]));

      $zam_vyskaod = $_POST["zam_vyskaod"];
      settype($zam_vyskaod, "integer");

      $zam_vyskado = $_POST["zam_vyskado"];
      settype($zam_vyskado, "integer");

      $zam_obor = $_POST["zam_obor"]; //array
      $zam_tytul = $this->var->main->BoolToInt($_POST["zam_tytul"]);


      if ($zam_hes == $zam_hesrep)
      {
        if ($this->var->mysqli->multi_query("INSERT INTO zamestnanec (
                                            id,
                                            loginjmeno,
                                            loginheslo,
                                            jmeno,
                                            prijmeni,
                                            idprava,
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
                                            datumnarozeni,
                                            idvzdelani,
                                            ridicak,
                                            pohlavi,
                                            datumosloveni,
                                            datumzivotopisu,
                                            datumpohovoru,
                                            datumzacatek,
                                            datumodmitnuti,
                                            datumkonec,
                                            idstatus,
                                            mistonarozeni,
                                            idzemenarozeni,
                                            idrodnyjazyk,
                                            jmenootce,
                                            prijmeniotce,
                                            povolaniotce,
                                            jmenomatky,
                                            prijmenimatky,
                                            povolanimatky,
                                            pocetbratru,
                                            pocetsester,
                                            maturita,
                                            stredni,
                                            nazevstredni,
                                            stredniod,
                                            strednido,
                                            vysoka,
                                            nazevvysoke,
                                            vyskaod,
                                            vyskado,
                                            vystytul
                                            ) VALUES (
                                            NULL,
                                            '$zam_log',
                                            '$zam_hes',
                                            '$zam_jmeno',
                                            '$zam_prim',
                                            $zam_prava,
                                            '$zam_ulice',
                                            $zam_cp,
                                            $zam_psc,
                                            '$zam_mesto',
                                            $zam_zeme,
                                            '$zam_pred1',
                                            '$zam_tel1',
                                            '$zam_pred2',
                                            '$zam_tel2',
                                            '$zam_email',
                                            '$zam_datnar',
                                            $zam_vzdelani,
                                            $zam_existridicak,
                                            $zam_pohlavi,
                                            '$zam_datosloveni',
                                            '$zam_datzivot',
                                            '$zam_datpoh',
                                            '$zam_datzac',
                                            '$zam_datodmit',
                                            '$zam_konprac',
                                            $zam_status,
                                            '$zam_rodiste',
                                            $zam_zemenaroz,
                                            $zam_matjazyk,
                                            '$zam_jmotce',
                                            '$zam_prijotce',
                                            '$zam_povotce',
                                            '$zam_jmmatky',
                                            '$zam_prijmatky',
                                            '$zam_povmatky',
                                            $zam_pocbrat,
                                            $zam_pocsest,
                                            $zam_mat,
                                            $zam_vyuc,
                                            '$zam_typstredni',
                                            $zam_stredniod,
                                            $zam_strednido,
                                            $zam_vyska,
                                            '$zam_typvyska',
                                            $zam_vyskaod,
                                            $zam_vyskado,
                                            $zam_tytul);"))//dodělat a doladit typy, u bool a int nebudou ''!
        {
          $idzam = $this->var->mysqli->insert_id;

          if (!Empty($_FILES["fotka"]["name"]) && $zam_existfoto == 1) //nepovinné
          {
            $this->PridatFotku($idzam); //přidá foto dle id zaměstnance
          }

          if (count($zam_jazyk) != 0)
          {
            $this->PridatNekolikJazyk($idzam);
          }

          if (count($zam_ridicak) != 0 && $zam_existridicak == 1)
          {
            $this->PridatNekolikRidicak($idzam);
          }

          if (count($zam_hobby) != 0)
          {
            $this->PridatNekolikHobby($idzam);
          }

          if (count($zam_sport) != 0)
          {
            $this->PridatNekolikSport($idzam);
          }

          if (count($zam_obor) != 0 && $zam_vyska == 1)
          {
            $this->PridatNekolikObor($idzam);
          }
          $nazev = $zam_log;
          $result = include "{$this->var->form}/add_true.php";
          //$this->var->main->AutoClick(1, "?action={$_GET["action"]}&akce={$_GET["akce"]}");  //auto kliknutí
        }
          else
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globální proměnné
        }
      }
        else
      {
        $result = $this->var->jazyk["err_psw"];
      }
    }
      else
    {
      if (!Empty($_POST["tlacitko"])) //když bylo zmáčknuto tlačítko
      {
        $zpet = "{$this->OdkazZ5()}<br />";
        $chybnepole = $this->var->jazyk["chybapole"];
        if (Empty($_POST["zam_log"])){$result .= "{$chybnepole}: {$this->var->jazyk["zam_log"]} {$zpet}";}
        if (Empty($_POST["zam_hes"])){$result .= "{$chybnepole}: {$this->var->jazyk["zam_hes"]} {$zpet}";}
        if (Empty($_POST["zam_hesrep"])){$result .= "{$chybnepole}: {$this->var->jazyk["zam_hesrep"]} {$zpet}";}
        if ($_POST["zam_hes"] != $_POST["zam_hesrep"]){$result .= "{$chybnepole}: {$this->var->jazyk["zam_cmphes"]} {$zpet}";}
        if (Empty($_POST["zam_jmeno"])){$result .= "{$chybnepole}: {$this->var->jazyk["zam_jmeno"]} {$zpet}";}
        if (Empty($_POST["zam_prim"])){$result .= "{$chybnepole}: {$this->var->jazyk["zam_prim"]} {$zpet}";}
        if (Empty($_POST["zam_prava"])){$result .= "{$chybnepole}: {$this->var->jazyk["zam_prava"]} {$zpet}";}
        if (Empty($_POST["zam_ulice"])){$result .= "{$chybnepole}: {$this->var->jazyk["zam_ulice"]} {$zpet}";}
        if (Empty($_POST["zam_cp"])){$result .= "{$chybnepole}: {$this->var->jazyk["zam_cp"]} {$zpet}";}
        if (Empty($_POST["zam_psc"])){$result .= "{$chybnepole}: {$this->var->jazyk["zam_psc"]} {$zpet}";}
        if (Empty($_POST["zam_mesto"])){$result .= "{$chybnepole}: {$this->var->jazyk["zam_mesto"]} {$zpet}";}
        if (Empty($_POST["zam_pred1"])){$result .= "{$chybnepole}: {$this->var->jazyk["zam_pred1"]} {$zpet}";}
        if (Empty($_POST["zam_tel1"])){$result .= "{$chybnepole}: {$this->var->jazyk["zam_tel1"]} {$zpet}";}
        if (Empty($_POST["zam_email"])){$result .= "{$chybnepole}: {$this->var->jazyk["zam_email"]} {$zpet}";}
        if (Empty($_POST["zam_datnar"])){$result .= "{$chybnepole}: {$this->var->jazyk["zam_datnar"]} {$zpet}";}
        if (Empty($_POST["zam_ridicak"])){$result .= "{$chybnepole}: {$this->var->jazyk["zam_ridicak"]} {$zpet}";}
        if (Empty($_POST["zam_pohlavi"])){$result .= "{$chybnepole}: {$this->var->jazyk["zam_pohlavi"]} {$zpet}";}
        if (Empty($_POST["zam_datosloveni"])){$result .= "{$chybnepole}: {$this->var->jazyk["zam_datosloveni"]} {$zpet}";}
        if (Empty($_POST["zam_datzivot"])){$result .= "{$chybnepole}: {$this->var->jazyk["zam_datzivot"]} {$zpet}";}
        if (Empty($_POST["zam_datpoh"])){$result .= "{$chybnepole}: {$this->var->jazyk["zam_datpoh"]} {$zpet}";}
        if (Empty($_POST["zam_datzac"])){$result .= "{$chybnepole}: {$this->var->jazyk["zam_datzac"]} {$zpet}";}
        if (Empty($_POST["zam_datodmit"])){$result .= "{$chybnepole}: {$this->var->jazyk["zam_datodmit"]} {$zpet}";}
        if (Empty($_POST["zam_konprac"])){$result .= "{$chybnepole}: {$this->var->jazyk["zam_konprac"]} {$zpet}";}
        if (Empty($_POST["zam_existfoto"])){$result .= "{$chybnepole}: {$this->var->jazyk["zam_existfoto"]} {$zpet}";}
        if (Empty($_POST["zam_rodiste"])){$result .= "{$chybnepole}: {$this->var->jazyk["zam_rodiste"]} {$zpet}";}
        if (Empty($_POST["zam_jmotce"])){$result .= "{$chybnepole}: {$this->var->jazyk["zam_jmotce"]} {$zpet}";}
        if (Empty($_POST["zam_prijotce"])){$result .= "{$chybnepole}: {$this->var->jazyk["zam_prijotce"]} {$zpet}";}
        if (Empty($_POST["zam_povotce"])){$result .= "{$chybnepole}: {$this->var->jazyk["zam_povotce"]} {$zpet}";}
        if (Empty($_POST["zam_jmmatky"])){$result .= "{$chybnepole}: {$this->var->jazyk["zam_jmmatky"]} {$zpet}";}
        if (Empty($_POST["zam_prijmatky"])){$result .= "{$chybnepole}: {$this->var->jazyk["zam_prijmatky"]} {$zpet}";}
        if (Empty($_POST["zam_povmatky"])){$result .= "{$chybnepole}: {$this->var->jazyk["zam_povmatky"]} {$zpet}";}
        if (Empty($_POST["zam_pocbrat"])){$result .= "{$chybnepole}: {$this->var->jazyk["zam_pocbrat"]} {$zpet}";}
        if (Empty($_POST["zam_pocsest"])){$result .= "{$chybnepole}: {$this->var->jazyk["zam_pocsest"]} {$zpet}";}
        if (Empty($_POST["zam_mat"])){$result .= "{$chybnepole}: {$this->var->jazyk["zam_mat"]} {$zpet}";}
        if (Empty($_POST["zam_vyuc"])){$result .= "{$chybnepole}: {$this->var->jazyk["zam_vyuc"]} {$zpet}";}
        if (Empty($_POST["zam_vyska"])){$result .= "{$chybnepole}: {$this->var->jazyk["zam_vyska"]} {$zpet}";}
        if (Empty($_POST["zam_tytul"])){$result .= "{$chybnepole}: {$this->var->jazyk["zam_tytul"]} {$zpet}";}
      }
    }

    return $result;
  }
//******************************************************************************
  function ZamestnanecUpravit()  //upraví zaměstnance v DB
  {
    $id = $_GET["cislo"];
    settype($id, "integer");

    if (!Empty($id) && $id != 0)
    {
      if ($res = @$this->var->mysqli->query("SELECT id, loginjmeno, loginheslo,
                                            jmeno, prijmeni, idprava, ulice, cp, psc,
                                            mesto, idzeme, predvolba, telefon, predvolba1,
                                            telefon1, email,
                                            DATE_FORMAT(datumnarozeni, '{$this->var->mysqlden}') as dendatumnarozeni,
                                            DATE_FORMAT(datumnarozeni, '{$this->var->mysqldatum}') as datumnarozeni,
                                            idvzdelani, ridicak, pohlavi,
                                            DATE_FORMAT(datumosloveni, '{$this->var->mysqlden}') as dendatumosloveni,
                                            DATE_FORMAT(datumosloveni, '{$this->var->mysqldatum}') as datumosloveni,
                                            DATE_FORMAT(datumzivotopisu, '{$this->var->mysqlden}') as dendatumzivotopisu,
                                            DATE_FORMAT(datumzivotopisu, '{$this->var->mysqldatum}') as datumzivotopisu,
                                            DATE_FORMAT(datumpohovoru, '{$this->var->mysqlden}') as dendatumpohovoru,
                                            DATE_FORMAT(datumpohovoru, '{$this->var->mysqldatum}') as datumpohovoru,
                                            DATE_FORMAT(datumzacatek, '{$this->var->mysqlden}') as dendatumzacatek,
                                            DATE_FORMAT(datumzacatek, '{$this->var->mysqldatum}') as datumzacatek,
                                            DATE_FORMAT(datumodmitnuti, '{$this->var->mysqlden}') as dendatumodmitnuti,
                                            DATE_FORMAT(datumodmitnuti, '{$this->var->mysqldatum}') as datumodmitnuti,
                                            DATE_FORMAT(datumkonec, '{$this->var->mysqlden}') as dendatumkonec,
                                            DATE_FORMAT(datumkonec, '{$this->var->mysqldatum}') as datumkonec,
                                            idstatus, mistonarozeni,
                                            idzemenarozeni, idrodnyjazyk, jmenootce,
                                            prijmeniotce, povolaniotce, jmenomatky,
                                            prijmenimatky, povolanimatky, pocetbratru,
                                            pocetsester, maturita, stredni, nazevstredni,
                                            stredniod, strednido, vysoka, nazevvysoke,
                                            vyskaod, vyskado, vystytul
                                            FROM zamestnanec
                                            WHERE id={$id}"))
      {
        $data = $res->fetch_object();
        $result .= include "{$this->var->form}/edit_zamestnanec.php";
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globální proměnné
      }
    }

    if (!Empty($_POST["zam_log"]) &&
        !Empty($_POST["zam_hes"])  &&
        !Empty($_POST["zam_hesrep"]) &&
        //!Empty($_POST["zam_jmeno"]) &&
        //!Empty($_POST["zam_prim"]) &&
        //!Empty($_POST["zam_prava"]) &&  //práva
        //!Empty($_POST["zam_ulice"]) &&
        //!Empty($_POST["zam_cp"]) &&
        //!Empty($_POST["zam_psc"]) &&
        //!Empty($_POST["zam_mesto"]) &&
        //!Empty($_POST["zam_zeme"]) &&   // stát vždy vybráno
        //!Empty($_POST["zam_pred1"]) &&
        //!Empty($_POST["zam_tel1"]) &&
        //!Empty($_POST["zam_pred2"]) &&  //nepovinný
        //!Empty($_POST["zam_tel2"]) &&   //nepovinný
        //!Empty($_POST["zam_email"]) &&
        //!Empty($_POST["zam_datnar"]) &&
        //count($_POST["zam_jazyk"]) != 0 && pole
        //!Empty($_POST["zam_vzdelani"]) && //vždy
        //!Empty($_POST["zam_existridicak"]) &&
        //!Empty($_POST["zam_ridicak"]) &&  //pole  nepovinné
        //!Empty($_POST["zam_pohlavi"]) &&  //vždy
        //!Empty($_POST["zam_datosloveni"]) &&
        //!Empty($_POST["zam_datzivot"]) &&
        //!Empty($_POST["zam_datpoh"]) &&
        //!Empty($_POST["zam_datzac"]) &&
        //!Empty($_POST["zam_datodmit"]) &&
        //!Empty($_POST["zam_konprac"]) &&
        //!Empty($_POST["zam_status"]) &&
        //!Empty($_POST["zam_existfoto"]) &&
        //!Empty($_FILES["fotka"]["name"]) &&     //nepovinné
        //!Empty($_POST["zam_hobby"]) &&  pole
        //!Empty($_POST["zam_sport"]) &&  pole
        //!Empty($_POST["zam_rodiste"]) &&
        //!Empty($_POST["zam_zemenaroz"]) &&  //země, vždy vybráno
        //!Empty($_POST["zam_matjazyk"]) && vždy vybrán
        //!Empty($_POST["zam_jmotce"]) &&
        //!Empty($_POST["zam_prijotce"]) &&
        //!Empty($_POST["zam_povotce"]) &&
        //!Empty($_POST["zam_jmmatky"]) &&
        //!Empty($_POST["zam_prijmatky"]) &&
        //!Empty($_POST["zam_povmatky"]) &&
        //!Empty($_POST["zam_pocbrat"]) &&
        //!Empty($_POST["zam_pocsest"]) &&
        //!Empty($_POST["zam_mat"]) &&
        //!Empty($_POST["zam_vyuc"]) &&
        //!Empty($_POST["zam_typstredni"]) &&
        //!Empty($_POST["zam_stredniod"]) &&
        //!Empty($_POST["zam_strednido"]) &&
        //!Empty($_POST["zam_vyska"]) &&
        //!Empty($_POST["zam_typvyska"]) &&
        //!Empty($_POST["zam_vyskaod"]) &&
        //!Empty($_POST["zam_vyskado"]) &&
        //!Empty($_POST["zam_obor"]) && pole
        //!Empty($_POST["zam_tytul"]) &&
        !Empty($_POST["tlacitko"]))
    {
      $zam_log = stripslashes(htmlspecialchars($_POST["zam_log"]));
      $zam_hes = stripslashes(htmlspecialchars($_POST["zam_hes"]));
      $zam_hesrep = stripslashes(htmlspecialchars($_POST["zam_hesrep"]));
      $zam_jmeno = stripslashes(htmlspecialchars($_POST["zam_jmeno"]));
      $zam_prim = stripslashes(htmlspecialchars($_POST["zam_prim"]));
      $zam_prava = $_POST["zam_prava"];  //práva
      settype($zam_prava, "integer");
      $zam_ulice = stripslashes(htmlspecialchars($_POST["zam_ulice"]));
      $zam_cp = $_POST["zam_cp"];
      settype($zam_cp, "integer");
      $zam_psc = $_POST["zam_psc"];
      settype($zam_psc, "integer");
      $zam_mesto = stripslashes(htmlspecialchars($_POST["zam_mesto"]));
      $zam_zeme = $_POST["zam_zeme"];   //stát/země narození
      settype($zam_zeme, "integer");

      $zam_pred1 = stripslashes(htmlspecialchars($_POST["zam_pred1"]));
      $zam_tel1 = stripslashes(htmlspecialchars($_POST["zam_tel1"]));
      $zam_pred2 = stripslashes(htmlspecialchars($_POST["zam_pred2"]));  //nepovinný
      $zam_tel2 = stripslashes(htmlspecialchars($_POST["zam_tel2"]));   //nepovinný
      $zam_email = stripslashes(htmlspecialchars($_POST["zam_email"]));
      $zam_datnar = (!Empty($_POST["zam_datnar"]) ? date("Y-m-d", strtotime($_POST["zam_datnar"])) : "");
      $zam_jazyk = $_POST["zam_jazyk"]; //array
      $zam_vzdelani = $_POST["zam_vzdelani"];
      settype($zam_vzdelani, "integer");

      $zam_existridicak = $this->var->main->BoolToInt($_POST["zam_existridicak"]);

      if ($zam_existridicak == 1)
      {
        $zam_ridicak = $_POST["zam_ridicak"]; //array
      }

      $zam_pohlavi = $this->var->main->BoolToInt($_POST["zam_pohlavi"]);
      $zam_datosloveni = (!Empty($_POST["zam_datosloveni"]) ? date("Y-m-d", strtotime($_POST["zam_datosloveni"])) : "");
      $zam_datzivot = (!Empty($_POST["zam_datzivot"]) ? date("Y-m-d", strtotime($_POST["zam_datzivot"])) : "");
      $zam_datpoh = (!Empty($_POST["zam_datpoh"]) ? date("Y-m-d", strtotime($_POST["zam_datpoh"])) : "");
      $zam_datzac = (!Empty($_POST["zam_datzac"]) ? date("Y-m-d", strtotime($_POST["zam_datzac"])) : "");
      $zam_datodmit = (!Empty($_POST["zam_datodmit"]) ? date("Y-m-d", strtotime($_POST["zam_datodmit"])) : "");
      $zam_konprac = (!Empty($_POST["zam_konprac"]) ? date("Y-m-d", strtotime($_POST["zam_konprac"])) : "");
      $zam_status = $_POST["zam_status"];
      settype($zam_status, "integer");
      $zam_existfoto = $this->var->main->BoolToInt($_POST["zam_existfoto"]);

      $zam_hobby = $_POST["zam_hobby"]; //array
      $zam_sport = $_POST["zam_sport"]; //array
      $zam_rodiste = stripslashes(htmlspecialchars($_POST["zam_rodiste"]));
      $zam_zemenaroz = $_POST["zam_zemenaroz"];
      settype($zam_zemenaroz, "integer");
      $zam_matjazyk = $_POST["zam_matjazyk"];
      settype($zam_matjazyk, "integer");
      $zam_jmotce = stripslashes(htmlspecialchars($_POST["zam_jmotce"]));
      $zam_prijotce = stripslashes(htmlspecialchars($_POST["zam_prijotce"]));
      $zam_povotce = stripslashes(htmlspecialchars($_POST["zam_povotce"]));
      $zam_jmmatky = stripslashes(htmlspecialchars($_POST["zam_jmmatky"]));
      $zam_prijmatky = stripslashes(htmlspecialchars($_POST["zam_prijmatky"]));
      $zam_povmatky = stripslashes(htmlspecialchars($_POST["zam_povmatky"]));
      $zam_pocbrat = stripslashes(htmlspecialchars($_POST["zam_pocbrat"]));
      $zam_pocsest = stripslashes(htmlspecialchars($_POST["zam_pocsest"]));
      $zam_mat = $this->var->main->BoolToInt($_POST["zam_mat"]);
      $zam_vyuc = $this->var->main->BoolToInt($_POST["zam_vyuc"]);

      $zam_typstredni = stripslashes(htmlspecialchars($_POST["zam_typstredni"]));

      $zam_stredniod = $_POST["zam_stredniod"];
      settype($zam_stredniod, "integer");

      $zam_strednido = $_POST["zam_strednido"];
      settype($zam_strednido, "integer");

      $zam_vyska = $this->var->main->BoolToInt($_POST["zam_vyska"]);

      $zam_typvyska = stripslashes(htmlspecialchars($_POST["zam_typvyska"]));

      $zam_vyskaod = $_POST["zam_vyskaod"];
      settype($zam_vyskaod, "integer");

      $zam_vyskado = $_POST["zam_vyskado"];
      settype($zam_vyskado, "integer");

      $zam_obor = $_POST["zam_obor"]; //array
      $zam_tytul = $this->var->main->BoolToInt($_POST["zam_tytul"]);

      if ($zam_hes == $zam_hesrep)
      {
        $this->var->mysqli->multi_query("UPDATE zamestnanec SET loginjmeno='$zam_log' WHERE id=$id;");
        $this->var->mysqli->multi_query("UPDATE zamestnanec SET loginheslo='$zam_hes' WHERE id=$id;");
        $this->var->mysqli->multi_query("UPDATE zamestnanec SET jmeno='$zam_jmeno' WHERE id=$id;");
        $this->var->mysqli->multi_query("UPDATE zamestnanec SET prijmeni='$zam_prim' WHERE id=$id;");
        $this->var->mysqli->multi_query("UPDATE zamestnanec SET idprava=$zam_prava WHERE id=$id;");
        $this->var->mysqli->multi_query("UPDATE zamestnanec SET ulice='$zam_ulice' WHERE id=$id;");
        $this->var->mysqli->multi_query("UPDATE zamestnanec SET cp=$zam_cp WHERE id=$id;");
        $this->var->mysqli->multi_query("UPDATE zamestnanec SET psc=$zam_psc WHERE id=$id;");
        $this->var->mysqli->multi_query("UPDATE zamestnanec SET mesto='$zam_mesto' WHERE id=$id;");
        $this->var->mysqli->multi_query("UPDATE zamestnanec SET idzeme=$zam_zeme WHERE id=$id;");
        $this->var->mysqli->multi_query("UPDATE zamestnanec SET predvolba='$zam_pred1' WHERE id=$id;");
        $this->var->mysqli->multi_query("UPDATE zamestnanec SET telefon='$zam_tel1' WHERE id=$id;");
        $this->var->mysqli->multi_query("UPDATE zamestnanec SET predvolba1='$zam_pred2' WHERE id=$id;");
        $this->var->mysqli->multi_query("UPDATE zamestnanec SET telefon1='$zam_tel2' WHERE id=$id;");
        $this->var->mysqli->multi_query("UPDATE zamestnanec SET email='$zam_email' WHERE id=$id;");
        $this->var->mysqli->multi_query("UPDATE zamestnanec SET datumnarozeni='$zam_datnar' WHERE id=$id;");
        $this->var->mysqli->multi_query("UPDATE zamestnanec SET idvzdelani=$zam_vzdelani WHERE id=$id;");
        $this->var->mysqli->multi_query("UPDATE zamestnanec SET ridicak=$zam_existridicak WHERE id=$id;");
        $this->var->mysqli->multi_query("UPDATE zamestnanec SET pohlavi=$zam_pohlavi WHERE id=$id;");
        $this->var->mysqli->multi_query("UPDATE zamestnanec SET datumosloveni='$zam_datosloveni' WHERE id=$id;");
        $this->var->mysqli->multi_query("UPDATE zamestnanec SET datumzivotopisu='$zam_datzivot' WHERE id=$id;");
        $this->var->mysqli->multi_query("UPDATE zamestnanec SET datumpohovoru='$zam_datpoh' WHERE id=$id;");
        $this->var->mysqli->multi_query("UPDATE zamestnanec SET datumzacatek='$zam_datzac' WHERE id=$id;");
        $this->var->mysqli->multi_query("UPDATE zamestnanec SET datumodmitnuti='$zam_datodmit' WHERE id=$id;");
        $this->var->mysqli->multi_query("UPDATE zamestnanec SET datumkonec='$zam_konprac' WHERE id=$id;");
        $this->var->mysqli->multi_query("UPDATE zamestnanec SET idstatus=$zam_status WHERE id=$id;");
        $this->var->mysqli->multi_query("UPDATE zamestnanec SET mistonarozeni='$zam_rodiste' WHERE id=$id;");
        $this->var->mysqli->multi_query("UPDATE zamestnanec SET idzemenarozeni=$zam_zemenaroz WHERE id=$id;");
        $this->var->mysqli->multi_query("UPDATE zamestnanec SET idrodnyjazyk=$zam_matjazyk WHERE id=$id;");
        $this->var->mysqli->multi_query("UPDATE zamestnanec SET jmenootce='$zam_jmotce' WHERE id=$id;");
        $this->var->mysqli->multi_query("UPDATE zamestnanec SET prijmeniotce='$zam_prijotce' WHERE id=$id;");
        $this->var->mysqli->multi_query("UPDATE zamestnanec SET povolaniotce='$zam_povotce' WHERE id=$id;");
        $this->var->mysqli->multi_query("UPDATE zamestnanec SET jmenomatky='$zam_jmmatky' WHERE id=$id;");
        $this->var->mysqli->multi_query("UPDATE zamestnanec SET prijmenimatky='$zam_prijmatky' WHERE id=$id;");
        $this->var->mysqli->multi_query("UPDATE zamestnanec SET povolanimatky='$zam_povmatky' WHERE id=$id;");
        $this->var->mysqli->multi_query("UPDATE zamestnanec SET pocetbratru=$zam_pocbrat WHERE id=$id;");
        $this->var->mysqli->multi_query("UPDATE zamestnanec SET pocetsester=$zam_pocsest WHERE id=$id;");
        $this->var->mysqli->multi_query("UPDATE zamestnanec SET maturita=$zam_mat WHERE id=$id;");
        $this->var->mysqli->multi_query("UPDATE zamestnanec SET stredni=$zam_vyuc WHERE id=$id;");
        $this->var->mysqli->multi_query("UPDATE zamestnanec SET nazevstredni='$zam_typstredni' WHERE id=$id;");
        $this->var->mysqli->multi_query("UPDATE zamestnanec SET stredniod=$zam_stredniod WHERE id=$id;");
        $this->var->mysqli->multi_query("UPDATE zamestnanec SET strednido=$zam_strednido WHERE id=$id;");
        $this->var->mysqli->multi_query("UPDATE zamestnanec SET vysoka=$zam_vyska WHERE id=$id;");
        $this->var->mysqli->multi_query("UPDATE zamestnanec SET nazevvysoke='$zam_typvyska' WHERE id=$id;");
        $this->var->mysqli->multi_query("UPDATE zamestnanec SET vyskaod=$zam_vyskaod WHERE id=$id;");
        $this->var->mysqli->multi_query("UPDATE zamestnanec SET vyskado=$zam_vyskado WHERE id=$id;");
        $this->var->mysqli->multi_query("UPDATE zamestnanec SET vystytul=$zam_tytul WHERE id=$id;");

        if (!Empty($_FILES["fotka"]["name"]) && $zam_existfoto == 1) //nepovinné
        {
          $this->UpravitFotku($id); //upraví foto dle id zaměstnance
        }

        if ($zam_existfoto == 0)
        {
          $this->SmazatFotku($id);  //smaže fotku
        }

        //if (count($zam_jazyk) != 0)
        //{
          $this->UpravitNekolikJazyk($id);
        //}

        //if (count($zam_ridicak) != 0 && $zam_existridicak == 1)
        //{
          $this->UpravitNekolikRidicak($id);
        //}

        //if (count($zam_hobby) != 0)
        //{
          $this->UpravitNekolikHobby($id);
        //}

        //if (count($zam_sport) != 0)
        //{
          $this->UpravitNekolikSport($id);
        //}

        //if (count($zam_obor) != 0 && $zam_vyska == 1)
        //{
          $this->UpravitNekolikObor($id);
        //}

        $nazev = $zam_log;
        $result = include "{$this->var->form}/edit_true.php";
        $this->var->main->AutoClick(1, "?action={$_GET["action"]}&akce={$_GET["akce"]}");  //auto kliknutí

  /*      }
          else
        {
          $this->chyba = this->var->main->ErrorMsg($this->mysqli->error); //chyba do globální proměnné
        }*/
        //$result .= $this->var->main->ErrorMsg($this->mysqli->error);

      }
        else
      {
        $result = $this->var->jazyk["err_psw"];
      }
    }
      else
    {
      if (!Empty($_POST["tlacitko"])) //když bylo zmáčknuto tlačítko
      {
        $zpet = "{$this->var->main->OdkazZ5()}<br />";
        $chybnepole = $this->var->jazyk["chybapole"];
        if (Empty($_POST["zam_log"])){$result .= "{$chybnepole}: {$this->var->jazyk["zam_log"]} {$zpet}";}
        if (Empty($_POST["zam_hes"])){$result .= "{$chybnepole}: {$this->var->jazyk["zam_hes"]} {$zpet}";}
        if (Empty($_POST["zam_hesrep"])){$result .= "{$chybnepole}: {$this->var->jazyk["zam_hesrep"]} {$zpet}";}
        if ($_POST["zam_hes"] != $_POST["zam_hesrep"]){$result .= "{$chybnepole}: {$this->var->jazyk["zam_cmphes"]} {$zpet}";}
        if (Empty($_POST["zam_jmeno"])){$result .= "{$chybnepole}: {$this->var->jazyk["zam_jmeno"]} {$zpet}";}
        if (Empty($_POST["zam_prim"])){$result .= "{$chybnepole}: {$this->var->jazyk["zam_prim"]} {$zpet}";}
        if (Empty($_POST["zam_prava"])){$result .= "{$chybnepole}: {$this->var->jazyk["zam_prava"]} {$zpet}";}
        if (Empty($_POST["zam_ulice"])){$result .= "{$chybnepole}: {$this->var->jazyk["zam_ulice"]} {$zpet}";}
        if (Empty($_POST["zam_cp"])){$result .= "{$chybnepole}: {$this->var->jazyk["zam_cp"]} {$zpet}";}
        if (Empty($_POST["zam_psc"])){$result .= "{$chybnepole}: {$this->var->jazyk["zam_psc"]} {$zpet}";}
        if (Empty($_POST["zam_mesto"])){$result .= "{$chybnepole}: {$this->var->jazyk["zam_mesto"]} {$zpet}";}
        if (Empty($_POST["zam_pred1"])){$result .= "{$chybnepole}: {$this->var->jazyk["zam_pred1"]} {$zpet}";}
        if (Empty($_POST["zam_tel1"])){$result .= "{$chybnepole}: {$this->var->jazyk["zam_tel1"]} {$zpet}";}
        if (Empty($_POST["zam_email"])){$result .= "{$chybnepole}: {$this->var->jazyk["zam_email"]} {$zpet}";}
        if (Empty($_POST["zam_datnar"])){$result .= "{$chybnepole}: {$this->var->jazyk["zam_datnar"]} {$zpet}";}
        if (Empty($_POST["zam_ridicak"])){$result .= "{$chybnepole}: {$this->var->jazyk["zam_ridicak"]} {$zpet}";}
        if (Empty($_POST["zam_pohlavi"])){$result .= "{$chybnepole}: {$this->var->jazyk["zam_pohlavi"]} {$zpet}";}
        if (Empty($_POST["zam_datosloveni"])){$result .= "{$chybnepole}: {$this->var->jazyk["zam_datosloveni"]} {$zpet}";}
        if (Empty($_POST["zam_datzivot"])){$result .= "{$chybnepole}: {$this->var->jazyk["zam_datzivot"]} {$zpet}";}
        if (Empty($_POST["zam_datpoh"])){$result .= "{$chybnepole}: {$this->var->jazyk["zam_datpoh"]} {$zpet}";}
        if (Empty($_POST["zam_datzac"])){$result .= "{$chybnepole}: {$this->var->jazyk["zam_datzac"]} {$zpet}";}
        if (Empty($_POST["zam_datodmit"])){$result .= "{$chybnepole}: {$this->var->jazyk["zam_datodmit"]} {$zpet}";}
        if (Empty($_POST["zam_konprac"])){$result .= "{$chybnepole}: {$this->var->jazyk["zam_konprac"]} {$zpet}";}
        if (Empty($_POST["zam_existfoto"])){$result .= "{$chybnepole}: {$this->var->jazyk["zam_existfoto"]} {$zpet}";}
        if (Empty($_POST["zam_rodiste"])){$result .= "{$chybnepole}: {$this->var->jazyk["zam_rodiste"]} {$zpet}";}
        if (Empty($_POST["zam_jmotce"])){$result .= "{$chybnepole}: {$this->var->jazyk["zam_jmotce"]} {$zpet}";}
        if (Empty($_POST["zam_prijotce"])){$result .= "{$chybnepole}: {$this->var->jazyk["zam_prijotce"]} {$zpet}";}
        if (Empty($_POST["zam_povotce"])){$result .= "{$chybnepole}: {$this->var->jazyk["zam_povotce"]} {$zpet}";}
        if (Empty($_POST["zam_jmmatky"])){$result .= "{$chybnepole}: {$this->var->jazyk["zam_jmmatky"]} {$zpet}";}
        if (Empty($_POST["zam_prijmatky"])){$result .= "{$chybnepole}: {$this->var->jazyk["zam_prijmatky"]} {$zpet}";}
        if (Empty($_POST["zam_povmatky"])){$result .= "{$chybnepole}: {$this->var->jazyk["zam_povmatky"]} {$zpet}";}
        if (Empty($_POST["zam_pocbrat"])){$result .= "{$chybnepole}: {$this->var->jazyk["zam_pocbrat"]} {$zpet}";}
        if (Empty($_POST["zam_pocsest"])){$result .= "{$chybnepole}: {$this->var->jazyk["zam_pocsest"]} {$zpet}";}
        if (Empty($_POST["zam_mat"])){$result .= "{$chybnepole}: {$this->var->jazyk["zam_mat"]} {$zpet}";}
        if (Empty($_POST["zam_vyuc"])){$result .= "{$chybnepole}: {$this->var->jazyk["zam_vyuc"]} {$zpet}";}
        if (Empty($_POST["zam_vyska"])){$result .= "{$chybnepole}: {$this->var->jazyk["zam_vyska"]} {$zpet}";}
        if (Empty($_POST["zam_tytul"])){$result .= "{$chybnepole}: {$this->var->jazyk["zam_tytul"]} {$zpet}";}
      }
    }

    return $result;
  }
//******************************************************************************
  function ZamestnanecSmazat() //smaže zaměstnance
  {
    $id = $_GET["cislo"];
    settype($id, "integer");

    if (!Empty($id) && $id != 0)
    {
      if ($res = @$this->var->mysqli->query("SELECT loginjmeno
                                            FROM zamestnanec
                                            WHERE id={$id}"))
      {
        $data = $res->fetch_object();
        $result .= include "{$this->var->form}/del_zamestnanec.php";
      }
        else
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globální proměnné
      }
    }

    if (!Empty($_POST["ano"]) &&
        !Empty($id) &&
        $id != 0)
    {
      $this->var->mysqli->multi_query("DELETE FROM zamestnanec WHERE id={$id};");
      $this->var->mysqli->multi_query("DELETE FROM zamestnanec_umi_jazyk WHERE idzamestnanec={$id};");
      $this->var->mysqli->multi_query("DELETE FROM zamestnanec_ma_ridicak WHERE idzamestnanec={$id};");
      $this->var->mysqli->multi_query("DELETE FROM zamestnanec_ma_hobby WHERE idzamestnanec={$id};");
      $this->var->mysqli->multi_query("DELETE FROM zamestnanec_ma_sport WHERE idzamestnanec={$id};");
      $this->var->mysqli->multi_query("DELETE FROM zamestnanec_ma_typvysoke WHERE idzamestnanec={$id};");
      $this->var->mysqli->multi_query("DELETE FROM fotozamestnanecmini WHERE id={$id};");
      $this->var->mysqli->multi_query("DELETE FROM fotozamestnanecfull WHERE id={$id};");

      $nazev = $data->loginjmeno;
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
/*
  function PridatNekolikJednoFoto($pridaneid, $idfoto)  //přidá data do spojovací tabulky fotky
  {
    if (!@$this->var->mysqli->multi_query("INSERT INTO zamestnanec_ma_foto (id, idzamestnanec, idfoto) VALUES(NULL, $pridaneid, $idfoto);"))
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globální proměnné
    }
  }
*/
//******************************************************************************
  function PridatNekolikJazyk($pridaneid) //přidá data do spojovací tabulky jazyka
  {
    $hodnoty = $_POST["zam_jazyk"];

    for($i = 0; $i < count($hodnoty); $i++)
    {
      if (!@$this->var->mysqli->multi_query("INSERT INTO zamestnanec_umi_jazyk (id, idzamestnanec, idjazyk) VALUES(NULL, {$pridaneid}, {$hodnoty[$i]});"))
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globální proměnné
      }
    }
  }
//******************************************************************************
  function UpravitNekolikJazyk($pridaneid)  //upraví data do spojovací tabulky jazyka
  {
    if (!@$this->var->mysqli->multi_query("DELETE FROM zamestnanec_umi_jazyk WHERE idzamestnanec={$pridaneid};"))
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globální proměnné
    }

    $hodnoty = $_POST["zam_jazyk"];

    for($i = 0; $i < count($hodnoty); $i++)
    {
      if (!@$this->var->mysqli->multi_query("INSERT INTO zamestnanec_umi_jazyk (id, idzamestnanec, idjazyk) VALUES(NULL, {$pridaneid}, {$hodnoty[$i]});"))
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globální proměnné
      }
    }
  }
//******************************************************************************
  function PridatNekolikRidicak($pridaneid) //přidá data do spojovací tabulky řidičáku
  {
    $hodnoty = $_POST["zam_ridicak"];

    for($i = 0; $i < count($hodnoty); $i++)
    {
      if (!@$this->var->mysqli->multi_query("INSERT INTO zamestnanec_ma_ridicak (id, idzamestnanec, idridicak) VALUES(NULL, {$pridaneid}, {$hodnoty[$i]});"))
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globální proměnné
      }
    }
  }
//******************************************************************************
  function UpravitNekolikRidicak($pridaneid)  //upraví data ve spojovací tabulce řidičíku
  {
    if (!@$this->var->mysqli->multi_query("DELETE FROM zamestnanec_ma_ridicak WHERE idzamestnanec={$pridaneid};"))
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globální proměnné
    }

    $hodnoty = $_POST["zam_ridicak"];

    for($i = 0; $i < count($hodnoty); $i++)
    {
      if (!@$this->var->mysqli->multi_query("INSERT INTO zamestnanec_ma_ridicak (id, idzamestnanec, idridicak) VALUES(NULL, {$pridaneid}, {$hodnoty[$i]});"))
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globální proměnné
      }
    }
  }
//******************************************************************************
  function PridatNekolikHobby($pridaneid) //přidá data do spojovací tabulky hobby
  {
    $hodnoty = $_POST["zam_hobby"];

    for($i = 0; $i < count($hodnoty); $i++)
    {
      if (!@$this->var->mysqli->multi_query("INSERT INTO zamestnanec_ma_hobby (id, idzamestnanec, idhobby) VALUES(NULL, {$pridaneid}, {$hodnoty[$i]});"))
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globální proměnné
      }
    }
  }
//******************************************************************************
  function UpravitNekolikHobby($pridaneid)  //upraví data ve spojovací tabulce hobby
  {
    if (!@$this->var->mysqli->multi_query("DELETE FROM zamestnanec_ma_hobby WHERE idzamestnanec={$pridaneid};"))
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globální proměnné
    }
    $hodnoty = $_POST["zam_hobby"];

    for($i = 0; $i < count($hodnoty); $i++)
    {
      if (!@$this->var->mysqli->multi_query("INSERT INTO zamestnanec_ma_hobby (id, idzamestnanec, idhobby) VALUES(NULL, {$pridaneid}, {$hodnoty[$i]});"))
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globální proměnné
      }
    }
  }
//******************************************************************************
  function PridatNekolikSport($pridaneid) //přidá do spojovací tabulky sport
  {
    $hodnoty = $_POST["zam_sport"];

    for($i = 0; $i < count($hodnoty); $i++)
    {
      if (!@$this->var->mysqli->multi_query("INSERT INTO zamestnanec_ma_sport (id, idzamestnanec, idsport) VALUES(NULL, {$pridaneid}, {$hodnoty[$i]});"))
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globální proměnné
      }
    }
  }
//******************************************************************************
  function UpravitNekolikSport($pridaneid)  //upraví ve spojovací tabulce sport
  {
    if (!@$this->var->mysqli->multi_query("DELETE FROM zamestnanec_ma_sport WHERE idzamestnanec={$pridaneid};"))
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globální proměnné
    }

    $hodnoty = $_POST["zam_sport"];

    for($i = 0; $i < count($hodnoty); $i++)
    {
      if (!@$this->var->mysqli->multi_query("INSERT INTO zamestnanec_ma_sport (id, idzamestnanec, idsport) VALUES(NULL, {$pridaneid}, {$hodnoty[$i]});"))
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globální proměnné
      }
    }
  }
//******************************************************************************
  function PridatNekolikObor($pridaneid)  //přidá do spojovací tzabulky obor výšky
  {
    $hodnoty = $_POST["zam_obor"];

    for($i = 0; $i < count($hodnoty); $i++)
    {
      if (!@$this->var->mysqli->multi_query("INSERT INTO zamestnanec_ma_typvysoke (id, idzamestnanec, idtypvysoke) VALUES(NULL, {$pridaneid}, {$hodnoty[$i]});"))
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globální proměnné
      }
    }
  }
//******************************************************************************
  function UpravitNekolikObor($pridaneid) //upraví ve spojovací tabulce obor výšky
  {
    if (!@$this->var->mysqli->multi_query("DELETE FROM zamestnanec_ma_typvysoke WHERE idzamestnanec={$pridaneid};"))
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globální proměnné
    }

    $hodnoty = $_POST["zam_obor"];

    for($i = 0; $i < count($hodnoty); $i++)
    {
      if (!@$this->var->mysqli->multi_query("INSERT INTO zamestnanec_ma_typvysoke (id, idzamestnanec, idtypvysoke) VALUES(NULL, {$pridaneid}, {$hodnoty[$i]});"))
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globální proměnné
      }
    }
  }
//******************************************************************************
  function PridatFotku($idzam)  //přidá fotku k zaměstnanci z jeho id
  {
    $jmeno = $this->var->main->KontrolaNazvu($_FILES["fotka"]["name"]);  //jméno
    $tmp = $_FILES["fotka"]["tmp_name"];  //source
    $typ = $_FILES["fotka"]["type"];  //typ
    $size = $_FILES["fotka"]["size"]; //velikost

    list($w, $h, $t) = getimagesize($tmp);  //šířka, výška

    if (($t == 3 || $t == 2) &&
        ($size <= $this->var->maxsize))
    {
      //na server prvni ulozit a pak zmensovat

      $obr = $tmp;
      $u = fopen($obr, "rb");  //otevře
      //$stream1 = base64_encode(addslashes(fread($u, filesize($obr))));  //odělá '' a zakoduje
      $stream1 = fread($u, filesize($obr));
      fclose($u); //zavře

      $obr2 = "pokus1.jpg";
      $u = fopen($obr2, "w");
      fwrite($u, $stream1);
      fclose($u);

/*
      $this->ZmensiObrazekNaMini($tmp);

      $obr = $this->var->dnzm;
      $u = fopen($obr, "r");  //otevře
      $stream1 = base64_encode(addslashes(fread($u, filesize($obr))));  //odělá '' a zakoduje
      fclose($u); //zavře

      $this->ZmensiObrazekNaFull($tmp);

      $obr = $this->var->dnzf;
      $u = fopen($obr, "r");  //otevře
      $stream2 = base64_encode(addslashes(fread($u, filesize($obr))));  //odělá '' a zakoduje
      fclose($u); //zavře

      if (!@$this->var->mysqli->multi_query("INSERT INTO fotozamestnanecmini (id, foto, nazev, typ) VALUES({$idzam}, '{$stream1}', '{$jmeno}','{$typ}');"))
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globální proměnné
      }

      if (!@$this->var->mysqli->multi_query("INSERT INTO fotozamestnanecfull (id, foto, nazev, typ) VALUES({$idzam}, '{$stream2}', '{$jmeno}','{$typ}');"))
      {
        $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globální proměnné
      }
*/
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->jazyk["foto_err"]);
    }
  }
//******************************************************************************
  function UpravitFotku($idzam) //upraví fotku s jeho id
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

      $obr = $this->var->dnzm;
      $u = fopen($obr, "r");  //otevře
      $stream1 = base64_encode(addslashes(fread($u, filesize($obr))));  //odělá '' a zakoduje
      fclose($u); //zavře

      $this->ZmensiObrazekNaFull($tmp);

      $obr = $this->var->dnzf;
      $u = fopen($obr, "r");  //otevře
      $stream2 = base64_encode(addslashes(fread($u, filesize($obr))));  //odělá '' a zakoduje
      fclose($u); //zavře

      @$this->var->mysqli->multi_query("DELETE FROM fotozamestnanecmini WHERE id={$idzam};");
      @$this->var->mysqli->multi_query("DELETE FROM fotozamestnanecfull WHERE id={$idzam};");
      @$this->var->mysqli->multi_query("INSERT INTO fotozamestnanecmini (id, foto, nazev, typ) VALUES({$idzam}, '{$stream1}', '{$jmeno}', '{$typ}');");
      @$this->var->mysqli->multi_query("INSERT INTO fotozamestnanecfull (id, foto, nazev, typ) VALUES({$idzam}, '{$stream2}', '{$jmeno}', '{$typ}');");
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->jazyk["foto_err"]);
    }
  }
//******************************************************************************
  function SmazatFotku($idzam)  //smaze fotku
  {
    if (!Empty($idzam) && $idzam != 0)
    {
      $this->var->mysqli->multi_query("DELETE FROM fotozamestnanecmini WHERE id={$idzam};");
      $this->var->mysqli->multi_query("DELETE FROM fotozamestnanecfull WHERE id={$idzam};");
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
      case 2: //jpg
        $source = @imagecreatefromjpeg($stream);
        @imagecopyresampled($res, $source, 0, 0, 0, 0, $newwidth, $newheight, $w, $h);
        imagejpeg($res, $this->var->dnzm);
      break;

      case 3: //png
        $source = @imagecreatefrompng($stream);
        @imagecopyresampled($res, $source, 0, 0, 0, 0, $newwidth, $newheight, $w, $h);
        imagepng($res, $this->var->dnzm);
      break;
    }
    imagedestroy($res);
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
      case 2: //jpg
        $source = @imagecreatefromjpeg($stream);
        @imagecopyresampled($res, $source, 0, 0, 0, 0, $newwidth, $newheight, $w, $h);
        imagejpeg($res, $this->var->dnzf);
      break;

      case 3: //png
        $source = @imagecreatefrompng($stream);
        @imagecopyresampled($res, $source, 0, 0, 0, 0, $newwidth, $newheight, $w, $h);
        imagepng($res, $this->var->dnzf);
      break;
    }
    imagedestroy($res);
  }
//******************************************************************************
  function ZamestnanecPrava() //vypise prava zamestnance
  {
    if ($res = @$this->var->mysqli->query("SELECT id, prava FROM prava ORDER BY prava ASC;"))
    {
      if ($res->num_rows != 0)
      {
        $result = //výpis prava
        "<select name=\"zam_prava\">";
        while ($data = $res->fetch_object())
        {
          $result .=
          "
          <option value=\"{$data->id}\">{$data->prava}</option>
          ";
        }
        $result .=
        "</select>";
      }
        else
      {
        $result = $this->var->main->EmptyLine();
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globální proměnné
    }

    return $result;
  }
//******************************************************************************
  function ZamestnanecOznacenyPrava($id)  //vypise oznaceny prava
  {
    if ($res = @$this->var->mysqli->query("SELECT id, prava FROM prava ORDER BY prava ASC;"))
    {
      if ($res->num_rows != 0)
      {
        $result = //výpis prava
        "<select name=\"zam_prava\">";
        while ($data = $res->fetch_object())
        {
          $result .=
          "
          <option value=\"{$data->id}\" ".($data->id == $id ? "selected=\"selected\"" : "").">{$data->prava}</option>
          ";
        }
        $result .=
        "</select>";
      }
        else
      {
        $result = $this->var->main->EmptyLine();
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globální proměnné
    }

    return $result;
  }
//******************************************************************************
  function ZamestnanecRodnyJazyk()  //vypíše možnosti rozných jazyků z db jazyk
  {
    if ($res = @$this->var->mysqli->query("SELECT id, jazyk FROM jazyk ORDER BY jazyk ASC;"))
    {
      if ($res->num_rows != 0)
      {
        $result =
        "<select name=\"zam_matjazyk\">";
        while ($data = $res->fetch_object())
        {
          $result .=
          "
          <option value=\"{$data->id}\">{$data->jazyk}</option>
          ";
        }
        $result .=
        "</select>";
      }
        else
      {
        $result = $this->var->main->EmptyLine();
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globální proměnné
    }

    return $result;
  }
//******************************************************************************
  function ZamestnanecOznacenyEditRodnyJazyk($id) //vypíše označený rodný jazyk
  {
    if ($res = @$this->var->mysqli->query("SELECT id, jazyk FROM jazyk ORDER BY jazyk ASC;"))
    {
      if ($res->num_rows != 0)
      {
        $result =
        "<select name=\"zam_matjazyk\">";
        while ($data = $res->fetch_object())
        {
          $result .=
          "
          <option value=\"{$data->id}\" ".($id == $data->id ? "selected=\"selected\"" : "").">{$data->jazyk}</option>
          ";
        }
        $result .=
        "</select>";
      }
        else
      {
        $result = $this->var->main->EmptyLine();
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globální proměnné
    }

    return $result;
  }
//******************************************************************************
  function ZamestnanecVzdelani()  //jaké vzdělání, přesně definováno
  {
    if ($res = @$this->var->mysqli->query("SELECT id, vzdelani FROM vzdelani ORDER BY id ASC;"))
    {
      if ($res->num_rows != 0)
      {
        $result =
        "<select name=\"zam_vzdelani\">";
        while ($data = $res->fetch_object())
        {
          $result .=
          "
          <option value=\"{$data->id}\">{$data->vzdelani}</option>
          ";
        }
        $result .=
        "</select>";
      }
        else
      {
        $result = $this->var->main->EmptyLine();
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globální proměnné
    }

    return $result;
  }
//******************************************************************************
  function ZamestnanecOznacenyEditVzdelani($id)  //vypíše označení jaký zzdělání, přesně definováno
  {
    if ($res = @$this->var->mysqli->query("SELECT id, vzdelani FROM vzdelani ORDER BY id ASC;"))
    {
      if ($res->num_rows != 0)
      {
        $result =
        "<select name=\"zam_vzdelani\">";
        while ($data = $res->fetch_object())
        {
          $result .=
          "
          <option value=\"{$data->id}\" ".($id == $data->id ? "selected=\"selected\"" : "").">{$data->vzdelani}</option>
          ";
        }
        $result .=
        "</select>";
      }
        else
      {
        $result = $this->var->main->EmptyLine();
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globální proměnné
    }

    return $result;
  }
//******************************************************************************
  function ZamestnanecRidicak() //možnosti řidičáku, přesně definováno
  {
    if ($res = @$this->var->mysqli->query("SELECT id, ridicak FROM ridicak ORDER BY id;"))
    {
      if ($res->num_rows != 0)
      {
        while ($data = $res->fetch_object())
        {
          $result .=
          "<input type=\"checkbox\" name=\"zam_ridicak[]\" value=\"{$data->id}\" />{$data->ridicak}<br />
          ";
        }
      }
        else
      {
        $result = $this->var->main->EmptyLine();
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globální proměnné
    }

    return $result;
  }
//******************************************************************************
  function OznacenyRidicakHledani() //možnosti řidičáku, přesně definováno
  {
    if ($res = @$this->var->mysqli->query("SELECT id, ridicak FROM ridicak ORDER BY id;"))
    {
      if ($res->num_rows != 0)
      {
        while ($data = $res->fetch_object())
        {
          $result .=
          "<input type=\"checkbox\" name=\"zam_ridicak[]\" value=\"{$data->id}\" ".(!Empty($_POST["zam_ridicak"]) && in_array($data->id, $_POST["zam_ridicak"]) ? "checked=\"checked\"" : "")." />{$data->ridicak}<br />
          ";
        }
      }
        else
      {
        $result = $this->var->main->EmptyLine();
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globální proměnné
    }

    return $result;
  }
//******************************************************************************
  function ZamestnanecOznacenyEditExistRidicak($id) //vypíše označený radiobutton exist řidičák, přesně definováno
  {
    $oznac[$id] = "checked=\"checked\"";

    $result =
    "
    <input type=\"radio\" name=\"zam_existridicak\" value=\"true\" {$oznac[1]} />{$this->var->jazyk["ano"]}
    <input type=\"radio\" name=\"zam_existridicak\" value=\"false\" {$oznac[0]} />{$this->var->jazyk["ne"]}<br />
    ";

    return $result;
  }
//******************************************************************************
  function ZamestnanecOznacenyRidicak($id) //vypíše jaké řidičáky dotyčný má, přesně definováno
  {
    if ($res = @$this->var->mysqli->query("SELECT ridicak.ridicak as ridicak FROM zamestnanec, zamestnanec_ma_ridicak, ridicak WHERE zamestnanec.id=zamestnanec_ma_ridicak.idzamestnanec AND zamestnanec_ma_ridicak.idridicak=ridicak.id AND zamestnanec.id={$id};"))
    {
      if ($res->num_rows != 0)
      {
        while ($data = $res->fetch_object())
        {
          $result .=
          "{$data->ridicak}, ";
        }
        $result = substr($result, 0, -2);
      }
        else
      {
        $result = $this->var->main->EmptyLine();
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globální proměnné
    }

    return $result;
  }
//******************************************************************************
  function ZamestnanecOznacenyEditRidicak($id) //vypíše označený jaky řidičák edit, přesně definováno
  {
    if ($res = @$this->var->mysqli->query("SELECT id, ridicak FROM ridicak ORDER BY id;"))
    {
      if ($res->num_rows != 0)
      {
        if ($r = @$this->var->mysqli->query("SELECT idridicak FROM zamestnanec, zamestnanec_ma_ridicak, ridicak WHERE zamestnanec.id=zamestnanec_ma_ridicak.idzamestnanec AND zamestnanec_ma_ridicak.idridicak=ridicak.id AND zamestnanec.id={$id};"))
        {
          while ($d = $r->fetch_object())
          {
            $oznac[$d->idridicak] = "checked=\"checked\"";
          }
        }
          else
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globální proměnné
        }

        while ($data = $res->fetch_object())
        {
          $result .=
          "<input type=\"checkbox\" name=\"zam_ridicak[]\" value=\"{$data->id}\" {$oznac[$data->id]} />{$data->ridicak}<br />
          ";
        }
      }
        else
      {
        $result = $this->var->main->EmptyLine();
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globální proměnné
    }

    return $result;
  }
//******************************************************************************
  function ZamestnanecOznacenyEditExistFoto($zamid) //vypíše označený radiobutton edit exist foto
  {
    if ($res = @$this->var->mysqli->query("SELECT id FROM fotozamestnanecmini WHERE id={$zamid};"))
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
      $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globální proměnné
    }

    $result =
    "
    <input type=\"radio\" name=\"zam_existfoto\" value=\"true\" onclick=\"ZablokovaniElementu('fot', false);\" {$oznac[1]} />{$this->var->jazyk["ano"]}
    <input type=\"radio\" name=\"zam_existfoto\" value=\"false\" onclick=\"ZablokovaniElementu('fot', true);\" {$oznac[0]} />{$this->var->jazyk["ne"]}
    ";

    return $result;
  }
//******************************************************************************
  function IntToFoto($zamid)  //zjistí jestli existuje hlavní fotka zaměstnance
  {
    if ($res = @$this->var->mysqli->query("SELECT id FROM fotozamestnanecmini WHERE id={$zamid};"))
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
      $this->var->main->ErrorMsg($this->mysqli->error); //chyba do globální proměnné
    }

    $result = $this->var->main->IntToBool($oznac);

    return $result;
  }
//******************************************************************************
  function IntToPohlavi($hodnota) //převadí číselnou hodnotu na textový typ
  {
    switch ($hodnota)
    {
      case 1:
        $result = $this->var->jazyk["muz"];
      break;

      case 0:
        $result = $this->var->jazyk["zena"];
      break;
    }

    return $result;
  }
//******************************************************************************
  function ZamestnanecOznacenyEditTytul($id)  //vypíše označený radiobutton pro editaci tytulu
  {
    $oznac[$id] = "checked=\"checked\"";

    $result =
    "
    <input type=\"radio\" name=\"zam_tytul\" value=\"true\" {$oznac[1]} />{$this->var->jazyk["ano"]}
    <input type=\"radio\" name=\"zam_tytul\" value=\"false\" {$oznac[0]} />{$this->var->jazyk["ne"]}<br />
    ";

    return $result;
  }
//******************************************************************************
  function ZamestnanecOznacenyEditStredni($id)  //vypíše označený radiobutton pro editaci střední
  {
    $oznac[$id] = "checked=\"checked\"";

    $result =
    "
    <input type=\"radio\" name=\"zam_vyuc\" value=\"true\" {$oznac[1]} />{$this->var->jazyk["ano"]}
    <input type=\"radio\" name=\"zam_vyuc\" value=\"false\" {$oznac[0]} />{$this->var->jazyk["ne"]}<br />
    ";

    return $result;
  }
//******************************************************************************
  function ZamestnanecOznacenyEditMaturita($id) //vypíše označený radiobutton pro editaci maturity
  {
    $oznac[$id] = "checked=\"checked\"";

    $result =
    "
    <input type=\"radio\" name=\"zam_mat\" value=\"true\" {$oznac[1]} />{$this->var->jazyk["ano"]}
    <input type=\"radio\" name=\"zam_mat\" value=\"false\" {$oznac[0]} />{$this->var->jazyk["ne"]}<br />
    ";

    return $result;
  }
//******************************************************************************
  function ZamestnanecOznacenyEditVyska($id)  //vypíše označený radiobutton pro editaci vyšky
  {
    $oznac[$id] = "checked=\"checked\"";

    $result =
    "
    <input type=\"radio\" name=\"zam_vyska\" value=\"true\" {$oznac[1]} />{$this->var->jazyk["ano"]}
    <input type=\"radio\" name=\"zam_vyska\" value=\"false\" {$oznac[0]} />{$this->var->jazyk["ne"]}<br />
    ";

    return $result;
  }
//******************************************************************************
  function ZamestnanecHobby() //vypíše zaškrkávací hobby
  {
    if ($res = @$this->var->mysqli->query("SELECT id, hobby FROM hobby ORDER BY hobby ASC;"))
    {
      if ($res->num_rows != 0)
      {
        while ($data = $res->fetch_object())
        {
          $result .=
          "
          <input type=\"checkbox\" name=\"zam_hobby[]\" value=\"{$data->id}\" />{$data->hobby}<br />
          ";
        }
      }
        else
      {
        $this->var->main->EmptyLine();
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globální proměnné
    }

    return $result;
  }
//******************************************************************************
  function OznacenyHobbyHledani() //vypíše zaškrkávací hobby
  {
    if ($res = @$this->var->mysqli->query("SELECT id, hobby FROM hobby ORDER BY hobby ASC;"))
    {
      if ($res->num_rows != 0)
      {
        while ($data = $res->fetch_object())
        {
          $result .=
          "<input type=\"checkbox\" name=\"zam_hobby[]\" value=\"{$data->id}\" ".(!Empty($_POST["zam_hobby"]) && in_array($data->id, $_POST["zam_hobby"]) ? "checked=\"checked\"" : "")." />{$data->hobby}<br />
          ";
        }
      }
        else
      {
        $this->var->main->EmptyLine();
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globální proměnné
    }

    return $result;
  }
//******************************************************************************
  function ZamestnanecOznacenyHobby($id)  //vypíše hobby textově
  {
    if ($res = @$this->var->mysqli->query("SELECT hobby FROM zamestnanec, zamestnanec_ma_hobby, hobby WHERE zamestnanec.id=zamestnanec_ma_hobby.idzamestnanec AND hobby.id=zamestnanec_ma_hobby.idhobby AND zamestnanec.id={$id} ORDER BY hobby ASC;"))
    {
      if ($res->num_rows != 0)
      {
        while ($data = $res->fetch_object())
        {
          $result .=
          "{$data->hobby}, ";
        }
        $result = substr($result, 0, -2);
      }
        else
      {
        $result = $this->var->main->EmptyLine();
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globální proměnné
    }

    return $result;
  }
//******************************************************************************
  function ZamestnanecOznacenyEditHobby($id)  //vypíše zaškrkané hobby
  {
    if ($res = @$this->var->mysqli->query("SELECT id, hobby FROM hobby ORDER BY hobby ASC;"))
    {
      if ($res->num_rows != 0)
      {
        if ($r = @$this->var->mysqli->query("SELECT hobby.id as id FROM zamestnanec, zamestnanec_ma_hobby, hobby WHERE zamestnanec.id=zamestnanec_ma_hobby.idzamestnanec AND hobby.id=zamestnanec_ma_hobby.idhobby AND zamestnanec.id={$id};"))
        {
          while ($d = $r->fetch_object())
          {
            $oznac[$d->id] = "checked=\"checked\"";
          }
        }
          else
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globální proměnné
        }

        while ($data = $res->fetch_object())
        {
          $result .=
          "
          <input type=\"checkbox\" name=\"zam_hobby[]\" value=\"{$data->id}\" {$oznac[$data->id]} />{$data->hobby}<br />
          ";
        }
      }
        else
      {
        $result = $this->var->main->EmptyLine();
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globální proměnné
    }

    return $result;
  }

//******************************************************************************
  function ZamestnanecSport() //vypíše sporty
  {
    if ($res = @$this->var->mysqli->query("SELECT id, sport FROM sport ORDER BY sport ASC;"))
    {
      if ($res->num_rows != 0)
      {
        while ($data = $res->fetch_object())
        {
          $result .=
          "
          <input type=\"checkbox\" name=\"zam_sport[]\" value=\"{$data->id}\" />{$data->sport}<br />
          ";
        }
      }
        else
      {
        $result = $this->var->main->EmptyLine();
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globální proměnné
    }

    return $result;
  }
//******************************************************************************
  function OznacenySportHledani() //vypíše sporty
  {
    if ($res = @$this->var->mysqli->query("SELECT id, sport FROM sport ORDER BY sport ASC;"))
    {
      if ($res->num_rows != 0)
      {
        while ($data = $res->fetch_object())
        {
          $result .=
          "<input type=\"checkbox\" name=\"zam_sport[]\" value=\"{$data->id}\" ".(!Empty($_POST["zam_sport"]) && in_array($data->id, $_POST["zam_sport"]) ? "checked=\"checked\"" : "")." />{$data->sport}<br />
          ";
        }
      }
        else
      {
        $result = $this->var->main->EmptyLine();
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globální proměnné
    }

    return $result;
  }
//******************************************************************************
  function ZamestnanecOznacenySport($id)  //vypíše textově sporty
  {
    if ($res = @$this->var->mysqli->query("SELECT sport FROM zamestnanec, zamestnanec_ma_sport, sport WHERE zamestnanec.id=zamestnanec_ma_sport.idzamestnanec AND sport.id=zamestnanec_ma_sport.idsport AND zamestnanec.id={$id} ORDER BY sport ASC"))
    {
      if ($res->num_rows != 0)
      {
        while ($data = $res->fetch_object())
        {
          $result .=
          "{$data->sport}, ";
        }
        $result = substr($result, 0, -2);
      }
        else
      {
        $result = $this->var->main->EmptyLine();
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globální proměnné
    }

    return $result;
  }
//******************************************************************************
  function ZamestnanecOznacenyEditSport($id)  //vypíše zaškrkané sporty
  {
    if ($res = @$this->var->mysqli->query("SELECT id, sport FROM sport ORDER BY sport ASC;"))
    {
      if ($res->num_rows != 0)
      {
        if ($r = @$this->var->mysqli->query("SELECT sport.id FROM zamestnanec, zamestnanec_ma_sport, sport WHERE zamestnanec.id=zamestnanec_ma_sport.idzamestnanec AND sport.id=zamestnanec_ma_sport.idsport AND zamestnanec.id={$id}"))
        {
          while ($d = $r->fetch_object())
          {
            $oznac[$d->id] = "checked=\"checked\"";
          }
        }
          else
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globální proměnné
        }

        while ($data = $res->fetch_object())
        {
          $result .=
          "
          <input type=\"checkbox\" name=\"zam_sport[]\" value=\"{$data->id}\" {$oznac[$data->id]} />{$data->sport}<br />
          ";
        }
      }
        else
      {
        $result = $this->var->main->EmptyLine();
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globální proměnné
    }

    return $result;
  }
//******************************************************************************
  function ZamestnanecVyska() //vypíše obory výšky
  {
    if ($res = @$this->var->mysqli->query("SELECT id, typ FROM typvysoke ORDER BY typ ASC;"))
    {
      if ($res->num_rows != 0)
      {
        while ($data = $res->fetch_object())
        {
          $result .=
          "
          <input type=\"checkbox\" name=\"zam_obor[]\" value=\"{$data->id}\" />{$data->typ}<br />
          ";
        }
      }
        else
      {
        $result = $this->var->main->EmptyLine();
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globální proměnné
    }

    return $result;
  }
//******************************************************************************
  function OznacenyVyskaHladani() //vypíše obory výšky
  {
    if ($res = @$this->var->mysqli->query("SELECT id, typ FROM typvysoke ORDER BY typ ASC;"))
    {
      if ($res->num_rows != 0)
      {
        while ($data = $res->fetch_object())
        {
          $result .=
          "
          <input type=\"checkbox\" name=\"zam_obor[]\" value=\"{$data->id}\" ".(!Empty($_POST["zam_obor"]) && in_array($data->id, $_POST["zam_obor"]) ? "checked=\"checked\"" : "")." />{$data->typ}<br />
          ";
        }
      }
        else
      {
        $result = $this->var->main->EmptyLine();
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globální proměnné
    }

    return $result;
  }
//******************************************************************************
  function ZamestnanecOznacenyVyska($id)  //vypíše textově obory výšky
  {
    if ($res = @$this->var->mysqli->query("SELECT typ FROM zamestnanec, zamestnanec_ma_typvysoke, typvysoke WHERE zamestnanec.id=zamestnanec_ma_typvysoke.idzamestnanec AND typvysoke.id=zamestnanec_ma_typvysoke.idtypvysoke AND zamestnanec.id={$id} ORDER BY typ ASC"))
    {
      if ($res->num_rows != 0)
      {
        while ($data = $res->fetch_object())
        {
          $result .=
          "{$data->typ}, ";
        }
        $result = substr($result, 0, -2);
      }
        else
      {
        $result = $this->var->main->EmptyLine();
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globální proměnné
    }

    return $result;
  }
//******************************************************************************
  function ZamestnanecOznacenyEditTypVyska($id) //vypíše označené obory výšky
  {
    if ($res = @$this->var->mysqli->query("SELECT id, typ FROM typvysoke ORDER BY typ ASC;"))
    {
      if ($res->num_rows != 0)
      {
        if ($r = @$this->var->mysqli->query("SELECT typvysoke.id as id FROM zamestnanec, zamestnanec_ma_typvysoke, typvysoke WHERE zamestnanec.id=zamestnanec_ma_typvysoke.idzamestnanec AND typvysoke.id=zamestnanec_ma_typvysoke.idtypvysoke AND zamestnanec.id=$id"))
        {
          while ($d = $r->fetch_object())
          {
            $oznac[$d->id] = "checked=\"checked\"";
          }
        }
          else
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globální proměnné
        }

        while ($data = $res->fetch_object())
        {
          $result .=
          "
          <input type=\"checkbox\" name=\"zam_obor[]\" value=\"{$data->id}\" {$oznac[$data->id]} />{$data->typ}<br />
          ";
        }
      }
        else
      {
        $result = $this->var->main->EmptyLine();
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globální proměnné
    }

    return $result;
  }
//******************************************************************************
  function HledaniZamestnanec()
  {
    $prek = array("loginjmeno" => "zam_log",
                  "loginheslo" => "zam_hes",
                  "jmeno" => "zam_jmeno",
                  "prijmeni" => "zam_prim",
                  "ulice" => "zam_ulice",
                  "cp" => "zam_cp",
                  "psc" => "zam_psc",
                  "mesto" => "zam_mesto",
                  "predvolba" => "zam_tel1_p",
                  "telefon" => "zam_tel1",
                  "predvolba1" => "zam_tel2_p",
                  "telefon1" => "zam_tel2",
                  "email" => "zam_email",
                  "datumnarozeni" => "zam_datnar",
                  "datumosloveni" => "zam_datosloveni",
                  "datumzivotopisu" => "zam_datzivot",
                  "datumpohovoru" => "zam_datpoh",
                  "datumzacatek" => "zam_datzac",
                  "datumodmitnuti" => "zam_datodmit",
                  "datumkonec" => "zam_konprac",
                  "mistonarozeni" => "zam_rodiste",
                  "jmenootce" => "zam_jmotce",
                  "prijmeniotce" => "zam_prijotce",
                  "povolaniotce" => "zam_povotce",
                  "jmenomatky" => "zam_jmmatky",
                  "prijmenimatky" => "zam_prijmatky",
                  "povolanimatky" => "zam_povmatky",
                  "pocetbratru" => "zam_pocbrat",
                  "pocetsester" => "zam_pocsest",
                  "nazevstredni" => "zam_typstredni",
                  "stredniod" => "od",
                  "strednido" => "do",
                  "nazevvysoke" => "zam_vyska",
                  "vyskaod" => "od",
                  "vyskado" => "do",
                  "jazyk" => "zam_jazyk",
                  "ridicak" => "zam_typridicak",
                  "hobby" => "zam_hobby",
                  "sport" => "zam_sport",
                  "typ" => "zam_obor");

//value[0], jazykový ekvyvalent[1], obsah povolení[2], propojovaci id[3], oznaceni v html formě[4], datový typ[5]; (pripojne tabulky[6], zobrazeni pripojne tabulky[7])  pri jine DB se pouziva id z aktualni
    $pridpole = array(array("idprava", "zam_prava", "{$this->var->zam->ZamestnanecOznacenyPrava($_POST["zam_prava"])}", "idprava", "zam_prava", "int"),
                      array("idzeme", "zam_zeme", "{$this->var->main->OznacenyEditZeme($_POST["search_zeme"], "search_zeme")}", "idzeme", "search_zeme", "int"),
                      array("jazyk.id", "zam_jazyk", "<br />{$this->var->main->OznacenyEditJazykHledani("search_jazyk")}", "(zamestnanec.id=zamestnanec_umi_jazyk.idzamestnanec AND zamestnanec_umi_jazyk.idjazyk=jazyk.id)", "search_jazyk", "array", ", zamestnanec_umi_jazyk, jazyk", "jazyk.jazyk"),
                      array("idvzdelani", "zam_vzdelani", "{$this->var->zam->ZamestnanecOznacenyEditVzdelani($_POST["zam_vzdelani"])}", "idvzdelani", "zam_vzdelani", "int"),
                      array("ridicak", "zam_ridicak", "{$this->var->main->RadioButton("search_ridicak", $this->var->main->BoolToInt($_POST["search_ridicak"]))}", "zamestnanec.ridicak", "search_ridicak", "bool"),
                      array("ridicak.id", "zam_typridicak", "<br />{$this->var->zam->OznacenyRidicakHledani()}", "(zamestnanec.id=zamestnanec_ma_ridicak.idzamestnanec AND zamestnanec_ma_ridicak.idridicak=ridicak.id)", "zam_ridicak", "array", ", zamestnanec_ma_ridicak, ridicak", "ridicak.ridicak"),
                      array("pohlavi", "zam_pohlavi", "{$this->var->main->RadioButton("search_pohlavi", $this->var->main->BoolToInt($_POST["search_pohlavi"]), "muz", "zena")}", "pohlavi", "search_pohlavi", "bool"),
                      array("idstatus", "zam_status", "{$this->var->main->OznacenyEditStatus($_POST["search_status"], "search_status")}", "idstatus", "search_status", "int"),
                      //array("foto", "zam_existfoto", "{$this->var->main->RadioButton("search_foto")}", "id", "search_foto", "bool"),
                      array("hobby.id", "zam_hobby", "<br />{$this->var->zam->OznacenyHobbyHledani()}", "(zamestnanec.id=zamestnanec_ma_hobby.idzamestnanec AND hobby.id=zamestnanec_ma_hobby.idhobby)", "zam_hobby", "array", ", zamestnanec_ma_hobby, hobby", "hobby.hobby"),
                      array("sport.id", "zam_sport", "<br />{$this->var->zam->OznacenySportHledani()}", "(zamestnanec.id=zamestnanec_ma_sport.idzamestnanec AND sport.id=zamestnanec_ma_sport.idsport)", "zam_sport", "array", ", zamestnanec_ma_sport, sport", "sport.sport"),
                      array("idzemenarozeni", "zam_zemenaroz", "{$this->var->main->OznacenyEditZeme($_POST["search_rodiste"], "search_rodiste")}", "idzemenarozeni", "search_rodiste", "int"),
                      array("idrodnyjazyk", "zam_matjazyk", "{$this->var->zam->ZamestnanecOznacenyEditRodnyJazyk($_POST["zam_matjazyk"])}", "idrodnyjazyk", "zam_matjazyk", "int"),
                      array("maturita", "zam_mat", "{$this->var->main->RadioButton("search_maturita", $this->var->main->BoolToInt($_POST["search_maturita"]))}", "maturita", "search_maturita", "bool"),
                      array("stredni", "zam_stredni", "{$this->var->main->RadioButton("search_stredi", $this->var->main->BoolToInt($_POST["search_stredi"]))}", "stredni", "search_stredi", "bool"),
                      array("vysoka", "zam_vyska", "{$this->var->main->RadioButton("search_vysoka", $this->var->main->BoolToInt($_POST["search_vysoka"]))}", "vysoka", "search_vysoka", "bool"),
                      array("typvysoke.id", "zam_obor", "<br />{$this->var->zam->OznacenyVyskaHladani()}", "(zamestnanec.id=zamestnanec_ma_typvysoke.idzamestnanec AND typvysoke.id=zamestnanec_ma_typvysoke.idtypvysoke)", "zam_obor", "array", ", zamestnanec_ma_typvysoke, typvysoke", "typvysoke.typ"),
                      array("vystytul", "zam_tytul", "{$this->var->main->RadioButton("search_tytul", $this->var->main->BoolToInt($_POST["search_tytul"]))}", "vystytul", "search_tytul", "bool")
                      );

    for($i = 0; $i < count($pridpole); $i++)
    {
      $pridavek .=
      "<input type=\"checkbox\" name=\"pridavek[{$i}]\" value=\"{$pridpole[$i][0]}\" ".(!Empty($_POST[pridavek]) && in_array($pridpole[$i][0], $_POST[pridavek]) ? "checked=\"checked\"" : "")." /> {$this->var->jazyk[$pridpole[$i][1]]}: {$pridpole[$i][2]}<br />
      ";
    }

    if ($res = @$this->var->mysqli->query("SELECT loginjmeno, loginheslo, jmeno, prijmeni, ulice, cp, psc, mesto, predvolba, telefon, predvolba1, telefon1, email, datumnarozeni, datumosloveni, datumzivotopisu, datumpohovoru, datumzacatek, datumodmitnuti, datumkonec, mistonarozeni, jmenootce, prijmeniotce, povolaniotce, jmenomatky, prijmenimatky, povolanimatky, pocetbratru, pocetsester, nazevstredni, stredniod, strednido, nazevvysoke, vyskaod, vyskado FROM zamestnanec;"))
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
      $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globální proměnné
    }

    $result .= include "{$this->var->form}/hledani_zamestnanec.php";

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
              $kde .= "{$pridpole[$i][3]} AND {$arr} ".($pocarray == $a ? "GROUP BY zamestnanec.id {$_POST["logicky"]} " : "{$_POST["logicky"]} "); //zamerne doplneno AND
              $dotaz .= "{$pridpole[$i][7]}, ";
              $arr = "";  //vynulování
            break;
          } //end case
        } //end if
      } //end for

      $dotaz = substr($dotaz, 0, -2); //odstraneni posledniho prebytecneho clenu
      $kde = substr($kde, 0, -(strlen($_POST["logicky"]) + 2));

      $sql = "SELECT zamestnanec.id, idprava, {$dotaz} FROM zamestnanec{$from} WHERE {$kde} ORDER BY zamestnanec.prijmeni ASC, zamestnanec.jmeno ASC;";
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
            if ($jmeno != "id" && $jmeno != "idprava")
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
                  ".($data->$alljmeno[1] == $this->var->superadmin ? ($i == count($hlava) ? "<a href=\"?action={$_GET["action"]}&amp;akce=info&amp;cislo={$data->id}\">{$this->var->jazyk["info"]}</a>" : ($i == (count($hlava) + 1) ? "<a href=\"?action={$_GET["action"]}&amp;akce=edit&amp;cislo={$data->id}\">{$this->var->jazyk["edit"]}</a>" : $this->var->emptypol)) : ($i == count($hlava) ? "<a href=\"?action={$_GET["action"]}&amp;akce=info&amp;cislo={$data->id}\">{$this->var->jazyk["info"]}</a>" : ($i == (count($hlava) + 1) ? "<a href=\"?action={$_GET["action"]}&amp;akce=edit&amp;cislo={$data->id}\">{$this->var->jazyk["edit"]}</a>" : "<a href=\"?action={$_GET["action"]}&amp;akce=del&amp;cislo={$data->id}\">{$this->var->jazyk["del"]}</a>")))."
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
        $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globální proměnné
      }
    }

    return $result;
  }
//******************************************************************************
  function VygenerujPDF() //Aplikace PDF generatoru
  {
    $id = $_GET["cislo"];
    settype($id, "integer");

    if ($res = $this->var->mysqli->query("SELECT loginjmeno, jmeno, prijmeni, prava.prava,
                                          ulice, cp, psc, mesto, zeme.zeme, predvolba, telefon,
                                          predvolba1, telefon1, email, vzdelani.vzdelani,
                                          DATE_FORMAT(datumnarozeni, '{$this->var->mysqldatum}') as datumnarozeni,
                                          ridicak, pohlavi,
                                          DATE_FORMAT(datumosloveni, '{$this->var->mysqldatum}') as datumosloveni,
                                          DATE_FORMAT(datumzivotopisu, '{$this->var->mysqldatum}') as datumzivotopisu,
                                          DATE_FORMAT(datumpohovoru, '{$this->var->mysqldatum}') as datumpohovoru,
                                          DATE_FORMAT(datumzacatek, '{$this->var->mysqldatum}') as datumzacatek,
                                          DATE_FORMAT(datumodmitnuti, '{$this->var->mysqldatum}') as datumodmitnuti,
                                          DATE_FORMAT(datumkonec, '{$this->var->mysqldatum}') as datumkonec,
                                          status.status, mistonarozeni,
                                          zeme1.zeme as zemenar, jazyk.jazyk,
                                          jmenootce, prijmeniotce, povolaniotce,
                                          jmenomatky, prijmenimatky, povolanimatky,
                                          pocetbratru, pocetsester, maturita,
                                          stredni, nazevstredni, stredniod,
                                          strednido, vysoka, nazevvysoke, vyskaod,
                                          vyskado, vystytul
                                          FROM zamestnanec, prava, zeme, zeme as zeme1, vzdelani, status, jazyk
                                          WHERE zamestnanec.idprava=prava.id AND
                                          zamestnanec.idzeme=zeme.id AND
                                          zamestnanec.idvzdelani=vzdelani.id AND
                                          zamestnanec.idstatus=status.id AND
                                          zamestnanec.idzemenarozeni=zeme1.id AND
                                          zamestnanec.idrodnyjazyk=jazyk.id AND
                                          zamestnanec.id={$id};"))
    {
      if ($res->num_rows != 0)
      {
        $data = $res->fetch_object();
        $ignorovat = array ("<strong>",
                            "</strong>");

        $popis = array ("",
                        "{$this->var->jazyk["zam_log"]}:",
                        "{$this->var->jazyk["zam_jmeno"]}:",
                        "{$this->var->jazyk["zam_prim"]}:",
                        "{$this->var->jazyk["zam_prava"]}:",
                        "{$this->var->jazyk["zam_ulice"]}:",
                        "{$this->var->jazyk["zam_cp"]}:",
                        "{$this->var->jazyk["zam_psc"]}:",
                        "{$this->var->jazyk["zam_mesto"]}:",
                        "{$this->var->jazyk["zam_zeme"]}:",
                        "{$this->var->jazyk["zam_tel1"]}:",
                        "{$this->var->jazyk["zam_tel2"]}:",
                        "{$this->var->jazyk["zam_email"]}:",
                        "{$this->var->jazyk["zam_datnar"]}:",
                        "{$this->var->jazyk["zam_jazyk"]}:",
                        "{$this->var->jazyk["zam_vzdelani"]}:",
                        "{$this->var->jazyk["zam_ridicak"]}:",
                        "{$this->var->jazyk["zam_typridicak"]}:",
                        "{$this->var->jazyk["zam_pohlavi"]}:",
                        "{$this->var->jazyk["zam_datosloveni"]}:",
                        "{$this->var->jazyk["zam_datzivot"]}:",
                        "{$this->var->jazyk["zam_datpoh"]}:",
                        "{$this->var->jazyk["zam_datzac"]}:",
                        "{$this->var->jazyk["zam_datodmit"]}:",
                        "{$this->var->jazyk["zam_konprac"]}:",
                        "{$this->var->jazyk["zam_status"]}:",
                        "{$this->var->jazyk["zam_existfoto"]}:",
                        "{$this->var->jazyk["zam_hobby"]}:",
                        "{$this->var->jazyk["zam_sport"]}:",
                        "{$this->var->jazyk["zam_rodiste"]}:",
                        "{$this->var->jazyk["zam_zemenaroz"]}:",
                        "{$this->var->jazyk["zam_matjazyk"]}:",
                        "{$this->var->jazyk["zam_jmotce"]}:",
                        "{$this->var->jazyk["zam_prijotce"]}:",
                        "{$this->var->jazyk["zam_povotce"]}:",
                        "{$this->var->jazyk["zam_jmmatky"]}:",
                        "{$this->var->jazyk["zam_prijmatky"]}:",
                        "{$this->var->jazyk["zam_povmatky"]}:",
                        "{$this->var->jazyk["zam_pocbrat"]}:",
                        "{$this->var->jazyk["zam_pocsest"]}:",
                        "{$this->var->jazyk["zam_sumsour"]}:",
                        "{$this->var->jazyk["zam_mat"]}:",
                        "{$this->var->jazyk["zam_stredni"]}:",
                        "{$this->var->jazyk["zam_typstredni"]}:",
                        "{$this->var->jazyk["od"]} - {$this->var->jazyk["do"]}:",
                        "{$this->var->jazyk["zam_vyska"]}:",
                        "{$this->var->jazyk["zam_typvyska"]}:",
                        "{$this->var->jazyk["od"]} - {$this->var->jazyk["do"]}:",
                        "{$this->var->jazyk["zam_obor"]}:",
                        "{$this->var->jazyk["zam_tytul"]}:"
                        );

        $text = array("{$data->jmeno} {$data->prijmeni}", //title
                      (!Empty($data->loginjmeno) ? $data->loginjmeno : $this->var->emptypol),  //login:
                      (!Empty($data->jmeno) ? $data->jmeno : $this->var->emptypol),
                      (!Empty($data->prijmeni) ? $data->prijmeni : $this->var->emptypol),
                      (!Empty($data->prava) ? $data->prava : $this->var->emptypol),
                      (!Empty($data->ulice) ? $data->ulice : $this->var->emptypol),
                      (!Empty($data->cp) ? $data->cp : $this->var->emptypol),
                      (!Empty($data->psc) ? $data->psc : $this->var->emptypol),
                      (!Empty($data->mesto) ? $data->mesto : $this->var->emptypol),
                      (!Empty($data->zeme) ? $data->zeme : $this->var->emptypol),
                      (!Empty($data->telefon) ? "{$data->predvolba}{$data->telefon}" : $this->var->emptypol),
                      (!Empty($data->telefon1) ? "{$data->predvolba1}{$data->telefon1}" : $this->var->emptypol),
                      (!Empty($data->email) ? $data->email : $this->var->emptypol),
                      ($data->datumnarozeni != "00.00.0000" ? "{$data->datumnarozeni}" : $this->var->emptypol),
                      (str_replace($ignorovat, "", $this->var->main->OznacenyJazyk($id, "zamestnanec"))),
                      (!Empty($data->vzdelani) ? $data->vzdelani : $this->var->emptypol),
                      "{$this->var->main->IntToBool($data->ridicak)}",
                      (str_replace($ignorovat, "", $this->var->zam->ZamestnanecOznacenyRidicak($id))),
                      "{$this->var->zam->IntToPohlavi($data->pohlavi)}",
                      ($data->datumosloveni != "00.00.0000" ? "{$data->datumosloveni}" : $this->var->emptypol),
                      ($data->datumzivotopisu != "00.00.0000" ? "{$data->datumzivotopisu}" : $this->var->emptypol),
                      ($data->datumpohovoru != "00.00.0000" ? "{$data->datumpohovoru}" : $this->var->emptypol),
                      ($data->datumzacatek != "00.00.0000" ? "{$data->datumzacatek}" : $this->var->emptypol),
                      ($data->datumodmitnuti != "00.00.0000" ? "{$data->datumodmitnuti}" : $this->var->emptypol),
                      ($data->datumkonec != "00.00.0000" ? "{$data->datumkonec}" : $this->var->emptypol),
                      (!Empty($data->status) ? $data->status : $this->var->emptypol),
                      "{$this->var->zam->IntToFoto($id)}",
                      (str_replace($ignorovat, "", $this->var->zam->ZamestnanecOznacenyHobby($id))),
                      (str_replace($ignorovat, "", $this->var->zam->ZamestnanecOznacenySport($id))),
                      (!Empty($data->mistonarozeni) ? $data->mistonarozeni : $this->var->emptypol),
                      (!Empty($data->zemenar) ? $data->zemenar : $this->var->emptypol),
                      (!Empty($data->jazyk) ? $data->jazyk : $this->var->emptypol),
                      (!Empty($data->jmenootce) ? $data->jmenootce : $this->var->emptypol),
                      (!Empty($data->prijmeniotce) ? $data->prijmeniotce : $this->var->emptypol),
                      (!Empty($data->povolaniotce) ? $data->povolaniotce : $this->var->emptypol),
                      (!Empty($data->jmenomatky) ? $data->jmenomatky : $this->var->emptypol),
                      (!Empty($data->prijmenimatky) ? $data->prijmenimatky : $this->var->emptypol),
                      (!Empty($data->povolanimatky) ? $data->povolanimatky : $this->var->emptypol),
                      (!Empty($data->pocetbratru) ? $data->pocetbratru : $this->var->emptypol),
                      (!Empty($data->pocetsester) ? $data->pocetsester : $this->var->emptypol),
                      ($data->pocetbratru + $data->pocetsester),
                      "{$this->var->main->IntToBool($data->maturita)}",
                      "{$this->var->main->IntToBool($data->stredni)}",
                      (!Empty($data->nazevstredni) ? "{$data->nazevstredni}" : $this->var->emptypol),
                      (!Empty($data->stredniod) ? "{$data->stredniod} - {$data->strednido}" : $this->var->emptypol),
                      "{$this->var->main->IntToBool($data->vysoka)}",
                      (!Empty($data->nazevvysoke) ? "{$data->nazevvysoke}" : $this->var->emptypol),
                      (!Empty($data->vyskaod) ? "{$data->vyskaod} - {$data->vyskado}" : $this->var->emptypol),
                      (str_replace($ignorovat, "", $this->ZamestnanecOznacenyVyska($id))),
                      "{$this->var->main->IntToBool($data->vystytul)}"
                      );

        for ($i = 0; $i < count($text); $i++)
        {
          $popis[$i] = iconv('UTF-8', 'windows-1250', $popis[$i]);
          $text[$i] = iconv('UTF-8', 'windows-1250', $text[$i]);
        }

        if ($res = $this->var->mysqli->query("SELECT foto, typ FROM fotozamestnanecmini WHERE id={$id};"))
        {
          if ($res->num_rows != 0)  //kdyz existuje obrazek
          {
            $data = $res->fetch_object();

            switch ($data->typ)
            {
              case "image/jpeg":
                $kon = "jpg";
              break;

              case "image/png":
                $kon = "png";
              break;
            }

            $nazevobr = "./docasny.{$kon}"; //vytvor docasny obrazek z DB
            $u = fopen($nazevobr, "w");
            $obr = stripslashes(base64_decode($data->foto)); //přidá dekoduje a přidá ''
            fwrite($u, $obr);
            fclose($u); //zavře
          }
            else  //kdyz neexistuje obrazek
          {
            $nazevobr = "./obr/nahradni_obrazek_pdf.jpg";
            $result = $this->var->main->EmptyLine();
          }
        }
          else  //kbyz je chyba DB foto
        {
          $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globální proměnné
        }

        $border = 0;
        $vyska = 6; //vyska bunky
//p d f ************************************************************************
/*
define('FPDF_FONTPATH','./font/');

header('Content-Type','text/html; charset=WINDOWS-1250');



require('./fpdf.php');



$pdf=new FPDF();

$pdf->Open();

$pdf->AddPage();

$pdf->AddFont('Jmeno_fontu', '', 'vygenerovany_font.php');

$pdf->SetFont('Jmeno_fontu','',16);



$pdf->Cell(40,10, iconv('UTF-8', 'WINDOWS-1250', "můjaa článek" ) );

$pdf->Output();

*/

        $pdf = new PDF(); //vytvoreni tridy

        $pdf->SetCreator("Create by GF Design", true); //vyplneni creatoru
        $pdf->SetAuthor("GF Design", true); //podepsani autoru
        $pdf->SetDisplayMode("real", "single"); //nastaveni zobrazeni

        $pdf->AddPage();  //vytvori a prida stranku

        //hlavicka
        $pdf->SetFont("Arial", "B", 15);  //nastaveni fontu
        $pdf->SetXY(50, 10);  //nastaveni pozice
        $pdf->Cell(100, 10, $text[0], $border, 0, "C"); //vypise hlavicku

        //portret
        $pdf->Image($nazevobr, 160, 30, 30); //vlozeni obrazku

        //nastaveni fontu pro text
        $pdf->SetFont("Times", "", 12); //nasanevi fontu
        $pdf->SetXY(50, 30);

        for ($i = 1; $i < count($text); $i++)
        {
          $pdf->SetX(10); //nastaveni X
          $pdf->Cell(70, $vyska, $popis[$i], $border, 0, "R");  //vypis radku
          $pdf->Cell(100, $vyska, $text[$i], $border, 1, "L");  //vypis radku
        }

        $pdf->Output();
//******************************************************************************
      } //end if zam row = 1
        else
      {
        $result = $this->var->main->EmptyLine();
      }
    }
      else
    {
      $this->var->main->ErrorMsg($this->var->mysqli->error);  //chyba do globální proměnné
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
}
?>
