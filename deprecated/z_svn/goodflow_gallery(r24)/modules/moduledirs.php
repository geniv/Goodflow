<?php
/*
 *      menudirs.php
 *
 *      Copyright 2011 geniv <geniv.radek@gmail.com>
 *
 */

  namespace modules;

  use classes\Core,
      classes\Html,
      classes\Form,
      classes\Administration,
      classes\XmlStorage,
      configs\Config,
      Exception;

//FIXME sjednotit popisky => picture/photo/image ???
  final class ModuleDirs implements Module {
    const URL = 'dir';
    const VERSION = '1.5';

    public static function getName() {
      return _('Directory');
    }

    private static $xmldata = NULL;
    private static $web_path = NULL;
    private static $source_path = NULL;

    public static function getState() {
      try {

        $result = false;
        if (!file_exists(self::$source_path)) {
          if (!@mkdir(self::$source_path)) {
            throw new ExceptionModuleDirs(_('nelze vytvorit slozku galerie!'));
          }
        }
        $result = file_exists(self::$source_path);

      } catch (ExceptionModuleDirs $e) {
        echo $e;
      }

      return $result;
    }

    public static function setWebPath($path = NULL) {
      self::$web_path = $path;
      self::$source_path = sprintf('%s%s', self::$web_path, Config::SOURCE);
      //var_dump(self::$source_path);
    }

    public static function getXmlPath() {
      $class = substr(__CLASS__, strlen(__NAMESPACE__) + 1);
      return XmlStorage::getAutoPath(__DIR__, $class);
    }
//nacita jen aktivni adresare
    public static function getActiveDirs() {
      $load_data = self::loadXmlData();
      $result = array();
      if (!empty($load_data)) {
        foreach ($load_data as $dir => $conf) {
          $enabled = $conf['enabled'];
          if ($enabled) {
            $result[$dir] = $conf;
          }
        }
      }

      return $result;
    }

    private static function synchronizeXml($load, $dirs) {
      $result = NULL;

      $xml_path = self::getXmlPath();
      $load_data = self::loadXmlData();

      $diff = array_diff($load, $dirs);
      if (!empty($diff)) {
        foreach ($diff as $dir) {
          $load_data[$dir] = NULL;
        }

        if (XmlStorage::setData($xml_path, $load_data)) {
          $result[] = sprintf(_('Synchronized: %s'), implode(', ', $diff));
          $get_adress = Administration::getGetAdress();
          Core::setRefresh(Config::TIME_EDIT, Core::getAbsoluteUrl(array($get_adress[0] => self::URL), array('path' => Administration::ADMIN_URL)));
        }
      }

      return $result;
    }

    private static function loadXmlData() {
      try {

        $xml_path = self::getXmlPath();
        if (file_exists($xml_path)) {
          //pokud je prazdna jednou se nacte
          if (empty(self::$xmldata)) {
            self::$xmldata = XmlStorage::getData($xml_path);
          }
        } else {
          //neni kriticka chyba!
          //throw new ExceptionModuleDirs(sprintf('Does not exist file: %s', $xml_path));
        }

      } catch (ExceptionModuleDirs $e) {
        echo $e;
      }

      return self::$xmldata;
    }

    public static function getPageTitle($settings = array()) {
      $result = NULL;
      $before = Core::isFill($settings, 'before');
      $after = Core::isFill($settings, 'after');

      $current = Administration::getCurrentAdress();

      $row = array();
      if (!empty($before)) {  //muze se zatim vlozit jen text! ne pole!
        $row[] = $before;
      }

      //nacitany nazev
      if (!empty($current)) {
        $row[] = $current;
      }

      if (!empty($after)) { //muze se zatim vlozit jen text! ne pole!
        $row[] = $after;
      }

      $result = implode(' - ', $row); //slucovani title

      return $result;
    }

    public static function getPageMenu() {
      $result = NULL;
      $load_data = self::getActiveDirs();

      $absoluteurl = Core::getAbsoluteUrl();
      $current = Administration::getCurrentAdress();

      $row = array();
      foreach ($load_data as $dir => $values) {
        $href_link = sprintf('%s%s', $absoluteurl, $dir);
        $row[] = Html::elem('a')
                      ->href($href_link)
                      ->class($current == $dir ? 'aktivni' : NULL)
                      ->setText($dir)
                      ;
      }
      $result = implode('', $row);

      return $result;
    }

    public static function getPageContent() {
      $result = NULL;
      $load_data = self::getActiveDirs();

      $absoluteurl = Core::getAbsoluteUrl();
      $current = Administration::getCurrentAdress();

      $source_path = Config::SOURCE;

      if (!empty($current)) {
        if (array_key_exists($current, $load_data)) {
          $path_full = sprintf('%s/%s', $source_path, $current);
          $path_mini = sprintf('%s/%s/%s', $source_path, $current, Config::THUMB);

          $files = Core::isFill($load_data[$current], 'files');
          if (!empty($files)) {
            $row = array();
            foreach ($files as $name => $comment) {
              $obr_path = sprintf('%s/%s', $path_mini, $name);
              $obrazek = Html::elem('img')
                            ->src($obr_path)
                            ;

              $href_link = sprintf('%s%s/%s', $absoluteurl, $path_full, $name);
              $href = Html::elem('a')
                            ->href($href_link)
                            ->setText($obrazek)
                            ;

              $span = Html::elem('span')
                          ->setText($comment)
                          ->insert(array(Html::elem('br'), $href, Html::elem('br'), Html::elem('br'),))
                          ;

              $row[] = $span;
            }
            $result = implode('', $row);
          } else {
            $result = _('No photos');
          }
        }
      }

      return $result;
    }

    public static function getAdminTitle() {
      $result = NULL;
      //prozatim by melo stacit na vraceni title
      $result = base64_decode(Core::isFill($_GET, 'id'));

      return $result;
    }

    public static function getAdminContent($co) {
      $result = NULL;
      $source_path = self::$source_path;
//var_dump(self::$source_path);//Config::SOURCE
      $absoluteurl = Core::getAbsoluteUrl(NULL, array('path' => Administration::ADMIN_URL));
      $get_adress = Administration::getGetAdress();

      $backarray = array($get_adress[0] => self::URL);
      $backarray_set = array('path' => Administration::ADMIN_URL);

      $xml_path = self::getXmlPath();

      switch ($co) {
        default:
          $load_data = self::loadXmlData();

          $key_load_data = array();
          $dirs = array();
          //if (is_array($load_data)) {
          $key_load_data = (is_array($load_data) ? array_keys($load_data) : array());

          $dirs = Core::getListDir(array('path' => $source_path, 'sort' => array(Core::LIST_SORT_SELF => $key_load_data)));

          $row = array();
          foreach ($dirs as $index => $dir) {
            $pathdir = sprintf('%s/%s', $source_path, $dir);

            $iddir = base64_encode($dir);
            $row_data = Core::isFill($load_data, $dir); //nactene data radku
            $activate = (boolean) Core::isFill($row_data, 'enabled'); //aktivace
            $links = array();
            if (empty($row_data)) {
              //neni v xml
              $links[] = Html::elem('a')
                              ->href($absoluteurl, array($get_adress[0] => self::URL, $get_adress[1] => 'activate', 'id' => $iddir))
                              ->setText(_('Activate'));
            } else {
              //je v xml
              $links[] = Html::elem('a')
                              ->href($absoluteurl, array($get_adress[0] => self::URL, $get_adress[1] => 'enabled', 'id' => $iddir))
                              ->setText($activate ? _('Disable') : _('Enable'));

              $links[] = Html::elem('a')  //strankovani
                              ->href($absoluteurl, array($get_adress[0] => self::URL, $get_adress[1] => 'page', 'id' => $iddir))
                              ->setText(_('Control pagination'));

              $links[] = Html::elem('a')  //rename
                              ->href($absoluteurl, array($get_adress[0] => self::URL, $get_adress[1] => 'rename', 'id' => $iddir))
                              ->setText(_('Rename'));

              $links[] = Html::elem('a')  //delete
                              ->href($absoluteurl, array($get_adress[0] => self::URL, $get_adress[1] => 'del', 'id' => $iddir))
                              ->setText(_('Delete'))
                              ->onClick(sprintf(_('return confirm(\'Really delete: &quot;%s&quot; ?\');'), $dir))
                              ;

              $links[] = Html::elem('a')  //delete content
                              ->href($absoluteurl, array($get_adress[0] => self::URL, $get_adress[1] => 'delall', 'id' => $iddir))
                              ->setText(_('Delete content'))
                              ->onClick(sprintf(_('return confirm(\'Really delete all content: &quot;%s&quot; ?\');'), $dir))
                              ;
            }

            $stav = (empty($row_data) ? 'neaktivovano' : ($activate ? 'povolene' : 'nepovolene'));
            $dir_size = Core::calculateSize(Core::getSizeDir($pathdir, true));  //cele slozky
            $count_pic = Core::getCountListFile(array('path' => $pathdir));
            //$owner = nameposix_getpwuid(fileowner($pathdir))
            $paginate = Core::isFill($row_data, 'paginate');

            $row_name = Html::elem('span')  //obal nazvu
                            ->setText($dir)
                            ->setText(sprintf(', %s', $dir_size)) //TODO predelat fotmat!!!
                            ->setText(sprintf(ngettext(', %s foto', ', %s fotos', $count_pic), $count_pic))
                            ->setText(sprintf(', -- %s --', $stav))
                            ->setText(sprintf(', strankovani: %s, na: %s', (Core::isFill($paginate, 'enabled') ? 'jo' : 'ne'), Core::isFill($paginate, 'perpage', 'nic')))
                            ->setText(sprintf(', perm: %s', Core::getFilePermissions($pathdir)))
                            ;

            $row[] = Html::elem('div')  //obal polozky
                          ->setDepth(2)
                          ->insert($row_name)
                          //->setDepth(3)
                          ->insert($links)
                          ->class('obal-jednoho-radku')
                          ->class($stav)
                          ->id(sprintf('arrays_%s', !empty($row_data) ? Core::encodeData($dir, true) : NULL))  //jen kdyz je slozka aktivovana

                          ;
          }

/*
        } else {
          $row[] = Html::elem('div')->setText(_('No dirs'));
        }
*/

          $status_drag = Html::elem('div')->id('status_drag');
          $createlink = Html::elem('a')->href($absoluteurl, array($get_adress[0] => self::URL, $get_adress[1] => 'create'))->setText(_('Create new dir'));

/* otazkou zustava jestli to ma tatko za kazdou cenu komplikovat?!
$jq = new jQuery;
$jq->addModule('.obal_razeni', 'sortable')
    ->tolerance('pointer')
    ->scroll(true)
    ->scrollSensitivity(40)
    ->scrollSpeed(30)
    ->revert(300)
    ->opacity(0.6)
    ->cursor('move')
    ->delay(150)
    ->update('...func...')
    ;
    $js = new JavaScript;
    $js->var('order', '$(this).sortable("serialize") + "&menu=%s&co=sortdirs"');
echo $jq;
echo $js;
*/

        $url = array ('menu' => __CLASS__,
                      'co' => 'sortdirs');

        $javascript = Html::elem('script')
                          ->type('text/javascript')
                          ->setText(sprintf('
$(document).ready(function(){
  $(function() {
    $(".obal_razeni").sortable({
                      tolerance: \'pointer\',
                      scroll: true,
                      scrollSensitivity: 40,
                      scrollSpeed: 30,
                      revert: 300,
                      opacity: 0.6,
                      cursor: \'move\',
                      delay: 150,
                      update: function() {
      var order = $(this).sortable("serialize") + "&%s";
      $.post("%sajax.php", order, function(theResponse) {
        $("#status_drag").html(theResponse);
      });
      ZpracujHlasku(\'#status_drag\');
    }
    });
  });
});

function ZpracujHlasku(ret) {
  $(ret).fadeIn(\'slow\').delay(2000).fadeOut(\'slow\');
}', http_build_query($url), self::$web_path))
                          ->appendAfter(array($status_drag, $createlink));

        $result = Html::elem('div')
                      ->setDepth(1)
                      ->appendBefore($javascript)
                      ->insert($row)
                      ->class('obal_razeni')
                      ->setText(self::synchronizeXml($key_load_data, $dirs))
                      ;
        break;

        case 'activate':  //activate dirs
          try {

            $id = base64_decode(Core::isFill($_GET, 'id'));
            $safename = Core::getInteligentRewrite($id);
            $data = self::loadXmlData();

            $final = array();
            $new = array($safename => array('enabled' => true));
            if (is_array($data) && !array_key_exists($safename, $data)) {
              if ($id != $safename) {
                if (!@rename(sprintf('%s/%s', $source_path, $id), sprintf('%s/%s', $source_path, $safename))) {
                  throw new ExceptionModuleDirs(_('nepovedlo se prejmenovat slozku! naprav to! nemas asi prava!'));
                }
              }

              $final = array_merge($data, $new);
            } else {
              $final[] = $new;
            }

            if (XmlStorage::setData($xml_path, $final)) {
              $result = _('Activated');
              Core::setRefresh(Config::TIME_EDIT, Core::getAbsoluteUrl($backarray, $backarray_set));
            }

          } catch (ExceptionModuleDirs $e) {
            echo $e;
          }
        break;

        case 'enabled': //enabled/disable dirs
          $id = base64_decode(Core::isFill($_GET, 'id'));
          $data = self::loadXmlData();

          $data[$id]['enabled'] = !(boolean) $data[$id]['enabled'];

          if (XmlStorage::setData($xml_path, $data)) {
            $result = ($data[$id]['enabled'] ? _('Enabled') : _('Disabled'));
            Core::setRefresh(Config::TIME_EDIT, Core::getAbsoluteUrl($backarray, $backarray_set));
          }
        break;

        case 'page':  //nastavovani strankovani
          $id = base64_decode(Core::isFill($_GET, 'id'));
          $data = self::loadXmlData();

          $paginate = Core::isFill($data[$id], 'paginate', NULL);

          $form = new Form;
          $form->addBackLink(_('Back'), $absoluteurl, $backarray)
                ->addCheckbox('enablepage', array('label' => _('Enable pagination'), 'checked' => Core::isFill($paginate, 'enabled', false)))
                  ->setTypeVariable(Form::TYPE_BOOL)
                ->addText('perpage', array('value' => Core::isFill($paginate, 'perpage', 1), 'label' => _('Number items per page')))
                  ->setTypeVariable(Form::TYPE_INTEGER)
                ->addSubmit(__CLASS__.'_submit', array('value' => _('Set pagination')));

          $result = $form;

          if ($form->isSubmitted()) {
            $data[$id]['paginate'] = array('enabled' => $form->enablepage,
                                          'perpage' => $form->perpage);

            if (XmlStorage::setData($xml_path, $data)) {
              $result = _('Settings pagination sucessfull');
              Core::setRefresh(Config::TIME_EDIT, Core::getAbsoluteUrl($backarray, $backarray_set));
            }
          }

          if ($form->isErrors()) {
            $result .= $form->getErrors();
          }
        break;

        case 'create':  //create new dir
          try {

            $form = new Form;
            $form->addBackLink(_('Back'), $absoluteurl, $backarray)
                  ->addText('namedir', array('value' => '', 'label' => _('Name for new dir'), 'placeholder' => _('Here type name directory...')))
                  ->addSubmit(__CLASS__.'_submit', array('value' => _('Create')))
            ;

            $result = $form;

            if ($form->isSubmitted()) {
              $namedir = $form->getValue('namedir');
              $pathdir = sprintf('%s/%s', $source_path, $namedir);
              if (!file_exists($pathdir)) {
                if (@mkdir($pathdir)) {
                  $result = sprintf(_('Successfully created directory "%s"!'), $namedir);
                } else {
                  throw new ExceptionModuleDirs(sprintf(_('Cannot create directory "%s"!'), $namedir));
                }
              } else {
                throw new ExceptionModuleDirs(sprintf(_('Name "%s" already exists!'), $namedir));
              }

              Core::setRefresh(Config::TIME_EDIT, Core::getAbsoluteUrl($backarray, $backarray_set));
            }

          } catch (ExceptionModuleDirs $e) {
            echo $e;
          }
        break;

        case 'rename':  //rename dirs
          try {

            $id = base64_decode(Core::isFill($_GET, 'id'));
            $data = self::loadXmlData();

            $backarray = array($get_adress[0] => self::URL);

            $form = new Form;
            $form->addBackLink(_('Back'), $absoluteurl, $backarray)
                  ->addText('dir', array('value' => $id, 'label' => _('New name dir')))
                  ->addSubmit(__CLASS__.'_submit', array('value' => _('Save')))
            ;

            $result = $form;

            if ($form->isSubmitted()) {
              $values = $form->getValues();
              $newname = Core::getInteligentRewrite($values['dir']);
              if ($id != $newname) {
                if (!@rename(sprintf('%s/%s', $source_path, $id), sprintf('%s/%s', $source_path, $newname))) {
                  throw new ExceptionModuleDirs(_('nepovedlo se prejmenovat slozku! naprav to! nemas asi prava!'));
                }
                $data[$newname] = $data[$id]; //preneseni stareho id do noveho
                $data[$id] = NULL;  //odstraneni indexu

                if (XmlStorage::setData($xml_path, $data)) {
                  $result = _('Renamed');
                }
              } else {
                $result = _('nothing renamed, name is equally');
              }

              Core::setRefresh(Config::TIME_EDIT, Core::getAbsoluteUrl($backarray, $backarray_set));
            }

          } catch (ExceptionModuleDirs $e) {
            echo $e;
          }
        break;

        case 'del':
          try {

            $id = base64_decode(Core::isFill($_GET, 'id'));
            $data = self::loadXmlData();

            $path = sprintf('%s/%s', $source_path, $id);
            if (!file_exists($path)) {
              throw new ExceptionModuleDirs(sprintf(_('adresar: <strong>%s</strong> neexistuje !'), $path));
            }

            $subcont = Core::getListRecursiveAll(array('path' => $path, 'full' => true));

            if (!empty($subcont)) {
              //smazani obsahu
              foreach ($subcont as $file) {
                if (is_writable($file)) {
                  if (is_file($file)) {
                    if (!@unlink($file)) {
                      throw new ExceptionModuleDirs(sprintf(_('nepovelo se smazat soubor: <strong>%s</strong> !'), $file));
                    }
                  }

                  if (is_dir($file)) {
                    if (!@rmdir($file)) {
                      throw new ExceptionModuleDirs(sprintf(_('nepovelo se smazat sub adresar: <strong>%s</strong> !'), $file));
                    }
                  }
                } else {
                  throw new ExceptionModuleDirs(sprintf(_('spatne prava pro smazani: <strong>%s</strong> !'), $file));
                }
              }
            }
            //nakonec smazani samotneho adresare
            if (!@rmdir($path)) {
              throw new ExceptionModuleDirs(sprintf(_('nepovelo se smazat adresar: <strong>%s</strong> !'), $path));
            }

            //pokud je vse uspesne smazano tak muze odmaznout i zaznam...
            $data[$id] = NULL;

            if (XmlStorage::setData($xml_path, $data)) {
              $result = _('Deleted');
              Core::setRefresh(Config::TIME_EDIT, Core::getAbsoluteUrl($backarray, $backarray_set));
            }

          } catch (ExceptionModuleDirs $e) {
            echo $e;
          }
        break;

        case 'delall':
          try {
            $id = base64_decode(Core::isFill($_GET, 'id'));

            $path = sprintf('%s/%s', $source_path, $id);

            $subcont = Core::getListRecursiveAll(array('path' => $path, 'full' => true, 'onlyfile' => true));
            if (!empty($subcont)) {
              foreach ($subcont as $file) {
                if (is_writable($file) && is_file($file)) {
                  if (@!unlink($file)) {
                    throw new ExceptionModuleDirs(sprintf(_('File "%s" does not delete!'), $file));
                  }
                }
              }

              $result = _('All content deleted');
              Core::setRefresh(Config::TIME_EDIT, Core::getAbsoluteUrl($backarray, $backarray_set));
            } else {
              $result = _('No content');
              Core::setRefresh(Config::TIME_EDIT, Core::getAbsoluteUrl($backarray, $backarray_set));
            }

          } catch (ExceptionModuleDirs $e) {
            echo $e;
          }
        break;
      }

      return $result;
    }

    public static function getAjax() {
      $result = NULL;

      $co = Core::isFill($_POST, 'co');

      switch ($co) {
        case 'sortdirs':
          $arrays = Core::isFill($_POST, 'arrays');

          $xml_path = self::getXmlPath();

          $data = self::loadXmlData();

          $decode_array = array_map('base64_decode', $arrays);

          $new_data = array();
          foreach ($decode_array as $dir) {
            $new_data[$dir] = $data[$dir];  //preskladani pole
          }

          if (XmlStorage::setData($xml_path, $new_data)) {
            $result = _('Sucessfull saved');
          }
        break;
      }

      return $result;
    }
  }

  class ExceptionModuleDirs extends Exception {}

?>
