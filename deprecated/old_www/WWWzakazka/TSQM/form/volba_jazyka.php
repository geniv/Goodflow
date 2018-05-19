<?php //nastaveni_jazyka
  return
  "\n<div id='nastaveni_jazyka'>\n<form action='' method='get'>\n<fieldset>\n<dl>\n<dd class='prvni_dd'>\n<select name='language'>\n<option value='czech' {$ces[0]}>{$this->var->jazyk["cz"]}</option>\n<option value='deutsch' {$ces[1]}>{$this->var->jazyk["de"]}</option>\n</select>\n</dd>\n<dd class='druhy_dd'>\n<input type='submit' name='setlang' value='{$this->var->jazyk["nastav_jazyk"]}' />\n</dd>\n</dl>\n<input type='hidden' name='action' value='{$_GET["action"]}' />\n<input type='hidden' name='akce' value='{$_GET["akce"]}' />\n</fieldset>\n</form>\n</div>";
/*
  return
  "
            <div class=\"nastaveni_jazyka\">
              <form action=\"\" method=\"get\">
                <fieldset>
                  <select name=\"language\">
                    <option value=\"czech\" {$ces[0]}>{$this->var->jazyk["cz"]}</option>
                    <option value=\"deutsch\" {$ces[1]}>{$this->var->jazyk["de"]}</option>
                  </select>
                  <input type=\"submit\" name=\"setlang\" value=\"{$this->var->jazyk["nastav_jazyk"]}\" />
                </fieldset>
              </form>
            </div>
  ";*/
?>
