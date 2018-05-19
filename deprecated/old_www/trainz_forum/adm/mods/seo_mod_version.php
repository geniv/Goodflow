<?php
/**
*
* @package acp
* @version $Id: seo_mod_version.php 54 2007-11-09 00:55:27Z Handyman $
* @copyright (c) 2007 StarTrekGuide
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

if (!defined('IN_PHPBB'))
{
	exit;
}

/**
* @package seo_mod
*/

class seo_mod_version
{
	function version()
	{
		return array(
			'author'	=> 'Handyman`',
			'title'		=> 'SEO MOD',
			'tag'		=> 'seo_mod',
			'version'	=> '1.0.0',
			'file'		=> array('startrekguide', 'updatecheck', 'mods101.xml'),
		);
	}
}

?>