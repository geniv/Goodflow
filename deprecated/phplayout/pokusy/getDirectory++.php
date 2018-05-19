<?php
function formatBytes($bytes, $precision = 2) {
	$units = array('B', 'KB', 'MB', 'GB', 'TB');

	$bytes = max($bytes, 0);
	$pow = floor(($bytes ? log($bytes) : 0) / log(1024));
	$pow = min($pow, count($units) - 1);

	$bytes /= pow(1024, $pow);

	return round($bytes, $precision) . ' ' . $units[$pow];
}

/*** Spočtení souborů ve složce ***/
function pocet_souboru($slozka){

$adresar = opendir($slozka);
$num=0;while ($soubor = readdir($adresar)){$num++;}
$num = $num-2;if ($num=="-2"){$num=0;}
return $num;}

function dirSize($directory) {
	$size = 0;
	foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory)) as $file){
		$size+=$file->getSize();
	}
	return $size;
}

/*** rekurzivní výpis složky ***/
function getDirectory($path, $files = "*", $icon = "", $recursive = 1 ){

$cesta = "{$path}/{$files}";
$icon != "" ? $style = "_{$icon}" : $style = $icon;
$ignore = array('cgi-bin', '.', '..');

$result = "<ul class=\"soubory\">\n";
//prochazeni slozky
foreach (glob($cesta, GLOB_BRACE) as $polozka)
{
	if (!in_array($polozka, $ignore))
	{
	$pol = basename($polozka);
	if (is_dir($polozka))
	{ //rekurze
		$result .= "<li class=\"dir\">{$pol} <span class=\"chmod\">Velikost: ".formatBytes(dirSize($path."/".$pol))." / Souborů: ". pocet_souboru($path."/".$pol) ." / Práva: ".substr(decoct(fileperms($path."/".$pol)),2)."</span></li>\n";
		if ($recursive == 1) { $result .= getDirectory( "{$path}{$pol}", $files, $icon ); };
	}
		else
	{
		$result .= "<li class=\"file{$style}\">{$pol} <span class=\"chmod\">".formatBytes(filesize($path."/".$pol))."</span></li>\n";
	}
	}
}
$result .= "</ul>\n";

return $result;
};

$mp3 = getDirectory( ".", "*", "mp3" );
?>
