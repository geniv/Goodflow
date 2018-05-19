<?php
  return
  "
                      {$this->var->jazyk["del"]} {$this->var->jazyk["zam_prava"]}: $data->prava ?<br />
                      <form action=\"\" method=\"post\">
                          <fieldset>
                            <input type=\"hidden\" name=\"delprava\" value=\"$data->prava\" />
                            <input type=\"submit\" name=\"ano\" value=\"{$this->var->jazyk["ano"]}\" />
                            <input type=\"submit\" name=\"ne\" value=\"{$this->var->jazyk["ne"]}\" />
                          </fieldset>
                        </form>";
?>
