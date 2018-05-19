<?php

  namespace _admin\pages;

  use classes\IPage,
      classes\Core,
      classes\ContentValues,
      classes\Form;

  class NabidkaHer_Home implements IPage {
    //nazev a ruzne promenne
    public static function getName() {
      return array('name' => 'Výpis nabídky her',
                  'name_blok' => 'Nabídka her',
                  );
    }

    //extra JS pro danou stranku
    public static function getJS($data = null) {
      $class = str_replace('\\', '/', __CLASS__);
      return array('external' => array('js/jquery-ui-1.9.2.custom.min.js'),
                    'embed' => <<<JS

      $(document).ready(function() {
        $("#sortable").sortable({
                          tolerance: 'pointer',
                          scroll: true,
                          scrollSensitivity: 40,
                          scrollSpeed: 30,
                          revert: 300,
                          opacity: 0.6,
                          cursor: 'move',
                          delay: 150,
                          update: function() {
                            var order = $(this).sortable("serialize") + '&class={__CLASS__}&method=updatePoradi';
                            $.post("{$data['weburl']}../ajax.php", order, function(response) {
                              $('#status_drag').html(response).fadeIn('slow').delay(2000).fadeOut('slow');
                            });
                          }
        });
      });

      function rewrite(text, target) {
        $.post("{$data['weburl']}../ajax.php", "class={$class}&method=getRewriteName&text="+text, function(response) {
          $(target).val(response);
        });
      }
    
JS
                  );
    }

    //extra CSS pro danou stranku
    //~ public static function getCSS() {}

    // uprava poradi nabidky her
    public static function updatePoradi($data, $args) {
      $db = $data['db'];
      $poradi = $args['arrayporadi'];
      $p = 0;
      foreach ($poradi as $k => $id) {
        $c = new ContentValues;
        $c->put('poradi', $k);
        $p += $db->update('nabidka_her', $c, 'idnabidka_hra=?', array($id));
      }
      return ($p > 0 ? 'upravano poradu u '.$p.' souboru' : '');
    }

    // rewrite prepis nazvu do url
    public static function getRewriteName($data, $args) {
      return strtolower(Core::getInteligentRewrite($args['text']));
    }

    //obsah
    public static function getContent($data = null) {
      $tpl = $data['tpl'];
      $spravce = $data['spravce'];
      //~ $html = $data['html'];
      $f = $data['form_global'];
      $uri = $data['web_uri'];
      $db = $data['db'];
//TOOD nabidka bude mit v sobe i skupiny a samotne hry!
      $blok = (isset($uri['blok']) ? $uri['blok'] : '');
      $id = (isset($uri['id']) ? $uri['id'] : '');

      $result = null;
      $dbVypis = null;
      $frm_out = null;

      // formular pro vykreslovani
      $f->addText('nabidkaher_nazev', 'nazev hry', null, array('maxlength' => 100, 'class' => 'dlouhy', 'onkeydown' => 'rewrite(this.value, \'.rewrite\');', 'onchange' => 'rewrite(this.value, \'.rewrite\');'))
          ->setRequired('Je nutne vyplnit nadpis')
        ->addText('nabidkaher_url', 'url hry', null, array('maxlength' => 100, 'readonly' => true, 'class' => 'rewrite dlouhy'))
          ->setRequired('Je nutne vyplnit url nadpis')
        ->addText('nabidkaher_popis', 'popis hry', null, array('maxlength' => 200))
        //TODO avatar img + file
        ->addText('nabidkaher_cena', 'ceny hry / za slot', 10)
          ->addRule(Form::NUMERIC, 'musi být číslo')
        ->addText('nabidkaher_minslotu', 'minimálně slotu', 4)
          ->addRule(Form::INTEGER, 'musi být celé číslo')
        ->addText('nabidkaher_maxslotu', 'maximálně slotu', 8)
          ->addRule(Form::INTEGER, 'musi být celé číslo')
        ->addText('nabidkaher_krokslotu', 'krok slotu', 1)
          ->addRule(Form::INTEGER, 'musi být celé číslo');

      switch ($blok) {
        default:
          $result = 'tady je pridavny text u vypis z databaze...';

          $dbVypis = $db->query('nabidka_her', array('idnabidka_hra', 'nazev', 'cena', 'minslotu', 'maxslotu', 'pridano', 'upraveno'), 'smazano is null', null, null, null, 'poradi ASC, nazev ASC');
        break;

        case 'add': // pridani nabidky her
          $backUrl = Core::getRequestUrl(null, -1);

          $f->addBackLink('zpět', $backUrl)
            ->addSubmit('add_nabidkaher', null, 'Přidat hru do nabídky');

          $result = $f->render();

          if ($f->isSubmitted()) {
            if ($f->isValid()) {
              $val = $f->getValues();

              $c = new ContentValues;
              $c->put('nazev', $val['nabidkaher_nazev'])
                ->put('url', $val['nabidkaher_url'])
                ->put('popis', $val['nabidkaher_popis'])
                //~ ->put('avatar', $val['nabidkaher_nazev'])
                ->put('cena', $val['nabidkaher_cena'])
                ->put('minslotu', $val['nabidkaher_minslotu'])
                ->put('maxslotu', $val['nabidkaher_maxslotu'])
                ->put('krokslotu', $val['nabidkaher_krokslotu'])
                ->putDate('pridano');

              $res = $db->insertOrThrow('nabidka_her', $c);

              if ($res > 0) {
                $result = 'přidáno: '.$val['nabidkaher_nazev'];
                Core::setRefresh(1, $backUrl);
              } else {
                $result = 'nepodařilo se přidat';
              }

            } else {
              $frm_out = $f->getErrors();
            }
          }
        break;

        case 'edit':  // editace nabidky her
          $backUrl = Core::getRequestUrl(null, -2);

          if (is_numeric($id)) {
            $edit = $db->query('nabidka_her', array('nazev', 'url', 'popis', 'avatar', 'cena', 'minslotu', 'maxslotu', 'krokslotu'), 'idnabidka_hra=?', array($id));  //vyber radku z db
            if ($edit->hasNext()) { //nacteni zaznamu
              $d = $edit->nextRow();

              $f->addBackLink('zpět', $backUrl)
                ->addSubmit('edit_nabidkaher', null, 'upravit hru do nabídky');

              $f->setDefaults(array(
                                    'nabidkaher_nazev' => $d->nazev,
                                    'nabidkaher_url' => $d->url,
                                    'nabidkaher_popis' => $d->popis,
                                    //avatar
                                    'nabidkaher_cena' => $d->cena,
                                    'nabidkaher_minslotu' => $d->minslotu,
                                    'nabidkaher_maxslotu' => $d->maxslotu,
                                    'nabidkaher_krokslotu' => $d->krokslotu,
                                    )
                              );

              $result = $f->render();

              if ($f->isSubmitted()) {
                if ($f->isValid()) {
                  $val = $f->getValues();

                  $c = new ContentValues;
                  $c->put('nazev', $val['nabidkaher_nazev'])
                    ->put('url', $val['nabidkaher_url'])
                    ->put('popis', $val['nabidkaher_popis'])
                    //~ ->put('avatar', $val['nabidkaher_avatar'])
                    ->put('cena', $val['nabidkaher_cena'])
                    ->put('minslotu', $val['nabidkaher_minslotu'])
                    ->put('maxslotu', $val['nabidkaher_maxslotu'])
                    ->put('krokslotu', $val['nabidkaher_krokslotu'])
                    ->putDate('upraveno');

                  $res = $db->update('nabidka_her', $c, 'idnabidka_hra=?', array($id));
                  if ($res > 0) {
                    $result = 'upraveno: '.$val['nabidkaher_nazev'];
                    Core::setRefresh(1, $backUrl);
                  } else {
                    $result = 'nepodařilo se upravit';
                  }
                } else {
                  $frm_out = $f->getErrors();
                }
              }
            } else {
              $result = 'neexistuje v databazi!';
            }
          } else {
            $result = 'neni vybrane ID!';
          }
        break;

        case 'del': // smazani nabidky her
          $backUrl = Core::getRequestUrl(null, -2);

          if (is_numeric($id)) {
            $c = new ContentValues;
            $c->putDate('smazano');

            $res = $db->update('nabidka_her', $c, 'idnabidka_hra=?', array($id));
            if ($res > 0) {
              $result = 'smazano';
              Core::setRefresh(1, $backUrl);
            }
//TODO pro CRONa vystup hodnot ktere podlehaji zkaze, expirace uzivatelu respektive smazanych udaju!
          } else {
            $result = 'neni vybrane ID!';
          }
        break;
      }

      $assign = array(
                      'addLink' => Core::getRequestUrl('add'),
                      'editLink' => Core::getRequestUrl('edit'),
                      'delLink' => Core::getRequestUrl('del'),
                      'url_blok' => $blok,
                      //~ 'url_id' => $id,
                      'dbVypis' => $dbVypis,
                      'formular' => $result,
                      'formular_out' => $frm_out,
                      );
      $tpl->assign($assign);

      return $tpl->template('webadmin/nabidkaher_home')->render();
    }
  }
