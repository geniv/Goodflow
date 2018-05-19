<?php
/*
 * iauthenticator.php
 *
 * Copyright 2012 geniv <geniv.radek@gmail.com>
 *
 */

  namespace classes;

  /**
   *
   * rozhranni pro Authenticator (rozpoznani uzivatelu)
   *
   */
  interface IAuthenticator {
    //const VERSION = 2.04;
    public function authenticate(array $arrays);
  }

  class ExceptionAuthenticator extends \Exception {}
