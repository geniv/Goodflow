<?php
/*
 *      menupictures.php
 *
 *      Copyright 2011 geniv <geniv.radek@gmail.com>
 *
 */

  final class MenuPictures {
    const URL = 'file';

    public static function getName() {
      return _('Pictures');
    }

    protected static function getFirstNotExistThumb($path) {
      $files = Core::getListFile(array('path' => $path));

      $result = NULL;
      foreach ($files as $file) {
        $mini_path = sprintf('%s/%s/%s', $path, Config::THUMB, $file);
        if (!file_exists($mini_path)) {
          $result = urlencode(base64_encode(sprintf('%s/%s', $path, $file)));
          break;
        }
      }

      return $result;
    }

    protected static function synchronizeXml($id) {
      $result = NULL;

      $source_path = Config::SOURCE;

      $get_adress = Administration::getGetAdress();
      $xml_path = MenuDirs::getXmlPath();

      $full_path = sprintf('%s/%s', $source_path, $id);
      $full_files = Core::getListFile(array('path' => $full_path));

      $mini_path = sprintf('%s/%s/%s', $source_path, $id, Config::THUMB);
      $mini_files = Core::getListFile(array('path' => $mini_path));

      $load_data = XmlStorage::getData($xml_path, false);
      $load = array_keys($load_data[$id]['files']);

      //xml, mini
      $diff = array_diff($load, $mini_files);
      if (!empty($diff)) {
        foreach ($diff as $file) {
          //jsou navic na databazi => vymazani z databaze
          $load_data[$id]['files'][$file] = NULL;
        }

        if (XmlStorage::setData($xml_path, $load_data)) {
          $result = _('xml mini synchronized');
          Core::setRefresh(1, Core::getAbsoluteUrl(array($get_adress[0] => self::URL, $get_adress[1] => 'dir', 'id' => base64_encode($id))));
        }
      }

      //xml, full
      $diff = array_diff($load, $full_files);
      if (!empty($diff)) {
        foreach ($diff as $file) {
          //jsou navic na databazi => vymazani z databaze
          $load_data[$id]['files'][$file] = NULL;
        }

        if (XmlStorage::setData($xml_path, $load_data)) {
          $result = _('xml full synchronized');
          Core::setRefresh(1, Core::getAbsoluteUrl(array($get_adress[0] => self::URL, $get_adress[1] => 'dir', 'id' => base64_encode($id))));
        }
      }

      //filesystem, mini
      $diff = array_diff($mini_files, $load); //tady je opacna strategie diffu
      if (!empty($diff)) {
        foreach ($diff as $file) {
          //jsou navic ve filesystemu => vymazani z filesystemu
          //FIXME osetreni stavu kdyz by to neslo smazat!
          if (unlink(sprintf('%s/%s', $mini_path, $file))) {
            $result .= _('file full synchronized');
            Core::setRefresh(1, Core::getAbsoluteUrl(array($get_adress[0] => self::URL, $get_adress[1] => 'dir', 'id' => base64_encode($id))));
          }
        }
      }

      return $result;
    }

    //uprava komentaru a mazani obrazku
    public static function getContent($co) {
      $result = NULL;
      $source_path = Config::SOURCE;

      $absoluteurl = Core::getAbsoluteUrl();
      $get_adress = Administration::getGetAdress();

      $xml_path = MenuDirs::getXmlPath();

      switch ($co) {
        default:  //vypis
          $dirs = MenuDirs::getActivatedMenu();

          $row = array();
          foreach ($dirs as $dir => $conf) {
            $iddir = base64_encode($dir);
//var_dump($conf['files']);
            $full_path = sprintf('%s/%s', $source_path, $dir);
            $full_count = Core::getCountListFile(array('path' => $full_path));

            $thumb_path = sprintf('%s/%s/%s', $source_path, $dir, Config::THUMB);
            $thumb_count = 0;
            if (file_exists($thumb_path)) {
              $thumb_count = Core::getCountListFile(array('path' => $thumb_path));
            }

            $links = array();
            if (!empty($conf['files'])) {
              $links[] = Html::elem('a')
                              ->href($absoluteurl, array($get_adress[0] => self::URL, $get_adress[1] => 'dir', 'id' => $iddir))
                              ->setText($dir)
                              ;
            } else {
              $links[] = Html::elem('span')
                              ->setText($dir)
                              ;
            }

            //pokud je pocet full >0 a v thumb neni nic
            //nebo jsou full, jsou thumb ale full neni stejny jako thumb
            if (($full_count > 0 && $thumb_count == 0) ||
                ($full_count > 0 && $thumb_count > 0 && $full_count != $thumb_count)) {
              $links[] = Html::elem('a')
                              ->href($absoluteurl, array($get_adress[0] => self::URL, $get_adress[1] => 'gen', 'id' => $iddir))
                              ->setText(_('Generated miniaturs'));
            }

            $links[] = Html::elem('a')
                            ->href($absoluteurl, array($get_adress[0] => self::URL, $get_adress[1] => 'reg', 'id' => $iddir))
                            ->setText(_('Registration foto'));

            $row_name = Html::elem('span')  //obal nazvu
                            //->setText($dir)
                            ->insert($links)
                            //->setText(sprintf(', %s', $dir_size))
                            //->setText(sprintf(', fotek: %s', $count_pic))
                            //->setText(sprintf(', -- %s --', $stav))
                            ;

            $row[] = Html::elem('div')  //obal polozky
                          ->setDepth(2)
                          ->insert($row_name)
                          //->setDepth(3)
                          //->insert($links)
                          //->class('obal-jednoho-radku')
                          //->class($stav)
                          ;
          }

          $result = Html::elem('div')
                        ->setDepth(1)
                        ->insert($row)
                        ->class('cely-obal-nactenych-slozek')
                        ;
        break;

        case 'dir': //vybrana galerie
          $hashid = Core::isFill($_GET, 'id');
          $id = base64_decode($hashid);

          $row = array();

          $load_data = XmlStorage::getData($xml_path, false);

          foreach ($load_data[$id]['files'] as $file => $comment) {
            $idfile = base64_encode($file);

            $mini_path = sprintf('%s/%s/%s/%s', $source_path, $id, Config::THUMB, $file);
            $full_path = sprintf('%s/%s/%s', $source_path, $id, $file);
//TODO kontrolovat velikost obrazku! musi byt > 0 !!!
            $stav = NULL;
            if (!file_exists($mini_path)) {
              //chyby mini -> oprava
              $stav = Html::elem('span')->setText('neexistuje miniatura! => dá se opravit!');
            }

            if (!file_exists($full_path)) {
              //chyby full -> oprava
              $stav = Html::elem('span')->setText('neexistuje full obrazek! => neopravitelne!');
            }

            if (file_exists($mini_path) &&
                file_exists($full_path)) {
              //vse redy
              $stav = Html::elem('span')->setText('obrazek je kompletni!');
            }

            $img = Html::elem('img')
                        ->src(sprintf('%s%s/%s/%s/%s', $absoluteurl, Config::SOURCE, $id, Config::THUMB, $file))
                        ;

            $links = array();
            $links[] = Html::elem('a')
                        ->href(sprintf('%s%s/%s/%s', $absoluteurl, Config::SOURCE, $id, $file))
                        ->setDepth(2)
                        ->insert($img)
                        ->appendAfter(Html::elem('br'))
                        ;

            $links[] = Html::elem('a')
                            ->href($absoluteurl, array($get_adress[0] => self::URL, $get_adress[1] => 'edit', 'iddir' => $hashid, 'id' => $idfile))
                            ->setText(_('edit comment picture'))
                            ;

            $links[] = Html::elem('a')
                            ->href($absoluteurl, array($get_adress[0] => self::URL, $get_adress[1] => 'del', 'iddir' => $hashid, 'id' => $idfile))
                            ->setText(_('delete picture'))
                            ->onClick(sprintf('return confirm(\'Opravdu smazat: &quot;%s&quot; ?\');', $file))
                            ;

            $html_com = Html::elem('span')
                            //->setText($file.'<br />')
                            ->setText($comment)
                            ->setText(Html::elem('br'))
                            ->class('komentar obrazku')
                            ;

            $row[] = Html::elem('div')
                          ->setDepth(1)
                          ->insert($html_com)
                          ->insert($links)
                          ->insert($stav)
                          ->class('obal jednoho obrazku')
                          ->id(sprintf('arrays_%s', urlencode($idfile)))
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
        var order = $(this).sortable("serialize") + "&menu='.__CLASS__.'&co=sortdirs&iddir='.urlencode($hashid).'";
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
                          ->insert($row)
                          ->setText($javascript)
                          ->setText(self::synchronizeXml($id))
                          ->class('obal_razeni')
                          ;
        break;

        case 'gen':  //generovani miniatur
          try {

            $id = base64_decode(Core::isFill($_GET, 'id'));
            $originalid = Core::isFill($_GET, 'id');

            $pathdir = sprintf('%s/%s', $source_path, $id);
            $mini_path = sprintf('%s/%s', $pathdir, Config::THUMB);

            if (is_writable($pathdir)) {
              if (!file_exists($mini_path)) {
                if (!@mkdir($mini_path)) {
                  throw new ExceptionMenuPictures(NULL, 100);
                }
              }
            } else {
              throw new ExceptionMenuPictures($pathdir, 101);
            }

            $count_file = Core::getCountListFile(array('path' => $pathdir));
            if ($count_file <= 0) {
              throw new ExceptionMenuPictures(NULL, 102);
            }

            $file = self::getFirstNotExistThumb($pathdir);
            //FIXME pokud neni prazdny

            $data_settings = MenuSettings::getXmlData();
            $minsize = urlencode(base64_encode($data_settings['minsize']));
            $maxsize = urlencode(base64_encode($data_settings['maxsize']));

            $result = '

            <script type="text/javascript">

              function generovani() {

                var index = location.hash.substr(1);
                $(document).ready(function() {
                  $.post("ajax.php", "menu='.__CLASS__.'&co=gen&index="+index+"&count='.$count_file.'&min='.$minsize.'&max='.$maxsize.'", function(data) {
                    $(\'#status_drag\').html(data);
                  });
                });

              }

              location.hash = "'.$file.'";
              generovani();

            </script>
            <div id="status_drag"></div>
            ';

          } catch (ExceptionMenuPictures $e) {
            switch ($e->getCode()) {
              case 100:
                echo 'nelze vytvořir složku pro miniatury';
              break;

              case 101:
                echo sprintf('nelze zapisovat do slozky %s!', $e->getMessage());
              break;

              case 102:
                echo 'nelze vytvaret miniatury ve slozce ve ktere neni zadny obrazek!';
              break;
            }
          }
        break;

        case 'reg':

          $id = base64_decode(Core::isFill($_GET, 'id'));

          $pathdir = sprintf('%s/%s', $source_path, $id);

          $load_data = XmlStorage::getData($xml_path, false);

          $files = Core::getListFile(array('path' => $pathdir));
          foreach ($files as $file) {
            $load_data[$id]['files'][$file] = $file;  //zakladni komentar
          }

          if (XmlStorage::setData($xml_path, $load_data)) {
            $result = _('Photos sucessfull registred!');
            Core::setRefresh(1, Core::getAbsoluteUrl(array($get_adress[0] => self::URL)));
          }

        break;

        case 'edit': //uprava komentaru
          $hashiddir = Core::isFill($_GET, 'iddir');
          $iddir = base64_decode($hashiddir);
          $id = base64_decode(Core::isFill($_GET, 'id'));

          $load_data = XmlStorage::getData($xml_path, false);

          $form = new Form;
          $form->addTextArea('comment', array('label' => _('comment:'), 'value' => $load_data[$iddir]['files'][$id]))
                ->addSubmit(__CLASS__.'_submit', array('value' => _('edit comment')));

          $result = $form;

          if ($form->isSubmitted()) {

            $values = $form->getValues();
            $load_data[$iddir]['files'][$id] = $values['comment'];

            if (XmlStorage::setData($xml_path, $load_data)) {
              $result = _('Comment saved!');
              Core::setRefresh(1, Core::getAbsoluteUrl(array($get_adress[0] => self::URL, $get_adress[1] => 'dir', 'id' => $hashiddir)));
            }
          }
        break;

        case 'del': //mazani mini a full
          try {

            $hashiddir = Core::isFill($_GET, 'iddir');
            $iddir = base64_decode($hashiddir);
            $id = base64_decode(Core::isFill($_GET, 'id'));

            $mini_path = sprintf('%s/%s/%s/%s', $source_path, $iddir, Config::THUMB, $id);
            $full_path = sprintf('%s/%s/%s', $source_path, $iddir, $id);

            if (!@unlink($mini_path)) {
              throw new ExceptionMenuPictures($mini_path, 100);
            }

            if (!@unlink($full_path)) {
              throw new ExceptionMenuPictures($full_path, 101);
            }

            $load_data = XmlStorage::getData($xml_path, false);

            $load_data[$iddir]['files'][$id] = NULL;

            if (XmlStorage::setData($xml_path, $load_data)) {
              $result = _('deleted');
              Core::setRefresh(1, Core::getAbsoluteUrl(array($get_adress[0] => self::URL, $get_adress[1] => 'dir', 'id' => $hashiddir)));
            }

          } catch (ExceptionMenuPictures $e) {
            $msg = $e->getMessage();
            switch ($e->getCode()) {
              case 100:
                $result = sprintf('nepodarilo se smazat miniaturu: %s !', $msg);
              break;

              case 101:
                $result = sprintf('nepodarilo se smazat full: %s !', $msg);
              break;
            }
          }
        break;

      }

      return $result;
    }

    public static function getAjax() {
      $result = NULL;

      $get_adress = Administration::getGetAdress();
//TODO pridat multi-uploady na vlastni nahravani do vybrane slozky
      $co = Core::isFill($_POST, 'co');
      switch ($co) {
        case 'gen':
          $id = base64_decode(Core::isFill($_POST, 'index'));

          $minsize = base64_decode(Core::isFill($_POST, 'min'));
          $maxsize = base64_decode(Core::isFill($_POST, 'max'));

          if (!empty($id) && file_exists($id)) {

            $pathdir = dirname($id);
            $filename = basename($id);

            $full_path = $id;

            $mini_path = sprintf('%s/%s/%s', $pathdir, Config::THUMB, $filename);
  //FIXME mini path musi existovat!!! a musi tam byt pravo zapisu!!!!
  //a hlavne nesmi byt prazdna slozka!!!

            if (!file_exists($mini_path)) {
              $image = new Imagic($full_path);  //uprava mini
              $size = explode('x', $minsize);
              $image->thumbnailImage($size[0], $size[1], true);
              $image->writeImage($mini_path);
            }
//TODO pokud ma zanechat velikost jako 0x0 tak se zmensovani full uplne preskoci!!!
//toto cele zapinat checkboxem, moznost vkladat obrazokovy podpis (obrazek), pozice x x x 3x pod sebou, odsazeni, a upload toho obrazku v nastaveni
            $image = new Imagic($full_path);  //uprava full
            $size = explode('x', $maxsize);
            $image->thumbnailImage($size[0], $size[1], true);
            $image->writeImage();

            $count = $_POST['count'];

            $mini_path = sprintf('%s/%s', $pathdir, Config::THUMB);
            //nepocitat index ale brat prvni neexistujici miniaturu!
            $index = Core::getCountListFile(array('path' => $mini_path));

            $proc = round((100 / $count) * $index);

            $file = self::getFirstNotExistThumb($pathdir);
            if (!empty($file)) {
              $result = Html::elem('div') //100ms pockat
                          ->setText(sprintf('%s z %s, %s%%<script type="text/javascript">%s</script>',
                                    $index, $count, $proc, ($index != $count ? 'location.hash = "'.$file.'"; setTimeout("generovani()", 500);' : '')));
            } else {
              $result = _('Photos sucessfull generated!');
              $url = Core::getAbsoluteUrl(array($get_adress[0] => self::URL, $get_adress[1] => 'reg', 'id' => base64_encode(basename($pathdir))));
              //TODO tady je to zatim zamerne bez prodlevy, prodlevu by obstaraval stejne settimeout, viz vyse...
              $result .= '<script type="text/javascript">location.href="'.$url.'";</script>';
            }
          }

        break;

        case 'sortdirs':
          $arrays = Core::isFill($_POST, 'arrays');

          $iddir = base64_decode(Core::isFill($_POST, 'iddir'));

          $xml_path = MenuDirs::getXmlPath();

          $data = XmlStorage::getData($xml_path, false);

          $decode_array = array_map('base64_decode', $arrays);

          $new_data = array();
          foreach ($decode_array as $file) {
            $new_data[$file] = $data[$iddir]['files'][$file];  //preskladani pole
          }

          $data[$iddir]['files'] = $new_data;

          if (XmlStorage::setData($xml_path, $data)) {
            $result = _('sucessfull saved');
          }
        break;
      }

      return $result;
    }
  }

  class ExceptionMenuPictures extends Exception {}

?>
