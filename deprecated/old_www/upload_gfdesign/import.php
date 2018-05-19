<?php
  $style = $_GET["style"];
  settype($style, "integer");
//".(!Empty($_POST["ano"]) || !Empty($_POST["ne"]) ? " style=\"display: none;\"" : "")."
  return
  "
<script type=\"text/javascript\">
  PresunStyl({$style}, 0, 'show', 0);
</script>
<div id=\"vypis_importu\">
  <a href=\"?action=addimport&amp;style={$style}\" class=\"pridat_import\" title=\"{$this->var->stranka["addimport"]}\">{$this->var->stranka["addimport"]}<span></span></a>
  {$this->var->main->ListingDirVzhled($style, $hlaska)}
</div>
  {$hlaska}
  ";
?>