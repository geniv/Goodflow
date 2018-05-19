<?php
  $chybnepole = $this->var->jazyk["chybapole"];
  return
  "
                  <p>
            <br />
            {$this->var->jazyk["edit_zamestnanec"]}
            </p>
            <form action=\"\" method=\"post\" enctype=\"multipart/form-data\">
              <fieldset>
                ".($this->var->main->PristupOdkaz("ezam", "log") ? "{$this->var->jazyk["zam_log"]}
                <input type=\"text\" name=\"zam_log\" value=\"$data->loginjmeno\" onkeyup=\"AjaxKontrola('id_zam_log', 'zamlog', this.value);\" />*<span id=\"id_zam_log\"></span>" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ezam", "hes") ? "{$this->var->jazyk["zam_hes"]}
                <input type=\"text\" name=\"zam_hes\" value=\"$data->loginheslo\" />*" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ezam", "hre") ? "{$this->var->jazyk["zam_hesrep"]}
                <input type=\"text\" name=\"zam_hesrep\" value=\"$data->loginheslo\" />*" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ezam", "jme") ? "{$this->var->jazyk["zam_jmeno"]}
                <input type=\"text\" name=\"zam_jmeno\" value=\"$data->jmeno\" />" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ezam", "pri") ? "{$this->var->jazyk["zam_prim"]}
                <input type=\"text\" name=\"zam_prim\" value=\"$data->prijmeni\" />" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ezam", "pra") ? "{$this->var->jazyk["zam_prava"]}<br />
                {$this->var->zam->ZamestnanecOznacenyPrava($data->idprava)}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ezam", "uli") ? "{$this->var->jazyk["zam_ulice"]}
                <input type=\"text\" name=\"zam_ulice\" value=\"$data->ulice\" />" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ezam", "cp") ? "{$this->var->jazyk["zam_cp"]}
                <input type=\"text\" name=\"zam_cp\" value=\"$data->cp\" />" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ezam", "psc") ? "{$this->var->jazyk["zam_psc"]}
                <input type=\"text\" name=\"zam_psc\" value=\"$data->psc\" /" : "")."><br /><br />

                ".($this->var->main->PristupOdkaz("ezam", "mes") ? "{$this->var->jazyk["zam_mesto"]}
                <input type=\"text\" name=\"zam_mesto\" value=\"$data->mesto\" />" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ezam", "zem") ? "{$this->var->jazyk["zam_zeme"]}<br />
                {$this->var->main->OznacenyEditZeme($data->idzeme, "zam_zeme")}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ezam", "te1") ? "{$this->var->jazyk["zam_tel1"]}
                <input type=\"text\" name=\"zam_pred1\" value=\"$data->predvolba\" />
                <input type=\"text\" name=\"zam_tel1\" value=\"$data->telefon\" />" : "")."<br />

                ".($this->var->main->PristupOdkaz("ezam", "te2") ? "{$this->var->jazyk["zam_tel2"]}
                <input type=\"text\" name=\"zam_pred2\" value=\"$data->predvolba1\" />
                <input type=\"text\" name=\"zam_tel2\" value=\"$data->telefon1\" />" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ezam", "ema") ? "{$this->var->jazyk["zam_email"]}
                <input type=\"text\" name=\"zam_email\" id=\"email_label_input\" value=\"$data->email\" onchange=\"UniverzalniKontrola('id_zam_email', '{$this->var->regemail}', '$chybnepole {$this->var->jazyk["zam_email"]}!');\" />" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ezam", "dna") ? "{$this->var->jazyk["zam_datnar"]}
                <input type=\"text\" name=\"zam_datnar\" value=\"".($data->datumnarozeni != "00.00.0000" ? $data->datumnarozeni : "")."\" id=\"id_zam_datnar\" onchange=\"AjaxKontrola('id_dat_nar_den', 'genden', this.value);UniverzalniKontrola('id_zam_datnar', '{$this->var->regdatum}', '$chybnepole {$this->var->jazyk["zam_datnar"]}!');\" /><span id=\"id_dat_nar_den\">".($data->datumnarozeni != "00.00.0000" ? $this->var->jazyk["den{$data->dendatumnarozeni}"] : "")."</span> {$this->var->datformat}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ezam", "jaz") ? "{$this->var->jazyk["zam_jazyk"]}<br />
                {$this->var->main->OznacenyEditJazyk($data->id, "zamestnanec", "zam_jazyk")}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ezam", "vzd") ? "{$this->var->jazyk["zam_vzdelani"]}<br />
                {$this->var->zam->ZamestnanecOznacenyEditVzdelani($data->idvzdelani)}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ezam", "rid") ? "{$this->var->jazyk["zam_ridicak"]}<br />
                {$this->var->zam->ZamestnanecOznacenyEditExistRidicak($data->ridicak)}
                {$this->var->zam->ZamestnanecOznacenyEditRidicak($data->id)}" : "")."<br />

                ".($this->var->main->PristupOdkaz("ezam", "poh") ? "{$this->var->jazyk["zam_pohlavi"]}<br />
                {$this->var->zam->ZamestnanecOznacenyEditPohlavi($data->pohlavi)}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ezam", "dos") ? "{$this->var->jazyk["zam_datosloveni"]}
                <input type=\"text\" name=\"zam_datosloveni\" value=\"".($data->datumosloveni != "00.00.0000" ? $data->datumosloveni : "")."\" id=\"id_zam_datosloveni\" onchange=\"AjaxKontrola('id_dat_oslov_den', 'genden', this.value);UniverzalniKontrola('id_zam_datosloveni', '{$this->var->regdatum}', '$chybnepole {$this->var->jazyk["zam_datosloveni"]}!');\" /><span id=\"id_dat_oslov_den\">".($data->datumosloveni != "00.00.0000" ? $this->var->jazyk["den{$data->dendatumosloveni}"] : "")."</span> {$this->var->datformat}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ezam", "dzi") ? "{$this->var->jazyk["zam_datzivot"]}
                <input type=\"text\" name=\"zam_datzivot\" value=\"".($data->datumzivotopisu != "00.00.0000" ? $data->datumzivotopisu : "")."\" id=\"id_zam_datzivot\" onchange=\"AjaxKontrola('id_dat_zivot_den', 'genden', this.value);UniverzalniKontrola('id_zam_datzivot', '{$this->var->regdatum}', '$chybnepole {$this->var->jazyk["zam_datzivot"]}!');\" /><span id=\"id_dat_zivot_den\">".($data->datumzivotopisu != "00.00.0000" ? $this->var->jazyk["den{$data->dendatumzivotopisu}"] : "")."</span> {$this->var->datformat}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ezam", "dpo") ? "{$this->var->jazyk["zam_datpoh"]}
                <input type=\"text\" name=\"zam_datpoh\" value=\"".($data->datumpohovoru != "00.00.0000" ? $data->datumpohovoru : "")."\" id=\"zam_datpoh\" onchange=\"AjaxKontrola('id_dat_poh_den', 'genden', this.value);UniverzalniKontrola('id_zam_datzivot', '{$this->var->regdatum}', '$chybnepole {$this->var->jazyk["zam_datpoh"]}!');\" /><span id=\"id_dat_poh_den\">".($data->datumpohovoru != "00.00.0000" ? $this->var->jazyk["den{$data->dendatumpohovoru}"] : "")."</span> {$this->var->datformat}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ezam", "dza") ? "{$this->var->jazyk["zam_datzac"]}
                <input type=\"text\" name=\"zam_datzac\" value=\"".($data->datumzacatek != "00.00.0000" ? $data->datumzacatek : "")."\" id=\"id_zam_datzac\" onchange=\"AjaxKontrola('id_dat_zac_den', 'genden', this.value);UniverzalniKontrola('id_zam_datzac', '{$this->var->regdatum}', '$chybnepole {$this->var->jazyk["zam_datzac"]}!');\" /><span id=\"id_dat_zac_den\">".($data->datumzacatek != "00.00.0000" ? $this->var->jazyk["den{$data->dendatumzacatek}"] : "")."</span> {$this->var->datformat}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ezam", "dod") ? "{$this->var->jazyk["zam_datodmit"]}
                <input type=\"text\" name=\"zam_datodmit\" value=\"".($data->datumodmitnuti != "00.00.0000" ? $data->datumodmitnuti : "")."\" id=\"id_zam_datodmit\" onchange=\"AjaxKontrola('id_dat_zac_den', 'genden', this.value);UniverzalniKontrola('id_zam_datodmit', '{$this->var->regdatum}', '$chybnepole {$this->var->jazyk["zam_datodmit"]}!');\" /><span id=\"id_dat_odmit_den\">".($data->datumodmitnuti != "00.00.0000" ? $this->var->jazyk["den{$data->dendatumodmitnuti}"] : "")."</span> {$this->var->datformat}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ezam", "dko") ? "{$this->var->jazyk["zam_konprac"]}
                <input type=\"text\" name=\"zam_konprac\" value=\"".($data->datumkonec != "00.00.0000" ? $data->datumkonec : "")."\" id=\"id_zam_konprac\" onchange=\"AjaxKontrola('id_dat_kon_den', 'genden', this.value);UniverzalniKontrola('id_zam_konprac', '{$this->var->regdatum}', '$chybnepole {$this->var->jazyk["zam_konprac"]}!');\" /><span id=\"id_dat_kon_den\">".($data->datumkonec != "00.00.0000" ? $this->var->jazyk["den{$data->dendatumkonec}"] : "")."</span> {$this->var->datformat}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ezam", "sta") ? "{$this->var->jazyk["zam_status"]}<br />
                {$this->var->main->OznacenyEditStatus($data->idstatus, "zam_status")}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ezam", "exi") ? "{$this->var->jazyk["zam_existfoto"]}<br />
                {$this->var->zam->ZamestnanecOznacenyEditExistFoto($data->id)}
                <a href=\"foto.php?sekce=zamestnancifull&amp;id={$data->id}\" title=\"\"><img src=\"foto.php?sekce=zamestnancimini&amp;id={$data->id}\" alt=\"\" /></a><br />
                <input type=\"file\" id=\"fot\" name=\"fotka\" />(jpg, png) max 1MB" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ezam", "hob") ? "{$this->var->jazyk["zam_hobby"]}<br />
                {$this->var->zam->ZamestnanecOznacenyEditHobby($data->id)}" : "")."<br />

                ".($this->var->main->PristupOdkaz("ezam", "spo") ? "{$this->var->jazyk["zam_sport"]}<br />
                {$this->var->zam->ZamestnanecOznacenyEditSport($data->id)}" : "")."<br />

                ".($this->var->main->PristupOdkaz("ezam", "rod") ? "{$this->var->jazyk["zam_rodiste"]}<br />
                <input type=\"text\" name=\"zam_rodiste\" value=\"$data->mistonarozeni\" />" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ezam", "mze") ? "{$this->var->jazyk["zam_zemenaroz"]}<br />
                {$this->var->main->OznacenyEditZeme($data->idzemenarozeni, "zam_zemenaroz")}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ezam", "mja") ? "{$this->var->jazyk["zam_matjazyk"]}<br />
                {$this->var->zam->ZamestnanecOznacenyEditRodnyJazyk($data->idrodnyjazyk)}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ezam", "jot") ? "{$this->var->jazyk["zam_jmotce"]}
                <input type=\"text\" name=\"zam_jmotce\" value=\"$data->jmenootce\" />" : "")."<br />

                ".($this->var->main->PristupOdkaz("ezam", "pro") ? "{$this->var->jazyk["zam_prijotce"]}
                <input type=\"text\" name=\"zam_prijotce\" value=\"$data->prijmeniotce\" />" : "")."<br />

                ".($this->var->main->PristupOdkaz("ezam", "pot") ? "{$this->var->jazyk["zam_povotce"]}
                <input type=\"text\" name=\"zam_povotce\" value=\"$data->povolaniotce\" />" : "")."<br />

                ".($this->var->main->PristupOdkaz("ezam", "jma") ? "{$this->var->jazyk["zam_jmmatky"]}
                <input type=\"text\" name=\"zam_jmmatky\" value=\"$data->jmenomatky\" />" : "")."<br />

                ".($this->var->main->PristupOdkaz("ezam", "prm") ? "{$this->var->jazyk["zam_prijmatky"]}
                <input type=\"text\" name=\"zam_prijmatky\" value=\"$data->prijmenimatky\" />" : "")."<br />

                ".($this->var->main->PristupOdkaz("ezam", "pma") ? "{$this->var->jazyk["zam_povmatky"]}
                <input type=\"text\" name=\"zam_povmatky\" value=\"$data->povolanimatky\" />" : "")."<br />

                ".($this->var->main->PristupOdkaz("ezam", "pob") ? "{$this->var->jazyk["zam_pocbrat"]}
                <input type=\"text\" name=\"zam_pocbrat\" id=\"pocbrat\" value=\"$data->pocetbratru\" id=\"pocbrat\" onchange=\"UniverzalniKontrola('pocbrat', '{$this->var->regcislo}', '$chybnepole {$this->var->jazyk["zam_pocbrat"]}!');SoucetSourozencu('pocbrat', 'pocsest', 'sumsour', '$chybnepole {$this->var->jazyk["zam_pocbrat"]}');\" />" : "")."<br />

                ".($this->var->main->PristupOdkaz("ezam", "pos") ? "{$this->var->jazyk["zam_pocsest"]}
                <input type=\"text\" name=\"zam_pocsest\" id=\"pocsest\" value=\"$data->pocetsester\" id=\"pocsest\" onchange=\"UniverzalniKontrola('pocsest', '{$this->var->regcislo}', '$chybnepole {$this->var->jazyk["zam_pocsest"]}!');SoucetSourozencu('pocbrat', 'pocsest', 'sumsour', '$chybnepole {$this->var->jazyk["zam_pocsest"]}');\" />" : "")."<br />

                ".($this->var->main->PristupOdkaz("ezam", "sso") ? "{$this->var->jazyk["zam_sumsour"]}: <span id=\"sumsour\">".($data->pocetbratru + $data->pocetsester)."</span>" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ezam", "mat") ? "{$this->var->jazyk["zam_mat"]}<br />
                {$this->var->zam->ZamestnanecOznacenyEditMaturita($data->maturita)}" : "")."<br />

                ".($this->var->main->PristupOdkaz("ezam", "str") ? "{$this->var->jazyk["zam_stredni"]}<br />
                {$this->var->zam->ZamestnanecOznacenyEditStredni($data->stredni)}" : "")."
                ".($this->var->main->PristupOdkaz("ezam", "tst") ? "{$this->var->jazyk["zam_typstredni"]}<input type=\"text\" name=\"zam_typstredni\" id=\"sttyp\" value=\"$data->nazevstredni\" />" : "")."<br />

                ".($this->var->main->PristupOdkaz("ezam", "str") ? "{$this->var->jazyk["od"]}<input type=\"text\" name=\"zam_stredniod\" value=\"$data->stredniod\" id=\"stod\" onchange=\"UniverzalniKontrola('stod', '{$this->var->regrok}', '$chybnepole {$this->var->jazyk["zam_stredni"]} {$this->var->jazyk["od"]}!');VypocetPocetRoku('stod', 'stdo', 'stpocrok', '$chybnepole {$this->var->jazyk["od"]}');\" />YYYY
                {$this->var->jazyk["do"]}<input type=\"text\" name=\"zam_strednido\" value=\"$data->strednido\" id=\"stdo\" onchange=\"UniverzalniKontrola('stdo', '{$this->var->regrok}', '$chybnepole {$this->var->jazyk["zam_stredni"]} {$this->var->jazyk["do"]}!');VypocetPocetRoku('stod', 'stdo', 'stpocrok', '$chybnepole {$this->var->jazyk["do"]}');\" />YYYY<br />
                <span id=\"stpocrok\">".($data->strednido - $data->stredniod)."</span> {$this->var->jazyk["roku"]}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ezam", "vys") ? "{$this->var->jazyk["zam_vyska"]}
                {$this->var->zam->ZamestnanecOznacenyEditVyska($data->vysoka)}" : "")."
                ".($this->var->main->PristupOdkaz("ezam", "tvy") ? "{$this->var->jazyk["zam_typvyska"]}<input type=\"text\" name=\"zam_typvyska\" id=\"vytyp\" value=\"$data->nazevvysoke\" />" : "")."<br />

                ".($this->var->main->PristupOdkaz("ezam", "vys") ? "{$this->var->jazyk["od"]}<input type=\"text\" name=\"zam_vyskaod\" value=\"$data->vyskaod\" id=\"vyod\" onchange=\"UniverzalniKontrola('vyod', '{$this->var->regrok}', '$chybnepole {$this->var->jazyk["zam_vyska"]} {$this->var->jazyk["od"]}!');VypocetPocetRoku('vyod', 'vydo', 'vypocrok', '$chybnepole {$this->var->jazyk["od"]}');\" />YYYY
                {$this->var->jazyk["do"]}<input type=\"text\" name=\"zam_vyskado\" value=\"$data->vyskado\" id=\"vydo\" onchange=\"UniverzalniKontrola('vydo', '{$this->var->regrok}', '$chybnepole {$this->var->jazyk["zam_vyska"]} {$this->var->jazyk["od"]}!');VypocetPocetRoku('vyod', 'vydo', 'vypocrok', '$chybnepole {$this->var->jazyk["od"]}');\" />YYYY<br />
                <span id=\"vypocrok\">".($data->vyskado - $data->vyskaod)."</span> {$this->var->jazyk["roku"]}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ezam", "obo") ? "{$this->var->jazyk["zam_obor"]}<br />
                {$this->var->zam->ZamestnanecOznacenyEditTypVyska($data->id)}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ezam", "tyt") ? "{$this->var->jazyk["zam_tytul"]}<br />
                {$this->var->zam->ZamestnanecOznacenyEditTytul($data->vystytul)}" : "")."<br />

Velke policka - cely zadavaci formular udelejte v peknem designu, policka
nemusi byt pod sebou ale smysluplny formular.<br />

                <input type=\"submit\" name=\"tlacitko\" value=\"{$this->var->jazyk["edit"]}\" />
              </fieldset>
            </form>
  ";
?>

