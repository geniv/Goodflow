<?php
/*
 * simpleruleauthenticator.php
 *
 * Copyright 2013 geniv <geniv.radek@gmail.com>
 *
 */

  namespace classes;

  /**
   * jednoducha aplikace tridy Authenticator pro prihlasovani (naivni) s rule
   *
   * @package stable/user
   * @author geniv
   * @version 1.10
   */
  class SimpleRuleAuthenticator implements IAuthenticator {
    private $userlist = array();

    /**
     * default constructor
     *
     * @since 1.00
     * @param array userlist users array (user=>array(pass, array(roles)))
     */
    public function __construct(array $userlist) {
      $this->userlist = $userlist;
    }

    /**
     * main method for authenticate process
     *
     * @since 1.00
     * @param array credentials with login and pass (login, pass)
     * @return Identity|null instance of Identity or throw
     */
    public function authenticate(array $credentials) {
      list($login, $pass) = $credentials;
      if (isset($this->userlist[$login])) {
        if (!isset($this->userlist[$login][1]) || !is_array($this->userlist[$login][1])) {
          throw new ExceptionAuthenticator('bad array format; l => (p, array(r))');
        }

        if (strval($this->userlist[$login][0]) === strval($pass)) {
          return new Identity($login, $this->userlist[$login][1]);
        } else {
          throw new ExceptionAuthenticator('invalid pass');
        }
      } else {
        throw new ExceptionAuthenticator('invalid login');
      }
    }
  }