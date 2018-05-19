<?php
  return
  "
                      {$this->var->jazyk["del"]} {$this->var->jazyk["zam_jazyk"]} & {$this->var->jazyk["zam_matjazyk"]}: $data->jazyk ?<br />
                      <form action=\"\" method=\"post\">
                          <fieldset>
                            <input type=\"hidden\" name=\"deljazyk\" value=\"$data->jazyk\" />
                            <input type=\"submit\" name=\"ano\" value=\"{$this->var->jazyk["ano"]}\" />
                            <input type=\"submit\" name=\"ne\" value=\"{$this->var->jazyk["ne"]}\" />
                          </fieldset>
                        </form>
  ";
?>
