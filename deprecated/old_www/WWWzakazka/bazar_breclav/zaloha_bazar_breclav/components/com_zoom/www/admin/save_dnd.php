<?php
//zOOm Media Gallery//
/** 
-----------------------------------------------------------------------
|  zOOm Media Gallery! by Mike de Boer - a multi-gallery component    |
-----------------------------------------------------------------------

-----------------------------------------------------------------------
|                                                                     |
| Author: Mike de Boer, <http://www.mikedeboer.nl>                    |
| Copyright: copyright (C) 2006 by Mike de Boer                       |
| Description: zOOm Media Gallery, a multi-gallery component for      |
|              Joomla!. It's the most feature-rich gallery component  |
|              for Joomla!! For documentation and a detailed list     |
|              of features, check the zOOm homepage:                  |
|              http://www.zoomfactory.org                             |
| License: GPL                                                        |
| Filename: save_dnd.php                                              |
|                                                                     |
-----------------------------------------------------------------------
* @version $Id: save_dnd.php,v 1.22 2006/12/24 22:52:02 kevinuru Exp $
* @package zOOmGallery
* @author Mike de Boer <mailme@mikedeboer.nl> 
**/
define( "_VALID_MOS", 1 );
echo "Processing images from list...<br /><br />";	
    // $mosConfig_absolute_path = $_REQUEST['dnd_mospath'];
	/*
	* Iterate over all received files.
	* PHP > 4.2 / 4.3 ? will save the file information into the
	* array $_FILES[]. Before these versions, the data was saved into
	* $HTTP_POST_FILES[]
	*/
	// reset script execution time limit (as set in MAX_EXECUTION_TIME ini directive)...
    // requires SAFE MODE to be OFF!
    if (ini_get('safe_mode') != 1 ) {
        set_time_limit(0);
    }
	include_once('../../../../configuration.php');
	if (file_exists($mosConfig_absolute_path."/version.php")) {
		include_once($mosConfig_absolute_path."/version.php");
	} else {
		include_once($mosConfig_absolute_path."/includes/version.php");
	}
	if (eregi("4\.5[ \t]", $version)) {
		$cmstype = 1;
	} else {
		$cmstype = 2;
	}
	// redefine the mambo database object to use the comment function...
	if($cmstype == 2) {
		require_once($mosConfig_absolute_path.'/includes/database.php');
	} else {
		require_once($mosConfig_absolute_path.'/classes/database.php');
	}
	$database = new database( $mosConfig_host, $mosConfig_user, $mosConfig_password, $mosConfig_db, $mosConfig_dbprefix );
	// Include zOOm configuration
	include_once($mosConfig_absolute_path.'/components/com_zoom/etc/zoom_config.php');
	// Create zOOm Image Gallery object
	require_once($mosConfig_absolute_path.'/components/com_zoom/lib/zoom.class.php');
	require_once($mosConfig_absolute_path.'/components/com_zoom/lib/editmon.class.php'); //like a common session-monitor...
	require_once($mosConfig_absolute_path.'/components/com_zoom/lib/gallery.class.php');
	require_once($mosConfig_absolute_path.'/components/com_zoom/lib/image.class.php');
	require_once($mosConfig_absolute_path.'/components/com_zoom/lib/toolbox.class.php');
	require_once($mosConfig_absolute_path.'/components/com_zoom/lib/privileges.class.php');
	require_once($mosConfig_absolute_path.'/components/com_zoom/lib/mime/mime.class.php');
	$zoom = new zoom();
	
	// now create an instance of the ToolBox!
	$zoom->toolbox = new toolbox(false);

	$catid = intval($zoom->getParam($_REQUEST, 'catid'));
	$uid = intval($zoom->getParam($_REQUEST, 'dnd_uid'));
	if (empty($catid)) {
		echo "No gallery specified, please select one from the list.";
		exit();
	} else {
		$zoom->setGallery($catid, true);
	}
	$zoom->_CurrUID = $uid;
	
	// inclusion of filesystem-functions, platform dependent.
	if ($zoom->isWin()) {
		require_once($mosConfig_absolute_path.'/components/com_zoom/lib/WinNtPlatform.class.php');
		$zoom->platform = new WinNtPlatform();
	} else {
		require_once($mosConfig_absolute_path.'/components/com_zoom/lib/UnixPlatform.class.php');
		$zoom->platform = new UnixPlatform();
	}
	
	if (file_exists($mosConfig_absolute_path."/components/com_zoom/lib/language/".$mosConfig_lang.".php") ) { 
		include_once($mosConfig_absolute_path."/components/com_zoom/lib/language/".$mosConfig_lang.".php");
	} else { 
		include_once($mosConfig_absolute_path."/components/com_zoom/lib/language/english.php");
	}
	if ($zoom->_CONFIG['readEXIF'] && !(bool)ini_get('safe_mode')) {
		include_once($mosConfig_absolute_path."/components/com_zoom/lib/iptc/JPEG.php");
		include_once($mosConfig_absolute_path."/components/com_zoom/lib/iptc/EXIF.php");
		include_once($mosConfig_absolute_path."/components/com_zoom/lib/iptc/Photoshop_IRB.php");
		include_once($mosConfig_absolute_path."/components/com_zoom/lib/iptc/XMP.php");
		include_once($mosConfig_absolute_path."/components/com_zoom/lib/iptc/Photoshop_File_Info.php");
	}
 	
 	foreach ($_FILES as $key => $value) {
        $tag = ereg_replace(".*\.([^\.]*)$", "\\1", urldecode($value['name']));
        $tag = strtolower($tag);
        $filetype = $value['type']; //used for MIME type based check
        $setFilename = $zoom->getParam($_REQUEST, 'dnd_setFilename');
        if($setFilename) {
        	$name = urldecode($value['name']);
        } else {
        	$name = $zoom->getParam($_GET, 'dnd_name');
        }
        $keywords = $zoom->getParam($_GET, 'dnd_keywords');
        $descr = $zoom->getParam($_REQUEST, 'dnd_descr', null, _MOS_ALLOWHTML);
        //Check for right format
        if ($zoom->acceptableFormat($tag)) {
        	$imagepath = $zoom->_CONFIG['imagepath'];
        	$catdir = $zoom->_gallery->getDir();
        	$filename = urldecode($value['name']);
        	if (!isset($descr)) {
        		$descr = $zoom->_CONFIG['tempDescr'];
        	} 
        	$zoom->toolbox->processImage($value['tmp_name'], $filename, $filetype, $keywords, $name, $descr, false, '0', '0', $uid);
        	if ($zoom->toolbox->_err_num > 0) {
        		$zoom->toolbox->displayErrors();
        	} else {
        			echo "<b>1 "._ZOOM_ALERT_UPLOADSOK."</b><br />";
        	}
        } else {
        	//Not the right format, back to uploadscreen-->
        	echo "<b>"._ZOOM_ALERT_WRONGFORMAT."</b><br />";
        }
    }
?>