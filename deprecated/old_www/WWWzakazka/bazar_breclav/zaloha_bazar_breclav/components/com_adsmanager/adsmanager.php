<?php
//
// Copyright (C) 2006 Thomas Papin
// http://www.gnu.org/copyleft/gpl.html GNU/GPL

// This file is part of the AdsManager Component,
// a Joomla! Classifieds Component by Thomas Papin
// Email: thomas.papin@free.fr
//
// Dont allow direct linking
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

require_once( $mainframe->getPath( 'front_html' ) );
require_once( $mainframe->getPath( 'class' ) );

if (file_exists($mosConfig_absolute_path .'/components/'.$option.'/lang/lang_' . $mosConfig_lang . '.php'))
	include_once( $mosConfig_absolute_path .'/components/'.$option.'/lang/lang_' . $mosConfig_lang . '.php' );
else
	include_once( $mosConfig_absolute_path .'/components/'.$option.'/lang/lang_english.php' );

// cache activation
$cache =&mosCache::getCache( $option );

$page			 = mosGetParam( $_GET, 'page', "front" );
$expand			 = intval( mosGetParam( $_GET, 'expand', -1 ) );
$text_search	 = mosGetParam( $_GET, 'text_search', "" );
$limitstart		 = intval( mosGetParam( $_GET, 'limitstart', 0 ) );
$userid			 = intval( mosGetParam( $_GET, 'userid', $my->id ) );
$catid			 = intval( mosGetParam( $_GET, 'catid', 0 ) );
$adid			 = intval( mosGetParam( $_GET, 'adid', 0 ) );
$order           = intval(mosGetParam( $_GET, 'order', 0 ));
$page            = mosGetParam( $_GET, 'page', "" );
$mode            = mosGetParam( $_GET, 'mode', 'email');

if (file_exists( $mosConfig_absolute_path .'/components/'.$option.'/cron.php' ))
	include_once( $mosConfig_absolute_path .'/components/'.$option.'/cron.php' );
	
if ($last_cron_date != date("Ymd"))  	
	manage_expiration($option);

$mainframe->addCustomHeadTag('<link rel="stylesheet" href="'.$mosConfig_live_site.'/components/'.$option.'/css/adsmanager.css" type="text/css" />');

	
switch ($page) {

  case 'show_profile': {
    $cache->call( 'show_profile',$userid,$option);
    break;
  }
  
  case 'save_profile': {
	mosCache::cleanCache( $option );
	save_profile($option);
    break;
  }
  
  case 'show_search': {
	$cache->call( 'show_search',$catid,$option);	
	break;
  }
  
  case 'show_user': {
	if ($my->id != $userid)
		$cache->call( 'show_user',$userid,$option,$expand,$text_search,$order,$limitstart);
	else
		show_user($userid,$option,$expand,$text_search,$order,$limitstart);
    break;
  }
  
  case 'show_category': {
	$cache->call( 'show_category',$catid,$option,$expand,$text_search,$order,$limitstart);	
    break;
  }

  case 'show_rules': {
	$cache->call('show_rules',$option);
    break;
  }

  case 'show_ad': {
	$ad_userid = $cache->call( 'show_ad',$adid,$option);
	
	// increment views. views from ad author are not counted to prevent highclicking views of own ad
	if ( $my->id <> $ad_userid) {
		$sql = "UPDATE #__adsmanager_ads SET views = LAST_INSERT_ID(views+1) WHERE id = $adid";
		$database->setQuery($sql);

		if ($database->getErrorNum()) {
			echo $database->stderr();
		} else {
			$database->query();
		}
	}
    break;
  }

  case 'write_ad': {
	write_ad($adid,$catid,$option);
    break;
  }
  
  case 'save_ad': {
	mosCache::cleanCache( $option );
	save_ad($option);
	
    break;
  }

  case 'delete_ad': {
	mosCache::cleanCache( $option );
    delete_ad($adid,$option);
    break;
  }
  
  case 'show_result':
	if (($catid == 0)||(!isset($catid)))
		show_all($option,$expand,$text_search,$order,$limitstart);
	else
		show_category($catid,$option,$expand,$text_search,$order,$limitstart);	
	break;

  case 'show_all': {
	$cache->call( 'show_all',$option,$expand,$text_search,$order,$limitstart);
	
    break;
  }
  
  case 'show_message_form': {
	$cache->call( 'show_message_form',$option,$adid,$mode);
	break;
  }
  
  case 'send_message': {
	send_message($option,$mode);
	break;
  }
  
  case 'search': {
	if ($catid == 0)
		$cache->call( 'show_all',$option,$expand,$text_search,$order,$limitstart);
	else
		$cache->call( 'show_category',$catid,$option,$expand,$text_search,$order,$limitstart);	
    break;
  
  }
  
  case 'expiration': {
	show_expiration($adid,$option);
	break;
  }
  
  default: {
	$cache->call('front',$option);
	break;
  }
}

adsmanager_html::show_footer();

function adsList($text,$description,$url,$page,$search,$text_search,$expand,$order,$catid,$option,$limitstart,$update_possible = 0)
{
	global $my,$database,$mosConfig_absolute_path;
	
	//$update_possible = 1;
	
	$database->setQuery( "SELECT f.* FROM #__adsmanager_fields AS f ".
						 "WHERE f.searchable = 1 AND f.published = 1 ORDER by f.ordering" );

	$fields_searchable = $database->loadObjectList();
	if ($database->getErrorNum()) {
		echo $database->stderr();
		return;
	}
	
	$url_param = "";
	
	if(isset($fields_searchable))
	{
		foreach($fields_searchable as $fsearch)
		{
			switch($fsearch->type)
			{
				case 'multicheckbox':
				case 'multiselect':
					$value = mosGetParam( $_GET, $fsearch->name, array() );
					for($i = 0,$nb=count($value);$i < $nb;$i++)
					{
						$url_param .= "&amp;".$fsearch->name."=".$value[$i];
						if ($i == 0)
							$search .= " AND (";	
						$search .= "a.$fsearch->name = ',$value[$i],'";
						if ($i < $nb - 1)
							$search .= " OR ";
						else
							$search .= " )";	
					}
					break;
				case 'checkbox':
				case 'radio':
				case 'select':	
					$value = mosGetParam( $_GET, $fsearch->name, "" );
					if ($value != "")
					{
						$search .= " AND a.$fsearch->name = '$value'";
						$url_param .= "&amp;".$fsearch->name."=".$value;
					}
		
				case 'textarea':
				case 'number':
				case 'price':
				case 'emailaddress':
				case 'url':
				case 'text':
					$value = mosGetParam( $_GET, $fsearch->name, "" );
					if ($value != "")
					{
						$search .= " AND a.$fsearch->name LIKE '%$value%'";
						$url_param .= "&amp;".$fsearch->name."=".$value;
					}
					break;
			}
		}
	}
	
		
	if ($text_search <> "") {
		$search .= " AND (a.ad_headline LIKE '%$text_search%' OR a.ad_text LIKE '%$text_search%') AND a.published = 1";
	}
	else
		$search .= " AND a.published = 1";
		
	$url .= $url_param;
	
	$database->setQuery( "SELECT COUNT(*) FROM #__adsmanager_ads as a WHERE $search");			
	$total = $database->loadResult();
	
	// get configuration
	$database->setQuery( "SELECT * FROM #__adsmanager_config");
	$database->loadObject($conf);
	if ($database -> getErrorNum()) {
		echo $database -> stderr();
		return false;
	}
	$limit = $conf->ads_per_page;
	
	if ($expand == -1)
	{
		if (($conf->display_expand == 0)||($conf->display_expand == 1))
		{
			$expand = 0;
		}
		else
		{
			$expand = 1;
		}	
	}
	
	$database->setQuery( "SELECT f.* FROM #__adsmanager_fields AS f WHERE f.published = 1" );

	$fields = $database->loadObjectList();
		
	if ($order == -1)
	{
		$order_text = "a.views DESC, a.date_created DESC ,a.id DESC";
	}
	else if ($order != 0)
	{
		$database->setQuery( "SELECT f.name,f.sort_direction,f.type FROM #__adsmanager_fields AS f WHERE f.fieldid=$order AND f.published = 1" );
		$database->loadObject($sort);
		if (($sort->type == "number")||($sort->type == "price"))
			$order_text = "a.".$sort->name." * 1 ".$sort->sort_direction;
		else
			$order_text = "a.".$sort->name." ".$sort->sort_direction;
	}
	else 
	{
		$order_text = "a.date_created DESC ,a.id DESC";
	}
	
	$database->setQuery( "SELECT f.title,f.fieldid,f.catsid FROM #__adsmanager_fields AS f WHERE f.sort = 1 AND f.published = 1" );

	$searchs = $database->loadObjectList();
		
	require_once( $mosConfig_absolute_path . '/includes/pageNavigation.php' );
	$pageNav = new mosPageNav( $total, $limitstart,$limit );
							
	$database->setQuery("SELECT a.*, p.name as parent, p.id as parentid, c.name as cat, c.id as catid, u.username as user ".
						"FROM #__adsmanager_ads as a ".
						"LEFT JOIN #__users as u ON a.userid = u.id ".
						"LEFT JOIN #__adsmanager_categories as c ON a.category = c.id ".
						"LEFT JOIN #__adsmanager_categories as p ON c.parent = p.id ".
						"WHERE $search and c.published = 1 ".
						"ORDER BY $order_text ",
						$limitstart,$limit);

	$ads = $database->loadObjectList();
	
	//*****************Mod by TomekOmel *******************
	
	$database->setQuery("SELECT c.* ".
						"FROM #__adsmanager_columns as c ".
						"ORDER BY c.ordering ");

	
	$columns = $database->loadObjectList();
	
	if (isset($columns))
	{
		$licz=0;
		$col = array();
		
		foreach ($columns as $c ) {
			
			if (($c->catsid == ",-1,")||($catid == 0)||(!isset($catid)))				//// TUTAJ POPRAWIC
				array_push( $col, $c );
			else 
			{	
				$find = ",".$catid.",";
				if (strstr($c->catsid, $find))
					array_push( $col, $c );
			}
		}
	}
	
	unset($columns);
	$columns = $col;
	
	//***************** END of TomekOmel **********************/
		
	$database->setQuery( "SELECT c.* FROM #__adsmanager_fields AS c ".
						 "WHERE c.columnid != -1 AND c.published = 1 ORDER by c.columnorder,c.fieldid" );

	$fields = $database->loadObjectList();
	
	// establish the hierarchy of the menu
	$fColumn = array();
	// first pass - collect children
	if (isset($fields))
	{
		foreach ($fields as $f ) {
			$pt 	= $f->columnid;
			$list 	= @$fColumn[$pt] ? $fColumn[$pt] : array();
			array_push( $list, $f );
			$fColumn[$pt] = $list;
		}
	}
	
	$database->setQuery( "SELECT * FROM #__adsmanager_positions WHERE 1 " );

	$positions = $database->loadObjectList();
	if ($database->getErrorNum()) {
		echo $database->stderr();
		return;
	}
	
	$database->setQuery( "SELECT f.* FROM #__adsmanager_fields AS f ".
						 "WHERE f.pos != -1 AND f.published = 1 ORDER by f.posorder" );

	$fields = $database->loadObjectList();
	if ($database->getErrorNum()) {
		echo $database->stderr();
		return;
	}
	
	// establish the hierarchy of the menu
	$fDisplay = array();
	// first pass - collect children
	if (isset($fields))
	{
		foreach ($fields as $f ) {
			$pt 	= $f->pos;
			$list 	= @$fDisplay[$pt] ? $fDisplay[$pt] : array();
			array_push( $list, $f );
			$fDisplay[$pt] = $list;
		}
	}
	
	//get value fields
	$database->setQuery( "SELECT * FROM #__adsmanager_field_values ORDER by ordering ");
	$fieldvalues = $database->loadObjectList();
	if ($database -> getErrorNum()) {
		echo $database -> stderr();
		return false;
	}
	
	$field_values = array();
	// first pass - collect children
	if (isset($fieldvalues))
	{
		foreach ($fieldvalues as $v ) {
			$pt 	= $v->fieldid;
			$list 	= @$field_values[$pt] ? $field_values[$pt] : array();
			array_push( $list, $v );
			$field_values[$pt] = $list;
		}
	}

	if (($conf->show_contact == 1)&&($my->id == "0"))
		$show_contact = 0;
	else
		$show_contact = 1;
			
	$itemid = intval( mosGetParam( $_GET, 'Itemid', 0 ));
	
	$nav_link = $url."&expand=".$expand."&amp;Itemid=".$itemid;
	
	adsmanager_html::show_list($catid,$description,$text,$url,$page,$ads,$pageNav,$nav_link,
							   $show_contact,$expand,$order,$text_search,
							   $itemid,$option,$my->id,$update_possible,
							   $searchs,
							   $columns,$fColumn,$positions,$fDisplay,$field_values,
							   $conf,
							   $fields_searchable);
}

function getSubCatsList($cats,$catid,&$list,$itemid,$option,$order,$expand){
	$i=0;
	if(isset($cats))
	{
		foreach($cats as $cat) {
			if ($cat->parent == $catid)
			{
				$list[$i]->text   = $cat->name;//." (".$cat->num_ads.")";
				$list[$i++]->link = sefRelToAbs('index.php?option='.$option.'&amp;page=show_category&amp;catid='.$cat->id.'&amp;text_search=&amp;order='.$order.'&amp;expand='.$expand.'&amp;Itemid='.$itemid);
			} 
		}
	}
}

function getPathList($cats,$catid,$catname,&$list,$itemid,$option,$order,$expand){
	$orderlist = array();
	if(isset($cats))
	{
		foreach ($cats as $c ) {
			$orderlist[$c->id] = $c;
		}
	
		$i=0;
		$list[$i]->text   = $orderlist[$catid]->name;
		$list[$i]->link   = sefRelToAbs('index.php?option='.$option.'&amp;page=show_category&amp;catid='.$catid.'&amp;text_search=&amp;order='.$order.'&amp;expand='.$expand.'&amp;Itemid='.$itemid);
		$i++;
	
		if ($catid != -1)
		{
			$current = $catid;
			
			while($orderlist[$current]->parent != 0)
			{
				$current = $orderlist[$current]->parent;
				$list[$i]->text   = $orderlist[$current]->name;
				$list[$i]->link   = sefRelToAbs('index.php?option='.$option.'&amp;page=show_category&amp;catid='.$orderlist[$current]->id.'&amp;text_search=&amp;order='.$order.'&amp;expand='.$expand.'&amp;Itemid='.$itemid);
				$i++;
					
			}
		}
	}
}

function show_search($catid,$option)
{
	global $my,$database,$mosConfig_absolute_path,$mainframe;
	
	// Dynamic Page Title
	$mainframe->SetPageTitle( ADSMANAGER_PAGE_TITLE . ADSMANAGER_ADVANCED_SEARCH );
	
	$database->setQuery( "SELECT f.* FROM #__adsmanager_fields AS f ".
						 "WHERE f.searchable = 1 AND f.published = 1 ORDER by f.ordering" );

	$fields_searchable = $database->loadObjectList();
	if ($database->getErrorNum()) {
		echo $database->stderr();
		return;
	}
	
	//get value fields
	$database->setQuery( "SELECT * FROM #__adsmanager_field_values ORDER by ordering ");
	$fieldvalues = $database->loadObjectList();
	if ($database -> getErrorNum()) {
		echo $database -> stderr();
		return false;
	}
	
	$field_values = array();
	// first pass - collect children
	if (isset($fieldvalues))
	{
		foreach ($fieldvalues as $v ) {
			$pt 	= $v->fieldid;
			$list 	= @$field_values[$pt] ? $field_values[$pt] : array();
			array_push( $list, $v );
			$field_values[$pt] = $list;
		}
	}
	
	$itemid = intval( mosGetParam( $_GET, 'Itemid', 0 ));

	$paths[0]->text = ADSMANAGER_ROOT_TITLE;
	$paths[0]->link = sefRelToAbs('index.php?option='.$option.'&amp;Itemid='.$itemid);
	adsmanager_html::show_pathway($paths,$option);
	
	getCatTree($cats);
	
	adsmanager_html::show_search($option,$fields_searchable,$field_values,$catid,$cats,$itemid);
}

function show_all($option,$expand,$text_search,$order,$limitstart)
{
	global $mainframe,$database,$mosConfig_absolute_path,$mosConfig_live_site;
	
	$itemid          = intval( mosGetParam( $_GET, 'Itemid', 0 ));
	
	// Dynamic Page Title
	$mainframe->SetPageTitle( ADSMANAGER_PAGE_TITLE . ADSMANAGER_LIST_TEXT );
	
	//Pathway
	$database->setQuery( "SELECT c.id, c.name,c.parent ".
						" FROM #__adsmanager_categories as c ".
						 "WHERE c.published = 1 ORDER BY c.parent,c.ordering");
	$list = $database->loadObjectList();
	getSubCatsList($list,0,$subcats,$itemid,$option,$order,$expand);
	$paths[0]->text = ADSMANAGER_ROOT_TITLE;
	$paths[0]->link = sefRelToAbs('index.php?option='.$option.'&amp;Itemid='.$itemid);
	adsmanager_html::show_pathway($paths,$option);
	adsmanager_html::show_subcats($subcats);
		
	//List
	$url ="index.php?option=$option&amp;page=show_all&amp;text_search=".$text_search."&amp;order=".$order;
	adsList(ADSMANAGER_LIST_TEXT,"",$url,"show_all","1",$text_search,$expand,$order,0,$option,$limitstart);
}

function show_user($userid,$option,$expand,$text_search,$order,$limitstart)
{
	global $database,$mosConfig_absolute_path,$mosConfig_live_site,$my,$mainframe;
	
	$itemid          = intval( mosGetParam( $_GET, 'Itemid', 0 ));
	
	//PathWay
	$paths[0]->text = ADSMANAGER_ROOT_TITLE;
	$paths[0]->link = sefRelToAbs('index.php?option='.$option.'&amp;Itemid='.$itemid);
	adsmanager_html::show_pathway($paths,$option);
	
	// get configuration
	$database->setQuery( "SELECT * FROM #__adsmanager_config");
	$database->loadObject($conf);
	if ($database -> getErrorNum()) {
		echo $database -> stderr();
		return false;
	}
	
    if ($userid == "0")
    {
		adsmanager_html::loginpage($_SERVER['REQUEST_URI'],$conf->comprofiler);
    }
    else
    { 
    
		if ($conf->comprofiler == 2)
		{
			mosRedirect(sefRelToAbs("index.php?option=com_comprofiler&amp;task=userProfile&amp;tab=AdsManagerTab&amp;user=$userid&amp;Itemid=&amp;Itemid=$itemid"),"");
		}
		else
		{
			//Dynamic Page Title
			$user = new mosUser( $database );
			$user->load( $userid );
			$name_list = ADSMANAGER_LIST_USER_TEXT." ".$user->username;
			$mainframe->SetPageTitle( ADSMANAGER_PAGE_TITLE . $name_list );
			
			//List
			$url ="index.php?option=$option&amp;page=show_user&amp;userid=".$userid."&amp;text_search=".$text_search."&amp;order=".$order;
			//adsList($name_list,"user.gif",$url,"show_user",,$text_search,$expand,$order,0);
			if ($my->id == $userid)
				$update_possible = 1;
			else
				$update_possible = 0;
			adsList($name_list,"",$url,"show_user","userid=$userid",$text_search,$expand,$order,0,$option,$limitstart,$update_possible);
		}
	}
}

function recurseSearch ($rows,&$list,$catid){
	if(isset($rows))
	{
		foreach($rows as $row) {
			if ($row->parent == $catid)
			{
				$list[]= $row->id;
				recurseSearch($rows,$list,$row->id);
			} 
		}
	}
}

function show_category($catid,$option,$expand,$text_search,$order,$limitstart)
{
	global $database,$mosConfig_absolute_path,$mosConfig_live_site,$my,$mainframe;
	
	$itemid          = intval( mosGetParam( $_GET, 'Itemid', 0 ));
	
	// get category-name: #__adsmanager_category
	$database->setQuery("SELECT c.id, c.name, c.description, c.parent ".
						" FROM #__adsmanager_categories as c WHERE c.published='1' AND c.id=$catid");
	
	$database->loadObject($category);
	
	$cat_name 		 = $category->name;
	$cat_description = $category->description;
	$parent 	     = $category->parent;
	
	//Dynamic Page Title
	$mainframe->SetPageTitle( ADSMANAGER_PAGE_TITLE . $cat_name );
	
	$linkTarget = sefRelToAbs("index.php?option=$option&amp;page=show_category&amp;catid=$catid&amp;Itemid=$itemid");
	
	$database->setQuery( "SELECT c.id, c.name,c.parent ".
						" FROM #__adsmanager_categories as c ".
						 "WHERE c.published = 1 ORDER BY c.parent,c.ordering");
						 
	$listcats = $database->loadObjectList();
	getPathList($listcats,$catid,$cat_name,$paths,$itemid,$option,$order,$expand);
	$nb =count($paths);
	$paths[$nb]->text = ADSMANAGER_ROOT_TITLE;
	$paths[$nb]->link = sefRelToAbs('index.php?option='.$option.'&amp;page=show_all&amp;text_search=&amp;order='.$order.'&amp;expand='.$expand.'&amp;Itemid='.$itemid);
	getSubCatsList($listcats,$catid,$subcats,$itemid,$option,$order,$expand);
	adsmanager_html::show_pathway($paths,$option);
	adsmanager_html::show_subcats($subcats);
	
	//List		
	$list[] = $catid;
	recurseSearch($listcats,$list,$catid);
	$listids = implode(',', $list);
	$database->setQuery("SELECT count(*) FROM #__adsmanager_ads WHERE category IN ($listids)");	
	$search = "category IN ($listids)";
	$url ="index.php?option=$option&amp;page=show_category&amp;catid=".$catid."&amp;text_search=".$text_search."&amp;order=".$order;
	adsList($cat_name,$cat_description,$url,"show_category",$search,$text_search,$expand,$order,$catid,$option,$limitstart);
}

function show_message_form($option,$adid,$mode)
{
	global $database,$my,$mainframe;
	
	$itemid = intval( mosGetParam( $_GET, 'Itemid', 0 ));
	
	$database->setQuery("SELECT a.* FROM #__adsmanager_ads as a WHERE a.id=$adid");
	$database->loadObject($ad);
	
	$user = new mosUser( $database );
	if($my->id > 0)
		$user->load( $my->id );
		
	if ($mode == 0) //Email
	{
		// get configuration
		$database->setQuery( "SELECT allow_attachement FROM #__adsmanager_config");
		$database->loadObject($conf);
		if ($database -> getErrorNum()) {
			echo $database -> stderr();
			return false;
		}	
		adsmanager_html::show_message_form($option,$ad,$user,$mode,$conf->allow_attachement,$itemid);
	}
	else // PMS
		adsmanager_html::show_message_form($option,$ad,$user,$mode,0,$itemid);
	
}

function send_message($option,$mode)
{
	global $database,$mosConfig_absolute_path,$my,$_MAMBOTS;

	$itemid = intval( mosGetParam( $_GET, 'Itemid', 0 ));
	$adid = intval( mosGetParam( $_POST, 'adid' , 0  ));
	
	$database->setQuery("SELECT * FROM #__adsmanager_ads as a WHERE a.id=$adid");
	$database->loadObject($ad);
	
	if (isset($ad))
	{
		$name = mosGetParam($_POST,  'name' , "" );
		$email = mosGetParam($_POST, 'email', "" );
		$title = mosGetParam($_POST, 'title', "" );
		$body = mosGetParam($_POST,  'body' , "" );
		
		if ($mode == 1)
		{
			$_MAMBOTS->loadBotGroup( 'com_adsmanager' );
			$results = $_MAMBOTS->trigger( 'onSendPMS', array( $ad->userid,$my->id,$title,$body ), false );
		}
		else
		{	
			if ($_FILES['attach_file']['tmp_name'] != "")
			{
				$directory = ini_get('upload_tmp_dir')."";
				if ($directory == "")
					$directory = ini_get('session.save_path')."";
					
				$filename = $directory."/".basename($_FILES['attach_file']['name']);
				rename($_FILES['attach_file']['tmp_name'], $filename);
				mosMail($email,$name,$ad->email,$title,$body,1,NULL,NULL,$filename);
			}
			else
				mosMail($email,$name,$ad->email,$title,$body,1);
		}
	}
	
	mosRedirect(sefRelToAbs("index.php?option=$option&amp;page=show_ad&amp;adid=$adid&amp;Itemid=$itemid"),ADSMANAGER_MESSAGE_SENT);
}

function show_ad($adid,$option)
{
	global $database,$my,$mainframe;
	
	$itemid          = intval( mosGetParam( $_GET, 'Itemid', 0 ));
	
	$database->setQuery("SELECT a.*, p.name as parent, p.id as parentid, c.name as cat, c.id as catid, u.username as user ".
						"FROM #__adsmanager_ads as a ".
						"LEFT JOIN #__users as u ON a.userid = u.id ".
						"LEFT JOIN #__adsmanager_categories as c ON a.category = c.id ".
						"LEFT JOIN #__adsmanager_categories as p ON c.parent = p.id ".
						"WHERE a.id=$adid and c.published");

	$database->loadObject($ad);
	
	//Dynamic Page Title
	$mainframe->SetPageTitle( ADSMANAGER_PAGE_TITLE . $ad->cat . " - ". $ad->ad_headline );
	
	//PathWay
	$database->setQuery( "SELECT c.* FROM #__adsmanager_categories as c ".
						 "WHERE c.published = 1 ORDER BY c.parent,c.ordering");
	$listcats = $database->loadObjectList();
	getPathList($listcats,$ad->category,$ad->cat,$paths,$itemid,$option,0,0);
	$nb =count($paths);
	$paths[$nb]->text =ADSMANAGER_ROOT_TITLE;
	$paths[$nb]->link = sefRelToAbs('index.php?option='.$option.'&amp;page=show_all&amp;Itemid='.$itemid);
	adsmanager_html::show_pathway($paths,$option);
		
	
	// get configuration
	$database->setQuery( "SELECT * FROM #__adsmanager_config");
	$database->loadObject($conf);
	if ($database -> getErrorNum()) {
		echo $database -> stderr();
		return false;
	}		
		
	//Show Ad
	if (($conf->show_contact == 1)&&($my->id == "0"))
		$show_contact = 0;
	else
		$show_contact = 1;
		
	$database->setQuery( "SELECT * FROM #__adsmanager_positions WHERE 1 " );

	$positions = $database->loadObjectList();
	if ($database->getErrorNum()) {
		echo $database->stderr();
		return;
	}
	
	$database->setQuery( "SELECT f.* FROM #__adsmanager_fields AS f ".
						 "WHERE f.pos != -1 AND f.published = 1 ORDER by f.posorder" );

	$fields = $database->loadObjectList();
	if ($database->getErrorNum()) {
		echo $database->stderr();
		return;
	}
	
	//get value fields
	$database->setQuery( "SELECT * FROM #__adsmanager_field_values ORDER by ordering ");
	$fieldvalues = $database->loadObjectList();
	if ($database -> getErrorNum()) {
		echo $database -> stderr();
		return;
	}
	
	$field_values = array();
	// first pass - collect children
	if (isset($fieldvalues))
	{
		foreach ($fieldvalues as $v ) {
			$pt 	= $v->fieldid;
			$list 	= @$field_values[$pt] ? $field_values[$pt] : array();
			array_push( $list, $v );
			$field_values[$pt] = $list;
		}
	}
	
	// establish the hierarchy of the menu
	$fDisplay = array();
	// first pass - collect children
	if (isset($fields))
	{
		foreach ($fields as $f ) {
			$pt 	= $f->pos;
			$list 	= @$fDisplay[$pt] ? $fDisplay[$pt] : array();
			array_push( $list, $f );
			$fDisplay[$pt] = $list;
		}
	}			
	adsmanager_html::show_html_ad($ad,$show_contact,$option,$itemid,$positions,$fDisplay,$field_values,$conf,1,0);
	
	return $ad->id;
}

function createImageAndThumb($src_file,$image_name,$thumb_name,
							$max_width,
						    $max_height,
							$max_width_t,
							$max_height_t,
							$tag,
							$path,
							$orig_name)
{
	global $mosConfig_absolute_path;
	
	$types = array( 
        IMAGETYPE_JPEG => 'jpeg', 
        IMAGETYPE_GIF => 'gif', 
        IMAGETYPE_PNG => 'png' 
    ); 
	
    ini_set('memory_limit', '20M');

	
	$src_file = urldecode($src_file);
	/*if (extension_loaded('exif')) 
	{
		$type2 = exif_imagetype($src_file);
		$types = array( 
			IMAGETYPE_JPEG => 'jpeg', 
			IMAGETYPE_GIF => 'gif', 
			IMAGETYPE_PNG => 'png' 
		); 
    
		$type = $types[$type2]; 
	}
	else
	{*/
		$orig_name = strtolower($orig_name);
		$findme  = '.jpg';
		$pos = strpos($orig_name, $findme);
		if ($pos === false)
		{
			$findme  = '.jpeg';
			$pos = strpos($orig_name, $findme);
			if ($pos === false)
			{
				$findme  = '.gif';
				$pos = strpos($orig_name, $findme);
				if ($pos === false)
				{
					$findme  = '.png';
					$pos = strpos($orig_name, $findme);
					if ($pos === false)
					{
						return;
					}
					else
					{
						$type = "png";
					}
				}
				else
				{
					$type = "gif";
				}
			}
			else
			{
				$type = "jpeg";
			}
		}
		else
		{
			$type = "jpeg";
		}
	//}
	
	$max_h = $max_height;
	$max_w = $max_width;
	$max_thumb_h = $max_height_t;
	$max_thumb_w = $max_width_t;
	
	if ( file_exists( "$path/$image_name")) {
		unlink( "$path/$image_name");
	}
	
	if ( file_exists( "$path/$thumb_name")) {
		unlink( "$path/$thumb_name");
	}
	
	$read = 'imagecreatefrom' . $type; 
	$write = 'image' . $type; 
	
	$src_img = $read($src_file);
	
	// height/width
	$imginfo = getimagesize($src_file);
	$src_w = $imginfo[0];
	$src_h = $imginfo[1];
	
	$zoom_h = $max_h / $src_h;
    $zoom_w = $max_w / $src_w;
    $zoom   = min($zoom_h, $zoom_w);
    $dst_h  = $zoom<1 ? round($src_h*$zoom) : $src_h;
    $dst_w  = $zoom<1 ? round($src_w*$zoom) : $src_w;
	
	$zoom_h = $max_thumb_h / $src_h;
    $zoom_w = $max_thumb_w / $src_w;
    $zoom   = min($zoom_h, $zoom_w);
    $dst_thumb_h  = $zoom<1 ? round($src_h*$zoom) : $src_h;
    $dst_thumb_w  = $zoom<1 ? round($src_w*$zoom) : $src_w;
	
	$dst_img = imagecreatetruecolor($dst_w,$dst_h);
	
	$white = imagecolorallocate($dst_img,255,255,255);
	imagefill($dst_img,0,0,$white);
	imagecopyresampled($dst_img,$src_img, 0,0,0,0, $dst_w,$dst_h,$src_w,$src_h);
	$textcolor = imagecolorallocate($dst_img, 255, 255, 255);
	if (isset($tag))
		imagestring($dst_img, 5, 5, 5, "$tag", $textcolor);  
	$desc_img = $write($dst_img,"$path/$image_name", 75);
	
	
	$dst_t_img = imagecreatetruecolor($dst_thumb_w,$dst_thumb_h);
	$white = imagecolorallocate($dst_img,255,255,255);
	imagefill($dst_t_img,0,0,$white);
	imagecopyresampled($dst_t_img,$src_img, 0,0,0,0, $dst_thumb_w,$dst_thumb_h,$src_w,$src_h);
	$textcolor = imagecolorallocate($dst_t_img, 255, 255, 255);
	if (isset($tag))
		imagestring($dst_t_img, 2, 2, 2, "$tag", $textcolor);
	$desc_img = $write($dst_t_img,"$path/$thumb_name", 75);
	
}

function save_ad($option){
	global $database,$mosConfig_absolute_path,$mosConfig_mailfrom,$my;
	$row = new adsManagerAd($database);
	
	$itemid = intval( mosGetParam( $_GET, 'Itemid', 0 ));

	// get configuration
	$database->setQuery( "SELECT * FROM #__adsmanager_config");
	$database->loadObject($conf);
	if ($database -> getErrorNum()) {
		echo $database -> stderr();
		return false;
	}
	
	if (($my->id != "0")&&($conf->nb_ads_by_user != -1))
	{
		$database->setQuery( "SELECT count(*) FROM #__adsmanager_ads as a WHERE a.userid =".$my->id);
		$nb = $database->loadResult();
		if ($nb >= $conf->nb_ads_by_user)
		{
			$redirect_text = sprintf(ADSMANAGER_MAX_NUM_ADS_REACHED,$conf->nb_ads_by_user);
			mosRedirect(sefRelToAbs("index.php?option=$option&amp;Itemid=$itemid"),$redirect_text);
		}
	}
	
	// bind it to the table
	if (!$row -> bind($_POST)) {
		echo "<script> alert('"
			.$row -> getError()
			."'); window.history.go(-1); </script>\n";
		exit();
	}                                             
	
	if (($conf->submission_type == 0)&&($my->id == 0))
	{
		$username = mosGetParam( $_POST, 'username', "" );
		$password = mosGetParam( $_POST, 'password', ""  );
		$email = mosGetParam( $_POST, 'email', ""  );
		$errorMsg = checkAccount($username,$password,$email,$userid,$conf);
		if (isset($errorMsg))
		{
			$catid = intval(mosGetParam( $_POST, 'category', 0 ));
			$url = sefRelToAbs("index.php?option=$option&page=write_ad&catid=$catid&Itemid=$itemid");
			echo "<form name='form' action='$url' method='post'>"; 
			foreach($_POST as $key=>$val) 
			{
				echo "<input type='hidden' name='$key' value='".htmlentities(stripslashes($val),ENT_QUOTES)."'>"; 
			}
			echo "<input type='hidden' name='errorMsg' value='$errorMsg'>"; 
			echo '</form>'; 
			echo '<script language="JavaScript">'; 
			echo 'document.form.submit()'; 
			echo '</script>'; 		
			return;
		}
		
		$row->userid = $userid;
	}
	else
	{
		$row->userid = $my->id;
	}
	
	//get fields
	$database->setQuery( "SELECT * FROM #__adsmanager_fields WHERE published = 1");
	$fields = $database->loadObjectList();
	if ($database -> getErrorNum()) {
		echo $database -> stderr();
		return false;
	}	
	
	$isUpdateMode  = intval(mosGetParam( $_POST, 'isUpdateMode', 0));
	if ($isUpdateMode == 0)
	{
		if ($conf->auto_publish == 1)
		{
			$row->published = 1;
			$redirect_text = ADSMANAGER_INSERT_SUCCESSFULL_PUBLISH;
		}
		else
		{
			$row->published = 0;
			$redirect_text = ADSMANAGER_INSERT_SUCCESSFULL_CONFIRM;
		}
	}
	else
		$redirect_text .= ADSMANAGER_UPDATE_SUCCESSFULL;
	
	if ($isUpdateMode == 0)
	{
		$row->date_created = date("Y-m-d");
	}
	
	// store it in the db
	if (!$row -> store()) {
		echo "<script> alert('"
			.$row -> getError()
			."'); window.history.go(-1); </script>\n";
		exit();	
	}
	
	$query = "UPDATE #__adsmanager_ads ";
	
	$first=0;
	if(isset($fields))
	{
		foreach($fields as $field)
		{ 	
			if ($field->type == "multiselect")
			{	
				$value = mosGetParam( $_POST, $field->name, array() );
				//$valueA = explode("|*|",$value);
				$value = ",".implode(',', $value).",";
				if ($value != "")
				{
					if ($first == 0)
						$query .= "SET"; 
					else
						$query .= ",";
					$first = 1;
					$query .= " $field->name = '".$value."' ";
					//echo "$query";
					//return;
				}
			
			}
			else if ($field->type == "multicheckbox")
			{
				$value = mosGetParam( $_POST, $field->name, array() );
				$value = ",".implode(',', $value).",";
				if ($value != "")
				{
					if ($first == 0)
						$query .= "SET"; 
					else
						$query .= ",";
					$first = 1;
					$query .= " $field->name = '".$value."' ";
				}
			}
			else
			{
				$value = mosGetParam( $_POST, $field->name, "" );
				if ($value != "")
				{
					if ($first == 0)
						$query .= "SET"; 
					else
						$query .= ",";
					$first = 1;
					$query .= " $field->name = '".$value."' ";
				}
			}
		}
	}
	$query .= "WHERE id = ".$row->id;
	
	if ($first != 0)
	{
		$database->setQuery( $query);
		$database->query();
	}
	
	$nbImages = $conf->nb_images;
	
	for($i = 1 ;$i < $nbImages + 1; $i++)
	{	
		$ext_name = chr(ord('a')+$i-1);
		$cb_image = mosGetParam( $_POST, "cb_image$i", "" );
		// image1 delete
		if ( $cb_image == "delete") {
			$pict = $mosConfig_absolute_path."/images/$option/ads/".$row->id.$ext_name."_t.jpg";
			if ( file_exists( $pict)) {
				unlink( $pict);
			}
			$pic = $mosConfig_absolute_path."/images/$option/ads/".$row->id.$ext_name.".jpg";
			if ( file_exists( $pic)) {
				unlink( $pic);
			}
		}
							
		if (isset( $_FILES["ad_picture$i"])) {
			if ( $_FILES["ad_picture$i"]['size'] > $conf->max_image_size) {
				mosRedirect(sefRelToAbs("index.php?option=$option&amp;act=ads&amp;catid=".$row->category."&amp;Itemid=".$itemid), ADSMANAGER_IMAGETOOBIG);
				return;
			}
		}
		
		// image1 upload
		if (isset( $_FILES["ad_picture$i"]) and !$_FILES["ad_picture$i"]['error'] ) {
			createImageAndThumb($_FILES["ad_picture$i"]['tmp_name'],$row->id.$ext_name.".jpg",$row->id.$ext_name."_t.jpg",
								$conf->max_width,
								$conf->max_height,
								$conf->max_width_t,
								$conf->max_height_t,
								$conf->tag,
								$mosConfig_absolute_path."/images/$option/ads/",
								$_FILES["ad_picture$i"]['name']);
		}
	}
	
	if ((($conf->send_email_on_new == 1)&&($isUpdateMode == 0))||(($conf->send_email_on_update == 1)&&($isUpdateMode == 1)))
	{
		$title = mosGetParam( $_POST, "ad_headline", "" );
		$body = mosGetParam( $_POST, "ad_text", "" );
		sendAdEmail($isUpdateMode,$title,$body,$mosConfig_mailfrom);
	}
	
	if ($conf->comprofiler == 2)
		mosRedirect(sefRelToAbs("index.php?option=com_comprofiler&amp;task=userProfile&amp;tab=AdsManagerTab&amp;Itemid=$itemid"),$redirect_text);
	else
		mosRedirect(sefRelToAbs("index.php?option=$option&amp;page=show_user&amp;Itemid=$itemid"),$redirect_text);
}

function sendAdEmail($isUpdateMode,$title,$body,$email)
{
	global $mosConfig_mailfrom, $mosConfig_fromname;
	
	if ($isUpdateMode == 1)
	{
		$subject = ADSMANAGER_EMAIL_UPDATE.$title;
	}
	else
	{
		$subject = ADSMANAGER_EMAIL_NEW.$title;
	}
	
	mosMail($mosConfig_mailfrom,$mosConfig_fromname,$mosConfig_mailfrom, $subject , $body,1);
}

function write_ad($adid,$catid,$option)
{
	global $database,$my;
	
	$itemid  = intval( mosGetParam( $_GET, 'Itemid', 0 ));
	$errorMsg = mosGetParam( $_POST, 'errorMsg', "" );
	
	// get configuration
	$database->setQuery( "SELECT * FROM #__adsmanager_config");
	$database->loadObject($conf);
	if ($database -> getErrorNum()) {
		echo $database -> stderr();
		return false;
	}
	
	if (($my->id != "0")&&($conf->nb_ads_by_user != -1))
	{
		$database->setQuery( "SELECT count(*) FROM #__adsmanager_ads as a WHERE a.userid =".$my->id);
		$nb = $database->loadResult();
		if ($nb >= $conf->nb_ads_by_user)
		{
			$redirect_text = sprintf(ADSMANAGER_MAX_NUM_ADS_REACHED,$conf->nb_ads_by_user);
			mosRedirect(sefRelToAbs("index.php?option=$option&amp;Itemid=$itemid"),$redirect_text);
		}
	}
	
	//PathWay
	$paths[0]->text = ADSMANAGER_ROOT_TITLE;
	$paths[0]->link = sefRelToAbs('index.php?option='.$option.'&amp;Itemid='.$itemid);
	adsmanager_html::show_pathway($paths,$option);

	/* submission_type = 1 -> Account needed */
    if (($conf->submission_type == 1)&&($my->id == "0")) {	
		adsmanager_html::loginpage($_SERVER['REQUEST_URI'],$conf->comprofiler);	  
    }
    else
    {   	
		//get fields
		$database->setQuery( "SELECT * FROM #__adsmanager_fields WHERE published = 1 ORDER by ordering");
		$fields = $database->loadObjectList();
		if ($database -> getErrorNum()) {
			echo $database -> stderr();
			return false;
		}	
		
		//get value fields
		$database->setQuery( "SELECT * FROM #__adsmanager_field_values ORDER by ordering ");
		$fieldvalues = $database->loadObjectList();
		if ($database -> getErrorNum()) {
			echo $database -> stderr();
			return false;
		}
		
		$field_values = array();
		// first pass - collect children
		if(isset($fieldvalues))
		{
			foreach ($fieldvalues as $v ) {
				$pt 	= $v->fieldid;
				$list 	= @$field_values[$pt] ? $field_values[$pt] : array();
				array_push( $list, $v );
				$field_values[$pt] = $list;
			}
		}
		
		/* No need to user query, if errorMsg */
		if ($errorMsg == "")
		{
			if ($conf->comprofiler == 0)
			{	
				$database->setQuery("SELECT p.*,u.* FROM #__adsmanager_profile as p ".
									"LEFT JOIN #__users as u ON u.id = p.userid ".
									"WHERE p.userid=".$my->id);
				$database->loadObject($user);
			}
			else
			{
				$database->setQuery("SELECT f.name as name,c.name as cbname,c.table FROM #__comprofiler_fields as c ".
									"LEFT JOIN #__adsmanager_fields as f ON f.cb_field  = c.fieldid ".
									"WHERE f.cb_field <> 1 AND f.published = 1");
									
				$rows = $database->loadObjectList();
				$sql="SELECT ";
				for($i=0,$nb=count($rows);$i<$nb;$i++)
				{
					if ($rows[$i]->table == "#__comprofiler")
						$sql .= "cb.".$rows[$i]->cbname." as ".$rows[$i]->name;
					else
						$sql .= "u.".$rows[$i]->cbname." as ".$rows[$i]->name;
						
					if ($i != $nb - 1)
						$sql .= ",";
				}				
			
				$database->setQuery("$sql FROM #__comprofiler as cb, #__users as u ".
									"WHERE cb.user_id=".$my->id." AND u.id=".$my->id);
																	
				$database->loadObject($user);	
			}
		}
		
		// Update Ad ?
		if( $adid > 0)
		{ // edit ad	
			// 1. get data
			$database->setQuery("SELECT * FROM #__adsmanager_ads WHERE id=$adid");
			$database->loadObject($ad);
			if ($database -> getErrorNum()) {
				echo $database -> stderr();
				return false;
			}
	
			$ad->ad_text = str_replace ('<br/>',"\r\n",$ad->ad_text);
			$ad->ad_text = stripslashes($ad->ad_text);
			$ad->ad_headline = stripslashes($ad->ad_headline);
	
			if ($catid == 0)
				$catid = $ad->category;
			
			if ($ad->userid == $my->id)
			{
				$isUpdateMode = 1;
			}
			else
			{
				$isUpdateMode = 0;
				$ad = null;	
			}
		}
		else { // insert
			$isUpdateMode = 0;	
		}
		
		if(!isset($ad))
		{
			$ad = new adsManagerAd($database);
		}
		
		getCatTree($tree);
		
		if ($errorMsg == "")
			adsmanager_html::show_write_form($isUpdateMode,$ad,$user,$fields,$field_values,$catid,$tree,$itemid,$option,$conf,$errorMsg);
		else
		{
			$default = (object) $_POST;
			adsmanager_html::show_write_form($isUpdateMode,$default,$default,$fields,$field_values,$catid,$tree,$itemid,$option,$conf,$errorMsg);			
		}
	}
}

function delete_ad($adid,$option)
{
	global $mosConfig_absolute_path,$database,$my;
	
	$itemid  = intval( mosGetParam( $_GET, 'Itemid', 0 ));

    if ($my->id == "0") { // user not logged in
		// get configuration
		$database->setQuery( "SELECT * FROM #__adsmanager_config");
		$database->loadObject($conf);
		if ($database -> getErrorNum()) {
			echo $database -> stderr();
			return false;
		}
		//PathWay
		$paths[0]->text = ADSMANAGER_ROOT_TITLE;
		$paths[0]->link = sefRelToAbs('index.php?option='.$option.'&amp;Itemid='.$itemid);
		adsmanager_html::show_pathway($paths,$option);
		adsmanager_html::loginpage($_SERVER['REQUEST_URI'],$conf->comprofiler);	  		
    }
    else {  // user logged in

	    $mode  =  mosGetParam( $_GET, 'mode', "");
		if ( $mode =="confirm") {
			
			$database->setQuery("SELECT * FROM #__adsmanager_ads WHERE id=$adid");
			$database->loadObject($ad);
			if ($database -> getErrorNum()) {
				echo $database -> stderr();
				return false;
			}
			
			if (($ad->userid == $my->id)||($my->id == 62))
			{
				$database->setQuery("DELETE FROM #__adsmanager_ads WHERE id=$adid");
				if ($database->getErrorNum()) {
					echo $database->stderr();
				} else {
					$database->query();
				}
	
				// image1 delete
				$a_pict = $mosConfig_absolute_path."/images/$option/ads/".$adid."a_t.jpg";
				if ( file_exists( $a_pict)) {
					unlink( $a_pict);
				}
				$a_pic = $mosConfig_absolute_path."/images/$option/ads/".$adid."a.jpg";
				if ( file_exists( $a_pic)) {
					unlink( $a_pic);
				}
				// image2 delete
				$b_pict = $mosConfig_absolute_path."/images/$option/ads/".$adid."b_t.jpg";
				if ( file_exists( $b_pict)) {
					unlink( $b_pict);
				}
				$b_pic = $mosConfig_absolute_path."/images/$option/ads/".$adid."b.jpg";
				if ( file_exists( $b_pic)) {
					unlink( $b_pic);
				}
			}
			
			// get configuration
			$database->setQuery( "SELECT * FROM #__adsmanager_config");
			$database->loadObject($conf);
			if ($database -> getErrorNum()) {
				echo $database -> stderr();
				return false;
			}	
			
			if ($conf->comprofiler == 2)
				mosRedirect(sefRelToAbs("index.php?option=com_comprofiler&amp;task=userProfile&amp;tab=AdsManagerTab&amp;Itemid=$itemid",''));
			else
				mosRedirect(sefRelToAbs("index.php?option=$option&amp;page=show_user&amp;Itemid=$itemid",''));
		}
		else {
		
			$database->setQuery("SELECT * FROM #__adsmanager_ads WHERE id=$adid");
			$database->loadObject($ad);
			if ($database -> getErrorNum()) {
				echo $database -> stderr();
				return false;
			}
			//PathWay
			$paths[0]->text = ADSMANAGER_ROOT_TITLE;
			$paths[0]->link = sefRelToAbs('index.php?option='.$option.'&amp;Itemid='.$itemid);
			adsmanager_html::show_pathway($paths,$option);
			adsmanager_html::show_confirmation($my->username,$adid,$ad->ad_headline,$option,$itemid);	
    	}
    } // user logged in
}

function show_profile($userid,$option){
	global $database;
		
	$itemid  = intval( mosGetParam( $_GET, 'Itemid', 0 ));
			
	//PathWay
	$paths[0]->text = ADSMANAGER_ROOT_TITLE;
	$paths[0]->link = sefRelToAbs('index.php?option='.$option.'&amp;Itemid='.$itemid);
	adsmanager_html::show_pathway($paths,$option);
	
	// get configuration
	$database->setQuery( "SELECT * FROM #__adsmanager_config");
	$database->loadObject($conf);
	if ($database -> getErrorNum()) {
		echo $database -> stderr();
		return false;
	}	
	
	if ($userid == "0") {
		adsmanager_html::loginpage($_SERVER['REQUEST_URI'],$conf->comprofiler);	  	  
    }
    else
    { 	
		if ($conf->comprofiler > 0)
		{
			mosRedirect(sefRelToAbs("index.php?option=com_comprofiler&amp;task=userDetails&amp;Itemid=$itemid"),"");
		}
		else
		{
			$database->setQuery( "SELECT f.name,f.title FROM #__adsmanager_fields as f ".
								 "WHERE f.profile = 1 AND f.published = 1 ORDER BY f.ordering ASC");
			$fields = $database->loadObjectList();
		
			$database->setQuery("SELECT p.*,u.* FROM #__adsmanager_profile as p ".
								"LEFT JOIN #__users as u ON p.userid = u.id ".
								"WHERE userid = $userid");
							
			$database->loadObject($user);
								
			if (!isset($user)){
		
				$database->setQuery("INSERT INTO #__adsmanager_profile (userid) VALUES ('$userid')");
				$database->query();
				$database->setQuery("SELECT p.*,u.* FROM #__adsmanager_profile as p ".
								"LEFT JOIN #__users as u ON p.userid = u.id ".
								"WHERE userid = $userid");
				$database->loadObject($user);
			}
			adsmanager_html::showProfile($user,$fields,$option,$itemid);
		}
	}
}

function save_profile($option){

	global $database;
	$user_id  = intval(mosGetParam( $_POST, 'id', 0));
	$itemid   = intval( mosGetParam( $_GET, 'Itemid', 0 ));

	$row = new mosUser( $database );
	$row->load( $user_id );
	$row->orig_password = $row->password;

	$password   = mosGetParam( $_POST, 'password', "");
	$verifyPass = mosGetParam( $_POST, 'verifyPass', "");
	if($password != "") {
		if($verifyPass == $password) {
			$row->password = md5($password);
		} else {
			echo "<script> alert(\""._PASS_MATCH."\"); window.history.go(-1); </script>\n";
			exit();
		}
	} else {
		// Restore 'original password'
		$row->password = $row->orig_password;
	}

	$row->name = mosGetParam( $_POST, 'name', "");
	$row->username = mosGetParam( $_POST, 'username', "");
	$row->email = mosGetParam( $_POST, 'email', "");

	unset($row->orig_password); // prevent DB error!!

	if (!$row->store()) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}


	$database->setQuery( "SELECT f.name FROM #__adsmanager_fields as f ".
						 "WHERE f.profile = 1 AND f.published = 1");
	$fields = $database->loadObjectList();
	
	$sql = "UPDATE #__adsmanager_profile SET ";
	
	for($i=0,$nb=count($fields);$i<$nb;$i++)
	{
		$sql .= $fields[$i]->name." = '".mosGetParam( $_POST, $fields[$i]->name, "")."'";
		if ($i != $nb -1)
			$sql .=",";
	}
	$sql .= " WHERE userid = $user_id";
	//echo $sql;
	$database->setQuery( $sql);
	$database->query();
	
	mosRedirect(sefRelToAbs("index.php?option=$option&amp;Itemid=$itemid",ADSMANAGER_UPDATE_PROFILE_SUCCESSFULL));
}

function getCatTree(&$tree) {
	global $database;
	
	/*$database->setQuery( "SELECT c.id, c.name, c.parent, ".
						" (select count(*) ".
						"  from #__adsmanager_ads a ".
						"  where a.category = c.id ".
						"    and a.published = 1 ".
						" ) as num_ads ".
						"FROM #__adsmanager_categories as c ".
						"WHERE c.published = 1 ORDER BY c.parent,c.ordering");*/
	$database->setQuery( "SELECT c.*, count(*) as num_ads,a.id as not_empty ".
					 "FROM #__adsmanager_categories as c ".
					 "LEFT JOIN #__adsmanager_ads as a ON a.category = c.id ".
					 "WHERE c.published = 1 ".
					 "GROUP BY c.id ".
					 "ORDER BY c.parent,c.ordering");
					 
	$list = $database->loadObjectList();
						 
	// establish the hierarchy of the menu
	$tree = array();
	// first pass - collect children
	if(isset($list))
	{
		foreach ($list as $v ) {
			$pt 	= $v->parent;
			$list_temp 	= @$tree[$pt] ? $tree[$pt] : array();
			array_push( $list_temp, $v );
			$tree[$pt] = $list_temp;
		}
	}
}


function front($option) {
	global $database,$mosConfig_absolute_path,$mosConfig_live_site,$mainframe;
	
	$itemid          = intval( mosGetParam( $_GET, 'Itemid', 0 ));
	
	getCatTree($tree);
	
	$database->setQuery("SELECT * FROM #__adsmanager_config"  );
	$database->loadObject($conf);
	if ($database -> getErrorNum()) {
		echo $database -> stderr();
		return false;
	}
	
	$database->setQuery("SELECT a.id, a.ad_headline, a.category, a.date_created,p.id as parentid,p.name as parent,c.id as catid, c.name as cat ".
					"FROM #__adsmanager_ads as a ".
					"LEFT JOIN #__adsmanager_categories as c ON a.category = c.id ".
					"LEFT JOIN #__adsmanager_categories as p ON c.parent = p.id ".
					"WHERE c.published = 1 and a.published = 1 ORDER BY a.date_created DESC ,a.id DESC LIMIT 0, 3");
	$ads = $database->loadObjectList();
	
	// Dynamic Page Title
	$mainframe->SetPageTitle( ADSMANAGER_PAGE_TITLE );

	adsmanager_html::showFront($conf,$tree,$ads,$option,$itemid);
}

function show_rules($option) {
	global $database;
	
	$itemid   = intval( mosGetParam( $_GET, 'Itemid', 0 ));
	
	//PathWay
	$paths[0]->text = ADSMANAGER_ROOT_TITLE;
	$paths[0]->link = sefRelToAbs('index.php?option='.$option.'&amp;Itemid='.$itemid);
	adsmanager_html::show_pathway($paths,$option);
	
	// get configuration
	$database->setQuery( "SELECT id,rules_text FROM #__adsmanager_config");
	$database->loadObject($conf);
	if ($database -> getErrorNum()) {
		echo $database -> stderr();
		return false;
	}
	
	adsmanager_html::show_rules($conf->rules_text);
}

function show_expiration($adid,$option) {
	global $database;
	
	$database->setQuery( "UPDATE #__adsmanager_ads SET date_created = CURDATE(),recall_mail_sent=0 WHERE id=$adid and recall_mail_sent = 1");
	mosCache::cleanCache( $option );
	$database->query();
	if ($database -> getErrorNum()) {
		echo $database -> stderr();
		return false;
	}
	mosRedirect(sefRelToAbs("index.php?option=$option"),ADSMANAGER_AD_RESUBMIT);
}

function sendEmail($ad,$conf,$option) {
	global $mosConfig_mailfrom, $mosConfig_fromname,$mosConfig_sitename;
	
	if ($ad->email) {
		$link = sefRelToAbs("index.php?option=$option&amp;page=expiration&amp;adid=".$ad->id);
		$body = $conf->recall_text;
		$body .= sprintf(ADSMANAGER_EXPIRATION_MAIL_BODY,$ad->ad_headline,$conf->recall_time,$link,$link);
		
		mosMail($mosConfig_mailfrom,$mosConfig_fromname,$ad->email,$mosConfig_sitename." / ".ADSMANAGER_EXPIRATION_MAIL,$body,1);
	}
}

function manage_expiration($option){
	global $database,$mosConfig_absolute_path;
	
	// get configuration
	$database->setQuery( "SELECT * FROM #__adsmanager_config");
	$database->loadObject($conf);
	if ($database -> getErrorNum()) {
		echo $database -> stderr();
		return false;
	}
	
	if ($conf->expiration == 1)
	{
		if ($conf->recall == 1)
		{
			$delta = $conf->ad_duration - 1 + $conf->recall_time;  
			$recall_time = date("Ymd",mktime()-($delta*24*3600)); 
			$database->setQuery( "SELECT id,email,ad_headline FROM #__adsmanager_ads WHERE date_created < $recall_time AND recall_mail_sent = 0");
			$ads = $database->loadObjectList();
			if ($database -> getErrorNum()) {
				echo $database -> stderr();
				return false;
			}
			if(isset($ads))
			{
				foreach($ads as $ad)
				{
					sendEmail($ad,$conf,$option);
					
				}
			}
			$database->setQuery( "UPDATE #__adsmanager_ads SET recall_mail_sent = 1,date_recall = CURDATE() WHERE date_created < $recall_time");
			$database->query();
			if ($database -> getErrorNum()) {
				echo $database -> stderr();
				return false;
			}
			
			$delta = $conf->recall_time - 1;  
			$expiration_date = date("Ymd",mktime()-($delta*24*3600)); 
			
			$database->setQuery( "DELETE FROM #__adsmanager_ads WHERE recall_mail_sent = 1 AND date_recall < $expiration_date");
			$database->query();
			if ($database -> getErrorNum()) {
				echo $database -> stderr();
				return false;
			}
		}	
		else
		{
			$delta = $conf->ad_duration - 1;  
			$expiration_date = date("Ymd",mktime()-($delta*24*3600)); 
			
			$database->setQuery( "DELETE FROM #__adsmanager_ads WHERE date_created < $expiration_date");
			$database->query();
			if ($database -> getErrorNum()) {
				echo $database -> stderr();
				return false;
			}
		}
	}
	
	$last_cron_date = date("Ymd");
	$Fnm = $mosConfig_absolute_path .'/components/'.$option.'/cron.php';
    $inF = fopen($Fnm,"w"); 
	fwrite($inF,'<?php $last_cron_date='.$last_cron_date.';?>');
	fclose($inF); 
}

function checkAccount( $username,$password,$email,&$userid,$conf ) {
    global $database,$mainframe,$mosConfig_uniquemail;

	// simple spoof check security (login module does it only with Joomla functions, no cb.class inclusion)
	/*if ( is_callable("josSpoofCheck")) {
		josSpoofCheck(1);
	}*/
	
	$passwd = md5( $password );
    
    $database->setQuery( "SELECT * "
						. "\nFROM #__users u "
						. "\nWHERE u.username='".$username."'"
						);
	$database->loadObject( $user );
	if (isset($user)) {
		//User exist, Verify Password
		if ($user->password == $passwd)
		{
			//Login Ok
			$mainframe->login($username,$passwd);
			$userid = $user->id;
			return null;
		}
		else
		{
			//Login Failed
			return "bad_password";
		}
	}
	else
	{
		if ($mosConfig_uniquemail == 1)
		{
			$database->setQuery( "SELECT * "
								. "\nFROM #__users u "
								. "\nWHERE u.email='".$email."'"
								);
			$database->loadObject( $user );
			if (isset($user)) {
				//Login Failed
				return "email_already_used";
			}
		}
		
		//Create Account
		echo "Create Account";
		$userid = saveRegistration($conf->comprofiler);
		$mainframe->login($username,$passwd);
		return null;
	}
}

function saveRegistration($comprofiler) {
	global $database, $acl;

	// simple spoof check security
	//josSpoofCheck();	
	
	$row = new mosUser( $database );

	if (!$row->bind( $_POST, 'usertype' )) {
		mosErrorAlert( $row->getError() );
	}

	mosMakeHtmlSafe($row);

	$row->id 		= 0;
	$row->usertype 	= '';
	$row->gid 		= $acl->get_group_id( 'Registered', 'ARO' );

	if (!$row->check()) {
		echo "<script> alert('".html_entity_decode($row->getError())."'); window.history.go(-1); </script>\n";
		exit();
	}

	$row->password 		= md5( $row->password );
	$row->registerDate 	= date( 'Y-m-d H:i:s' );

	if (!$row->store()) {
		echo "<script> alert('".html_entity_decode($row->getError())."'); window.history.go(-1); </script>\n";
		exit();
	}
	$row->checkin();
	
	$database->setQuery( "SELECT u.id "
				. "\nFROM #__users u "
				. "\nWHERE u.username='".$row->username."'"
				);
	$userid  = $database->loadResult();
	
	if ($comprofiler > 0)
	{
		$query = "INSERT INTO #__comprofiler (id,user_id,firstname) VALUES ('$userid' ,'$userid' ,'$row->username')";
		$database->setQuery($query);
		$database->query();
	}
	
	return $userid;
}  
?>