<?php
  if (!Empty($this->var->cislosekce))
  {
    $text =
    "
    aktuální sekce: {$this->VypisSekciGrafikaText($this->var->cislosekce)}";
    $nadp = " - {$this->VypisSekciGrafikaText($this->var->cislosekce)}";
  }
    else
  {
    $text =
    "rozcestník:<br/>";

    for ($i = 1; $i < count($this->var->sekce) + 1; $i++)
    {
      $text .= "<a href=\"#\" onclick=\"AjaxStranka('grafika', '{$i}', '', '');\"\">{$this->var->sekce[$i]}</a><br/>
      {$this->VypisRozcesti($i)}<br />";
    }

    $nadp = "";
  }

  return
  "
  <h2>
    Grafika {$nadp}
  </h2>
  <p class=\"uvodni_text\">
    {$this->TextSekce("grafika")}
  </p>
  <br />
  {$text}
  <br/>
  {$this->VypisGrafiky($this->var->cislosekce)}
  ";
?>
