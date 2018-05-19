<?php
/**
* Web based SQLite management
* @package SQLiteManager
* @version $Id: english.inc.php,v 1.51 2006/04/14 15:16:52 freddy78 Exp $ $Revision: 1.51 $
*/
$charset = 'iso-8859-1';
$langSuffix = 'en';
/**
* Fichier d'internationnalisation
*/
$itemTranslated = array(  "Table"   => "Table",
              "View"    => "View",
              "Trigger" => "Trigger",
              "Function"  => "Function");

$langueTranslated = array(  1=>"French", 2=>"English", 3=>"Polish",
              				4=>"German", 5=>"Japanese", 6=>"Italian",
              				7=>"Croatian", 8=>"Brazilian portuguese", 9=>"Netherlands",
              				10=>"Spanish", 11=>"Danish", 12=>"Chinese traditional", 
              				13=>"Chinese simplified", 14=>"Česky");

$themeTranslated = array("default"=>"Default", "green"=>"Green", "PMA"=>"PMA", "jall"=>"Jall");

$TEXT[1]  = "Home";
$TEXT[2]  = "Welcome to <a href=\"http://www.sqlitemanager.org\" target=\"_blank\">SQLiteManager</a> version";
$TEXT[3]  = "SQLite version";
$TEXT[4]  = "SQLite Documentation";
$TEXT[5]  = "SQL Language";
$TEXT[6]  = "The SQLite extension can't be loaded.";
$TEXT[7]  = "Unable to open the 'SQLite' configuration database.<br>Error message";
$TEXT[8]  = "The configuration database is read-only (not writeable)!";
$TEXT[9]  = "Error";
$TEXT[10] = "Function";
$TEXT[11] = "Aggregate";
$TEXT[12] = "Final function";
$TEXT[13] = "Nb Args";
$TEXT[14] = "Modify";
$TEXT[15] = "Delete";
$TEXT[16] = "New function properties";
$TEXT[17] = "Function properties";
$TEXT[18] = "Error: All fields must be filled.";
$TEXT[19] = "Name";
$TEXT[20] = "Type";
$TEXT[21] = "Step Properties";
$TEXT[22] = "Final Properties";
$TEXT[23] = "Nb args";
$TEXT[24] = "Attribute this function to all databases.";
$TEXT[25] = "New table properties";
$TEXT[26] = "Table properties";
$TEXT[27] = "Field";
$TEXT[28] = "Type";
$TEXT[29] = "Length";
$TEXT[30] = "Null";
$TEXT[31] = "Default";
$TEXT[32] = "Primary";
$TEXT[33] = "Action";
$TEXT[34] = "Check all";
$TEXT[35] = "Uncheck all";
$TEXT[36] = "For the selection";
$TEXT[37] = "Are you sure you want to delete this/these fields?";
$TEXT[38] = "Management of index(es)";
$TEXT[39] = "Are you sure you want to delete the field";
$TEXT[40] = "Yes";
$TEXT[41] = "No";
$TEXT[42] = "Primary";
$TEXT[43] = "Add";
$TEXT[44] = "Field(s)";
$TEXT[45] = "At the end of table";
$TEXT[46] = "At the beginning of table";
$TEXT[47] = "After";
$TEXT[48] = "Insert new record";
$TEXT[49] = "Modify a record";
$TEXT[50] = "Value";
$TEXT[51] = "Save";
$TEXT[52] = "Insert data from a file.";
$TEXT[53] = "Trigger";
$TEXT[54] = "New trigger properties";
$TEXT[55] = "Trigger properties";
$TEXT[56] = "Moment";
$TEXT[57] = "Event";
$TEXT[58] = "On";
$TEXT[59] = "Condition";
$TEXT[60] = "Step";
$TEXT[61] = "Properties";
$TEXT[62] = "New View properties";
$TEXT[63] = "View properties";
$TEXT[64] = "No query has been executed!";
$TEXT[65] = "Bad resource connection!";
$TEXT[66] = "Execute one or more <b>request(s)";
$TEXT[67] = "<i>Or</i> from an sql file";
$TEXT[68] = "Query format: Standard (SQLite)";
$TEXT[69] = "Execute";
$TEXT[70] = "query has been executed.";
$TEXT[71] = "Line has been modified.";
$TEXT[72] = "Structure";
$TEXT[73] = "Display";
$TEXT[74] = "SQL";
$TEXT[75] = "Insert";
$TEXT[76] = "Export";
$TEXT[77] = "Empty";
$TEXT[78] = "Do you really want to delete this function?";
$TEXT[79] = "Do you really want to empty this table?";
$TEXT[80] = "Do you really want to delete this table?";
$TEXT[81] = "Add";
$TEXT[82] = "Do you really want to delete this view?";
$TEXT[83] = "Do you really want to delete this trigger?";
$TEXT[84] = "Options";
$TEXT[85] = "Are you really sure you want to delete this database? Only the subscription will be removed, the database will not be destroyed. ";
$TEXT[86] = "Delete";
$TEXT[87] = "Add a new View";
$TEXT[88] = "Add a new Trigger";
$TEXT[89] = "Add a new Function";
$TEXT[90] = "SQL query";
$TEXT[91] = "Key name";
$TEXT[92] = "Do you really want to delete this Index";
$TEXT[93] = "Add an Index on";
$TEXT[94] = "column(s)";
$TEXT[95] = "Ignore";
$TEXT[96] = "Add on the key";
$TEXT[97] = "Create a View with name ";
$TEXT[98] = "from this query.";
$TEXT[99] = "Error line(s)";
$TEXT[100]  = "There is certainly a problem of write rights on the configuration database";
$TEXT[101]  = "Impossible to create or read this database";
$TEXT[102]  = "All the fields must be filled!";
$TEXT[103]  = "Create or add new database";
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
$TEXT[118]  = "Nb records";
$TEXT[119]  = "Insert";
$TEXT[120]  = "Are you sure you want to delete";
$TEXT[121]  = "the";
$TEXT[122]  = "the";
$TEXT[123]  = "Are you sure you want to empty this table";
$TEXT[124]  = "Structure only";
$TEXT[125]  = "Structure and Data";
$TEXT[126]  = "Data only";
$TEXT[127]  = "Complete inserts";
$TEXT[128]  = "send";
$TEXT[129]  = "Host";
$TEXT[130]  = "Generation Time";
$TEXT[131]  = "Database";
$TEXT[132]  = "Table structure for table";
$TEXT[133]  = "Dumping data for table";
$TEXT[134]  = "View structure for view";
$TEXT[135]  = "User Defined Function properties";
$TEXT[136]  = "Records";
$TEXT[137]  = "File";
$TEXT[138]  = "Replace content";
$TEXT[139]  = "Separator";
$TEXT[140]  = "Insert of data from text formatted file";
$TEXT[141]  = "Language";
$TEXT[142]  = "Theme";
$TEXT[143]  = "Upload Database";
$TEXT[144]  = "Upload folder does not accessible.<br>(Modify constant 'DEFAULT_DB_PATH' in the file 'include/user_defined.inc.php')";
$TEXT[145]  = "Explain SQL";
$TEXT[146]  = "Management of attached databases";
$TEXT[147]  = "You are not allowed to access. You must enter a valid login and password.";
$TEXT[148]  = "This login is not valid.";
$TEXT[149]  = "This password don't correspond to this login.";
$TEXT[150]  = "PHP version";
$TEXT[151]  =   "After save";
$TEXT[152]  =   "Go back to previous page";
$TEXT[153]  =   "Insert another new row";
$TEXT[154]  =   "The configuration database is read-only.<br>Some features of SQLiteManager can't work correctly.";
$TEXT[155]  =   "This database is read-only.";
$TEXT[156]  =   "Privileges";
$TEXT[157]  =   "Change password";
$TEXT[158]  =   "Logoff";
$TEXT[159]  =   "Add user";
$TEXT[160]  =   "Add group";
$TEXT[161]  =   "User overview";
$TEXT[162]  =   "Groups overview";
$TEXT[163]  =   "Name";
$TEXT[164]  =   "Login";
$TEXT[165]  =   "Group";
$TEXT[166]  =   "execSQL";
$TEXT[167]  =   "data";
$TEXT[168]  =   "export";
$TEXT[169]  =   "empty";
$TEXT[170]  =   "del";
$TEXT[171]  =   "Incorrect old password.";
$TEXT[172]  =   "Password and confirmation are different.";
$TEXT[173]  =   "The password has been changed";
$TEXT[174]  =   "Click here for re-logon";
$TEXT[175]  =   "Old:";
$TEXT[176]  =   "New:";
$TEXT[177]  =   "Confirm:";
$TEXT[178]  =   "Information";
$TEXT[179]  =   "Location:";
$TEXT[180]  =   "Size:";
$TEXT[181]  =   "Rights:";
$TEXT[182]  =   "Last modified:";
$TEXT[183]  =   "Integrity Check";
$TEXT[184]  =   "Vacuum";
$TEXT[185]  =   "Default synchronous:";
$TEXT[186]  =   "Default cache_size:";
$TEXT[187]  =   "OFF ";
$TEXT[188]  =   "NORMAL ";
$TEXT[189]  =   "FULL ";
$TEXT[190]  =   "Access control management";
$TEXT[191]  =   "Yes";
$TEXT[192]  =   "No";
$TEXT[193]  =   "Default Temporary Storage";
$TEXT[194]  =   "DEFAULT";
$TEXT[195]  =   "MEMORY";
$TEXT[196]  =   "FILE";
$TEXT[197]  =   "Unique";
$TEXT[198]  =   "Index";
$TEXT[199]  =   "Data";
$TEXT[200]  =   "Apply";
$TEXT[201]  = "Selection";
$TEXT[202]  = "Operator";
$TEXT[203]  = "additional condition:";
$TEXT[204]  = "AND";
$TEXT[205]  = "OR";
$TEXT[206]  = "Select";
$TEXT[207]  = "Search";
$TEXT[208]  = "Rename";
$TEXT[209]  = "Move";
$TEXT[210]  = "Copy";
$TEXT[211]  = "Plugins";
$TEXT[212]  = "Maintenance";
$TEXT[213]  = "Query time:";
$TEXT[214]  = "msec.";
$TEXT[215]  = "Rename table to:";
$TEXT[216]  = "Move table to (database.table):";
$TEXT[217]  = "Copy table to (database.table):";
$TEXT[218]  = "Add DROP TABLE";
$TEXT[219]  = "Save as new row";
$TEXT[220]  = "Save";
$TEXT[221]  = "Save Type";
$TEXT[222]  =   "Operation";
$TEXT[223]  =   "Update";
$TEXT[224]  =   "Tip : You can use internal PHP functions in your queries !";
$TEXT[225]  =   "Truncated text";
$TEXT[226]  =   "Full text";
$TEXT[227]  =   "-- select --";
$TEXT[228]  =   "(s)";
$TEXT[229]  =   "Version";
$TEXT[230]  =   "(new database)";
$TEXT[231]  =   "Official SQliteManager Homepage";
$TEXT[232]  =   "The database can't be attain";
$TEXT[233]  =   "Trigger structure";
?>