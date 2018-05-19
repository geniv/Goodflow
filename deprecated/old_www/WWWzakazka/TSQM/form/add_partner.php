<?php
  $chybnepole = $this->var->jazyk["chybapole"]; //dodělat kontrolu, komentáře do html
  return
  "
        <p>
            <br />
            {$this->var->jazyk["add_partner"]}
            </p>
            <form action=\"\" method=\"post\" enctype=\"multipart/form-data\">
              <fieldset>
                ".($this->var->main->PristupOdkaz("apar", "naz") ? "{$this->var->jazyk["par_nazev"]}
                <input type=\"text\" name=\"par_nazev\" value=\"\" />" : "")."<br /><br />
{$this->var->jazyk["par_kontakt"]}:<br />
                ".($this->var->main->PristupOdkaz("apar", "jme") ? "{$this->var->jazyk["par_jmeno"]}
                <input type=\"text\" name=\"par_jmeno\" value=\"\" />" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("apar", "pri") ? "{$this->var->jazyk["par_prijmeni"]}
                <input type=\"text\" name=\"par_prijmeni\" value=\"\" />" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("apar", "uli") ? "{$this->var->jazyk["par_ulice"]}
                <input type=\"text\" name=\"par_ulice\" value=\"\" />" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("apar", "cp") ? "{$this->var->jazyk["par_cp"]}
                <input type=\"text\" name=\"par_cp\" value=\"\" id=\"id_par_cp\" />" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("apar", "psc") ? "{$this->var->jazyk["par_psc"]}
                <input type=\"text\" name=\"par_psc\" value=\"\" id=\"id_par_psc\" />" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("apar", "mes") ? "{$this->var->jazyk["par_mesto"]}
                <input type=\"text\" name=\"par_mesto\" value=\"\" />" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("apar", "zem") ? "{$this->var->jazyk["par_zeme"]}
                {$this->var->main->Zeme("par_zeme")}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("apar", "te1") ? "{$this->var->jazyk["par_tel"]}
                <input type=\"text\" name=\"par_pred\" value=\"\" />
                <input type=\"text\" name=\"par_tel\" value=\"\" />" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("apar", "te2") ? "{$this->var->jazyk["par_tel1"]}
                <input type=\"text\" name=\"par_pred1\" value=\"\" />
                <input type=\"text\" name=\"par_tel1\" value=\"\" />" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("apar", "ema") ? "{$this->var->jazyk["par_email"]}
                <input type=\"text\" name=\"par_email\" value=\"\" id=\"id_par_email\" onchange=\"UniverzalniKontrola('id_par_email', '{$this->var->regemail}', '$chybnepole {$this->var->jazyk["par_email"]}!');\" />" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("apar", "jaz") ? "{$this->var->jazyk["par_jazyk"]}<br />
                {$this->var->main->Jazyk("par_jazyk")}" : "")."<br />

                ".($this->var->main->PristupOdkaz("apar", "poh") ? "{$this->var->jazyk["par_pohlavi"]}<br />
                <input type=\"radio\" name=\"par_pohlavi\" checked=\"checked\" value=\"true\" />{$this->var->jazyk["muz"]}<br />
                <input type=\"radio\" name=\"par_pohlavi\" value=\"false\" />{$this->var->jazyk["zena"]}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("apar", "dos") ? "{$this->var->jazyk["par_datumosloveni"]}
                <input type=\"text\" name=\"par_datumosloveni\" value=\"$datum\" id=\"id_par_datumosloveni\" onchange=\"AjaxKontrola('id_dat_osl_den', 'genden', this.value);UniverzalniKontrola('id_par_datumosloveni', '{$this->var->regdatum}', '$chybnepole {$this->var->jazyk["par_datumosloveni"]}!');\" /><span id=\"id_dat_osl_den\"></span> {$this->var->datformat}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("apar", "dka") ? "{$this->var->jazyk["par_datumkalkulace"]}
                <input type=\"text\" name=\"par_datumkalkulace\" value=\"$datum\" id=\"id_par_datumkalkulace\" onchange=\"AjaxKontrola('id_dat_kal_den', 'genden', this.value);UniverzalniKontrola('id_par_datumkalkulace', '{$this->var->regdatum}', '$chybnepole {$this->var->jazyk["par_datumkalkulace"]}!');\" /><span id=\"id_dat_kal_den\"></span> {$this->var->datformat}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("apar", "dpo") ? "{$this->var->jazyk["par_datumpohovoru"]}
                <input type=\"text\" name=\"par_datumpohovoru\" value=\"$datum\" id=\"id_par_datumpohovoru\" onchange=\"AjaxKontrola('id_dat_poh_den', 'genden', this.value);UniverzalniKontrola('id_par_datumpohovoru', '{$this->var->regdatum}', '$chybnepole {$this->var->jazyk["par_datumpohovoru"]}!');\" /><span id=\"id_dat_poh_den\"></span> {$this->var->datformat}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("apar", "dza") ? "{$this->var->jazyk["par_datumzacatek"]}
                <input type=\"text\" name=\"par_datumzacatek\" value=\"$datum\" id=\"id_par_datumzacatek\" onchange=\"AjaxKontrola('id_dat_zac_den', 'genden', this.value);UniverzalniKontrola('id_par_datumzacatek', '{$this->var->regdatum}', '$chybnepole {$this->var->jazyk["par_datumzacatek"]}!');\" /><span id=\"id_dat_zac_den\"></span> {$this->var->datformat}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("apar", "dod") ? "{$this->var->jazyk["par_datumodmitnuti"]}
                <input type=\"text\" name=\"par_datumodmitnuti\" value=\"$datum\" id=\"id_par_datumodmitnuti\" onchange=\"AjaxKontrola('id_dat_odm_den', 'genden', this.value);UniverzalniKontrola('id_par_datumodmitnuti', '{$this->var->regdatum}', '$chybnepole {$this->var->jazyk["par_datumodmitnuti"]}!');\" /><span id=\"id_dat_odm_den\"></span> {$this->var->datformat}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("apar", "dko") ? "{$this->var->jazyk["par_datumkonec"]}
                <input type=\"text\" name=\"par_datumkonec\" value=\"$datum\" id=\"id_par_datumkonec\" onchange=\"AjaxKontrola('id_dat_kon_den', 'genden', this.value);UniverzalniKontrola('id_par_datumkonec', '{$this->var->regdatum}', '$chybnepole {$this->var->jazyk["par_datumkonec"]}!');\" /><span id=\"id_dat_kon_den\"></span> {$this->var->datformat}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("apar", "sta") ? "{$this->var->jazyk["par_status"]}
                {$this->var->main->Status("par_status")}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("apar", "csp") ? "{$this->var->jazyk["par_celkovaspokojenost"]}
                {$this->var->main->Procenta("par_celkovaspokojenost")}%" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("apar", "kom") ? "{$this->var->jazyk["par_komentar"]}
                <textarea name=\"par_komentar\" rows=\"20\" cols=\"100\"></textarea>" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("apar", "exi") ? "{$this->var->jazyk["par_existfoto"]}<br />
                <input type=\"radio\" name=\"par_existfoto\" value=\"true\" onclick=\"ZablokovaniElementu('fot', false);\" />{$this->var->jazyk["ano"]}
                <input type=\"radio\" name=\"par_existfoto\" checked=\"checked\" value=\"false\" onclick=\"ZablokovaniElementu('fot', true);\" />{$this->var->jazyk["ne"]}<br />
                <input type=\"file\" id=\"fot\" name=\"fotka\" />(jpg, png) max 1MB" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("apar", "pra") ? "{$this->var->jazyk["par_pratelsky"]}
                {$this->var->main->Procenta("par_pratelsky")}%" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("apar", "pre") ? "{$this->var->jazyk["par_presnost"]}
                {$this->var->main->Procenta("par_presnost")}%" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("apar", "kpt") ? "{$this->var->jazyk["par_kompetence"]}
                {$this->var->main->Procenta("par_kompetence")}%" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("apar", "kmk") ? "{$this->var->jazyk["par_komunikace"]}
                {$this->var->main->Procenta("par_komunikace")}%" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("apar", "vys") ? "{$this->var->jazyk["par_vystupovani"]}
                {$this->var->main->Procenta("par_vystupovani")}%" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("apar", "ido") ? "{$this->var->jazyk["par_infodostatek"]}<br />
                <input type=\"radio\" name=\"par_infodostatek\" value=\"true\" />{$this->var->jazyk["ano"]}<br />
                <input type=\"radio\" name=\"par_infodostatek\" checked=\"checked\" value=\"false\" />{$this->var->jazyk["ne"]}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("apar", "isr") ? "{$this->var->jazyk["par_infosruzumitelne"]}
                {$this->var->main->Procenta("par_infosruzumitelne")}%" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("apar", "ius") ? "{$this->var->jazyk["par_infoustnisrozumitelne"]}
                {$this->var->main->Procenta("par_infoustnisrozumitelne")}%" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("apar", "iho") ? "{$this->var->jazyk["par_infohodnoceni"]}
                {$this->var->main->Procenta("par_infohodnoceni")}%" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("apar", "tka") ? "{$this->var->jazyk["par_terminkalkulace"]}<br />
                <input type=\"radio\" name=\"par_terminkalkulace\" value=\"true\" />{$this->var->jazyk["ano"]}<br />
                <input type=\"radio\" name=\"par_terminkalkulace\" checked=\"checked\" value=\"false\" />{$this->var->jazyk["ne"]}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("apar", "tdo") ? "{$this->var->jazyk["par_termindodani"]}<br />
                <input type=\"radio\" name=\"par_termindodani\" value=\"true\" />{$this->var->jazyk["ano"]}<br />
                <input type=\"radio\" name=\"par_termindodani\" checked=\"checked\" value=\"false\" />{$this->var->jazyk["ne"]}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("apar", "roz") ? "{$this->var->jazyk["par_rozpocet"]}<br />
                <input type=\"radio\" name=\"par_rozpocet\" value=\"true\" />{$this->var->jazyk["ano"]}<br />
                <input type=\"radio\" name=\"par_rozpocet\" checked=\"checked\" value=\"false\" />{$this->var->jazyk["ne"]}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("apar", "odc") ? "{$this->var->jazyk["par_odchylka"]}
                <input type=\"text\" name=\"par_odchylka\" value=\"\" />%" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("apar", "spo") ? "{$this->var->jazyk["par_spokojenost"]}
                {$this->var->main->Procenta("par_spokojenost")}%" : "")."<br /><br />

                <input type=\"submit\" name=\"tlacitko\" value=\"{$this->var->jazyk["add"]}\" />
              </fieldset>
            </form>
  ";
?>
