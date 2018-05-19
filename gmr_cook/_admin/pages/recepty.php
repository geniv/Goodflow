<?php

  namespace _admin\pages;

  use classes\IPage,
      classes\Core,
      classes\ContentValues,
      classes\Configurator;

  class Recepty implements IPage {
    //nazev a ruzne promenne
    public static function getName() {
      return array('name' => 'Recepty',
                  );
    }

    // extra JS pro danou stranku
    public static function getJS($data = null) {
      return array('external' => array('js/tinymce/jscripts/tiny_mce/tiny_mce.js'),
                    'embed' => <<<JS

      tinyMCE.init({
        mode : "textareas",
        theme : "advanced",
        skin : "o2k7",
        plugins : "safari,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,visualblocks,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,imagemanager,filemanager",

        // Theme options
        theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
        theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
        theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
        theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,spellchecker,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,blockquote,pagebreak",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true,

        schema: "html5",

        // HTML5 formats
        style_formats : [
                {title : 'h1', block : 'h1'},
                {title : 'h2', block : 'h2'},
                {title : 'h3', block : 'h3'},
                {title : 'h4', block : 'h4'},
                {title : 'h5', block : 'h5'},
                {title : 'h6', block : 'h6'},
                {title : 'p', block : 'p'},
                {title : 'div', block : 'div'},
                {title : 'pre', block : 'pre'},
                {title : 'section', block : 'section', wrapper: true, merge_siblings: false},
                {title : 'article', block : 'article', wrapper: true, merge_siblings: false},
                {title : 'blockquote', block : 'blockquote', wrapper: true},
                {title : 'hgroup', block : 'hgroup', wrapper: true},
                {title : 'aside', block : 'aside', wrapper: true},
                {title : 'figure', block : 'figure', wrapper: true}
        ],

        language : "cs"
      });

JS
                  );
    }

    //obsah
    public static function getContent($data = null) {
      $tpl = $data['tpl'];
      $user = $data['user'];
      //~ $html = $data['html'];
      $f = $data['form_global'];
      $uri = $data['web_uri'];
      $db = $data['db'];

      $blok = (isset($uri['blok']) ? $uri['blok'] : '');
      $id = (isset($uri['id']) ? $uri['id'] : '');

      $result = null;
      $dbResult = null;
      $form_out = null;
      $generate = null;

      $sortValues = null;
      $sortDirection = null;
      $selectDirection = 0;

      // defaultni hodnoty razeni
      $defaultValue = 0;
      $defaultDirection = 0;

      $userid = $user->getIdentity()->getId();

//TODO obalovat jednotlive skupiny polozek (nadobi a receptu) podle zacinajicich pismen (neumi to formular!!)
//TODO strankovani receptu

      $f->addGroup('popis receptu')
        ->addSelect('idkategorie', 'kategorie')
          ->setItems($data->getKategorie())
          ->setPrompt('vyber kategorii!')
          ->setRequired('je nutne vypnit kategorii')
        ->addText('nazev', 'nazev receptu', null, array('maxlength' => 200,))
          ->setRequired('je nutne vypnit nazev')
        ->addTextArea('popis', 'popis postupu')
          ->setRequired('je nutne vypnit postup')
        ->addText('doba', 'doba přípravy', null, array('maxlength' => 30,))
          ->setRequired('je nutne vypnit dobu')
        ->addText('porce', 'počet porcí', null, array('maxlength' => 30,))
          ->setRequired('je nutne vypnit pocet porci')
        ->addCheckbox('navrh', 'rozepsany recept?')
        ->addGroup('nadobí')
        ->addCheckList('nadobi_na_recepty', array($f::CALLBACK_ELEMENT => $data->getCallbackFormCheckList()))
          ->setItems($data->getNadobi())
        ->addGroup('suroviny')
        ->addCheckList('suroviny_na_recepty', array($f::CALLBACK_ELEMENT => $data->getCallbackFormCheckList()))
          ->setItems($data->getSuroviny())
        ->addGroup();

      switch ($blok) {
        default:
          if (is_numeric($blok)) {
            // rozkliknuti receptu
            $dbResult = $db->rawQuery('SELECT
                                        idrecepty,
                                        uzivatele.login uzivatel_login,
                                        kategorie.nazev kategorie_nazev,
                                        recepty.nazev recept_nazev,
                                        recepty.popis recept_popis,
                                        doba,
                                        porce,
                                        navrh,
                                        recepty.pridano pridano,
                                        recepty.upraveno upraveno,
                                        group_concat(DISTINCT nadobi.nazev ORDER by nadobi.nazev SEPARATOR ", ") AS nadobi,
                                        group_concat(DISTINCT suroviny.nazev ORDER BY suroviny.nazev SEPARATOR ", ") AS suroviny
                                      FROM recepty
                                      JOIN uzivatele USING(iduzivatel)
                                      JOIN kategorie USING(idkategorie)
                                      JOIN nadobi_na_recepty USING(idrecepty)
                                      JOIN nadobi USING(idnadobi)
                                      JOIN suroviny_na_recepty USING(idrecepty)
                                      JOIN suroviny USING(idsuroviny)
                                      WHERE recepty.smazano IS NULL AND
                                      idrecepty=?
                                      GROUP BY idrecepty;', array($blok));
          } else {
            // defaultni vypis
            $sortValues = array(array('nazev', 'recepty.nazev'),
                                array('kategorie', 'kategorie.nazev'),
                                array('autor', 'uzivatele.login'),
                                array('přidáno', 'recepty.pridano'),
                                array('upraveno', 'recepty.upraveno'),
                                );

            $sortDirection = array(array('v', 'ASC'),
                                    array('^', 'DESC')
                                  );

            if (!empty($id)) {
              list($defaultValue, $defaultDirection) = explode('-', $id);
              if ($selectDirection == $defaultDirection) {  // prepinani smeru razeni
                $selectDirection = 1;
              }

              // pokud je zadany neplatny $defaultValue index
              if (!isset($sortValues[$defaultValue])) {
                $defaultValue = 0;
              }

              // pokud je zadany neplatny $defaultDirection index
              if (!isset($sortDirection[$defaultDirection])) {
                $defaultDirection = 0;
              }
            }
            $sqlSort = $sortValues[$defaultValue][1].' '.$sortDirection[$defaultDirection][1];  // sestaveni dotazu pro order by

            //~ $dbResult = $db->rawQuery('SELECT
                                        //~ idrecepty,
                                        //~ uzivatele.login uzivatel_login,
                                        //~ kategorie.nazev kategorie_nazev,
                                        //~ recepty.nazev recept_nazev,
                                        //~ doba,
                                        //~ porce,
                                        //~ recepty.pridano pridano,
                                        //~ recepty.upraveno upraveno
                                      //~ FROM recepty
                                      //~ JOIN uzivatele USING(iduzivatel)
                                      //~ JOIN kategorie USING(idkategorie)
                                      //~ WHERE recepty.smazano IS NULL
                                      //~ ORDER BY pridano DESC;');
//TODO pridat sloupec "navrh" coz je alias draft-u!!
//FIXME administracni cast nechat, jen aplikovat opravneni na akce v adminu a vykreslovani v tpl!
            $dbResult = $db->rawQuery('SELECT
                                        idrecepty,
                                        uzivatele.login uzivatel_login,
                                        kategorie.nazev kategorie_nazev,
                                        recepty.nazev recept_nazev,
                                        doba,
                                        porce,
                                        navrh,
                                        recepty.pridano pridano,
                                        recepty.upraveno upraveno,
                                        group_concat(DISTINCT nadobi.nazev ORDER by nadobi.nazev SEPARATOR ", ") AS nadobi,
                                        group_concat(DISTINCT suroviny.nazev ORDER BY suroviny.nazev SEPARATOR ", ") AS suroviny
                                      FROM recepty
                                      JOIN uzivatele USING(iduzivatel)
                                      JOIN kategorie USING(idkategorie)
                                      JOIN nadobi_na_recepty USING(idrecepty)
                                      JOIN nadobi USING(idnadobi)
                                      JOIN suroviny_na_recepty USING(idrecepty)
                                      JOIN suroviny USING(idsuroviny)
                                      WHERE recepty.smazano IS NULL
                                      GROUP BY idrecepty
                                      ORDER BY '.$sqlSort.';');
          }
        break;

        case 'add':
          $backUrl = Core::getRequestUrl(null, -1);

          $f->addBackLink('zpět', $backUrl)
            ->addSubmit('add_recepty', null, 'Přidat recept')
            ->setReturnValues($_POST);

          $result = $f->render();

          if ($f->isSubmitted()) {
            $val = $f->getValues();

            if ($f->isValid() &&
                isset($val['nadobi_na_recepty']) &&
                isset($val['suroviny_na_recepty'])) {

              $c = new ContentValues($val);
              $c->put('iduzivatel', $userid)
                ->put('navrh', isset($val['navrh']))
                ->putDate('pridano')
                ->remove('add_recepty')
                ->remove('nadobi_na_recepty')
                ->remove('suroviny_na_recepty');

              $idrecept = $db->insertOrThrow('recepty', $c);

              // cyklicke vkladani nadobi
              foreach ($val['nadobi_na_recepty'] as $idnadobi) {
                $c1 = new ContentValues();
                $c1->put('idnadobi', $idnadobi)
                    ->put('idrecepty', $idrecept);
                    //~ ->put('mnozstvi', 0)
                    //~ ->put('povinne', true);
                $db->insertOrThrow('nadobi_na_recepty', $c1);
              }

              // cyklicke vkladani surovin
              foreach ($val['suroviny_na_recepty'] as $idsuroviny) {
                $c2 = new ContentValues();
                $c2->put('idsuroviny', $idsuroviny)
                    ->put('idrecepty', $idrecept);
                    //~ ->put('mnozstvi', 0)
                    //~ ->put('povinne', true)
                    //~ ->put('idjednotky', 0);
                $db->insertOrThrow('suroviny_na_recepty', $c2);
              }

              if ($idrecept > 0) {
                $result = 'přidáno: '.$val['nazev'];
                Core::setRefresh(1, $backUrl);
              } else {
                $result = 'nepodařilo se přidat';
              }

            } else {
              $form_out = $f->getErrors();

              if (!isset($val['nadobi_na_recepty'])) {
                $form_out[] = 'je nutne vyplnit nejake nadobi';
              }

              if (!isset($val['suroviny_na_recepty'])) {
                $form_out[] = 'je nutne vyplnit nejake suroviny';
              }
            }
          }
        break;

        case 'edit':
          $backUrl = Core::getRequestUrl(null, -2);

          if (is_numeric($id)) {
            $edit = $db->query('recepty', array('idkategorie', 'nazev', 'popis', 'doba', 'porce', 'navrh'), 'idrecepty=?', array($id));  //vyber radku z db
            if ($edit->hasNext()) { //nacteni zaznamu
              $d = $edit->nextRow();

              $plus = array(
                            'nadobi_na_recepty' => $data->getIdNadobi($id),
                            'suroviny_na_recepty' => $data->getIdSuroviny($id),
                            'navrh' => ($d->navrh ? 'on' : ''),
                            );

              $f->addBackLink('zpět', $backUrl)
                ->addSubmit('edit_recepty', null, 'Upravit recepty')
                ->setDefaults($d)
                ->setDefaults($plus)
                ->setReturnValues($_POST);

              $result = $f->render();

              if ($f->isSubmitted()) {
                $val = $f->getValues();

                if ($f->isValid() &&
                    isset($val['nadobi_na_recepty']) &&
                    isset($val['suroviny_na_recepty'])) {

                  $c = new ContentValues($val);
                  $c->put('navrh', isset($val['navrh']))
                    ->putDate('upraveno')
                    //~ ->put('iduzivatel', $userid)
                    ->remove('edit_recepty')
                    ->remove('nadobi_na_recepty')
                    ->remove('suroviny_na_recepty');

                  // pokud se detekuje zmena u nadobi
                  $diff_nadobi = array_diff($val['nadobi_na_recepty'], $plus['nadobi_na_recepty']);
                  if (!empty($diff_nadobi) || count($val['nadobi_na_recepty']) != count($plus['nadobi_na_recepty'])) {
                    // smazani polozek z nadobi_na_recepty
                    $db->delete('nadobi_na_recepty', 'idrecepty=?', array($id));

                    // cyklicke vkladani nadobi
                    foreach ($val['nadobi_na_recepty'] as $idnadobi) {
                      $c1 = new ContentValues();
                      $c1->put('idnadobi', $idnadobi)
                          ->put('idrecepty', $id);
                          //~ ->put('mnozstvi', 0)
                          //~ ->put('povinne', true);
                      $db->insertOrThrow('nadobi_na_recepty', $c1);
                    }
                  }

                  // pokud se detekuje zmena u surovin
                  $diff_suroviny = array_diff($val['suroviny_na_recepty'], $plus['suroviny_na_recepty']);
                  if (!empty($diff_suroviny) || count($val['suroviny_na_recepty']) != count($plus['suroviny_na_recepty'])) {
                    // smazani polozek z nadobi_na_recepty
                    $db->delete('suroviny_na_recepty', 'idrecepty=?', array($id));

                    // cyklicke vkladani surovin
                    foreach ($val['suroviny_na_recepty'] as $idsuroviny) {
                      $c2 = new ContentValues();
                      $c2->put('idsuroviny', $idsuroviny)
                          ->put('idrecepty', $id);
                          //~ ->put('mnozstvi', 0)
                          //~ ->put('povinne', true)
                          //~ ->put('idjednotky', 0);
                      $db->insertOrThrow('suroviny_na_recepty', $c2);
                    }
                  }

                  $res = $db->update('recepty', $c, 'idrecepty=?', array($id));
                  if ($res > 0) {
                    $result = 'upraveno: '.$val['nazev'];
                    Core::setRefresh(1, $backUrl);
                  } else {
                    $result = 'nepodařilo se upravit';
                  }

                } else {
                  $form_out = $f->getErrors();

                  if (!isset($val['nadobi_na_recepty'])) {
                    $form_out[] = 'je nutne vyplnit nejake nadobi';
                  }

                  if (!isset($val['suroviny_na_recepty'])) {
                    $form_out[] = 'je nutne vyplnit nejake suroviny';
                  }
                }
              }
            } else {
              $result = 'neni v DB';
            }
          } else {
            $result = 'neplatne ID';
          }
        break;

        case 'del':
          $backUrl = Core::getRequestUrl(null, -2);
          if (is_numeric($id)) {
            $c = new ContentValues;
            $c->putDate('smazano');
//TODO cronem cistit DB smazanach receptu a jejich zavislosti v: nadobi_na_recepty a suroviny_na_recepty
            $res = $db->update('recepty', $c, 'idrecepty=?', array($id));
            if ($res > 0) {
              $result = 'smazano';
              Core::setRefresh(1, $backUrl);
            }
          } else {
            $result = 'neplatne ID';
          }
        break;

        case 'generate':  // generovani sqlite databaze
          $generate = $data->initializationSQLite('../', $db);

          $backUrl = Core::getRequestUrl(null, -1);
          Core::setRefresh(5, $backUrl);
        break;
      }

      $db_conf = Configurator::decode('../database_config.php');
      $genPath = Core::getAbsoluteUrl() . $db_conf['SQLite3']['host'];

      $assign = array(
                      'url_blok' => $blok,

                      'sortValues' => $sortValues,
                      'sortDirection' => $sortDirection,
                      'defaultDirection' => $defaultDirection,  //defaltni smer (value)
                      'selectDirection' => $selectDirection,  //vybrana (key)

                      //~ 'editLink' => Core::getRequestUrl('edit'),
                      //~ 'delLink' => Core::getRequestUrl('del'),
                      'addLink' => Core::getRequestUrl('add'),
                      'editLink' => $data['weburl'].'?recepty/edit',
                      'delLink' => $data['weburl'].'?recepty/del',

                      'genLink' => Core::getRequestUrl('generate'),
                      'genResult' => $generate,
                      'genPath' => $genPath,
                      'genMtime' => filemtime('../' . $db_conf['SQLite3']['host']),

                      'formular' => $result,
                      'formular_out' => $form_out,
                      'dbResult' => $dbResult,
                      );
      $tpl->assign($assign);

      return $tpl->template('page_recepty')->render();
    }
  }