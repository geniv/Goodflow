<?php
  return
  "
                      {$this->var->jazyk["del"]} {$this->var->jazyk["zam_status"]}: $data->status ?<br />
                      <form action=\"\" method=\"post\">
                          <fieldset>
                            <input type=\"hidden\" name=\"delstat\" value=\"$data->status\" />
                            <input type=\"submit\" name=\"ano\" value=\"{$this->var->jazyk["ano"]}\" />
                            <input type=\"submit\" name=\"ne\" value=\"{$this->var->jazyk["ne"]}\" />
                          </fieldset>
                        </form>
  ";
?>
