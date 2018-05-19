<?php
  return
  "
  <div id=\"admin_reklamni_text\">
    <h1>Administrace reklamního textu</h1>
    <p>Zde můžete měnit zobrazení reklamní lišty a upravovat reklamní text</p>
    <p class=\"celkem_navstev_pocitadla\">
      Zobrazení reklamní lišty: <input type=\"checkbox\" disabled=\"disabled\"".($this->var->main->VypisTexty("rekl_text_on") == 1 ? " checked=\"checked\"" : "")." /> <a href=\"#\" onclick=\"PoslatAkci('edittexbool&amp;var=rekl_text_on&amp;info=Zobrazení reklamní lišty:&amp;out=info_rekl', 0, 'info_rekl'); return false;\" title=\"Nastavit zobrazení\">Nastavit zobrazení</a>
    </p>
    <div class=\"reklama_bezici_text\">
      <p class=\"jezdici_text\">
        {$this->var->main->VypisTexty("rekl_text1")}
      </p>
    </div>
    <a href=\"#\" onclick=\"PoslatAkci('edittex&amp;var=rekl_text1&amp;info=Upravit reklamní text:&amp;out=info_rekl', 0, 'info_rekl'); return false;\" title=\"Upravit reklamní text\">
      Upravit reklamní text
    </a>
    <div class=\"reklama_bezici_text\">
      <p class=\"jezdici_text\">
        {$this->var->main->VypisTexty("rekl_text2")}
      </p>
    </div>
    <a href=\"#\" onclick=\"PoslatAkci('edittex&amp;var=rekl_text2&amp;info=Upravit reklamní text:&amp;out=info_rekl', 0, 'info_rekl'); return false;\" title=\"Upravit reklamní text\">
      Upravit reklamní text
    </a>
    <div class=\"reklama_bezici_text\">
      <p class=\"jezdici_text\">
        {$this->var->main->VypisTexty("rekl_text3")}
      </p>
    </div>
    <a href=\"#\" onclick=\"PoslatAkci('edittex&amp;var=rekl_text3&amp;info=Upravit reklamní text:&amp;out=info_rekl', 0, 'info_rekl'); return false;\" title=\"Upravit reklamní text\">
      Upravit reklamní text
    </a>
    <div class=\"reklama_bezici_text\">
      <p class=\"jezdici_text\">
        {$this->var->main->VypisTexty("rekl_text4")}
      </p>
    </div>
    <a href=\"#\" onclick=\"PoslatAkci('edittex&amp;var=rekl_text4&amp;info=Upravit reklamní text:&amp;out=info_rekl', 0, 'info_rekl'); return false;\" title=\"Upravit reklamní text\">
      Upravit reklamní text
    </a>
    <div class=\"reklama_bezici_text\">
      <p class=\"jezdici_text\">
        {$this->var->main->VypisTexty("rekl_text5")}
      </p>
    </div>
    <a href=\"#\" onclick=\"PoslatAkci('edittex&amp;var=rekl_text5&amp;info=Upravit reklamní text:&amp;out=info_rekl', 0, 'info_rekl'); return false;\" title=\"Upravit reklamní text\">
      Upravit reklamní text
    </a>
  <div id=\"info_rekl\"></div>
</div>
  ";
?>
