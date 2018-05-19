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
| Filename: jupload.config.php                                        |
|                                                                     |
-----------------------------------------------------------------------
* @version $Id$
* @package zOOmGallery
* @author Mike de Boer <mailme@mikedeboer.nl> 
**/
define( "_VALID_MOS", 1 );
//echo "Processing images from list...<br /><br />";	
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
	echo header('Content-Type:text/plain');
?>
Debug=false
Encoding=UTF-8
Files.Convert.Format=
Files.Convert.ImprovedRendering=false
Files.Convert.IncludeMetadata=true
Files.Convert.InterpolationAlgo=
Files.Convert.MaxHeight=-1
Files.Convert.MaxWidth=-1
Files.Filter.Duplicates=true
Files.Filter.Folders=false
Files.Filter.MaxImageDimension=
Files.Filter.Multi=
Files.ForceImageCache=false
Files.KeepImagesCached=false
Files.MaxImageSize=-1
Files.Preselected=
Files.Thumbnails.Smooth=true
Files.UploadInvalidImages=true
Gui.ContextMenu.Files=AddFolder,Seperator,ConvertImage,Seperator,CopyClipboard,PasteClipboard,Seperator,RenameFile,SaveFiles,DeleteFiles
Gui.ContextMenu.General=ShowInvalids,Seperator,Screenshot,JUploadScreenshot,ScreenshotDelay,Seperator,About
Gui.DeactivateOnUpload=false
Gui.Enabled=true
Gui.FileChooser.DefaultDir=
Gui.FileChooser.Filter.All=true
Gui.FileChooser.Filter.Image=true
Gui.FileChooser.Filter.Multi=
Gui.FileChooser.Preview.Enabled=true
Gui.FileChooser.Preview.FixedWidth=true
Gui.FileChooser.Preview.Show=false
Gui.FileChooser.Preview.Size=192x192
Gui.FileChooser.Preview.Smooth=false
Gui.FileChooser.Size=800x600
Gui.ImageView.ItemGap=4
Gui.ImageView.ItemSize=
Gui.LF.Background=
Gui.LF.Borders=true
Gui.LF.Classname=skinlf
Gui.LF.Font=
Gui.LF.Foreground=
Gui.LF.OverrideColorsBorders=false
Gui.LF.OverrideFont=true
Gui.LF.SelectedBackground=
Gui.LF.SelectedForeground=
Gui.LF.SkinPackUrl=<?php echo $mosConfig_live_site;?>/components/com_zoom/lib/jupload/skinlf/xpluna.zip
Gui.ServerResponse.AutoShow=true
Gui.ServerResponse.Enable=true
Gui.ServerResponse.Height=100
Gui.Status.BorderColor=#000000
Gui.Status.PanelHeight=70
Gui.Status.ShowBar=true
Gui.Status.ShowPanel=true
Gui.Status.ShowPrepare=true
Gui.Status.ShowSuccessDialog=false
Gui.Toolbar.Buttons=add,remove,upload,menu
Gui.Views.AutoSelectAddedFiles=false
Gui.Views.Details.Widths=
Gui.Views.Display=list,details,thumbnail
Gui.Views.Icon.MaxHeight=32
Gui.Views.Icon.MaxWidth=32
Gui.Views.Icon.SystemIcons=true
Gui.Views.ShowPaths=false
Gui.Views.Thumbs.Enabled=true
Gui.Views.Tree.MinSize=120x200
ID=jupload0
Locale=
MinJavaVersion=1.4
Upload.Auth.AutoLogin=
Upload.Auth.UserAuthRequired=false
Upload.AutoRemove=true
Upload.Autostart=false
Upload.Formname=JUploadForm
Upload.Http.AdditionalHeaders=
Upload.Http.AdditionalPostFields=
Upload.Http.Auth.Scheme=basic
Upload.Http.Cookies=
Upload.Http.MaxRequestFileCount=-1
Upload.Http.MaxRequestSize=-1
Upload.Http.Meta.AbsolutePath=false
Upload.Http.Meta.FileTag=files
Upload.Http.Meta.LastModified=true
Upload.Http.Meta.MD5=false
Upload.Http.Method=post
Upload.Http.Query=
Upload.MaxFileSize=-1
Upload.MaxTotalFileCount=-1
Upload.MaxTotalFileSize=<?php echo ($zoom->_CONFIG['maxsizekb']*1024); ?>

Upload.Thumbnails.Enable=false
Upload.Thumbnails.Format=jpg
Upload.Thumbnails.Http.AdditionalHeaders=
Upload.Thumbnails.Http.AdditionalPostFields=
Upload.Thumbnails.Http.Cookies=
Upload.Thumbnails.Http.Query=
Upload.Thumbnails.Http.TagName=thumbnail
Upload.Thumbnails.Size=100x100
Upload.Thumbnails.TargetURL=scripts/php/jupload-post.php
<?php echo "Upload.URL.Action=".$mosConfig_live_site."/components/com_zoom/www/admin/save_dnd.php"; ?>

WaitForPlugins=