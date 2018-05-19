<?php
/*
 * route.php
 *
 * Copyright 2012 geniv <geniv.radek@gmail.com>
 *
 */

  namespace classes;

  use stdClass,
      Exception;

  final class Route {
    const VERSION = 1.36;

    private $route = null;

    /**
     * hlavni konstruktor
     * pokud se nenastavuje nic dal tak se berou informace z $_SERVER
     * REQUEST_URI a SCRIPT_NAME
     */
    public function __construct() {
      $this->route = new stdClass;
      $this->route->model = null;
      $this->route->defaulturi = null;
      $sub = self::getRequest(); //substr($_SERVER['REQUEST_URI'], strlen(dirname($_SERVER['SCRIPT_NAME'])) + (dirname($_SERVER['SCRIPT_NAME']) != '/' ? 1 : 0));
      $this->route->request = Core::isEmpty($sub);
    }

    /**
     * separace request retezce
     *
     * @return request text
     */
    public static function getRequest() {
      $len_uri = strlen($_SERVER['REQUEST_URI']);
      $dir_script = dirname($_SERVER['SCRIPT_NAME']);
      $len_script = strlen($dir_script) + ($dir_script != '/' ? 1 : 0);
      return ($len_uri != $len_script ? substr($_SERVER['REQUEST_URI'], $len_script) : '');
    }

    /**
     * vrati request uri
     *
     * @return request uri
     */
    public function getRequestUri() {
      return $this->route->request;
    }

    /**
     * nastavi request uri
     *
     * @param uri text uri odkazu
     * @return this
     */
    public function setRequestUri($uri) {
      if (!is_null($uri)) {
        $this->route->request = $uri;
      }
      return $this;
    }

    /**
     * rozpad request uri na pole
     *
     * @return pole request uri
     */
    public function getRequestUrl() {
      return explode('/', $this->route->request);
    }

    /**
     * rozpad defaultni uri na pole
     *
     * @return pole default uri
     */
    public function getDefaultUrl() {
      return explode('/', $this->route->defaulturi);
    }

    /**
     * nacteni route modelu
     *
     * @return route model
     */
    public function getRouteModel() {
      return $this->route->model;
    }

    /**
     * nastaveni route modelu
     *
     * @param model routovaci pole modelu
     * @return this
     */
    public function setRouteModel(array $model) {
      if (!empty($model)) {
        $this->route->model = $model;
      }
      return $this;
    }

    /**
     * nacteni defaultni uri
     *
     * @return defaultni uri
     */
    public function getDefaultUri() {
      return $this->route->defaulturi;
    }

    /**
     * nastaveni default uri
     *
     * @param uri novy defaut uri
     * @return this
     */
    public function setDefaultUri($uri) {
      if (!is_null($uri)) {
        $this->route->defaulturi = $uri;
      }
      return $this;
    }

    /**
     * vraceni defaultniho pole podle default uri a [0] indexu v modelu
     *
     * @return defautlni pole
     */
    private function getDefaultResult() {
      //bacha bere v uvahu jen 0 index!
      $model = explode('/', $this->route->model[0]);
      $default = explode('/', $this->route->defaulturi);
      //vezme jen tolik kolik je v defaultu
      $slice_model = array_slice($model, 0, count($default));
      //vytvoreni pole
      return array_combine($slice_model, $default);
    }

    /**
     * vrati asociativni pole z route model
     *
     * example:
     * array('action/subakce/id/di/ouje',
     *       'action==recipe/subakce2==blee/idd',
     *       'action==units/subakce3==edit2/editid2==[0-9]+/si',
     *       'action==units/subakce3==edit2/editid2==[a-z]+/si',)
     *
     * @param routemodel vstupni pole uri na route model
     * @return vysledne asociativni pole slozene z modelu a request adresy
     */
    public function getUri(array $routemodel = null) {
      $result = null;
      //load request uri from variables
      if (empty($this->route->model) && empty($routemodel)) {
        throw new ExceptionRoute('not definet route model!!!');
      } else
      if (empty($this->route->model) && !empty($routemodel)) {
        $this->route->model = $routemodel;
      }

      $uri = (empty($this->route->request) && !empty($this->route->defaulturi) ? $this->route->defaulturi : $this->route->request);
      $explodeuri = explode('/', $uri); //split string uri of the array

      if (!empty($explodeuri[0])) { //if explodeuri[0] not empty
        $primary_function = function($val, $key, $data) {
          $secondary_function = function($val, $key, $data) {
            $explodemodel = explode('==', $val);
            $index = $data['key'];
            $data['newmodel'][$index][$key] = $explodemodel[0];
            if (!empty($data['uri'][$key]) && !empty($explodemodel[1])) {
              //aplikace regiralniho vyrazu
              if ($explodemodel[1][0] == '[') {  //detekce regualrniho vyrazu
                if (preg_match(sprintf('/%s/', $explodemodel[1]), $data['uri'][$key], $ret)) {
                  $data['uri'][$key] = $ret[0]; //vraceni do pole dat overenou hodnotu
                  $explodemodel[1] = $ret[0]; //vnuceni explode modelu
                }
              }
              //vyhledavani nejlepsi schody
              if ($data['uri'][$key] == $explodemodel[1]) {
                $data['poc'][$index]++; //if equal then increment counter
              } else {
                $data['poc'][$index]--; //and if not then decrement counter
              }
            }
          };
          $splitmodel = explode('/', $val); //split each row route modelu
          $data['poc'][$key] = 0; //inicialize counter
          $data['newmodel'][$key]  = array(); //inicialize array new modelu
          //composition multi array for array_walk 3 from 4 is return in param
          $userdata = array('key' => $key,
                            'uri' => &$data['uri'],
                            'poc' => &$data['poc'],
                            'newmodel' => &$data['newmodel']);
          //for each secondary function
          array_walk($splitmodel, $secondary_function, $userdata);
        };
        $newmodel  = array(); //declaration array new model
        $poc = array(); //declaration counter
        //composition multi array for array_walk
        $userdata = array('uri' => &$explodeuri,
                          'poc' => &$poc,
                          'newmodel' => &$newmodel);
        //for each primary function
        array_walk($this->route->model, $primary_function, $userdata);
        //find max value from counter array
        $max = array_keys($userdata['poc'], max($userdata['poc']));
        $index = $max[0]; //selection 0.index from max for int value
        //slice from new model array with count explodeuri
        $slice = array_slice($userdata['newmodel'][$index], 0, count($explodeuri));
        //if count slice and count explodeuri is equal then exec array_combine

        if (count($slice) == count($explodeuri)) {
          $result = array_combine($slice, $explodeuri);
        }
      }

      //pokud je resutl null zajisti se defaultni hodnota
      if (is_null($result)) {
        $result = self::getDefaultResult();
      }
      return $result;
    }
  }

  class ExceptionRoute extends Exception {}

?>
