<?php
  return
  "
<script type=\"text/javascript\">
  PoslatAkci('vypisbuben', 0, 'vypis_buben');
</script>
<div id=\"admin_bubny\">
  <h1>Administrace bubnů</h1>
  <p>Zde můžete ovládat bubny na stránkách. Nastavujete zde počet otáček bubnů.</p>
  <p>Dále zde můžete posouvat a nahrávat obrázky v bubnech.</p>
  <div id=\"ovladani_bubnu\">
    <p>
      <em>Počet minimálních otoček bubnů:</em> <cite>{$this->CtiNastaveni("min_ot")}</cite>
      <a href=\"#\" onclick=\"PoslatAkci('editvar&amp;var=min_ot&amp;info=Počet minimálních otáček:&amp;out=info_buben', 0, 'info_buben'); return false;\" title=\"Upravit hodnotu\">
        <span></span>
        Upravit hodnotu
      </a>
    </p>
    <p>
      <em>Počet maximálních otoček bubnů:</em> <cite>{$this->CtiNastaveni("max_ot")}</cite>
      <a href=\"#\" onclick=\"PoslatAkci('editvar&amp;var=max_ot&amp;info=Počet maximálních otáček:&amp;out=info_buben', 0, 'info_buben'); return false;\" title=\"Upravit hodnotu\">
        <span></span>
        Upravit hodnotu
      </a>
    </p>
    <div id=\"info_buben\">
      {$this->var->main->EditAdminObrazekBuben()}
    </div>
    <div id=\"vypis_buben\"></div>
  </div>
</div>
  ";
?>
