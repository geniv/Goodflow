<?php
  $dynamickyobsahprodejna = $this->var->main[0]->NactiFunkci("DynamicObsah", "DynamickyObsah", $_GET["sekce"]);
  $dynamickyformularprodejna = $this->var->main[0]->NactiFunkci("DynamicForm", "Formular", $_GET["sekce"]);
	return
  "<div id=\"sekce_prodejna\">
{$dynamickyobsahprodejna}
{$dynamickyformularprodejna}
</div>";
?>