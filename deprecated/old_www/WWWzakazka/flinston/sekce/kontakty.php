<?php
  $dynamickyobsahkontakty = $this->var->main[0]->NactiFunkci("DynamicObsah", "DynamickyObsah", "obsahkontakty");
	return
  "<div id=\"sekce_kontakty\">
{$dynamickyobsahkontakty}
</div>";
?>