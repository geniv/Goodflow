<?php
/*
 * user.php
 *
 * Copyright 2013 geniv <geniv.radek@gmail.com>
 *
 * sprava uzivatelu, tridy: User, Identity, staticACL
 */

  namespace classes;

  /**
   * nevlastni rozhranni pro indentitu uzivatele
   *
   * @package stable/user
   * @author geniv
   * @version 2.00
   */
  interface IIdentity {

    /**
     * vraceni id uzivatele
     *
     * @since 2.00
     * @param void
     * @return int|string id uzivatele
     */
    public function getId();

    /**
     * vraceni roli uzivatele
     *
     * @since 2.00
     * @param void
     * @return array pole roli
     */
    public function getRoles();
  }


  /**
   * nevlastni trida spravujici identitu uzivatele
   *
   * @package stable/user
   * @author geniv
   * @version 2.12
   */
  class Identity implements IIdentity {

    private $id = null; //identifikator uzivatele
    private $roles = null;  //role uzivatele
    private $data = null; //dalsi data

    /**
     * konstruktor identity
     *
     * @param int|string id identifikator uzivatele
     * @param array roles pole roli kterych uzivatel nabyva
     * @param array data pridavne data
     */
    public function __construct($id, array $roles = array(), $data = null) {
      $this->id = (is_numeric($id) ? 1 * $id : $id);
      $this->roles = $roles;
      $this->data = $data;
    }

    /**
     * nacitani id uzivatele
     *
     * @return int|string id
     */
    public function getId() {
      return $this->id;
    }

    /**
     * nacitani roli uzivatele
     *
     * @return array pole roli
     */
    public function getRoles() {
      return $this->roles;
    }

    /**
     * nacitani dat
     *
     * @param string|int index pripadny index do pole
     * @return string pridavne data
     */
    public function getData($index = null) {
      return ($index ? $this->data[$index] : $this->data);
    }
  }


  /**
   * hlavni vlastni trida uzivatelu
   *
   * @package stable/user
   * @author geniv
   * @version 2.52
   */
  class User {

    private $authenticator = null;  //prihasovani
    private $authorizator = null; //overovani pro ACL

    private $sessionHandler = null; //hlandler session objektu
    private $sessionSection = null;  //jmenny prostor pro session

    //callback funkce pro prihlaseni a odhlaseni
    private $callbackLoggedIn, $callbackLoggedOut;

    /**
     * hlavni konstruktor a vytvoreni session a session sekce
     *
     * @param string session_name nazev session sekce
     */
    public function __construct($session_name) {
      $this->sessionHandler = new Session;
      $this->sessionHandler->setExpiration(0);  // do zavreni prohlizece
      $this->sessionSection = $this->sessionHandler->getSection($session_name);
      $this->sessionSection->setClearAfterExpire(true);  //automaticky odhlasuje
    }

    /**
     * nacitani identity ze session
     *
     * @return string session identita
     */
    private function getSessionIdentity() {
      return $this->sessionSection->identity;
    }

    /**
     * nastaveni identity do session
     *
     * @param IIdentity identity identita na vlozeni
     * @return this
     */
    private function setSessionIdentity(IIdentity $identity = null) {
      $this->sessionSection->identity = $identity;
      return $this;
    }

    /**
     * je autentikace ze session?
     *
     * @return bool true pokud je autenticovano
     */
    private function isSessionAuthenticated() {
      return $this->sessionSection->authenticated;
    }

    /**
     * nastaveni stavu authentikace
     *
     * @param bool state stav pro nastaveni stavu
     * @return this
     */
    private function setSessionAuthenticated($state) {
      $this->sessionSection->authenticated = $state;  // nastaveni stavu
      $this->sessionHandler->regenerateId();  // obnova id
      return $this;
    }

    /**
     * nacteni client info ze session
     *
     * @return string client info
     */
    private function getSessionClientInfo() {
      return $this->sessionSection->client;
    }

    /**
     * nastaveni client info do session
     *
     * @param string info client info
     * @return this
     */
    private function setSessionClientInfo($info) {
      $this->sessionSection->client = $info;
      return $this;
    }

    /**
     * nacteni serverove identifikace uzivatele
     *
     * @return string client info
     */
    private function getServerClientInfo() {
      return ($_SERVER['REMOTE_ADDR'].'::'.$_SERVER['HTTP_USER_AGENT']);
    }

    /**
     * prihlasovni uzivatele do session
     *
     * @param IIdentity|string identity identita|login pro authentikaci
     * @param string|null password heslo pro authentikaci
     * @return this
     */
    public function login($identity, $password = null) {
      if (!($identity instanceof IIdentity)) {
        $identity = $this->authenticator->authenticate(array($identity, $password));
      }

      if (!is_null($identity)) {
        $this->setSessionIdentity($identity)  // nastaveni identity
            ->setSessionAuthenticated(true) // prihlaseny = true
            ->setSessionClientInfo($this->getServerClientInfo());

        if ($this->callbackLoggedIn) {
          call_user_func($this->callbackLoggedIn, $this); // volani callback po prihlaseni
        }
      }
      return $this;
    }

    /**
     * odhlasovani uzivatel ze session
     * -expirace udaju probiha sama, ale lze okamzite vynutit
     *
     * @param bool clearIdentity true pro vynuceni okamzite smazani identity
     * @return this
     */
    public function logout($clearIdentity = false) {
      if ($this->isLoggedIn()) {
        if ($this->callbackLoggedOut) { //obsluha callbyck odhlaseni
          call_user_func($this->callbackLoggedOut, $this);  // volani callback po odhlaseni
        }

        $this->setSessionAuthenticated(false);
      }

      if ($clearIdentity) {
        $this->setSessionIdentity(null);
      }
    }

    /**
     * je uzivatel prihlaseny?
     *
     * @return bool true pokud je uzivatel prihlaseny
     */
    public function isLoggedIn() {
      return ($this->isSessionAuthenticated() && $this->getSessionClientInfo() === $this->getServerClientInfo());
    }

    /**
     * nacteni aktualni identity
     *
     * @return IIdentity identita
     */
    public function getIdentity() {
      return $this->getSessionIdentity();
    }

    /**
     * nacteni id uzivatele z identity
     *
     * @return string|int id uzivatele
     */
    public function getId() {
      $identity = $this->getSessionIdentity();
      return ($identity ? $identity->getId() : null);
    }

    /**
     * nacteni role z identity
     *
     * @return array pole roli indentity
     */
    public function getRoles() {
      $identity = $this->getSessionIdentity();
      return ($identity ? $identity->getRoles() : null);
    }

    /**
     * nacteni dat z indetity
     *
     * @param string index nepovinny index (klic) pokud je v datech pole
     * @return string|null hodnota dat
     */
    public function getData($index = null) {
      $identity = $this->getSessionIdentity();
      return ($identity ? $identity->getData($index) : null);
    }

    /**
     * je role v rolich uzivatele
     *
     * @param string role role na overeni
     * @return bool true pokud je "v roli"
     */
    public function isInRole($role) {
      $roles = $this->getRoles();
      return (isset($roles) && is_array($roles) && in_array($role, $roles));
    }

    /**
     * nacteni expirace prihlaseni, predsunuteho casu dopredu
     *
     * @return string cas expirace formatu "1 hours"
     */
    public function getExpiration() {
      return $this->sessionSection->getExpiration();
    }

    /**
     * nastavovani expirace prihlaseni, predsouvani casu dopredu
     * -defaultni hodnota je '1 hours'
     *
     * @param string time cas expirace ve formatu "2 hours"
     * @return this
     */
    public function setExpiration($time) {
      $this->sessionSection->setExpiration($time);
      return $this;
    }

    /**
     * nacitani casu expirace
     *
     * @return string cas expirace
     */
    public function getExpirationTime() {
      return $this->sessionSection->getExpirationTime();
    }

    /**
     * prikaz na revalidaci casu prihlaseni
     *
     * @return this
     */
    public function revalidate() {
      $this->sessionSection->revalidate();
      return $this;
    }

    /**
     * nastavovani callback funkce pro prihlasovani
     * pouziva jeden parametr (this) !!
     *
     * @param callback closure|nazev funkce ktera se ma spoustet
     * @return this
     */
    public function setCallbackLoggedIn($callback) {
      $this->callbackLoggedIn = $callback;
      return $this;
    }

    /**
     * nastavovani callback funkce pro odhlasovani
     * pouziva jeden parametr (this) !!
     *
     * @param callback closure|nazev funkce ktera se ma spoustet
     * @return this
     */
    public function setCallbackLoggedOut($callback) {
      $this->callbackLoggedOut = $callback;
      return $this;
    }

    /**
     * vraci instanci authenticatoru
     * -pro overovani uzivatelu
     *
     * @return IAuthenticator instance authenticatoru
     */
    public function getAuthenticator() {
      return $this->authenticator;
    }

    /**
     * nastavuje instanci authenticatoru
     * -pro overovani uzivatelu
     *
     * @param IAuthenticator handler instance authenticatoru zalozana na rozhranni IAuthenticator
     * @return this
     */
    public function setAuthenticator(IAuthenticator $handler) {
      $this->authenticator = $handler;
      return $this;
    }

    /**
     * vraci instanci authorizatoru
     * -pro overovani prav uzivatele (pomoci ACL)
     *
     * @return IAuthorizator instance authorizatoru
     */
    public function getAuthorizator() {
      return $this->authorizator;
    }

    /**
     * nastavuje instanci authorizatoru
     * -pro overovani prav uzivatele (pomoci ACL)
     *
     * @param IAuthorizator handler instance authorizatoru zalozena na rozhranni IAuthorizator
     * @return this
     */
    public function setAuthorizator(IAuthorizator $handler) {
      $this->authorizator = $handler;
      return $this;
    }

    /**
     * overuje jestli nektera role uzivatele ma pravo pro konkretni zdroj a prava
     *
     * @param string resource zdroje
     * @param string privilege prava
     * @return bool true pokud ma na pozadovanou akci pravo
     */
    public function isAllowed($resource = IAuthorizator::ALL, $privilege = IAuthorizator::ALL) {
      // overovani pro kazdou roli uzivatele
      $roles = $this->getRoles();
      if ($roles) {
        foreach ($roles as $role) {
          if ($this->authorizator->isAllowed($role, $resource, $privilege)) {
            return true;
          }
        }
      }
      return false;
    }
  }


  /**
   * nevlastni rozhranni pro autorizaci opravneni
   *
   * @package stable/user
   * @author geniv
   * @version 2.02
   */
  interface IAuthorizator {

    const ALL = 'all';
    const ALLOW = 'allow';
    const DENY = 'deny';

    /**
     * je dovoleno pristupovat podle zadaneho opravneni?
     *
     * @since 2.02
     * @param string role nazev role
     * @param string resource nazev zdroje
     * @param string privilege nazev prava
     * @return bool true pokud ma opravneni
     */
    public function isAllowed($role = self::ALL, $resource = self::ALL, $privilege = self::ALL);
  }

  /**
   * trida vyjimky pro IAuthorizator
   *
   * @package stable/user
   * @author geniv
   * @version 1.00
   */
  class ExceptionAuthorizator extends \Exception {}


  /**
   * nevlastni trida spravujici staticke ACL (access control list)
   *
   * @package stable/user
   * @author geniv
   * @version 4.00
   */
  class StaticACL implements IAuthorizator {

    private $roles = array(); // pole roles
    private $resources = array(); // pole resources
    private $rules = array(); //pole rules
    private $loadFromFile = false;  //nacitano ze souboru?

    /**
     * hlavni konstruktor ACL
     *
     * @param string|null path pripadna cesta pro prime nacteni ACL cache
     */
    public function __construct($path = null) {
      $this->loadFromFile($path);
    }

    /**
     * pridavani novych roli
     *
     * @param string role nazev role
     * @param string|array|null parents nazev role od ktere dedi
     * @return this
     */
    public function addRole($role, $parents = null) {
      // zabraneni pouziti pole pri dedeni roli
      if (is_array($parents)) { throw new ExceptionAuthorizator('does not support array in parents!'); }
      if ($this->hasRole($role)) { throw new ExceptionAuthorizator($role.' aleady exist!'); }

      if (is_null($parents)) {
        $this->roles[$role] = array('parents' => null);
      } else {
        // kontrola existence rodicu
        if (!$this->hasRole($parents)) { throw new ExceptionAuthorizator($parents.' does not exist!'); }
        $this->roles[$role] = array('parents' => (array) $parents);
      }
      return $this;
    }

    /**
     * vnitrni nacteni konkretni role
     *
     * @param string role nazev hledane role
     * @return array obsah vyhledane role
     */
    private function getRole($role) {
      return (isset($this->roles[$role]) ? $this->roles[$role] : null);
    }

    /**
     * obsahuje tuto roli?
     *
     * @param string role nazev role
     * @return bool true pokud roli obsahue
     */
    public function hasRole($role) {
      return (isset($this->roles[$role]));
    }

    /**
     * nacteni pole roli
     *
     * @return array pole roli
     */
    public function getRoles() {
      return array_keys($this->roles);
    }

    /**
     * nastaveni pole roli
     *
     * @param array pole roli
     * @return this
     */
    public function setRoles($roles) {
      $this->roles = $roles;
      return $this;
    }

    /**
     * nacteni rodicu dane role
     * -rekurzivne hleda vsechy rodice
     *
     * @param string role nazev role
     * @return array pole rodicu
     */
    public function getRoleParents($role) {
      $result = null;
      if (isset($this->roles[$role]['parents'])) {
        foreach ($this->roles[$role]['parents'] as $roles) {
          $result[] = $roles;
          $res = $this->getRoleParents($roles);
          if ($res) {
            $result = array_unique(array_merge($result, $res)); // unikatni soucet
          }
        }
      }
      return $result;
    }

    /**
     * je role predkem?
     *
     * @param string role hledana role
     * @param string inherit dedi z
     * @return bool true pokud je v dane roli
     */
    public function roleInheritsFrom($role, $inherit) {
      $roles = $this->getRoleParents($role);
      return (!is_null($roles) && in_array($inherit, $roles));
    }

    /**
     * smazani konkretni role
     *
     * @param string role nazev prole na smazani
     * @return this
     */
    public function removeRole($role) {
      unset($this->roles[$role]);
      return $this;
    }

    /**
     * smazani vsech roli
     *
     * @return this
     */
    public function removeAllRoles() {
      $this->roles = array();
      return $this;
    }

    /**
     * pridavani novych zdroju
     *
     * @param stinrg resource nazev zdroje
     * @param string|array|null parents nazev|pole zdroju od kterych dedi
     * @return this
     */
    public function addResource($resource, $parents = null) {
      if ($this->hasResource($resource)) { throw new ExceptionAuthorizator($resource.' aleady exist!'); }

      if (is_null($parents)) {
        $this->resources[$resource] = array('parents' => null);
      } else {
        // kontrola existence rodicu
        if (is_array($parents)) {
          foreach ($parents as $p) {
            if (!$this->hasResource($p)) { throw new ExceptionAuthorizator($p.' does not exist!'); }
          }
        } else {
          if (!$this->hasResource($parents)) { throw new ExceptionAuthorizator($parents.' does not exist!'); }
        }
        $this->resources[$resource] = array('parents' => (array) $parents);
      }
      return $this;
    }

    /**
     * vnitrni nacteni konkretniho zdroje
     *
     * @param string resource nazev zdroje
     * @return array obsah vyhledaneho zdroje
     */
    private function getResource($resource) {
      return (isset($this->resources[$resource]) ? $this->resources[$resource] : null);
    }

    /**
     * obsahuje tento zdroj?
     *
     * @param string resource nazev zdroje
     * @return bool true pokud zdroj existuje
     */
    public function hasResource($resource) {
      return (isset($this->resources[$resource]));
    }

    /**
     * nacteni pole zdroju
     *
     * @return array pole zdroju
     */
    public function getResources() {
      return array_keys($this->resources);
    }

    /**
     * nastaveni pole zdroju
     *
     * @param array resources pole zdroju
     * @return thia
     */
    public function setResources($resources) {
      $this->resources = $resources;
      return $this;
    }

    /**
     * nacteni rodicu daneho zdroje
     *
     * @param string resource nazev zdroje
     * @return array pole rodicu
     */
    public function getResourceParents($resource) {
      $result = null;
      if (isset($this->resources[$resource]['parents'])) {
        foreach ($this->resources[$resource]['parents'] as $resources) {
          $result[] = $resources;
          $res = $this->getResourceParents($resources);
          if ($res) {
            $result = array_unique(array_merge($result, $res)); // unikatni soucet
          }
        }
      }
      return $result;
    }

    /**
     * je zdroj predkem?
     *
     * @param string resource hledany zdroj
     * @param string inherit dedi z
     * @return bool true pokud je v danem zdroji
     */
    public function resourceInheritsFrom($resource, $inherit) {
      $resources = $this->getResourceParents($resource);
      return (!is_null($resources) && in_array($inherit, $resources));
    }

    /**
     * smazani konkretniho zdroje
     *
     * @param string resource nazev zdroje
     * @return this
     */
    public function removeResource($resource) {
      unset($this->resources[$resource]);
      return $this;
    }

    /**
     * smazani vsech zdroju
     *
     * @return this
     */
    public function removeAllResources() {
      $this->resources = array();
      return $this;
    }

    /**
     * nastaveni pristupu ALLOW (povoleni)
     *
     * @param string role nazev role
     * @param string|array resources nazev zdroje
     * @param string|array privileges nazev prava
     * @param bool|string last boolean|path oznameni posledniho pravidla, respektive cesta pro cache ACL
     * @return this
     */
    public function allow($role = self::ALL, $resources = self::ALL, $privileges = self::ALL, $last = false) {
      $this->setRule($role, $resources, $privileges, self::ALLOW);
      if ($last) { $this->commitRules(is_string($last) ? $last : null); }
      return $this;
    }

    /**
     * nastaveni pristupu DENY (odepreni)
     *
     * @param string role nazev role
     * @param string|array resources nazev zdroje
     * @param string|array privileges nazev prava
     * @param bool|string last boolean|path oznameni posledniho pravidla, respektive cesta pro cache ACL
     * @return this
     */
    public function deny($role = self::ALL, $resources = self::ALL, $privileges = self::ALL, $last = false) {
      $this->setRule($role, $resources, $privileges, self::DENY);
      if ($last) { $this->commitRules(is_string($last) ? $last : null); }
      return $this;
    }

    /**
     * odstraneni ALLOW pristupu
     *
     * @param string role nazev role
     * @param string resource nazev zdroje
     * @param string privilege nazev prava
     * @return this
     */
    public function removeAllow($role = self::ALL, $resource = self::ALL, $privilege = self::ALL) {
      if (isset($this->rules[$role][$resource][$privilege]) &&
          $this->rules[$role][$resource][$privilege] == self::ALLOW) {
        unset($this->rules[$role][$resource][$privilege]);
      }
      return $this;
    }

    /**
     * odstraneni DENY pristupu
     *
     * @param string role nazev role
     * @param string resource nazev zdroje
     * @param string privilege nazev prava
     * @return this
     */
    public function removeDeny($role = self::ALL, $resource = self::ALL, $privilege = self::ALL) {
      if (isset($this->rules[$role][$resource][$privilege]) &&
          $this->rules[$role][$resource][$privilege] == self::DENY) {
        unset($this->rules[$role][$resource][$privilege]);
      }
      return $this;
    }

    /**
     * existuje toto pravidlo?
     *
     * @param string role nazev role
     * @param string resource nazev zdroje
     * @param string privilege nazev opravneni
     * @return bool true pokud pravidlo existuje
     */
    public function hasRules($role = self::ALL, $resource = self::ALL, $privilege = self::ALL) {
      return (isset($this->rules[$role][$resource][$privilege]));
    }

    /**
     * nacteni pole pravidel
     *
     * @return array pole pravidel
     */
    public function getRules() {
      return $this->rules;
    }

    /**
     * nastaveni pole pravidel
     *
     * @param array pole pravidel
     * @return this
     */
    public function setRules($rules) {
      $this->rules = $rules;
      return $this;
    }

    /**
     * smazani vsech pravidel
     *
     * @return this
     */
    public function removeAllRules() {
      $this->rules = array();
      return $this;
    }

    /**
     * vnitrni univerzalni vkladani pravidel do pole
     *
     * @param string role nazev role
     * @param string|array resources nazev zdroje
     * @param string|array privileges nazev prava
     * @param string type typ opravneni
     * @return this
     */
    private function setRule($role, $resources, $privileges, $type) {
      if (!$this->hasRole($role) && $role != self::ALL) { throw new ExceptionAuthorizator($role.' does not exist!'); }
      // pokud jsou resources pole
      if (is_array($resources)) {
        foreach ($resources as $resource) {
          if (!$this->hasResource($resource) && $resource != self::ALL) { throw new ExceptionAuthorizator($resource.' does not exist!'); }
          //pokud jsou resources && privileges pole
          if (is_array($privileges)) {
            foreach ($privileges as $privilege) {
              $this->rules[$role][$resource][$privilege] = $type;
            }
          } else {
            // pokud je resources pole
            $this->rules[$role][$resource][$privileges] = $type;
          }
        }
      } else
      // pokud jsou privilegia array
      if (is_array($privileges)) {
        if (!$this->hasResource($resources) && $resources != self::ALL) { throw new ExceptionAuthorizator($resources.' does not exist!'); }
        foreach ($privileges as $privilege) {
          $this->rules[$role][$resources][$privilege] = $type;
        }
      } else {
        if (!$this->hasResource($resources) && $resources != self::ALL) { throw new ExceptionAuthorizator($resources.' does not exist!'); }
        // prime vkladani (prima adresa)
        $this->rules[$role][$resources][$privileges] = $type;
      }
      return $this;
    }

    /**
     * nacitani ulozeneho ACL ze souboru
     *
     * @param string|null path cesta pro soubor
     * @return this
     */
    public function loadFromFile($path = null) {
      // pokud je zadany path
      if (!is_null($path)) {
        if (file_exists($path)) {
          $out = file_get_contents($path);
          //rozdeleni nacteniho pole
          $jsonout = json_decode($out, true);
          $this->roles = $jsonout['roles'];
          $this->resources = $jsonout['resources'];
          $this->rules = $jsonout['rules'];

          $this->loadFromFile = true; // oznamenu ze bylo nacteno ze souboru
        }
      }
      return $this;
    }

    /**
     * je ACL nacteno ze souboru?
     *
     * @return bool true pokud nacteno ze souboru
     */
    public function isLoadFromFile() {
      return $this->loadFromFile;
    }

    /**
     * vnitrni soucet poli pro aplikaci dedeni pro slucovani predku
     *
     * @param array source zdrojove pole
     * @param array parents pole rodicu ktere se potrebude pro-iterovat
     * @return sectene pole
     */
    private function getMergeArray($source, $parents) {
      $result = array();
      foreach ($parents as $row) {
        if (isset($source[$row])) {
          $result += $source[$row];
        }
      }
      return $result;
    }

    /**
     * konecne potvrzeni pravidel, aplikace dedeni, ukladani do souboru
     * -uklada pokud se ACL generuje, neuklada kdyz se nacita ze souboru!
     *
     * @param string|null path cesta pro soubor
     * @return this
     */
    public function commitRules($path = null) {
      // pokud se nenacita ze souboru, provadi zavislosti
      if (!$this->loadFromFile) {
        // aplikace dedeni na role & zdroje
        foreach ($this->roles as $k_role => $v_role) {
          // nacitani rodice role
          $role_parents = $this->getRoleParents($k_role);
          if (!is_null($role_parents)) {  // pokud existuji nejaci rodice
            if (!isset($this->rules[$k_role])) {  // vytvareni nezivych pro role; brainnnn, chrrr :D
              $this->rules[$k_role] = array();
            }
            // secteni pole pravide a pravidel rodicu
            $this->rules[$k_role] = array_merge_recursive($this->rules[$k_role], $this->getMergeArray($this->rules, $role_parents));
          }

          // aplikace dedeni na zdroje
          foreach ($this->resources as $k_res => $v_res) {
            // nacitani rodice zdroje
            $resource_parents = $this->getResourceParents($k_res);
            if (!is_null($resource_parents)) {  // pokud existuji nejaci rodice
              if (!isset($this->rules[$k_role])) {  // vytvareni nezivych pro zdroje
                $this->rules[$k_role] = array();
              }
              // pokud index neexistuje vytvori jej, jinak secte pole
              if (!isset($this->rules[$k_role][$k_res])) {
                $this->rules[$k_role][$k_res] = $this->getMergeArray($this->rules[$k_role], $resource_parents);
              } else {
                $this->rules[$k_role][$k_res] += $this->getMergeArray($this->rules[$k_role], $resource_parents);
              }
            }
          }
        }

        // musi ukladat jen vygenerovane pole
        if (!is_null($path)) {
          //~ unlink($path);
          $out = array(
                        'roles' => $this->roles,
                        'resources' => $this->resources,
                        'rules' => $this->rules,
                        );
          // ulozeni do souboru
          file_put_contents($path, json_encode($out));
        }
      }
      return $this;
    }

    /**
     * je dovoleno pristupovat podle zadaneho opravneni?
     * -hlavni implementacni metoda
     *
     * @param string role nazev role
     * @param string resource nazev zdroje
     * @param string privilege nazev prava
     * @return bool true pokud ma opravneni
     */
    public function isAllowed($role = self::ALL, $resource = self::ALL, $privilege = self::ALL) {
      // pokud je presna adresa
      if (isset($this->rules[$role][$resource][$privilege])) {  // 000
        return ($this->rules[$role][$resource][$privilege] == self::ALLOW);
      } else

      // pokud jsou privilegia ALL
      if (isset($this->rules[$role][$resource][self::ALL])) { // 001
        return ($this->rules[$role][$resource][self::ALL] == self::ALLOW);
      } else

      // pokud jsou zdroje ALL
      if (isset($this->rules[$role][self::ALL][$privilege])) {  // 010
        return ($this->rules[$role][self::ALL][$privilege] == self::ALLOW);
      } else

      // pokud jsou zdroje a privilegia ALL
      if (isset($this->rules[$role][self::ALL][self::ALL])) { // 011
        return ($this->rules[$role][self::ALL][self::ALL] == self::ALLOW);
      } else

      // pokud jsou role ALL
      if (isset($this->rules[self::ALL][$resource][$privilege])) {  // 100
        return ($this->rules[self::ALL][$resource][$privilege] == self::ALLOW);
      } else

      // pokud jsou role a privilegia ALL
      if (isset($this->rules[self::ALL][$resource][self::ALL])) {  // 101
        return ($this->rules[self::ALL][$resource][self::ALL] == self::ALLOW);
      } else

      // pokud jsou role a zdroje ALL
      if (isset($this->rules[self::ALL][self::ALL][$privilege])) {  // 110
        return ($this->rules[self::ALL][self::ALL][$privilege] == self::ALLOW);
      } else

      // pokud jsou uzivatlele, zdroje a privilegia ALL
      if (isset($this->rules[self::ALL][self::ALL][self::ALL])) { // 111
        return ($this->rules[self::ALL][self::ALL][self::ALL] == self::ALLOW);
      }

      return false;
    }
  }
