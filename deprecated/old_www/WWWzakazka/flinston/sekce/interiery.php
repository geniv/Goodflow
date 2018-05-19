<?php
  $dynamickyobsahinteriery = $this->var->main[0]->NactiFunkci("DynamicObsah", "DynamickyObsah", $_GET["sekce"]);
  $dynamickyobsahinterierynadpis = $this->var->main[0]->NactiFunkci("DynamicObsah", "DynamickyObsah", "nadpisinteriery");
  $galerie = $this->var->main[0]->NactiFunkci("DynamicPictureGallery", "PictureGallery", $_GET["sekce"]);
  $dynamickyformularinteriery = $this->var->main[0]->NactiFunkci("DynamicForm", "Formular", $_GET["sekce"]);
	return
  "<div id=\"sekce_interiery\">
{$dynamickyobsahinterierynadpis}
{$dynamickyobsahinteriery}
{$galerie}{$dynamickyformularinteriery}</div>";
?>