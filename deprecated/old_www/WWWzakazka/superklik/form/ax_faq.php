<?php
  return
  "
<h2></h2>
<div id=\"div_faq\">
  <a href=\"#\" class=\"zavrit_sekci\" title=\"Zavřít sekci\" onclick=\"AjaxStranka(''); return false;\"><span>Zavřít sekci</span></a>
  <h1>FAQ - otázky a odpovědi</h1>

  {$this->var->main->VypisFAQ()}

  <a href=\"#\" class=\"zavrit_sekci_pravidla spodek\" title=\"Zavřít sekci\" onclick=\"AjaxStranka(''); location.href='#'; return false;\"><span>Zavřít sekci</span></a>
</div>
<h3 class=\"pravidla_bottom\"></h3>
  ";

/*
<h4>Technické otázky</h4>
  <p>
    <em class=\"ikona_otazka\"></em> <strong class=\"otazka\">Otázka:</strong> Nezobrazuje si mi úvodní animace ve flashi a nelze dále procházet stránkami.
  </p>
  <p>
    <em class=\"ikona_odpoved\"></em> <strong class=\"odpoved\">Odpověď:</strong> Váš webový prohlížeč zřejmě neobsahuje nainstalovanou/aktuální verzi flash v.9.0 a vyšší. Pro odstranění tohoto problému musíte nainstalovat <a href=\"\" title=\"\">Micromedia Flash Player</a>, nebo zkontrolujte zda je povolen flash ve vašem prohlížeči.
  </p>
  <span class=\"linka\"></span>
  <p>
    <em class=\"ikona_otazka\"></em> <strong class=\"otazka\">Otázka:</strong> Pro jaké verze internetového prohlížeče je optimalizován ?
  </p>
  <p>
    <em class=\"ikona_odpoved\"></em> <strong class=\"odpoved\">Odpověď:</strong> Internet Explorer 6, Internet Explorer 7, Firefox 2, Firefox 3, Opera, Safari, ostatní prohlížeče založené na jádru Gecko.
  </p>
  <span class=\"linka\"></span>
  <p>
    <em class=\"ikona_otazka\"></em> <strong class=\"otazka\">Otázka:</strong> Po klepnutí na odkaz se nic nezobrazí, co mám dělat ?
  </p>
  <p>
    <em class=\"ikona_odpoved\"></em> <strong class=\"odpoved\">Odpověď:</strong> Zkontrolujte zda má Váš Internetový prohlížeč zapnutou funkci JAVAScriptu.
  </p>



  <h4 class=\"vetsi_odsazeni\">Soutěžní dotazy:</h4>
  <p>
    <em class=\"ikona_otazka\"></em> <strong class=\"otazka\">Otázka:</strong> Mohu zkusit své štěstí vícekrát za den ?
  </p>
  <p>
    <em class=\"ikona_odpoved\"></em> <strong class=\"odpoved\">Odpověď:</strong> Ne, systém výher je nastaven pro každého uživatele pouze na jeden pokus za den. Systém kontroluje a zamezuje přihlášení stejného uživatele pomocí kontroly IP adresy a ID prohlížeče.
  </p>
  <span class=\"linka\"></span>
  <p>
    <em class=\"ikona_otazka\"></em> <strong class=\"otazka\">Otázka:</strong> Pokud vyhraji, bude mi cena za výhru zaslána ?
  </p>
  <p>
    <em class=\"ikona_odpoved\"></em> <strong class=\"odpoved\">Odpověď:</strong> Ano, vše bude doručeno poštovní dobírkou České pošty dle zadaných registračních údajů.
  </p>
*/
?>
