<?php
/**
 *      ﻿KubisCMS - 
 *      
 *      <popis>
 *      
 *      @author Jan "DJ KUBIS" Kubka | Programmer / Team leader <dj-kubis@reversity.org>
 *      @version 0.6.0
 *      @category KubisCMS
 *      @package /include/classes
 *      @subpackage /core.class.php
 *      @copyright Copyright (C) 2004 - 2011 Reversity Studios - Reversity WebStudio
 *      @link http://dj-kubis.reversity.org Reversity KubisCMS
 *      
 *      +-------------------------------------------------------+
 *      | Reversity Studios - Reversity WebStudio KubisCMS 
 *      | Copyright (C) 2004 - 2011 Reversity Studios - Reversity WebStudio
 *      | http://www.reversity.org | http://webstudio.reversity.org
 *      | Contact info@reversity.org | webstudio@reversity.org
 *      +--------------------------------------------------------+
 *      | Filename: core.class.php
 *      | Version: 0.6.0
 *      | Author: Jan "DJ KUBIS" Kubka | Programmer / Team leader
 *      | Author E-mail: dj-kubis@reversity.org
 *      | Created: 2011-02-19
 *      +--------------------------------------------------------+
 *      | This program is released as Licensed software under the
 *      | Reversity Studios - Reversity WebStudio license. You can´t redistribute it and/or
 *      | modify it under the terms of this license which you
 *      | can read by viewing the included license.txt or online
 *      | at http://webstudio.reversity.org/license/. Removal of this
 *      | copyright header is strictly prohibited without
 *      | written permission from the original author(s).
 *      +--------------------------------------------------------+
 *      | Redistribution and use in source and binary forms, with or without
 *      | modification, are permitted provided that the following conditions are
 *      | met:
 *      +--------------------------------------------------------+
 *      | * Redistributions of source code must retain the above copyright
 *      |   notice, this list of conditions and the following disclaimer.
 *      | * Redistributions in binary form must reproduce the above
 *      |   copyright notice, this list of conditions and the following disclaimer
 *      |   in the documentation and/or other materials provided with the
 *      |   distribution.
 *      | * Neither the name of the Reversity Studios - Reversity WebStudio nor the names of its
 *      |   contributors may be used to endorse or promote products derived from
 *      |   this software without specific prior written permission.
 *      +--------------------------------------------------------+
 *      | THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 *      | "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 *      | LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 *      | A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 *      | OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 *      | SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 *      | LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 *      | DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 *      | THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 *      | (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 *      | OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *      
 *      +--------------------------------------------------------+
 */



defined('C_EXEC') OR die('Access denied - No direct access!');

class Core {

  private $_arrConfig;

  private $_objDb;




  public function __construct() {

    session_start();

    set_error_handler(array($this, "errorHandler"));

    if ( C_ERROR === true ) {

      set_exception_handler(array($this, "exceptionHandler"));

      error_reporting(E_ALL);

    }
    elseif ( C_ERROR === false ) {

      error_reporting(0);

    }

    /* - - - */

    $this->loadGlobalConfiguration();

    $this->loadGlobalLanguage();

    /* - - - */

    date_default_timezone_set($this->_arrConfig['default_timezone']);

  }


  protected function getInstance() {

    $objConfig = C_Object :: getInstance();

    $this->_arrConfig = $objConfig->get('configuration');

    /* - - - */

    $objDatabase = C_Object :: getInstance();

    $this->_objDb = $objDatabase->get('database');

  }


  /*
   * Core :: connectDatabase()
   *
   * Die Datenbankverbindung wird per MySQLi-Klasse hergestellt und das Datenbank-Objekt wird global in die Registry abgelegt.
   *
  */
  private function connectDatabase() {

    $this->_objDb = new MySQLi( $this->_arrConfig['db_host'], $this->_arrConfig['db_user'], $this->_arrConfig['db_password'], $this->_arrConfig['db_database'] );

    if ( !$this->_objDb || mysqli_connect_errno() ) {

      throw new Exception( mysqli_connect_error() );

    }

    define('DB_PREFIX', $this->_arrConfig['db_prefix']);

    $this->_objDb->set_charset("UTF8");

    /* - - - */

    $objDatabase = C_Object :: getInstance();

    $objDatabase->set($this->_objDb, 'database');

  }


  /*
   * Core :: closeDatabase()
   *
   * Die offene Datenbankverbindung wird beendet.
   *
  */
  private function closeDatabase() {

    if ( is_object($this->_objDb) ) {

      $this->_objDb->close();

    }

  }


  /*
   * Core :: XSSProtect() 
   *
   * Diese Methode reinigt Benutzereingaben von gefährlichem Inhalt. Sie muss bei jeglichen Input angewendet werden!
   *
   * @param $strInput : die ungefilterte Daten
   * @param $strictMode : den strikten Modus aktivieren/deaktivieren
   *
  */
  protected function XSSProtect( $strInput, $strictMode = true ) {

    if ( get_magic_quotes_gpc() ) {

      $strInput = stripslashes($strInput);

    }

    $strInput = htmlspecialchars($strInput, ENT_QUOTES);

    if ( $strictMode === true ) {

      $strInput = preg_match("~{modul:([^}]+)}~", $strInput) ? preg_replace("~{modul:([^}]+)}~", "", $strInput) : $strInput;
      $strInput = preg_match("~{snippet:([^}]+)}~", $strInput) ? preg_replace("~{snippet:([^}]+)}~", "", $strInput) : $strInput;

    }
 
    return trim($strInput);

  }


  /*
   * Core :: exceptionHandler()
   *
   * Der Exception-Handler zeigt Exceptions des Systems an.
   *
   * @param $messageException : die Exception
   *
  */
  public function exceptionHandler( $messageException ) {

    $exceptionMessage = sprintf("<strong>KubisCMS Error (Exception):</strong> %s (File: %s - Line: %s)\n", $messageException->getMessage(), $messageException->getFile(), $messageException->getLine());

    echo nl2br($exceptionMessage);

  }

  /*
   * Core :: errorHandler()
   *
   * Der Error-Handler gibt PHP-Laufzeitfehler aus.
   *
   * @param $errorNo : der Fehlertyp
   * @param $errorText : die Fehlermeldung
   * @param $errorFile : die Datei, in der der Fehler aufgetreten ist
   * @param $errorLine : die Zeile, in der der Fehler aufgetreten ist
   *
  */
  public function errorHandler( $errorNo, $errorText, $errorFile, $errorLine ) {

    switch( $errorNo ) {

      case E_USER_ERROR:

        $errorType = "Error";

      break;

    /* - - - */

      case E_RECOVERABLE_ERROR:

        $errorType = "Recoverable Error";

      break;

    /* - - - */

      case E_WARNING:
      case E_USER_WARNING:

        $errorType = "Warning";

      break;

    /* - - - */

      case E_NOTICE:
      case E_USER_NOTICE:

        $errorType = "Notice";

      break;

    /* - - - */

      case E_STRICT:

        $errorType = "Strict Notice";

      break;

    /* - - - */

      default:

        $errorType = "Unknown Error";

      break;

    }

    $errorLog = sprintf("%s | %s | KubisCMS Error (%s): %s (File: %s - Line: %s)\n", time(), $this->XSSProtect($_SERVER['REMOTE_ADDR']), $errorType, $errorText, $errorFile, $errorLine);

    /* - - - */

    $fileHandler = new C_File();

    $fileHandler->createFile("logs/error.log", C_File :: getContent("logs/error.log") . $errorLog);

    $fileHandler->closeFile();

    /* - - - */

    if ( C_ERROR === true ) {

      $errorMessage = sprintf("<strong>KubisCMS Error (%s):</strong> %s (File: %s - Line: %s)\n", $errorType, $errorText, $errorFile, $errorLine);

      echo nl2br($errorMessage);

    }

  }


  /*
   * Core :: doLog()
   *
   * Diese Methode loggt wichtige Aktivitäten des Systems mit, um diese später nachzuvollziehen zu können.
   *
   * @param $strMessage : die genaue Beschreibung der Aktivität
   * @param $strComponent : Komponente, von der die Aktivität ausgegangen ist
   *
  */
  protected function doLog( $strMessage, $strComponent ) {

    $currentUser = emptyStr($this->getUserID()) ? "?" : $this->getUserID();

    $eventLog = sprintf("%s | %s | %s | %s | %s" . "\n", time(), $currentUser, $this->XSSProtect($_SERVER['REMOTE_ADDR']), $strMessage, $strComponent);

    /* - - - */

    $fileHandler = new C_File();

    $fileHandler->createFile("logs/system.log", C_File :: getContent("logs/system.log") . $eventLog);

    $fileHandler->closeFile();

  }


  /*
   * Core :: loadGlobalConfiguration() 
   *
   * Das globale Konfigurations-Array wird geladen und integriert.
   *
  */
  private function loadGlobalConfiguration() {

    if ( fileExists("include/configuration_main.ini") ) {

      $arrConfig = parseConfigFile("include/configuration_main.ini");

      $this->_arrConfig = $arrConfig;

      /* - - - */

      $objConfig = C_Object :: getInstance();

      $objConfig->set($arrConfig, 'configuration');

    }
    else {

      throw new Exception('The configuration-file "include/configuration_main.ini" could not be loaded!');

    }

  }


  /*
   * Core :: loadGlobalLanguage()
   *
   * Das globale Sprach-Array wird geladen und integriert.
   *
  */
  private function loadGlobalLanguage() {

    if ( empty($_SESSION['systemLanguage']) AND (fileExists( "language/" . $this->_arrConfig['language'] . ".lang.ini" )) ) {

      $arrLanguage = parseConfigFile( "language/" . $this->_arrConfig['language'] . ".lang.ini" );

      $this->_arrLang = $arrLanguage;

      $objLanguage = C_Object :: getInstance();

      $objLanguage->set($arrLanguage, 'language');
      
      $_SESSION['systemLanguage'] = $this->_arrConfig['language'];

    }
    else if ( isset($_SESSION['systemLanguage']) AND fileExists( "language/" . $_SESSION['systemLanguage'] . ".lang.ini" ) ) {

      $arrLanguage = parseConfigFile( "language/" . $_SESSION['systemLanguage'] . ".lang.ini" );

      $this->_arrLang = $arrLanguage;

      $objLanguage = C_Object :: getInstance();

      $objLanguage->set($arrLanguage, 'language');

    }
    else {

      throw new Exception('The language-file "language/' . $this->_arrConfig['language'] . '.lang.ini" could not be loaded!');

    }

  }


  /*
   * Core :: isAdmin()
   *
   * Prüft, ob der aktuelle Benutzer angemeldet ist und seine Sitzung noch gültig ist.
   *
  */
  protected function isAdmin() {

    if ( isset($_SESSION['authentication']) && $_SESSION['authentication'] === true ) {

      $currentTime = time();
      $securityHash = sha1( $this->getUserID() . $this->XSSProtect($_SERVER['REMOTE_ADDR']) . $this->XSSProtect($_SERVER['HTTP_USER_AGENT']) );

      $sessionTimeout = $currentTime - ($this->_arrConfig['session_timeout'] * 60);

      /* - - - */

      $statement = $this->_objDb->prepare("SELECT `ID`
                                           FROM `" . DB_PREFIX . "sessions`
                                           WHERE `session` = ? AND `hash` = ? AND `time` > ?");

      if ( $statement ) {

        $sessionID = session_id();

        $statement->bind_param("ssi", $sessionID, $securityHash, $sessionTimeout);
        $statement->execute();
        $statement->bind_result($resultID);
        $statement->fetch();
        $statement->close();
          
        if ( $resultID ) {

          if ( $this->getUserStatus() == 1 ) {

            $statement = $this->_objDb->prepare("UPDATE `" . DB_PREFIX . "sessions`
                                                 SET `time` = ?
                                                 WHERE `ID` = ?");

            if ( !$statement ) {

              throw new Exception('A fatal error occurred while executing a database query! Please check up your database!');

            }

            $statement->bind_param("ii", $currentTime, $resultID);
            $statement->execute();
            $statement->close();

            return true;

          }
          else {

            $statement = $this->_objDb->prepare("DELETE FROM `" . DB_PREFIX . "sessions`
                                                 WHERE `ID` = ?");

            if ( !$statement ) {

              throw new Exception('A fatal error occurred while executing a database query! Please check up your database!');

            }

            $statement->bind_param("i", $resultID);
            $statement->execute();
            $statement->close();

            return false;

          }

        }

      }
      else {

        throw new Exception('A fatal error occurred while executing a database query! Please check up your database!');

      }

    }
    else {

      return false;

    }

  }


  /*
   * Core :: getValidPermission()
   *
   * Prüft, ob die aktuelle Zugangsstufe des angemeldeten Benutzers für die Komponente oder das Snippet ausreicht.
   *
   * @param $accessLevel : die Zugangsstufe der Komponente
   *
  */
  protected function getValidPermission( $accessLevel = 5 ) {

    $userRights = $this->getUserRights();

    return ($userRights < $accessLevel) || ($userRights == $accessLevel) ? true : false;

  }


  /*
   * Core :: getUserID()
   *
   * Gibt den ID des aktuell angemeldeten Benutzers zurück.
   *
  */
  protected function getUserID() {

    $statement = $this->_objDb->prepare("SELECT `user`
                                         FROM `" . DB_PREFIX . "sessions`
                                         WHERE `session` = ? AND `ip` = ?");

    if ( $statement ) {

      $sessionID = session_id();
      $currentIP = $this->XSSProtect($_SERVER['REMOTE_ADDR']);

      $statement->bind_param("ss", $sessionID, $currentIP);
      $statement->execute();
      $statement->bind_result($userID);
      $statement->fetch();
      $statement->close();

      return $userID ? $userID : false;
 
    }
    else {

      throw new Exception('A fatal error occurred while executing a database query! Please check up your database!');

    }

  }


  /*
   * Core :: getUserName()
   *
   * Gibt den Benutzernamen des aktuell angemeldeten Benutzers zurück.
   *
  */
  protected function getUserName() {

    $statement = $this->_objDb->prepare("SELECT `username`
                                         FROM `" . DB_PREFIX . "users`
                                         WHERE `ID` = ?");

    if ( $statement ) {

      $userID = $this->getUserID();

      $statement->bind_param("i", $userID);
      $statement->execute();
      $statement->bind_result($userName);
      $statement->fetch();
      $statement->close();

      return $userName ? $userName : false;
 
    }
    else {

      throw new Exception('A fatal error occurred while executing a database query! Please check up your database!');

    }

  }


  /*
   * Core :: getUserRights()
   *
   * Gibt die Zugangsstufe des angemeldeten Benutzers zurück.
   *
  */
  protected function getUserRights() {

    $statement = $this->_objDb->prepare("SELECT `access_level`
                                         FROM `" . DB_PREFIX . "users`
                                         WHERE `ID` = ?");

    if ( $statement ) {

      $userID = $this->getUserID();

      $statement->bind_param("i", $userID);
      $statement->execute();
      $statement->bind_result($userAccessLevel);
      $statement->fetch();
      $statement->close();

      return $userAccessLevel ? $userAccessLevel : false;
 
    }
    else {

      throw new Exception('A fatal error occurred while executing a database query! Please check up your database!');

    }

  }


  /*
   * Core :: getUserStatus()
   *
   * Gibt den Account-Status des angemeldeten Benutzers zurück.
   *
  */
  protected function getUserStatus() {

    $statement = $this->_objDb->prepare("SELECT `status`
                                         FROM `" . DB_PREFIX . "users`
                                         WHERE `ID` = ?");

    if ( $statement ) {

      $userID = $this->getUserID();

      $statement->bind_param("i", $userID);
      $statement->execute();
      $statement->bind_result($userStatus);
      $statement->fetch();
      $statement->close();

      return $userStatus ? $userStatus : false;
 
    }
    else {

      throw new Exception('A fatal error occurred while executing a database query! Please check up your database!');

    }

  }


  /*
   * Core :: getPageID()
   *
   * Gibt den ID der aktuellen Seite zurück (des Frontends).
   *
  */
  protected function getPageID() {

    if ( isset($_GET['id']) && !emptyStr($_GET['id']) ) {

      $pageID = is_numeric($_GET['id']) ? $this->XSSProtect($_GET['id']) : 1;

    }
    else {

      $pageID = 1;

    }

    return $pageID;

  }


  /*
   * Core :: snippetLoader()
   *
   * Lädt das vorgegebene Snippet und gibt ihren Rückgabewert zurück.
   *
   * @param $snippetName : der Name des Snippets
   * @param $snippetPath : der kompletter Pfad zur Snippet-Datei (snippet.php)
   *
  */
  protected function snippetLoader( $snippetName, $snippetPath = '' ) {

    if ( fileExists($snippetPath) && is_file($snippetPath) ) {

      include_once($snippetPath);

      $objSnippet = new $snippetName();

      return $objSnippet->getController();

    }

  }


  /*
   * Core :: componentLoader()
   *
   * Lädt eine definierte Komponente. Wenn keine Definition stattgefunden hat, wird die Komponente, die per GET-Parameter übertragen wurde, geladen.
   *
   * @param $componentName : der Name der definierten Komponente
   *
  */
  protected function componentLoader( $componentName = false ) {

    if ( $componentName !== false ) {

      header("Location: index.php?main=admin&id=" . $componentName);

    }
    else {

      if ( isset($_GET['id']) && !emptyStr($_GET['id']) ) {

        $componentName = $this->XSSProtect($_GET['id']);

        if ( fileExists("ccms/components/" . $componentName . "/component.php") ) {

          if ( fileExists("ccms/components/" . $componentName . "/package.xml") ) {

            $objXML = simplexml_load_file("ccms/components/" . $componentName . "/package.xml");

            /* - - - */

            $statement = $this->_objDb->prepare("SELECT `status`
                                                 FROM `" . DB_PREFIX . "extentions`
                                                 WHERE `name` = ? AND `package` = 'component'");

            if ( !$statement ) {

              throw new Exception('A fatal error occurred while executing a database query! Please check up your database!');

            }

            $statement->bind_param("s", $componentName);
            $statement->execute();
            $statement->bind_result($componentStatus);
            $statement->fetch();
            $statement->close();

            /* - - - */

            if ( $componentStatus && $componentStatus == 1 ) {

              include_once("ccms/components/" . $componentName . "/component.php");

              $objComponent = new $componentName();

              return $objComponent->getController();

            }
            else {

              $tpl = new C_Template( 'ccms/template/template_elements/notice_error.html' );

              $tpl->assign("message", sprintf($this->_arrLang['ERROR_COMPONENT_NOT_INSTALLED'], $componentName));
              $tpl->assign("link", "index.php?main=admin&amp;id=com_dashboard");
              $tpl->assign("link_title", $this->_arrLang['NEXT']);

              return $tpl->output();

            }

          }
          else {

            include_once("ccms/components/" . $componentName . "/component.php");

            $objComponent = new $componentName();

            return $objComponent->getController();

          }

        }
        else {

          $tpl = new C_Template( 'ccms/template/template_elements/notice_error.html' );

          $tpl->assign("message", sprintf($this->_arrLang['ERROR_LOAD_COMPONENT'], $componentName));
          $tpl->assign("link", "index.php?main=admin&amp;id=com_dashboard");
          $tpl->assign("link_title", $this->_arrLang['NEXT']);

          return $tpl->output();

        }

      }
      else {

        $this->componentLoader( 'com_login' );

      }
 
    }

  }


  /*
   * Core :: loadPageParams()
   *
   * Lädt die verschiedenen Informationen für die Platzhalter im Template (nur Frontend).
   *
   * @param $varOperation : der Platzhalter, der geladen werden soll
   *
  */
  private function loadPageParams( $varOperation ) {

    switch( $varOperation ) {

      case 'sitename':

        return $this->_arrConfig['sitename'];

      break;

    /* - - - */

      case 'title':

        $pageID = $this->getPageID();

        $statement = $this->_objDb->prepare("SELECT `title`
                                             FROM `" . DB_PREFIX . "content`
                                             WHERE `langID` = ? AND `language` = '".$_SESSION['systemLanguage']."'");

        if ( !$statement ) {

          throw new Exception('A fatal error occurred while executing a database query! Please check up your database!');

        }

        $statement->bind_param("i", $pageID);
        $statement->execute();
        $statement->bind_result($contentTitle);
        $statement->fetch();
        $statement->close();

        return $contentTitle ? $contentTitle : $this->_arrLang['ERROR_404_TITLE'];

      break;

    /* - - - */

      case 'category':

        $pageID = $this->getPageID();

        $statement = $this->_objDb->prepare("SELECT `category`.`title`
                                             FROM `" . DB_PREFIX . "content` AS `content`,
                                                  `" . DB_PREFIX . "categories` AS `category`
                                             WHERE `content`.`langID` = ? AND `content`.`category` = `category`.`ID`");

        if ( !$statement ) {

          throw new Exception('A fatal error occurred while executing a database query! Please check up your database!');

        }

        $statement->bind_param("i", $pageID);
        $statement->execute();
        $statement->bind_result($categoryTitle);
        $statement->fetch();
        $statement->close();

        return $categoryTitle ? $categoryTitle : "";

      break;

    /* - - - */

      case 'meta_tags':

        $pageID = $this->getPageID();

        $statement = $this->_objDb->prepare("SELECT `meta_robots`,
                                                    `meta_revisit_after`,
                                                    `meta_description`,
                                                    `meta_keywords`,
                                                    `meta_author`,
                                                    `meta_copyright`
                                             FROM `" . DB_PREFIX . "content`
                                             WHERE `langID` = ?");

        if ( !$statement ) {

          throw new Exception('A fatal error occurred while executing a database query! Please check up your database!');

        }

        $statement->bind_param("i", $pageID);
        $statement->execute();
        $statement->bind_result(  $metaRobots,
                                  $metaRevisitAfter,
                                  $metaDescription,
                                  $metaKeywords,
                                  $metaAuthor,
                                  $metaCopyright
                               );
        $statement->fetch();
        $statement->close();

        /* - - - */

        $metaTags = new C_Template( 'ccms/template/template_elements/html.meta.html' );

        $metaTags->assign("meta_encoding", "text/html; charset=UTF-8");
        $metaTags->assign("meta_robots", emptyStr($metaRobots) ? $this->_arrConfig['meta_robots'] : $metaRobots);
        $metaTags->assign("meta_revisit_after", emptyStr($metaRevisitAfter) ? $this->_arrConfig['meta_revisit_after'] : $metaRevisitAfter);
        $metaTags->assign("meta_description", emptyStr($metaDescription) ? $this->_arrConfig['meta_description'] : $metaDescription);
        $metaTags->assign("meta_keywords", emptyStr($metaKeywords) ? $this->_arrConfig['meta_keywords'] : $metaKeywords);
        $metaTags->assign("meta_author", emptyStr($metaAuthor) ? $this->_arrConfig['meta_author'] : $metaAuthor);
        $metaTags->assign("meta_copyright", emptyStr($metaCopyright) ? $this->_arrConfig['meta_copyright'] : $metaCopyright);
        $metaTags->assign("meta_generator", "Reversity KubisCMS - http://webstudio.reversity.org");

        return $metaTags->output();

      break;

    /* - - - */

      case 'content':

        $pageID = $this->getPageID();

        $statement = $this->_objDb->prepare("SELECT `langID`,
                                                    `content`
                                             FROM `" . DB_PREFIX . "content`
                                             WHERE `langID` = ? AND `language` = '".$_SESSION['systemLanguage']."'");

        if ( !$statement ) {

          throw new Exception('A fatal error occurred while executing a database query! Please check up your database!');

        }

        $statement->bind_param("i", $pageID);
        $statement->execute();
        $statement->bind_result($contentID, $contentText);
        $statement->fetch();
        $statement->close();

        if ( $contentID ) {

          $statement = $this->_objDb->prepare("UPDATE `" . DB_PREFIX . "content`
                                               SET `views` = `views` + 1
                                               WHERE `ID` = ?");

          if ( !$statement ) {

            throw new Exception('A fatal error occurred while executing a database query! Please check up your database!');

          }

          $statement->bind_param("i", $contentID);
          $statement->execute();
          $statement->close();

          /* - - - */

          $statement = $this->_objDb->prepare("SELECT `ID`
                                               FROM `" . DB_PREFIX . "counter`
                                               WHERE `date` = CURDATE()");

          if ( !$statement ) {

            throw new Exception('A fatal error occurred while executing a database query! Please check up your database!');

          }

          $statement->execute();
          $statement->bind_result($testCounter);
          $statement->fetch();
          $statement->close();

          if ( !$testCounter ) {

            $statement = $this->_objDb->prepare("INSERT INTO `" . DB_PREFIX . "counter` (`date`)
                                                 VALUES ( CURDATE() );");

            if ( !$statement ) {

              throw new Exception('A fatal error occurred while executing a database query! Please check up your database!');

            }

            $statement->execute();
            $statement->close();

          }

          /* - - - */

          $statement = $this->_objDb->prepare("DELETE FROM `" . DB_PREFIX . "stats`
                                               WHERE DATE_SUB(NOW(), INTERVAL 1 DAY) > `date_time`");

          if ( !$statement ) {

            throw new Exception('A fatal error occurred while executing a database query! Please check up your database!');

          }

          $statement->execute();
          $statement->close();

          /* - - - */

          $currentIP = $this->XSSProtect($_SERVER['REMOTE_ADDR']);

          $statement = $this->_objDb->prepare("SELECT `ip`
                                               FROM `" . DB_PREFIX . "stats`
                                               WHERE `ip` = ?");

          $statement->bind_param("s", $currentIP);
          $statement->execute();
          $statement->bind_result($resultIP);
          $statement->fetch();
          $statement->close();

          if ( $resultIP ) {

            $statement = $this->_objDb->prepare("UPDATE `" . DB_PREFIX . "stats`
                                                 SET `date_time` = NOW()
                                                 WHERE `ip` = ?");

            if ( !$statement ) {

              throw new Exception('A fatal error occurred while executing a database query! Please check up your database!');

            }

            $statement->bind_param("s", $currentIP);
            $statement->execute();
            $statement->close();

          }
          else {

            $statement = $this->_objDb->prepare("INSERT INTO `" . DB_PREFIX . "stats` (`date_time`,
                                                                                       `ip`
                                                                                      )
                                                 VALUES (NOW(), ?);");

            if ( !$statement ) {

              throw new Exception('A fatal error occurred while executing a database query! Please check up your database!');

            }

            $statement->bind_param("s", $currentIP);
            $statement->execute();
            $statement->close();

            /* - - - */

            $statement = $this->_objDb->prepare("UPDATE `" . DB_PREFIX . "counter`
                                                 SET `count` = `count` + 1
                                                 WHERE `date` = CURDATE()");

            if ( !$statement ) {

              throw new Exception('A fatal error occurred while executing a database query! Please check up your database!');

            }

            $statement->execute();
            $statement->close();

          }

          /* - - - */

          if ( preg_match("~{page:addRedirect:([^}]+)}~", $contentText, $linkMatches) ) {

            $returnContent = validateURL($linkMatches[1]) ? "" : sprintf($this->_arrLang['ERROR_REDIRECT'], $linkMatches[1]);

            if ( validateURL($linkMatches[1]) ) {

              header("Location: " . $linkMatches[1]);

            }

          }
          else {

            preg_match_all("~{page:addHead:([^}]+)}~", $contentText, $addHeadElements, PREG_PATTERN_ORDER);

            foreach ( $addHeadElements[1] as $addHeadElement => $addHeadElementValue ) {

              $contentText = str_replace($addHeadElements[0], "", $contentText);

              $this->addHead( decodeText($addHeadElementValue) );

            }

            $returnContent = $contentText;

          }

        }
        else {

          $returnContent = $this->_arrLang['ERROR_404'];

        }

        return $returnContent;

      break;

    }

  }


  /*
   * Core :: outputController()
   *
   * Gibt die komplett fertigen Template-Daten aus, um die Seite zu generieren und auszugeben.
   *
  */
  private function outputController() {

    if ( isset($_GET['main']) ) {

      switch ( $_GET['main'] ) {

        case 'admin':

          return $this->outputAdmin();

        break;


        case 'content':

          return $this->outputPage();

        break;


        case 'snippet':

          return $this->outputSnippet();

        break;


        default:

          return $this->outputPage();

        break;

      }

    }
    else {

      return $this->outputPage();

    }

  }


  /*
   * Core :: outputSnippet()
   *
   * Gibt Snippets zurück, die per URL-Einbindung geladen werden (z.B. index.php?main=snippet&id=<sni_snippet>).
   *
  */
  private function outputSnippet() {

    if ( isset($_GET['id']) && !emptyStr($_GET['id']) ) {

      $snippetName = $this->XSSProtect($_GET['id']);

      if ( fileExists( "ccms/snippets/" . $snippetName . "/configuration.ini" ) ) {

        $arrConfig_c = parseConfigFile( "ccms/snippets/" . $snippetName . "/configuration.ini" );

        /* - - - */

        if ( $arrConfig_c['integration_type'] == "url_method" || $arrConfig_c['integration_type'] == "return_method, url_method" ) {

          if ( fileExists("ccms/snippets/" . $snippetName . "/package.xml") ) {

            $objXML = simplexml_load_file("ccms/snippets/" . $snippetName . "/package.xml");

            /* - - - */

            $statement = $this->_objDb->prepare("SELECT `status`
                                                 FROM `" . DB_PREFIX . "extentions`
                                                 WHERE `name` = ? AND `package` = 'snippet'");

            if ( !$statement ) {

              throw new Exception('A fatal error occurred while executing a database query! Please check up your database!');

            }

            $statement->bind_param("s", $snippetName);
            $statement->execute();
            $statement->bind_result($snippetStatus);
            $statement->fetch();
            $statement->close();

            /* - - - */

            if ( $snippetStatus && $snippetStatus == 1 ) {

              echo $this->snippetLoader($snippetName, "ccms/snippets/" . $snippetName . "/snippet.php");

            }
            else {

              echo sprintf($this->_arrLang['ERROR_EXTENTION_NOT_INSTALLED'], $snippetName);

            }

          }
          else {

            echo $this->snippetLoader($snippetName, "ccms/snippets/" . $snippetName . "/snippet.php");

          }

        }

      }
      else {

        echo sprintf($this->_arrLang['ERROR_LOAD_EXTENTION'], $snippetName);

      }

    }

  }


  /*
   * Core :: addHead()
   *
   * Fügt dem fertigem HTML-Dokument extern eingebundene Head-Elemente hinzu.
   *
   * @param $headLine : das Head-Element, z.B. Stylesheet oder Javascript
   *
  */
  protected function addHead( $headLine ) {

    $arrHead = C_Object :: getInstance();

    $arrHead->set( $arrHead->get('head') . $headLine . "\n", 'head' );

  }


  /*
   * Core :: outputPage()
   *
   * Gibt das fertig generierte Frontend aus.
   *
  */
  private function outputPage() {

    if ( $this->_arrConfig['site_status'] == 1 || $this->isAdmin() ) {

        if ( checkMobileBrowser() && fileExists("template/" . $this->_arrConfig['template'] . "/template_mobile.html") ) {

          $tpl = new C_Template( 'template/' . $this->_arrConfig['template'] . '/template_mobile.html' );

        }
        else {

          $tpl = new C_Template( 'template/' . $this->_arrConfig['template'] . '/template.html' );

        }

        /* - - - */

      $tpl->assign("page:sitename", $this->loadPageParams('sitename'));

      $tpl->assign("page:title", $this->loadPageParams('title'));

      $tpl->assign("page:category", $this->loadPageParams('category'));

      $tpl->assign("page:meta_tags", $this->loadPageParams('meta_tags'));

      $tpl->assign("page:content", $this->loadPageParams('content'));

      $tpl->assign("page:footer", "{lang:powered_by} <a href=\"http://webstudio.reversity.org\" target=\"_blank\" title=\"{lang:powered_by} KubisCMS\"><strong>KubisCMS</strong></a> | Copyright &copy; 2003 - {system:date.year} by <a href=\"http://webstudio.reversity.org\" target=\"_blank\">Reversity Studios</a> &reg; | Programed by &copy; <a href=\"http://webstudio.reversity.org\" target=\"_blank\">Reversity WebStudio</a><br />{page:loaded}");

      $tpl->assign("page:loaded", "All rights reserved. | {lang:loaded_by}");

      $tpl->assign("system:date.year", date("Y")); /* - - - Fixing Marker - - - */

      $tpl->assign("system:sessionTimeoutMinutes", $this->_arrConfig['session_timeout']<=1 ? $this->_arrLang['SESSION_MINUTE'] : $this->_arrLang['SESSION_MINUTES']);

      $tpl->assign("system:sessionTimeout", $this->_arrConfig['session_timeout']);

      $tpl->assign("path", "template/" . $this->_arrConfig['template'] . "/"); /* - - - Fixing Marker - - - */
      $tpl->assign("system:path", "template/" . $this->_arrConfig['template'] . "/");
      $tpl->assign("system:jquery_template", "css/themes/" . $this->_arrConfig['jquery_template'] . "/");
      $tpl->assign("system:jquery_template_name", $this->_arrConfig['jquery_template']);

      preg_match_all("~{lang:([^}]+)}~", $tpl->tempOutput(), $langElements, PREG_PATTERN_ORDER);

      foreach ( $langElements[1] as $langElement => $langKey ) {

        if ( isset($this->_arrLang[strtoupper($langKey)]) ) {

          $tpl->assign("lang:" . $langKey, $this->_arrLang[strtoupper($langKey)]);

        }

      }

      /* - - - */

      preg_match_all("~{modul:([^}]+)}~", $tpl->tempOutput(), $modulElements, PREG_PATTERN_ORDER);

      foreach ( $modulElements[1] as $modulElement => $modulName ) {

        if ( fileExists("ccms/modules/" . $modulName . "/package.xml") ) {

          $objXML = simplexml_load_file("ccms/modules/" . $modulName . "/package.xml");

          /* - - - */

          $statement = $this->_objDb->prepare("SELECT `status`
                                               FROM `" . DB_PREFIX . "extentions`
                                               WHERE `name` = ? AND `package` = 'modul'");

          if ( !$statement ) {

            throw new Exception('A fatal error occurred while executing a database query! Please check up your database!');

          }

          $statement->bind_param("s", $modulName);
          $statement->execute();
          $statement->bind_result($modulStatus);
          $statement->fetch();
          $statement->close();

          /* - - - */

          if ( $modulStatus && $modulStatus == 1 ) {

            if ( fileExists("ccms/modules/" . $modulName . "/frontend.modul.php") ) {

              include_once("ccms/modules/" . $modulName . "/frontend.modul.php");

              $objModul = new $modulName();

              $tpl->assign("modul:" . $modulName, $objModul->getController());

            }

          }
          else {

            $tpl->assign("modul:" . $modulName, sprintf($this->_arrLang['ERROR_EXTENTION_NOT_INSTALLED'], $modulName));

          }

          unset($modulStatus);

        }
        else {

          $tpl->assign("modul:" . $modulName, sprintf($this->_arrLang['ERROR_LOAD_EXTENTION'], $modulName));

        }

        unset($modulName);

      }

      /* - - - */

      preg_match_all("~{snippet:([^}]+)}~", $tpl->tempOutput(), $snippetElements, PREG_PATTERN_ORDER);

      foreach ( $snippetElements[1] as $snippetElement => $snippetName ) {

        if ( fileExists( "ccms/snippets/" . $snippetName . "/configuration.ini" ) ) {

          $arrConfig_c = parseConfigFile( "ccms/snippets/" . $snippetName . "/configuration.ini" );

          /* - - - */

          if ( $arrConfig_c['integration_type'] == "return_method" || $arrConfig_c['integration_type'] == "return_method, url_method" ) {

            if ( fileExists("ccms/snippets/" . $snippetName . "/package.xml") ) {

              $objXML = simplexml_load_file("ccms/snippets/" . $snippetName . "/package.xml");

              /* - - - */

              $statement = $this->_objDb->prepare("SELECT `status`
                                                   FROM `" . DB_PREFIX . "extentions`
                                                   WHERE `name` = ? AND `package` = 'snippet'");

              if ( !$statement ) {

                throw new Exception('A fatal error occurred while executing a database query! Please check up your database!');

              }

              $statement->bind_param("s", $snippetName);
              $statement->execute();
              $statement->bind_result($snippetStatus);
              $statement->fetch();
              $statement->close();

              /* - - - */

              if ( $snippetStatus && $snippetStatus == 1 ) {

                $tpl->assign("snippet:" . $snippetName, $this->snippetLoader($snippetName, "ccms/snippets/" . $snippetName . "/snippet.php"));

              }
              else {

                $tpl->assign("snippet:" . $snippetName, sprintf($this->_arrLang['ERROR_EXTENTION_NOT_INSTALLED'], $snippetName));

              }

            }
            else {

              $tpl->assign("snippet:" . $snippetName, $this->snippetLoader($snippetName, "ccms/snippets/" . $snippetName . "/snippet.php"));

            }

          }

        }
        else {

          $tpl->assign("snippet:" . $snippetName, sprintf($this->_arrLang['ERROR_LOAD_EXTENTION'], $snippetName));

        }

        unset($snippetName);

      }

      $arrHead = C_Object :: getInstance();

		$tpl->assign("page:jquery_css", "<link rel=\"stylesheet\" type=\"text/css\" href=\""."css/themes/" . $this->_arrConfig['jquery_template'] . "/".$this->_arrConfig['jquery_template'].".css\" >");
		$tpl->assign("page:jquery_js", "<script type=\"text/javascript\" src=\"js/jquery-1.4.3.js\"></script>");
		$tpl->assign("page:jquery_ui", "<script type=\"text/javascript\" src=\"js/ui/jquery-ui-1.8.6.custom.js\"></script>");	
		$tpl->assign("page:head", $arrHead->get('head'));
      
      echo $tpl->output();

    }
    else {

      $tpl = new C_Template( 'ccms/template/offline.html' );

      /* - - - */

      preg_match_all("~{lang:([^}]+)}~", $tpl->tempOutput(), $langElements, PREG_PATTERN_ORDER);

      foreach ( $langElements[1] as $langElement => $langKey ) {

        if ( isset($this->_arrLang[strtoupper($langKey)]) ) {

          $tpl->assign("lang:" . $langKey, $this->_arrLang[strtoupper($langKey)]);

        }

      }		
	$arrHead = C_Object :: getInstance();
	
      $tpl->assign("page:sitename", $this->_arrConfig['sitename']);

      $tpl->assign("system:path", "ccms/template/");

      $tpl->assign("system:jquery_template", "css/themes/" . $this->_arrConfig['jquery_template'] . "/");

      $tpl->assign("system:jquery_template_name", $this->_arrConfig['jquery_template']);

      $tpl->assign("page:jquery_css", "<link rel=\"stylesheet\" type=\"text/css\" href=\""."css/themes/" . $this->_arrConfig['jquery_template'] . "/".$this->_arrConfig['jquery_template'].".css\" >");
	  $tpl->assign("page:jquery_js", "<script type=\"text/javascript\" src=\"js/jquery-1.4.3.js\"></script>");
	  $tpl->assign("page:jquery_ui", "<script type=\"text/javascript\" src=\"js/ui/jquery-ui-1.8.6.custom.js\"></script>");	
	  $tpl->assign("page:head", $arrHead->get('head'));
      /* - - - */

      echo $tpl->output();

    }

  }


  /*
   * Core :: outputAdmin()
   *
   * Gibt das fertig generierte Backend aus. 
   *
  */
  private function outputAdmin() {

    if ( $this->isAdmin() ) {

      $tpl = new C_Template( 'ccms/template/template.html' );

      /* - - - */

      $tpl->assign("page:sitename", $this->_arrConfig['sitename']);

      $tpl->assign("snippet:sni_footpanel", $this->snippetLoader("sni_footpanel", "ccms/snippets/sni_footpanel/snippet.php"));

      $tpl->assign("snippet:be_navigation_1", $this->snippetLoader("sni_be_navigation_1", "ccms/snippets/sni_be_navigation_1/snippet.php"));

      $tpl->assign("snippet:be_navigation_2", $this->snippetLoader("sni_be_navigation_2", "ccms/snippets/sni_be_navigation_2/snippet.php"));
      
      $tpl->assign("snippet:be_navigation_a", $this->snippetLoader("sni_be_navigation_a", "ccms/snippets/sni_be_navigation_a/snippet.php"));

      $tpl->assign("snippet:be_navigation_b", $this->snippetLoader("sni_be_navigation_b", "ccms/snippets/sni_be_navigation_b/snippet.php"));
      
      $tpl->assign("snippet:sni_lang_admin", $this->snippetLoader("sni_lang_admin", "ccms/snippets/sni_lang_admin/snippet.php"));

      $tpl->assign("page:content", $this->componentLoader());

      $tpl->assign("system:date.year", date("Y")); /* - - - Fixing Marker - - - */

      $tpl->assign("system:path", "ccms/template/");

      $tpl->assign("system:jquery_template", "css/themes/" . $this->_arrConfig['jquery_template'] . "/");

      $tpl->assign("system:jquery_template_name", $this->_arrConfig['jquery_template']);

      $tpl->assign("system:version", CORE_VERSION);

      $tpl->assign("system:name", CORE_NAME);

      $tpl->assign("system:build", CORE_BUILD);

      $tpl->assign("system:gui", CORE_GUI);

      $tpl->assign("page:loaded", "All rights reserved. | {lang:loaded_by}");
      
      preg_match_all("~{lang:([^}]+)}~", $tpl->tempOutput(), $langElements, PREG_PATTERN_ORDER);

      foreach ( $langElements[1] as $langElement => $langKey ) {

        if ( isset($this->_arrLang[strtoupper($langKey)]) ) {

          $tpl->assign("lang:" . $langKey, $this->_arrLang[strtoupper($langKey)]);

        }

      }

      $tpl->assign("system:sessionTimeout", $this->_arrConfig['session_timeout']);

      $tpl->assign("system:sessionTimeoutMinutes", $this->_arrConfig['session_timeout']<=1 ? $this->_arrLang['SESSION_MINUTE'] : $this->_arrLang['SESSION_MINUTES']);


      /* - - - */

      $arrHead = C_Object :: getInstance();


		$tpl->assign("page:jquery_css", "<link rel=\"stylesheet\" type=\"text/css\" href=\""."css/themes/" . $this->_arrConfig['jquery_template'] . "/".$this->_arrConfig['jquery_template'].".css\" >");
		$tpl->assign("page:jquery_js", "<script type=\"text/javascript\" src=\"js/jquery-1.4.3.js\"></script>");
		$tpl->assign("page:jquery_ui", "<script type=\"text/javascript\" src=\"js/ui/jquery-ui-1.8.6.custom.js\"></script>");	
		$tpl->assign("page:head", $arrHead->get('head'));


      echo $tpl->output();

    }
    else {

      $tpl = new C_Template( 'ccms/template/login.html' );

      /* - - - */

      preg_match_all("~{lang:([^}]+)}~", $tpl->tempOutput(), $langElements, PREG_PATTERN_ORDER);

      foreach ( $langElements[1] as $langElement => $langKey ) {

        if ( isset($this->_arrLang[strtoupper($langKey)]) ) {

          $tpl->assign("lang:" . $langKey, $this->_arrLang[strtoupper($langKey)]);

        }

      }

      $tpl->assign("page:sitename", $this->_arrConfig['sitename']);

      $tpl->assign("page:content", $this->componentLoader());

      $tpl->assign("system:date.year", date("Y")); /* - - - Fixing Marker - - - */

      $tpl->assign("system:path", "ccms/template/");

      $tpl->assign("system:jquery_template", "css/themes/" . $this->_arrConfig['jquery_template'] . "/");

      $tpl->assign("system:jquery_template_name", $this->_arrConfig['jquery_template']);

      

      /* - - - */

      $arrHead = C_Object :: getInstance();

		$tpl->assign("page:jquery_css", "<link rel=\"stylesheet\" type=\"text/css\" href=\""."css/themes/" . $this->_arrConfig['jquery_template'] . "/".$this->_arrConfig['jquery_template'].".css\" >");
		$tpl->assign("page:jquery_js", "<script type=\"text/javascript\" src=\"js/jquery-1.4.3.js\"></script>");
		$tpl->assign("page:jquery_ui", "<script type=\"text/javascript\" src=\"js/ui/jquery-ui-1.8.6.custom.js\"></script>");	
		$tpl->assign("page:head", $arrHead->get('head'));

      $tpl->assign("snippet:sni_lang_admin", $this->snippetLoader("sni_lang_admin", "ccms/snippets/sni_lang_admin/snippet.php"));
      
      echo $tpl->output();

    }

  }


  /*
   * Core :: executeSystem()
   *
   * Gibt die fertigen Daten aus.
   *
  */
  public function executeSystem() {

    $this->connectDatabase();

    /* - - - */

    if ( fileExists("include/runonce.php") ) {

      include("include/runonce.php");

      $objRunOnce = new RunOnceFile();

      $objRunOnce->getController();

      /* - - - */

      C_Filesystem :: delete("include/runonce.php");

    }

    $this->outputController();

    $this->closeDatabase();

  }


}

?>
