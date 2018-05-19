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
    const VERSION = '1.0';

    public static function getAutoPath($dir, $class) {
      return sprintf('%s/.%s.json', $dir, $class);
    }

    private static function checkExtension() {
      if (!extension_loaded('json')) {
        echo 'Missing Apache extension JSON!';
        exit(1);
      }
    }

    public static function getData($path, $assoc = true) {
      try {

        self::checkExtension();

        $result = NULL;
        if (!empty($path)) {
          if (file_exists($path)) {
            $data = file_get_contents($path);
            $result = json_decode($data, $assoc);
          }
        } else {
          throw new ExceptionJsonStorage('The path must not be empty!');
        }

      } catch (ExceptionJsonStorage $e) {
        echo $e;
      }

      return $result;
    }

    public static function setData($path, array $data) {
      try {

        self::checkExtension();

        $result = false;
        if (!empty($path)) {
          //TODO overovat jestli se da zapisovat do pathu?
          $json = json_encode($data);
          if (!$result = file_put_contents($path, $json)) {
            throw new ExceptionJsonStorage('Failed to write data!');
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
