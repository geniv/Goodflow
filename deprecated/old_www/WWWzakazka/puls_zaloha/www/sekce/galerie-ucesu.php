<?php
  $absolute_url = $this->var->absolutni_url;
  //$sekceamp = $this->var->main[0]->NactiFunkci("DynamicConfig", "ObjectConfigGroup", "sekce-amp");
  //$nazvysekci = $this->var->main[0]->NactiFunkci("DynamicConfig", "ObjectConfigGroup", "nazvy-sekci", true);
  //$ampobsah = $this->var->main[0]->NactiFunkci("DynamicCentral", "Central", array("adresa" => "amp-obsah", "tvar" => "amp-obsah"));
  
  
  
  $galerieucesu = $this->var->main[0]->NactiFunkci("DynamicCentral", "Central", array("adresa" => "galerie-ucesu", "tvar" => "galerie-ucesu"));

  $result =
  "



<script type=\"text/javascript\" src=\"{$absolute_url}script/jquery/jquery.galleriffic.puls.js\"></script>










				<div id=\"gallery\" class=\"content\">
					<div id=\"controls\" class=\"controls\"></div>
					<div class=\"slideshow-container\">
						<div id=\"loading\" class=\"loader\"></div>
						<div id=\"slideshow\" class=\"slideshow\"></div>
					</div>
					<div id=\"caption\" class=\"caption-container\"></div>
				</div>
				<div id=\"thumbs\" class=\"navigation\">
					<ul class=\"thumbs noscript\">
					{$galerieucesu}
					</ul>
				</div>



		<script type=\"text/javascript\">
			jQuery(document).ready(function($) {

				var gallery = $('#thumbs').galleriffic({
					delay:                     2500,
					numThumbs:                 4,
					preloadAhead:              8,
					enableTopPager:            false,
					enableBottomPager:         true,
					maxPagesToShow:            30,
					imageContainerSel:         '#slideshow',
					controlsContainerSel:      '#controls',
					captionContainerSel:       '#caption',
					loadingContainerSel:       '#loading',
					renderSSControls:          true,
					renderNavControls:         true,
					nextPageLinkText:          '',
					prevPageLinkText:          '',
					enableHistory:             false,
					autoStart:                 false,
					syncTransitions:           true,
					defaultTransitionDuration: 900,

					onPageTransitionOut:       function(callback) {
						this.fadeTo('fast', 0.0, callback);
					},
					onPageTransitionIn:        function() {
						this.fadeTo('fast', 1.0);
					}
				});
			});
		</script>














";
  return $result;
?>