<?php
  return
  "
<div id=\"admin_uvod\">
  <h1>Vítejte v administraci Superklik.cz</h1>
  {$this->var->main->AktualniVyhra()}
  {$this->var->main->PocetUzivatelu()}
  {$this->var->main->PosledniUspesnyVyherce()}
  <p>{$this->var->main->PocetVsechToceni()}</p>
  {$this->var->main->InfoDatum()}
  {$this->var->main->StatistikyUzivatelu()}
  <span class=\"obrazek_dekorace\"></span>
</div>
  ";
?>
