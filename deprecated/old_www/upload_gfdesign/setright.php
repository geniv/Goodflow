<?php
  return
  "
<script type=\"text/javascript\">
  Sdileni(0, 0);
</script>
<div id=\"vypis_sdileni\"".((!Empty($_POST["ano"]) || !Empty($_POST["ne"])) || (!Empty($_GET["od"]) && !Empty($_GET["do"])) || (!Empty($_GET["id"]) && !Empty($_GET["ida"])) ? " style=\"display: none;\"" : "").">
  {$this->var->main->ListingSetRight($hlaska)}
</div>
<div id=\"info_upraveno_sdileni\"></div>
<div id=\"vypis_sdileni_uzivatele\"></div>
{$hlaska}
  ";
?>
