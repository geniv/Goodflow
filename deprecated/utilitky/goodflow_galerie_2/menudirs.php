<?php
/*
 *      menudirs.php
 *
 *      Copyright 2011 geniv <geniv.radek@gmail.com>
 *
 */

  final class MenuDirs {  //extends MenuMaster
    const URL = 'dir';

    public static function getName() {
      return _('Directory');
    }

    public static function getXmlPath() {
      return XmlStorage::getAutoPath(__DIR__, __CLASS__);
    }

    public static function getActivatedMenu() {
      $xml_path = self::getXmlPath();
      $load_data = XmlStorage::getData($xml_path, false);
      $result = array();
      foreach ($load_data as $dir => $conf) {
        $enabled = (boolean) $conf['enabled'];
        if ($enabled) {
          $result[$dir] = $conf;
        }
      }

      return $result;
    }

    protected static function synchronizeXml($load, $dirs) {
      $result = NULL;

      $xml_path = self::getXmlPath();

      $load_data = XmlStorage::getData($xml_path, false);

      $diff = array_diff($load, $dirs);
      if (!empty($diff)) {
        foreach ($diff as $dir) {
          $load_data[$dir] = NULL;
        }

        if (XmlStorage::setData($xml_path, $load_data)) {
          $result = _('synchronized');
          $get_adress = Administration::getGetAdress();
          Core::setRefresh(1, Core::getAbsoluteUrl(array($get_adress[0] => self::URL)));
        }
      }

      return $result;
    }

    //mazani souboru i  s obrazky, prejmenovani, drag razeni, potvrzovani, heslovani slozek
    public static function getContent($co) {
      $result = NULL;
      $source_path = Config::SOURCE;
      if (!file_exists($source_path)) {
        echo 'neexistuje slozka';
        exit();
      }

      $absoluteurl = Core::getAbsoluteUrl();
      $get_adress = Administration::getGetAdress();

      $xml_path = self::getXmlPath();
//TODO zabudovat: TIME_LOGIN, TIME_EDIT
//TODO vytvareni slozek do adminu... pro obrazky
//TODO dodelat back-linky, vsude!!!!
      switch ($co) {
        default:
          $load_data = XmlStorage::getData($xml_path, false);

          $key_load_data = array_keys($load_data);
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

              $links[] = Html::elem('a')  //rename
                              ->href($absoluteurl, array($get_adress[0] => self::URL, $get_adress[1] => 'rename', 'id' => $iddir))
                              ->setText(_('Rename'))
                              ;
              $links[] = Html::elem('a')  //delete
                              ->href($absoluteurl, array($get_adress[0] => self::URL, $get_adress[1] => 'del', 'id' => $iddir))
                              ->setText(_('Delete'))
                              ->onClick(sprintf('return confirm(\'Opravdu smazat: &quot;%s&quot; ?\');', $dir))
                              ;
            }

            $stav = (empty($row_data) ? 'neaktivovano' : ($activate ? 'povolene' : 'nepovolene'));
            $dir_size = Core::calculateSize(Core::getSizeDir($pathdir, true));  //cele slozky
            $count_pic = Core::getCountListFile(array('path' => $pathdir));
            $row_name = Html::elem('span')  //obal nazvu
                            ->setText($dir)
                            ->setText(sprintf(', %s', $dir_size))
                            ->setText(sprintf(ngettext(', %s foto', ', %s fotos', $count_pic), $count_pic))
                            ->setText(sprintf(', -- %s --', $stav))
                            ->setText(sprintf(', permission: %s', Core::getFilePermissions($pathdir)))
                            ;

            $row[] = Html::elem('div')  //obal polozky
                          ->setDepth(2)
                          ->insert($row_name)
                          //->setDepth(3)
                          ->insert($links)
                          ->class('obal-jednoho-radku')
                          ->class($stav)
                          ->id(sprintf('arrays_%s', !empty($row_data) ? urlencode($iddir) : NULL))  //jen kdyz je slozka aktivovana
                          //->class('lool')
                          //->class('laaaaaaaaaaaaaaaakkkkkkkkkk')
                          //->style('a', 'b')
                          //->style('c', 'd')
                          //->style(array('e' => 'f', 'g' => 'h'))
                          ;
          }
//TODO poresit umisteni JS!
          $javascript = '
<script type="text/javascript">
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
        var order = $(this).sortable("serialize") + "&menu='.__CLASS__.'&co=sortdirs";
        $.post("ajax.php", order, function(theResponse) {
          $("#status_drag").html(theResponse);
        });
        ZpracujHlasku(\'#status_drag\');
      }
      });
    });
  });

  function ZpracujHlasku(ret) {
    $(ret).fadeIn(\'slow\').delay(2000).fadeOut(\'slow\');
  }
</script>
<div id="status_drag"></div>
';

          $result = Html::elem('div')
                        ->setDepth(1)
                        ->insert($row)
                        ->class('obal_razeni')
                        ->setText($javascript)
                        ->setText(self::synchronizeXml($key_load_data, $dirs))
                        ;
        break;

        case 'activate':  //activate dirs
          try {

            $id = base64_decode(Core::isFill($_GET, 'id'));
            $safename = Core::getInteligentRewrite($id);
            $data = XmlStorage::getData($xml_path, false);

            $final = array();
            if (!array_key_exists($safename, $data)) {
              $new = array($safename => array('enabled' => true));

              if ($id != $safename) {
                if (!@rename(sprintf('%s/%s', $source_path, $id), sprintf('%s/%s', $source_path, $safename))) {
                  throw new ExceptionMenuDirs;
                }
              }

              $final = array_merge($data, $new);
            }

            if (XmlStorage::setData($xml_path, $final)) {
              $result = _('activated');
              Core::setRefresh(1, Core::getAbsoluteUrl(array($get_adress[0] => self::URL)));
            }

          } catch (ExceptionMenuDirs $e) {
            echo 'nepovedlo se prejmenovat slozku! naprav to! nemáš asi práva!';
          }
        break;

        case 'enabled': //enabled/disable dirs
          $id = base64_decode(Core::isFill($_GET, 'id'));
          $data = XmlStorage::getData($xml_path, false);

          $data[$id]['enabled'] = !(boolean) $data[$id]['enabled'];

          if (XmlStorage::setData($xml_path, $data)) {
            $result = ($data[$id]['enabled'] ? _('Enabled') : _('Disabled'));
            Core::setRefresh(1, Core::getAbsoluteUrl(array($get_adress[0] => self::URL)));
          }
        break;

        case 'rename':  //rename dirs
          try {

            $id = base64_decode(Core::isFill($_GET, 'id'));
            $data = XmlStorage::getData($xml_path, false);

            $form = new Form;
            $form->addText('dir', array('value' => $id, 'label' => 'name new dir'))
                  ->addSubmit(__CLASS__.'_submit', array('value' => _('Save')))
            ;

            $result = $form;

            if ($form->isSubmitted()) {
              $values = $form->getValues();
              $newname = Core::getInteligentRewrite($values['dir']);
              if ($id != $newname) {
                if (!@rename(sprintf('%s/%s', $source_path, $id), sprintf('%s/%s', $source_path, $newname))) {
                  throw new ExceptionMenuDirs;
                }
                $data[$newname] = $data[$id]; //preneseni stareho id do noveho
                $data[$id] = NULL;  //odstraneni indexu

                if (XmlStorage::setData($xml_path, $data)) {
                  $result = _('renamed');
                }
              } else {
                $result = _('nothing renamed, name is equally');
              }

              Core::setRefresh(1, Core::getAbsoluteUrl(array($get_adress[0] => self::URL)));
            }

          } catch (ExceptionMenuDirs $e) {
            echo 'nepovedlo se prejmenovat slozku! naprav to! nemáš asi práva!';
          }
        break;

        case 'del':
          try {

            $id = base64_decode(Core::isFill($_GET, 'id'));
            $data = XmlStorage::getData($xml_path, false);

            $path = sprintf('%s/%s', $source_path, $id);
            if (!file_exists($path)) {
              throw new ExceptionMenuDirs($path, 103);
            }

            $subcont = Core::getListRecursiveAll(array('path' => $path, 'full' => true));

            if (!empty($subcont)) {
              //smazani obsahu
              foreach ($subcont as $file) {
                if (is_writable($file)) {
                  if (is_file($file)) {
                    if (!@unlink($file)) {
                      throw new ExceptionMenuDirs($file, 100);
                    }
                  }

                  if (is_dir($file)) {
                    if (!@rmdir($file)) {
                      throw new ExceptionMenuDirs($file, 101);
                    }
                  }
                } else {
                  throw new ExceptionMenuDirs($file, 102);
                }
              }
            }
            //nakonec smazani samotne fotky
            if (!@rmdir($path)) {
              throw new ExceptionMenuDirs($path, 101);
            }

            //pokud je vse uspesne smazano tak muze odmaznout i zaznam...
            $data[$id] = NULL;

            if (XmlStorage::setData($xml_path, $data)) {
              $result = _('deleted');
              Core::setRefresh(1, Core::getAbsoluteUrl(array($get_adress[0] => self::URL)));
            }

          } catch (ExceptionMenuDirs $e) {
            $msg = $e->getMessage();
            switch ($e->getCode()) {
              case 100:
                $result = sprintf('nepovelo se smazat soubor: <strong>%s</strong> !', $msg);
              break;

              case 101:
                $result = sprintf('nepovelo se smazat adresar: <strong>%s</strong> !', $msg);
              break;

              case 102:
                $result = sprintf('spatne prava pro smazani: <strong>%s</strong> !', $msg);
              break;

              case 103:
                $result = sprintf('adresar: <strong>%s</strong> neexistuje !', $msg);
              break;
            }
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

          $data = XmlStorage::getData($xml_path, false);

          $decode_array = array_map('base64_decode', $arrays);

          $new_data = array();
          foreach ($decode_array as $dir) {
            $new_data[$dir] = $data[$dir];  //preskladani pole
          }

          if (XmlStorage::setData($xml_path, $new_data)) {
            $result = _('sucessfull saved');
          }
        break;
      }

      return $result;
    }
  }

  class ExceptionMenuDirs extends Exception {}

?>
