<?php
  $dynamickyobsahporadna = $this->var->main[0]->NactiFunkci("DynamicObsah", "DynamickyObsah", "obsahporadna");
  $dynamickyformularporadna = $this->var->main[0]->NactiFunkci("DynamicForm", "Formular", "poradnaformular");
	return
  "<div id=\"sekce_poradna\">
{$dynamickyobsahporadna}
{$dynamickyformularporadna}
</div>";
?>