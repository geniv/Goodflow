<?php
/*
 *      administration.php
 *
 *      Copyright 2011 geniv <geniv.radek@gmail.com>
 *
 */

  namespace classes;

  use configs\Config,
      Exception;

  final class Administration {
    const VERSION = '1.7';
    const ADMIN_URL = 'index.php';  //TODO po presunuti do zvlastni slozky bude po problemu?????????

    const HTACCESS_FILE = '.htaccess';
    private static $htaccess_path = NULL;

    const CRYPT_FILE = '.htpasswd';
    private static $crypt_path = NULL;

    private static $menu_template = NULL;
    private static $get_adress = array('action', 'co');
    private static $main_adress = array('login', 'logout'); //TODO login je tu zbytecny
    private static $session_index = NULL;
    private static $web_path = NULL;

    public static function getGetAdress() {
      return self::$get_adress;
    }

    private static function getMenuTemplate() {

      if (empty(self::$menu_template)) {
        $menu = Config::getLoadModules(); //nacitani moduu adminu
        $result = array();
        foreach ($menu as $polozka) {
          $state = $polozka::getState();
          if ($state) {
            $result[$polozka::URL] = array ('class' => $polozka,
                                            'name' => $polozka::getName(),
                                            );
          } else {
            echo sprintf(_('Module does not redy: %s'), $polozka);
            break;
          }
        }

        self::$menu_template = $result;
      }

      return self::$menu_template;
    }

    //aktualni get adresa
    public static function getCurrentAdress($uroven = 0) {
      return Core::isFill($_GET, self::$get_adress[$uroven]);
    }

    //title adminu
    public static function getAdminTitle() {
      $result = NULL;
      $current = self::getCurrentAdress();
      $menu = self::getMenuTemplate();
      $item = Core::isFill($menu, $current); //$this->menu_template[$current]['name'];
      if (!empty($item)) {
        $result = $item['name'];
      }
      return $result;
    }

    //menu adminu
    public static function getAdminMenu() {
      $item = array();
      $absoluteurl = Core::getAbsoluteUrl(NULL, array('path' => self::ADMIN_URL));
      $current = self::getCurrentAdress();
      $menu = self::getMenuTemplate();
      foreach ($menu as $url => $name) {
        $adress = (!empty($url) ? array(self::$get_adress[0] => $url) : NULL);
        $item[] = Html::elem('a')
                      ->href($absoluteurl, $adress)
                      ->setText($name['name'])
                      ->class($current == $url ? 'active' : NULL)
                      ->title($name['name'])
                      ->setNewLine('')
                      ;
      }
      $result = implode(Html::elem('span')->setText('/')->setNewLine(''), $item);

      return $result;
    }

    //obsah adminu
    public static function getAdminContent() {

      $current0 = self::getCurrentAdress();
      $current1 = self::getCurrentAdress(1);

      $text = NULL;
      $menu = self::getMenuTemplate();
      $item = Core::isFill($menu, $current0);  //$class = $this->menu_template[$current0]['class'];
      if (!empty($item)) {
        $class = $item['class'];
        $text = $class::getAdminContent($current1);
      }

      $result = Html::elem('div')
                    //->setText("--toto je hlavicka kazde admin stranky?--<hr />\n")
                    ->setText($text)
                    ;

      return $result;
    }



////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////

    //const STATE_LOGIN = 'login';
    const STATE_LOGOUT = 'logout';
    const STATE_ACCESS = 'access';
    const STATE_DENIED = 'denied';

    public static function setWebPath($path = NULL) {
      self::$web_path = $path;

      self::$crypt_path = sprintf('%s%s', self::$web_path, self::CRYPT_FILE);
      self::$htaccess_path = sprintf('%s%s', self::$web_path, self::HTACCESS_FILE);
    }

    public static function setSessionIndex($name) {
      self::$session_index = $name;
    }

    public static function getStateAdmin() {
      $current = self::getCurrentAdress();
      $result = NULL;
      switch ($current) {
        default:
          $result = (self::isLogin() ? self::STATE_ACCESS : self::STATE_DENIED);
        break;

/*
        case self::$main_adress[0]: //login page
          $result = self::STATE_LOGIN;
        break;
*/

        case self::$main_adress[1]: //logout page
          $result = self::STATE_LOGOUT;
        break;
      }

      return $result;
    }

    public static function getLoginLink($dir = NULL) {
      $absoluteurl = Core::getAbsoluteUrl();

      self::getCryptData();

      $result = Html::elem('a')
                    ->href(sprintf('%s%s%s', $absoluteurl, $dir, self::ADMIN_URL))
                    ->setText(_('Login here'))
                    ;
//, array(self::$get_adress[0] => self::$main_adress[0])
      return $result;
    }

    public static function getLogoutLink() {
      $absoluteurl = Core::getAbsoluteUrl();
//TODO ????????????
      $result = Html::elem('a')
                    ->href(sprintf('%s%s', $absoluteurl, self::ADMIN_URL), array(self::$get_adress[0] => self::$main_adress[1]))
                    ->setText(_('Logout here'))
                    ;

      return $result;
    }

    public static function execLogout($path = NULL) {
      unset($_SESSION[self::$session_index]);
      unset($_SERVER['PHP_AUTH_USER']);
      unset($_SERVER['PHP_AUTH_PW']);

      Core::setRefresh(Config::TIME_LOGIN, Core::getAbsoluteUrl(NULL, array('path' => $path)));
      $result = _('bye, logout!');
      return $result;
    }

    public static function getCryptData() {
      //zatim omezeno jen na jeden radek == 1 uzivatel
      if (!file_exists(self::$crypt_path)) {
        self::setCryptData('admin', 'admin'); //nastaveni defaultnich hodnot
      }

      $file = new Filesystem(self::$crypt_path, Filesystem::MODE_READ);
      return explode(':', trim($file->read()));
    }

    public static function setCryptData($login, $pass) {
      $file = new Filesystem(self::$crypt_path, Filesystem::MODE_WRITE);
      $data = sprintf('%s:%s', $login, crypt($pass));
      $file->write($data);
    }

    public static function checkOriginalAuth() {
      $auth = self::getCryptData();
      //kontrola jestli neni stejny login a heslo
      return (crypt($auth[0], $auth[1]) == $auth[1]);
    }

    public static function setHtaccess(array $settings = array()) {
      //FIXME nastavovat path z admin index pro web & admin! aby modul vedek kde co hledat!
      //var_dump(self::$htaccess_path, $settings, __DIR__);
/*
      $sablona = sprintf('#zobrazovani souboru
Options -Indexes

AuthUserFile %s/.htpasswd
AuthGroupFile /dev/null
AuthName "%s"
AuthType Basic
Require valid-user', dirname(Core::getWebPath()), $form->prompt);
*/
    }

    public static function getStateLogin() {
      $auth = self::getCryptData();

      $result = NULL;
      if ($auth[0] == $_SERVER['PHP_AUTH_USER'] && (crypt($_SERVER['PHP_AUTH_PW'], $auth[1]) == $auth[1])) {
        $hash = md5_file(self::$crypt_path);
        $_SESSION[self::$session_index] = array('login' => $auth[0],
                                                'access' => true,
                                                'hash' => $hash,  //ochrana proti zamene souboru prihlasovani!
                                                );

        $result = _('Login were successful.');
      }

      return $result;
    }

    //na prihlasovanci strance
/*
    public static function getLoginForm() {
      $result = NULL;

      $absoluteurl = Core::getAbsoluteUrl(NULL, array('path' => self::ADMIN_URL));
//FIXME jelikoz htpasswd zdrejme stoji na htaccess tak nebudu daat opravneni pres Form!
      $form = new Form;
      $form->addText('log', array('label' => _('Name')))
            ->addRule(Form::RULE_FILLED, _('You must filled name!'));
      $form->addPassword('pass', array('label' => _('Password')))
            ->addRule(Form::RULE_FILLED, _('You must filled password!'));
      $form->addSubmit('login_button', array('value' => _('Login')));

      if (self::isLogin()) {
        $form->addBackLink(_('Admin is now active.'), $absoluteurl);
      }

      $result = $form;

      if ($form->isSubmitted()) {
        $values = $form->getValues();

        $auth = self::getCryptData();

        $_SESSION[self::$session_index] = NULL;

//phpinfo();
//var_dump($_SERVER, 'REMOTE_USER', 'PHP_AUTH_USER', 'PHP_AUTH_PW');
//var_dump($_SERVER);

        if ($auth[0] == $values['log'] && (crypt($values['pass'], $auth[1]) == $auth[1])) {
          $hash = md5_file(self::CRYPT_FILE);
          $_SESSION[self::$session_index] = array('login' => $auth[0],
                                                  'access' => true,
                                                  'hash' => $hash,  //ochrana proti zamene souboru prihlasovani!
                                                  );

          $result = _('Login were successful.');
          Core::setRefresh(Config::TIME_LOGIN, $absoluteurl);
        } else {
          $result = _('Login were failed.');
          Core::setRefresh(Config::TIME_LOGIN, Core::getAbsoluteUrl());
        }
      }
      return $result;
    }
*/

    private static function isLogin() {
      $result = false;
      $session = Core::isFill($_SESSION, self::$session_index);
      if (!empty($session)) {
        $session = $_SESSION[self::$session_index];
        $result = ($session['access'] &&
                  file_exists(self::$crypt_path) &&
                  $session['hash'] == md5_file(self::$crypt_path));
      }
      return $result;
    }

  }

  class ExceptionAdministration extends Exception {}

?>
