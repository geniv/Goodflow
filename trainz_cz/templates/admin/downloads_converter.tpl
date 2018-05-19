{code}//<?
  $code = <<<F
        <fieldset class="mws-form-inline">
          <legend>Převodník kuid formátů z configu / původních stránek / Trainz agent / TOZ maps</legend>
          <div class="mws-form-row">
            <label class="mws-form-label">Převodník vstup/výstup</label>
            <div class="mws-form-item">
              <div class="grid_4">
                {textarea:vstup|$|class|:|large|,|rows|:|30|@|filled|:|Pole nebylo vyplněno!}
              </div>
              <div class="grid_4">
                {textarea:vystup|$|readonly|,|class|:|large|,|rows|:|30}
              </div>
            </div>
          </div>
        </fieldset>
        <div class="mws-button-row">
          {submit:;Převést|$|class|:|btn btn-small btn-primary btn-primary18}
        </div>
F;

  // samotne konvertovani
  function convert($values, &$pocet = null) {
    $result = null;
    if (isset($values['vstup'])) {
      // konverze z kuid_xxx_yyy
      if (preg_match_all('/kuid[2]?_-?[0-9]+_[0-9]+(?:_[0-9]+)?/', $values['vstup'], $m)) {
        $values['vstup'] = implode(PHP_EOL, array_map(function($v) {
            return str_replace(array('kuid2', 'kuid', '_'), array('', '', ':'), strtolower($v));
          }, $m[0]));
      }

      if (preg_match_all('/[a-zA-Z]{4}2?:-?[0-9]+:[0-9]+(?::[0-9]+)?/', $values['vstup'], $m)) {
        //~ var_dump($m);
        $values['vstup'] = implode(PHP_EOL, array_map(function($v) {
            if (substr_count(strtolower($v), 'kuid2:') == 1) {
              return substr($v, 6); // kuid2
            } else {
              return substr($v, 5); // kuid
            }
          }, $m[0]));
      }

      if (preg_match_all('/-?[0-9]+:[0-9]+(?::[0-9]+)?/', $values['vstup'], $m)) {
        //~ var_dump(array_filter(explode("\r\n", $values['vstup'])));
        $pocet = array(
            'vstup' => count(array_filter(explode(PHP_EOL, $values['vstup']),  function($v) { return $v != "\n" && $v != "\r" && $v != '';})),
            'vystup' => count($m[0]),
          );
        $result = implode(PHP_EOL, $m[0]);
      }
    }
    return $result;
  }

  $f = classes\TplForm::compile($code, array('class' => 'mws-form'));
  $f->setReturnValues($_POST, array('vystup'))
    ->setReturnValues(array('vystup' => convert($_POST, $pocet)));
  $f_render = $f->render();
{/code}

  <div class="grid_8 mws-panel mws-tree-navigace-noaddbtn">
    <div class="mws-panel-header mws-panel-header-normal">
      <span class="nazevpolozky">Převodník kuidů</span>
    </div>
    <div class="mws-panel-body no-padding">
{if="$f->isSuccess()"}
    <div class="mws-form-message info">Převod byl proveden! Počet řádku na vstupu: <strong>{$pocet.vstup ?: 0}</strong>, Počet řádku na výstupu: <strong>{$pocet.vystup ?: 0}</strong></div>
{/if}
{if="$f->isErrors()"}
  {loop="$f->getErrors()"}
    <div class="mws-form-message warning">{$value}</div>
  {/loop}
{/if}
      {$f_render}
    </div>
  </div>