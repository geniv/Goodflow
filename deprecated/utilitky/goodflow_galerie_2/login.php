<?php
/*
 *      login.php
 *
 *      Copyright 2011 geniv <geniv.radek@gmail.com>
 *
 */

  final class Login {
    //normal login/first login
    protected $form;
    protected $login_file = '.lggfaolfloeordyofilrogwlien';
    protected $login_dir = '.logg';
    protected $login_crypt = 'whirlpool';
//TODO nektere metody predelat jen na static, a vubec tato trida muze byt singleton!!
    public function __construct() {
      //$absoluteurl = Core::getAbsoluteUrl();
    }

    public function isFirstLogin() {
      $path = "{$this->login_dir}/{$this->login_file}";
      return !file_exists($path);
    }

    public function isLogin() {
      $cookie = Core::getCookie('log');
      $cookie_ses = Core::getCookie(Core::getSessionName());
      $result = false;
      if (!empty($cookie) && !empty($cookie_ses)) {
        $result = (!$this->isFirstLogin() && $cookie == $cookie_ses);
      }

      return $result;
    }

    public function LoginForm() {

//var_dump($_GET);
//TODO zmenit na cistou stranku a tam dat jen ty 2 formulare!
//takze metoda isLogin by mela vracet zadane hodnoty a ty pak porovnavat s konstantama!

      $this->form = new Form;
      if ($this->isFirstLogin()) {
        Core::unsetCookie('log');
        Core::setRenewSessionId();

        $this->form->addText('log', array('label' => _('New name')))
              ->addRule(Form::RULE_FILLED, _('You must filled name!'));
        $this->form->addPassword('pass', array('label' => _('New password')))
              ->addRule(Form::RULE_FILLED, _('You must filled password!'));
        $this->form->addPassword('pass2', array('label' => _('Retype password')))
              ->addRule(Form::RULE_FILLED, _('You must filled retype password!'))
              ->addRule(Form::RULE_EQUAL, _('Passwords do not match'), $this->form->pass);
        $this->form->addSubmit('login_button', array('value' => _('Create')));
      } else {
        $this->form->addText('log', array('label' => _('Name')))
              ->addRule(Form::RULE_FILLED, _('You must filled name!'));
        $this->form->addPassword('pass', array('label' => _('Password')))
              ->addRule(Form::RULE_FILLED, _('You must filled password!'));
        $this->form->addSubmit('login_button', array('value' => _('Login')));
      }

      $result = $this->form;

      if ($this->form->isSubmitted()) {
        $values = $this->form->getValues();
        $final = $this->verifyAutorize($values);

        if ($this->isFirstLogin()) {
          if (!file_exists($this->login_dir)) {
            if (!mkdir($this->login_dir)) {
              echo 'nepovedlo se vytvorit slozku';
            }
          }
//FIXME doresit zpusob prihlasovani
          if (file_exists($this->login_dir)) {
            $path = "{$this->login_dir}/{$this->login_file}";
            $u = fopen($path, 'w');
            fwrite($u, $final);
            fclose($u);
          }

          //auto login
          Core::setCookie('log', Core::getSessionId($final));
          $result = _('Create & login successfully');
          Core::setRefresh(1, Core::getAbsoluteUrl());

        } else {
          //jen prihlaseni
          $path = "{$this->login_dir}/{$this->login_file}";
          $u = fopen($path, 'r');
          $data = fread($u, filesize($path));
          fclose($u);

          if ($final == $data) {
            Core::setCookie('log', Core::getSessionId($final));
            $result = _('Login successfully');
            Core::setRefresh(1, Core::getAbsoluteUrl());
          } else {
            $result = _('Login failed');
            Core::setRefresh(1, Core::getAbsoluteUrl());
          }
        }
      }

      return $result;
    }

    //public function LogoutLink() {
    public function LogoutForm() {
      $result = '';
      if ($this->isLogin()) {

        $absoluteurl = Core::getAbsoluteUrl();
        $get_adress = Administration::getGetAdress();

        //logout link
        $result = Html::elem('a')
                      ->href($absoluteurl, array($get_adress[0] => 'logout'))
                      ->setText(_('Logout'))
                      ;
//FIXME pri odhlasovani menit title!! -> text na prelozeni, zobrazuje prazdy
        $co = Core::isFill($_GET, $get_adress[0]);
        if ($co == 'logout') {
          Core::unsetCookie('log');
          Core::setRefresh(1, Core::getAbsoluteUrl());
          $result = Html::elem('span')->setText(_('Logout done'));
        }

      }

      return $result;
    }

    protected function verifyAutorize($values) {
      $crypt = hash_init($this->login_crypt);
      //TODO pouzit na hasovani funkce typu crypt???
      foreach ($values as $key => $value) {
        switch ($key) {
          case 'log':
          case 'pass':
            hash_update($crypt, $value);
          break;
        }
      }

      return hash_final($crypt);
    }

    public function getErrors() {
      return $this->form->getErrors();
    }
  }

?>
