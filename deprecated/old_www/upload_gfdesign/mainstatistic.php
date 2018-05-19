<?php
  return
  "
<div id=\"vypis_statistik_centralni_statistiky\">
  {$this->var->main->ViewStatistic()}
  {$this->var->main->SizeStatistic()}
  {$this->var->main->OtherStatistic()}
</div>
<div id=\"flag_zeme\"></div>
  ";
?>