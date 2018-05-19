<?php
/*
onsubmit=\"UniverzalniKontrola('id_zam_email', '^[_a-zA-Z0-9\.\-]+@[_a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,4}\$', 'špatně email');\"
 onchange=\"UniverzalniKontrola('id_zam_cp', '{$this->var->regcislo}', '$chybnepole {$this->var->jazyk["zam_cp"]}!');\"
  onchange=\"UniverzalniKontrola('id_zam_psc', '{$this->var->regpsc}', '$chybnepole {$this->var->jazyk["zam_psc"]}!');\"
*/
  $chybnepole = $this->var->jazyk["chybapole"];
  return
  "<p>
            <br />
            {$this->var->jazyk["add_zamestnanec"]}
            </p>
            <form action=\"\" method=\"post\" enctype=\"multipart/form-data\">
              <fieldset>
                ".($this->var->main->PristupOdkaz("azam", "log") ? "{$this->var->jazyk["zam_log"]}
                <input type=\"text\" name=\"zam_log\" value=\"\" onkeyup=\"AjaxKontrola('id_zam_log', 'zamlog', this.value);\" />*<span id=\"id_zam_log\"></span>" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("azam", "hes") ? "{$this->var->jazyk["zam_hes"]}
                <input type=\"text\" name=\"zam_hes\" value=\"\" />*" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("azam", "hre") ? "{$this->var->jazyk["zam_hesrep"]}
                <input type=\"text\" name=\"zam_hesrep\" value=\"\" />*" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("azam", "jme") ? "{$this->var->jazyk["zam_jmeno"]}
                <input type=\"text\" name=\"zam_jmeno\" value=\"\" />" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("azam", "pri") ? "{$this->var->jazyk["zam_prim"]}
                <input type=\"text\" name=\"zam_prim\" value=\"\" />" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("azam", "pra") ? "{$this->var->jazyk["zam_prava"]}<br />
                {$this->var->zam->ZamestnanecPrava()}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("azam", "uli") ? "{$this->var->jazyk["zam_ulice"]}
                <input type=\"text\" name=\"zam_ulice\" value=\"\" />" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("azam", "cp") ? "{$this->var->jazyk["zam_cp"]}
                <input type=\"text\" name=\"zam_cp\" value=\"\" id=\"id_zam_cp\" />" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("azam", "psc") ? "{$this->var->jazyk["zam_psc"]}
                <input type=\"text\" name=\"zam_psc\" value=\"\" id=\"id_zam_psc\" />" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("azam", "mes") ? "{$this->var->jazyk["zam_mesto"]}
                <input type=\"text\" name=\"zam_mesto\" value=\"\" />" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("azam", "zem") ? "{$this->var->jazyk["zam_zeme"]}<br />
                {$this->var->main->Zeme("zam_zeme")}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("azam", "te1") ? "{$this->var->jazyk["zam_tel1"]}
                <input type=\"text\" name=\"zam_pred1\" value=\"\" />
                <input type=\"text\" name=\"zam_tel1\" value=\"\" />" : "")."<br />

                ".($this->var->main->PristupOdkaz("azam", "te2") ? "{$this->var->jazyk["zam_tel2"]}
                <input type=\"text\" name=\"zam_pred2\" value=\"\"  />
                <input type=\"text\" name=\"zam_tel2\" value=\"\" />" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("azam", "ema") ? "{$this->var->jazyk["zam_email"]}
                <input type=\"text\" name=\"zam_email\" id=\"id_zam_email\" value=\"\" onchange=\"UniverzalniKontrola('id_zam_email', '{$this->var->regemail}', '$chybnepole {$this->var->jazyk["zam_email"]}!');\" />" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("azam", "dna") ? "{$this->var->jazyk["zam_datnar"]}
                <input type=\"text\" name=\"zam_datnar\" value=\"$datum\" id=\"id_zam_datnar\" onchange=\"AjaxKontrola('id_dat_nar_den', 'genden', this.value);UniverzalniKontrola('id_zam_datnar', '{$this->var->regdatum}', '$chybnepole {$this->var->jazyk["zam_datnar"]}!');\" /><span id=\"id_dat_nar_den\"></span> {$this->var->datformat}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("azam", "jaz") ? "{$this->var->jazyk["zam_jazyk"]}<br />
                {$this->var->main->Jazyk("zam_jazyk")}" : "")."<br />

                ".($this->var->main->PristupOdkaz("azam", "vzd") ? "{$this->var->jazyk["zam_vzdelani"]}<br />
                {$this->var->zam->ZamestnanecVzdelani()}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("azam", "rid") ? "{$this->var->jazyk["zam_ridicak"]}<br />
                <input type=\"radio\" name=\"zam_existridicak\" value=\"true\" />{$this->var->jazyk["ano"]}
                <input type=\"radio\" name=\"zam_existridicak\" checked=\"checked\" value=\"false\" />{$this->var->jazyk["ne"]}<br />
                {$this->var->zam->ZamestnanecRidicak()}" : "")."<br />

                ".($this->var->main->PristupOdkaz("azam", "poh") ? "{$this->var->jazyk["zam_pohlavi"]}<br />
                <input type=\"radio\" name=\"zam_pohlavi\" checked=\"checked\" value=\"true\" />{$this->var->jazyk["muz"]}<br />
                <input type=\"radio\" name=\"zam_pohlavi\" value=\"false\" />{$this->var->jazyk["zena"]}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("azam", "dos") ? "{$this->var->jazyk["zam_datosloveni"]}
                <input type=\"text\" name=\"zam_datosloveni\" value=\"$datum\" id=\"id_zam_datosloveni\" onchange=\"AjaxKontrola('id_dat_oslov_den', 'genden', this.value);UniverzalniKontrola('id_zam_datosloveni', '{$this->var->regdatum}', '$chybnepole {$this->var->jazyk["zam_datosloveni"]}!');\" /><span id=\"id_dat_oslov_den\"></span> {$this->var->datformat}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("azam", "dzi") ? "{$this->var->jazyk["zam_datzivot"]}
                <input type=\"text\" name=\"zam_datzivot\" value=\"$datum\" id=\"id_zam_datzivot\" onchange=\"AjaxKontrola('id_dat_zivot_den', 'genden', this.value);UniverzalniKontrola('id_zam_datzivot', '{$this->var->regdatum}', '$chybnepole {$this->var->jazyk["zam_datzivot"]}!');\" /><span id=\"id_dat_zivot_den\"></span> {$this->var->datformat}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("azam", "dpo") ? "{$this->var->jazyk["zam_datpoh"]}
                <input type=\"text\" name=\"zam_datpoh\" value=\"$datum\" id=\"zam_datpoh\" onchange=\"AjaxKontrola('id_dat_poh_den', 'genden', this.value);UniverzalniKontrola('id_zam_datzivot', '{$this->var->regdatum}', '$chybnepole {$this->var->jazyk["zam_datpoh"]}!');\" /><span id=\"id_dat_poh_den\"></span> {$this->var->datformat}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("azam", "dza") ? "{$this->var->jazyk["zam_datzac"]}
                <input type=\"text\" name=\"zam_datzac\" value=\"$datum\" id=\"id_zam_datzac\" onchange=\"AjaxKontrola('id_dat_zac_den', 'genden', this.value);UniverzalniKontrola('id_zam_datzac', '{$this->var->regdatum}', '$chybnepole {$this->var->jazyk["zam_datzac"]}!');\" /><span id=\"id_dat_zac_den\"></span> {$this->var->datformat}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("azam", "dod") ? "{$this->var->jazyk["zam_datodmit"]}
                <input type=\"text\" name=\"zam_datodmit\" value=\"$datum\" id=\"id_zam_datodmit\" onchange=\"AjaxKontrola('id_dat_zac_den', 'genden', this.value);AjaxKontrola('id_dat_odmit_den', 'genden', this.value);UniverzalniKontrola('id_zam_datodmit', '{$this->var->regdatum}', '$chybnepole {$this->var->jazyk["zam_datodmit"]}!');\" /><span id=\"id_dat_odmit_den\"></span> {$this->var->datformat}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("azam", "dko") ? "{$this->var->jazyk["zam_konprac"]}
                <input type=\"text\" name=\"zam_konprac\" value=\"$datum\" id=\"id_zam_konprac\" onchange=\"AjaxKontrola('id_dat_kon_den', 'genden', this.value);UniverzalniKontrola('id_zam_konprac', '{$this->var->regdatum}', '$chybnepole {$this->var->jazyk["zam_konprac"]}!');\" /><span id=\"id_dat_kon_den\"></span> {$this->var->datformat}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("azam", "sta") ? "{$this->var->jazyk["zam_status"]}<br />
                {$this->var->main->Status("zam_status")}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("azam", "exi") ? "{$this->var->jazyk["zam_existfoto"]}<br />
                <input type=\"radio\" name=\"zam_existfoto\" value=\"true\" onclick=\"ZablokovaniElementu('fot', false);\" />{$this->var->jazyk["ano"]}
                <input type=\"radio\" name=\"zam_existfoto\" checked=\"checked\" value=\"false\" onclick=\"ZablokovaniElementu('fot', true);\" />{$this->var->jazyk["ne"]}<br />
                <input type=\"file\" id=\"fot\" name=\"fotka\" />(jpg, png) max 1MB" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("azam", "hob") ? "{$this->var->jazyk["zam_hobby"]}<br />
                {$this->var->zam->ZamestnanecHobby()}" : "")."<br />

                ".($this->var->main->PristupOdkaz("azam", "spo") ? "{$this->var->jazyk["zam_sport"]}<br />
                {$this->var->zam->ZamestnanecSport()}" : "")."<br />

                ".($this->var->main->PristupOdkaz("azam", "rod") ? "{$this->var->jazyk["zam_rodiste"]}<br />
                <input type=\"text\" name=\"zam_rodiste\" value=\"\" />" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("azam", "mze") ? "{$this->var->jazyk["zam_zemenaroz"]}<br />
                {$this->var->main->Zeme("zam_zemenaroz")}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("azam", "mja") ? "{$this->var->jazyk["zam_matjazyk"]}<br />
                {$this->var->zam->ZamestnanecRodnyJazyk()}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("azam", "jot") ? "{$this->var->jazyk["zam_jmotce"]}
                <input type=\"text\" name=\"zam_jmotce\" value=\"\" />" : "")."<br />

                ".($this->var->main->PristupOdkaz("azam", "pro") ? "{$this->var->jazyk["zam_prijotce"]}
                <input type=\"text\" name=\"zam_prijotce\" value=\"\" />" : "")."<br />

                ".($this->var->main->PristupOdkaz("azam", "pot") ? "{$this->var->jazyk["zam_povotce"]}
                <input type=\"text\" name=\"zam_povotce\" value=\"\" />" : "")."<br />

                ".($this->var->main->PristupOdkaz("azam", "jma") ? "{$this->var->jazyk["zam_jmmatky"]}
                <input type=\"text\" name=\"zam_jmmatky\" value=\"\" />" : "")."<br />

                ".($this->var->main->PristupOdkaz("azam", "prm") ? "{$this->var->jazyk["zam_prijmatky"]}
                <input type=\"text\" name=\"zam_prijmatky\" value=\"\" />" : "")."<br />

                ".($this->var->main->PristupOdkaz("azam", "pma") ? "{$this->var->jazyk["zam_povmatky"]}
                <input type=\"text\" name=\"zam_povmatky\" value=\"\" />" : "")."<br />

                ".($this->var->main->PristupOdkaz("azam", "pob") ? "{$this->var->jazyk["zam_pocbrat"]}
                <input type=\"text\" name=\"zam_pocbrat\" value=\"0\" id=\"pocbrat\" onchange=\"UniverzalniKontrola('pocbrat', '{$this->var->regcislo}', '$chybnepole {$this->var->jazyk["zam_pocbrat"]}!');SoucetSourozencu('pocbrat', 'pocsest', 'sumsour', '$chybnepole {$this->var->jazyk["zam_pocbrat"]}');\" />" : "")."<br />

                ".($this->var->main->PristupOdkaz("azam", "pos") ? "{$this->var->jazyk["zam_pocsest"]}
                <input type=\"text\" name=\"zam_pocsest\" value=\"0\" id=\"pocsest\" onchange=\"UniverzalniKontrola('pocsest', '{$this->var->regcislo}', '$chybnepole {$this->var->jazyk["zam_pocsest"]}!');SoucetSourozencu('pocbrat', 'pocsest', 'sumsour', '$chybnepole {$this->var->jazyk["zam_pocsest"]}');\" />" : "")."<br />

                ".($this->var->main->PristupOdkaz("azam", "sso") ? "{$this->var->jazyk["zam_sumsour"]}: <span id=\"sumsour\"></span>" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("azam", "mat") ? "{$this->var->jazyk["zam_mat"]}<br />
                <input type=\"radio\" name=\"zam_mat\" value=\"true\" />{$this->var->jazyk["ano"]}
                <input type=\"radio\" name=\"zam_mat\" checked=\"checked\" value=\"false\" />{$this->var->jazyk["ne"]}" : "")."<br />

                ".($this->var->main->PristupOdkaz("azam", "str") ? "{$this->var->jazyk["zam_stredni"]}<br />
                <input type=\"radio\" name=\"zam_vyuc\" value=\"true\" />{$this->var->jazyk["ano"]}
                <input type=\"radio\" name=\"zam_vyuc\" checked=\"checked\" value=\"false\" />{$this->var->jazyk["ne"]}" : "")."<br />
                ".($this->var->main->PristupOdkaz("azam", "tst") ? "{$this->var->jazyk["zam_typstredni"]}<input type=\"text\" name=\"zam_typstredni\" id=\"sttyp\" value=\"\" />" : "")."<br />

                ".($this->var->main->PristupOdkaz("azam", "str") ? "{$this->var->jazyk["od"]}<input type=\"text\" name=\"zam_stredniod\" value=\"$rok\" id=\"tod\" onchange=\"UniverzalniKontrola('stod', '{$this->var->regrok}', '$chybnepole {$this->var->jazyk["zam_stredni"]} {$this->var->jazyk["od"]}!');VypocetPocetRoku('stod', 'stdo', 'stpocrok', '$chybnepole {$this->var->jazyk["od"]}');\" />YYYY
                {$this->var->jazyk["do"]}<input type=\"text\" name=\"zam_strednido\" value=\"$rok\" id=\"stdo\" onchange=\"UniverzalniKontrola('stdo', '{$this->var->regrok}', '$chybnepole {$this->var->jazyk["zam_stredni"]} {$this->var->jazyk["do"]}!');VypocetPocetRoku('stod', 'stdo', 'stpocrok', '$chybnepole {$this->var->jazyk["do"]}');\" />YYYY<br />
                <span id=\"stpocrok\"></span> {$this->var->jazyk["roku"]}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("azam", "vys") ? "{$this->var->jazyk["zam_vyska"]}
                <input type=\"radio\" name=\"zam_vyska\" value=\"true\" />{$this->var->jazyk["ano"]}
                <input type=\"radio\" name=\"zam_vyska\" checked=\"checked\" value=\"false\" />{$this->var->jazyk["ne"]}" : "")."<br />
                ".($this->var->main->PristupOdkaz("azam", "tvy") ? "{$this->var->jazyk["zam_typvyska"]}<input type=\"text\" name=\"zam_typvyska\" id=\"vytyp\" value=\"\" />" : "")."<br />

                ".($this->var->main->PristupOdkaz("azam", "vys") ? "{$this->var->jazyk["od"]}<input type=\"text\" name=\"zam_vyskaod\" value=\"$rok\" id=\"vyod\" onchange=\"UniverzalniKontrola('vyod', '{$this->var->regrok}', '$chybnepole {$this->var->jazyk["zam_vyska"]} {$this->var->jazyk["od"]}!');VypocetPocetRoku('vyod', 'vydo', 'vypocrok', '$chybnepole {$this->var->jazyk["od"]}');\" />YYYY
                {$this->var->jazyk["do"]}<input type=\"text\" name=\"zam_vyskado\" value=\"$rok\" id=\"vydo\" onchange=\"UniverzalniKontrola('vydo', '{$this->var->regrok}', '$chybnepole {$this->var->jazyk["zam_vyska"]} {$this->var->jazyk["od"]}!');VypocetPocetRoku('vyod', 'vydo', 'vypocrok', '$chybnepole {$this->var->jazyk["od"]}');\" />YYYY<br />
                <span id=\"vypocrok\"></span> {$this->var->jazyk["roku"]}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("azam", "obo") ? "{$this->var->jazyk["zam_obor"]}<br />
                {$this->var->zam->ZamestnanecVyska()}" : "")."<br />

                ".($this->var->main->PristupOdkaz("azam", "tyt") ? "{$this->var->jazyk["zam_tytul"]}<br />
                <input type=\"radio\" name=\"zam_tytul\" value=\"true\" />{$this->var->jazyk["ano"]}
                <input type=\"radio\" name=\"zam_tytul\" checked=\"checked\" value=\"false\" />{$this->var->jazyk["ne"]}" : "")."<br /><br />

Velke policka - cely zadavaci formular udelejte v peknem designu, policka
nemusi byt pod sebou ale smysluplny formular.<br />

                <input type=\"submit\" name=\"tlacitko\" value=\"{$this->var->jazyk["add"]}\" />
              </fieldset>
            </form>";
?>

