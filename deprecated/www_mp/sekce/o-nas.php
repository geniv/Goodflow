<?php
  $absolute_url = $this->var->absolutni_url;
  $nazvysekci = $this->var->main[0]->NactiFunkci("DynamicConfig", "ObjectConfigGroup", "nazvy-sekci", true);
  $onasrozcestnik = $this->var->main[0]->NactiFunkci("DynamicCentral", "CentralMenuObsah", array("adresa" =>  "o-nas-rozcestnik", "pridavek_obal" => array("nazevsekceonas" => $nazvysekci->nazev_sekce_o_nas), "baseurl" => "o-nas/", "tvar" => "o-nas-obsah"));
  $onasfotky = $this->var->main[0]->NactiFunkci("DynamicCentral", "Central", array("adresa" => "o-nas-fotky", "tvar" => "o-nas-fotky", "skryvat" => true));
/*
<a href=\"{$absolute_url}bukake30a.jpg\" class=\"highslide\" title=\"bukake30a\" onclick=\"return hs.expand(this, config1 )\">
<img src=\"{$absolute_url}bukake30b_a.png\" alt=\"\" />
</a>
<a href=\"{$absolute_url}bukake06a.jpg\" class=\"highslide\" title=\"bukake06a\" onclick=\"return hs.expand(this, config1 )\">
<img src=\"{$absolute_url}bukake06b.png\" alt=\"\" />
</a>
<a href=\"{$absolute_url}bukake31b.jpg\" class=\"highslide\" title=\"bukake31b\" onclick=\"return hs.expand(this, config1 )\">
<img src=\"{$absolute_url}bukake31a.png\" alt=\"\" />
</a>
<a href=\"{$absolute_url}bukake29a.jpg\" class=\"highslide\" title=\"bukake29a\" onclick=\"return hs.expand(this, config1 )\">
<img src=\"{$absolute_url}bukake29b.png\" alt=\"\" />
</a>
<a href=\"{$absolute_url}bukake25a.jpg\" class=\"highslide\" title=\"bukake25a\" onclick=\"return hs.expand(this, config1 )\">
<img src=\"{$absolute_url}bukake25b.png\" alt=\"\" />
</a>
<a href=\"{$absolute_url}bukake24a.jpg\" class=\"highslide\" title=\"bukake24a\" onclick=\"return hs.expand(this, config1 )\">
<img src=\"{$absolute_url}bukake24b.png\" alt=\"\" />
</a>
<a href=\"{$absolute_url}bukake10a.jpg\" class=\"highslide\" title=\"bukake10a\" onclick=\"return hs.expand(this, config1 )\">
<img src=\"{$absolute_url}bukake10b.png\" alt=\"\" />
</a>
<a href=\"{$absolute_url}o-nas/bc-ales-durdak\" title=\"Bc. Aleš Durďák\">
<span class=\"foto_sprit\" style=\"background-image: url({$absolute_url}fotka_onas_ales.png);\"><!-- --></span>
<strong>Bc. Aleš Durďák</strong>
</a>
<a href=\"{$absolute_url}o-nas/bc-filip-turecky\" title=\"Bc. Filip Turecký\">
<span class=\"foto_sprit\" style=\"background-image: url({$absolute_url}fotka_onas_filip.png);\"><!-- --></span>
<strong>Bc. Filip Turecký, MSc.</strong>
</a>
<a href=\"{$absolute_url}o-nas/roman-janal\" title=\"Roman Janál\">
<span class=\"foto_sprit\" style=\"background-image: url({$absolute_url}fotka_onas_roman.png);\"><!-- --></span>
<strong>Roman Janál</strong>
</a>
<a href=\"{$absolute_url}o-nas/marek-manasek\" title=\"Marek Maňásek\">
<span class=\"foto_sprit\" style=\"background-image: url({$absolute_url}fotka_onas_marek.png);\"><!-- --></span>
<strong>Marek Maňásek</strong>
</a>
Central($adresa, $baseurl = "", $skryvat = false, $pridavek = NULL, $strankovani = NULL, $tvar = 1)
Central($adresa, "", true, NULL, NULL, (Empty($_GET["menu"]) ? 1 : 2))
*/
  $result =
  "<script type=\"text/javascript\" src=\"{$absolute_url}script/highslide/highslide-with-gallery.min.js\"></script>
<script type=\"text/javascript\" src=\"{$absolute_url}script/highslide/highslide.config.js\"></script>
<script type=\"text/javascript\">
  hs.graphicsDir = '{$absolute_url}obr/highslide/';
</script>
{$onasrozcestnik}
  <div id=\"obal_kdo_jsme_fotky\" class=\"highslide-gallery\">
{$onasfotky}
  </div>
</div>\n";
  return $result;
?>