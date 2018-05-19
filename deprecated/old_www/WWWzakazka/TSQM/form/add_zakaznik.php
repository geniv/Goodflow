<?php
  $chybnepole = $this->var->jazyk["chybapole"]; //dodělat kontrolu, komentáře do html
  return
  "
        <p>
            <br />
            {$this->var->jazyk["add_zakaznik"]}
            </p>
            <form action=\"\" method=\"post\" enctype=\"multipart/form-data\">
              <fieldset>
                ".($this->var->main->PristupOdkaz("azak", "naz") ? "{$this->var->jazyk["zak_nazev"]}
                <input type=\"text\" name=\"zak_nazev\" value=\"\" />" : "")."<br /><br />
{$this->var->jazyk["zak_kontakt"]}:<br />
                ".($this->var->main->PristupOdkaz("azak", "jme") ? "{$this->var->jazyk["zak_jmeno"]}
                <input type=\"text\" name=\"zak_jmeno\" value=\"\" />" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("azak", "pri") ? "{$this->var->jazyk["zak_prijmeni"]}
                <input type=\"text\" name=\"zak_prijmeni\" value=\"\" />" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("azak", "uli") ? "{$this->var->jazyk["zak_ulice"]}
                <input type=\"text\" name=\"zak_ulice\" value=\"\" />" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("azak", "cp") ? "{$this->var->jazyk["zak_cp"]}
                <input type=\"text\" name=\"zak_cp\" value=\"\" id=\"id_zak_cp\" />" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("azak", "psc") ? "{$this->var->jazyk["zak_psc"]}
                <input type=\"text\" name=\"zak_psc\" value=\"\" id=\"id_zak_psc\" />" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("azak", "mes") ? "{$this->var->jazyk["zak_mesto"]}
                <input type=\"text\" name=\"zak_mesto\" value=\"\" />" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("azak", "zem") ? "{$this->var->jazyk["zak_zeme"]}
                {$this->var->main->Zeme("zak_zeme")}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("azak", "te1") ? "{$this->var->jazyk["zak_tel"]}
                <input type=\"text\" name=\"zak_pred\" value=\"\" />
                <input type=\"text\" name=\"zak_tel\" value=\"\" />" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("azak", "te2") ? "{$this->var->jazyk["zak_tel1"]}
                <input type=\"text\" name=\"zak_pred1\" value=\"\" />
                <input type=\"text\" name=\"zak_tel1\" value=\"\" />" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("azak", "ema") ? "{$this->var->jazyk["zak_email"]}
                <input type=\"text\" name=\"zak_email\" value=\"\" id=\"id_zak_email\" onchange=\"UniverzalniKontrola('id_zak_email', '{$this->var->regemail}', '$chybnepole {$this->var->jazyk["zak_email"]}!');\" />" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("azak", "jaz") ? "{$this->var->jazyk["zak_jazyk"]}<br />
                {$this->var->main->Jazyk("zak_jazyk")}" : "")."<br />

                ".($this->var->main->PristupOdkaz("azak", "poh") ? "{$this->var->jazyk["zak_pohlavi"]}<br />
                <input type=\"radio\" name=\"zak_pohlavi\" checked=\"checked\" value=\"true\" />{$this->var->jazyk["muz"]}<br />
                <input type=\"radio\" name=\"zak_pohlavi\" value=\"false\" />{$this->var->jazyk["zena"]}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("azak", "dos") ? "{$this->var->jazyk["zak_datumosloveni"]}
                <input type=\"text\" name=\"zak_datumosloveni\" value=\"$datum\" id=\"id_zak_datumosloveni\" onchange=\"AjaxKontrola('id_dat_osl_den', 'genden', this.value);UniverzalniKontrola('id_zak_datumosloveni', '{$this->var->regdatum}', '$chybnepole {$this->var->jazyk["zak_datumosloveni"]}!');\" /><span id=\"id_dat_osl_den\"></span> {$this->var->datformat}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("azak", "dka") ? "{$this->var->jazyk["zak_datumkalkulace"]}
                <input type=\"text\" name=\"zak_datumkalkulace\" value=\"$datum\" id=\"id_zak_datumkalkulace\" onchange=\"AjaxKontrola('id_dat_kal_den', 'genden', this.value);UniverzalniKontrola('id_zak_datumkalkulace', '{$this->var->regdatum}', '$chybnepole {$this->var->jazyk["zak_datumkalkulace"]}!');\" /><span id=\"id_dat_kal_den\"></span> {$this->var->datformat}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("azak", "dpo") ? "{$this->var->jazyk["zak_datumpohovoru"]}
                <input type=\"text\" name=\"zak_datumpohovoru\" value=\"$datum\" id=\"id_zak_datumpohovoru\" onchange=\"AjaxKontrola('id_dat_poh_den', 'genden', this.value);UniverzalniKontrola('id_zak_datumpohovoru', '{$this->var->regdatum}', '$chybnepole {$this->var->jazyk["zak_datumpohovoru"]}!');\" /><span id=\"id_dat_poh_den\"></span> {$this->var->datformat}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("azak", "dza") ? "{$this->var->jazyk["zak_datumzacatek"]}
                <input type=\"text\" name=\"zak_datumzacatek\" value=\"$datum\" id=\"id_zak_datumzacatek\" onchange=\"AjaxKontrola('id_dat_zac_den', 'genden', this.value);UniverzalniKontrola('id_zak_datumzacatek', '{$this->var->regdatum}', '$chybnepole {$this->var->jazyk["zak_datumzacatek"]}!');\" /><span id=\"id_dat_zac_den\"></span> {$this->var->datformat}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("azak", "dod") ? "{$this->var->jazyk["zak_datumodmitnuti"]}
                <input type=\"text\" name=\"zak_datumodmitnuti\" value=\"$datum\" id=\"id_zak_datumodmitnuti\" onchange=\"AjaxKontrola('id_dat_odm_den', 'genden', this.value);UniverzalniKontrola('id_zak_datumodmitnuti', '{$this->var->regdatum}', '$chybnepole {$this->var->jazyk["zak_datumodmitnuti"]}!');\" /><span id=\"id_dat_odm_den\"></span> {$this->var->datformat}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("azak", "dko") ? "{$this->var->jazyk["zak_datumkonec"]}
                <input type=\"text\" name=\"zak_datumkonec\" value=\"$datum\" id=\"id_zak_datumkonec\" onchange=\"AjaxKontrola('id_dat_kon_den', 'genden', this.value);UniverzalniKontrola('id_zak_datumkonec', '{$this->var->regdatum}', '$chybnepole {$this->var->jazyk["zak_datumkonec"]}!');\" /><span id=\"id_dat_kon_den\"></span> {$this->var->datformat}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("azak", "sta") ? "{$this->var->jazyk["zak_status"]}
                {$this->var->main->Status("zak_status")}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("azak", "csp") ? "{$this->var->jazyk["zak_celkovaspokojenost"]}
                {$this->var->main->Procenta("zak_celkovaspokojenost")}%" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("azak", "kom") ? "{$this->var->jazyk["zak_komentar"]}
                <textarea name=\"zak_komentar\" rows=\"20\" cols=\"100\"></textarea>" : "")."<br /><br />
                
                ".($this->var->main->PristupOdkaz("azak", "exi") ? "{$this->var->jazyk["zak_existfoto"]}<br />
                <input type=\"radio\" name=\"zak_existfoto\" value=\"true\" onclick=\"ZablokovaniElementu('fot', false);\" />{$this->var->jazyk["ano"]}
                <input type=\"radio\" name=\"zak_existfoto\" checked=\"checked\" value=\"false\" onclick=\"ZablokovaniElementu('fot', true);\" />{$this->var->jazyk["ne"]}<br />
                <input type=\"file\" id=\"fot\" name=\"fotka\" />(jpg, png) max 1MB" : "")."<br /><br />

                <input type=\"submit\" name=\"tlacitko\" value=\"{$this->var->jazyk["add"]}\" />
              </fieldset>
            </form>
  ";
?>
