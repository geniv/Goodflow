<?php
/*
 * simpleauthenticator.php
 *
 * Copyright 2012 geniv <geniv.radek@gmail.com>
 *
 */

  namespace classes;

  /**
   * jednoducha aplikace tridy Authenticator pro prihlasovani (jednoduchy)
   * - vyuziti nan user jako ->login(login, gethash(login, hash))
   *
   * @package stable/user
   * @author geniv
   * @version 2.08
   */
  class SimpleAuthenticator implements IAuthenticator {
    private $userlist = array();
    private $errorThrow;

    /**
     * defaultni konstruktor
     *
     * @since 2.00
     * @param array userlist users array (user=>pass)
     * @param bool throw ovladani vystupu pri vyhodnocovani udaju, defaultne true (chybu vyhazuje Exception)
     */
    public function __construct(array $userlist, $throw = true) {
      $this->userlist = $userlist;
      $this->errorThrow = $throw;
    }
//FIXME autorizace by mela jet samostatne v try catch!! a errory prihladovani naharovat pres catch!!!
    /**
     * main method for authenticate process
     * - vyuziva vypinani throw
     *
     * @since 2.00
     * @param array credentials with login and pass (login, pass)
     * @return Identity|null instance of Identity or throw
     */
    public function authenticate(array $credentials) {
      list($login, $pass) = $credentials;
      if (isset($this->userlist[$login])) {
        if (strval($this->userlist[$login]) === strval($pass)) {  // kontrola indexu 1.arg a prevedeni 2.arg
          return new Identity($login);  // vytvoreni instance a jako id se pouzije 1.arg
        } else {
          if ($this->errorThrow) { throw new ExceptionAuthenticator('invalid pass'); }
        }
      } else {
        if ($this->errorThrow) { throw new ExceptionAuthenticator('invalid login'); }
      }
      return null;
    }
  }