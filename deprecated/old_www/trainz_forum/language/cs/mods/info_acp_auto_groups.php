<?php
/**
*
* acp_info_auto_gropus [Czech]
*
* @package language
* @version 1.0.0 $
* @copyright (c) 2008 JediSoft.cz, Sueneé
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

if (!defined('IN_PHPBB'))
{
	exit;
}

/**
* DO NOT CHANGE
*/
if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine

$lang = array_merge($lang, array(
	'AUTO_GROUP'			=> 'Automatické začlenění do skupiny',
	'GROUP_MIN_POSTS'		=> 'Minimílní počet příspěvků',
	'GROUP_MAX_POSTS'		=> 'Maximální počet příspěvků',
	'GROUP_MIN_DAYS'		=> 'Mimimální doba členství',
	'GROUP_MAX_DAYS'		=> 'Maximální doba členství',
	'GROUP_MIN_WARNINGS'	=> 'Minimum varovných bodů',
	'GROUP_MAX_WARNINGS'	=> 'Maximum varovných bodů',
	'DEFAULT_AUTO_GROUP'	=> 'Udělat automaticky jako výchozí',
	'DEFAULT_AUTO_GROUP_EXPLAIN'	=> 'Uživateli je přidělena tato skupina jako výchozí pokud splní výše uvedené podmínky.',)
);
?>
