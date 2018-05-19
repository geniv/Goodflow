<?php
  return
  "
                      {$this->var->jazyk["del"]} {$this->var->jazyk["zam_vzdelani"]}: $data->vzdelani ?<br />
                      <form action=\"\" method=\"post\">
                          <fieldset>
                            <input type=\"hidden\" name=\"delvzde\" value=\"$data->vzdelani\" />
                            <input type=\"submit\" name=\"ano\" value=\"{$this->var->jazyk["ano"]}\" />
                            <input type=\"submit\" name=\"ne\" value=\"{$this->var->jazyk["ne"]}\" />
                          </fieldset>
                        </form>
  ";
?>
