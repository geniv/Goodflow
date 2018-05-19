{code}//<?
  $form = <<<F
  {textarea:vstup|$|rows|:|40|,|cols|:|70|@|filled|:|že by jsi nic nezadal?}
  {label:pocet}<br />
  {textarea:vystup|$|readonly|,|rows|:|40|,|cols|:|70}
  <br />
  {submit:;Parsrovat}
F;
  $f = classes\TplForm::compile($form);//->setAutoHide(true);


  $weburl = classes\Core::getUrl();

  function convert($values, &$pocet = null) {
    $result = null;
    if (isset($values['vstup'])) {
      // konverze z kuid_xxx_yyy
      if (preg_match_all('/[a-zA-Z]{4}2?_-?[0-9]+_[0-9]+(?:_[0-9]+)?/', $values['vstup'], $m)) {
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
        $pocet = 'zadanych radku: '.count(array_filter(explode(PHP_EOL, $values['vstup']),  function($v) { return $v != "\n" && $v != "\r" && $v != '';})).', parsrovanych kuidu: '.count($m[0]);
        $result = implode(PHP_EOL, $m[0]);
      }
    }
    return $result;
  }

  $f->setReturnValues($_POST, array('vystup'))->setReturnValues(array('vystup' => convert($_POST, $p)));
  $f_render = $f->render();

  $result = null;
  $count = null;
  if ($f->isSuccess()) {
    //~ $values = $f->getValues(true);

    var_dump($p);

    //~ // konverze z kuid_xxx_yyy
    //~ if (preg_match_all('/-?[0-9]+_[0-9]+(?:_[0-9]+)?/', $values['vstup'], $m)) {
      //~ $values['vstup'] = implode("\n", array_map(function($v) {
          //~ return str_replace('_', ':', $v);
        //~ }, $m[0]));
    //~ }

    //~ if (preg_match_all('/[a-zA-Z]{4}2?:-?[0-9]+:[0-9]+(?::[0-9]+)?/', $values['vstup'], $m)) {
      //~ // var_dump($m);
      //~ $values['vstup'] = implode("\n", array_map(function($v) {
          //~ if (substr_count($v, 'KUID2:') == 1) {
            //~ return substr($v, 6); // kuid2
          //~ } else {
            //~ return substr($v, 5); // kuid
          //~ }
        //~ }, $m[0]));
    //~ }

    //~ if (preg_match_all('/-?[0-9]+:[0-9]+(?::[0-9]+)?/', $values['vstup'], $m)) {
      //~ // var_dump($m);
      //~ $count = 'zadanych radku: '.count(array_filter(explode("\n", $values['vstup']))).', parsrovanych kuidu: '.count($m[0]);
      //~ $result = implode('<br />', $m[0]);
    //~ }
  }




{/code}

{if="$f->isErrors()"}
  {loop="$f->getErrors()"}
    chyba: {$value}
  {/loop}
{/if}

<a href="{$weburl}">domu</a><br />
{$count}
<hr />

{$f_render}
{$result}