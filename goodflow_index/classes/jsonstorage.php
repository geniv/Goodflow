<?php
/*
 *      jsonstorage.php
 *
 *      Copyright 2011 geniv <geniv.radek@gmail.com>
 *
 */

  namespace classes;

  use Exception;

  final class JsonStorage {
    const VERSION = 1.07;

    public static function getAutoPath($dir, $class) {
      return sprintf('%s/.%s.json', $dir, $class);
    }

    private static function checkExtension() {
      if (!extension_loaded('json')) {
        echo 'Missing Apache extension JSON!';
        exit(1);
      }
    }

//nacitani dat do json
    public static function getData($path, $assoc = true) {
      try {

        self::checkExtension();

        $result = NULL;
        if (!empty($path)) {
          if (file_exists($path)) {
            if (is_readable($path)) {
              $data = file_get_contents($path);
              $result = json_decode($data, $assoc);
            } else {
              throw new ExceptionJsonStorage('Path is not readable!');
            }

            //detekce chyb
            switch (json_last_error()) {
              case JSON_ERROR_NONE:
              break;

              case JSON_ERROR_DEPTH:
                throw new ExceptionJsonStorage('Maximum stack depth exceeded');
              break;

              case JSON_ERROR_STATE_MISMATCH:
                throw new ExceptionJsonStorage('Underflow or the modes mismatch');
              break;

              case JSON_ERROR_CTRL_CHAR:
                throw new ExceptionJsonStorage('Unexpected control character found');
              break;
              case JSON_ERROR_SYNTAX:
                throw new ExceptionJsonStorage('Syntax error, malformed JSON');
              break;

              case JSON_ERROR_UTF8:
                throw new ExceptionJsonStorage('Malformed UTF-8 characters, possibly incorrectly encoded');
              break;

              default:
                throw new ExceptionJsonStorage('Unknown error');
              break;
            }
          }
        } else {
          throw new ExceptionJsonStorage('The path must not be empty!');
        }

      } catch (ExceptionJsonStorage $e) {
        echo $e;
      }

      return $result;
    }

//ukladani dat do json
    public static function setData($path, array $data) {
      try {

        self::checkExtension();

        $result = false;
        if (!empty($path)) {
          if (file_exists($path) && !is_writable($path)) {
            throw new ExceptionJsonStorage('Path is not writable!');
          }
          $json = json_encode($data);
          if (!$result = @file_put_contents($path, $json)) {
            throw new ExceptionJsonStorage(sprintf('Unable to write data to "%s"', $path));
          }
        } else {
          throw new ExceptionJsonStorage('The path must not be empty!');
        }

      } catch (ExceptionJsonStorage $e) {
        echo $e;
      }

      return $result;
    }
  }

  class ExceptionJsonStorage extends Exception {}


/*
$p = JsonStorage::getAutoPath(__DIR__, __CLASS__);
JsonStorage::setData($p, $form->getValues());
var_dump(JsonStorage::getData($p));
*/
?>
