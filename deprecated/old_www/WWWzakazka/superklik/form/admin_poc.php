<?php
  return
  "
  <script type=\"text/javascript\">
    PoslatAkci('vypispoc', 0, 'vypis_poc');
  </script>
  <div id=\"admin_pocitadla\">
    <h1>Počítadla</h1>
    <p>Počítadla přístupů</p>
    <p class=\"celkem_navstev_pocitadla\">Celkem návštěv: <em>{$this->var->main->CisloPocitadlaPristupu()}</em></p>
    <div id=\"info_poc\"></div>
    <div id=\"vypis_poc\"></div>
  </div>
  ";
?>
