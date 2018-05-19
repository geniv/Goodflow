<?php
  return
  "
                      {$this->var->jazyk["del"]} {$this->var->jazyk["zam_hobby"]}: $data->hobby ?<br />
                      <form action=\"\" method=\"post\">
                          <fieldset>
                            <input type=\"hidden\" name=\"delhobby\" value=\"$data->hobby\" />
                            <input type=\"submit\" name=\"ano\" value=\"{$this->var->jazyk["ano"]}\" />
                            <input type=\"submit\" name=\"ne\" value=\"{$this->var->jazyk["ne"]}\" />
                          </fieldset>
                        </form>
  ";
?>
