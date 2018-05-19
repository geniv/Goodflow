<?php
/*
 *      tokenizer.php
 *
 *      Copyright 2011 server <geniv.radek@gmail.com>
 *
 * Samonosny fronted
 *
 */

  namespace classes;

  class Tokenizer {
    const VERSION = 1.62;

    const STATE_ADD = 'add';
    const STATE_EDIT = 'edit';
    const STATE_DEL = 'delete';
    const STATE_EXP = 'export';
    const STATE_FILTER = 'filter';
    const STATE_LIST = '';

    const STATE_LISTLAB = 'listlabel';
    const STATE_EDITLAB = 'editlabel';
    const STATE_DELLAB = 'dellabel';

    const STORAGE_CODES = 'codes';
    const STORAGE_LABELS = 'labels';

    private static $get_adress = array('action', 'co');
    private static $code_con, $label_con, $workurl;

    public static function getCurrentAdress($level = 0) {
      return Core::isFill($_GET, self::$get_adress[$level]);
    }

    public static function setWorkUrl($url) {
      self::$workurl = $url;
    }

//pouze path k souboru!
    public static function setConnetion($path) {
      $con = new Connector(Connector::TYPE_JSON, sprintf('%s/%s', $path, self::STORAGE_CODES));  //pripojeni
      //nastaveni struktury dat pro kody
      $con->setStructure(array('name' => 'string',
                              'class' => 'int',
                              'version' => 'float',
                              'rows' => 'int',
                              'original' => 'int',
                              'new' => 'int',
                              'compress' => 'float',
                              'source' => 'string_code',
                              'date' => 'string',
                              'editdate' => 'string',
                              'comment' => 'string',
                              'labels' => 'array',
                              )
                        )->load();
      self::$code_con = $con;

      $con = new Connector(Connector::TYPE_JSON, sprintf('%s/%s', $path, self::STORAGE_LABELS));
      //nastaveni struktury dat pro popisky
      $con->setStructure(array('name' => 'string',
                              'color' => 'string',
                              'show' => 'bool',
                              'comment' => 'string'))->load();
      self::$label_con = $con;
    }

    private static function getAddLabelForm() {
      $con = self::$label_con;
//FIXME administrace add a edit formulare na stitky bude stejna, 1:1,
//takze tento formular ulozit do sablony a pouzivat ho z promenne!!!
      $form = new Form;
      $form->addText('name', array('label' => _('Jméno štítku')))
              ->addRule(Form::RULE_FILLED, _('musi být vyplněno nějaké jméno'))
            ->addText('color', array('label' => _('Barva štítku')))
            ->addCheckbox('show', array('label' => _('Zobrazit štítek')))
            ->addTextArea('comment', array('label' => _('Komentář štítku')))
            ->addSubmit('button', array('value' => _('Uložit štítek')));
//var_dump($form);
      $result = $form;

      if ($form->isSubmitted()) {
        $con->addRow($form->getValues()); //pridani do uloziste
        $result = _('šítek přidán...');
        Core::setRefresh(1, self::$workurl);
      }

      if ($form->isErrors()) {
        $result .= $form->getErrors();
      }
      return $result;
    }

    private function getEditLabelForm() {
      $result = NULL;
//http://acko.net/dev/farbtastic
      $id = Core::decodeData(Core::isFill($_GET, 'id'));
      if (!empty($id)) {
        $labcon = self::$label_con;
        $rowdata = $labcon->loadRow($id);
        if (!empty($rowdata)) {
          $form = new Form;
          $form->setValues($rowdata)  //nacitani dat primo ve formulari
                ->addText('name', array('label' => _('Jméno štítku'), 'returnvalue' => true))
                  ->addRule(Form::RULE_FILLED, _('musi být vyplněno nějaké jméno'))
                ->addText('color', array('label' => _('Barva štítku'), 'returnvalue' => true))
                ->addCheckbox('show', array('label' => _('Zobrazit štítek'), 'returnvalue' => true))
                ->addTextArea('comment', array('label' => _('Komentář štítku'), 'returnvalue' => true))
                ->addSubmit('button', array('value' => _('Uložit upravený štítek')))
                ->addBackLink(_('Zpět na výpis štítků'), self::$workurl.self::STATE_LISTLAB);

          $result = $form;

          if ($form->isSubmitted()) {
            $values = $form->getValues();
            $merge = array_merge($rowdata, $values);
            $labcon->editRow($id, $merge);
            $result = _('štítek upraven a uložena');
            Core::setRefresh(1, self::$workurl.self::STATE_LISTLAB);
          }

          if ($form->isErrors()) {
            $result .= $form->getErrors();
          }
        }
      }
      return $result;
    }

    private static function getAddForm() {
      $con = self::$code_con;

      $form = new Form(array('enctype' => Form::MIME_MULTIPART));
      $form->addFile('files', array('label' => _('Vstupní zdrojové soubory'), 'multiple' => true, 'accept' => array('application/x-php')))
              ->addRule(Form::RULE_FILLED, _('musi být vybrán nějaký soubor!!'))
            ->addSubmit('button', array('value' => _('Poslat soubory')))
            ->addBackLink(_('Zpět na výpis'), self::$workurl);

//TODO pri uploadu vybrat jaky stitek priradit vsem defaultne!!!!!!!!!!!

      $result = $form;

      if ($form->isSubmitted()) {
        $values = $form->getValues();
        $files = $values['files'];
        foreach ($files['name'] as $index => $name) {
          if ($files['type'][$index] == 'application/x-php') {
            $min = self::getMiniVersion($files['tmp_name'][$index]); //$name,
            $min['name'] = $name;
            $min['date'] = strtotime('now');
            $con->addRow($min); //pridani do uloziste
            $result = _('soubory přidány do uložiště');
          } else {
            $result = sprintf(_('zadany soubor "%s" neni typu php!'), $name);
          }
        }
        Core::setRefresh(1, self::$workurl);
      }

      if ($form->isErrors()) {
        $result .= $form->getErrors();
      }
      return $result;
    }

    private static function getEditForm() {
      $result = NULL;

      $id = Core::decodeData(Core::isFill($_GET, 'id'));
      if (!empty($id)) {
        $con = self::$code_con;
        $labcon = self::$label_con;
        $rowdata = $con->loadRow($id);
        if (!empty($rowdata)) {
          $labeldata = $labcon->getListRows('name');

          $form = new Form;
          $form->setValues($rowdata)
                ->addText('name', array('label' => _('Jméno souboru'), 'readonly' => true, 'returnvalue' => true))
                ->addText('version', array('label' => _('Verze souboru'), 'returnvalue' => true))
                ->addCheckGroup('labels', array('label' => _('Dostupné štítky'), 'value' => $labeldata, 'multiple' => true, 'returnvalue' => true))
                ->addTextArea('comment', array('label' => _('Komentář'), 'returnvalue' => true))
                ->addSubmit('button', array('value' => _('Uložit položku')))
                ->addBackLink(_('Zpět na výpis'), self::$workurl);

          $result = $form;

          if ($form->isSubmitted()) {
            $values = $form->getValues();
            $values['editdate'] = strtotime('now');
            $merge = array_merge($rowdata, $values);
            $con->editRow($id, $merge);
            $result = _('položka upravena a uložena');
            Core::setRefresh(1, self::$workurl);
          }

          if ($form->isErrors()) {
            $result .= $form->getErrors();
          }
        }
      }
      return $result;
    }

    private static function getListLabel() {
      $result = NULL;

      $labcon = self::$label_con;
      $url = self::$workurl;

      $add = self::getAddLabelForm();

      $row = array(
                  Html::a()->href(self::$workurl)->setText(_('Zpět na výpis')),
                  );

      $listlabel = $labcon->getListRows();
      if (!empty($listlabel)) {
        foreach ($listlabel as $key => $values) {
          $id = Core::encodeData($key, true);
          $row[] = Html::ul()->insert(Html::li()->setText($values['name'])
                                                ->insert(Html::input(array('type' => 'checkbox', 'checked' => $values['show'], 'disabled' => true)))
                                                ->insert(Html::elem('a')->href(sprintf('%s%s/%s', $url, self::STATE_EDITLAB, $id))->setText(_('upravit štítek')))
                                                ->insert(Html::elem('a')->href('#')->onclick(sprintf('return confirm(\'%s\') ? funcdel(\'%s\', \'%s\') : false', sprintf(_('Hele opravdu chceš smazat tento štítek: &quot;%s&quot; ?'), $values['name']), $id, self::STATE_DELLAB))->setText(_('smazat')))
                                      );
        }
      } else {
        $row[] = _('žádný štítek');
      }

      $row[] = $add;

      $result = implode(PHP_EOL, $row);

      return $result;
    }

    private static function getList() {
      $con = self::$code_con;
      $labcon = self::$label_con;
      $url = self::$workurl;

      $row = array(
                  Html::a()->href($url.self::STATE_LISTLAB)->setText(_('administace štítků')),
                  Html::a()->href($url.self::STATE_ADD)->setText(_('Přidej soubor')),
                  Html::br(), Html::br(), _('Štítky:'), Html::br()
                  );

      //nacitani id pro filtrovani
      $labelid = NULL;
      $current = self::getCurrentAdress();
      if ($current == self::STATE_FILTER) {
        $labelid = Core::isFill($_GET, 'id');
      }

      //nacitani stitku
      $listlabel = $labcon->getListRows();
      if (!empty($listlabel)) {
        foreach ($listlabel as $key => $values) {
          if ($values['show']) {
            $row[] = Html::a()->href(sprintf('%s%s/%s', $url, self::STATE_FILTER, $key))->class($labelid == $key ? 'aktivni' : NULL)->setText($values['name']);
          }
        }
      }

      $row[] = Html::br();
      $row[] = Html::br();
      $row[] = _('Zdrojáky:');
//TODO rozsirit moznosti exportovani do souboru, i vybranych a i podle stitku!
      $list = $con->getListRows();
      if (!empty($list)) {
        foreach ($list as $key => $values) {
          $id = Core::encodeData($key, true);
          //filrovani polozek
          if (!empty($labelid) ? in_array($labelid, $values['labels']) : true) {
            $row[] = Html::elem('ul')
                          ->insert(Html::elem('li')
                                        ->setText($values['name'].', (')  //.$key.'), '
                                        ->setText($values['class'].'x class, ')
                                        ->setText($values['rows'].' řádků, ')
                                        ->setText('ver: '.$values['version'].', ')
                                        ->setText(Core::calculateSize($values['original']).' → ')
                                        ->setText(Core::calculateSize($values['new']).', ')
                                        ->setText('o: '.$values['compress'].'x menší, ')
                                        //->setText('přidáno v: '.date('d.m.Y H:i:s', $values['date']))
                                        ->insert(Html::elem('a')->href(sprintf('%s%s/%s', $url, self::STATE_EXP, $id))->setText(_('export')))
                                        ->insert(Html::elem('a')->href(sprintf('%s%s/%s', $url, self::STATE_EDIT, $id))->setText(_('upravit')))
                                        ->insert(Html::elem('a')->href('#')->onclick(sprintf('return confirm(\'%s\') ? funcdel(\'%s\', \'%s\') : false', sprintf(_('Hele opravdu chceš smazat tento soubor: &quot;%s&quot; ?'), $values['name']), $id, self::STATE_DEL))->setText(_('smazat')))
                                  );
          }
        }
      } else {
        $row[] = _('žádná položka');
      }

      $result = implode(PHP_EOL, $row);

      return $result;
    }

    public static function getContent() {
      $result = NULL;
      switch (self::getCurrentAdress()) {
        default:
        case self::STATE_LIST:  //vypis
        case self::STATE_FILTER:
          $result = self::getList();
        break;

        case self::STATE_LISTLAB: //administrace stitku
          $result = self::getListLabel();
        break;

        case self::STATE_EDITLAB: //editace labelu
          $result = self::getEditLabelForm();
        break;

        case self::STATE_ADD:  //pridavani
          $result = self::getAddForm();
        break;

        case self::STATE_EDIT: //editace
          $result = self::getEditForm();
        break;

        case self::STATE_EXP: //export
          $result = self::getExportCode();
        break;
      }
      return $result;
    }

    private static function getExportCode() {
      $result = NULL;

      $id = Core::decodeData(Core::isFill($_GET, 'id'));

      $con = self::$code_con;
      $rowdata = $con->loadRow($id);
      $comment = str_replace(PHP_EOL, sprintf('%s * ', PHP_EOL), PHP_EOL.$rowdata['comment'].PHP_EOL);

      $output = sprintf(_('<?php
/**
 * Generated with goodflow_tokenizer
 *
 * File: %s
 * Version: %s
 * Date added: %s
 * Date editing: %s
 * Date generation: %s
 * Original size: %s
 * New size: %s
 * Compression about %sx less
 * Original number of lines: %s
 *%s
 */
 %s
?>').PHP_EOL, $rowdata['name'],
              $rowdata['version'],
              date('r', $rowdata['date']),
              (!empty($rowdata['editdate']) ? date('r', $rowdata['editdate']) : ''),
              date('r'),
              Core::calculateSize($rowdata['original']),
              Core::calculateSize($rowdata['new']),
              $rowdata['compress'],
              $rowdata['rows'],
              $comment,
              $rowdata['source']);

//FIXME osetrit pripadne chyby ktere mohou nastat! jiank se kod vygeneruje s krpou, takze seknout!!!!!!!!!!!

      //zaslani hlavicek pro stahnuti
      header('Content-Description: File Transfer');
      header('Content-Type: application/force-download');
      header(sprintf('Content-Disposition: attachment; filename=%s', $rowdata['name']));
      header(sprintf('Content-Length: %s', mb_strlen($output)));
      echo $output;
      exit;
    }

//vygenerovani mini verze se zjistenim dodatecnych informaci
    private static function getMiniVersion($filename) {
      //load file
      $input = file_get_contents($filename);
      $result['class'] = 0;
      $space = '';
      $source = '';
      $set = '!"#$&\'()*+,-./:;<=>?@[\]^`{|}';
      $set = array_flip(preg_split('//',$set));
      $tokens = token_get_all($input);
      foreach ($tokens as $index => $token) {
        if (!is_array($token)) {
          $token = array(0, $token);
        }

        switch ($token[0]) {
          case T_COMMENT:
          case T_DOC_COMMENT:
          case T_WHITESPACE:
            $space = ' ';
          break;

          case T_OPEN_TAG:
          case T_CLOSE_TAG:
            //hrube spocitani radku php kodu
            if ($token[0] == T_OPEN_TAG) {
              $start = $token[2];
            }

            if ($token[0] == T_CLOSE_TAG) {
              $result['rows'] = $token[2] - $start; //konec-start
            }
          break;

          case T_CONST:
            $source .= ' '.$token[1];
            //hledani verze tridy
            if ($tokens[$index + 2][1] == 'VERSION') {
              $result['version'] = $tokens[$index + 6][1];
            }
          break;

          case T_CLASS:
            $source .= ' '.$token[1];
            //pocitani trid
            $result['class']++;
          break;

          default:
            if (isset($set[substr($source, -1)]) || isset($set[$token[1]{0}])) {
              $space = '';
            }
            $source .= $space.$token[1];
            $space = '';
          break;
        }
      }
      $result['original'] = filesize($filename);
      $result['new'] = mb_strlen($source);
      //kompresni pomer
      $result['compress'] = round($result['original'] / $result['new'], 3); //FIXME osetrit deleni nulou!
      $result['source'] = $source;

      return $result;
    }


    public static function getAjax() {
      $result = NULL;

      $co = Core::isFill($_POST, self::$get_adress[1]);

      $p = Core::decodeData(Core::isFill($_POST, 'p'));
      self::setConnetion($p);

      switch ($co) {
        case self::STATE_DELLAB:
          $id = Core::decodeData(Core::isFill($_POST, 'id'));
          $con = self::$label_con;
          $name = $con->loadRow($id, 'name');
          $con->delRow($id);
          $result = sprintf(_('štátek "%s" smazán...'), $name);
        break;

        case self::STATE_DEL:
          $id = Core::decodeData(Core::isFill($_POST, 'id'));
          $con = self::$code_con;
          $name = $con->loadRow($id, 'name');
          $con->delRow($id);
          $result = sprintf(_('soubor "%s" smazán...'), $name);
        break;
      }
      return $result;
    }
  }

?>
