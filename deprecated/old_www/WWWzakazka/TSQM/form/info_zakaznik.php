<?php
  return
  "
<p>
<br />
                ".($this->var->main->PristupOdkaz("izak", "naz") ? "{$this->var->jazyk["zak_nazev"]}: ".(!Empty($data->nazev) ? "{$data->nazev}" : $this->var->emptypol) : "")."<br /><br />

{$this->var->jazyk["zak_kontakt"]}:<br />
                ".($this->var->main->PristupOdkaz("izak", "jme") ? "{$this->var->jazyk["zak_jmeno"]}: ".(!Empty($data->jmeno) ? "{$data->jmeno}" : $this->var->emptypol) : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("izak", "pri") ? "{$this->var->jazyk["zak_prijmeni"]}: ".(!Empty($data->prijmeni) ? "{$data->prijmeni}" : $this->var->emptypol) : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("izak", "uli") ? "{$this->var->jazyk["zak_ulice"]}: ".(!Empty($data->ulice) ? "{$data->ulice}" : $this->var->emptypol) : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("izak", "cp") ? "{$this->var->jazyk["zak_cp"]}: {$data->cp}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("izak", "psc") ? "{$this->var->jazyk["zak_psc"]}: ".(!Empty($data->psc) ? "{$data->psc}" : $this->var->emptypol) : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("izak", "mes") ? "{$this->var->jazyk["zak_mesto"]}: ".(!Empty($data->mesto) ? "{$data->mesto}" : $this->var->emptypol) : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("izak", "zem") ? "{$this->var->jazyk["zak_zeme"]}: ".(!Empty($data->zeme) ? "{$data->zeme}" : $this->var->emptypol) : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("izak", "te1") ? "{$this->var->jazyk["zak_tel"]}: ".(!Empty($data->telefon) ? "{$data->predvolba} {$data->telefon}" : $this->var->emptypol) : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("izak", "te2") ? "{$this->var->jazyk["zak_tel1"]}: ".(!Empty($data->telefon1) ? "{$data->predvolba1} {$data->telefon1}" : $this->var->emptypol) : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("izak", "ema") ? "{$this->var->jazyk["zak_email"]}: ".(!Empty($data->email) ? "{$data->email}" : $this->var->emptypol) : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("izak", "jaz") ? "{$this->var->jazyk["zak_jazyk"]}<br />
                {$this->var->main->OznacenyJazyk($data->id, "zakaznik")}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("izak", "poh") ? "{$this->var->jazyk["zak_pohlavi"]}: {$this->var->zam->IntToPohlavi($data->pohlavi)}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("izak", "dos") ? "{$this->var->jazyk["zak_datumosloveni"]}: ".($data->datumosloveni != "00.00.0000" ? "{$this->var->jazyk["den{$data->dendatumosloveni}"]}, {$data->datumosloveni}" : $this->var->emptypol) : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("izak", "dka") ? "{$this->var->jazyk["zak_datumkalkulace"]}: ".($data->datumkalkulace != "00.00.0000" ? "{$this->var->jazyk["den{$data->dendatumkalkulace}"]}, {$data->datumkalkulace}" : $this->var->emptypol) : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("izak", "dpo") ? "{$this->var->jazyk["zak_datumpohovoru"]}: ".($data->datumpohovoru != "00.00.0000" ? "{$this->var->jazyk["den{$data->dendatumpohovoru}"]}, {$data->datumpohovoru}" : $this->var->emptypol) : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("izak", "dza") ? "{$this->var->jazyk["zak_datumzacatek"]}: ".($data->datumzacatek != "00.00.0000" ? "{$this->var->jazyk["den{$data->dendatumzacatek}"]}, {$data->datumzacatek}" : $this->var->emptypol) : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("izak", "dod") ? "{$this->var->jazyk["zak_datumodmitnuti"]}: ".($data->datumodmitnuti != "00.00.0000" ? "{$this->var->jazyk["den{$data->dendatumodmitnuti}"]}, {$data->datumodmitnuti}" : $this->var->emptypol) : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("izak", "dko") ? "{$this->var->jazyk["zak_datumkonec"]}: ".($data->datumkonec != "00.00.0000" ? "{$this->var->jazyk["den{$data->dendatumkonec}"]}, {$data->datumkonec}" : $this->var->emptypol) : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("izak", "sta") ? "{$this->var->jazyk["zak_status"]}:
                {$data->status}" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("izak", "csp") ? "{$this->var->jazyk["zak_celkovaspokojenost"]}: {$data->celkovaspokojenost}%" : "")."<br /><br />

                ".($this->var->main->PristupOdkaz("izak", "kom") ? "{$this->var->jazyk["zak_komentar"]}: ".(!Empty($data->komentar) ? "<cite>{$data->komentar}</cite>" : $this->var->emptypol) : "")."<br /><br />
                
                ".($this->var->main->PristupOdkaz("izak", "exi") ? "{$this->var->jazyk["zak_existfoto"]}: {$this->IntToFoto($data->id)}<br />
                <a href=\"foto.php?sekce=zakaznicifull&amp;id={$data->id}\" title=\"\"><img src=\"foto.php?sekce=zakaznicimini&amp;id={$data->id}\" alt=\"\" /></a>" : "")."<br /><br />

                </p>
  ";
?>
