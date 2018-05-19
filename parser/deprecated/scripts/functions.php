<?php

	function parseMainPage($url){
		$seznam = array();
		$res = file_get_contents( $url );
			
		
		$fileContainer = "log/last_load_page.log";
		$filePointer = fopen($fileContainer, "w");
	    fputs($filePointer, $res);
	    fclose($filePointer);		
		
	    
		$content = ereg_replace('Mobilní verze(.*)','', $res);
		preg_match('|<li class="active"><a href="(.*)">Firmy</a></li>|', $content, $match);
		// match je tu prazdne pole
		$query = strip_tags($match[1]);
		preg_match('|&amp;gId=0">Další</a>|', $content, $match);
		if (sizeof($match)>0){
			$next = true;
		} else {
			$next = false;
		}
		
		$pieces = explode('<table class="vysledek"', $content);
		
		foreach ($pieces as $k => $piece){
			if ($k == 0){
				continue;
			}
			$vystup = array();
			preg_match('|id="vysledek-(.*)"> <tr>|', $piece, $match);
			$vystup['id'] = $match[1];
			
			preg_match('|<a href="(.*)" class="logolink"|', $piece, $match);
			$vystup['url'] = FIRMY_SERVER . $match[1];
			
			preg_match('|<p class="desc">(.*)</p>|', $piece, $match);
			$vystup['desc'] = strip_tags($match[1]);
			
			preg_match('|<p class="links"> <a href="(.*)" class="url"|', $piece, $match);
			
			if (!isset($match[1])){
//				echo $vystup['url'].'<br>';
			} else {
				$vystup['web'] = $match[1];	
			}

		
			$seznam[] = $vystup;
		}
		$ret['list'] = $seznam;
		$ret['query'] = $query;
		$ret['next'] = $next;
		return $ret;
		
	}

    /**
        $ret['list'] = array(
                0 => array( url => 'http://www.firmy.cz/detail/737573-aukro-cz-zlin.html',
                            Detail => '<!DOCTYPE html><...... />',
                );
        $ret['query'] = $query;
        $ret['next']
     */
    function parseMainPage2011($url, $id_kategorie)
    {
        $seznam = array();
        $query = '';

        // wait for 0-1 seconds
        $timerand = rand(0,1000000);
        usleep($timerand);

        $res = file_get_contents( $url );
            
//         $ret = getRealUrl($url);
//         if(!$ret) {
//             return false;
//         }
//         $query = 'http://firmy.cz'.$ret['query'];// /Auto-moto
        if (!$res) {
            //404 not found
            logCron2011(__FUNCTION__.":[$id_kategorie]: get page failed: ".$url."");
            return false;
        }

        $fileContainer = "log/last_load_page.log";
        $filePointer = fopen($fileContainer, "w");
        fputs($filePointer, $res);
        fclose($filePointer);       
        
//         if (!$res) {
//             return false;//404
//         }

        $content = preg_replace('/<\!DOCTYPE html>/','', $res);     
   
        $dom = new DOMDocument('1.0', 'UTF-8');
        @$dom->loadHTML($content);
        
        $finder = new DomXPath($dom);

        //seznam id
        $nodelistid = $finder->query("//*[contains (@id, 'results')]//*[contains (@class, 'resultcont')]/table/@id");
        if (!$nodelistid) {
            //chyba v xpath
            logCron2011(__FUNCTION__.":[$id_kategorie]: chyba v xpath: ".$url."");
            return false;
        }

        $selectedpagenodelist = $finder->query("//div[@id='paging']/span[contains (@class, 'next')]");
        if (!$selectedpagenodelist) {
            //fatal error - spatny xquery
            logCron2011(__FUNCTION__.":[$id_kategorie]: spatne xpath: ".$url."");
        }

        if ($selectedpagenodelist->length == 1) {
            $next = true;
        } else {
            $next = false;
        }

        $regionsnodelist = $finder->query("//table[@id='regions']//*[contains (@class, 'limiter')]//ul/li/a/@href");
        if (!$regionsnodelist->length) {
            if ($nodelistid -> length) {
            //prusvih - neexistuji Idcka ale ani jeden region, nezjistim url :(
                logCron2011(__FUNCTION__.":[$id_kategorie]: neexistuje ani jeden region: ".$url."");
                return false;
            }
        } else {
//             /Remesla-a-sluzby/Revizni-sluzby/Revize-jerabu--vytahu-a-eskalatoru/reg/kraj-jihocesky
            $urlkraje = $regionsnodelist -> item (0) -> nodeValue;
//             $urlkraje = '/Remesla-a-sluzby/Revizni-sluzby/Revize-jerabu--vytahu-a-eskalatoru/reg/kraj-jihocesky';
            preg_match('/^(.*)\/reg\/(.*)$/', $urlkraje, $match);
            if (!isset($match[1])) {
                //prusvih - kraj ma nejaky neznamy tvar :-/
                logCron2011(__FUNCTION__.":[$id_kategorie]: neznamy tvar kraje: ".$url."");
                return false;
            } else {
                $query = 'http://www.firmy.cz'.$match[1];
            }
        }
        
//             $polozka = array(
//                         'id' => 12,
//                         'url' => 'http://www.firmy.cz/detail/2025967-otomoto-cz-zlin.html',
//                         'desc' => 'Motoristická inzerce online. Nabídka a poptávka autobazarů, autosalónů i soukromníků. Inzerce aut, motorek, užitkových a nákladních vozidel, čtyřkolek, minibike i veteránů. Inzerce nových a použitých dílů i příslušenství.',
//                         'web' => 'http://www.otomoto.cz/',
//                         );

        for($i=0; $i<$nodelistid->length; $i++) {
//                 echo $nodelistid -> item($i) -> nodeValue."<br/>";
            $polozka = array();

            $id = (int)preg_replace('/^vysledek\-/', '', $nodelistid -> item($i) -> nodeValue);

            $polozka = parsePolozka2011($id, $finder);

            $seznam[] = $polozka;
        }

        $ret['list'] = $seznam;
        $ret['query'] = $query;
        $ret['next'] = $next;
        return $ret;
    }
    /**
     * Pomocna funkce na naparsovani jedne firmy ze stranky
     * @param int $odvetvi
     * @param DomXPath $finder
     * @return array(
            'id',
            'url',
            'web',
            'desc',
        )
     */
    function parsePolozka2011($id, $finder)
    {
        $polozka = array();

        $polozka['id'] = (int)$id;

        //seznam url adres
        $nodelisturl = $finder->query("//table[@id='vysledek-$id']//*[@class='text']/h3/a/@href");
        if ($nodelisturl && $nodelisturl -> length) {
            $polozka['url'] = 'http://firmy.cz'.$nodelisturl -> item(0) -> nodeValue;
        } else {
            $polozka['url'] = '';
        }

        $nodelistdesc = $finder->query("//table[@id='vysledek-$id']//*[@class='text']//p[@class='desc']");
        if ($nodelistdesc && $nodelistdesc -> length) {
            $polozka['desc'] = $nodelistdesc -> item(0) -> nodeValue;
        } else {
            $polozka['desc'] = '';
        }

        $nodelistweb = $finder->query("//table[@id='vysledek-$id']//*[@class='text']/p[@class='info']/*[@class='url']");
        if ($nodelistweb && $nodelistweb -> length) {
            $polozka['web'] = $nodelistweb -> item(0) -> nodeValue;
        } else {
            $polozka['web'] = '';
        }

        return $polozka;
    }
	
	
	function parseDetailPage($url){
		
		$detail = array();
		$res = file_get_contents( $url );
		
		$content = ereg_replace('(.*)<div id="mainCenter">','', $res);
		$content = ereg_replace('gemiusAudience(.*)','', $content);
//		echo $content;
		preg_match('|<span class="latitude">(.*)</span>, <span class="longitude">|', $content, $match);
		$detail['GPSlat'] = $match[1];	
			
		preg_match('|<span class="longitude">(.*)</span> </div> <div id="|', $content, $match);
		$detail['GPSlong'] = $match[1];	
		
		preg_match('|<div id="firmCont"> <h2>(.*) </h2>|', $content, $match);
		$detail['Name'] = $match[1];	
			
		preg_match('|<span class="street-address">(.*)</span>, <span class="postal-code">|', $content, $match);
		$detail['Adress'] = $match[1];	
		
		preg_match('|<span class="postal-code">(.*)</span>&nbsp; <span class="locality">|', $content, $match);
		$detail['PSC'] = str_replace(array('&nbsp;',' '),'',$match[1]);	
			
		preg_match('|<span class="locality">(.*)</span> <a class="url fn org nodisplay"|', $content, $match);
		$detail['Lokalita'] = $match[1];	
			
		preg_match('|<span class="type nodisplay"> WORK</span>:</span> <span class="value">\+[0-9].{36}|', $content, $match);
		if (isset($match[0])){
			$detail['Tel1'] = str_replace(array('&nbsp;',' ','WORK:'),'',strip_tags($match[0]));	
		}		
		
		preg_match('|<span class="type nodisplay"> CELL</span>:</span> <span class="value">\+[0-9].{36}|', $content, $match);
		if (isset($match[0])){
			$detail['Tel2'] = str_replace(array('&nbsp;',' ','CELL:'),'',strip_tags($match[0]));	
		}	
			
		$regexpEmail = "[^0-9][A-z0-9_]+([.][A-z0-9_]+)*[@][A-z0-9_]+([.][A-z0-9_]+)*[.][A-z]{2,4}";
		preg_match('|EMAIL</span><a href="mailto:'.$regexpEmail.'|', $content, $match);
		$detail['Email'] = str_replace('EMAIL</span><a href="mailto:', '', $match[0]);	 
			
		preg_match('|Zařazení v kategoriích:</h3> <ul>(.*)</a></li>|', $content, $match);
		$pies = explode('<li>', $match[1]);
		$kategorieZarazeni = array();
		foreach ($pies as $index => $pie){
			if ($index == 0){
				continue;
			}			
			$zar = array();
			preg_match('|<a href="(.*)">|', $pie, $urlPie);
			$zar['url'] = $urlPie[1];
			$zar['title'] = strip_tags($pie);
			$kategorieZarazeni[] = $zar['title'].'['.$zar['url'].'];';
		}
		$detail['Zarazeni'] = implode("\n",$kategorieZarazeni);	
		return $detail;
//		die;
	}
    
    /**
     * function return real url after redirect
     *
     */
    function getRealUrl($url) 
    {
        $context = array
        (
            'http' => array
                (
                    'method' => 'GET',
                    'max_redirects' => 2,
                    'header'=>"Accept-language: en\r\n" .
                    "User-Agent:Mozilla/5.0 (X11; Linux x86_64; rv:7.0.1) Gecko/20100101 Firefox/7.0.1\r\n"
                ),
        );
        ini_set('user_agent', "Mozilla/5.0 (X11; Linux x86_64; rv:7.0.1) Gecko/20100101 Firefox/7.0.1");
        $ret = file_get_contents($url, null, stream_context_create($context));
        foreach ($http_response_header as $item) {
            //print_r($http_response_header);exit;
            if (strpos($item, 'Location: ') !== false) {
                $retArr['query'] = str_replace('Location: ', '', $item);
                $retArr['Detail'] = $ret;
                return $retArr;
            }
        }
        return false;
    }
    /**
     * Klasicky implode ale pres klice
     */
    function implode_key($pieces = array(), $glue = "" ) {
        $arrK = array_keys($pieces);
        return implode($glue, $arrK);
    } 

    function parseDetailPage2011($url, $id_kategorie){
        $detail = array();
//         echo getRealUrl('http://www.firmy.cz/');
//         $url = 'http://firmy.cz/cat/neco-1';
//         $res = file_get_contents( 'http://www.firmy.cz/cat/Auto-moto-1' );
//         echo $res;exit;
//         echo file_get_contents('http://www.firmy.cz/');
//          echo file_get_contents('http://firmy.cz/detail/460833-stating-s-r-o-stavby-pro-lidi-kostelec-nad-orlici-kostelecka-lhota.html');
//          exit;
        // wait for 0-1.5 seconds
        $timerand = rand(0,1500000);
        usleep($timerand);
        $res = file_get_contents( $url );
//         var_dump('ret'.$res);exit;
        if (!$res) {
            logCron2011(__FUNCTION__.":[$id_kategorie]: get page failed: ".$url."");
            return false;//404
        }

        $content = preg_replace('/<\!DOCTYPE html>/','', $res);     
   
        $dom = new DOMDocument('1.0', 'UTF-8');
        @$dom->loadHTML($content);
        
        $finder = new DomXPath($dom);

        //$detail['DetailUrl'] = getRealUrl($url); //vytvori o 1 pozadavek navic :-/
        $detail['DetailUrl'] = $url;

        $list = $finder->query("//*[contains (@id, 'firmCont')]//h2");
        $detail['Name'] = ($list->length)? $list->item(0)->textContent : '';


        $list = $finder->query("//*[contains (@id, 'firmCont')]/*[contains (@class, 'web')]/a[contains (@class, 'externalLink')]");
        $detail['Web'] = ($list->length)? $list->item(0)->textContent : '';

        $list = $finder->query("//*[contains (@class, 'adr')]/*[contains (@class, 'street-address')]");
        $detail['Adress'] = ($list->length)? $list->item(0)->textContent : '';

        $list = $finder->query("//*[contains (@class, 'adr')]/*[contains (@class, 'postal-code')]");
        $detail['PSC'] = ($list->length)? $list->item(0)->textContent : '';

        $list = $finder->query("//*[contains (@class, 'adr')]/*[contains (@class, 'locality')]");
        $detail['Lokalita'] = ($list->length)? $list->item(0)->textContent : '';

        $list = $finder->query("//*[contains (@class, 'contactBlock')]//*[contains (@class, 'tel')]//*[contains (@class, 'value')]");
        $detail['Tel1'] = ($list->length)? $list->item(0)->textContent : '';

        $list = $finder->query("//*[contains (@class, 'contactBlock')]//*[contains (@class, 'tel')]//*[contains (@class, 'value')]");
        $detail['Tel2'] = ($list->length > 1)? $list->item(1)->textContent : '';


        $list = $finder->query("//*[contains (@class, 'contactBlock')]//*[contains (@class, 'email')]//*[contains (@class, 'value')]");
        $detail['Email'] = ($list->length)? str_replace('&nbsp;', '', $list->item(0)->textContent) : '';

        $detail['GPSlat'] = '';//bohuzel nezjistim :-/
        $detail['GPSlong'] = '';//bohuzel nezjistim :-/

        $list = $finder->query("//*[contains (@id, 'category')]//*//li//a");
        if ($list->length) {
            $kat = array();
            foreach($list as $element) {
                $kat[] = $element->nodeValue.'['.$element->getAttribute('href').'];';
            }
            $detail['Zarazeni'] = implode("\n",$kat); 
        } else {
            $detail['Zarazeni'] = '';
        }

        return $detail;
    }

function custom_warning_handler($errno, $errstr) {
//file_get_contents(http://www.firmy.cz/detail/737573-aukro-cz-zlin.html) [function.file-get-contents]: failed to open stream: HTTP request failed! HTTP/1.1 403 Forbidden
    if (strpos($errstr, '403 Forbidden') !== false) {
        $q = "
            UPDATE zpracovani_2011
            SET `Lock` = '1', Timelock = NOW()
        ";
        $ret = mysql_query($q);
        if (!$ret) {
            logCron2011(__FUNCTION__.":[]: failed to lock table: ".$url."\n".$q."\n".mysql_error());
        }
        logCron2011("WARNING: ".$errstr."");
    }
}

function lock2011()
{
    $q = "
        UPDATE zpracovani_2011
        SET `Lock` = '1', Timelock = NOW()
    ";
    $ret = mysql_query($q);
    if (!$ret) {
        logCron2011(__FUNCTION__.":[]: failed to lock table: ".$url."\n".$q."\n".mysql_error());
    }
//     logCron2011("WARNING: ".$errstr."");
}

function unlock2011()
{
    $q = "
        UPDATE zpracovani_2011
        SET `Lock` = '0'
    ";
    $ret = mysql_query($q);
    if (!$ret) {
        logCron2011(__FUNCTION__.":[]: failed to lock table: ".$url."\n".$q."\n".mysql_error());
    }
//     logCron2011("WARNING: ".$errstr."");
}

function companyExists($id)
{
    $q = "SELECT * FROM kontakty_2011 WHERE Id = '$id'";
    $ret = mysql_query($q);
    if (!$ret) {
        //error
        return false;
    }

    if (mysql_num_rows($ret) == 1) {
        return true;
    } else {
        return false;
    }
    
}

function logCron2011($msg)
{
    $LogFile = dirname(dirname(__FILE__))."/log/cron2011.log";
    $teraz_str = date("d.m.Y H:i:s");
        
    $f = fopen($LogFile,"a");
    if ($f != false){
            fwrite($f,"
====================================================================================================
$teraz_str: $site => $msg");
            fclose($f);
            return true;
        } else {
              return false;
          }

}

