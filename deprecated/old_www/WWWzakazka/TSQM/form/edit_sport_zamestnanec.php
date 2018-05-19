<?php
  return
  "
                      {$this->var->jazyk["edit"]} {$this->var->jazyk["zam_sport"]}:<br />
                      <form action=\"\" method=\"post\">
                        <fieldset>
                          <input type=\"text\" name=\"editsport\" value=\"$data->sport\" /><br />
                          <input type=\"submit\" name=\"tlacitko\" value=\"{$this->var->jazyk["edit"]}\" />
                        </fieldset>
                      </form>
  ";
?>
