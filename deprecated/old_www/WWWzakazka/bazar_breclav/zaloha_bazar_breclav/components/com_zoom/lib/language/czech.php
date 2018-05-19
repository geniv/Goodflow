<?php
//zOOm Media Gallery//
/** 
-----------------------------------------------------------------------
|  zOOm Media Gallery! by Mike de Boer - a multi-gallery component    |
-----------------------------------------------------------------------

-----------------------------------------------------------------------
|                                                                     |
| Author: Mike de Boer, <http://www.mikedeboer.nl>                    |
| Copyright: copyright (C) 2004 by Mike de Boer                       |
| Description: zOOm Media Gallery, a multi-gallery component for      |
|              Joomla!. It's the most feature-rich gallery component  |
|              for Joomla!! For documentation and a detailed list     |
|              of features, check the zOOm homepage:                  |
|              http://www.zoomfactory.org                             |
| License: GPL                                                        |
| Filename: czech1250.php                                               |
|                                                                     |
-----------------------------------------------------------------------
* @package zOOm Media Gallery
* @author Mike de Boer <mailme@mikedeboer.nl> 
**/
// MOS Intruder Alerts
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
//Language translation
define("_ZOOM_DATEFORMAT","%d.%m.%Y %H:%M"); // use the PHP strftime Format, more info at http://www.php.net
define("_ZOOM_ISO","utf-8");
define("_ZOOM_PICK","Vyberte galerii");
define("_ZOOM_DELETE","Smazat");
define("_ZOOM_BACK","Zpet");
define("_ZOOM_MAINSCREEN","Hlavní obrazovka");
define("_ZOOM_BACKTOGALLERY","Zpet do galerie");
define("_ZOOM_INFO_DONE","hotovo!");
define("_ZOOM_TOOLTIP", "zOOm Tip");
define("_ZOOM_WARNING", "zOOm Upozornění!");

//Gallery admin page
define("_ZOOM_ADMINSYSTEM","Admin System");
define("_ZOOM_USERSYSTEM","User System");
define("_ZOOM_ADMIN_TITLE","Administrátorská sekce galerie");
define("_ZOOM_USER_TITLE","Uživatelská sekce galerie");
define("_ZOOM_CATSMGR","Manažer gelerií");
define("_ZOOM_CATSMGR_DESCR","vytvořit nové galerie pro fotografie, vytvářet a mazat je můžete zde v Manažeru galerií.");
define("_ZOOM_SETTINGS_DDONOF","Enable Drag n Drop");
define("_ZOOM_NEW","Nová galerie");
define("_ZOOM_DEL","Smazat galerii");
define("_ZOOM_MEDIAMGR","Manažer médií");
define("_ZOOM_MEDIAMGR_DESCR","editovat, mazat, prohlédnout média automaticky nebo nahrát (multiple) nová média manuálně.");
define("_ZOOM_THUMB", "Zoom Thumb Coder");
define("_ZOOM_THUMB_DESCR", "Compute your Zoom Thumb codes easily");
define("_ZOOM_UPLOAD","Nahrát obrázky");
define("_ZOOM_EDIT","Editovat galerii");
define("_ZOOM_ADMIN_CREATE","Vytvořit databázi");
define("_ZOOM_ADMIN_CREATE_DESCR","sestavení požadované databázové tabulky abys mohl začít s použitím galerií");
define("_ZOOM_HD_PREVIEW","Náhled");
define("_ZOOM_HD_CHECKALL","Označit/Zrušit označení všech");
define("_ZOOM_HD_CREATEDBY","Vytvořil");
define("_ZOOM_HD_AFTER","Vložit za");
define("_ZOOM_HD_HIDEMSG","Schovat 'žádné obrázky' text");
define("_ZOOM_HD_NAME","Jméno galerie");
define("_ZOOM_HD_DIR","Adresář");
define("_ZOOM_HD_NEW","Nová galerie");
define("_ZOOM_HD_SHARE","Sdílet tuto galerii");
define("_ZOOM_SHARE","Sdílet");
define("_ZOOM_UNSHARE","Nesdílet");
define("_ZOOM_PUBLISH","Publikovat");
define("_ZOOM_UNPUBLISH","Nepublikovat");
define("_ZOOM_TOPLEVEL","Top level");
define("_ZOOM_HD_UPLOAD","Nahrát obrázek");
define("_ZOOM_A_ERROR_ERRORTYPE","Typ chyby");
define("_ZOOM_A_ERROR_IMAGENAME","Jméno obrázku");
define("_ZOOM_A_ERROR_NOFFMPEG","<u>FFmpeg</u> nenalezen");
define("_ZOOM_A_ERROR_NOPDFTOTEXT","<u>PDFtoText</u> nenalezen");
define("_ZOOM_A_ERROR_NOTINSTALLED","Nenainstalován");
define("_ZOOM_A_ERROR_CONFTODB","Chyba při ukládání konfigurace do databáze!");
define("_ZOOM_A_MESS_NOT_SHURE","* Pokud si nejsi jistý, použij defaultní \"auto\" ");
define("_ZOOM_A_MESS_SAFEMODE1","Note: \"Safe Mode\" je aktivovaný, proto není vyloučeno, že uploady vetších souborů nebudou pracovat!<br />zOOm doporučuje aktivovat FTP - Mode v administraci systému.");
define("_ZOOM_A_MESS_SAFEMODE2","Note: \"Safe Mode\" je aktivovaný, proto není vyloučeno, že uploady vetších souborů nebudou pracovat!<br />zOOm doporučuje aktivovat FTP - Mode v administraci systému.");
define("_ZOOM_A_MESS_PROCESSING_FILE","Zpracovávám soubor...");
define("_ZOOM_A_MESS_NOTOPEN_URL","Nelze otevrít url:");
define("_ZOOM_A_MESS_PARSE_URL","Analýza \"%s\" obrázku... "); // %s = $url
define("_ZOOM_A_MESS_NOJAVA","Pokud vidíš jen šedý box, nebo máš potíže s uploadem, muže to být tím, že<br />nemáš instalován poslední java run-time. Jdi na <a href=\"http://www.java.com\" target=\"_blank\">Java.com</a> <br /> a stáhni si poslední verzi.");
define("_ZOOM_SETTINGS","Nastavení");
define("_ZOOM_SETTINGS_DESCR","zde mužeš menit všechna konfiguracní nastavení.");
define("_ZOOM_SETTINGS_TAB1","Systém");
define("_ZOOM_SETTINGS_TAB2","Media");
define("_ZOOM_SETTINGS_TAB3","Features");
define("_ZOOM_SETTINGS_TAB4","Layout");
define("_ZOOM_SETTINGS_TAB5","Watermarks");
define("_ZOOM_SETTINGS_TAB6","Safe Mode");
define("_ZOOM_SETTINGS_TAB7","Accessibility");
define("_ZOOM_SETTINGS_TAB8","Reset");
define("_ZOOM_SETTINGS_ERASE","Click to wipe all zoom gallery data and start anew. This resets settings and removes all images.");
define("_ZOOM_SETTINGS_CONVTYPE","Typ převodu");
define("_ZOOM_SETTINGS_GALLERY_FEATURES","Gallery View Features");
define("_ZOOM_SETTINGS_VIEW_FEATURES","Media View Features");

define("_ZOOM_SETTINGS_GALLERY","Gallery View");
define("_ZOOM_SETTINGS_VIEW","Media View");

define("_ZOOM_SETTINGS_GENERAL_FEATURES","General Features");
define("_ZOOM_SETTINGS_AUTODET","auto-detected: ");
define("_ZOOM_SETTINGS_IMGPATH","Cesta k media-files:");
define("_ZOOM_SETTINGS_TTIMGPATH","Current path to media is ");
define("_ZOOM_SETTINGS_CONVSETTINGS","Nastavení konverze obrázku:");
define("_ZOOM_SETTINGS_IMPATH","Cesta k ImageMagick: ");
define("_ZOOM_SETTINGS_NETPBMPATH"," nebo NetPBM: ");
define("_ZOOM_SETTINGS_FFMPEGPATH","Cesta k FFmpeg");
define("_ZOOM_SETTINGS_FFMPEGTOOLTIP","FFmpeg je nutný k vytvoření thumbnailu tvých video souborů.<br />Podporované typy jsou: ");
define("_ZOOM_SETTINGS_OVERRIDE_FFMPEG","Use FFmpeg, even if zOOm is unable to verify its existence on this system.");
define("_ZOOM_SETTINGS_PDFTOTEXTPATH","Path to PDFtoText");
define("_ZOOM_SETTINGS_XPDFTOOLTIP","pdf2text, which is part of the Xpdf package, is required for PDF file indexing.");
define("_ZOOM_SETTINGS_OVERRIDE_PDF","Use PDFtoText, even if zOOm is unable to verify its existence on this system.");
define("_ZOOM_SETTINGS_MAXSIZE","Max. velikost obrázku: ");
define("_ZOOM_SETTINGS_MAXSIZEKB","Medium - including images - max. size (in kB): "); //added: 08-08-2006
define("_ZOOM_SETTINGS_MAXSIZEKB_WARNING","The upload limit of this server, set by you ISP as part of the PHP configuration, is %s.<br />Thus, setting the limit higher than this value will have NO use!"); //added: 09-01-2006
define("_ZOOM_SETTINGS_THUMBSETTINGS","Nastavení thumbnailu:");
define("_ZOOM_SETTINGS_QUALITY","NetPBM a GD2 JPEG kvalita: ");
define("_ZOOM_SETTINGS_SIZE","Max. velikost thumbnailu: ");
define("_ZOOM_SETTINGS_TEMPNAME","Temp Název: ");
define("_ZOOM_SETTINGS_AUTONUMBER","auto-number jmen obrázku (napr. 1,2,3)");
define("_ZOOM_SETTINGS_TEMPDESCR","Temp Popis: ");
define("_ZOOM_SETTINGS_TITLE","Název galerie:");
define("_ZOOM_SETTINGS_SUBCATSPG","Počet sloupců (sub-)galerií");
define("_ZOOM_SETTINGS_COLUMNS","Počet sloupců thumbnailu");
define("_ZOOM_SETTINGS_THUMBSPG","thumbnailů na stránku");
define("_ZOOM_SETTINGS_CMTLENGTH","Max. délka komentáře");
define("_ZOOM_SETTINGS_CHARS","znaků");
define("_ZOOM_SETTINGS_GALLERYPREFIX","Prefix názvu gallerie ");
define("_ZOOM_SETTINGS_SHOWOCCSPACE","Ukaž použité místo v Media Manageru");
define("_ZOOM_SETTINGS_TEMPLATE_TITLE","Template");
define("_ZOOM_SETTINGS_FEATURES_TITLE","Vlastnosti ANO/NE");
define("_ZOOM_SETTINGS_CSS_TITLE","Editace stylu");
define("_ZOOM_SETTINGS_DISPLAY_TITLE","Zobrazovat data ANO/NE");
define("_ZOOM_SETTINGS_TEMPLATE_CHOOSE","Select a template to define the look &amp; feel of your gallery");
define("_ZOOM_SETTINGS_TEMPLATE_TABLES","Classic (with tables)");
define("_ZOOM_SETTINGS_TEMPLATE_TABLELESS","Modern (tableless design)");
define("_ZOOM_SETTINGS_COMMENTS","Komentáře");
define("_ZOOM_SETTINGS_POPUP","PopUp Media");
define("_ZOOM_SETTINGS_CATIMG","Zobrazit obrázek kategorie");
define("_ZOOM_SETTINGS_SLIDESHOW","Slideshow");
define("_ZOOM_SETTINGS_ZOOMLOGO","Zobrazit zOOm-logo");
define("_ZOOM_SETTINGS_SHOWHITS","Zobrazit počet. hitů");
define("_ZOOM_SETTINGS_READEXIF","Načíst EXIF-data");
define("_ZOOM_SETTINGS_EXIFTOOLTIP","Tato vlastnost zobrazí dodatečná EXIF a další IPTC data, bez potřeby mít EXIF jednotku pro PHP nainstalovanou na vašem systému.");
define("_ZOOM_SETTINGS_READID3","Nacíst mp3 ID3-data");
define("_ZOOM_SETTINGS_ID3TOOLTIP","Tato vlastnost zobrazí dodatečný ID3 v1.1 a v2.0 data pro prohlížení detailu mp3 souboru.");
define("_ZOOM_SETTINGS_RATING","Rating");
define("_ZOOM_SETTINGS_CSS","Styl popup okna");
define("_ZOOM_SETTINGS_CSSZOOM","zOOm gallery &amp; medium view");
define("_ZOOM_SETTINGS_SUCCESS","Konfigurace byla aktualizována!");
define("_ZOOM_SETTINGS_ZOOMING","Zoom obrázku");
define("_ZOOM_SETTINGS_ORDERBY","Metoda uspořádání thumbnailů; řadit podle");
define("_ZOOM_SETTINGS_CATORDERBY","Metoda usporádání (sub-)Galerií; radit podle");
define("_ZOOM_SETTINGS_DATE_ASC","DATUM, vzestupně");
define("_ZOOM_SETTINGS_DATE_DESC","DATUM, sestupně");
define("_ZOOM_SETTINGS_FLNM_ASC","FILENAME, vzestupně");
define("_ZOOM_SETTINGS_FLNM_DESC","FILENAME, sestupně");
define("_ZOOM_SETTINGS_NAME_ASC","JMÉNO, vzestupně");
define("_ZOOM_SETTINGS_NAME_DESC","JMÉNO, sestupně");
define("_ZOOM_SETTINGS_LBTOOLTIP","A lightbox is like a shopping cart filled with user-selected media, which may be downloaded as a ZIP file.");
define("_ZOOM_SETTINGS_SHOWNAME","Display Name");
define("_ZOOM_SETTINGS_SHOWDESCR","Display description");
define("_ZOOM_SETTINGS_SHOWKEYWORDS","Display keywords");
define("_ZOOM_SETTINGS_SHOWDATE","Zobrazit datum");
define("_ZOOM_SETTINGS_SHOWUNAME","Zobrazit jméno");
define("_ZOOM_SETTINGS_SHOWFILENAME","Zobrazit jméno souboru");
define("_ZOOM_SETTINGS_METABOX","Zobrazit plovoucí box s detaily na stránce galerie");
define("_ZOOM_SETTINGS_METABOXTOOLTIP","Nezatržené zvětší rychlost vaší galerie. Účinný s velkými databázemi.");
define("_ZOOM_SETTINGS_ECARDS","E-cards");
define("_ZOOM_SETTINGS_ECARDS_LIFETIME","E-cards existence");
define("_ZOOM_SETTINGS_ECARDS_ONEWEEK","týden");
define("_ZOOM_SETTINGS_ECARDS_TWOWEEKS","dva týdny");
define("_ZOOM_SETTINGS_ECARDS_ONEMONTH","měsíc");
define("_ZOOM_SETTINGS_ECARDS_THREEMONTHS","tři měsíce");
define("_ZOOM_SETTINGS_SHOWSEARCH","Hledání na všech stránkách");
define("_ZOOM_SETTINGS_BOX_ANIMATE","Animovat okna");
define("_ZOOM_SETTINGS_BOX_PROPERTIES","Vlastnosti v zobrazených oknech");
define("_ZOOM_SETTINGS_BOX_META","Metadata v zobrazených oknech");
define("_ZOOM_SETTINGS_BOX_COMMENTS","Komentáře v zobrazených oknech");
define("_ZOOM_SETTINGS_BOX_RATING","Hodnocení v zobrazených oknech");
define("_ZOOM_SETTINGS_TOPTEN","Zobrazit \"10 nej\" na hlavní straně");
define("_ZOOM_SETTINGS_LASTSUBM","Zobrazit \"Poslední nahrané soubory\" na hlavní straně");
define("_ZOOM_SETTINGS_SETMENUOPTION","Zobrazit \"Upload Media\" v uživatelském menu");
define("_ZOOM_SETTINGS_USEFTP","Použít FTP mode?");
define("_ZOOM_SETTINGS_FTPHOST","Host jméno");
define("_ZOOM_SETTINGS_FTPUNAME","Uživatel jméno");
define("_ZOOM_SETTINGS_FTPPASS","Heslo");
define("_ZOOM_SETTINGS_FTPWARNING","Varování: Heslo není uloženo zabezpečeně!");
define("_ZOOM_SETTINGS_FTPHOSTDIR","Hostitelský adresář");
define("_ZOOM_SETTINGS_MESS_FTPHOSTDIR","Prosím určete cestu k Joomle z vašeho ftp- rootu. DŮLEŽITÉ: Konec <b>bez</b> lomítka nebo obráceného lomítka!");
define("_ZOOM_SETTINGS_GROUP","Skupina");
define("_ZOOM_SETTINGS_PRIV_DESCR","Máš možnost změnit přístupová práva pro každou skupinu se kterou Joomla! pracuje. <br />
    Uživatel teoreticky může dělat následující akce: nahrát soubory, upravovat/mazat soubory, vytvářet/upravovat/mazat (sdílené) galerie.<br />
	Co skutecně bude a nebude moct dělat je opravdu na Tobě.");
define("_ZOOM_SETTINGS_CLOSE","Zobrazit \"Zavřít\" v popup okně");
define("_ZOOM_SETTINGS_MAINSCREEN","Zobrazit odkaz na Hlavní stranu v navigační lište");
define("_ZOOM_SETTINGS_NAVBUTTONS","Zobrazit navigacní tlačítka v popup okně");
define("_ZOOM_SETTINGS_PROPERTIES","Zobrazit vlastnosti pod obrázkem/souborem");
define("_ZOOM_SETTINGS_MEDIAFOUND","Zobrazit text \"Nalezená média\" v galerii");
define("_ZOOM_SETTINGS_ANONYMOUS_COMMENTS","Allow anonymous comment");
define("_ZOOM_SETTINGS_WM_ENABLE_TITLE","Enable Feature");
define("_ZOOM_SETTINGS_WM_TITLE", "Your watermarks");
define("_ZOOM_SETTINGS_WM_DESCR", "Your watermark appears on top of your images on this website. "
 . "The image will still be visible, but visitors will not be tempted to copy or print it."
 . "<br /><br />Suggestion: you can use your company logo as a watermark. "
 . "Please make sure that you set the background of the watermark image to be transparent!");
define("_ZOOM_SETTINGS_WM_IMG", "Image");
define("_ZOOM_SETTINGS_WM_NOWATERMARKS", "No watermarks found. You may upload a new watermark below.");
define("_ZOOM_SETTINGS_WM_PLACEMENT_TITLE", "Placement");
define("_ZOOM_SETTINGS_WM_PLACEMENT_DESCR", "You can define the position of the watermark on the target-image by "
 . "selecting one of the positions in the grey box below.");
define("_ZOOM_SETTINGS_WM_FILE","Upload watermark");
define("_ZOOM_SETTINGS_WM_UPLOAD_SUCCESS","Watermark successfully uploaded!");
define("_ZOOM_SETTINGS_WM_UPLOAD_FAIL","Watermark upload failed.");
define("_ZOOM_SETTINGS_WM_DEL_SUCCESS","Watermark deleted successfully!");
define("_ZOOM_SETTINGS_WM_DEL_FAIL","Watermark could not be deleted.");
define("_ZOOM_SYSTEM_TITLE","Systémové nastavení");
define("_ZOOM_YES","ano");
define("_ZOOM_NO","ne");
define("_ZOOM_VISIBLE","viditelný");
define("_ZOOM_HIDDEN","skrytý");
define("_ZOOM_SAVE","Uložit");
define("_ZOOM_MOVEFILES","Přesunout obrázky");
define("_ZOOM_BUTTON_MOVE","Přesunout");
define("_ZOOM_MOVEFILES_STEP1","Zvolte cílovou galerii & přesuňte obrázky");
define("_ZOOM_ALERT_MOVE","%s bylo úspěšně přesunuto, %s souborů přesunuto nebylo.");
define("_ZOOM_OPTIMIZE","Přizpůsobit tabulky");
define("_ZOOM_OPTIMIZE_DESCR","zOOm galerie užívá své tabulky hodně a tak vytváří režijní data, např. ' použitá data' . Klikněte zde pro odstranění tohoto odpadu.");
define("_ZOOM_OPTIMIZE_SUCCESS","Tabulky zOOm Media Gallery byly otimalizovány!");
define("_ZOOM_UPDATE","Aktualizovat zOOm Media Gallery");
define("_ZOOM_UPDATE_DESCR","přidejte nové vlastnosti, řešte problémy a vyřešte chyby! Navštivte <a href=\"http://www.zoomfactory.org\" target=\"_blank\">www.zoomfactory.org</a> pro poslední aktualizace!");
define("_ZOOM_UPDATE_XMLDATE","Datum poslední aktualizace");
define("_ZOOM_UPDATE_NOUPDATES","doposud žádné úpravy!"); // added 11-08
define("_ZOOM_UPDATE_PACKAGE","Aktualizovat soubor ZIP: ");
define("_ZOOM_CREDITS","About zOOm Media Gallery &amp; Credits");

//Image actions
define("_ZOOM_DISKSPACEUSAGE","Právě je použito %s");
define("_ZOOM_UPLOAD_SINGLE","jeden (ZIP-)obrázek");
define("_ZOOM_UPLOAD_MULTIPLE","více obrázků");
define("_ZOOM_UPLOAD_DRAGNDROP","Drag n Drop");
define("_ZOOM_UPLOAD_SCANDIR","projít adresář");
define("_ZOOM_UPLOAD_INTRO","Klikněte na tlačítko <b>Browse</b> pro nastavení cesty k obrázkům, které chcete nahrát.");
define("_ZOOM_UPLOAD_STEP1","1. Zvolte počet obrázků, které chcete nahrát: ");
define("_ZOOM_UPLOAD_STEP2","2. Zvolte galerii, do které chcete obrázky nahrát: ");
define("_ZOOM_UPLOAD_STEP3","3. Použijte tlačítko Browse pro nalezení obrázků na vašem počítači");
define("_ZOOM_SCAN_STEP1","Krok 1: zadejte cestu k obrázkům, které chcete nahrát...");
define("_ZOOM_SCAN_STEP2","Krok 2: zvolte obrázky, které chcete nahrát...");
define("_ZOOM_SCAN_STEP3","Krok 3: poté budou zvolené obrázky automaticky zpracovány...");
define("_ZOOM_SCAN_STEP1_DESCR","Umístění může být buď URL nebo adresář na serveru.<br />&nbsp;   Tip: Použijte FTP přístup pro nahrání obrázků do adresáře na serveru, z něj potom můžete obrázky nahrát do galerie!");
define("_ZOOM_SCAN_STEP2_DESCR1","Zpracovávám obrázky");
define("_ZOOM_SCAN_STEP2_DESCR2","jako lokální adresář");
define("_ZOOM_FORMCREATE_NAME","Jméno");
define("_ZOOM_FORM_IMAGEFILE","Soubor");
define("_ZOOM_FORM_IMAGEFILTER","Podporované typy obrázků");
define("_ZOOM_FORM_INGALLERY","V galerii");
define("_ZOOM_FORM_SETFILENAME","Nastavit původní jména obrázkům");
define("_ZOOM_FORM_IGNORESIZES","Ignorovat nastavení maximální velikosti obrázku"); //added: 12-08
define("_ZOOM_FORM_LOCATION","Umístění");
define("_ZOOM_BUTTON_SCAN","Potvrdit URL nebo adresář");
define("_ZOOM_BUTTON_UPLOAD","Nahrát");
define("_ZOOM_BUTTON_EDIT","Editovat");
define("_ZOOM_BUTTON_CREATE","Vytvořit");
define("_ZOOM_CONFIRM_WIPE","WARNING!\\n Running this function will completely wipe your zOOm gallery and remove all images and galleries.\\n\\n Are you sure you want to continue?");
define("_ZOOM_CONFIRM_DEL","Tato volba úplně smaže galerii, včetně obrázků!\\nChcete pokračovat?");
define("_ZOOM_CONFIRM_DELMEDIUM","Chystáte se úplně vymazat tento obrázek!\\nChcete pokračovat?");
define("_ZOOM_ALERT_DEL","Galerie je smazána!");
define("_ZOOM_ALERT_NOCAT","Žádna galerie nebyla vybrána!");
define("_ZOOM_ALERT_NOMEDIA","Žádna média nebyla vybrána!");
define("_ZOOM_ALERT_EDITOK","Galerie byla upravena!");
define("_ZOOM_ALERT_NEWGALLERY","Nová galerie byla vytvořena.");
define("_ZOOM_ALERT_NONEWGALLERY","Galerie nebyla vytvořena!!");
define("_ZOOM_ALERT_EDITIMG","Vlastnosti obrázku úspěšně změny");
define("_ZOOM_ALERT_DELPIC","Soubor byl vymazán!");
define("_ZOOM_ALERT_NODELPIC","Soubor nemůže být vymazán!");
define("_ZOOM_ALERT_MOVEFAILURE","Medium could not be moved."); //added: 08-08-2006
define("_ZOOM_ALERT_NOPICSELECTED","Nebyl vybrán žádný obrázek.");
define("_ZOOM_ALERT_NOPICSELECTED_MULT","Nebyly vybrány žádné obrázky.");
define("_ZOOM_ALERT_UPLOADOK","Soubor úpěšně nahrán!");
define("_ZOOM_ALERT_UPLOADSOK","Soubory úpěšně nahrány!");
define("_ZOOM_ALERT_WRONGFORMAT","Chybný formát obrázku.");
define("_ZOOM_ALERT_WRONGFORMAT_MULT","Chybný formát obrázků.");
define("_ZOOM_ALERT_TOOBIG","Filesize of the medium is too big; %s is the allowed max."); //added 08-08-2006
define("_ZOOM_ALERT_IMGERROR","Chyba při změně velikosti obráku/ tvorbě náhledu.");
define("_ZOOM_ALERT_PCLZIPERROR","Chyba při rozbalování archivu.");
define("_ZOOM_ALERT_INDEXERROR","Chyba při indexaci dokumentu");
define("_ZOOM_ALERT_WATERMARKERROR","Error occured while applying a watermark to the image.");
define("_ZOOM_ALERT_IMGFOUND","obrázky nalezeny");
define("_ZOOM_INFO_CHECKCAT","Prosím nejprve vyberte galerii a poté klikněte na tlačítko Nahrát!");
define("_ZOOM_BUTTON_ADDIMAGES","Přidat obrázky");
define("_ZOOM_BUTTON_REMIMAGES","Odstranit obrázky");
define("_ZOOM_INFO_PROCESSING","Zpracovávám obrázek:");
define("_ZOOM_ITEMEDIT_TAB1","Vlastnosti");
define("_ZOOM_ITEMEDIT_TAB2","Registrovaní uživatelé");
define("_ZOOM_ITEMEDIT_TAB3","Akce");
define("_ZOOM_USERSLIST_LINE1",">>Zvolte uživatele této položky<<");
define("_ZOOM_USERSLIST_ALLOWALL",">>Veřejný přístup<<");
define("_ZOOM_USERSLIST_MEMBERSONLY",">>Pouze registrovaní uživatelé<<");
define("_ZOOM_PUBLISHED","Publikováno");
define("_ZOOM_SHARED","Sdílet");
define("_ZOOM_ROTATE","Otočit obrázek o 90 stupňů");
define("_ZOOM_CLOCKWISE","ve směru");
define("_ZOOM_CCLOCKWISE","proti směru hodinových ručiček");
define("_ZOOM_FLIP_HORIZ","Překlopit obázek horizontálně");
define("_ZOOM_FLIP_VERT","Překlopit obrázek vertikálně");
define("_ZOOM_PROGRESS_DESCR","Požadavek se právě provádí... Trpělivost prosím.");

//Navigation (including Slideshow buttons)
define("_ZOOM_SLIDESHOW","Slideshow:");
define("_ZOOM_PREV_IMG","předchozí obrázek");
define("_ZOOM_NEXT_IMG","následující obrázek");
define("_ZOOM_FIRST_IMG","první obrázek");
define("_ZOOM_LAST_IMG","poslední obrázek");
define("_ZOOM_PLAY","přehrát");
define("_ZOOM_STOP","zastavit");
define("_ZOOM_RESET","reset");
define("_ZOOM_FIRST","První");
define("_ZOOM_LAST","Poslední");
define("_ZOOM_PREVIOUS","Předchozí");
define("_ZOOM_NEXT","Následující");
define("_ZOOM_IN_DESC", "najeďte myší nad obrázek a stiskněte klávedu NAHORU/DOLŮ.");

//Gallery actions
define("_ZOOM_SEARCH_BOX","Rychlé hledání...");
define("_ZOOM_ADVANCED_SEARCH","Rozšířené hledání");
define("_ZOOM_SEARCH_KEYWORD","Hledat podle klíčového slova");
define("_ZOOM_IMAGES","obrázků");
define("_ZOOM_IMGFOUND","%s nalezeno - jste na %s. straně z %s");
define("_ZOOM_SUBGALLERIES","sub-galerie");
define("_ZOOM_ALERT_COMMENTOK","Váš komentář byl úspěšně vložen!");
define("_ZOOM_ALERT_COMMENTERROR","Tento obrázek jste již okomentovali!");
define("_ZOOM_ALERT_VOTE_OK","Váš hlas byl započítán! Děkujeme.");
define("_ZOOM_ALERT_VOTE_ERROR","Pro tento obrázek jste již hlasovali!");
define("_ZOOM_WINDOW_CLOSE","Zavřít");
define("_ZOOM_NOPICS","Žádné obrázky v galerii");
define("_ZOOM_PROPERTIES","Vlastnosti");
define("_ZOOM_COMMENTS","Komentáře");
define("_ZOOM_NO_COMMENTS","Dosud bez komentáře.");
define("_ZOOM_YOUR_NAME","Jméno");
define("_ZOOM_ADD","Přidat");
define("_ZOOM_NAME","Jméno");
define("_ZOOM_DATE","Datum přidání");
define("_ZOOM_UNAME","Přidal(a)");
define("_ZOOM_DESCRIPTION","Popis");
define("_ZOOM_IMGNAME","Jméno");
define("_ZOOM_FILENAME","Jméno obrázku");
define("_ZOOM_CLICKDOCUMENT","(klikněte na jméno obrázku pro jeho otevření)");
define("_ZOOM_KEYWORDS","Klíčová slova");
define("_ZOOM_HITS","zobrazení");
define("_ZOOM_CLOSE","Zavřít");
define("_ZOOM_NOIMG", "Nebyl nalezen žádný obrázek!");
define("_ZOOM_NONAME", "Musíte zadat jméno!");
define("_ZOOM_NOCAT", "Nebyla vybrána kategorie!");
define("_ZOOM_EDITPIC", "Editovat obrázek");
define("_ZOOM_SETCATIMG","Zvolit jako obrázek galerie");
define("_ZOOM_SETPARENTIMG","Zvolit jako obrázek nadřazené galerie");
define("_ZOOM_PASS","Heslo");
define("_ZOOM_PASS_REQUIRED","GTato galerie vyžaduje heslo.<br />Prosím vyplňte políčko Heslo<br />a klikněte na tlačítko Jdi. Děkujeme.");
define("_ZOOM_PASS_BUTTON","Jdi");
define("_ZOOM_PASS_GALLERY","Heslo");
define("_ZOOM_PASS_INNCORRECT","Špatné heslo");

//Hotlinking
define("_ZOOM_SETTINGS_HOTLINK","Enable Image Hotlinking Protection");
define("_ZOOM_SETTINGS_HPTOOLTIP","When hotlinking protection is enabled, image file names and paths will be hidden. Also, if a user attempts to use the image on another site, it will not appear.");


//Lightbox
define("_ZOOM_LIGHTBOX","Lightbox");
define("_ZOOM_LIGHTBOX_GALLERY","Tuto galerii do Lightboxu!");
define("_ZOOM_LIGHTBOX_ITEM","Tento obrázek do Lightboxu!");
define("_ZOOM_LIGHTBOX_VIEW","Zobrazit Lightbox");
define("_ZOOM_YOUR_LIGHTBOX","Obsah Vašeho Lightboxu:");
define("_ZOOM_LIGHTBOX_EMPTY","Váš Lightbox je momentálně prázdný.");
define("_ZOOM_LIGHTBOX_ZIPBTN","Vytvořit ZIP archiv");
define("_ZOOM_LIGHTBOX_PLAYLISTBTN","Vytvořit Playlist & Play");
define("_ZOOM_LIGHTBOX_CATS","Galerie");
define("_ZOOM_LIGHTBOX_TITLEDESCR","Název & Popis");
define("_ZOOM_ACTION","Akce");
define("_ZOOM_LIGHTBOX_ADDED","Obrázek byl úspěšně přidán do lightboxu!");
define("_ZOOM_LIGHTBOX_NOTADDED","Chyba při ukládání obrázku do lightboxu!");
define("_ZOOM_LIGHTBOX_EDITED","Obrázek úspěšně editován!");
define("_ZOOM_LIGHTBOX_NOTEDITED","Chyba při editaci obrázku!");
define("_ZOOM_LIGHTBOX_DEL","Obrázek byl z lightboxu úspěšně odebrán!");
define("_ZOOM_LIGHTBOX_NOTDEL","Chyba při odebírání obrázku z lightboxu!");
define("_ZOOM_LIGHTBOX_NOZIP","Již jste jednou ZIP-archiv z lightboxu vytvořili!");
define("_ZOOM_LIGHTBOX_PARSEZIP","Parsuji obrázky z galerie...");
define("_ZOOM_LIGHTBOX_DOZIP","vytvářím ZIP-archiv...");
define("_ZOOM_LIGHTBOX_DLHERE","Nyní můžete lightbox stáhnout.");
define("_ZOOM_LIGHTBOX_PLSUCCESS","Playlist byl úspěšně vytvořen! Je potřeba obnovit okno s přehrávačem.");
define("_ZOOM_LIGHTBOX_PLERROR","Playlist se nepodařilo vytvořit.");
define("_ZOOM_LIGHTBOX_NOAUDIO","Nejdříve je potřeba přidat audio soubory do Lightboxu!");
define("_ZOOM_LIGHTBOX_NOITEMS","vypadá to, že váš Lightbox je prázdný.");

//EXIF information
define("_ZOOM_EXIF","EXIF");
define("_ZOOM_EXIF_SHOWHIDE","Zobrazit/ skrýt Metadata");

//MP3 id3 v1.1 or later information
define("_ZOOM_AUDIO_PLAYING","právě hraje:");
define("_ZOOM_AUDIO_CLICKTOPLAY","Klikni pro přehrání tohoto souboru.");
define("_ZOOM_ID3","ID3");
define("_ZOOM_ID3_SHOWHIDE","Zobrazit/ skrýt ID3-tag data");
define("_ZOOM_ID3_LENGTH","Délka");
define("_ZOOM_ID3_QUALITY","Kvalita");
define("_ZOOM_ID3_TITLE","Název");
define("_ZOOM_ID3_ARTIST","Artist");
define("_ZOOM_ID3_ALBUM","Album");
define("_ZOOM_ID3_YEAR","Rok");
define("_ZOOM_ID3_COMMENT","Komentář");
define("_ZOOM_ID3_GENRE","Žánr");

//Video metadata information
define("_ZOOM_VIDEO_SHOWHIDE","Zobrazit/skrýt Video data");
define("_ZOOM_VIDEO_PIXELRATIO","Pixel ratio");
define("_ZOOM_VIDEO_QUALITY","Video kvalita");
define("_ZOOM_VIDEO_AUDIOQUALITY","Audio kvalita");
define("_ZOOM_VIDEO_CODEC","Kodek");
define("_ZOOM_VIDEO_RESOLUTION","Rozlišení");

//rating
define("_ZOOM_RATING","Hodnocení");
define("_ZOOM_NOTRATED","Dosud nehodnocen!");
define("_ZOOM_VOTE","hlas");
define("_ZOOM_VOTES","hlasy");
define("_ZOOM_RATE0","smetí");
define("_ZOOM_RATE1","slabý");
define("_ZOOM_RATE2","průměr");
define("_ZOOM_RATE3","dobrý");
define("_ZOOM_RATE4","velmi dobrý");
define("_ZOOM_RATE5","výborný!");

//special
define("_ZOOM_TOPTEN","Top Ten");
define("_ZOOM_LASTSUBM","Nejnovější obrázek");
define("_ZOOM_LASTCOMM","Nejnovější komentář");
define("_ZOOM_SEARCHRESULTS","Výsledek vyhledání");
define("_ZOOM_TOPRATED","Nejlépe hodnocený");

//ecard
define("_ZOOM_ECARD_SENDAS","Pošlete přátelům tento obrázek jako E-pohlednici!");
define("_ZOOM_ECARD_YOURNAME","Vaše jméno:");
define("_ZOOM_ECARD_YOUREMAIL","Váš e-mail:");
define("_ZOOM_ECARD_FRIENDSNAME","Jméno vašeho kamaráda");
define("_ZOOM_ECARD_FRIENDSEMAIL","E-mail vašeho kamaráda");
define("_ZOOM_ECARD_MESSAGE","Vzkaz");
define("_ZOOM_ECARD_SENDCARD","Poslat E-pohlednici");
define("_ZOOM_ECARD_SUCCESS","Pohlednice byla úspěšně odeslána.");
define("_ZOOM_ECARD_CLICKHERE","Klikněte zde pro její zobrazení!");
define("_ZOOM_ECARD_ERROR","Chyba při odesílání pohlednice adresátovi");
define("_ZOOM_ECARD_TURN","Podívat se na zadní stranu pohlednice!");
define("_ZOOM_ECARD_TURN2","Podívat se na přední stranu pohlednice!");
define("_ZOOM_ECARD_SENDER","Tuto pohlednici Vám poslal:");
define("_ZOOM_ECARD_SUBJ","Dostali jste pohlednici od:");
define("_ZOOM_ECARD_MSG1","pohlednici Vám poslal(a)");
define("_ZOOM_ECARD_MSG2","Klikněte na odkaz dole pro zobrazení Vaší osobní pohlednice!");
define("_ZOOM_ECARD_MSG3","Prosím neodpovídejte na tento e-mail, byl vygenerován automaticky.");
define("_ZOOM_ECARD_ECARDEXPIRED","Omlouváme se, ale tato pohlednice už není k dispozici.");

//installation-screen
define ('_ZOOM_INSTALL_CREATE_DIR','zOOm Instalace zkusí vytvořit adresář obrázků "images/zoom" ...');
define ('_ZOOM_INSTALL_CREATE_DIR_WM','zOOm Installation is trying to create the Images-directory "images/zoom/watermarks" ...');
define ('_ZOOM_INSTALL_CREATE_DIR_SUCC','hotovo!');
define ('_ZOOM_INSTALL_CREATE_DIR_FAIL','chyba!');
define ('_ZOOM_INSTALL_CREATE_DBASE_SUCC','Database created successfully!');
define ('_ZOOM_INSTALL_UPGRADED_DBASE_SUCC','Database upgraded successfully!');
define ('_ZOOM_INSTALL_MESS1','zOOm Galerie je nainstalována.<br>Nyní jste připravení zveřejnit vaše alba!');
define ('_ZOOM_INSTALL_MESS2','POZNÁMKA: co byste nyní měli udělat, jít do menu komponent,<br>kliknout na "zOOm Media Gallery Admin"<br>zkontrolovat nastavení v Administraci systému.');
define ('_ZOOM_INSTALL_MESS3','Zde můžete změnit všechny proměnné hodící se do vašeho uspořádání zOOm.');
define ('_ZOOM_INSTALL_MESS4','Nezapomeňte vytvořit galerii a jste doma!');
define ('_ZOOM_INSTALL_MESS_FAIL1','zOOm Galerie NENÍ nainstalována!');
define ('_ZOOM_INSTALL_MESS_FAIL2','Následující adresáře musí být vytvořeny a chmod změněno na  "0777":<br />'
. '"images/zoom"<br />'
. '/components/com_zoom/images"<br />'
. '"/components/com_zoom/admin"<br />'
. '"/components/com_zoom/classes"<br />'
. '"/components/com_zoom/images"<br />'
. '"/components/com_zoom/images/admin"<br />'
. '"/components/com_zoom/images/filetypes"<br />'
. '"/components/com_zoom/images/rating"<br />'
. '"/components/com_zoom/images/smilies"<br />'
. '"/components/com_zoom/language"<br />'
. '"/components/com_zoom/tabs"');
define ('_ZOOM_INSTALL_MESS_FAIL3','Po vytvoření těchto adresářů a změnění práv, jdi do <br /> "Components -> zOOm Media Gallery" a nastav vše podle přání.');
?>
