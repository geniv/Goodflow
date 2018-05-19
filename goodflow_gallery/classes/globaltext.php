<?php
/*
 *      globaltext.php
 *
 *      Copyright 2011 server <geniv.radek@gmail.com>
 *
 */

  namespace classes;

  use classes\Configurator,
      Exception;

  class GlobalText extends Configurator {
    const VERSION = 1.09;

    protected static function getText() { //metoda sdruzujici pole prekladu
      $result = array('modules\ModuleDirs::getState' => _('Could not create galleries!'),
                      'modules\ModuleDirs::getPageTitle' => _('Web adress does not exist!'),
                      'modules\ModuleDirs::getAdminContent' => array('nocreate' => _('Cannot create directory "%s"!'),
                                                                    'alreadyexists' => _('Name "%s" already exists!'),
                                                                    'badpermit' => _('failed to rename folder to rename! bad permissions!'),
                                                                    //'badindex' => _('required database index not exists!'),
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
  }

?>
