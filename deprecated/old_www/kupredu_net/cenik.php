<?php
  return
  "
    <span class=\"nadpis_cenik\"></span>

    <p class=\"uvodni_text\">
      Tarify bez agregace
   </p>

<div id=\"cenik_bez_agregace\">

  <span class=\"hlavicka\"></span>
  {$this->var->main->VypisBezAgregace()}
  <span class=\"paticka\"></span>
</div>

<p class=\"poznamka\">
      *Podmínkou je využití technologie přípojky 5GHz
   </p>

<p class=\"uvodni_text\">
      Tarify s agregací
   </p>

<div id=\"cenik_s_agregaci\">

  <span class=\"hlavicka\"></span>
  {$this->var->main->VypisSAgregaci()}
  <span class=\"paticka\"></span>
</div>

  ";
/*
 <ul>
  <li class=\"rychlost\">400 Kbit/s</li>
  <li class=\"cena\">99 Kč</li>
  <li class=\"tarif\">Meloun</li>
 </ul>

  <ul>
  <li class=\"rychlost\">700 Kbit/s</li>
  <li class=\"cena\">200 Kč</li>
  <li class=\"tarif\">Broskev</li>
 </ul>

  <ul>
  <li class=\"rychlost\">800 Kbit/s</li>
  <li class=\"cena\">256 Kč</li>
  <li class=\"tarif\">Jahoda</li>
 </ul>

  <ul>
  <li class=\"rychlost\">1,1 Mbit/s</li>
  <li class=\"cena\">401 Kč</li>
  <li class=\"tarif\">Vanilka</li>
 </ul>

  <ul>
  <li class=\"rychlost\">1,6 Mbit/s</li>
  <li class=\"cena\">601 Kč</li>
  <li class=\"tarif\">Lesní plody</li>
 </ul>

 <ul>
  <li class=\"rychlost\">2,1 Mbit/s</li>
  <li class=\"cena\">801 Kč</li>
  <li class=\"tarif\">Malina</li>
 </ul>

<ul>
  <li class=\"rychlost\">11 Mbit/s</li>
  <li class=\"agregace\">1:20</li>
  <li class=\"cena\">256 Kč</li>
  <li class=\"tarif\">Paprička</li>
 </ul>

  <ul>
  <li class=\"rychlost\">11 Mbit/s</li>
  <li class=\"agregace\">1:10</li>
  <li class=\"cena\">401 Kč</li>
  <li class=\"tarif\">Chili paprička</li>
 </ul>
*/
?>
