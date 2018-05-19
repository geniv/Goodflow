<?php
/**
* @version $Id: czech.php,v 1.00 2005/02/21 13:00:00 svatas Exp add Clay$
* @package Joomla 1.0.2
* @copyright Copyright (C) 2005 Open Source Matters. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

// no direct access
defined( '_VALID_MOS' ) or die( 'Přímý přístup do této oblasti není povolen.' );

// Site page note found
define( '_404', 'Omlouváme se, ale Vámi požadovaná stránka nebyla nalezena.' );
define( '_404_RTS', 'Návrat na stránku' );

define( '_SYSERR1', 'Databázové rozhraní není dostupné' );
define( '_SYSERR2', 'Nemohu se připojit k databázovému serveru' );
define( '_SYSERR3', 'Nemohu se připojit k databázi' );

// common
DEFINE('_LANGUAGE','cz');
DEFINE("_NOT_AUTH","Nemáte oprávnění pro prohlížení tohoto zdroje.");
DEFINE("_DO_LOGIN","Je vyžadováno přihlášení.");
DEFINE('_VALID_AZ09',"Prosím zadejte platné %s.  Bez mezer, více než %d znaků a obsahující 0-9,a-z,A-Z");
DEFINE('_VALID_AZ09_USER',"Prosím zadejte platné %s.  Více než %d znaků a obsahující 0-9,a-z,A-Z");
DEFINE('_CMN_YES',"Ano");
DEFINE('_CMN_NO',"Ne");
DEFINE('_CMN_SHOW','Ukázat');
DEFINE('_CMN_HIDE','Skrýt');

DEFINE('_CMN_NAME',"Jméno");
DEFINE('_CMN_DESCRIPTION',"Popis");
DEFINE('_CMN_SAVE',"Uložit");
DEFINE('_CMN_APPLY','Aplikovat');
DEFINE('_CMN_CANCEL',"Storno");
DEFINE('_CMN_PRINT',"Tisk");
DEFINE('_CMN_PDF',"PDF");
DEFINE('_CMN_EMAIL',"E-mail");
DEFINE('_ICON_SEP','|');
DEFINE('_CMN_PARENT',"O úroveň výš"); // in the context of parent folder, parent menu item, etc
DEFINE('_CMN_ORDERING',"Řazení");
DEFINE('_CMN_ACCESS',"Přístupová úroveň");
DEFINE('_CMN_SELECT',"Vybrat");

DEFINE('_CMN_NEXT',"Následující");
DEFINE('_CMN_NEXT_ARROW',"&gt;&gt;");
DEFINE('_CMN_PREV',"Předchozí");
DEFINE('_CMN_PREV_ARROW',"&gt;&gt;");

DEFINE('_CMN_SORT_NONE',"Neřadit");
DEFINE('_CMN_SORT_ASC',"Řadit vzestupně");
DEFINE('_CMN_SORT_DESC',"Řadit sestupně");

DEFINE('_CMN_NEW',"Nový");
DEFINE('_CMN_NONE',"Žádný");
DEFINE('_CMN_LEFT',"Vlevo");
DEFINE('_CMN_RIGHT',"Vpravo");
DEFINE('_CMN_CENTER',"Na střed");
DEFINE('_CMN_ARCHIVE','Archivovat');
DEFINE('_CMN_UNARCHIVE','Odarchivovat');
DEFINE('_CMN_TOP','Nahoru');
DEFINE('_CMN_BOTTOM','Dolu');

DEFINE('_CMN_PUBLISHED',"Zveřejnit");
DEFINE('_CMN_UNPUBLISHED',"Zneveřejnit");

DEFINE('_CMN_EDIT_HTML','Editovat HTML');
DEFINE('_CMN_EDIT_CSS','Editovat CSS');

DEFINE('_CMN_DELETE','Smazat');

DEFINE('_CMN_FOLDER',"Složka");
DEFINE('_CMN_SUBFOLDER',"Podsložka");
DEFINE('_CMN_OPTIONAL',"Volitelné");
DEFINE('_CMN_REQUIRED',"Povinné");

DEFINE('_CMN_CONTINUE',"Pokračovat");

DEFINE('_STATIC_CONTENT','Statický obsah');

DEFINE('_CMN_NEW_ITEM_LAST','Nové položky nakonec, jako výchozí');
DEFINE('_CMN_NEW_ITEM_FIRST','Nové položky na začátek, jako výchozí');
DEFINE('_LOGIN_INCOMPLETE','Prosím vyplňte pole uživatelské jméno a heslo.');
DEFINE('_LOGIN_BLOCKED','Váš přístup byl zablokován, kontaktujte administrátora.');
DEFINE('_LOGIN_INCORRECT','Nesprávné jméno nebo heslo. Zadejte znovu.');
DEFINE('_LOGIN_NOADMINS','Nelze se přihlásit, nebyla provedena požadovaná nastavení.');
DEFINE('_CMN_JAVASCRIPT','!Varování! Pro správné fungování musí být Java scripty povoleny.');

DEFINE('_NEW_MESSAGE','Nová soukromá zpráva');
DEFINE('_MESSAGE_FAILED','Uživatel má zamknutou schránku. Doručení selhalo.');

DEFINE('_CMN_IFRAMES', 'Tato volba nebude správně fungovat, protože Váš prohlížeč nepodporuje inline rámce (IFRAMES)');

DEFINE('_INSTALL_3PD_WARN','Varování: Instalace rozšíření třetích stran může výrazně ovlivnit bezpečnost Vašeho serveru. Aktualizace Joomla neaktualizuje rozšíření třetích stran. <br />Pro více informací a udržování bezpečností Vašich stránek navštivte <a href="http://forum.joomla.org/index.php/board,267.0.html" target="_blank" style="color: blue; text-decoration: underline;">Joomla! Security Forum</a>.');
DEFINE('_INSTALL_WARN','Pro Vaši bezpečnost kompletně odeberte instalační adresář včetně podadresářů - poté dejte obnovit tuto stránku');
DEFINE('_TEMPLATE_WARN','<font color=\"red\"><b>Šablona nebyla nalezena! Vyhledávat šablonu:</b></font>');
DEFINE('_NO_PARAMS','Tato položka nemá parametry');
DEFINE('_HANDLER','Handler není definován pro typ');

/** mambots */
DEFINE('_TOC_JUMPTO',"Přejít na obsah");

/**  content */
DEFINE('_READ_MORE','Celý článek...');
DEFINE('_READ_MORE_REGISTER','Pro další čtení se zaregistrujte...');
DEFINE('_MORE','Více...');
DEFINE('_ON_NEW_CONTENT', "Byl vložen nový článek užvatelem %s nazvaný %s (sekce %s kategorie %s)." );
DEFINE('_SEL_CATEGORY','Zvolte kategorii');
DEFINE('_SEL_SECTION','Zvolte sekci');
DEFINE('_SEL_AUTHOR','Zvolte autora');
DEFINE('_SEL_POSITION','Zvolte pozici');
DEFINE('_SEL_TYPE','Zvolte typ');
DEFINE('_EMPTY_CATEGORY','Tato kategorie je momentálně prázdná');
DEFINE('_EMPTY_BLOG','Nejsou zde žádné položky k zobrazení');
DEFINE('_NOT_EXIST','Stranka, kterou se pokousite zobrazit, neexistuje.<br />Zvolte stranku z hlavniho menu.');
DEFINE('_SUBMIT_BUTTON','Odeslat');

/** classes/html/modules.php */
DEFINE('_BUTTON_VOTE','Hlasovat');
DEFINE('_BUTTON_RESULTS','Výsledky');
DEFINE('_USERNAME','Uživatelské jméno');
DEFINE('_LOST_PASSWORD','Zapomenuté heslo');
DEFINE('_PASSWORD','Heslo');
DEFINE('_BUTTON_LOGIN','Přihlášení');
DEFINE('_BUTTON_LOGOUT','Odhlášení');
DEFINE('_NO_ACCOUNT','Nemáte účet?');
DEFINE('_CREATE_ACCOUNT','Vytvořte jej!');
DEFINE('_VOTE_POOR','Slabé');
DEFINE('_VOTE_BEST','Vynikající');
DEFINE('_USER_RATING','Hodnocení čtenářů');
DEFINE('_RATE_BUTTON','Ohodnotit');
DEFINE('_REMEMBER_ME','Zapamatovat');

/** contact.php */
DEFINE('_ENQUIRY','Dotaz');
DEFINE('_ENQUIRY_TEXT','Toto je e-mail s otázkou od');
DEFINE('_COPY_TEXT','Toto je kopie zprávy poslaná administrátorovi %s');
DEFINE('_COPY_SUBJECT','Kopie: ');
DEFINE('_THANK_MESSAGE','Děkujeme za váš e-mail.');
DEFINE('_CLOAKING','Tato adresa je chráněna proti spamování, pro její zobrazení potřebujete mít Java scripty povoleny ');
DEFINE('_CONTACT_HEADER_NAME','Jméno');
DEFINE('_CONTACT_HEADER_POS','Pozice');
DEFINE('_CONTACT_HEADER_EMAIL','Email');
DEFINE('_CONTACT_HEADER_PHONE','Telefon');
DEFINE('_CONTACT_HEADER_FAX','Fax');
DEFINE('_CONTACTS_DESC','Seznam kontaktů tohoto webu.');
DEFINE('_CONTACT_MORE_THAN','Můžete vložit pouze jednu email adresu.');

/** classes/html/contact.php */
DEFINE('_CONTACT_TITLE','Kontakt');
DEFINE('_EMAIL_DESCRIPTION','Poslat zprávu:');
DEFINE('_NAME_PROMPT',' Zadejte vaše jméno:');
DEFINE('_EMAIL_PROMPT',' Zadejte váš e-mail:');
DEFINE('_MESSAGE_PROMPT',' Vaše zpráva:');
DEFINE('_SEND_BUTTON','Odeslat');
DEFINE('_CONTACT_FORM_NC','Ujistěte se prosím, že je formulář kompletní a správně vyplněn.');
DEFINE('_CONTACT_TELEPHONE','Telefon: ');
DEFINE('_CONTACT_MOBILE','Mobil: ');
DEFINE('_CONTACT_FAX','Fax: ');
DEFINE('_CONTACT_EMAIL','Email: ');
DEFINE('_CONTACT_NAME','Jméno: ');
DEFINE('_CONTACT_POSITION','Pozice: ');
DEFINE('_CONTACT_ADDRESS','Adresa: ');
DEFINE('_CONTACT_MISC','Ostatní: ');
DEFINE('_CONTACT_SEL','Vyberte kontakt:');
DEFINE('_CONTACT_NONE','Pro tento kontakt nejsou k dispozici žádné detaily.');
DEFINE('_CONTACT_ONE_EMAIL','Můžete vložit pouze jednu email adresu.');
DEFINE('_EMAIL_A_COPY','Poslat kopii této zprávy také na vlastní adresu');
DEFINE('_CONTACT_DOWNLOAD_AS','Stáhnout informaci jako');
DEFINE('_VCARD','VCard');

/** pageNavigation */
DEFINE('_PN_LT','&lt;');
DEFINE('_PN_RT','&gt;');
DEFINE('_PN_PAGE','Strana');
DEFINE('_PN_OF','z');
DEFINE('_PN_START','Začátek');
DEFINE('_PN_PREVIOUS','Předchozí');
DEFINE('_PN_NEXT','Následující');
DEFINE('_PN_END','Konec');
DEFINE('_PN_DISPLAY_NR','Zobrazuji ');
DEFINE('_PN_RESULTS','Výsledky');

/** emailfriend */
DEFINE('_EMAIL_TITLE','E-mail příteli');
DEFINE('_EMAIL_FRIEND','Poslat odkaz na tuto stránku e-mailem příteli.');
DEFINE('_EMAIL_FRIEND_ADDR','E-mail příjemce:');
DEFINE('_EMAIL_YOUR_NAME','Vaše jméno:');
DEFINE('_EMAIL_YOUR_MAIL','Váš e-mail:');
DEFINE('_SUBJECT_PROMPT',' Předmět zprávy:');
DEFINE('_BUTTON_SUBMIT_MAIL','Odeslat e-mail');
DEFINE('_BUTTON_CANCEL','Storno');
DEFINE('_EMAIL_ERR_NOINFO','E-mailové adresy musí být vyplněné a platné.');
DEFINE('_EMAIL_MSG',' Následující odkaz ze stránek "%s" vám odeslal %s ( %s ).

Můžete si jej zobrazit kliknutím na odkaz: 
%s');
DEFINE('_EMAIL_INFO','Položku odeslal uživatel');
DEFINE('_EMAIL_SENT','Položka byla odeslána uživateli');
DEFINE('_PROMPT_CLOSE','Zavřít okno');

/** classes/html/content.php */
DEFINE('_AUTHOR_BY', ' Příspěvek přidal');
DEFINE('_WRITTEN_BY', ' Napsal');
DEFINE('_LAST_UPDATED', 'Aktualizováno');
DEFINE('_BACK','[Zpět]');
DEFINE('_LEGEND','Legenda');
DEFINE('_DATE','Datum');
DEFINE('_ORDER_DROPDOWN','Řazení');
DEFINE('_HEADER_TITLE','Jméno položky');
DEFINE('_HEADER_AUTHOR','Autor');
DEFINE('_HEADER_SUBMITTED','Odesláno');
DEFINE('_HEADER_HITS','Shlédnutí');
DEFINE('_E_EDIT','Editovat');
DEFINE('_E_ADD','Přidat');
DEFINE('_E_WARNUSER','Buď stornujte nebo uložte provedené změny');
DEFINE('_E_WARNTITLE','Položka musí mít název');
DEFINE('_E_WARNTEXT','Položka musí mít úvodní text');
DEFINE('_E_WARNCAT','Prosím vyberte kategorii');
DEFINE('_E_CONTENT','Obsah');
DEFINE('_E_TITLE','Název:');
DEFINE('_E_CATEGORY','Kategorie:');
DEFINE('_E_INTRO','Úvodní text');
DEFINE('_E_MAIN','Hlavní text');
DEFINE('_E_MOSIMAGE','INSERT {mosimage}');
DEFINE('_E_IMAGES','Obrázky');
DEFINE('_E_GALLERY_IMAGES','Obrázky z galerie');
DEFINE('_E_CONTENT_IMAGES','Obrázky k obsahu');
DEFINE('_E_EDIT_IMAGE','Úprava obrázku');
DEFINE('_E_NO_IMAGE','Žádný obrázek');
DEFINE('_E_INSERT','Vložit');
DEFINE('_E_UP','Nahoru');
DEFINE('_E_DOWN','Dolů');
DEFINE('_E_REMOVE','Odstranit');
DEFINE('_E_SOURCE','Zdroj:');
DEFINE('_E_ALIGN','Zarovnání:');
DEFINE('_E_ALT','Alt text:');
DEFINE('_E_BORDER','Okraj:');
DEFINE('_E_CAPTION','Hlavička');
DEFINE('_E_CAPTION_POSITION','Pozice hlavičky');
DEFINE('_E_CAPTION_ALIGN','Zarovnání hlavičky');
DEFINE('_E_CAPTION_WIDTH','Šířka hlavičky');
DEFINE('_E_APPLY','Použít');
DEFINE('_E_PUBLISHING','Publikování');
DEFINE('_E_STATE','Stav:');
DEFINE('_E_AUTHOR_ALIAS','Alias autora:');
DEFINE('_E_ACCESS_LEVEL','Přístupová úroveň:');
DEFINE('_E_ORDERING','Třídění:');
DEFINE('_E_START_PUB','Zveřejnit od:');
DEFINE('_E_FINISH_PUB','Zveřejnit do:');
DEFINE('_E_SHOW_FP','Ukázat na Hlavní straně:');
DEFINE('_E_HIDE_TITLE','Skrýt jméno položky:');
DEFINE('_E_METADATA','Metadata');
DEFINE('_E_M_DESC','Popis:');
DEFINE('_E_M_KEY','Klíčová slova:');
DEFINE('_E_SUBJECT','Předmět:');
DEFINE('_E_EXPIRES','Datum zneplatnění:');
DEFINE('_E_VERSION','Verze:');
DEFINE('_E_ABOUT','O');
DEFINE('_E_CREATED','Vytvořeno:');
DEFINE('_E_LAST_MOD','Poslední aktualizace:');
DEFINE('_E_HITS','Zhlédnutí:');
DEFINE('_E_SAVE','Uložit');
DEFINE('_E_CANCEL','Storno');
DEFINE('_E_REGISTERED','Pouze pro registrované uživatele');
DEFINE('_E_ITEM_INFO','Informace o položce');
DEFINE('_E_ITEM_SAVED','Položka úspěšně uložena.');
DEFINE('_ITEM_PREVIOUS','&lt; Předch.');
DEFINE('_ITEM_NEXT','Další &gt;');
DEFINE('_KEY_NOT_FOUND','Klíč nebyl nalezen');


/** content.php */
DEFINE('_SECTION_ARCHIVE_EMPTY','V této sekci nejsou momentálně žádné archivované položky, zkuste to jindy');
DEFINE('_CATEGORY_ARCHIVE_EMPTY','V této kategorii nejsou momentálně žádné archivované položky, zkuste to jindy');
DEFINE('_HEADER_SECTION_ARCHIVE','Archivy sekcí');
DEFINE('_HEADER_CATEGORY_ARCHIVE','Archivy kategorií');
DEFINE('_ARCHIVE_SEARCH_FAILURE','V archivu nejsou položky pro %s %s');        // values are month then year
DEFINE('_ARCHIVE_SEARCH_SUCCESS','V archivu nalezené položky pro %s %s');        // values are month then year
DEFINE('_FILTER','Filtr');
DEFINE('_ORDER_DROPDOWN_DA','Datum vzest.');
DEFINE('_ORDER_DROPDOWN_DD','Datum sest.');
DEFINE('_ORDER_DROPDOWN_TA','Název vzest.');
DEFINE('_ORDER_DROPDOWN_TD','Název sest.');
DEFINE('_ORDER_DROPDOWN_HA','Návštěvy vzest.');
DEFINE('_ORDER_DROPDOWN_HD','Návštěvy sest.');
DEFINE('_ORDER_DROPDOWN_AUA','Autor vzest.');
DEFINE('_ORDER_DROPDOWN_AUD','Autor sest.');
DEFINE('_ORDER_DROPDOWN_O','Řazení');

/** poll.php */
DEFINE('_ALERT_ENABLED','Cookies musí být povoleny!');
DEFINE('_ALREADY_VOTE','Z tohoto počítače se dnes již hlasovalo!');
DEFINE('_NO_SELECTION','Nebyla vybrána žádná volba. Zkuste to znovu');
DEFINE("_THANKS","Děkujeme za Váš hlas!");
DEFINE("_SELECT_POLL","Vyberte si anketu ze seznamu");

/** classes/html/poll.php */
DEFINE('_JAN','Leden');
DEFINE('_FEB','Únor');
DEFINE('_MAR','Březen');
DEFINE('_APR','Duben');
DEFINE('_MAY','Květen');
DEFINE('_JUN','Červen');
DEFINE('_JUL','Červenec');
DEFINE('_AUG','Srpen');
DEFINE('_SEP','Září');
DEFINE('_OCT','Říjen');
DEFINE('_NOV','Listopad');
DEFINE('_DEC','Prosinec');
DEFINE('_POLL_TITLE','Ankety - Výsledky');
DEFINE('_SURVEY_TITLE','Hlasování:');
DEFINE('_NUM_VOTERS','Počet hlasujících:');
DEFINE('_FIRST_VOTE','První hlas');
DEFINE('_LAST_VOTE','Poslední hlas');
DEFINE('_SEL_POLL','Vybraná anketa:');
DEFINE('_NO_RESULTS','Pro tuto anketu ještě nejsou výsledky.');

/** registration.php */
DEFINE('_ERROR_PASS','Příslušný uživatel nenalezen');
DEFINE('_NEWPASS_MSG','Uživatelský účet $checkusername má přiřazen tento e-mail.\n'
.'Uživatel z $mosConfig_live_site požádal o zaslání nového hesla.\n\n'
.' Nové heslo je : $newpass\n\nPokud nebylo nové heslo žádáno, neznepokojujte se.'
.' Pokud to je chyba, přihlašte se s použitím'
.' vašeho nového hesla a pak jej změňte na to, které má být nastaveno.');
DEFINE('_NEWPASS_SUB','$_sitename :: Nové heslo pro - $checkusername');
DEFINE('_NEWPASS_SENT','Nové heslo vytvořeno a zasláno!');
DEFINE('_REGWARN_NAME','Prosím zadejte vaše jméno.');
DEFINE('_REGWARN_UNAME','Zadejte prosím uživatelské jméno.');
DEFINE('_REGWARN_MAIL','Zadejte prosím platný e-mail.');
DEFINE('_REGWARN_PASS','Prosím zadejte platné heslo.  Bez mezer, více než 6 znaků a obsahující 0-9,a-z,A-Z');
DEFINE('_REGWARN_VPASS1','Prosím zadejte heslo znovu.');
DEFINE('_REGWARN_VPASS2','Zadaná hesla se neshodují, zkuste to znovu.');
DEFINE('_REGWARN_INUSE','Toto uživatelské jméno a heslo se již používá. Vyberte jiné.');
DEFINE('_REGWARN_EMAIL_INUSE', 'Tento e-mail je již zaregistrován. Pokud neznáte heslo, klikněte na "Zapomenuté heslo" a bude vám zasláno nové.');
DEFINE('_SEND_SUB','Informace o účtu pro %s na %s');
DEFINE('_USEND_MSG_ACTIVATE', 'Vítejte uživateli %s,

Děkujeme za registraci na %s. Váš účet je vytvořen a před prvním použitím jej musíte aktivovat.
Pro aktivaci klikněte na následující odkaz nebo jej zkopírujte do prohlížeče:
%s

Po aktivaci se můžete přihlásit na %s použitím uživatelského jména a hesla:

Uživatelské jméno - %s
Heslo - %s');
DEFINE('_USEND_MSG', "Vítejte %s,

Děkujeme za registraci na %s.

Můžete se přihlásit na %s použitím uživatelského jména a hesla zadaných při registraci.");
DEFINE('_USEND_MSG_NOPASS','Vítejte uživateli $name,\n\nByla provedena registrace na $mosConfig_live_site.\n'
.'Můžete se přihlásit na $mosConfig_live_site použitím uživatelského jména a hesla zadaných při registraci.\n\n'
.'Prosíme, neodpovídejte na tuto zprávu, je generována automaticky a má pouze informační charakter\n');
DEFINE('_ASEND_MSG','Vítejte %s,

Na %s se zaregistroval nový uživatel.
Tento email obsahuje informace o něm:

Jméno - %s
e-mail - %s
Uživatelské jméno - %s

Prosíme, neodpovídejte na tuto zprávu, je generována automaticky a má pouze informační charakter');
DEFINE('_REG_COMPLETE_NOPASS','<div class="componentheading">Registrace je kompletní!</div><br />&nbsp;&nbsp;'
.'Nyní se můžete přihlásit.<br />&nbsp;&nbsp;');
DEFINE('_REG_COMPLETE', '<div class="componentheading">Registrace je kompletní!</div><br />Nyní se můžete přihlásit.');
DEFINE('_REG_COMPLETE_ACTIVATE', '<div class="componentheading">Registrace je kompletní!</div><br />Účet byl vytvořen a aktivační odkaz byl odeslán na e-mail zadaný při registraci. Pro zaktivování musíte kliknout na odkaz došlý v e-mailu, jinak nebude možné se přihlásit.');
DEFINE('_REG_ACTIVATE_COMPLETE', '<div class="componentheading">Aktivace byla dokončena!</div><br />Váš účet byl úspěšně aktivován. Můžete se přihlásit použitím uživatelského jména a hesla zadaných při registraci.');
DEFINE('_REG_ACTIVATE_NOT_FOUND', '<div class="componentheading">Špatný aktivační odkaz!</div><br />Takový účet databáze neobsahuje nebo je aktivace již provedena.');
DEFINE('_REG_ACTIVATE_FAILURE', '<div class="componentheading">Aktivace selhala!</div><br />Systém nemůže aktivovat Váš účet. Kontaktujte prosím administrátora.');

/** classes/html/registration.php */
DEFINE('_PROMPT_PASSWORD','Zapomenuté heslo?');
DEFINE('_NEW_PASS_DESC','Zadejte prosím uživatelské jméno a e-mail, pak klikněte na tlačítko Poslat heslo.<br />'
.'Vaše heslo obdržíte obratem.  Použijte jej k přihlášení na stránky.');
DEFINE('_PROMPT_UNAME','Uživatelské jméno:');
DEFINE('_PROMPT_EMAIL','E-mail:');
DEFINE('_BUTTON_SEND_PASS','Poslat heslo');
DEFINE('_REGISTER_TITLE','Registrace');
DEFINE('_REGISTER_NAME','Jméno:');
DEFINE('_REGISTER_UNAME','Uživatelské jméno:');
DEFINE('_REGISTER_EMAIL','E-mail:');
DEFINE('_REGISTER_PASS','Heslo:');
DEFINE('_REGISTER_VPASS','Heslo znovu:');
DEFINE('_REGISTER_REQUIRED','Pole označená hvězdičkou (*) jsou povinná.');
DEFINE('_BUTTON_SEND_REG','Odeslat registraci');
DEFINE('_SENDING_PASSWORD','Vaše heslo bude zasláno na zadaný e-mail.<br />Poté co jej obdržíte se můžete'
.' jeho pomocí přihlásit a pak jej případně změnit.');

/** classes/html/search.php */
DEFINE('_SEARCH_TITLE','Hledání');
DEFINE('_PROMPT_KEYWORD','Pro hledané klíčové slovo');
DEFINE('_SEARCH_MATCHES','bylo nalezeno %d výskytů.');
DEFINE('_CONCLUSION','Celkem bylo prohledáno $totalRows řádků.  Hledám <b>$searchword</b> s pomocí');
DEFINE('_NOKEYWORD','Nic nebylo nalezeno');
DEFINE('_IGNOREKEYWORD','Jedno nebo více obecných slov bylo při hledání ignorováno');
DEFINE('_SEARCH_ANYWORDS','Jakékoliv slovo');
DEFINE('_SEARCH_ALLWORDS','Všechna slova');
DEFINE('_SEARCH_PHRASE','Přesná fráze');
DEFINE('_SEARCH_NEWEST','Nejnovější nejdříve');
DEFINE('_SEARCH_OLDEST','Nejstarší nejdříve');
DEFINE('_SEARCH_POPULAR','Nejpopulárnější');
DEFINE('_SEARCH_ALPHABETICAL','Abecedně');
DEFINE('_SEARCH_CATEGORY','Sekce/Kategorie');
DEFINE('_SEARCH_MESSAGE','Hledaný pojem musí být od 3 do 20 znaků');
DEFINE('_SEARCH_ARCHIVED','Archivováno');
DEFINE('_SEARCH_CATBLOG','Kategorie Blogu');
DEFINE('_SEARCH_CATLIST','Seznam Kategorií');
DEFINE('_SEARCH_NEWSFEEDS','Sledování novinek');
DEFINE('_SEARCH_SECLIST','Seznam Sekcí');
DEFINE('_SEARCH_SECBLOG','Sekce Blogu');


/** templates/*.php */
DEFINE('_ISO','charset=utf-8');
DEFINE('_DATE_FORMAT','l, F d Y');  //Použít PHP funkci DATE
/**
* Změnte následující řádek pro nastavení formátu data na vašich stránkách
*
* např.DEFINE("_DATE_FORMAT_LC","%A, %d %B %Y %H:%M"); //Použít PHP příkaz strftime
*/
DEFINE("_DATE_FORMAT_LC","%A, %d %B %Y"); //Použít PHP příkaz strftime
DEFINE("_DATE_FORMAT_LC2","%A, %d %B %Y %H:%M");
DEFINE('_SEARCH_BOX','hledat...');
DEFINE('_NEWSFLASH_BOX','Novinky!');
DEFINE('_MAINMENU_BOX','Hlavní nabídka');

/** classes/html/usermenu.php */
DEFINE('_UMENU_TITLE','Uživatelská nabídka');
DEFINE('_HI','Přihlášen ');

/** user.php */
DEFINE('_SAVE_ERR','Prosím vyplňte všechna pole.');
DEFINE('_THANK_SUB','Děkujeme za Váš příspěvek, který bude před zveřejněním prohlédnut.');
DEFINE('_THANK_SUB_PUB','Děkujeme za Váš příspěvek.');
DEFINE('_UP_SIZE','Nemůžete posílat soubory větší než 15kb.');
DEFINE('_UP_EXISTS','Obrázek $userfile_name již existuje. Přejmenujte soubor a zkuste to znovu.');
DEFINE('_UP_COPY_FAIL','Chyba při kopírování');
DEFINE('_UP_TYPE_WARN','Můžete posílat soubory typu gif nebo jpg.');
DEFINE('_MAIL_SUB','Údaje o novém uživateli odeslány');
DEFINE('_MAIL_MSG','Nový uživatel $type, $title, byl zaslán uživatelem $author'
.' na stránky $mosConfig_live_site.\n'
.'Prosím navštivte stránku $mosConfig_live_site/administrator a schvalte zadané $type.\n\n'
.'Na tento mail neodpovídejte, byl strojově vygenerován jen pro informační účel\n');
DEFINE('_PASS_VERR1','Pokud měníte své heslo, zadejte jej znovu pro ověření.');
DEFINE('_PASS_VERR2','Pokud měníte své heslo ujistěte se, že se heslo a ověření shodují.');
DEFINE('_UNAME_INUSE','Toto uživatelské jméno se již používá.');
DEFINE('_UPDATE','Aktualizovat');
DEFINE('_USER_DETAILS_SAVE','Vaše nastavení byla uložena.');
DEFINE('_USER_LOGIN','Přihlášení');

/** components/com_user */
DEFINE('_EDIT_TITLE','Upravit vaše údaje');
DEFINE('_YOUR_NAME','Vaše jméno:');
DEFINE('_EMAIL','e-mail:');
DEFINE('_UNAME','Uživatelské jméno:');
DEFINE('_PASS','Heslo:');
DEFINE('_VPASS','Ověření hesla:');
DEFINE('_SUBMIT_SUCCESS','Odeslání bylo úspěšné!');
DEFINE('_SUBMIT_SUCCESS_DESC','Váš příspěvek byl odeslán administrátorovi. Před zveřejněním bude prohlédnut.');
DEFINE('_WELCOME','Vítejte!');
DEFINE('_WELCOME_DESC','Vítejte v uživatelské sekci našich stránek');
DEFINE('_CONF_CHECKED_IN','Všechny položky ke kontrole byly zkontrolovány');
DEFINE('_CHECK_TABLE','Kontroluji tabulku');
DEFINE('_CHECKED_IN','Zkontrolováno ');
DEFINE('_CHECKED_IN_ITEMS',' položek');
DEFINE('_PASS_MATCH','Hesla nejsou shodná');

/** components/com_banners */
DEFINE('_BNR_CLIENT_NAME','Musíte vybrat jméno pro klienta.');
DEFINE('_BNR_CONTACT','Musíte vybrat kontakt na klienta.');
DEFINE('_BNR_VALID_EMAIL','Musíte vybrat platný e-mail klienta.');
DEFINE('_BNR_CLIENT','Musíte vybrat klienta.,');
DEFINE('_BNR_NAME','Musíte vybrat jméno pro banner.');
DEFINE('_BNR_IMAGE','Musíte vybrat obrázek pro banner.');
DEFINE('_BNR_URL','Musíte vybrat URL/Kód pro banner.');

/** components/com_login */
DEFINE('_ALREADY_LOGIN','Uživatel je již přihlášen!');
DEFINE('_LOGOUT','Klikněte zde pro odhlášení');
DEFINE('_LOGIN_TEXT','Použijte pole pro přihlášení a heslo pro získání plného přístupu');
DEFINE('_LOGIN_SUCCESS','Přihlášení proběhlo úspěšné!');
DEFINE('_LOGOUT_SUCCESS','Odhlášení proběhlo úspěšně!');
DEFINE('_LOGIN_DESCRIPTION','Pro přístup do uživatelské oblasti se musíte nejdříve přihlásit!');
DEFINE('_LOGOUT_DESCRIPTION','Jste přihlášeni v uživatelské oblasti webu.');


/** components/com_weblinks */
DEFINE('_WEBLINKS_TITLE','Odkazy');
DEFINE('_WEBLINKS_DESC','Pravidelně se pohybujeme na internetu. Poku najdeme zajímavý odkaz,'
.' zveřejníme jej zde.  <br />Z následujícího seznamu si vyberte kategorii, pak si vyberte přímo odkaz, který chcete navštívit.');
DEFINE('_HEADER_TITLE_WEBLINKS','Odkazy');
DEFINE('_SECTION','Sekce:');
DEFINE('_SUBMIT_LINK','Zaslat nový odkaz');
DEFINE('_URL','URL:');
DEFINE('_URL_DESC','Popis:');
DEFINE('_NAME','Jméno:');
DEFINE('_WEBLINK_EXIST','Tento odkaz zde již existuje, zkuste jej zadat znovu.');
DEFINE('_WEBLINK_TITLE','Vámi vložený odkaz musí mít jméno.');

/** components/com_newfeeds */
DEFINE('_FEED_NAME','Novinky');
DEFINE('_FEED_ARTICLES','Počet článků');
DEFINE('_FEED_LINK','Odkaz na zprávy');

/** whos_online.php */
DEFINE('_WE_HAVE', '<!--Právě zde je/jsou<br />-->');
DEFINE('_AND', ' a ');
DEFINE('_GUEST_COUNT','%s host');
DEFINE('_GUESTS_COUNT','%s hosté');
DEFINE('_MEMBER_COUNT','%s člen');
DEFINE('_MEMBERS_COUNT','%s členové');
DEFINE('_ONLINE','<!-- online-->');
DEFINE('_NONE','Žádní uživatelé online');

/** modules/mod_banners */
DEFINE('_BANNER_ALT','Reklama');

/** modules/mod_random_image */
DEFINE('_NO_IMAGES','Žádné obrázky');

/** modules/mod_stats.php */
DEFINE('_TIME_STAT','Čas');
DEFINE('_MEMBERS_STAT','Členů');
DEFINE('_HITS_STAT','Přístupů');
DEFINE('_NEWS_STAT','Reportů');
DEFINE('_LINKS_STAT','Odkazů');
DEFINE('_VISITORS','Přístupů');

/** /adminstrator/components/com_menus/admin.menus.html.php */
DEFINE('_MAINMENU_HOME','* První publikovaná položka v tomto menu [mainmenu] je implicitně domovskou stránkou tohoto webu *');
DEFINE('_MAINMENU_DEL','* Toto menu nemůžete smazat, protože je vyžadováno pro správný chod mamba *');
DEFINE('_MENU_GROUP','* Některé typy menu se vyskytují ve více skupinách *');


/** administrators/components/com_users */
DEFINE('_NEW_USER_MESSAGE_SUBJECT', 'Nové detaily uživatele' );
DEFINE('_NEW_USER_MESSAGE', 'Ahoj %s,


Byl jste přidán administrátorem jako uživatel na %s.

Tento e-mail obsahuje Vaše uživatelské jméno a heslo pro přístup na %s:

jméno - %s
heslo - %s


Prosíme, neodpovídejte na tuto zprávu, je generována automaticky a má pouze informační charakter.');

/** administrators/components/com_massmail */
DEFINE('_MASSMAIL_MESSAGE', "Toto je zpráva z '%s'

Zpráva:
" );


/** includes/pdf.php */
DEFINE('_PDF_GENERATED','Generováno:');
DEFINE('_PDF_POWERED','Vytvořeno pomocí Joomla!');
?>
