<?php
  return
  "
                      {$this->var->jazyk["edit"]} {$this->var->jazyk["zam_jazyk"]} & {$this->var->jazyk["zam_matjazyk"]}:<br />
                      <form action=\"\" method=\"post\">
                        <fieldset>
                          <input type=\"text\" name=\"editjazyk\" value=\"$data->jazyk\" /><br />
                          <input type=\"submit\" name=\"tlacitko\" value=\"{$this->var->jazyk["edit"]}\" />
                        </fieldset>
                      </form>
  ";
?>
