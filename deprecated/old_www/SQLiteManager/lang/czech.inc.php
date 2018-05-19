<?php
/**
* Web based SQLite management
* @package SQLiteManager
* @version $Id: english.inc.php,v 1.51 2006/04/14 15:16:52 freddy78 Exp $ $Revision: 1.51 $
*/
$charset = 'UTF-8';
$langSuffix = 'cz';
/**
* Fichier d'internationnalisation
*/
$itemTranslated = array("Table"   => "Tabulka",
                        "View"    => "Pohled",
                        "Trigger" => "Trigger",
                        "Function"  => "Funkce");

$langueTranslated = array(  1=>"French", 2=>"English", 3=>"Polish",
                      4=>"German", 5=>"Japanese", 6=>"Italian",
                      7=>"Croatian", 8=>"Brazilian portuguese", 9=>"Netherlands",
                      10=>"Spanish", 11=>"Danish", 12=>"Chinese traditional",
                      13=>"Chinese simplified", 14=>"Česky");

$themeTranslated = array("default"=>"Default", "green"=>"Green", "PMA"=>"PMA", "jall"=>"Jall");
//dopilovat...
$TEXT[1]  = "Domů";
$TEXT[2]  = "Vítej v <a href=\"http://www.sqlitemanager.org\" target=\"_blank\">SQLiteManager</a> verze";
$TEXT[3]  = "SQLite verze";
$TEXT[4]  = "SQLite Dokumentace";
$TEXT[5]  = "SQL Jazyk";
$TEXT[6]  = "The SQLite extension can't be loaded.";
$TEXT[7]  = "Unable to open the 'SQLite' configuration database.<br>Error message";
$TEXT[8]  = "The configuration database is read-only (not writeable)!";
$TEXT[9]  = "Chyba";
$TEXT[10] = "Funkce";
$TEXT[11] = "Aggregate";
$TEXT[12] = "Konečná fuknce";
$TEXT[13] = "Nb Args";
$TEXT[14] = "Změnit";
$TEXT[15] = "Smazat";
$TEXT[16] = "Nová vlastnost funkce";
$TEXT[17] = "Vlastnost funkce";
$TEXT[18] = "Chyba: Chybí název nebo cesta k DB";
$TEXT[19] = "Jméno";
$TEXT[20] = "Typ";
$TEXT[21] = "Step Properties";
$TEXT[22] = "Final Properties";
$TEXT[23] = "Nb args";
$TEXT[24] = "Attribute this function to all databases.";
$TEXT[25] = "Vlastnosti nové tabulky";
$TEXT[26] = "Vlasnosti tabulky";
$TEXT[27] = "Pole";
$TEXT[28] = "Typ";
$TEXT[29] = "Délka";
$TEXT[30] = "Nulové";
$TEXT[31] = "Výchozí";
$TEXT[32] = "Primární";
$TEXT[33] = "Akce";
$TEXT[34] = "Označit vše";
$TEXT[35] = "Odznačit vše";
$TEXT[36] = "Pro výběr";
$TEXT[37] = "Opravdu chcee smazat toto/tyto pole?";
$TEXT[38] = "Správa indexů";
$TEXT[39] = "Jste si jistí že chcete smazat pole";
$TEXT[40] = "Ano";
$TEXT[41] = "Ne";
$TEXT[42] = "Primární";
$TEXT[43] = "Přidej";
$TEXT[44] = "Pole";
$TEXT[45] = "Na konec tabulky";
$TEXT[46] = "Na začátek tabulky";
$TEXT[47] = "Za";
$TEXT[48] = "Vložit záznam";
$TEXT[49] = "Změnit záznam";
$TEXT[50] = "Hodnota";
$TEXT[51] = "Uložit";
$TEXT[52] = "Vložit data ze souboru.";
$TEXT[53] = "Spoušteč";
$TEXT[54] = "Nový Trigger";
$TEXT[55] = "Spouštěcí vlastnost";
$TEXT[56] = "Chvilku";
$TEXT[57] = "Událost";
$TEXT[58] = "V";
$TEXT[59] = "Podmínka";
$TEXT[60] = "Krok";
$TEXT[61] = "Struktura";
$TEXT[62] = "Nový Pohled";
$TEXT[63] = "Ukaž vlastnost";
$TEXT[64] = "No query has been executed!";
$TEXT[65] = "Bad resource connection!";
$TEXT[66] = "Execute one or more <b>request(s)";
$TEXT[67] = "<i>Or</i> from an sql file";
$TEXT[68] = "SQL format: Standard (SQLite)";
$TEXT[69] = "Vykonat";
$TEXT[70] = "Dotaz byl vykován.";
$TEXT[71] = "Line has been modified.";
$TEXT[72] = "Struktura";
$TEXT[73] = "Projít";
$TEXT[74] = "SQL";
$TEXT[75] = "Vložit";
$TEXT[76] = "Export";
$TEXT[77] = "Vyprázdnit";
$TEXT[78] = "Opravdu chcete smazat tuto funkci?";
$TEXT[79] = "Opravdu chcete vyprázdnit tuto tabulku?";
$TEXT[80] = "Opravdu chcete smazat tuto tabulku?";
$TEXT[81] = "Přidat";
$TEXT[82] = "Opravdu chcete smazat tento pohled?";
$TEXT[83] = "Opravdu chcete smazat tento trigger?";
$TEXT[84] = "Možnosti";
$TEXT[85] = "Opravdu chcete smazat tuto databazi? Pouze odebrat ze seznamu databází, databáze samotná smazána nebude.";
$TEXT[86] = "Smazat";
$TEXT[87] = "Přidat nový Pohled";
$TEXT[88] = "Přidat nový Trigger";
$TEXT[89] = "Přidat novou Funkci";
$TEXT[90] = "SQL dataz";
$TEXT[91] = "Jméno klíče";
$TEXT[92] = "Opravdu smazat tento index";
$TEXT[93] = "Přidat index na";
$TEXT[94] = "sloupec(e)";
$TEXT[95] = "Ignorovat";
$TEXT[96] = "Přidat klíč.";
$TEXT[97] = "Vytvoř Pohled se jménem ";
$TEXT[98] = "z tohoto datazu.";
$TEXT[99] = "Chybný řádek";
$TEXT[100]  = "There is certainly a problem of write rights on the configuration database";
$TEXT[101]  = "Impossible to create or read this database";
$TEXT[102]  = "Všechna pole musí být naplněna";
$TEXT[103]  = "Vytvoř nebo přidej novou databázi";
$TEXT[104]  = "Path";
$TEXT[105]  = "The data array has not a constant number of elements";
$TEXT[106]  = "The paramaters of the constructor class 'Grid' must be an array";
$TEXT[107]  = "The column alignment array doesn't haven't a good number of elements.";
$TEXT[108]  = "The cells alignment must be: 'left', 'right' or 'center'";
$TEXT[109]  = "The parameters for the columns alignment must be an array";
$TEXT[110]  = "The parameters for the columns format must be an array";
$TEXT[111]  = "The column sort array doesn't haven't a good number of elements.";
$TEXT[112]  = "The sort paramaters must be 0=no sort, Or 1=sort.";
$TEXT[113]  = "The paramaters for the columns sort must be an array";
$TEXT[114]  = "The format string for the calculate column is empty.";
$TEXT[115]  = "The title is obligatory for a calculate column.";
$TEXT[116]  = "The paramaters of the constructor class 'ArrayToGrid' must be an array.";
$TEXT[117]  = "Impossible to count the number of records";
$TEXT[118]  = "Záznamů";
$TEXT[119]  = "Vložit";
$TEXT[120]  = "Opravdu chcete smazat";
$TEXT[121]  = "";
$TEXT[122]  = "tento";
$TEXT[123]  = "Opravdu chcete vyprázdnit tabulku";
$TEXT[124]  = "Pouze struktura";
$TEXT[125]  = "Struktura a Data";
$TEXT[126]  = "Pouze data";
$TEXT[127]  = "Kompletní vložení";
$TEXT[128]  = "poslat";
$TEXT[129]  = "Host";
$TEXT[130]  = "Vygenerováno za";
$TEXT[131]  = "Databáze";
$TEXT[132]  = "Table structure for table";
$TEXT[133]  = "Dumping data for table";
$TEXT[134]  = "View structure for view";
$TEXT[135]  = "User Defined Function properties";
$TEXT[136]  = "Záznam";
$TEXT[137]  = "Soubor";
$TEXT[138]  = "Replace content";
$TEXT[139]  = "Separátor";
$TEXT[140]  = "Vložit data z textu formátovaným souborem";
$TEXT[141]  = "Jazyk";
$TEXT[142]  = "Barevné téma";
$TEXT[143]  = "Nahrát Databázi";
$TEXT[144]  = "Upload folder does not accessible.<br>(Modify constant 'DEFAULT_DB_PATH' in the file 'include/user_defined.inc.php')";
$TEXT[145]  = "Vysvětlit SQL";
$TEXT[146]  = "Management of attached databases";
$TEXT[147]  = "You are not allowed to access. You must enter a valid login and password.";
$TEXT[148]  = "This login is not valid.";
$TEXT[149]  = "This password don't correspond to this login.";
$TEXT[150]  = "PHP version";
$TEXT[151]  =   "Po uložení";
$TEXT[152]  =   "Jdi zpět na předchozí stránku";
$TEXT[153]  =   "Vlož další nový řádek";
$TEXT[154]  =   "The configuration database is read-only.<br>Some features of SQLiteManager can't work correctly.";
$TEXT[155]  =   "Tato databáze je pouze pro čtení.";
$TEXT[156]  =   "Privilegia";
$TEXT[157]  =   "Změna hesla";
$TEXT[158]  =   "Odhlásit";
$TEXT[159]  =   "Přidat uživatele";
$TEXT[160]  =   "Přidat skupinu";
$TEXT[161]  =   "Uzivatelský pohled";
$TEXT[162]  =   "Skupinový pohled";
$TEXT[163]  =   "Jméno";
$TEXT[164]  =   "Login";
$TEXT[165]  =   "Skupina";
$TEXT[166]  =   "execSQL";
$TEXT[167]  =   "data";
$TEXT[168]  =   "export";
$TEXT[169]  =   "vyprázdnit";
$TEXT[170]  =   "smazat";
$TEXT[171]  =   "Chybné staré heslo.";
$TEXT[172]  =   "Hesla se liší.";
$TEXT[173]  =   "Heslo musí bát změněno";
$TEXT[174]  =   "Klikni zde pro přehlášení";
$TEXT[175]  =   "Staré:";
$TEXT[176]  =   "Nové:";
$TEXT[177]  =   "Znovu:";
$TEXT[178]  =   "Informace";
$TEXT[179]  =   "Umstění:";
$TEXT[180]  =   "Velikost:";
$TEXT[181]  =   "Práva:";
$TEXT[182]  =   "Poslední změna:";
$TEXT[183]  =   "Kontrola integrity";
$TEXT[184]  =   "prázdné místo";
$TEXT[185]  =   "Výchozí synchronous:";
$TEXT[186]  =   "Výchozí cache_size:";
$TEXT[187]  =   "VYPNUTO ";
$TEXT[188]  =   "NORMÁLNÍ ";
$TEXT[189]  =   "PLNÝ ";
$TEXT[190]  =   "Řízení přístupu správy";
$TEXT[191]  =   "Ano";
$TEXT[192]  =   "Ne";
$TEXT[193]  =   "Výchozí Temporary Storage";
$TEXT[194]  =   "VÝCHOZÍ";
$TEXT[195]  =   "PAMĚŤ";
$TEXT[196]  =   "SOUBOR";
$TEXT[197]  =   "Jedinečný";
$TEXT[198]  =   "Index";
$TEXT[199]  =   "Data";
$TEXT[200]  =   "Použij";
$TEXT[201]  = "Výběr";
$TEXT[202]  = "Operátor";
$TEXT[203]  = "přídavná podmínka:";
$TEXT[204]  = "AND";
$TEXT[205]  = "OR";
$TEXT[206]  = "Select";
$TEXT[207]  = "Hledej";
$TEXT[208]  = "Přejmenuj";
$TEXT[209]  = "Přesunout";
$TEXT[210]  = "Kopírovat";
$TEXT[211]  = "Modul";
$TEXT[212]  = "Udržba";
$TEXT[213]  = "Čas dotazu:";
$TEXT[214]  = "ms";
$TEXT[215]  = "Přejmenovat tabulku jako:";
$TEXT[216]  = "Přesunout tabulku do (database.table):";
$TEXT[217]  = "Zkopírovat tabulku do (database.table):";
$TEXT[218]  = "Přádej DROP TABLE";
$TEXT[219]  = "Ulož jako nový řádek";
$TEXT[220]  = "Ulož";
$TEXT[221]  = "Ulož typ";
$TEXT[222]  =   "Možnosti";
$TEXT[223]  =   "Aktualizace";
$TEXT[224]  =   "Tip : You can use internal PHP functions in your queries !";
$TEXT[225]  =   "Zkrácený text";
$TEXT[226]  =   "Plný text";
$TEXT[227]  =   "-- select --";
$TEXT[228]  =   "(y)";
$TEXT[229]  =   "Verze";
$TEXT[230]  =   "(nová databáze)";
$TEXT[231]  =   "Oficiální domavské stránky SQliteManager";
$TEXT[232]  =   "The database can't be attain";
$TEXT[233]  =   "Struktura Triggeru";
?>