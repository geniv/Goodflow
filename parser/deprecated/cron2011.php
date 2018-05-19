<?php
	require_once('base_loader.php');
    error_reporting(E_ALL);
    set_error_handler("custom_warning_handler", E_WARNING);

	$AlesponNecoJsemUlozil = false;
	/**
	 * Nahodne spusteni
	 */
 	$deadlock = rand(0,1);
 	if ($deadlock == 1){
 		die('deadlock');
 	}
	
//if ($_GET['run'] != 1){
//	die;
//}

	/**
	 * Zdrzeni spusteni
	 */
 	$timerand = rand(0,5);
 	sleep($timerand);
	
	/**
	 * Dotaz na stav
	 */
	$q = "
		SELECT *
		FROM zpracovani_2011
		LIMIT 1
	";
	$res = mysql_query($q);
    if (!$res) {
        logCron2011("[]: selhal dotaz: \n$q\n".mysql_error());
    }
	$zpracovani = mysql_fetch_assoc($res);
	
	
	if ($zpracovani['Lock'] == 1){
		/**
		 * Detekce - zamek pro cron
		 */
		die('zamknuto');
	}
	
    lock2011();//jedeme, zamknu

    ini_set('user_agent', "Mozilla/5.0 (X11; Linux x86_64; rv:7.0.1) Gecko/20100101 Firefox/7.0.1");//samozrejme ze pristupujeme z prohlizece - co jste si kua mysleli ?

	/**
	 * Detekce prvni stranky - u prvni stranky neni v db query
	 */
    $id_kategorie = $zpracovani['Id'];
	if ( $zpracovani['Query'] == '' ) {
		$urlPageSource = 'http://www.firmy.cz/cat/neco-'.$zpracovani['Id'];
	} else {
		$urlPageSource = $zpracovani['Query'].'?page='.$zpracovani['Page'].'&gId=0';
	}
// 	$urlPageSource = 'http://firmy.cz/detail/191682-motortec-gate-brno-trnita.html';
//     var_dump(parseDetailPage2011($urlPageSource, 1));
	$pages = parseMainPage2011($urlPageSource, $id_kategorie);
    if (!$pages) { 
        die('chyba pri parsovani');
    }

    $processPage = array();
	foreach ($pages['list'] as $page){
        $id = $page['id'];
        //pokud zaznam v Id existuje, dal se nedotazuju a skocim na dalsi
        if ( companyExists($id) ) {
            continue;
        }
        $processItem = $page;
		$detail = parseDetailPage2011( $page['url'], $id_kategorie );
		$processItem['Detail'] = $detail;
        $processPage[] = $processItem;
	}
	
	/**
	 * zapisu vse do DB
	 */
	$logVypis = array();
	foreach ($processPage as $i => $list){
		/**
		 * odstraneni chyb Notice vypisu pri chybejicim cisle
		 */
		if (isset($list["Detail"]['Tel1'])){
			$tel1 = $list["Detail"]['Tel1'];
		} else {
			$tel1 = '';
		}
		if (isset($list["Detail"]['Tel2'])){
			$tel2 = $list["Detail"]['Tel2'];
		} else {
			$tel2 = '';
		}
		
		$q = "
			INSERT INTO `kontakty_2011` (
			`Id` ,
			`Company` ,
			`DetailUrl` ,
			`Description` ,
			`Web` ,
			`GPSlat` ,
			`GPSlong` ,
			`Address` ,
			`PSC` ,
			`Lokalita` ,
			`Tel1` ,
			`Tel2` ,
			`Email` ,
			`Zarazeni` ,
			`KategorieParser` ,
			`Page`
			)
			VALUES (
			'".$list['id']."', '".$list["Detail"]['Name']."', '".$list['url']."', '".$list['desc']."', '".$list['web']."', '".$list["Detail"]['GPSlat']."', 
			'".$list["Detail"]['GPSlong']."',
			 '".$list["Detail"]['Adress']."', '".$list["Detail"]['PSC']."', '".$list["Detail"]['Lokalita']."', '".$tel1."', '".$tel2."', 
			 '".$list["Detail"]['Email']."', '".$list["Detail"]['Zarazeni']."', '".$pages['query']."', '".$zpracovani['Page']."'
			);		
		";
		$ret = mysql_query($q); 
        if (!$ret) {
            logCron2011("[$id_kategorie]: selhal dotaz: \n$q\n".mysql_error());
            //neco se posralo
        }
		$lastId = mysql_insert_id();
//         echo $lastId."<br/>";
		if ($lastId != 0){
			$AlesponNecoJsemUlozil = true;
		}
		$logVypis[] = $list["Detail"]['Name'].' ['.$list['id'].'] - '.$lastId;
	}
	
	if ($AlesponNecoJsemUlozil == false){
		/**
		 * Pokud jsem nic nenacetl, bylo by vhodne navysit pocitadlo detekce neefektivni kategorie.
		 */
		$setEmpty = $zpracovani['EmptyLoadCounter'] + 1;
	} else {
		$setEmpty = 0;
	}
		
	
	/**
	 * Detekce uspesnosti nacteni - pokud nemam tlacitko NEXT na strance, musim prejit na dalsi kategorii
	 */
	if ($pages['next'] == true){
		if ($zpracovani['Query'] == ''){
			$setQuery = $pages['query'];  //Zpracovani je uspesne a ja projel prvni stranku
		} else {
			$setQuery = $zpracovani['Query'];  //Zpracovani je uspesne a ja projizdim page > 1 - u Page == 1 neni jeste zadane query v db
		}
		$setPage = $zpracovani['Page'] + 1; // -- navysim page
		$setId = $zpracovani['Id'];
	} else {
		$setQuery = '';
		$setPage = 1;
		$setId =  $zpracovani['Id'] + 1;
		$setEmpty = 0;
	}
	
	
	if ($zpracovani['EmptyLoadCounter'] == 2){
	/**
	 * Pokud jedu treti stranu kategorie a nic jsem behem toho nepridal, 
	 * nema smysl pokracovat dal a pokracuj v dalsi kategorii
	 */
        logCron2011("[$id_kategorie]: neefektivni kategorie");
		$setQuery = '';
		$setPage = 1;
		$setId =  $zpracovani['Id'] + 1;
		$setEmpty = 0;
	}	
	
	
	if ($setPage > 495){
	/**
	 * Reaguje na bug na seznamu, ktery neumoznuje nalistovat vice nez 500stranek
	 */
		$setQuery = '';
		$setPage = 1;
		$setId =  $zpracovani['Id'] + 1;
		$setEmpty = 0;
	}	
		
	//odemknu
	$q = "
		UPDATE zpracovani_2011
		SET Id = '".$setId."', Query = '".$setQuery."', Page = '".$setPage."', `Lock` = '0', EmptyLoadCounter = '".$setEmpty."'
	";
	
	echo '<br>zpracovanych stranek: '.sizeof($processPage);
	echo '<br>Zpracovano: '.implode('<br>', $logVypis);
 	$ret = mysql_query($q);
    if (!$ret) {
        logCron2011("[$id_kategorie]: selhal dotaz: \n$q\n".mysql_error());
    }
// 	echo mysql_error();
	
