<?php
  $chybnepole = $this->var->jazyk["chybapole"]; //dodělat kontrolu!, komentáže do html
  return
  "
        <p>
            <br />
            {$this->var->jazyk["edit_partner"]}
            </p>
            <form action=\"\" method=\"post\" enctype=\"multipart/form-data\">
              <fieldset>
               ".($this->var->main->PristupOdkaz("epar", "naz") ? " {$this->var->jazyk["par_nazev"]}
                <input type=\"text\" name=\"par_nazev\" value=\"$data->nazev\" />" : "")."<br /><br />
{$this->var->jazyk["par_kontakt"]}:<br />
                ".($this->var->main->PristupOdkaz("epar", "jme") ? "{$this->var->jazyk["par_jmeno"]}
                <input type=\"text\" name=\"par_jmeno\" value=\"$data->jmeno\" />" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("epar", "pri") ? "{$this->var->jazyk["par_prijmeni"]}
                <input type=\"text\" name=\"par_prijmeni\" value=\"$data->prijmeni\" />" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("epar", "uli") ? "{$this->var->jazyk["par_ulice"]}
                <input type=\"text\" name=\"par_ulice\" value=\"$data->ulice\" />" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("epar", "cp") ? "{$this->var->jazyk["par_cp"]}
                <input type=\"text\" name=\"par_cp\" value=\"$data->cp\" />" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("epar", "psc") ? "{$this->var->jazyk["par_psc"]}
                <input type=\"text\" name=\"par_psc\" value=\"$data->psc\" />" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("epar", "mes") ? "{$this->var->jazyk["par_mesto"]}
                <input type=\"text\" name=\"par_mesto\" value=\"$data->mesto\" />" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("epar", "zem") ? "{$this->var->jazyk["par_zeme"]}
                {$this->var->main->OznacenyEditZeme($data->idzeme, "par_zeme")}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("epar", "te1") ? "{$this->var->jazyk["par_tel"]}
                <input type=\"text\" name=\"par_pred\" value=\"$data->predvolba\" />
                <input type=\"text\" name=\"par_tel\" value=\"$data->telefon\" />" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("epar", "te2") ? "{$this->var->jazyk["par_tel1"]}
                <input type=\"text\" name=\"par_pred1\" value=\"$data->predvolba1\" />
                <input type=\"text\" name=\"par_tel1\" value=\"$data->telefon1\" />" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("epar", "ema") ? "{$this->var->jazyk["par_email"]}
                <input type=\"text\" name=\"par_email\" value=\"$data->email\" id=\"id_par_email\" onchange=\"UniverzalniKontrola('id_par_email', '{$this->var->regemail}', '$chybnepole {$this->var->jazyk["par_email"]}!');\" />" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("epar", "jaz") ? "{$this->var->jazyk["par_jazyk"]}<br />
                {$this->var->main->OznacenyEditJazyk($data->id, "partner", "par_jazyk")}" : "")."<br />

                ".($this->var->main->PristupOdkaz("epar", "poh") ? "{$this->var->jazyk["par_pohlavi"]}<br />
                {$this->var->par->PartnerOznacenyEditPohlavi($data->pohlavi)}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("epar", "dos") ? "{$this->var->jazyk["par_datumosloveni"]}
                <input type=\"text\" name=\"par_datumosloveni\" value=\"".($data->datumosloveni != "00.00.0000" ? $data->datumosloveni : "")."\" id=\"id_par_datumosloveni\" onchange=\"AjaxKontrola('id_dat_osl_den', 'genden', this.value);UniverzalniKontrola('id_par_datumosloveni', '{$this->var->regdatum}', '$chybnepole {$this->var->jazyk["par_datumosloveni"]}!');\" /><span id=\"id_dat_osl_den\">".($data->datumosloveni != "00.00.0000" ? $this->var->jazyk["den{$data->dendatumosloveni}"] : "")."</span> {$this->var->datformat}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("epar", "dka") ? "{$this->var->jazyk["par_datumkalkulace"]}
                <input type=\"text\" name=\"par_datumkalkulace\" value=\"".($data->datumkalkulace != "00.00.0000" ? $data->datumkalkulace : "")."\" id=\"id_par_datumkalkulace\" onchange=\"AjaxKontrola('id_dat_kal_den', 'genden', this.value);UniverzalniKontrola('id_par_datumkalkulace', '{$this->var->regdatum}', '$chybnepole {$this->var->jazyk["par_datumkalkulace"]}!');\" /><span id=\"id_kal_osl_den\">".($data->datumkalkulace != "00.00.0000" ? $this->var->jazyk["den{$data->dendatumkalkulace}"] : "")."</span> {$this->var->datformat}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("epar", "dpo") ? "{$this->var->jazyk["par_datumpohovoru"]}
                <input type=\"text\" name=\"par_datumpohovoru\" value=\"".($data->datumpohovoru != "00.00.0000" ? $data->datumpohovoru : "")."\" id=\"id_par_datumpohovoru\" onchange=\"AjaxKontrola('id_dat_poh_den', 'genden', this.value);UniverzalniKontrola('id_par_datumpohovoru', '{$this->var->regdatum}', '$chybnepole {$this->var->jazyk["par_datumpohovoru"]}!');\" /><span id=\"id_dat_poh_den\">".($data->datumpohovoru != "00.00.0000" ? $this->var->jazyk["den{$data->dendatumpohovoru}"] : "")."</span> {$this->var->datformat}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("epar", "dza") ? "{$this->var->jazyk["par_datumzacatek"]}
                <input type=\"text\" name=\"par_datumzacatek\" value=\"".($data->datumzacatek != "00.00.0000" ? $data->datumzacatek : "")."\" id=\"id_par_datumzacatek\" onchange=\"AjaxKontrola('id_dat_zac_den', 'genden', this.value);UniverzalniKontrola('id_par_datumzacatek', '{$this->var->regdatum}', '$chybnepole {$this->var->jazyk["par_datumzacatek"]}!');\" /><span id=\"id_dat_zac_den\">".($data->datumzacatek != "00.00.0000" ? $this->var->jazyk["den{$data->dendatumzacatek}"] : "")."</span> {$this->var->datformat}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("epar", "dod") ? "{$this->var->jazyk["par_datumodmitnuti"]}
                <input type=\"text\" name=\"par_datumodmitnuti\" value=\"".($data->datumodmitnuti != "00.00.0000" ? $data->datumodmitnuti : "")."\" id=\"id_par_datumodmitnuti\" onchange=\"AjaxKontrola('id_dat_odm_den', 'genden', this.value);UniverzalniKontrola('id_par_datumodmitnuti', '{$this->var->regdatum}', '$chybnepole {$this->var->jazyk["par_datumodmitnuti"]}!');\" /><span id=\"id_dat_odm_den\">".($data->datumodmitnuti != "00.00.0000" ? $this->var->jazyk["den{$data->dendatumodmitnuti}"] : "")."</span> {$this->var->datformat}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("epar", "dko") ? "{$this->var->jazyk["par_datumkonec"]}
                <input type=\"text\" name=\"par_datumkonec\" value=\"".($data->datumkonec != "00.00.0000" ? $data->datumkonec : "")."\" id=\"id_par_datumkonec\" onchange=\"AjaxKontrola('id_dat_kon_den', 'genden', this.value);UniverzalniKontrola('id_par_datumkonec', '{$this->var->regdatum}', '$chybnepole {$this->var->jazyk["par_datumkonec"]}!');\" /><span id=\"id_dat_kon_den\">".($data->datumkonec != "00.00.0000" ? $this->var->jazyk["den{$data->dendatumkonec}"] : "")."</span> {$this->var->datformat}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("epar", "sta") ? "{$this->var->jazyk["par_status"]}
                {$this->var->main->OznacenyEditStatus($data->idstatus, "par_status")}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("epar", "csp") ? "{$this->var->jazyk["par_celkovaspokojenost"]}
                {$this->var->main->OzancenyEditProcenta($data->celkovaspokojenost, "par_celkovaspokojenost")}%" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("epar", "kom") ? "{$this->var->jazyk["par_komentar"]}
                <textarea name=\"par_komentar\" rows=\"20\" cols=\"100\">$data->komentar</textarea>" : "")."<br /><br />
                
                ".($this->var->main->PristupOdkaz("epar", "exi") ? "{$this->var->jazyk["par_existfoto"]}<br />
                {$this->var->par->PartnerOznacenyEditExistFoto($data->id)}<br />
                <a href=\"foto.php?sekce=partnerifull&amp;id={$data->id}\" title=\"\"><img src=\"foto.php?sekce=partnerimini&amp;id={$data->id}\" alt=\"\" /></a><br />
                <input type=\"file\" id=\"fot\" name=\"fotka\" />(jpg, png) max 1MB" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("epar", "pra") ? "{$this->var->jazyk["par_pratelsky"]}
                {$this->var->main->OzancenyEditProcenta($data->pratelsky, "par_pratelsky")}%" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("epar", "pre") ? "{$this->var->jazyk["par_presnost"]}
                {$this->var->main->OzancenyEditProcenta($data->presnost, "par_presnost")}%" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("epar", "kpt") ? "{$this->var->jazyk["par_kompetence"]}
                {$this->var->main->OzancenyEditProcenta($data->kompetence, "par_kompetence")}%" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("epar", "kmk") ? "{$this->var->jazyk["par_komunikace"]}
                {$this->var->main->OzancenyEditProcenta($data->komunikace, "par_komunikace")}%" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("epar", "vys") ? "{$this->var->jazyk["par_vystupovani"]}
                {$this->var->main->OzancenyEditProcenta($data->vystupovani, "par_vystupovani")}%" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("epar", "ido") ? "{$this->var->jazyk["par_infodostatek"]}<br />
                {$this->var->par->PartnerOznacenyEditInfoDostatek($data->infodostatek)}" : "")."<br />

                ".($this->var->main->PristupOdkaz("epar", "isr") ? "{$this->var->jazyk["par_infosruzumitelne"]}
                {$this->var->main->OzancenyEditProcenta($data->infosrozumitelne, "par_infosruzumitelne")}%" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("epar", "ius") ? "{$this->var->jazyk["par_infoustnisrozumitelne"]}
                {$this->var->main->OzancenyEditProcenta($data->infoustnisrozumitelne, "par_infoustnisrozumitelne")}%" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("epar", "iho") ? "{$this->var->jazyk["par_infohodnoceni"]}
                {$this->var->main->OzancenyEditProcenta($data->infohodnoceni, "par_infohodnoceni")}%" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("epar", "tka") ? "{$this->var->jazyk["par_terminkalkulace"]}<br />
                {$this->var->par->PartnerOznacenyEditTerminKalkulace($data->terminkalkulace)}" : "")."<br />

                ".($this->var->main->PristupOdkaz("epar", "tdo") ? "{$this->var->jazyk["par_termindodani"]}<br />
                {$this->var->par->PartnerOznacenyEditTerminDodani($data->termindodani)}" : "")."<br />

                ".($this->var->main->PristupOdkaz("epar", "roz") ? "{$this->var->jazyk["par_rozpocet"]}<br />
                {$this->var->par->PartnerOznacenyEditRozpocet($data->rozpocet)}" : "")."<br />

                ".($this->var->main->PristupOdkaz("epar", "odc") ? "{$this->var->jazyk["par_odchylka"]}
                <input type=\"text\" name=\"par_odchylka\" value=\"$data->odchylka\" />%" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("epar", "spo") ? "{$this->var->jazyk["par_spokojenost"]}
                {$this->var->main->OzancenyEditProcenta($data->spokojenost, "par_spokojenost")}%" : "")."<br /><br />

                <input type=\"submit\" name=\"tlacitko\" value=\"{$this->var->jazyk["edit"]}\" />
              </fieldset>
            </form>
  ";
?>
