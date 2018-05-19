<?php
  $znaky = (!Empty($_POST["tlacitko"]) ? $_POST["znaky"] : "%%");
  $od = (!Empty($_POST["tlacitko"]) ? $_POST["od"] : 1);
  $do = (!Empty($_POST["tlacitko"]) ? $_POST["do"] : 20);
  echo "
  <form method=\"post\">
    <fieldset>
      <input type=\"text\" name=\"znaky\" value=\"{$znaky}\" />
      <input type=\"text\" name=\"od\" value=\"{$od}\" />
      <input type=\"text\" name=\"do\" value=\"{$do}\" />
      <input type=\"submit\" name=\"tlacitko\" />
    </fieldset>
  </form>
  <hr />";

  for ($i = $od; $i <= $do; $i++)
  {
    echo "{$znaky}{$i}{$znaky}<br />\n";
  }
?>
