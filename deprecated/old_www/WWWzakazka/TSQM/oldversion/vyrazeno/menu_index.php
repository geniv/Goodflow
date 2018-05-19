<?php
  return
  "
            <div class=\"menu_index\">
              <div class=\"obal_odstavcu\">
                <p>
                  ".($this->PristupOdkaz("uvod") ? "<a href=\"?action=uvod\" title=\"{$this->var->jazyk["uvod"]}\">{$this->var->jazyk["uvod"]}</a>" : "")."
                </p>
                <p>
                  ".($this->PristupOdkaz("zamestnanci") ? "<a href=\"?action=zamestnanci\" title=\"{$this->var->jazyk["zamestnanci"]}\">{$this->var->jazyk["zamestnanci"]}</a>" : "")."
                </p>
                <p>
                  ".($this->PristupOdkaz("partneri") ? "<a href=\"?action=partneri\" title=\"{$this->var->jazyk["partneri"]}\">{$this->var->jazyk["partneri"]}</a>" : "")."
                </p>
                <p>
                  ".($this->PristupOdkaz("zakaznici") ? "<a href=\"?action=zakaznici\" title=\"{$this->var->jazyk["zakaznici"]}\">{$this->var->jazyk["zakaznici"]}</a>" : "")."
                </p>
                <p>
                  ".($this->PristupOdkaz("management") ? "<a href=\"?action=management\" title=\"{$this->var->jazyk["management"]}\">{$this->var->jazyk["management"]}</a>" : "")."
                </p>
                <p>
                  ".($this->PristupOdkaz("procesy") ? "<a href=\"?action=procesy\" title=\"{$this->var->jazyk["procesy"]}\">{$this->var->jazyk["procesy"]}</a>" : "")."
                </p>
                <p>
                  ".($this->PristupOdkaz("terminy") ? "<a href=\"?action=terminy\" title=\"{$this->var->jazyk["terminy"]}\">{$this->var->jazyk["terminy"]}</a>" : "")."
                </p>
                <p>
                  ".($this->PristupOdkaz("archiv") ? "<a href=\"?action=archiv\" title=\"{$this->var->jazyk["archiv"]}\">{$this->var->jazyk["archiv"]}</a>" : "")."
                </p>
                <p>
                  ".($this->PristupOdkaz("admin") ? "<a href=\"?action=admin\" title=\"{$this->var->jazyk["admin"]}\">{$this->var->jazyk["admin"]}</a>" : "")."
                </p>
                <p>
                  <a href=\"http://www.tsqm.org\" title=\"{$this->var->jazyk["home"]}\">{$this->var->jazyk["home"]}</a>
                </p>
              </div>
            </div>
  ";
?>
