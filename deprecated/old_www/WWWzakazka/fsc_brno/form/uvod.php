<?php
  return
  "
<div id=\"uvodni_strana\">
  <h1>FSC TECHNIKA BRNO <span>ODDÍL KRASOBRUSLENÍ</span></h1>
  <p>
    {$this->VypisTextuSekce("uvod1")}
  </p>
  <div id=\"rozcestnik\">
    <div class=\"obal_dve_polozky\">
      <p id=\"polozka_1\" class=\"left\">
        <a href=\"#\" onclick=\"AjaxStranka('team', '');\" title=\"\">
          <span class=\"nadpis\"></span>
          <span class=\"obrazek\"></span>
        </a>
        <a href=\"#\" onclick=\"AjaxStranka('team', '');\" title=\"\">Team Moravia B</a> {$this->VypisTextuSekce("uvod2")} <a href=\"#\" onclick=\"AjaxStranka('team', '');\" title=\"\" class=\"tucne\">»</a>
      </p>
      <p id=\"polozka_2\" class=\"right\">
        <a href=\"#\" onclick=\"AjaxStranka('solo', '');\" title=\"\">
          <span class=\"nadpis\"></span>
          <span class=\"obrazek\"></span>
        </a>
        {$this->VypisTextuSekce("uvod3")} <a href=\"#\" onclick=\"AjaxStranka('solo', '');\" title=\"\" class=\"tucne\">»</a>
      </p>
    </div>
    <div class=\"obal_dve_polozky odsazeni\">
      <p id=\"polozka_3\" class=\"left\">
        <a href=\"#\" onclick=\"AjaxStranka('hokej', '');\" title=\"\">
          <span class=\"nadpis\"></span>
          <span class=\"obrazek\"></span>
        </a>
        {$this->VypisTextuSekce("uvod4")} <a href=\"#\" onclick=\"AjaxStranka('hokej', '');\" title=\"\" class=\"tucne\">»</a>
      </p>
      <p id=\"polozka_4\" class=\"right\">
        <a href=\"#\" onclick=\"AjaxStranka('kurzy', '');\" title=\"\">
          <span class=\"nadpis\"></span>
          <span class=\"obrazek\"></span>
        </a>
        <a href=\"#\" onclick=\"AjaxStranka('kurzy', '');\" title=\"\">Kurzy bruslení</a> {$this->VypisTextuSekce("uvod5")} <a href=\"#\" onclick=\"AjaxStranka('kurzy', '');\" title=\"\" class=\"tucne\">»</a>
      </p>
    </div>
  </div>
</div>
  ";
?>
