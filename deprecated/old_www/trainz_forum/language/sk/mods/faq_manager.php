<?php
/**
*
* @package phpBB3 FAQ Manager
* @copyright (c) 2007 EXreaction, Lithium Studios
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

// Create the lang array if it does not already exist
if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// Merge the following language entries into the lang array
$lang = array_merge($lang, array(
	'ACP_FAQ_MANAGER'			=> 'FAQ Manager',

	'BACKUP_LOCATION_NO_WRITE'	=> 'Není možné vytvořit záložní soubor. Prosím ověřte práva pro zápis do adresáře store/faq_backup/ a v šechny soubory a adresáře v něm.',
	'BAD_FAQ_FILE'				=> 'Soubor, který požadujete není FAQ soubor.',

	'CAT_ALREADY_EXISTS'		=> 'Kategorie s daným názvem již existuje.',
	'CATEGORY_NOT_EXIST'		=> 'Požadovaná kategorie neexistuje.',
	'CREATE_CATEGORY'			=> 'Vytvořit kategorii',
	'CREATE_FIELD'				=> 'Vytvořit pole',

	'DELETE_CAT'				=> 'Smazat kategorii',
	'DELETE_CAT_CONFIRM'		=> 'Jste si jistí, že chcete smazat tuto kategorii? Všechny pole v této kategorii budou smazány, pokud to uděláte!',
	'DELETE_VAR'				=> 'Smazat pole',
	'DELETE_VAR_CONFIRM'		=> 'Jste si jistí, že chcete toto pole smazat?',

	'FAQ_CAT_LIST'				=> 'Zde můžete vidět a upravit existující kategorie.',
	'FAQ_EDIT_SUCCESS'			=> 'FAQ bylo úspěšně aktualizováno.',
	'FAQ_FILE_NOT_EXIST'		=> 'Soubor, který chcete existovat, neexistuje.',
	'FAQ_FILE_NO_WRITE'			=> 'Nelze aktualizovat soubor. Zkountrolujte si oprávnění k souboru, který chcete editovat.',
	'FAQ_FILE_SELECT'			=> 'Vyberte soubor, který chcete editovat.',

	'LANGUAGE'					=> 'Jazyk',
	'LOAD_BACKUP'				=> 'Nahrát zálohu',

	'NAME'						=> 'Název',
	'NOT_ALLOWED_OUT_OF_DIR'	=> 'Nejste oprávněni upravovat soubory mimo adresář pro jazyky.',
	'NO_FAQ_FILES'				=> 'Žádné soubory FAQ.',
	'NO_FAQ_VARS'				=> 'V souboru nejsou žádné FAQ proměnné.',

	'VAR_ALREADY_EXISTS'		=> 'Pole daného názvu již existuje.',
	'VAR_NOT_EXIST'				=> 'Požadovaná proměnná neexistuje.',
));

?>
