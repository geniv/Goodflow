<?php
/*
 * user.php
 *
 * Copyright 2012 geniv <geniv.radek@gmail.com>
 *
 * inspirace auth & ACL v nette
 */

  namespace classes;

  use classes\IAuthenticator,
      Exception;

  /**
   *
   * rozhranni pro identifikai uziatele
   *
   */
  interface IIdentity {
    //const VERSION = 1.02;
    public function getId();  //vraceni id uzivatele
    public function getRoles(); //vraceni roli uzivatele
  }

  /**
   *
   * implicitni implementace tridy Identity, kterou vytvari Authenticator
   *
   */
  class Identity implements IIdentity {
    const VERSION = 1.10;

    private $id, $roles, $data;

    /**
     * construct Identity
     *
     * @param id any id user
     * @param roles array roles
     * @param data any data user
     */
    public function __construct($id, $roles = array(), $data = null) {
      $this->setId($id);
      $this->setRoles($roles);
      $this->data = $data;
    }

    /**
     * return id user
     *
     * @return id user
     */
    public function getId() {
      return $this->id;
    }

    /**
     * set new user id
     *
     * @param id user id
     * @return this
     */
    public function setId($id) {
      $this->id = (is_numeric($id) ? 1 * $id : $id);
      return $this;
    }

    /**
     * return array roles
     *
     * @return array roles
     */
    public function getRoles() {
      return $this->roles;
    }

    /**
     * set new roles
     *
     * @param roles array new roles
     * @return this
     */
    public function setRoles(array $roles) {
      $this->roles = $roles;
      return $this;
    }

    /**
     * return user data
     *
     * @return user data
     */
    public function getData($index = null) {
      return ($index ? $this->data[$index] : $this->data);
    }
  }

  /**
   *
   * hlavni trida uzivatelu
   *
   */
  class User {
    const VERSION = 1.36;

    private $storage;
    private $authenticator; //overovani uzivatele
    private $authorizator;  //overovani prav prihlaseneho uzivatele

    private $guestRole = 'guest'; //host, default role
    private $authenticatedRole = 'authenticated'; //overeny uzivatel

    //callback:
    private $callbackLoggedIn, $callbackLoggedOut;

    /**
     * main construct
     *
     * @param storage user storage instance with [session]
     */
    public function __construct(IUserStorage $storage = null) {
      $this->storage = $storage;
    }

    /**
     * set user storage for storage user state
     *
     * @param storage
     * @return this
     */
    public function setStorage(IUserStorage $storage) {
      $this->storage = $storage;
      return $this;
    }

    /**
     * return user storage instance
     *
     * @return usor storage
     */
    public function getStorage() {
      return $this->storage;
    }
//TEST this method!!!!!!
    /**
     * dumyslne hashovani hesla na zaklade loginu a hesla
     *
     * @param login vstupni login
     * @param pass vstupni heslo
     * @return clever hash
     */
    public static function getCleverHash($login, $pass) {
      $p = $pass;
      for ($i = 0; $i < strlen($login); $i++) {
        $p = hash('sha256', $p);
      }
      $p .= md5($login);
      return hash('ripemd320', $p);
    }

    /**
     * create string for verification true owner
     *
     * @return uniq sting
     */
    private function getRemoteIdentity() {
      return ($_SERVER['REMOTE_ADDR'].'::'.$_SERVER['HTTP_USER_AGENT']);  //$_SERVER['REMOTE_PORT']
    }

    /**
     * set callback for login
     *
     * @param callback callback function
     * @return this
     */
    public function setCallbackLoggedIn($callback) {
      $this->callbackLoggedIn = $callback;
      return $this;
    }

    /**
     * set callback for logout
     *
     * @param callback callback function
     * @return this
     */
    public function setCallbackLoggedOut($callback) {
      $this->callbackLoggedOut = $callback;
      return $this;
    }

    /**
     * login user
     *
     * @param id IIdentity or username user
     * @param password password, if id is not IIdentity
     * @return this
     */
    public function login($id, $password = null) {
      if (!$id instanceof IIdentity) {
        $id = $this->authenticator->authenticate(array($id, $password));
      }
//FIXME test na tuto situaci kdy je prazdy obsah v authenticate!!!!
//~ var_dump($id);
      if (!is_null($id)) {  // login nebo instance identity nesmi byt null!
        $this->storage->setIdentity($id); //ulozi se identita
        $this->storage->setAuthenticated(true); //nastavi se prihlaseni
        $this->storage->setRemoteInfo($this->getRemoteIdentity());  //ulozeni remote identifikace

        if ($this->callbackLoggedIn) {  //obsluha callback prihlaseni
          call_user_func($this->callbackLoggedIn, $this);
        }
      }
      return $this;
    }

    /**
     * logout user
     *
     * @param clearIdentity if true then clean identity from storage, default false
     * @return this
     */
    public function logout($clearIdentity = false) {
      if ($this->isLoggedIn()) {  //pokud je prihlasen
        if ($this->callbackLoggedOut) { //obsluha callbyck odhlaseni
          call_user_func($this->callbackLoggedOut, $this);
        }

        $this->storage->setAuthenticated(false);  //nastavi odhlaseni
      }

      if ($clearIdentity) { //pokud je potreba vymazat identitu
        $this->storage->setIdentity(null);
      }
      return $this;
    }

    /**
     * user is logger in?
     *
     * @param strict if true then strict check session (ip + agent)
     * @return true if logged in
     */
    public function isLoggedIn($strict = false) {
      $authen = $this->storage->isAuthenticated();
      return ($strict ? $authen && ($this->storage->getRemoteInfo() === $this->getRemoteIdentity()) : $authen);
    }

    /**
     * return identity from storage
     *
     * @return instance of identity
     */
    public function getIdentity() {
      return $this->storage->getIdentity();
    }

    /**
     * user id from instance identity
     *
     * @return user id
     */
    public function getId() {
      $idn = $this->storage->getIdentity();
      return ($idn ? $idn->getId() : null);
    }

    /**
     * get authenticator
     *
     * @return authenticator
     */
    public function getAuthenticator() {
      return $this->authenticator;
    }

    /**
     * set authenticator for authenticate valid user
     *
     * @param handler IAuthenticator instance
     * @return this
     */
    public function setAuthenticator(IAuthenticator $handler) {
      $this->authenticator = $handler;
      return $this;
    }
//TODO prilis netestovano
    /**
     * set expiration for user
     *
     * @param time time to auto logout user
     * @param whenBrowserIsClosed if true then logout when browser close
     * @param clearIdentity if true then clear identity
     * @return this
     */
    public function setExpiration($time, $whenBrowserIsClosed = true, $clearIdentity = false) {
      $flags = ($whenBrowserIsClosed ? IUserStorage::BROWSER_CLOSED : 0) | ($clearIdentity ? IUserStorage::CLEAR_IDENTITY : 0);
      $this->storage->setExpiration($time, $flags);
      return $this;
    }
//TODO prilis netestovano
    /**
     * get state logout
     *
     * @return state
     */
    public function getLogoutReason() {
      return $this->storage->getLogoutReason();
    }

    //----------------------------------------------------------------------
    //overovani jestli ma prihlaseny uzivatel dostatek prav

    /**
     * return user roles in identity
     * eg: admin, member, guest
     *
     * @return array roles
     */
    public function getRoles() {
      if (!$this->isLoggedIn()) { //pokud je neprihlasen jde o hosta
        return array($this->guestRole); //virtualni role host
      }
      $idt = $this->getIdentity();  //nacteni identity
      return ($idt && $idt->getRoles() ? $idt->getRoles() : array($this->authenticatedRole));
    }

    /**
     * user is in role?
     *
     * @param role user role
     * @return true if is in role
     */
    public function isInRole($role) {
      return in_array($role, $this->getRoles());
    }

    /**
     * user is allowed?
     * cooperate with authorizator and ACL, for each user role
     *
     * @param resource acl resource (commnet, pool...)
     * @param privilege alc privilege (add, view, vote...)
     * @return true if is allow
     */
    public function isAllowed($resource = IAuthorizator::ALL, $privilege = IAuthorizator::ALL) {
      $acl = $this->authorizator;
      //projde kazdou roli
      foreach ($this->getRoles() as $role) {
        //zepta se permission jesli ma pristup
        if ($acl->isAllowed($role, $resource, $privilege)) {
          return true;
        }
      }
      return false;
    }

    /**
     * return instance of ACL authorizator
     *
     * @return instance ACL
     */
    public function getAuthorizator() {
      return $this->authorizator;
    }

    /**
     * set new instance of ACL authorizator
     *
     * @param handler instance of IAuthorizator (ACL)
     * @return this
     */
    public function setAuthorizator(IAuthorizator $handler) {
      $this->authorizator = $handler;
      return $this;
    }
  }

  /**
   *
   * rozhranni pro Authorizator (rozpoznani prav prihlaseneho uzivatele), ACL (access control list)
   *
   */
  interface IAuthorizator {
    //const VERSION = 1.02;
    const ALL = null;
    const ALLOW = true;
    const DENY = false;
    public function isAllowed($role, $resource, $privilege);
  }

  /**
   *
   * Access control list (ACL) functionality and privileges management.
   *
   */
  class Permission implements IAuthorizator {
    const VERSION = 1.86;

    private $roles = array(); //array roles
    private $resources = array(); //array resources

    private $rules = array(); //array rules

    /**
     * Adds a Role to the list. The most recently added parent
     * takes precedence over parents that were previously added.
     *
     * @param  string
     * @param  string|array
     * @throws ExceptionPermission
     * @return this
     */
    public function addRole($role, $parents = null) {
      //overeni existence role
      if (!isset($this->roles[$role])) {
        //pole predku
        $this->roles[$role] = array('parents' => array());
        //pokud je parents ne-null
        if (!is_null($parents)) {
          if (!is_array($parents)) {
            //pokud neni parents pole
            if (isset($this->roles[$parents])) {  //overeni existence
              $this->roles[$role]['parents'] = array_merge($this->roles[$role]['parents'], $this->roles[$parents]['parents']);
              $this->roles[$role]['parents'][] = $parents;
              //$this->roles[$role]['parents'] = array_unique($this->roles[$role]['parents']);
            } else {
              throw new ExceptionPermission('Role '.$role.' not exists in the list.');
            }
          } else {
            //pokud je parents pole
            $parents_callback = function($val, $key, $data) {
              if (isset($data['roles'][$val])) {  //overeni existence
                $data['res'] = array_merge($data['res'], $data['roles'][$val]['parents']);
                $data['res'][] = $val;
                //$data['res'] = array_unique($data['res']);
              } else {
                throw new ExceptionPermission('Role '.$val.' not exists in the list.');
              }
            };
            array_walk($parents, $parents_callback, array('roles' => $this->roles, 'res' => &$this->roles[$role]['parents']));
          }
        }
      } else {
        throw new ExceptionPermission('Role '.$role.' already exists in the list.');
      }
      return $this;
    }

    /**
     * Returns TRUE if the Role exists in the list.
     *
     * @param  string
     * @return bool
     */
    public function hasRole($role) {
      return (isset($this->roles[$role]));
    }

    /**
     * Returns all Roles.
     *
     * @return array
     */
    public function getRoles() {
      return array_keys($this->roles);
    }

    /**
     * Returns existing Role's parents ordered by ascending priority.
     *
     * @param  string
     * @return array|null
     */
    public function getRoleParents($role) {
      return (isset($this->roles[$role]['parents']) ? array_unique($this->roles[$role]['parents']) : null);
    }

    /**
     * Returns TRUE if $role inherits from $inherit.
     *
     * @param  string
     * @param  string
     * @return bool
     */
    public function roleInheritsFrom($role, $inherit) {
      return (isset($this->roles[$role]['parents']) && in_array($inherit, $this->roles[$role]['parents']));
    }

    /**
     * Removes the Role from the list.
     *
     * @param  string
     * @return this
     */
    public function removeRole($role) {
      unset($this->roles[$role]);
      return $this;
    }

    /**
     * Removes all Roles from the list.
     *
     * @return this
     */
    public function removeAllRoles() {
      $this->roles = array();
      return $this;
    }

    /**
     * Adds a Resource having an identifier unique to the list.
     *
     * @param  string
     * @param  string
     * @throws ExceptionPermission
     * @return this
     */
    public function addResource($resource, $parents = null) {
      //overeni existence resource
      if (!isset($this->resources[$resource])) {
        //pole predku
        $this->resources[$resource] = array('parents' => array());
        //pokud je parents ne-null
        if (!is_null($parents)) {
          if (!is_array($parents)) {
            //pokud neni parents pole
            if (isset($this->resources[$parents])) {  //overeni existence
              $this->resources[$resource]['parents'] = array_merge($this->resources[$resource]['parents'], $this->resources[$parents]['parents']);
              $this->resources[$resource]['parents'][] = $parents;
              //$this->resources[$resource]['parents'] = array_unique($this->resources[$resource]['parents']);
            } else {
              throw new ExceptionPermission('Resource '.$resource.' not exists in the list.');
            }
          } else {
            //pokud je parents pole
            $parents_callback = function($val, $key, $data) {
              if (isset($data['resources'][$val])) {  //overeni existence
                //$data['res'] += $data['resources'][$val]['parents'];
                $data['res'] = array_merge($data['res'], $data['resources'][$val]['parents']);
                $data['res'][] = $val;
                //$data['res'] = array_unique($data['res']);
              } else {
                throw new ExceptionPermission('Resource '.$val.' not exists in the list.');
              }
            };
            array_walk($parents, $parents_callback, array('resources' => $this->resources, 'res' => &$this->resources[$resource]['parents']));
          }
        }
      } else {
        throw new ExceptionPermission('Resource '.$resource.' already exists in the list.');
      }
      return $this;
    }

    /**
     * Returns TRUE if the Resource exists in the list.
     *
     * @param  string
     * @return bool
     */
    public function hasResource($resource) {
      return (isset($this->resources[$resource]));
    }

    /**
     * Returns all Resources.
     *
     * @return array
     */
    public function getResources() {
      return array_keys($this->resources);
    }

    /**
     * Returns existing Resource's parents ordered by ascending priority.
     *
     * @param  string
     * @return array|null
     */
    public function getResourceParents($resource) {
      return (isset($this->resources[$resource]['parents']) ? array_unique($this->resources[$resource]['parents']) : null);
    }

    /**
     * Returns TRUE if $resource inherits from $inherit.
     *
     * @param  string
     * @param  string
     * @param  bool
     * @return bool
     */
    public function resourceInheritsFrom($resource, $inherit) {
      return in_array($inherit, $this->resources[$resource]['parents']);
    }

    /**
     * Removes a Resource and all of its children.
     *
     * @param  string
     * @return this
     */
    public function removeResource($resource) {
      unset($this->resources[$resource]);
      return $this;
    }

    /**
     * Removes all Resources.
     *
     * @return this
     */
    public function removeAllResources() {
      $this->resources = array();
      return $this;
    }

    /**
     * Allows one or more Roles access to [certain $privileges upon] the specified Resource(s).
     *
     * @param  string|array|Permission::ALL  roles
     * @param  string|array|Permission::ALL  resources
     * @param  string|array|Permission::ALL  privileges
     * @return this
     */
    public function allow($role = self::ALL, $resources = self::ALL, $privileges = self::ALL) {
      $this->setRule($role, $resources, $privileges, self::ALLOW);
      return $this;
    }

    /**
     * Denies one or more Roles access to [certain $privileges upon] the specified Resource(s).
     *
     * @param  string|array|Permission::ALL  roles
     * @param  string|array|Permission::ALL  resources
     * @param  string|array|Permission::ALL  privileges
     * @return this
     */
    public function deny($role = self::ALL, $resources = self::ALL, $privileges = self::ALL) {
      $this->setRule($role, $resources, $privileges, self::DENY);
      return $this;
    }

    /**
     * Removes "allow" permissions from the list in the context of the given Roles, Resources, and privileges.
     *
     * @param  string|array|Permission::ALL  roles
     * @param  string|array|Permission::ALL  resources
     * @param  string|array|Permission::ALL  privileges
     * @return this
     */
    public function removeAllow($role = self::ALL, $resource = self::ALL, $privilege = self::ALL) {
      //TODO pokud bude potreba rozsit o podporu odtranovani celych poli
      if (isset($this->rules[$role][$resource][$privilege]) && $this->rules[$role][$resource][$privilege] == self::ALLOW) {
        unset($this->rules[$role][$resource][$privilege]);
      }
      return $this;
    }

    /**
     * Removes "deny" restrictions from the list in the context of the given Roles, Resources, and privileges.
     *
     * @param  string|array|Permission::ALL  roles
     * @param  string|array|Permission::ALL  resources
     * @param  string|array|Permission::ALL  privileges
     * @return this
     */
    public function removeDeny($role = self::ALL, $resource = self::ALL, $privilege = self::ALL) {
      if (isset($this->rules[$role][$resource][$privilege]) && $this->rules[$role][$resource][$privilege] == self::DENY) {
        unset($this->rules[$role][$resource][$privilege]);
      }
      return $this;
    }

    /**
     * Performs operations on Access Control List rules.
     *
     * @param  string|array|Permission::ALL  roles
     * @param  string|array|Permission::ALL  resources
     * @param  string|array|Permission::ALL  privileges
     * @param  bool  type (ALLOW|DENY)
     * @return this
     */
    private function setRule($role, $resources, $privileges, $type) {
      if (is_array($resources)) {
        //pokud je resources pole
        foreach ($resources as $resource) {
          if (is_array($privileges)) {
            //pokud je privileges pole
            foreach ($privileges as $privilege) {
              $this->rules[$role][$resource][$privilege] = $type;
            }
          } else {
            //pokud je privileges text
            $this->rules[$role][$resource][$privileges] = $type;
          }
        }
      } else {
        //pokud je resources text
        if (is_array($privileges)) {
          //pokud je privileges pole
          foreach ($privileges as $privilege) {
            $this->rules[$role][$resources][$privilege] = $type;
          }
        } else {
          //pokud je privileges text
          $this->rules[$role][$resources][$privileges] = $type;
        }
      }
      return $this;
    }

    /**
     * Removes all Rules.
     *
     * @return this
     */
    public function removeAllRules() {
      $this->rules = array();
      return $this;
    }

    /**
     * Returns all Rules.
     *
     * @return array
     */
    public function getRules() {
      return $this->rules;
    }

    /**
     * Returns TRUE if and only if the Role has access to [certain $privileges upon] the Resource.
     * vlastnost uzivatele(moderator,spravce), logicky prvek(polozka,anketa), konkretni cinnost(add,edit,del,hlasovat)-->true/false
     *
     * This method checks Role inheritance using a depth-first traversal of the Role list.
     *
     * @param  string|Permission::ALL|IRole  role
     * @param  string|Permission::ALL|IResource  resource
     * @param  string|Permission::ALL  privilege
     * @return bool
     */
    public function isAllowed($role = self::ALL, $resource = self::ALL, $privilege = self::ALL) {
      //~ var_dump('rol: '.$role.'; res: '.$resource.'; pri: '.$privilege);

      if (isset($this->rules[$role][$resource][$privilege])) {  //000, direct
        return $this->rules[$role][$resource][$privilege];
      } else

      if (isset($this->rules[$role][$resource][self::ALL])) { //001
        return $this->rules[$role][$resource][self::ALL];
      } else

      if (isset($this->rules[$role][self::ALL][$privilege])) {  //010
        return $this->rules[$role][self::ALL][$privilege];
      } else

      if (isset($this->rules[$role][self::ALL][self::ALL])) { //011
        return $this->rules[$role][self::ALL][self::ALL];
      } else

      if (isset($this->rules[self::ALL][$resource][$privilege])) {  //100
        return $this->rules[self::ALL][$resource][$privilege];
      } else

      if (isset($this->rules[self::ALL][$resource][self::ALL])) {  //101
        return $this->rules[self::ALL][$resource][self::ALL];
      } else

      if (isset($this->rules[self::ALL][self::ALL][$privilege])) {  //110
        return $this->rules[self::ALL][self::ALL][$privilege];
      } else

      if (isset($this->rules[self::ALL][self::ALL][self::ALL])) {  //111
        return $this->rules[self::ALL][self::ALL][self::ALL];
      } else

      if (!empty($this->roles[$role]['parents'])) { //hleda roli v predcich roli
        $r = false;
        foreach ($this->roles[$role]['parents'] as $_role) {
          $r = $this->isAllowed($_role, $resource, $privilege);
          if ($r) { break; }
        }
        return $r;
      } else

      if (!empty($this->resources[$resource]['parents'])) { //hleda resource v predcich resource
        $r = false;
        foreach ($this->resources[$resource]['parents'] as $_res) {
          $r = $this->isAllowed($role, $_res, $privilege);
          if ($r) { break; }
        }
        return $r;
      }

      return false;
    }
  }

  class ExceptionPermission extends Exception {}

?>
