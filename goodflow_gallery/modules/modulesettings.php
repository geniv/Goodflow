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
      classes\Notification,
      classes\SelectionTheme,
      \Config;

  final class ModuleSettings implements Module {
    const URL = 'set';
    const VERSION = 1.66;

    public static function getName() {
      return _('Settings');
    }

    public static function getSection() {
      return array ('' => _('Signpost'),
                    'gallery' => _('Gallery settings'),
                    'login' => _('Login settings'),
                    );
    }

    public static function getLoadModules() {
      return array();
    }

    public static function getState() {
      return true;
    }

    public static function getXmlPath() {
      $class = substr(__CLASS__, strlen(__NAMESPACE__) + 1);
      return XmlStorage::getAutoPath(__DIR__, $class);
    }

    public static function getXmlData() {
      $result = XmlStorage::getData(self::getXmlPath());
      return $result;
    }

//FIXME rozsirit a udelat malinko jinak!!!!
    public static function getLoginQuery() {
      $get_adress = Administration::getGetAdress();
      return array($get_adress[0] => self::URL, $get_adress[1] => 'login');
    }

    public static function getAdminContent($co) {
      $result = NULL;
      $get_adress = Administration::getGetAdress();
      $adminurl = Administration::getAdminUrl();
      $backarray = array($get_adress[0] => self::URL);
      $refreshurl = Core::makeUrl($adminurl, array('query' => $backarray));
      $xml_path = self::getXmlPath();

      switch ($co) {
        default:
          $link = array();
          $link[] = Html::elem('a')->href($adminurl, array($get_adress[0] => self::URL, $get_adress[1] => 'gallery'))->setText(_('Gallery settings'));
          $link[] = Html::elem('a')->href($adminurl, array($get_adress[0] => self::URL, $get_adress[1] => 'login'))->id('settings_login')->setText(_('Login settings'));

          $result = Html::elem('div')->id('signpost')
                        ->insert($link);
        break;

        case 'gallery':
          $data = XmlStorage::getData($xml_path);

          $selectionpanel = SelectionTheme::getInstance()->internalControlPanel();

          $form = new Form;
          $form->addBackLink(_('Back'), $adminurl, $backarray, array('id' => 'back_link_central'))
                ->addText('minsizew', array('label' => _('Mini size width [px]'), 'label_class' => 'small_width', 'value' => Core::isNull($data, 'minsizew', Config::MINSIZEW)))
                  ->addRule(Form::RULE_NUMERIC, _('Value mini size width must be numeric!'))
                  ->setTypeVariable(Form::TYPE_INTEGER)
                ->addText('minsizeh', array('label' => _('Mini size height [px]'), 'label_class' => 'small_width', 'value' => Core::isNull($data, 'minsizeh', Config::MINSIZEH)))
                  ->addRule(Form::RULE_NUMERIC, _('Value mini size height must be numeric!'))
                  ->setTypeVariable(Form::TYPE_INTEGER)
                ->addText('maxsizew', array('label' => _('Maxi size width [px]'), 'label_class' => 'small_width', 'value' => Core::isNull($data, 'maxsizew', Config::MAXSIZEW)))
                  ->addRule(Form::RULE_NUMERIC, _('Value maxi size width must be numeric!'))
                  ->setTypeVariable(Form::TYPE_INTEGER)
                ->addText('maxsizeh', array('label' => _('Maxi size height [px]'), 'label_class' => 'small_width', 'value' => Core::isNull($data, 'maxsizeh', Config::MAXSIZEH)))
                  ->addRule(Form::RULE_NUMERIC, _('Value maxi size height must be numeric!'))
                  ->setTypeVariable(Form::TYPE_INTEGER)
                ->addText('title', array('label' => _('Title'), 'value' => Core::isFill($data, 'title'), 'placeholder' => _('Type here title webpage')))
                ->addTextArea('description', array('label' => _('Description'), 'value' => Core::isFill($data, 'description'), 'placeholder' => _('Type here description webpage')))
                ->addCheckbox('robots', array('label' => _('Enable indexing robots'), 'label_class' => 'checkbox', 'checked' => Core::isFill($data, 'robots', false)))
                  ->setTypeVariable(Form::TYPE_BOOL)
                ->addSelect('theme', array('label' => _('Available themes:'), 'value' => $selectionpanel, 'selected' => Core::isFill($data, 'theme')))
                ->addSubmit('_submit', array('value' => _('Save')));

          $result = $form;

          if ($form->isSubmitted()) {
            if (XmlStorage::setData($xml_path, $form->getValues())) {
              SelectionTheme::getInstance()->internalSetCookie($form->theme); //nastaveni cookie
              $result = Notification::successful(_('Settings successfully saved'))->wait(Notification::NORMAL);
              Core::setRefresh(Config::TIME_EDIT, $refreshurl);
            }
          }

          if ($form->isErrors()) {
            $result .= Notification::warning(_('Wrong: %s'))->arg($form->getErrors());
          }
        break;

        case 'login':
          $auth = Administration::getCryptData();

          $form = new Form;
          $form->addBackLink(_('Back'), $adminurl, $backarray, array('id' => 'back_link_central'))
                ->addText('log', array('label' => _('New login'), 'value' => $auth[0], 'autocomplete' => 'off'))
                ->addPassword('pas1', array('label' => _('New password'), 'autocomplete' => 'off'))
                  ->addRule(Form::RULE_FILLED, _('Must be filled password 1!'))
                ->addPassword('pas2', array('label' => _('New password retype'), 'autocomplete' => 'off'))
                  ->addRule(Form::RULE_FILLED, _('Must be filled password 2!'))
                  ->addRule(Form::RULE_EQUAL, _('Must be equal with password 1'), $form->pas1)
                ->addPassword('oldpas', array('label' => _('Enter the old password for verification'), 'autocomplete' => 'off'))
                  ->addRule(Form::RULE_FILLED, _('Must be filled verification password!'))
                ->addSubmit('_submit_login', array('value' => _('Change login')));

          $result = $form;

          if ($form->isSubmitted()) {
            $logdata = $form->getValues();
            if (Administration::setCryptData($logdata['log'], $logdata['pas1'], $logdata['oldpas'])) {
              $result = Notification::successful(_('Login successfully changed'))->wait(Notification::NORMAL);
            } else {
              $result = Notification::warning(_('Changing the login was not successful'))->wait(Notification::NORMAL);
            }
            Core::setRefresh(Config::TIME_LOGIN, $refreshurl);
          }

          if ($form->isErrors()) {
            $result .= Notification::warning(_('Wrong: %s'))->arg($form->getErrors());
          }
        break;
      }

      return $result;
    }
  }

  //class ExceptionModuleSettings extends Exception {}

?>
