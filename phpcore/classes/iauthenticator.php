<?php
/*
 * iauthenticator.php
 *
 * Copyright 2012 geniv <geniv.radek@gmail.com>
 *
 */

  namespace classes;

  /**
   * rozhranni pro Authenticator (rozpoznani uzivatelu)
   *
   * @package stable
   * @author geniv
   * @version 2.04
   */
  interface IAuthenticator {

    /**
     * metoda volana pri loginu v uzivatelich
     *
     * @uses SimpleAuthenticator
     * @uses SimpleRuleAuthenticator
     * @since 1.0
     *
     * @param arrays pole udaju: id,heslo
     * @return IIdentity|ExceptionAuthenticator
     */
    public function authenticate(array $arrays);
  }

  /**
   * trida vyjimky pro IAuthenticator
   *
   * @package stable
   * @author geniv
   * @version 1.0
   */
  class ExceptionAuthenticator extends \Exception {}