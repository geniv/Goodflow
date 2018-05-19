<?php
  return
  "
                      {$this->var->jazyk["edit"]} {$this->var->jazyk["zam_hobby"]}:<br />
                      <form action=\"\" method=\"post\">
                        <fieldset>
                          <input type=\"text\" name=\"edithobby\" value=\"$data->hobby\" /><br />
                          <input type=\"submit\" name=\"tlacitko\" value=\"{$this->var->jazyk["edit"]}\" />
                        </fieldset>
                      </form>
  ";
?>
