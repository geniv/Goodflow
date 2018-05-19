<?php
  return
  "
<p>
<br />
                ".($this->var->main->PristupOdkaz("ipar", "naz") ? "{$this->var->jazyk["par_nazev"]}: ".(!Empty($data->nazev) ? "{$data->nazev}" : $this->var->emptypol) : "")."<br /><br />

{$this->var->jazyk["par_kontakt"]}:<br />
                ".($this->var->main->PristupOdkaz("ipar", "jme") ? "{$this->var->jazyk["par_jmeno"]}: ".(!Empty($data->jmeno) ? "{$data->jmeno}" : $this->var->emptypol) : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ipar", "pri") ? "{$this->var->jazyk["par_prijmeni"]}: ".(!Empty($data->prijmeni) ? "{$data->prijmeni}" : $this->var->emptypol) : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ipar", "uli") ? "{$this->var->jazyk["par_ulice"]}: ".(!Empty($data->ulice) ? "{$data->ulice}" : $this->var->emptypol) : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ipar", "cp") ? "{$this->var->jazyk["par_cp"]}: {$data->cp}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ipar", "psc") ? "{$this->var->jazyk["par_psc"]}: ".(!Empty($data->psc) ? "{$data->psc}" : $this->var->emptypol) : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ipar", "mes") ? "{$this->var->jazyk["par_mesto"]}: ".(!Empty($data->mesto) ? "{$data->mesto}" : $this->var->emptypol) : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ipar", "zem") ? "{$this->var->jazyk["par_zeme"]}: ".(!Empty($data->zeme) ? "{$data->zeme}" : $this->var->emptypol) : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ipar", "te1") ? "{$this->var->jazyk["par_tel"]}: ".(!Empty($data->telefon) ? "{$data->predvolba} {$data->telefon}" : $this->var->emptypol) : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ipar", "te2") ? "{$this->var->jazyk["par_tel1"]}: ".(!Empty($data->telefon1) ? "{$data->predvolba1} {$data->telefon1}" : $this->var->emptypol) : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ipar", "ema") ? "{$this->var->jazyk["par_email"]}: ".(!Empty($data->email) ? "{$data->email}" : $this->var->emptypol) : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ipar", "jaz") ? "{$this->var->jazyk["par_jazyk"]}<br />
                {$this->var->main->OznacenyJazyk($data->id, "partner")}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ipar", "poh") ? "{$this->var->jazyk["par_pohlavi"]}: {$this->var->zam->IntToPohlavi($data->pohlavi)}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ipar", "dos") ? "{$this->var->jazyk["par_datumosloveni"]}: ".($data->datumosloveni != "00.00.0000" ? "{$this->var->jazyk["den{$data->dendatumosloveni}"]}, {$data->datumosloveni}" : $this->var->emptypol) : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ipar", "dka") ? "{$this->var->jazyk["par_datumkalkulace"]}: ".($data->datumkalkulace != "00.00.0000" ? "{$this->var->jazyk["den{$data->dendatumkalkulace}"]}, {$data->datumkalkulace}" : $this->var->emptypol) : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ipar", "dpo") ? "{$this->var->jazyk["par_datumpohovoru"]}: ".($data->datumpohovoru != "00.00.0000" ? "{$this->var->jazyk["den{$data->dendatumpohovoru}"]}, {$data->datumpohovoru}" : $this->var->emptypol) : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ipar", "dza") ? "{$this->var->jazyk["par_datumzacatek"]}: ".($data->datumzacatek != "00.00.0000" ? "{$this->var->jazyk["den{$data->dendatumzacatek}"]}, {$data->datumzacatek}" : $this->var->emptypol) : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ipar", "dod") ? "{$this->var->jazyk["par_datumodmitnuti"]}: ".($data->datumodmitnuti != "00.00.0000" ? "{$this->var->jazyk["den{$data->dendatumodmitnuti}"]}, {$data->datumodmitnuti}" : $this->var->emptypol) : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ipar", "dko") ? "{$this->var->jazyk["par_datumkonec"]}: ".($data->datumkonec != "00.00.0000" ? "{$this->var->jazyk["den{$data->dendatumkonec}"]}, {$data->datumkonec}" : $this->var->emptypol) : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ipar", "sta") ? "{$this->var->jazyk["par_status"]}:
                {$data->status}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ipar", "csp") ? "{$this->var->jazyk["par_celkovaspokojenost"]}: {$data->celkovaspokojenost}%" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ipar", "kom") ? "{$this->var->jazyk["par_komentar"]}: ".(!Empty($data->komentar) ? "<cite>{$data->komentar}</cite>" : $this->var->emptypol) : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ipar", "exi") ? "{$this->var->jazyk["par_existfoto"]}: {$this->IntToFoto($data->id)}<br />
                <a href=\"foto.php?sekce=partnerifull&amp;id={$data->id}\" title=\"\"><img src=\"foto.php?sekce=partnerimini&amp;id={$data->id}\" alt=\"\" /></a>" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ipar", "pra") ? "{$this->var->jazyk["par_pratelsky"]}: {$data->pratelsky}%" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ipar", "pre") ? "{$this->var->jazyk["par_presnost"]}: {$data->presnost}%" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ipar", "kpt") ? "{$this->var->jazyk["par_kompetence"]}: {$data->kompetence}%" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ipar", "kmk") ? "{$this->var->jazyk["par_komunikace"]}: {$data->komunikace}%" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ipar", "vys") ? "{$this->var->jazyk["par_vystupovani"]}: {$data->vystupovani}%" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ipar", "ido") ? "{$this->var->jazyk["par_infodostatek"]}: {$this->var->main->IntToBool($data->infodostatek)}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ipar", "isr") ? "{$this->var->jazyk["par_infosruzumitelne"]}: {$data->infosrozumitelne}%" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ipar", "ius") ? "{$this->var->jazyk["par_infoustnisrozumitelne"]}: {$data->infoustnisrozumitelne}%" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ipar", "iho") ? "{$this->var->jazyk["par_infohodnoceni"]}: {$data->infohodnoceni}%" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ipar", "tka") ? "{$this->var->jazyk["par_terminkalkulace"]}: {$this->var->main->IntToBool($data->terminkalkulace)}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ipar", "tdo") ? "{$this->var->jazyk["par_termindodani"]}: {$this->var->main->IntToBool($data->termindodani)}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ipar", "roz") ? "{$this->var->jazyk["par_rozpocet"]}: {$this->var->main->IntToBool($data->rozpocet)}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ipar", "odc") ? "{$this->var->jazyk["par_odchylka"]}: {$data->odchylka}%" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("ipar", "spo") ? "{$this->var->jazyk["par_spokojenost"]}: {$data->spokojenost}%" : "")."
                </p>
  ";
?>
