<?php
  $absolute_url = $this->var->absolutni_url;
  //$sekceamp = $this->var->main[0]->NactiFunkci("DynamicConfig", "ObjectConfigGroup", "sekce-amp");
  //$nazvysekci = $this->var->main[0]->NactiFunkci("DynamicConfig", "ObjectConfigGroup", "nazvy-sekci", true);
  //$ampobsah = $this->var->main[0]->NactiFunkci("DynamicCentral", "Central", array("adresa" => "amp-obsah", "tvar" => "amp-obsah"));



$pulsteam = $this->var->main[0]->NactiFunkci("DynamicCentral", "Central", array("adresa" => "pulsteam", "tvar" => "pulsteam"));



  $result =
  "



<script type=\"text/javascript\" src=\"{$absolute_url}script/jquery/jquery.galleriffic.puls.js\"></script>








<div id=\"obal_pulsteam\">










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
{$pulsteam}





					</ul>
				</div>











		<script type=\"text/javascript\">
			jQuery(document).ready(function($) {




				var gallery = $('#thumbs').galleriffic({
					delay:                     2500,
					numThumbs:                 15,
					preloadAhead:              10,
					enableTopPager:            false,
					enableBottomPager:         false,
					maxPagesToShow:            7,
					imageContainerSel:         '#slideshow',
					controlsContainerSel:      '#controls',
					captionContainerSel:       '#caption',
					loadingContainerSel:       '#loading',
					renderSSControls:          false,
					renderNavControls:         false,
					playLinkText:              'Play Slideshow',
					pauseLinkText:             'Pause Slideshow',
					prevLinkText:              '&lsaquo; Previous Photo',
					nextLinkText:              'Next Photo &rsaquo;',
					nextPageLinkText:          'Next &rsaquo;',
					prevPageLinkText:          '&lsaquo; Prev',
					enableHistory:             false,
					autoStart:                 false,
					syncTransitions:           true,
					defaultTransitionDuration: 900,



				});
			});
		</script>

















</div>







";
  return $result;
?>