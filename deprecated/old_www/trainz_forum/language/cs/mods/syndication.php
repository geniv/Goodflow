<?php
/**
*
* syndication [English]
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
	'CUSTOM_SYNDICATION_TITLE'							=> 'Vytvořit vlastní kanál',

	'INVALID_INPUT'													=> 'Skript byl zavolán nekorektně.',

	'NOTHING_SELECTED'											=> 'Prosím, vyberte si alespoň jedno forum a nebo zaškrtněte "Všechna fóra".',
	'NUMBER_ITEMS'												=> 'Počet položek v zobrazených v kanále',

	'PRIVATE_FEED'													=> 'soukromé kanály',
	'PRIVATE_FEED_CHANCEL'									=> "Přístup k tomuto kanálu je omezen. Prosím zadejte své uživatelské jméno a heslo.",

	'SELECT_FORUMS'												=> 'Vyberte fóra',
	'SELECT_FORUMS_EXPLAIN'									=> 'Vyberte fóra, která chcete zahrnout do kanálu.',
	'SERVICE_UNAVAILABLE'										=> 'Je nám líto, ale tato služba byla zakázána administrátorem.',
	'SYNDICATION_ADMIN_LIMIT'								=> 'Berte prosím na vědomí, že administrátor nastavil limit na %d položek. Tento limit nesmíte překročit.',
	'SYNDICATION_DISABLED'									=> 'Je nám líto, ale kanály byly vypnuty a nebo nemáte dostatečná oprávnění pro tuto operaci.',
	'SYNDICATION_FORUM_TOPICS'			=> 'Poslední témata v tomto fóru.',
	'SYNDICATION_FORUM_POSTS'			=> 'Poslední příspěvky v tomto fóru.',
	'SYNDICATION_PM_DESCRIPTION'						=> 'Poslední osobní zprávy z "%1$s" adresáře "%2$s".',
	'SYNDICATION_PM_TITLE'									=> 'Poslední osobní zprávy z adresáře "%1$s"',
	'SYNDICATION_POSTS_CATEGORIES_DESCRIPTION'		=> 'Poslední příspěvky z kategorie “%s" na fóru.',
	'SYNDICATION_POSTS_CATEGORIES_TITLE'				=> 'Poslední příspěvky z různých kategorií.',
	'SYNDICATION_POSTS_CATEGORY_DESCRIPTION'		=> 'Poslední příspěvky z kategorie "%s" ve fóru “%s".',
	'SYNDICATION_POSTS_CATEGORY_TITLE'				=> 'Poslední příspěvky z "%s"',
	'SYNDICATION_POSTS_DESCRIPTION'					=> 'Poslední příspěvky z fóra "%1$s" na "%2$s".',
	'SYNDICATION_POSTS_TITLE'								=> 'Poslední příspěvky z fóra "%s".',
	'SYNDICATION_POSTS_GLOBAL_DESCRIPTION'		=> 'Poslední příspěvky z fóra "%s".',
	'SYNDICATION_POSTS_GLOBAL_TITLE'					=> 'Poslední příspěvky z "%s".',
	'SYNDICATION_POSTS_VARIOUS_DESCRIPTION'	=> 'Různé poslední příspěvky z "%s".',
	'SYNDICATION_POSTS_VARIOUS_TITLE'				=> 'Různé poslední příspěvky z "%s".',
	'SYNDICATION_TOPIC_POSTS'										=> 'Poslední příspěvky v tomto tématu.',
	'SYNDICATION_TOPIC_POSTS_DESCRIPTION'			=> 'Poslední příspěvky v tématu "%1$s" na "%2$s".',
	'SYNDICATION_TOPIC_POSTS_TITLE'					=> 'Poslední příspěvky v tématu "%1$s"',
	'SYNDICATION_TOPICS_CAT'									=> 'Poslední témata v kategorii',
	'SYNDICATION_POSTS_CAT'									=> 'Poslední příspěvky v kategorii',
	'SYNDICATION_TOPICS_SUB'	=> 'Poslední témata v tomto fóru (vč. subfór)',
	'SYNDICATION_POSTS_SUB'	=> 'Poslední příspěvky v tomto fóru (vč. subfór)',
	'SYNDICATION_TOPICS_CATEGORIES_DESCRIPTION'		=> 'Poslední témata z různých kategorií "%s".',
	'SYNDICATION_TOPICS_CATEGORIES_TITLE'				=> 'Poslední témata z různých kategorií',
	'SYNDICATION_TOPICS_CATEGORY_DESCRIPTION'		=> 'Poslední témata z kategorie "%s" na "%s" fóru.',
	'SYNDICATION_TOPICS_CATEGORY_TITLE'				=> 'Poslední témata z "%s"',
	'SYNDICATION_TOPICS_DESCRIPTION'					=> 'Poslední témata na fóru "%1$s" z "%2$s".',
	'SYNDICATION_TOPICS_TITLE'								=> 'Poslední témata z "%s"',
	'SYNDICATION_TOPICS_GLOBAL_DESCRIPTION'		=> 'Poslední témata z "%s" fóra.',
	'SYNDICATION_TOPICS_GLOBAL_TITLE'				=> 'Posledné témata z "%s"',
	'SYNDICATION_TOPICS_VARIOUS_DESCRIPTION'	=> 'Různá témata z fóra "%s".',
	'SYNDICATION_TOPICS_VARIOUS_TITLE'				=> 'Různá poslední témata z "%s"',

	'TOPICS_OR_POSTS'											=> 'Témata nebo příspěvky',
	'TOPICS_OR_POSTS_EXPLAIN'								=> 'Prosím, zvolte, zda chcete informovat o změnách ve fórech a nebo v konkrétních vláknech.',
));

?>
