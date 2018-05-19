<?php
  return
  "
<script type=\"text/javascript\">
  PoslatAkci('vypisvyhry', 0, 'vypis_vyhry');
</script>
<div id=\"admin_listina_vyher\">
  <h1>Administrace výher</h1>
  <p>Zde můžete přidávat, upravovat a mazat výhry</p>
  <div id=\"info_vyhry\">
    {$this->var->main->EditAdminObrazkyVyhry()}
    {$this->var->main->EditAdmiVyhry()}
  </div>
  <div id=\"vypis_vyhry\"></div>
</div>
  ";
?>
