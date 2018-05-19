<?php
  return
  "
                {$this->var->jazyk["add"]} {$this->var->jazyk["zam_jazyk"]} & {$this->var->jazyk["zam_matjazyk"]}:<br />
                <form action=\"\" method=\"post\">
                  <fieldset>
                    <input type=\"text\" name=\"addjazyk\" /><br />
                    <input type=\"submit\" name=\"tlacitko\" value=\"{$this->var->jazyk["add"]}\" />
                  </fieldset>
                </form>
  ";
?>
