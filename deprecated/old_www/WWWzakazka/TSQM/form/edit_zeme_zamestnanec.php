<?php
  return
  "
                      {$this->var->jazyk["edit"]} {$this->var->jazyk["zam_zeme"]}:<br />
                      <form action=\"\" method=\"post\">
                        <fieldset>
                          <input type=\"text\" name=\"editzeme\" value=\"$data->zeme\" /><br />
                          <input type=\"submit\" name=\"tlacitko\" value=\"{$this->var->jazyk["edit"]}\" />
                        </fieldset>
                      </form>
  ";
?>
