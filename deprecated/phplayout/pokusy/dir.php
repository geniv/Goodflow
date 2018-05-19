<?php

function getDirectory($path)
{
  $cesta = "{$path}/*";
  $ignore = array('cgi-bin', '.', '..');
  $result = "<ul>\n";
  //prochazeni slozky
  foreach (glob($cesta) as $polozka)
  {
    if (!in_array($polozka, $ignore))
    {
      $pol = basename($polozka);
      if (is_dir($polozka))
      { //rekurze
        $result .= "<li class=\"dir\">DIR: {$pol}</li>\n";
        $result .= getDirectory("{$path}/{$pol}");
      }
        else
      {
        $result .= "<li class=\"file\">{$pol}</li>\n";
      }
    }
  }
  $result .= "</ul>\n";

  return $result;
}

echo getDirectory("../pokusy");

/*
function getDirectory( $path ){
	global $out;
	$out .= '<ul>';
	$ignore = array( 'cgi-bin', '.', '..' );

	$dh = opendir( $path );
	while( false !== ( $file = readdir( $dh ) ) ){
		if( !in_array( $file, $ignore ) ){
			if( is_dir( $path . $file ) ){
				$out .= '<li class="dir">'.$file.'</li>';
				getDirectory( $path.$file.'/' );
			} else {
				$out .= '<li class="file">'.$file.'</li>';
			}
		}
	}
	$out .= '</ul>';
};
*/

?>
