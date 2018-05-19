<?php
/*
 *      tokenizer.php
 *
 *      Copyright 2011 geniv <geniv.radek@gmail.com>
 *
 */
//TODO predelat do lepsiho kabatku, vylepsit o prochazeni slozek, pripane o nejake gui
//obalit do tridy, malincko jeste prepsat....

  //load autoload
  require 'loader.php';

/* hledani neinicializovanych proemennych
<?php
$initialized = array();
$tokens = token_get_all($source);
foreach ($tokens as $i => $token) {
    if ($token[0] === T_VARIABLE) {
        if ($tokens[$i+1] === '=') {
            $initialized[$token[1]] = true;
        } elseif (!$initialized[$token[1]]) {
            echo "Uninitialized variable $token[1] on line $token[2].\n";
        }
    }
}
?>
*/

  $path = 'token';
  $files = Core::getListFile(array('path' => $path));
  foreach ($files as $file) {
    $min = Tokenizer::getMiniVersion(sprintf('%s/%s', $path, $file));
    file_put_contents(sprintf('%s/min_%s', $path, $file), $min);
  }
  //TODO dosefovat!!!!!! a dodelat!!!! a poradne!
  echo 'complete...';

  class Tokenizer {
    const VERSION = '1.0';

    public static function getMiniVersion($filename) {
      //input file
      $input = file_get_contents($filename);

      $space = $output = '';
      $set = '!"#$&\'()*+,-./:;<=>?@[\]^`{|}';
      $set = array_flip(preg_split('//',$set));

      $tokens = token_get_all($input);
      foreach ($tokens as $token)  {
        if (!is_array($token)) {
          $token = array(0, $token);
        }

        switch ($token[0]) {
          case T_COMMENT:
          case T_DOC_COMMENT:
          case T_WHITESPACE:
            $space = ' ';
          break;

          default:
            if (isset($set[substr($output, -1)]) || isset($set[$token[1]{0}])) {
              $space = '';
            }
            $output .= $space . $token[1];
            $space = '';
          break;
        }
      }

      return $output;
    }
  }


  //highlight_string($output);

  //output file
  //file_put_contents(sprintf('compile_%s', $file_name), $output);

?>
