<?
function MeritCas()
{
  $cas=Explode(" ", microtime());
	$soucet=$cas[1]+$cas[0];
	return $soucet;
}


function VyslednyCas($start, $end)
{
	$presnost=10000;
	return ((Round(($end - $start) * $presnost)) / $presnost); //Abs
}

$start = MeritCas();

/*
print
"<a href=\"?sekce=grafika/projekty\">odkaz</a><br><br><br>";
print_r($_GET);

Název: CD Cargo 363 009-2 
Autor: Timi 
Popis: Lokomotiva rady 363. Patri spolecnosti CD Cargo. 
Autor textur: xxxxxxx 
KUID: <kuid:229219:36331> 
Vyžadované souèásti: Model od Hummuse 363 <kuid:61599:363> 
Velikost CDP: 2,67 MB   
Poèet stažení:
*/
ini_set('memory_limit', '200M');
$pol="./";
$i=0;
$cesta[]="";
$handle=opendir($pol);
while($soub=readdir($handle))
{
	$i++;
	$cesta[$i]=$soub;
}
closedir($handle);
sort($cesta);//seøazení
reset($cesta);

print 
"<table border=1>
<tr>
<td>Název</td>
<td>Kuid</td>
<td>cat class</td>
<td>cat reg</td>
<td>cat era</td>
<td>kind</td>
<td>web</td>
<td>email</td>
<td>author</td>
<td>description</td>
<td>licence</td>
<td>organizace</td>
</tr>
";

for($i=1;$i<count($cesta);$i++)
{
	$naz=explode(".", $cesta[$i]);
  if ($naz[1]=="cdp")
  {
		$soubor=$cesta[$i];
		$u=fopen($soubor, "rb");
		
		$u=fopen($soubor, "rb");
		$udaj=fread($u, filesize($soubor));
		fclose($u);
		//kuid
		$kuid0=explode("kuid", $udaj);
		$kuid=explode(">", $kuid0[1]);
		$kuid=substr($kuid[0], 1);
			if ($kuid[0]==":")
			{
				$kuid=substr($kuid, 1);
			}
			
			if ($kuid[strlen($kuid)-2]==":")
			{
				$kuid=substr($kuid, 0, strlen($kuid)-2);
			}
		
		//kategory class
		$cat_class0=explode("category-class", $kuid0[2]);
		$cat_class1=explode("category-region-0", $cat_class0[1]);
		$cat_class2=explode("", $cat_class1[0]);
		$cat_class3=explode("", $cat_class2[1]);
		$cat_class4=substr($cat_class3[0], 0, 3);
		$cat_class=rtrim($cat_class4); 
		
		//regon
		if (strstr($kuid0[2], "category-region-0")=="category-region-0")
		{
			$cat_reg0=explode("category-region-0", $kuid0[2]);
			$cat_reg1=explode("category-era-0", $cat_reg0[1]);
			$cat_reg2=explode("", $cat_reg1[0]);
			$cat_reg3=substr($cat_reg2[1], 0, 2);
			$cat_reg=rtrim($cat_reg3); 
		}
			else
		{
			$cat_reg = "nevyplnìno";
		}
		
		//era
		if (strstr($kuid0[2], "category-region-0")=="category-region-0")
		{
			$cat_era0=explode("category-era-0", $kuid0[2]);
			$cat_era1=explode("asset-filename", $cat_era0[1]);
			$cat_era2=explode("", $cat_era1[0]);
			$cat_era3=substr($cat_era2[1], 0, 5);
			$cat_era=rtrim($cat_era3); 
		}
			else
		{
			$cat_era = "nevyplnìno";
		}
		
		//kind
		if (strstr($kuid0[2], "kind")=="kind")
		{
			$kind0=explode("kind", $kuid0[2]);
			$kind1=explode("compression", $kind0[1]);
			$kind2=explode("", $kind1[0]);
			$kind3=explode("thumbnails", $kind2[1]);//vychytat!
			$kind4=explode("name", $kind3[0]);
			$kind5=explode("region", $kind4[0]);
			$kind6=explode("category-class", $kind5[0]);
			$kind7=explode("smoke0", $kind6[0]);
			$kind=rtrim($kind7[0]); 
		}
			else
		{
			$kind = "nevyplnìno";
		}
		
		//web
		if (strstr($kuid0[3], "contact-website")=="contact-website")
		{
			$web0=explode("contact-website", $kuid0[3]); //vychytat prázdné!
			$web1=explode("license", $web0[1]);
			$web2=explode("", $web1[0]);
			$web3=explode(".", $web2[1]);
			$web4=substr($web3[count($web3)-1], 0, 3);
			$webkon=rtrim($web4);
			$web=$web3[0];
			if ($web[0]!=" ")
			{
				for ($j=1; $j<count($web3)-1; $j++)
				{
				  $web.=".{$web3[$j]}";
				}
				$web="$web.$webkon";
			}
				else
			{
				$web = "nevyplnìno";
			}
		}
			else
		{
			$web = "nevyplnìno";
		}
		
		//email
		if (strstr($kuid0[3], "contact-email")=="contact-email")
		{
			$email0=explode("contact-email", $kuid0[3]);
			$email1=explode("contact-website", $email0[1]);
			$email2=explode("", $email1[0]);
			$email3=explode(".", $email2[1]);
			$email4=substr($email3[count($email3)-1], 0, 3);
			$emailkon=rtrim($email4);
			$email=$email3[0];
			if ($email3[0]!=" ")
			{
				for ($j=1; $j<count($email3)-1; $j++)
				{
				  $email.=".{$email3[$j]}";
				}
				$email="$email.$emailkon";
			}
				else
			{
				$email = "nevyplnìno";
			} 
		}
			else
		{
			$email = "nevyplnìno";
		}
		
		//author
		if (strstr($kuid0[3], "author")=="author")
		{
			$author0=explode("author", $kuid0[3]);
			$author1=explode("organisation", $author0[1]);
			$author2=explode("", $author1[0]);
			$author3=explode("organisation", $author2[1]);
			$author=rtrim($author3[0]);
		}
			else
		{
			$author = "nevyplnìno";
		}
		
		//description
		if (strstr($kuid0[3], "description")=="description")
		{
			$desc0=explode("description", $kuid0[3]);
			$desc1=explode("thumbnail", $desc0[1]);
			$desc2=explode("", $desc1[0]);
			$desc3=explode("thumbnail", $desc2[1]);
			$desc4=explode("?", $desc3[0]);
			$desc=rtrim($desc4[0]); 
		}
			else
		{
			$desc = "nevyplnìno";
		}
		
		//licence
		if (strstr($kuid0[3], "license")=="license")
		{
			$lic0=explode("license", $kuid0[3]);
			$lic1=explode("username", $lic0[1]);
			$lic2=explode("", $lic1[0]);
			$lic3=explode("username", $lic2[1]);
			$lic=rtrim($lic3[0]);
		}
			else
		{
			$lic = "nevyplnìno";
		}
		
		//organizace
		if (strstr($kuid0[3], "organisation")=="organisation")
		{
			$org0=explode("organisation", $kuid0[3]);
			$org1=explode("contact-email", $org0[1]);
			$org2=explode("", $org1[0]);
			$org3=explode("contact-email", $org2[1]);
			$org4=explode("\"", $org3[0]);
			$org5=explode("!", $org4[0]);
			$org=rtrim($org5[0]); 
		}
			else
		{
			$org = "nevyplnìno";
		}

		print 
		"<tr>
		<td>{$naz[0]}</td>
		<td><b>$kuid</b></td>
		<td><b>$cat_class</b></td>
		<td><b>$cat_reg</b></td>
		<td><b>$cat_era</b></td>
		<td><b>$kind</b></td>
		<td><b>$web</b></td>
		<td><b>$email</b></td>
		<td><b>$author</b></td>
		<td><b>$desc</b></td>
		<td><b>$lic</b></td>
		<td><b>$org</b></td>
		
		</tr>";
	}
}	//end for
print
"</table>";

/*
$soubor="Obloha_oblacno.cdp";
//
//"Kaplicka_B.cdp";
//"cd_cargo_363_009-2.cdp";
$u=fopen($soubor, "rb");
$udaj=fread($u, filesize($soubor));
fclose($u);

$kuid0=explode("kuid", $udaj);
$kuid=explode(">", $kuid0[1]);
$kuid=substr($kuid[0], 1);
	if ($kuid[0]==":")
	{
		$kuid=substr($kuid, 1);
	}
	
	if ($kuid[strlen($kuid)-2]==":")
	{
		$kuid=substr($kuid, 0, strlen($kuid)-2);
	}

	//kategory class
	$cat_class0=explode("category-class", $kuid0[2]);
	$cat_class1=explode("category-region-0", $cat_class0[1]);
	$cat_class2=explode("", $cat_class1[0]);
	$cat_class3=explode("", $cat_class2[1]);
	$cat_class4=substr($cat_class3[0], 0, 3);
	$cat_class=rtrim($cat_class4); 
	
	//regon
	if (strstr($kuid0[2], "category-region-0")=="category-region-0")
	{
		$cat_reg0=explode("category-region-0", $kuid0[2]);
		$cat_reg1=explode("category-era-0", $cat_reg0[1]);
		$cat_reg2=explode("", $cat_reg1[0]);
		$cat_reg3=substr($cat_reg2[1], 0, 2);
		$cat_reg=rtrim($cat_reg3); 
	}
		else
	{
		$cat_reg = "nevyplnìno";
	}
	
	//era
	if (strstr($kuid0[2], "category-region-0")=="category-region-0")
	{
		$cat_era0=explode("category-era-0", $kuid0[2]);
		$cat_era1=explode("asset-filename", $cat_era0[1]);
		$cat_era2=explode("", $cat_era1[0]);
		$cat_era3=substr($cat_era2[1], 0, 5);
		$cat_era=rtrim($cat_era3); 
	}
		else
	{
		$cat_era = "nevyplnìno";
	}
	
	//kind
	if (strstr($kuid0[2], "kind")=="kind")
	{
		$kind0=explode("kind", $kuid0[2]);
		$kind1=explode("compression", $kind0[1]);
		$kind2=explode("", $kind1[0]);
		$kind3=explode("", $kind2[1]);
		$kind=rtrim($kind3[0]); 
	}
		else
	{
		$kind = "nevyplnìno";
	}
	
	//web
	if (strstr($kuid0[3], "contact-website")=="contact-website")
	{
		$web0=explode("contact-website", $kuid0[3]);
		$web1=explode("license", $web0[1]);
		$web2=explode("", $web1[0]);
		$web3=explode(".", $web2[1]);
		$web4=substr($web3[count($web3)-1], 0, 3);
		//$web3=explode("È", $web2[1]);	
		$webkon=rtrim($web4);
		$web=$web3[0];
		if ($web[0]!=" ")
		{
			for ($j=1; $j<count($web3)-1; $j++)
			{
				$web.=".{$web3[$j]}";
			}
			$web="$web.$webkon";
		}
			else
		{
			$web = "nevyplnìno";
		}
	}
		else
	{
		$web = "nevyplnìno";
	}


//$cat_reg2=explode("", $cat_reg1[1]);
//$cat_reg3=substr($cat_reg2[0], 0, 2);


//print $cat_era0[1];
//print_r($kuid0[3]);
//print $cat_class4;//[0]; $cat_reg3
//print $cat_era3;

print 
"Kuid èíslo je: <b>$kuid</b><br>
Category class: <b>$cat_class</b><br>
Category region: <b>$cat_reg</b><br>
Category era: <b>$cat_era</b><br>
kind: <b>$kind</b><br>
web: <b>$web</b><br>

email: <b></b><br>
description: <b></b><br>
author: <b></b><br>
licence: <b></b><br>
organizace: 
<br>";
*/
//print $kuid0[2];


$end = MeritCas();
print 
"<br><br>
Stranka vygenerovana za: ".VyslednyCas($start, $end)." ms";

//((autor)), ((description)), ((kiud)), ((email)), ((web)), licence, ((region)), ((typ)) (scenery))), ((kind)), 
//((category...)), 


//$deltatime = (round(($deltatime*$rd)))/$rd; 
//print "<br>stránka byla natažena za $deltatime ms";
	//$kind3=substr($kind2[1], 0, 5);
/*
//explode(" ", $cat_class3[0]);
$time1 = microtime(); 
$time1 = explode(" ",$time1); 
$time1 = $time1[1] + $time1[0]; 
// toto musíte mít na úplném zaèiátku stránky 
$rd = "100000"; //zde nastavime zaokrouhlování 

---------
	$udaj=explode("kuid", fread($u, filesize($soubor)));
		fclose($u);
		
		//$pud1=explode("kuid",$udaj[1]);
		print_r($udaj);
		//print_r($udaj[2]);
		$kuid0=explode(">", $udaj[1]);
		$kuid=substr($kuid0[0], 1);
		if ($kuid[0]==":")
		{
			$kuid=substr($kuid, 1);
		}
		
		if ($kuid[strlen($kuid)-2]==":")
		{
			$kuid=substr($kuid, 0, strlen($kuid)-2);
		}
		//print $kuid[strlen($kuid)-2];
		//$region0=explode("region", $udaj[2]);
		//$type0=explode("type", $region0[1]);
		//$light0=explode("light", $type0[1]);
		//print $region0[1]; <b>{$light0[0]}</b>
		//print_r($light0);
---------

< ?php
function getMicroTime()
{
  List ($usec, $sec) = Explode (' ', microtime());
  return ((float)$sec + (float)$usec);
}

$start = getMicroTime()
?

HTML nebo PHP skript

< ?php
$end = getMicroTime();
printf ("Stránka byla naètena za %d sekund", ($end-$start));
?

< ? - stažení souboru
$soubor = "soubor.txt"; // Adresa souboru jež chcete dát na stažení

header("Content-Description: File Transfer"); 
header("Content-Type: application/force-download"); 
header("Content-Disposition: attachment; filename=\"$soubor\""); 

ReadFile ($soubor); 
? >

print
"<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\"
		\"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
	<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"cs\" lang=\"cs\">
	  <head>
	    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1250\" />
	    <meta http-equiv=\"Content-Language\" content=\"cs\" />
	    <meta name=\"author\" content=\"Fugess (Martin)\" />
	    <meta name=\"copyright\" content=\"Fugess Desig (c) 2008\" />
	    <meta name=\"keywords\" content=\"fugess design, fugess, webdesign, fugessdesign, fugess webdesign\" />
	    <meta name=\"description\" content=\"Weblog o mladém tvùrci webových prezentací\" />
	    <meta name=\"robots\" content=\"index, follow\" />
	      <title>Fugess Design - Fugessova tvorba webdesignu</title>
	  </head>
	  <body></body></html>
";

//$soubor="Kaplicka_B.cdp";
//"cd_cargo_363_009-2.cdp";
//$u=fopen($soubor,"r");
//$uj=fread($u, filesize($soubor));//
//$udaj=explode("<",fread($u, filesize($soubor)));

//$udaj=htmlspecialchars(readfile($soubor));

//$ud=readfile($soubor);

//fseek ($u, 100,100);
//$udaj=fgetc($u);
//fclose($u);

/*
$soubor="Kaplicka_B.cdp";
$u=fopen($soubor,"r");
fseek($u, 0, SEEK_SET);
	while (!feof($u))
	{
		print fgets($u, 10000);
		
	}
	
fclose($u);

$soubor="Kaplicka_B.cdp";
$u=fopen($soubor,"r");
$udaj=fread($u, filesize($soubor));
fclose($u);

print_r($udaj);
*/
/*
//$soubor="Kaplicka_B.cdp";
//@readfile($soubor);
//$ud=file($soubor);

$ud="";
$soubor="Kaplicka_B.cdp";
//"Garaz_A.cdp";
//"cd_cargo_363_009-2.cdp";	//	//"Kaplicka_B.cdp";

$u=fopen($soubor,"r");
$uda=strtr(fread($u, filesize($soubor)),"",":");
fclose($u);

print $uda;

//print_r(Explode(":", $uda));


$i=0;
while ($i < filesize($soubor))
{
  fseek($u, $i, SEEK_SET);
	$ud.=fgets($u, 30);
  $i+=20;
}
*/



//echo $ud;
//$udaj=file($soubor);
//print_r($udaj);
//$ud=fread($u, filesize($soubor));
//print_r($ud);

//print_r($udaj);
//print $udaj[1];
//print "Tady: ".$ud[0];

//$pud1=explode("kuid:",$udaj[1]);
//$pud2=explode(">", $pud1[1]);
//print $pud2[0];

/*


// toto na konci stranky 
$time2 = microtime(); 
$time2 = explode(" ",$time2); 
$time2 = $time2[1] + $time2[0]; 
$deltatime = $time2 - $time1; 
$deltatime = (round(($deltatime*$rd)))/$rd; 
print "<br>stránka byla natažena za $deltatime ms"; 
*/
//printf ("Stránka byla naètena za %d sekund", ($end - $start)*);
?>
