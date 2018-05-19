<?php
/**
*
* acp_syndication [English]
*
* @package language
* @version $Id$
* @copyright (c) 2007 Niklas Schmidtmer
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* DO NOT CHANGE
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

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
	'ENABLE_SYNDICATION'					=> 'Povolit kanály pro témata a fóra',

	'SYNDICATION_ATOM'							=> 'Atom',
	'SYNDICATION_DEFAULT'					=> 'Vyberte výchozí formát kanálů',
	'SYNDICATION_DEFAULT_EXPLAIN'	=> 'Uživatelé mohou toto nastavení změnit ve svém osobní nastavení.',
	'SYNDICATION_INSTALL'					=> 'Instalace plnohodnoté verze modulu',
	'SYNDICATION_INSTALL_COMPLETE'	=> 'Instalace databáze modulu je kompletní.',

	'SYNDICATION_ITEMS'						=> 'Počet položek zobrazených v kanálu',
	'SYNDICATION_LEGEND'					=> 'Konfigurace kanálů',
	'SYNDICATION_RSS2'							=> 'RSS 2.0',
	'SYNDICATION_QUERIES_FAILED'	=> 'This is not supposed to happen. Should you run into problems installing this MOD please seek help in the MOD’s release topic.',
	'SYNDICATION_TITLE'						=> 'Konfigurace kanálů',
	'SYNDICATION_TITLE_EXPLAIN'		=> 'Zde můžete nastavit základní nastavení kanálů.',
	'SYNDICATION_TTL'							=> 'Čas uložení dat do cache, než-li budou znovu načtena',
	'SYNDICATION_TTL_EXPLAIN'			=> 'Obsah příspěvků a nebo témat nebude znovu načten dříve než-li vyprší tento čas.',
));

?>
