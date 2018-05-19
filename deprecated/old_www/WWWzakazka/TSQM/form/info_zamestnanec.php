<?php
  return
  "
      ".($this->var->main->PristupOdkaz("izam", "log") ? "{$this->var->jazyk["zam_log"]}: {$data->loginjmeno}" : "")."<br /><br />

      ".($this->var->main->PristupOdkaz("izam", "hes") ? "{$this->var->jazyk["zam_hes"]}: {$data->loginheslo}" : "")."<br /><br />

      ".($this->var->main->PristupOdkaz("izam", "jme") ? "{$this->var->jazyk["zam_jmeno"]}: ".(!Empty($data->jmeno) ? "{$data->jmeno}" : $this->var->emptypol) : "")."<br /><br />

      ".($this->var->main->PristupOdkaz("izam", "pri") ? "{$this->var->jazyk["zam_prim"]}: ".(!Empty($data->prijmeni) ? "{$data->prijmeni}" : $this->var->emptypol) : "")."<br /><br />

      ".($this->var->main->PristupOdkaz("izam", "pra") ? "{$this->var->jazyk["zam_prava"]}: {$data->prava}" : "")."<br /><br />

      ".($this->var->main->PristupOdkaz("izam", "uli") ? "{$this->var->jazyk["zam_ulice"]}: ".(!Empty($data->ulice) ? "{$data->ulice}" : $this->var->emptypol) : "")."<br /><br />

      ".($this->var->main->PristupOdkaz("izam", "cp") ? "{$this->var->jazyk["zam_cp"]}: {$data->cp}" : "")."<br /><br />

      ".($this->var->main->PristupOdkaz("izam", "psc") ? "{$this->var->jazyk["zam_psc"]}: ".(!Empty($data->psc) ? "{$data->psc}" : $this->var->emptypol) : "")."<br /><br />

      ".($this->var->main->PristupOdkaz("izam", "mes") ? "{$this->var->jazyk["zam_mesto"]}: ".(!Empty($data->mesto) ? "{$data->mesto}" : $this->var->emptypol) : "")."<br /><br />

      ".($this->var->main->PristupOdkaz("izam", "zem") ? "{$this->var->jazyk["zam_zeme"]}: {$data->zeme}" : "")."<br /><br />

      ".($this->var->main->PristupOdkaz("izam", "te1") ? "{$this->var->jazyk["zam_tel1"]}: ".(!Empty($data->telefon) ? "{$data->predvolba} {$data->telefon}" : $this->var->emptypol) : "")."<br />
      ".($this->var->main->PristupOdkaz("izam", "te2") ? "{$this->var->jazyk["zam_tel2"]}: ".(!Empty($data->telefon1) ? "{$data->predvolba1} {$data->telefon1}" : $this->var->emptypol) : "")."<br /><br />

      ".($this->var->main->PristupOdkaz("izam", "ema") ? "{$this->var->jazyk["zam_email"]}: ".(!Empty($data->email) ? "{$data->email}" : $this->var->emptypol) : "")."<br /><br />

      ".($this->var->main->PristupOdkaz("izam", "dna") ? "{$this->var->jazyk["zam_datnar"]}: ".($data->datumnarozeni != "00.00.0000" ? "{$this->var->jazyk["den{$data->dendatumnarozeni}"]}, {$data->datumnarozeni}" : $this->var->emptypol)."" : "")."<br /><br />

      ".($this->var->main->PristupOdkaz("izam", "jaz") ? "{$this->var->jazyk["zam_jazyk"]}: {$this->var->main->OznacenyJazyk($data->zamid, "zamestnanec")}" : "")."<br /><br />

      ".($this->var->main->PristupOdkaz("izam", "vzd") ? "{$this->var->jazyk["zam_vzdelani"]}: ".(!Empty($data->vzdelani) ? "{$data->vzdelani}" : $this->var->emptypol) : "")."<br /><br />

      ".($this->var->main->PristupOdkaz("izam", "rid") ? "{$this->var->jazyk["zam_ridicak"]}: {$this->var->main->IntToBool($data->ridicak)}<br />
      {$this->var->jazyk["zam_typridicak"]}: {$this->var->zam->ZamestnanecOznacenyRidicak($data->zamid)}" : "")."<br />

      ".($this->var->main->PristupOdkaz("izam", "poh") ? "{$this->var->jazyk["zam_pohlavi"]}: {$this->var->zam->IntToPohlavi($data->pohlavi)}" : "")."<br /><br />

      ".($this->var->main->PristupOdkaz("izam", "dos") ? "{$this->var->jazyk["zam_datosloveni"]}: ".($data->datumosloveni != "00.00.0000" ? "{$this->var->jazyk["den{$data->dendatumosloveni}"]}, {$data->datumosloveni}" : $this->var->emptypol) : "")."<br /><br />

      ".($this->var->main->PristupOdkaz("izam", "dzi") ? "{$this->var->jazyk["zam_datzivot"]}: ".($data->datumzivotopisu != "00.00.0000" ? "{$this->var->jazyk["den{$data->dendatumzivotopisu}"]}, {$data->datumzivotopisu}" : $this->var->emptypol) : "")."<br /><br />

      ".($this->var->main->PristupOdkaz("izam", "dpo") ? "{$this->var->jazyk["zam_datpoh"]}: ".($data->datumpohovoru != "00.00.0000" ? "{$this->var->jazyk["den{$data->dendatumpohovoru}"]}, {$data->datumpohovoru}" : $this->var->emptypol) : "")."<br /><br />

      ".($this->var->main->PristupOdkaz("izam", "dza") ? "{$this->var->jazyk["zam_datzac"]}: ".($data->datumzacatek != "00.00.0000" ? "{$this->var->jazyk["den{$data->dendatumzacatek}"]}, {$data->datumzacatek}" : $this->var->emptypol) : "")."<br /><br />

      ".($this->var->main->PristupOdkaz("izam", "dod") ? "{$this->var->jazyk["zam_datodmit"]}: ".($data->datumodmitnuti != "00.00.0000" ? "{$this->var->jazyk["den{$data->dendatumodmitnuti}"]}, {$data->datumodmitnuti}" : $this->var->emptypol) : "")."<br /><br />

      ".($this->var->main->PristupOdkaz("izam", "dko") ? "{$this->var->jazyk["zam_konprac"]}: ".($data->datumkonec != "00.00.0000" ? "{$this->var->jazyk["den{$data->dendatumkonec}"]}, {$data->datumkonec}" : $this->var->emptypol) : "")."<br /><br />

      ".($this->var->main->PristupOdkaz("izam", "sta") ? "{$this->var->jazyk["zam_status"]}: {$data->status}" : "")."<br /><br />

      ".($this->var->main->PristupOdkaz("izam", "exi") ? "{$this->var->jazyk["zam_existfoto"]}: {$this->var->zam->IntToFoto($data->zamid)}<br />
      <a href=\"foto.php?sekce=zamestnancifull&amp;id={$data->zamid}\" title=\"\"><img src=\"foto.php?sekce=zamestnancimini&amp;id={$data->zamid}\" alt=\"\" /></a>" : "")."<br /><br />

      ".($this->var->main->PristupOdkaz("izam", "hob") ? "{$this->var->jazyk["zam_hobby"]}: {$this->var->zam->ZamestnanecOznacenyHobby($data->zamid)}" : "")."<br /><br />

      ".($this->var->main->PristupOdkaz("izam", "spo") ? "{$this->var->jazyk["zam_sport"]}: {$this->var->zam->ZamestnanecOznacenySport($data->zamid)}" : "")."<br /><br />

      ".($this->var->main->PristupOdkaz("izam", "rod") ? "{$this->var->jazyk["zam_rodiste"]}: ".(!Empty($data->mistonarozeni) ? "{$data->mistonarozeni}" : $this->var->emptypol) : "")."<br /><br />

      ".($this->var->main->PristupOdkaz("izam", "mze") ? "{$this->var->jazyk["zam_zemenaroz"]}: ".(!Empty($data->zemenar) ? "{$data->zemenar}" : $this->var->emptypol) : "")."<br /><br />

      ".($this->var->main->PristupOdkaz("izam", "mja") ? "{$this->var->jazyk["zam_matjazyk"]}: ".(!Empty($data->rodnyjazyk) ? "{$data->rodnyjazyk}" : $this->var->emptypol) : "")."<br /><br />

      ".($this->var->main->PristupOdkaz("izam", "jot") ? "{$this->var->jazyk["zam_jmotce"]}: ".(!Empty($data->jmenootce) ? "{$data->jmenootce}" : $this->var->emptypol) : "")."<br />

      ".($this->var->main->PristupOdkaz("izam", "pro") ? "{$this->var->jazyk["zam_prijotce"]}: ".(!Empty($data->prijmeniotce) ? "{$data->prijmeniotce}" : $this->var->emptypol) : "")."<br />

      ".($this->var->main->PristupOdkaz("izam", "pot") ? "{$this->var->jazyk["zam_povotce"]}: ".(!Empty($data->povolaniotce) ? "{$data->povolaniotce}" : $this->var->emptypol) : "")."<br />

      ".($this->var->main->PristupOdkaz("izam", "jma") ? "{$this->var->jazyk["zam_jmmatky"]}: ".(!Empty($data->jmenomatky) ? "{$data->jmenomatky}" : $this->var->emptypol) : "")."<br />

      ".($this->var->main->PristupOdkaz("izam", "prm") ? "{$this->var->jazyk["zam_prijmatky"]}: ".(!Empty($data->prijmenimatky) ? "{$data->prijmenimatky}" : $this->var->emptypol) : "")."<br />

      ".($this->var->main->PristupOdkaz("izam", "pma") ? "{$this->var->jazyk["zam_povmatky"]}: ".(!Empty($data->povolanimatky) ? "{$data->povolanimatky}" : $this->var->emptypol) : "")."<br />

      ".($this->var->main->PristupOdkaz("izam", "pob") ? "{$this->var->jazyk["zam_pocbrat"]}: ".(!Empty($data->pocetbratru) ? "{$data->pocetbratru}" : $this->var->emptypol) : "")."<br />

      ".($this->var->main->PristupOdkaz("izam", "pos") ? "{$this->var->jazyk["zam_pocsest"]}: ".(!Empty($data->pocetsester) ? "{$data->pocetsester}" : $this->var->emptypol) : "")."<br />

      ".($this->var->main->PristupOdkaz("izam", "sso") ? "{$this->var->jazyk["zam_sumsour"]}: ".($data->pocetbratru + $data->pocetsester) : "")."<br /><br />

      ".($this->var->main->PristupOdkaz("izam", "mat") ? "{$this->var->jazyk["zam_mat"]}: {$this->var->main->IntToBool($data->maturita)}" : "")."<br />

      ".($this->var->main->PristupOdkaz("izam", "str") ? "{$this->var->jazyk["zam_stredni"]}: {$this->var->main->IntToBool($data->stredni)}" : "")."<br />
      ".($this->var->main->PristupOdkaz("izam", "tst") ? "{$this->var->jazyk["zam_typstredni"]}: ".(!Empty($data->nazevstredni) ? "{$data->nazevstredni}" : $this->var->emptypol) : "")."<br />

      ".($this->var->main->PristupOdkaz("izam", "str") ? "{$this->var->jazyk["od"]}: ".(!Empty($data->stredniod) ? "{$data->stredniod}" : $this->var->emptypol)."
      {$this->var->jazyk["do"]}: ".(!Empty($data->strednido) ? "{$data->strednido}" : $this->var->emptypol)."<br />
      ".($data->strednido - $data->stredniod)." {$this->var->jazyk["roku"]}" : "")."<br /><br />

      ".($this->var->main->PristupOdkaz("izam", "vys") ? "{$this->var->jazyk["zam_vyska"]}: {$this->var->main->IntToBool($data->vysoka)}" : "")."<br />
      ".($this->var->main->PristupOdkaz("izam", "tvy") ? "{$this->var->jazyk["zam_typvyska"]}: ".(!Empty($data->nazevvysoke) ? "{$data->nazevvysoke}" : $this->var->emptypol) : "")."<br />

      ".($this->var->main->PristupOdkaz("izam", "vys") ? "{$this->var->jazyk["od"]}: ".(!Empty($data->vyskaod) ? "{$data->vyskaod}" : $this->var->emptypol)."
      {$this->var->jazyk["do"]}: ".(!Empty($data->vyskado) ? "{$data->vyskado}" : $this->var->emptypol)."<br />
      ".($data->vyskado - $data->vyskaod)." {$this->var->jazyk["roku"]}" : "")."<br /><br />

      ".($this->var->main->PristupOdkaz("izam", "obo") ? "{$this->var->jazyk["zam_obor"]}<br />
      {$this->ZamestnanecOznacenyVyska($data->zamid)}" : "")."<br /><br />

      ".($this->var->main->PristupOdkaz("izam", "tyt") ? "{$this->var->jazyk["zam_tytul"]}: {$this->var->main->IntToBool($data->vystytul)}" : "")."<br />
      <br />
  ";
?>

