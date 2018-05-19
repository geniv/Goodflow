<?php
/*
 * userstorage.php
 *
 * Copyright 2012 geniv <geniv.radek@gmail.com>
 *
 */

  namespace classes;
//TODO vygenerovat testy?! dopsat komentare!!!
  use classes\Session;

  //uloziste nad session
  interface IUserStorage {
    //const VERSION = 1.02;
    const MANUAL = 1,
          INACTIVITY = 2,
          BROWSER_CLOSED = 4;
    const CLEAR_IDENTITY = 8;

    public function setAuthenticated($state);
    public function isAuthenticated();
    public function setIdentity(IIdentity $identity = null);
    public function getIdentity();
    public function setExpiration($time, $flags = 0);
    public function getLogoutReason();
  }

  //uzivatelske uoziste vyuzivajici session
  class UserStorage implements IUserStorage {
    const VERSION = 1.32;

    private $handler, $section, $sectionname = ''; //session, session section, name session section

    public function __construct(Session $handler) {
      $this->handler = $handler;
    }

    //nastaveni remote info
    public function setRemoteInfo($info) {
      $this->getSessionSection(true)->server = $info;
    }

    //nacteni remove info
    public function getRemoteInfo() {
      return $this->getSessionSection(false)->server;
    }

    /**
     * Sets the authenticated status of this user.
     * @param  bool
     * @return UserStorage Provides a fluent interface
     */
    public function setAuthenticated($state) {
      $sect = $this->getSessionSection(true);
      $sect->authenticated = (bool) $state; //zapis do session

      $this->handler->regenerateId(); //regenerace session

      if ($state) { //dle stavu nastavi session
        $sect->reason = null;
        $sect->authTime = time(); //informacne
      } else {
        $sect->reason = self::MANUAL;
        $sect->authTime = null;
      }
      return $this;
    }

    /**
     * Sets the authenticated status of this user.
     * @param  bool
     * @return UserStorage Provides a fluent interface
     */
    public function isAuthenticated() {
      $sect = $this->getSessionSection(false);
      return ($sect && $sect->authenticated);
    }

    /**
     * Returns current user identity, if any.
     * @return Nette\Security\IIdentity|NULL
     */
    public function getIdentity() {
      $sect = $this->getSessionSection(false);
      return ($sect ? $sect->identity : null);
    }

    /**
     * Sets the user identity.
     * @param  IIdentity
     * @return UserStorage Provides a fluent interface
     */
    public function setIdentity(IIdentity $identity = null) {
      $this->getSessionSection(true)->identity = $identity;
      return $this;
    }

    /**
     * Returns current namespace.
     * @return string
     */
    public function getNamespace() {
      return $this->sectionname;
    }

    /**
     * Changes namespace; allows more users to share a session.
     * @param  string
     * @return UserStorage Provides a fluent interface
     */
    public function setNamespace($namespace) {
      if ($this->sectionname !== $namespace) {
        $this->sectionname = strval($namespace);
        $this->section = null;
      }
      return $this;
    }

    //vraceni casu
    public function getAuthTime() {
      $sect = $this->getSessionSection(false);
      return $sect->authTime;
    }
//FIXME uplne nahovno! respektive prepsat! tady ten system ma jiste mezery!!
    /**
     * Enables log out after inactivity.
     * @param  string|int|DateTime Number of seconds or timestamp
     * @param  int Log out when the browser is closed | Clear the identity from persistent storage?
     * @return UserStorage Provides a fluent interface
     */
    public function setExpiration($time, $flags = 0) {
      $sect = $this->getSessionSection(true);
      if ($time) { //pokud je nastaven cas
        $time = DateAndTime::from($time)->format('U');
        $sect->expireTime = $time;  //cas expirace
        $sect->expireDelta = $time - time();  //cas rozdilu
      } else {
        unset($sect->expireTime, $sect->expireDelta);
      }

      $sect->expireIdentity = (bool) ($flags & self::CLEAR_IDENTITY); //expirace na vyprseni identity
      $sect->expireBrowser = (bool) ($flags & self::BROWSER_CLOSED);  //expirace na zavreni prohlizece
      $sect->expireBrowser = true;
      $sect->setExpiration(0, 'browserCheck');  //expiraca pro promenou

      return $this;
    }

    /**
     * Why was user logged out?
     * @return int
     */
    public function getLogoutReason() {
      $sect = $this->getSessionSection(false);
      return ($sect ? $sect->reason : null);
    }

//zpracovani sekce session, true = zapis, false = cteni
    /**
     * Returns and initializes $this->sessionSection.
     * @return SessionSection
     */
    private function getSessionSection($need) { //true - nacitat (a menit)/false - pouze cist
      if ($this->section != null) { //pokud uz existuje
        return $this->section;
      }

      if (!$need && !$this->handler->isExists()) {  //pokud pro cteni a neexistuje
        return null;
      }

      $this->section = $sect = $this->handler->getSection('UserStorage/'.$this->sectionname);

      //pokud neni identita nebo authenticated neni bool
      if (!$sect->identity instanceof IIdentity || !$sect->authenticated) {
        $sect->remove();
      }

      //kontrola uzavreni prohlizece
      //~ if ($sect->authenticated && $sect->expireBrowser && !$sect->browserCheck) {
        //~ $sect->reason = self::BROWSER_CLOSED;
        //~ $sect->authenticated = false;
        //~ if ($sect->expireIdentity) {  //ma vymazat i identitu?
          //~ unset($sect->identity);
        //~ }
      //~ }

      //kontrola vyprseni casu
      if ($sect->authenticated && $sect->expireDelta > 0) {
        if ($sect->expireTime < time()) {
          $sect->reason = self::INACTIVITY;
          $sect->authenticated = false;
          if ($sect->expireIdentity) {  //ma vymazat i identitu?
            unset($sect->identity);
          }
        }
        $sect->expireTime = time() + $sect->expireDelta;  //posunuti casu expirace
      }
//~ var_dump(date('d.m.Y H:i:s', $sect->expireTime));
      //pokud neni autorizovano
      if (!$sect->authenticated) {
        unset($sect->expireTime, $sect->expireDelta, $sect->expireIdentity,
          $sect->expireBrowser, $sect->browserCheck, $sect->authTime);
      }
      return $this->section;
    }
  }

?>
