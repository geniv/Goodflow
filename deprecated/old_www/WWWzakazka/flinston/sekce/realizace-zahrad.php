<?php
  $dynamickyobsahrealizace = $this->var->main[0]->NactiFunkci("DynamicObsah", "DynamickyObsah", $_GET["sekce"]);
  $dynamickyobsahrealizacenadpis = $this->var->main[0]->NactiFunkci("DynamicObsah", "DynamickyObsah", "nadpisrealizacezahrad");
  $galerie = $this->var->main[0]->NactiFunkci("DynamicPictureGallery", "PictureGallery", $_GET["sekce"]);
  $dynamickyformularrealizace = $this->var->main[0]->NactiFunkci("DynamicForm", "Formular", $_GET["sekce"]);
	return
  "<div id=\"sekce_realizace_zahrad\">
{$dynamickyobsahrealizacenadpis}
{$dynamickyobsahrealizace}
{$galerie}{$dynamickyformularrealizace}</div>";
?>