<?php
  return
  "
                      {$this->var->jazyk["edit"]} {$this->var->jazyk["zam_vzdelani"]}:<br />
                      <form action=\"\" method=\"post\">
                        <fieldset>
                          <input type=\"text\" name=\"editvzde\" value=\"$data->vzdelani\" /><br />
                          <input type=\"submit\" name=\"tlacitko\" value=\"{$this->var->jazyk["edit"]}\" />
                        </fieldset>
                      </form>
  ";
?>
