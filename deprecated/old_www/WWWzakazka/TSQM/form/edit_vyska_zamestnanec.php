<?php
  return
  "
                      {$this->var->jazyk["edit"]} {$this->var->jazyk["zam_obor"]}:<br />
                      <form action=\"\" method=\"post\">
                        <fieldset>
                          <input type=\"text\" name=\"editvyska\" value=\"$data->typ\" /><br />
                          <input type=\"submit\" name=\"tlacitko\" value=\"{$this->var->jazyk["edit"]}\" />
                        </fieldset>
                      </form>
  ";
?>
