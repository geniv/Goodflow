<?php
/*
 *      globaltext.php
 *
 *      Copyright 2011 server <geniv.radek@gmail.com>
 *
 */

  namespace classes;

  use Exception;

  class GlobalText {
    const VERSION = 1.05;
    //TODO tady bude obsluha konstantnich textu na prelozeni, pole textu s preklady
//TODO dopsat u picture a settings!
    private static function getText() {
      $result = array('modules\ModuleDirs::getState' => _('Could not create galleries!'),
                      'modules\ModuleDirs::getPageTitle' => _('Web adress does not exist!'),
                      'modules\ModuleDirs::getAdminContent' => array('nocreate' => _('Cannot create directory "%s"!'),
                                                                    'alreadyexists' => _('Name "%s" already exists!'),
                                                                    'badpermit' => _('failed to rename folder to rename! bad permissions!'),
                                                                    'badindex' => _('required database index not exists!'),
                                                                    'nounlink' => _('File "%s" does not delete!'),
                                                                    'nowrite' => _('File "%s" does not write!'),
                                                                    ),
                      'modules\ModuleDirs::deleteSelectDir' => array('noexist' => _('directory: "%s" does not exist !'),
                                                                    'nounlink' => _('failed to delete the file: "%s" !'),
                                                                    'normdir' => _('failed to delete the directory: "%s" !'),
                                                                    'badpermit' => _('can not write to picture: "%s"<br />change permission to 0777 please!'),
                                                                    ),
                      'modules\ModuleDirs::activateSelectDir' => _('failed to rename folder to activate! bad permissions!'),
                      'modules\ModulePictures::getState' => _('Class "Imagic" does not exist!'),
                      'modules\ModulePictures::synchronizeXml' => array('norename' => _('Does not rename to "%s"!'),
                                                                        'badpermit' => _('Does not for write "%s"<br />change permission to 0777 please!'),
                                                                        ),
                      'modules\ModulePictures::getAdminContent' => array('badlimit' => _('Exceeding limit upload! [%s of %s]'),
                                                                        'nomkdir' => _('can not create a folder for thumbnails'),
                                                                        'badpermit' => _('can not write to folder: "%s"%schange permission to 0777 recursive please!'),
                                                                        'noread' => _('can not read to picture: "%s"<br />change permission to 0777 please!'),
                                                                        'nowrite' => _('can not write to picture: "%s"<br />change permission to 0777 please!'),
                                                                        'nodelthumb' => _('Failed to delete thumbnail: %s !'),
                                                                        'nodelfull' => _('Failed to delete full: %s !'),
                                                                        'nodelonethumb' => _('failed to delete a single thumbnail: %s !'),
                                                                        'nodelonefull' => _('failed to delete one full: %s !'),
                                                                        ),
                      '',
                      );
      return $result;
    }

    public static function s($method, $dodatek = NULL) {
      try {

        $result = NULL;
        $texts = self::getText();
        if (array_key_exists($method, $texts)) {
          if (!empty($dodatek)) {
            if (array_key_exists($dodatek, $texts[$method])) {
              $result = $texts[$method][$dodatek];
            } else {
              throw new ExceptionGlobalText(sprintf('Index textu: "%s" a s dodatkem: "%s" neexistuje!', $method, $dodatek));
            }
          } else {
            $result = $texts[$method];
          }
        } else {
          throw new ExceptionGlobalText(sprintf('Index textu: "%s" neexistuje!', $method));
        }

      } catch (ExceptionGlobalText $e) {
        echo $e;
      }
      return $result;
    }
  }

  class ExceptionGlobalText extends Exception {}

?>
