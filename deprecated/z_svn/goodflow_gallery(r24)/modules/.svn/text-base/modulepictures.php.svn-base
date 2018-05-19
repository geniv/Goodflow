<?php
/*
 *      modulepictures.php
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
      classes\Imagic,
      configs\Config,
      Exception;

  final class ModulePictures implements Module {
    const URL = 'file';
    const VERSION = '1.5';

    public static function getName() {
      return _('Pictures');
    }

    public static function getState() {
      try {

        $result = true;
        //var_dump(class_exists('Imagic'));
//TODO musi si kontrolovat pritomnost imagicu!!
//++slozky galerie!

      } catch (ExceptionModulePictures $e) {
        echo $e;
      }

      return $result;
    }

    private static $web_path = NULL;
    private static $source_path = NULL;

    public static function setWebPath($path = NULL) {
      self::$web_path = $path;
      self::$source_path = sprintf('%s%s', self::$web_path, Config::SOURCE);
      //var_dump(self::$source_path);
    }

    private static function synchronizeXml($id) {
      $result = NULL;

      $source_path = self::$source_path;
      //Config::SOURCE;

      $get_adress = Administration::getGetAdress();
      $xml_path = ModuleDirs::getXmlPath();

      $full_path = sprintf('%s/%s', $source_path, $id);
      $full_files = Core::getListFile(array('path' => $full_path));

      $mini_path = sprintf('%s/%s/%s', $source_path, $id, Config::THUMB);
      $mini_files = Core::getListFile(array('path' => $mini_path));

      $backarray = array($get_adress[0] => self::URL, $get_adress[1] => 'dir', 'id' => base64_encode($id));
      $backarray_set = array('path' => Administration::ADMIN_URL);

      $load_data = XmlStorage::getData($xml_path);
      if (!empty($load_data[$id]['files'])) {
        //$loadfiles = $load_data[$id]['files'];
        $load = array_keys($load_data[$id]['files']);
        //xml, mini
        $diff = array_diff($load, $mini_files);
        if (!empty($diff)) {
          foreach ($diff as $file) {
            //jsou navic na databazi => vymazani z databaze
            $load_data[$id]['files'][$file] = NULL;
          }

          if (XmlStorage::setData($xml_path, $load_data)) {
            $result[] = sprintf(_('Data mini synchronized: %s'), implode(', ', $diff));
            Core::setRefresh(Config::TIME_EDIT, Core::getAbsoluteUrl($backarray, $backarray_set));
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
            $result[] = sprintf(_('Data full synchronized: %s'), implode(', ', $diff));
            Core::setRefresh(Config::TIME_EDIT, Core::getAbsoluteUrl($backarray, $backarray_set));
          }
        }

        //filesystem, mini
        $diff = array_diff($mini_files, $load); //tady je opacna strategie diffu
        if (!empty($diff)) {
          foreach ($diff as $file) {
            //jsou navic ve filesystemu => vymazani z filesystemu
//FIXME osetreni stavu kdyz by to neslo smazat!
            if (unlink(sprintf('%s/%s', $mini_path, $file))) {
              $result[] = sprintf(_('File mini synchronized: %s'), $file);
              Core::setRefresh(Config::TIME_EDIT, Core::getAbsoluteUrl($backarray, $backarray_set));
            }
          }
        }
      }
      return $result;
    }
//FIXME mit moznost i vracet title!!!?!
    //uprava komentaru a mazani obrazku
    public static function getAdminContent($co) {
      $result = NULL;
      $source_path = self::$source_path;
      //Config::SOURCE;

      $absoluteurl = Core::getAbsoluteUrl(NULL, array('path' => Administration::ADMIN_URL));
      $get_adress = Administration::getGetAdress();

      $xml_path = ModuleDirs::getXmlPath();

      switch ($co) {
        default:  //vypis
          $dirs = ModuleDirs::getActiveDirs();

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
            if (isset($conf['files'])) {
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
                              ->setText(_('Generate thumbnails'));
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

        case 'dir': //vyber galerie
          $hashid = Core::isFill($_GET, 'id');
          $id = base64_decode($hashid);

          $row = array();
          $load_data = XmlStorage::getData($xml_path);
          if (!empty($load_data[$id]['files'])) {
            $imgurl = Core::getAbsoluteUrl();
            foreach ($load_data[$id]['files'] as $file => $comment) {
              $idfile = base64_encode($file);

              $mini_path = sprintf('%s/%s/%s/%s', $source_path, $id, Config::THUMB, $file);
              $full_path = sprintf('%s/%s/%s', $source_path, $id, $file);

              $stav = NULL;
              if (!file_exists($mini_path)) {
                //chyby mini -> oprava
                $state = _('Not exists miniature! You can fix it!');
              }

              if (!file_exists($full_path)) {
                //chyby full -> neopravitelne
                $state = _('Not exists original! Incorrigible!');
              }

              if (file_exists($mini_path) &&
                  file_exists($full_path)) {
                //vse redy
                $state = _('Photos complet.');
              }

              $img = Html::elem('img')
                          ->src(sprintf('%s%s/%s/%s/%s', $imgurl, self::$source_path, $id, Config::THUMB, $file))
                          ;

              $links = array();
              $links[] = Html::elem('a')
                              ->href(sprintf('%s%s/%s/%s', $imgurl, self::$source_path, $id, $file))
                              ->setDepth(2)
                              ->insert($img)
                              ->appendAfter(Html::elem('br'))
                              ;

              $links[] = Html::elem('a')
                              ->href($absoluteurl, array($get_adress[0] => self::URL, $get_adress[1] => 'edit', 'iddir' => $hashid, 'id' => $idfile))
                              ->setText(_('Edit comment photo'))
                              ;

              $links[] = Html::elem('a')
                              ->href($absoluteurl, array($get_adress[0] => self::URL, $get_adress[1] => 'del', 'iddir' => $hashid, 'id' => $idfile))
                              ->setText(_('Delete photo'))
                              ->onClick(sprintf(_('return confirm(\'Really delete: &quot;%s&quot; ?\');'), $file))
                              ;

              $html_com = Html::elem('span')
                              ->setText($comment)
                              ->setText(Html::elem('br'))
                              ->class('komentar obrazku')
                              ;

              $html_check = Html::elem('input')
                                ->type('checkbox')
                                //->name('selectpic[]')
                                ->class('cldelsel')
                                ->value($idfile)
                                ;

              $row[] = Html::elem('div')
                            ->setDepth(1)
                            ->insert($html_com)
                            ->insert($html_check)
                            ->insert($links)
                            ->insert(Html::elem('span')->setText($state))
                            ->class('obal jednoho obrazku')
                            ->id(sprintf('arrays_%s', urlencode($idfile)))
                            ;
            }
          } else {
            $row = Html::elem('span')->setText(_('No photos'));
          }

          $status_drag = Html::elem('div')->id('status_drag');
          $uploadlink = Html::elem('a')->href($absoluteurl, array($get_adress[0] => self::URL, $get_adress[1] => 'upload', 'id' => $hashid))->setText(_('upload new picture'));
          $backlink = Html::elem('a')->href($absoluteurl, array($get_adress[0] => self::URL))->setText(_('Back'));
          $selectdel = Html::elem('input')->type('button')->value(_('Delete selected photo(s)'))->onClick('delsel();');

          $url = array ('menu' => __CLASS__,
                        'co' => 'sortdirs',
                        'iddir' => $hashid
                        );
//TODO dodelat predavani tady tech hodnot pro smazani do php aby se to mohlo provest!
          $javascript = Html::elem('script')
                            ->type('text/javascript')
                            ->setText(sprintf('
  function delsel() {
    var row = new Array();
    $(".cldelsel").each(function(key, elem) {
      if (elem.checked) {
        row.push(elem.value);
      }
    });
    alert(row); //TODO poslat ajaxem? na smanazni!
  }

  $(document).ready(function(){
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

  function ZpracujHlasku(ret) {
    $(ret).fadeIn(\'slow\').delay(2000).fadeOut(\'slow\');
  }', http_build_query($url), self::$web_path))
                            ->appendAfter(array($status_drag, $backlink, $uploadlink, $selectdel));

          $result = Html::elem('div')
                          ->appendBefore(array($javascript))
                          ->insert($row)
                          ->setText(self::synchronizeXml($id))
                          ->class('obal_razeni')
                          ;
        break;

        case 'upload':  //upload obrazku
          $hashid = Core::isFill($_GET, 'id');
          $id = base64_decode($hashid);

          $backarray = array($get_adress[0] => self::URL, $get_adress[1] => 'dir', 'id' => $hashid);

          $form = new Form(array('enctype' => Form::MIME_MULTIPART));
          $form->addBackLink(_('Back'), $absoluteurl, $backarray)
                ->addFile('pictures', array('label' => _('Select picture(s)'),'multiple' => true))
                ->addSubmit(__CLASS__.'_submit', array('value' => _('Upload')))
          ;

          $result = $form;

          if ($form->isSubmitted()) {
            $pictures = $form->getValue('pictures');

            $tmp_name = $pictures['tmp_name'];
            $name = $pictures['name'];
            $error = $pictures['error'];

            $state = true;
            foreach ($tmp_name as $index => $tmp) {
              if ($error[$index] == UPLOAD_ERR_OK) {
                $path = sprintf('%s/%s/%s', $source_path, $id, $name[$index]);
                if (!move_uploaded_file($tmp, $path)) {
                  $state = false;
                }
              }
            }

            if ($state) {
              $result = _('Photos successfully uploaded!');
              Core::setRefresh(Config::TIME_EDIT, Core::getAbsoluteUrl(array($get_adress[0] => self::URL, $get_adress[1] => 'gen', 'id' => $hashid), array('path' => Administration::ADMIN_URL)));
            }
          }
        break;

        case 'gen':  //generovani miniatur
          try {

            $id = base64_decode(Core::isFill($_GET, 'id'));
            $originalid = Core::isFill($_GET, 'id');

            $pathdir = sprintf('%s/%s/%s', Core::getWebPath(), $source_path, $id);
            $mini_path = sprintf('%s/%s', $pathdir, Config::THUMB);

            if (is_writable($pathdir)) {
              if (!file_exists($mini_path)) {
                if (!@mkdir($mini_path)) {
                  throw new ExceptionModulePictures(_('nelze vytvorit slozku pro miniatury'));
                }
              }
            } else {
              throw new ExceptionModulePictures(sprintf(_('nelze zapisovat do slozky %s!'), $pathdir));
            }

            $files = Core::getListFile(array('path' => $pathdir, 'full' => true));
            $count_file = count($files);
            if ($count_file <= 0) {
              throw new ExceptionModulePictures(_('nelze vytvaret miniatury ve slozce ve ktere neni zadny obrazek!'));
            }

            $pictures = array();
            foreach ($files as $full) {
              $name = basename($full);
              $mini = sprintf('%s/%s/%s', $pathdir, Config::THUMB, $name);
              $pictures[] = array('name'=> $name,
                                  'mini' => $mini,
                                  'full' => $full,
                                  );
            }

            $data_settings = ModuleSettings::getXmlData();

            $data = array('files' => $pictures,
                          'dir' => $id,
                          'mini_path' => $mini_path,
                          'minsizew' => $data_settings['minsizew'],
                          'minsizeh' => $data_settings['minsizeh'],
                          'maxsizew' => $data_settings['maxsizew'],
                          'maxsizeh' => $data_settings['maxsizeh'],
                          );

            $url = array ('menu' => __CLASS__,
                          'co' => 'gen',
                          'data' => Core::encodeData(json_encode($data))
                          );

            $status_drag = Html::elem('div')->id('status_drag');

            $javascript = Html::elem('script')
                            ->type('text/javascript')
                            ->setText(sprintf('
            function generovani() {
                $(document).ready(function() {
                  $.post("%sajax.php", "%s", function(data) {
                    $(\'#status_drag\').html(data);
                  });
                });
              }
              generovani();', self::$web_path, http_build_query($url)))
                ->appendAfter(array($status_drag));

            $result = Html::elem('div')
                          ->appendBefore(array($javascript))
                          ->class('obal_razeni?')
                          ;

/*
            $result = '
            <script type="text/javascript">
              function generovani() {
                $(document).ready(function() {
                  $.post("ajax.php", "'.http_build_query($url).'", function(data) {
                    $(\'#status_drag\').html(data);
                  });
                });
              }
              generovani();
            </script>
            <div id="status_drag"></div>
            ';
*/

          } catch (ExceptionModulePictures $e) {
            echo $e;
          }
        break;

        case 'reg':

          $id = base64_decode(Core::isFill($_GET, 'id'));

          $pathdir = sprintf('%s/%s', $source_path, $id);

          $load_data = XmlStorage::getData($xml_path);

          $files = Core::getListFile(array('path' => $pathdir));
          if (!empty($files)) {
            foreach ($files as $file) {
              $load_data[$id]['files'][$file] = $file;  //zakladni komentar
            }
          } else {
            $load_data[$id]['files'] = '';
          }

          if (XmlStorage::setData($xml_path, $load_data)) {
            $result = _('Photos successfully registred!');
            Core::setRefresh(Config::TIME_EDIT, Core::getAbsoluteUrl(array($get_adress[0] => self::URL), array('path' => Administration::ADMIN_URL)));
          }
        break;

        case 'edit': //uprava komentaru
          $hashiddir = Core::isFill($_GET, 'iddir');
          $iddir = base64_decode($hashiddir);
          $id = base64_decode(Core::isFill($_GET, 'id'));

          $load_data = XmlStorage::getData($xml_path);

          $backarray = array($get_adress[0] => self::URL, $get_adress[1] => 'dir', 'id' => $hashiddir);

          $form = new Form;
          $form->addBackLink(_('Back'), $absoluteurl, $backarray)
                ->addTextArea('comment', array('label' => _('Comment:'), 'value' => $load_data[$iddir]['files'][$id]))
                ->addSubmit(__CLASS__.'_submit', array('value' => _('Edit comment')));

          $result = $form;

          if ($form->isSubmitted()) {

            $values = $form->getValues();
            $load_data[$iddir]['files'][$id] = $form->getValue('comment');

            if (XmlStorage::setData($xml_path, $load_data)) {
              $result = _('Comment saved!');
              Core::setRefresh(Config::TIME_EDIT, Core::getAbsoluteUrl($backarray, array('path' => Administration::ADMIN_URL)));
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
              throw new ExceptionModulePictures(sprintf(_('nepodarilo se smazat miniaturu: %s !'), $mini_path));
            }

            if (!@unlink($full_path)) {
              throw new ExceptionModulePictures(sprintf(_('nepodarilo se smazat full: %s !'), $full_path));
            }

            $load_data = XmlStorage::getData($xml_path);

            $load_data[$iddir]['files'][$id] = NULL;

            if (XmlStorage::setData($xml_path, $load_data)) {
              $result = _('Deleted');
              Core::setRefresh(Config::TIME_EDIT, Core::getAbsoluteUrl(array($get_adress[0] => self::URL, $get_adress[1] => 'dir', 'id' => $hashiddir), array('path' => Administration::ADMIN_URL)));
            }

          } catch (ExceptionModulePictures $e) {
            echo $e;
          }
        break;
      }

      return $result;
    }

    public static function getAjax() {
      $result = NULL;

      $get_adress = Administration::getGetAdress();

      $co = Core::isFill($_POST, 'co');
      switch ($co) {
        case 'gen':
          $data = json_decode(Core::decodeData($_POST['data']));

          if (!empty($data->files)) {

            $count = count($data->files);
            $count_file = Core::getCountListFile(array('path' => $data->mini_path));

            $name = '';
            foreach ($data->files as $file) {
              if (!file_exists($file->mini)) {

                $name = $file->name;
                //overeni jestli se jedna o obrazek
                if (Imagic::isPicture($file->full)) {
                  //vytvoreni mini
                  $image = new Imagic($file->full);
                  $image->thumbnailImage($data->minsizew, $data->minsizeh, true);
                  $image->writeImage($file->mini);

                  //uprava full
                  $image = new Imagic($file->full);
                  $image->thumbnailImage($data->maxsizew, $data->maxsizeh, true);
                  $image->writeImage();
                  break;
                }
              }
            }

            $res = array ('name' => $name,
                          'count' => $count,
                          'value' => $count_file,
                          'proc' => round((100 / $count) * $count_file),
                          'date' => date(_('Y-m-d')),
                          'time' => date(_('H:i:s')),
                          'url' => Core::getAbsoluteUrl(array($get_adress[0] => self::URL, $get_adress[1] => 'reg', 'id' => Core::encodeData($data->dir)), array('amp' => '&', 'path' => 'admin/'.Administration::ADMIN_URL)), //FIXME takhle by to neslo!
                          );

            $json = json_encode($res);

            $result = '
            <script type="text/javascript">
              var data = '.$json.';

              '.($count == $count_file ? 'location.href=data.url;' : 'setTimeout("generovani()", 500); $("#info").html(data.name+", "+data.proc+"%, "+data.value+" z "+data.count+", "+data.date+", "+data.time);').'

            </script>
            <meter value="'.$res['value'].'" min="0" max="'.$res['count'].'" title="postup... '.$res['value'].' z '.$res['count'].'" />
            <div id="info"></div>
            ';
          }
        break;

        case 'sortdirs':
          $arrays = Core::isFill($_POST, 'arrays');

          $iddir = base64_decode(Core::isFill($_POST, 'iddir'));

          $xml_path = ModuleDirs::getXmlPath();

          $data = XmlStorage::getData($xml_path);

          $decode_array = array_map('base64_decode', $arrays);

          $new_data = array();
          foreach ($decode_array as $file) {
            $new_data[$file] = $data[$iddir]['files'][$file];  //preskladani pole
          }

          $data[$iddir]['files'] = $new_data;

          if (XmlStorage::setData($xml_path, $data)) {
            $result = _('Sucessfull saved');
          }
        break;
      }

      return $result;
    }
  }

  class ExceptionModulePictures extends Exception {}

?>
