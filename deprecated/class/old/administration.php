<?php
/*
 *      administration.php
 *
 *      Copyright 2011 geniv <geniv.radek@gmail.com>
 *
 */

  namespace classes;

  use classes\Core,
      classes\Notification,
      classes\Html,
      classes\Filesystem,
      \Config,
      Exception;
//FIXME tento medul je slpatanina nekolika modulu! bud rozkouskovat a nebo se pouze jim inspirovat!
  final class Administration {
    const VERSION = 2.02;
    const ADMIN_URL = 'index.php';  //index pro admin
    const DEFSET = 'admin'; //defaultni nastaveni uzivatele

    const CRYPT_FILE = '.htpasswd';
    private static $crypt_path = NULL;

    private static $get_adress = array('action', 'co');
    private static $main_adress = array('login', 'logout');
    private static $session_index = NULL;
    private static $errors = array();

    private static $list_modules = NULL;  //staticka trida seznamu modulu
    private static $defpage = ''; //defaultne prazdny index

    private static $path = NULL;
    private static $weburl = NULL;
    private static $adminurl = NULL;

//nastavovani pathu pro modul
    public static function setPath($path = NULL, $adminurl = NULL, $weburl = NULL) {
      self::$path = $path;
      self::$adminurl = $adminurl;  //url adminu
      self::$weburl = $weburl;  //url webu
      self::$crypt_path = sprintf('%s%s', self::$path, self::CRYPT_FILE);
    }

    //vraci path filesystemu
    public static function getPath() {
      return self::$path;
    }

    //vraci admin url, vraceni s indexem je mozno zakazat
    public static function getAdminUrl($with_index = true) {
      return self::$adminurl.($with_index ? self::ADMIN_URL : '');
    }

    //vraci web url
    public static function getWebUrl() {
      return self::$weburl;
    }

//vraci pole dostupnych adres pro obsluhu
    public static function getGetAdress() {
      return self::$get_adress;
    }

//nacitani pole dostupnych modulu
    private static function getModules() {
      if (empty(self::$list_modules)) {
        $menu = Config::getLoadModules(); //nacitani moduu adminu
        $result = array();
        $res = array();
        foreach ($menu as $polozka) {
          $state = $polozka::getState();
          if ($state) {
            $result[$polozka::URL] = $polozka;
          } else {
            echo sprintf(_('Module "%s" does not redy'), $polozka);
          }
        }
        self::$list_modules = $result;
      }
      return self::$list_modules;
    }

//nastavovani jine defaultni stranky/modulu
    public static function setDefaultPage($url) {
      self::$defpage = $url;
    }

    //aktualni get adresa
    public static function getCurrentAdress($uroven = 0) {
      return Core::isFill($_GET, self::$get_adress[$uroven]);
    }

//nasitani aktualniho/defaultniho modulu
    public static function getCurrentModule() {
      $modules = self::getModules();
      $current = self::getCurrentAdress();
      return Core::isFill($modules, $current, $modules[self::$defpage]);
    }

    //title adminu
    public static function getAdminTitle() {
      $class = self::getCurrentModule();
      return $class::getName();
    }

//moznost plnit i polem
    public static function getAdminSection($args = NULL) {
      $result = NULL;
      $current = self::getCurrentAdress(1);

      $class = self::getCurrentModule();
      $section = $class::getSection();

      $item = Core::isFill($section, $current);
      if (!empty($item)) {
        $result = vsprintf($item, (!empty($args) ? $args : ''));
      }
      return $result;
    }

//nacitani modulu pro dany modul
    public static function getLoadModules() {
      $result = NULL;

      $class = self::getCurrentModule();
      $modules = $class::getLoadModules();
      if (!empty($modules)) {
        $current1 = self::getCurrentAdress(1);
        $result = Core::isFill($modules, $current1, array());
        $all = Core::isFill($modules, '*'); //pokud je v modulech index '*' - ve vsech podmenu
        if (!empty($all)) {
          $result = array_merge_recursive($result, $all);
        }
      }
      return $result;
    }

    //menu adminu
    public static function getAdminMenu() {
      $item = array();
      $adminurl = self::$adminurl.self::ADMIN_URL;
      $current = self::getCurrentAdress();

      $modules = self::getModules();
      foreach ($modules as $url => $class) {
        $name = $class::getName();
        $adress = (!empty($url) ? array(self::$get_adress[0] => $url) : NULL);
        $item[] = Html::elem('a')
                      ->href($adminurl, $adress)
                      ->setText($name)
                      ->class($current == $url ? 'active' : NULL)
                      ->title($name)
                      ->clearBreak();
      }
      return implode(Html::elem('span')->setText('/')->clearBreak(), $item);
    }

    //obsah adminu
    public static function getAdminContent() {
      $current1 = self::getCurrentAdress(1);
      $class = self::getCurrentModule();
      return $class::getAdminContent($current1);
    }


////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////

    const STATE_LOGIN = 'login';
    const STATE_LOGOUT = 'logout';
    const STATE_ACCESS = 'access';
    const STATE_DENIED = 'denied';

//nastaveni indexu pro session
    public static function setSessionIndex($name) {
      self::$session_index = $name;
    }

    public static function getErrors() {
      //TODO skusit udelat tak aby z modulu chodily errory pres tento modul ven!!!
      return self::$errors;
    }

    //zasilani zprav z modulu
    public static function setErrors($error) {
      $result = Notification::error($error);
      self::$errors[] = $result;
      return $result; //vrati instanci z Notification
    }

    public static function getStateAdmin() {
      $current = self::getCurrentAdress();
      $result = NULL;
      switch ($current) {
        default:
          $result = (self::isLogin() ? self::STATE_ACCESS : self::STATE_DENIED);
//TODO mozna do budoucna udelat trochu flexibilnejsi, je to tozit dost natvrdo

//FIXME toto overeni prervat pres parametr a to ze Setiings
          if (self::isOriginalAuth()) {
            self::$errors[] = Notification::warning(_('Login and password it default. Change it hurry, please.'));

            $current1 = self::getCurrentAdress(1);
            if ($current != 'set' && $current1 != 'login') {
              //$menu = self::getMenuTemplate();  //FIXME vyhodit a toto dost brutalne predelat!!!!
              //$class = $menu['set']['class'];
              $class = self::getCurrentModule();
              //var_dump($class);
              //Core::setRefresh(0, Core::getUrl(array('path' => self::ADMIN_URL, 'query' => $class::getLoginQuery())));  //FIXME tu vyhodit URL
            }
          }
        break;

        case self::$main_adress[0]: //login page
          $result = self::STATE_LOGIN;
        break;

        case self::$main_adress[1]: //logout page
          $result = self::STATE_LOGOUT;
        break;
      }

      return $result;
    }

    public static function getLoginLink() {
      self::getCryptData();
      $result = Html::elem('a')
                    ->href(self::$adminurl)
                    ->setText(_('Login'));
      return $result;
    }

    public static function getLogoutLink() {
      $result = Html::elem('a')
                    ->href(self::$adminurl.self::ADMIN_URL, array(self::$get_adress[0] => self::$main_adress[1]))
                    ->setText(_('Logout'));
      return $result;
    }

    public static function execLogout() {
      unset($_SESSION[self::$session_index]);
      Core::setRefresh(Config::TIME_LOGIN, self::$weburl);
      $result = _('bye, logout!');
      return $result;
    }

    public static function getCryptData() {
      //zatim omezeno jen na jeden radek == 1 uzivatel
      if (!file_exists(self::$crypt_path)) {
        self::setDefaultCrypt();  //nastaveni defaultnich hodnot
      }
      $file = new Filesystem(self::$crypt_path, Filesystem::MODE_READ);
      return explode(':', trim($file->read()));
    }

    public static function setDefaultCrypt() {
      $file = new Filesystem(self::$crypt_path, Filesystem::MODE_WRITE);
      $data = sprintf('%s:%s', self::DEFSET, crypt(self::DEFSET));
      $file->write($data);
    }

    public static function setCryptData($login, $pass, $oldpass = NULL) {
      $result = false;
      if (file_exists(self::$crypt_path) && !empty($oldpass)) {
        $auth = self::getCryptData();
        $cryptoldpass = crypt($oldpass, $auth[1]);
        if ($auth[1] == $cryptoldpass) {
          $file = new Filesystem(self::$crypt_path, Filesystem::MODE_WRITE);
          $data = sprintf('%s:%s', $login, crypt($pass));
          $file->write($data);
          $result = true;
        } else {
          $result = false;
        }
      } else {
        echo 'Snazis se o nelegalni operaci!!';
      }
      return $result;
    }

    private static function isOriginalAuth() {
      $auth = self::getCryptData();
      //kontrola jestli neni stejny login a heslo stejne jako DEFSET
      return (self::DEFSET == $auth[0] && crypt($auth[0], $auth[1]) == $auth[1]);
    }

    //na prihlasovanci strance
    public static function getLoginForm() {
      $result = NULL;
//var_dump($weburl, $adminurl, self::$weburl, self::$adminurl);$weburl, $adminurlself::$adminurl
      $adminurl = self::$adminurl.self::ADMIN_URL;

      $form = new Form;
      $form->addBackLink(_('Back to web.'), self::$weburl, array(), array('id' => 'back_link_central'))
            ->addText('log', array('label' => _('Name')))
            ->addRule(Form::RULE_FILLED, _('You must filled name!'));
      $form->addPassword('pass', array('label' => _('Password')))
            ->addRule(Form::RULE_FILLED, _('You must filled password!'));
      $form->addSubmit('login_button', array('value' => _('Login')));

      if (self::isLogin()) {
        $form->addBackLink(_('Admin is now active.'), $adminurl, array(), array('id' => 'back_link_central'));
      }

      $result = $form;

      if ($form->isSubmitted()) {
        $values = $form->getValues();
        $auth = self::getCryptData();
        $_SESSION[self::$session_index] = NULL;

        if ($auth[0] == $values['log'] && (crypt($values['pass'], $auth[1]) == $auth[1])) {
          $hash = md5_file(self::$crypt_path);
          $_SESSION[self::$session_index] = array('login' => $auth[0],
                                                  'access' => true,
                                                  'hash' => $hash,  //ochrana proti zamene souboru prihlasovani!
                                                  'agent' => Core::getUserAgent(),
                                                  );

          $result = _('Login were successful.');
          Core::setRefresh(Config::TIME_LOGIN, $adminurl);  //uspesne
        } else {
          $result = _('Login were failed.');
          Core::setRefresh(Config::TIME_LOGIN, self::$weburl);  //neuspesne
        }
      }
      return $result;
    }

//TODO pripadne rozsisit o kontroli ip a session id
    private static function isLogin() {
      $result = false;
      $session = Core::isFill($_SESSION, self::$session_index);
      //osetreni podle md5_file a user-agenta
      if (!empty($session)) {
        $session = $_SESSION[self::$session_index];
        $result = ($session['access'] &&
                  file_exists(self::$crypt_path) &&
                  $session['hash'] == md5_file(self::$crypt_path) &&
                  $session['agent'] == Core::getUserAgent());
      }
      return $result;
    }

  }

  class ExceptionAdministration extends Exception {}

?>
