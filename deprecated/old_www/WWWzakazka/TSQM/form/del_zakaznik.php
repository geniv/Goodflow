<?php
  return
  "
                      {$this->var->jazyk["del_zakaznik"]}: $data->nazev ?<br />
                      <form action=\"\" method=\"post\">
                          <fieldset>
                            <input type=\"submit\" name=\"ano\" value=\"{$this->var->jazyk["ano"]}\" />
                            <input type=\"submit\" name=\"ne\" value=\"{$this->var->jazyk["ne"]}\" />
                          </fieldset>
                        </form>
  ";
?>
