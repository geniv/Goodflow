<?php
  return
  "
  <script type=\"text/javascript\">
    PoslatAkci('vypiscenik', 0, 'vypis_cenik');
  </script>
  <div id=\"admin_cenik\">
    <h1>Administrace ceníku</h1>
    <p>Zde můžete přidávat, upravovat a mazat položky v ceníku</p>
    <div id=\"info_cenik\">
      {$this->var->main->PridejAdminCenikRadek()}{$this->var->main->EditAdmiCenikRadek()}
    </div>
    <div id=\"vypis_cenik\"></div>
    <div id=\"vypis_objednavky_cenik\">
      {$this->var->main->VypisAdminObjednavky()}
    </div>
  </div>
  ";
?>
