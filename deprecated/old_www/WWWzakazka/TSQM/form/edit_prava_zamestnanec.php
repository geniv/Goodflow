<?php
  return
  "
                      {$this->var->jazyk["edit"]} {$this->var->jazyk["zam_prava"]}:<br />
                      <form action=\"\" method=\"post\">
                        <fieldset>
                          <input type=\"text\" name=\"editprava\" value=\"$data->prava\" /><br />
                          <input type=\"submit\" name=\"tlacitko\" value=\"{$this->var->jazyk["edit"]}\" />
                        </fieldset>
                      </form>";
?>
