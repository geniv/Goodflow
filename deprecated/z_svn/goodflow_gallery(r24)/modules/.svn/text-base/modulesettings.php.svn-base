<?php
/*
 *      modulesettings.php
 *
 *      Copyright 2011 geniv <geniv.radek@gmail.com>
 *
 */

  namespace modules;

  use classes\Core,
      classes\Html,
      classes\Form,
      classes\Administration,
      classes\Filesystem,
      classes\XmlStorage,
      configs\Config;

  final class ModuleSettings implements Module {
    const URL = 'set';
    const VERSION = '1.5';

    public static function getName() {
      return _('Settings');
    }

    public static function getState() {
      $result = true;
      //kontrola zavislosti
      //var_dump(class_exists('XmlStorage'), class_exists('Core'), class_exists('Administration'));
      //XmlStorage, Core, Administration, Form, Html
      return $result;
    }

    public static function getXmlPath() {
      $class = substr(__CLASS__, strlen(__NAMESPACE__) + 1);
      return XmlStorage::getAutoPath(__DIR__, $class);
    }

    public static function getXmlData() {
      $result = XmlStorage::getData(self::getXmlPath());
      return $result;
    }

    public static function getAdminContent($co) {
      $result = NULL;

      $get_adress = Administration::getGetAdress();
      $absoluteurl = Core::getAbsoluteUrl(NULL, array('path' => Administration::ADMIN_URL));
      $backarray = array($get_adress[0] => self::URL);
      $absoluteurl_refresh = Core::getAbsoluteUrl($backarray, array('path' => Administration::ADMIN_URL));

      $xml_path = self::getXmlPath();

      switch ($co) {
        default:
          $link = array();
          $link[] = Html::elem('a')->href($absoluteurl, array($get_adress[0] => self::URL, $get_adress[1] => 'gallery'))->setText(_('Gallery settings'));
          $link[] = Html::elem('a')->href($absoluteurl, array($get_adress[0] => self::URL, $get_adress[1] => 'login'))->setText(_('Login settings'));

          $result = Html::elem('div')
                        ->insert($link);
        break;

        case 'gallery':
          $data = XmlStorage::getData($xml_path);

          $form = new Form;
          $form->addBackLink(_('Back to navigation'), $absoluteurl, $backarray)
                ->addText('minsizew', array('label' => _('Mini size width'), 'value' => Core::isNull($data, 'minsizew', Config::MINSIZEW)))
                  ->addRule(Form::RULE_NUMERIC, _('Value mini size width must be numeric!'))
                  ->setTypeVariable(Form::TYPE_INTEGER)
                ->addText('minsizeh', array('label' => _('Mini size height'), 'value' => Core::isNull($data, 'minsizeh', Config::MINSIZEH)))
                  ->addRule(Form::RULE_NUMERIC, _('Value mini size height must be numeric!'))
                  ->setTypeVariable(Form::TYPE_INTEGER)
                ->addText('maxsizew', array('label' => _('Maxi size width'), 'value' => Core::isFill($data, 'maxsizew', Config::MAXSIZEW)))
                  ->addRule(Form::RULE_NUMERIC, _('Value maxi size width must be numeric!'))
                  ->setTypeVariable(Form::TYPE_INTEGER)
                ->addText('maxsizeh', array('label' => _('Maxi size height'), 'value' => Core::isFill($data, 'maxsizeh', Config::MAXSIZEH)))
                  ->addRule(Form::RULE_NUMERIC, _('Value maxi size height must be numeric!'))
                  ->setTypeVariable(Form::TYPE_INTEGER)
                ->addText('title', array('label' => _('Title'), 'value' => Core::isFill($data, 'title'), 'placeholder' => _('Type here title webpage')))
                ->addTextArea('description', array('label' => _('Description'), 'value' => Core::isFill($data, 'description'), 'placeholder' => _('Type here description webpage')))
                ->addCheckbox('robots', array('label' => _('Enable indexing robots'), 'checked' => Core::isFill($data, 'robots', false)))
                  ->setTypeVariable(Form::TYPE_BOOL)
                ->addText('prompt', array('label' => _('Authorized prompt text'), 'value' => Core::isFill($data, 'prompt')))
                ->addSubmit(__CLASS__.'_submit', array('value' => _('Save')));

          $result = $form;

          if ($form->isSubmitted()) {
            if (XmlStorage::setData($xml_path, $form->getValues())) {

              Administration::setHtaccess(array('AuthName' => $form->prompt));

              $sablona = sprintf('#zobrazovani souboru
Options -Indexes

AuthUserFile %s/.htpasswd
AuthGroupFile /dev/null
AuthName "%s"
AuthType Basic
Require valid-user', dirname(Core::getWebPath()), $form->prompt);  //FIXME docasne reseni s posunem o jednu urovne vys!!!!

              $file = new Filesystem('../admin/.htaccess', Filesystem::MODE_WRITE); //FIXME taky docasne reseni umisteni!!!!
              $file->write($sablona);
//FIXME automaticke generovani a
//upravu htaccess-u bude mit na starosti trida Administration, tady to bude zase jen volane!!!!!
              $result = _('Settings successfully saved');
              Core::setRefresh(Config::TIME_EDIT, $absoluteurl_refresh);
            }
          }

          if ($form->isErrors()) {
            $result .= $form->getErrors();
          }
        break;

        case 'login':
          $auth = Administration::getCryptData();

          $form = new Form;
          $form->addBackLink(_('Back to navigation'), $absoluteurl, $backarray)
                ->addText('log', array('label' => _('New login'), 'value' => $auth[0], 'autocomplete' => 'off'))
                ->addPassword('pas1', array('label' => _('New password'), 'autocomplete' => 'off'))
                  ->addRule(Form::RULE_FILLED, _('Must be filled password 1'))
                ->addPassword('pas2', array('label' => _('New password retype'), 'autocomplete' => 'off'))
                  ->addRule(Form::RULE_FILLED, _('Must be filled password 2'))
                  ->addRule(Form::RULE_EQUAL, _('Must be equal with password 1'), $form->pas1)
                ->addSubmit(__CLASS__.'_submit_login', array('value' => _('Change login')));

          $result = $form;

          if ($form->isSubmitted()) {
            $logdata = $form->getValues();
            Administration::setCryptData($logdata['log'], $logdata['pas1']);
            $result = _('Login successfully changed');
            Core::setRefresh(Config::TIME_LOGIN, $absoluteurl_refresh);
          }

          if ($form->isErrors()) {
            $result .= $form->getErrors();
          }
        break;
      }

      return $result;
    }
  }

  //class ExceptionModuleSettings extends Exception {}

?>
