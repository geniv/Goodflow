<?php
  $chybnepole = $this->var->jazyk["chybapole"]; //dodělat kontrolu!, komentáže do html
  return
  "
        <p>
            <br />
            {$this->var->jazyk["edit_zakaznik"]}
            </p>
            <form action=\"\" method=\"post\" enctype=\"multipart/form-data\">
              <fieldset>
               ".($this->var->main->PristupOdkaz("ezak", "naz") ? " {$this->var->jazyk["zak_nazev"]}
                <input type=\"text\" name=\"zak_nazev\" value=\"$data->nazev\" />" : "")."<br /><br />
{$this->var->jazyk["zak_kontakt"]}:<br />
                ".($this->var->main->PristupOdkaz("ezak", "jme") ? "{$this->var->jazyk["zak_jmeno"]}
                <input type=\"text\" name=\"zak_jmeno\" value=\"$data->jmeno\" />" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ezak", "pri") ? "{$this->var->jazyk["zak_prijmeni"]}
                <input type=\"text\" name=\"zak_prijmeni\" value=\"$data->prijmeni\" />" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ezak", "uli") ? "{$this->var->jazyk["zak_ulice"]}
                <input type=\"text\" name=\"zak_ulice\" value=\"$data->ulice\" />" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ezak", "cp") ? "{$this->var->jazyk["zak_cp"]}
                <input type=\"text\" name=\"zak_cp\" value=\"$data->cp\" />" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ezak", "psc") ? "{$this->var->jazyk["zak_psc"]}
                <input type=\"text\" name=\"zak_psc\" value=\"$data->psc\" />" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ezak", "mes") ? "{$this->var->jazyk["zak_mesto"]}
                <input type=\"text\" name=\"zak_mesto\" value=\"$data->mesto\" />" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ezak", "zem") ? "{$this->var->jazyk["zak_zeme"]}
                {$this->var->main->OznacenyEditZeme($data->idzeme, "zak_zeme")}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ezak", "te1") ? "{$this->var->jazyk["zak_tel"]}
                <input type=\"text\" name=\"zak_pred\" value=\"$data->predvolba\" />
                <input type=\"text\" name=\"zak_tel\" value=\"$data->telefon\" />" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ezak", "te2") ? "{$this->var->jazyk["zak_tel1"]}
                <input type=\"text\" name=\"zak_pred1\" value=\"$data->predvolba1\" />
                <input type=\"text\" name=\"zak_tel1\" value=\"$data->telefon1\" />" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ezak", "ema") ? "{$this->var->jazyk["zak_email"]}
                <input type=\"text\" name=\"zak_email\" value=\"$data->email\" id=\"id_zak_email\" onchange=\"UniverzalniKontrola('id_zak_email', '{$this->var->regemail}', '$chybnepole {$this->var->jazyk["zak_email"]}!');\" />" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ezak", "jaz") ? "{$this->var->jazyk["zak_jazyk"]}<br />
                {$this->var->main->OznacenyEditJazyk($data->id, "zakaznik", "zak_jazyk")}" : "")."<br />

                ".($this->var->main->PristupOdkaz("ezak", "poh") ? "{$this->var->jazyk["zak_pohlavi"]}<br />
                {$this->var->zak->ZakaznikOznacenyEditPohlavi($data->pohlavi)}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ezak", "dos") ? "{$this->var->jazyk["zak_datumosloveni"]}
                <input type=\"text\" name=\"zak_datumosloveni\" value=\"".($data->datumosloveni != "00.00.0000" ? $data->datumosloveni : "")."\" id=\"id_zak_datumosloveni\" onchange=\"AjaxKontrola('id_dat_osl_den', 'genden', this.value);UniverzalniKontrola('id_zak_datumosloveni', '{$this->var->regdatum}', '$chybnepole {$this->var->jazyk["zak_datumosloveni"]}!');\" /><span id=\"id_dat_osl_den\">".($data->datumosloveni != "00.00.0000" ? $this->var->jazyk["den{$data->dendatumosloveni}"] : "")."</span> {$this->var->datformat}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ezak", "dka") ? "{$this->var->jazyk["zak_datumkalkulace"]}
                <input type=\"text\" name=\"zak_datumkalkulace\" value=\"".($data->datumkalkulace != "00.00.0000" ? $data->datumkalkulace : "")."\" id=\"id_zak_datumkalkulace\" onchange=\"AjaxKontrola('id_dat_kal_den', 'genden', this.value);UniverzalniKontrola('id_zak_datumkalkulace', '{$this->var->regdatum}', '$chybnepole {$this->var->jazyk["zak_datumkalkulace"]}!');\" /><span id=\"id_kal_osl_den\">".($data->datumkalkulace != "00.00.0000" ? $this->var->jazyk["den{$data->dendatumkalkulace}"] : "")."</span> {$this->var->datformat}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ezak", "dpo") ? "{$this->var->jazyk["zak_datumpohovoru"]}
                <input type=\"text\" name=\"zak_datumpohovoru\" value=\"".($data->datumpohovoru != "00.00.0000" ? $data->datumpohovoru : "")."\" id=\"id_zak_datumpohovoru\" onchange=\"AjaxKontrola('id_dat_poh_den', 'genden', this.value);UniverzalniKontrola('id_zak_datumpohovoru', '{$this->var->regdatum}', '$chybnepole {$this->var->jazyk["zak_datumpohovoru"]}!');\" /><span id=\"id_dat_poh_den\">".($data->datumpohovoru != "00.00.0000" ? $this->var->jazyk["den{$data->dendatumpohovoru}"] : "")."</span> {$this->var->datformat}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ezak", "dza") ? "{$this->var->jazyk["zak_datumzacatek"]}
                <input type=\"text\" name=\"zak_datumzacatek\" value=\"".($data->datumzacatek != "00.00.0000" ? $data->datumzacatek : "")."\" id=\"id_zak_datumzacatek\" onchange=\"AjaxKontrola('id_dat_zac_den', 'genden', this.value);UniverzalniKontrola('id_zak_datumzacatek', '{$this->var->regdatum}', '$chybnepole {$this->var->jazyk["zak_datumzacatek"]}!');\" /><span id=\"id_dat_zac_den\">".($data->datumzacatek != "00.00.0000" ? $this->var->jazyk["den{$data->dendatumzacatek}"] : "")."</span> {$this->var->datformat}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ezak", "dod") ? "{$this->var->jazyk["zak_datumodmitnuti"]}
                <input type=\"text\" name=\"zak_datumodmitnuti\" value=\"".($data->datumodmitnuti != "00.00.0000" ? $data->datumodmitnuti : "")."\" id=\"id_zak_datumodmitnuti\" onchange=\"AjaxKontrola('id_dat_odm_den', 'genden', this.value);UniverzalniKontrola('id_zak_datumodmitnuti', '{$this->var->regdatum}', '$chybnepole {$this->var->jazyk["zak_datumodmitnuti"]}!');\" /><span id=\"id_odm_osl_den\">".($data->datumodmitnuti != "00.00.0000" ? $this->var->jazyk["den{$data->dendatumodmitnuti}"] : "")."</span> {$this->var->datformat}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ezak", "dko") ? "{$this->var->jazyk["zak_datumkonec"]}
                <input type=\"text\" name=\"zak_datumkonec\" value=\"".($data->datumkonec != "00.00.0000" ? $data->datumkonec : "")."\" id=\"id_zak_datumkonec\" onchange=\"AjaxKontrola('id_dat_kon_den', 'genden', this.value);UniverzalniKontrola('id_zak_datumkonec', '{$this->var->regdatum}', '$chybnepole {$this->var->jazyk["zak_datumkonec"]}!');\" /><span id=\"id_dat_kon_den\">".($data->datumkonec != "00.00.0000" ? $this->var->jazyk["den{$data->dendatumkonec}"] : "")."</span> {$this->var->datformat}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ezak", "sta") ? "{$this->var->jazyk["zak_status"]}
                {$this->var->main->OznacenyEditStatus($data->idstatus, "zak_status")}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ezak", "csp") ? "{$this->var->jazyk["zak_celkovaspokojenost"]}
                {$this->var->main->OzancenyEditProcenta($data->celkovaspokojenost, "zak_celkovaspokojenost")}%" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ezak", "kom") ? "{$this->var->jazyk["zak_komentar"]}
                <textarea name=\"zak_komentar\" rows=\"20\" cols=\"100\">$data->komentar</textarea>" : "")."<br /><br />
                
                ".($this->var->main->PristupOdkaz("ezak", "exi") ? "{$this->var->jazyk["zak_existfoto"]}<br />
                {$this->var->zak->ZakaznikOznacenyEditExistFoto($data->id)}<br />
                <a href=\"foto.php?sekce=zakaznicifull&amp;id={$data->id}\" title=\"\"><img src=\"foto.php?sekce=zakaznicimini&amp;id={$data->id}\" alt=\"\" /></a><br />
                <input type=\"file\" id=\"fot\" name=\"fotka\" />(jpg, png) max 1MB" : "")."<br /><br />

                <input type=\"submit\" name=\"tlacitko\" value=\"{$this->var->jazyk["edit"]}\" />
              </fieldset>
            </form>
  ";
?>
