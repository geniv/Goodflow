<?php
  return
  "
                      {$this->var->jazyk["edit"]} {$this->var->jazyk["zam_status"]}:<br />
                      <form action=\"\" method=\"post\">
                        <fieldset>
                          <input type=\"text\" name=\"editstat\" value=\"$data->status\" /><br />
                          <input type=\"submit\" name=\"tlacitko\" value=\"{$this->var->jazyk["edit"]}\" />
                        </fieldset>
                      </form>
  ";
?>
