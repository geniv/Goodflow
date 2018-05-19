<?php
  return
  "
<h2></h2>
<div>
  <a href=\"#\" class=\"zavrit_sekci\" title=\"Zavřít sekci\" onclick=\"AjaxStranka(''); return false;\"><span>Zavřít sekci</span></a>
  <h1>Listina výher</h1>
  <h4>Aktuální listina výher pro tento měsíc</h4>

  <p id=\"bonus_text\">Bonus výhra pro tento měsíc</p>
  <p id=\"bonus_text_maly\">(Tuto bonusovou cenu získá soutěžící při poskládání symbolů 3xBONUS na výherních válcích.)<p>

  {$this->var->main->VypisVyhry()}

  <a href=\"#\" class=\"zavrit_sekci_pravidla spodek\" title=\"Zavřít sekci\" onclick=\"AjaxStranka(''); location.href='#'; return false;\"><span>Zavřít sekci</span></a>
</div>
<h3 class=\"pravidla_bottom\"></h3>
  ";

/*
<ul class=\"listina_vyher listina_bonus\">
    <li class=\"popis_text_vyhry\"><br /><br /><br /><span>LCD TV Full HD</span> <span>SAMSUNG LE40A756</span></li>
    <li class=\"obrazek_vyhry\"><img src=\"obr/vyhry/vyhra_bonus.png\" alt=\"Autorádio Kenwood KDC-W3037A - AUTOSHOP, Břeclav\" /></li>
    <li class=\"informace_o_zbozi_vyhry\"><br /><br /><br />Samsung</li>
  </ul>

  <ul class=\"listina_vyher\">
    <li class=\"popis_text_vyhry\"><br />Autorádio Kenwood KDC-W3037A</li>
    <li class=\"obrazek_vyhry\"><img src=\"obr/vyhry/vyhra_001.png\" alt=\"Autorádio Kenwood KDC-W3037A - AUTOSHOP, Břeclav\" /></li>
    <li class=\"informace_o_zbozi_vyhry\"><br />AUTOSHOP, Břeclav</li>
  </ul>

  <ul class=\"listina_vyher\">
    <li class=\"popis_text_vyhry\"><br /><br /><br /><span>Dárková poukázka v hodnotě 4.000,-</span> <span>na ubytování, stravu a rybolov</span></li>
    <li class=\"obrazek_vyhry\"><img src=\"obr/vyhry/vyhra_002.png\" alt=\"Autorádio Kenwood KDC-W3037A - AUTOSHOP, Břeclav\" /></li>
    <li class=\"informace_o_zbozi_vyhry\"><br /><br /><br /><span>KD system s.r.o.</span> <span>Rybník Balaton - Brno</span></li>
  </ul>

  <ul class=\"listina_vyher\">
    <li class=\"popis_text_vyhry\"><br /><br /><br /><br /><span>Notebook HP Pavilion DV5-1115</span> <span>RM72/2GB 250GB 15.4WXGABV</span><span>DVD±RW LS/WiFi/BT/VHP</span></li>
    <li class=\"obrazek_vyhry\"><img src=\"obr/vyhry/vyhra_003.png\" alt=\"Autorádio Kenwood KDC-W3037A - AUTOSHOP, Břeclav\" /></li>
    <li class=\"informace_o_zbozi_vyhry\"><br /><br /><br /><br /><br />Hawlett - Packard</li>
  </ul>

  <ul class=\"listina_vyher\">
    <li class=\"popis_text_vyhry\"><br /><br /><br />SONY PSP - PlayStation Portable3004</li>
    <li class=\"obrazek_vyhry\"><img src=\"obr/vyhry/vyhra_004.png\" alt=\"Autorádio Kenwood KDC-W3037A - AUTOSHOP, Břeclav\" /></li>
    <li class=\"informace_o_zbozi_vyhry\"><br /><br /><br />MeximONE s.r.o.</li>
  </ul>

  <ul class=\"listina_vyher\">
    <li class=\"popis_text_vyhry\"><br /><span>Poukázka na nákup v hodnotě 4 x 500,- Kč</span> <span>po celé ČR v prodejnách Hervis sport</span></li>
    <li class=\"obrazek_vyhry\"><img src=\"obr/vyhry/vyhra_005.png\" alt=\"Autorádio Kenwood KDC-W3037A - AUTOSHOP, Břeclav\" /></li>
    <li class=\"informace_o_zbozi_vyhry\"><br />Hervis Sport</li>
  </ul>

*/
?>
