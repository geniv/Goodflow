<?php
/*
 * router.php
 *
 * Copyright 2013 geniv <geniv.radek@gmail.com>
 *
 */

  namespace classes;

  /**
   * routovaci trida
   * -vychozi seperator adresy '/'
   * -instancni i staticka varianta vystupu
   *
   * @package stable
   * @author geniv
   * @version 2.76
   */
  final class Router {

    private $model = null;
    private $default = null;
    private $request = null;

    /**
     * hlavni konstruktor
     *
     * @since 2.00
     * @param string|array model pole uri modelu pro rewrite
     * @param string default defaultni uri kdyz nebude odpovidat request
     */
    public function __construct($_model = null, $_default = '') {
      $this->model = $_model;
      $this->default = $_default;
      $this->request = self::request();
    }

    /**
     * nacteno route modelu
     *
     * @since 2.10
     * @return array pole modelu
     */
    public function getModel() {
      return $this->model;
    }

    /**
     * nastaveni route modelu
     *
     * @since 2.10
     * @param array model pole modelu
     * @return this
     */
    public function setModel($_model) {
      $this->model = $_model;
      return $this;
    }

    /**
     * nacteni defaultni uri
     *
     * @since 2.16
     * @return string defaultni uri
     */
    public function getDefault() {
      return $this->default;
    }

    /**
     * nastaeni defaultni uri
     *
     * @since 2.16
     * @param string default defaultni uri
     * @return this
     */
    public function setDefault($_default) {
      $this->default = $_default;
      return $this;
    }

    /**
     * nacteni array requestu
     *
     * @since 2.04
     * @return string text requestu
     */
    public function getRequestUri() {
      return explode('/', $this->request);
    }

    /**
     * nacteni requestu
     *
     * @since 2.64
     * @return string request
     */
    public function getRequest() {
      return $this->request;
    }

    /**
     * nastaveni requestu
     *
     * @since 2.06
     * @param string request text request
     * @return this
     */
    public function setRequest($_request) {
      $this->request = $_request;
      return $this;
    }

    /**
     * nacitani instancniho uri, bere data z instance
     *
     * @since 2.22
     * @param int from orezat pole adresy od
     * @param int length delka orezu adresy
     * @return array slozene pole podle modelu
     */
    public function getUri($from = 0, $length = null) {
      return self::uri($this->model, $this->default, $this->request, $from, $length);
    }

    /**
     * nacteni separovaneho request retezce
     *
     * @return string request text
     */
    public static function request() {
      $len_uri = strlen($_SERVER['REQUEST_URI']);
      $dir_script = dirname($_SERVER['SCRIPT_NAME']);
      $len_script = strlen($dir_script) + ($dir_script != '/' ? 1 : 0);
      return ($len_uri != $len_script ? substr($_SERVER['REQUEST_URI'], $len_script) : '');
    }

    /**
     * zpracovani defaultniho vystupu
     *
     * @since 2.32
     * @param string _model model hlavni model, index [0]
     * @param string _default  defaultni adresa
     * @return array slouceen pole
     */
    private static function getDefaultResult($_model, $_default) {
      //bacha bere v uvahu jen 0 index!
      $model = explode('/', $_model);
      $default = explode('/', $_default);
      //vezme jen tolik kolik je v defaultu
      $slice_model = array_slice($model, 0, count($default));
      //vytvoreni pole
      return array_combine($slice_model, $default);
    }

    /**
     * zpracovani slucovani requestu a modelu
     *
     * @since 2.60
     * @param array _model model na slouceni
     * @param array _request pole hodnot
     * @return array sloucene pole
     */
    private static function getResult($_model, $_request) {
      $_count = count($_request);
      // orezani modelu podle poctu polozek v requestu
      $slice = array_slice($_model, 0, $_count);
      if (count($slice) === $_count) {
        // slouceni klicu a hodnot
        return array_combine($slice, $_request);
      }
      return null;
    }

    /**
     * nacitani statickeho uri, bere data z parametru
     *
     * @since 2.22
     * @param string|array model text/jediny index je hlavni pravidlo, dalsi jsou pomocne a upresnujici
     * @param string default_uri defaultni uri adresa
     * @param int from orezat pole adresy od
     * @param int length delka orezu adresy
     * @return array slozene pole podle modelu
     */
    public static function uri($model, $default_uri = '', $request = null, $from = 0, $length = null) {
      $result = null;
      // zpracovani requestu
      $explode_request = explode('/', (!is_null($request) ? $request : self::request()));

      // zpracovani samostatneho modelu,  nacteni hlavniho modelu
      $main_model = (is_array($model) ? $model[0] : $model);

      // pokud je v requestu nejaky text
      if (!empty($explode_request[0])) {

        // podle poctu polozek v modelu rozdeluje parsrovani
        if (count($model) > 1) {

          $newmodel = array();
          $poc = array();
          // prochazeni dostupnych modelu
          foreach ($model as $_mod_index => $_mod) {

            $newmodel[$_mod_index] = null;
            $poc[$_mod_index] = 0;
            $explode_model = explode('/', $_mod); // rozdeleni modelu podle /
            foreach ($explode_model as $_ex_index => $_ex_model) {

              // rozdeleni indexu podle ==
              $cmp_ex_model = explode('==', $_ex_model);
              if (isset($cmp_ex_model[1]) && isset($explode_request[$_ex_index])) {

                // detekce regexp, cocita se v tim ze bude uzavreny v []
                if ($cmp_ex_model[1][0] === '[' && preg_match('/'.$cmp_ex_model[1].'/', $explode_request[$_ex_index], $ret)) {
                  $cmp_ex_model[1] = $ret[0]; // vnuceni na porovanni hodnoty prevzate z regexp
                }

                // porovanvani shody
                if ($cmp_ex_model[1] === $explode_request[$_ex_index]) {
                  $poc[$_mod_index]++;  // pokud se shoduje pridava vahu
                } else {
                  $poc[$_mod_index]--;
                }
              }
              // tvorba noveho modelu
              $newmodel[$_mod_index][] = $cmp_ex_model[0];
            }
          }

          // najiti maxima v mezi hodnotamy a nalezeni klic
          $_max = array_keys($poc, max($poc));

          // zpracovani modelu a requestu
          $result = self::getResult($newmodel[$_max[0]], $explode_request);
        } else {

          // zpracovani modelu a requestu
          $result = self::getResult(explode('/', $main_model), $explode_request);
        }
      }

      //aplikace defaultu, pokud neni result definovano
      if (!$result) {
        $result = self::getDefaultResult($main_model, ($default_uri ?: ''));
      }

      // aplikace orezevani
      if ($from || $length) {
        $result = array_slice($result, $from, $length);
      }

      return $result;
    }
  }