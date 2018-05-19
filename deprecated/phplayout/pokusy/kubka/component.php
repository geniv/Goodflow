<?php
/**
 *      ﻿KubisCMS - component About
 *      
 *      About CMS
 *      
 *      @author Jan "DJ KUBIS" Kubka | Programmer / Team leader <dj-kubis@reversity.org>
 *      @version 0.6.0
 *      @category KubisCMS
 *      @package /ccms/components/com_about
 *      @subpackage /component.php
 *      @copyright Copyright (C) 2004 - 2011 Reversity Studios - Reversity WebStudio
 *      @link http://dj-kubis.reversity.org Reversity KubisCMS
 *      
 *      +-------------------------------------------------------+
 *      | Reversity Studios - Reversity WebStudio KubisCMS 
 *      | Copyright (C) 2004 - 2011 Reversity Studios - Reversity WebStudio
 *      | http://www.reversity.org | http://webstudio.reversity.org
 *      | Contact info@reversity.org | webstudio@reversity.org
 *      +--------------------------------------------------------+
 *      | Filename: component.php
 *      | Version: 0.6.0
 *      | Author: Jan "DJ KUBIS" Kubka | Programmer / Team leader
 *      | Author E-mail: dj-kubis@reversity.org
 *      | Created: 2011-02-20
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


class com_about extends Core {

  private $_ComponentName = 'com_about';

  private $_ComponentPath = 'ccms/components/com_about';

  private $_ComponentDefaultLanguage = 'en';

  /* - - - */

  private $_arrConfig;

  private $_arrConfig_c;

  private $_objDb;

  private $_arrLang;

  private $_arrLang_c;


  public function __construct() {

    Core :: getInstance();

    /* - - - */

    $objConfiguration = C_Object :: getInstance();

    $this->_arrConfig = $objConfiguration->get('configuration');

    self :: loadConfiguration();

    /* - - - */

    $objDatabase = C_Object :: getInstance();

    $this->_objDb = $objDatabase->get('database');

    /* - - - */

    $objLanguage = C_Object :: getInstance();

    $this->_arrLang = $objLanguage->get('language');

    self :: loadLanguage();

  }

  private function getPermission() {

    if ( Core :: isAdmin() && Core :: getValidPermission($this->_arrConfig_c['access_level']) ) {

      return true;

    }
    else {

      return false;

    }

  }

  private function loadConfiguration() {

    if ( fileExists($this->_ComponentPath . "/configuration.ini") ) {

      $this->_arrConfig_c = parseConfigFile($this->_ComponentPath . "/configuration.ini");

    }
    else {

      throw new Exception('The configuration-file "' . $this->_ComponentPath . '/configuration.ini" could not be loaded!');

    }

  }

  private function loadLanguage() {

    if ( empty($_SESSION['systemLanguage']) && fileExists( $this->_ComponentPath . "/resources/language/" . $this->_arrConfig['language'] . ".lang.ini" ) ) {

      $this->_arrLang_c = parseConfigFile( $this->_ComponentPath . "/resources/language/" . $this->_arrConfig['language'] . ".lang.ini" );

    }
    elseif ( empty($_SESSION['systemLanguage']) && fileExists( $this->_ComponentPath . "/resources/language/" . $this->_ComponentDefaultLanguage . ".lang.ini" ) ) {

      $this->_arrLang_c = parseConfigFile( $this->_ComponentPath . "/resources/language/" . $this->_ComponentDefaultLanguage . ".lang.ini" );

    }
    elseif ( isset($_SESSION['systemLanguage']) ) {
		if(fileExists( $this->_ComponentPath . "/resources/language/" . $_SESSION['systemLanguage'] . ".lang.ini" )){
			$this->_arrLang_c = parseConfigFile( $this->_ComponentPath . "/resources/language/" . $_SESSION['systemLanguage'] . ".lang.ini" );
		}elseif(fileExists( $this->_ComponentPath . "/resources/language/" . $this->_ComponentDefaultLanguage . ".lang.ini" )){
			$this->_arrLang_c = parseConfigFile( $this->_ComponentPath . "/resources/language/" . $this->_ComponentDefaultLanguage . ".lang.ini" );
		}
      

    }
    else {

      throw new Exception('The language-file "' . $this->_ComponentPath . "/resources/language/" . $this->_ComponentDefaultLanguage . '.lang.ini" could not be loaded!');

    }

  }

  protected function getController() {

    if ( self :: getPermission() ) {

      Core :: addHead("<link rel=\"stylesheet\" type=\"text/css\" href=\"" . $this->_ComponentPath . "/resources/stylesheets/component.css\" />");

      /* - - - */

      $tpl = new C_Template( $this->_ComponentPath . '/resources/template_elements/component.html' );

      $tpl->assign("component_image_path", $this->_ComponentPath . "/resources/images/component.png");
      $tpl->assign("component_path", $this->_ComponentPath);
      $tpl->assign("component_name", $this->_arrLang_c['COMPONENT_NAME']);

      /* - - - */

      $tpl->assign("lang:release_notice", $this->_arrLang_c['RELEASE_NOTICE']);
      $tpl->assign("lang:application_description", $this->_arrLang_c['APPLICATION_DESCRIPTION']);
      $tpl->assign("lang:contains_products", $this->_arrLang_c['CONTAINS_PRODUCTS']);
      $tpl->assign("system:date.year", date("Y"));

      $response = $tpl->output();

    }
    else {

      $tpl = new C_Template( 'ccms/template/template_elements/notice_error.html' );

      $tpl->assign("message", $this->_arrLang['ERROR_ACCESS_DENIED']);
      $tpl->assign("link", "index.php?main=admin&amp;id=com_dashboard");
      $tpl->assign("link_title", $this->_arrLang['NEXT']);

      $response = $tpl->output();

    }

    return $response;

  }


}

?>
