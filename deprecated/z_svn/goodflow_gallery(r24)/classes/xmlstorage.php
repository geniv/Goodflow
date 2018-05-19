<?php
/*
 *      xmlstorage.php
 *
 *      Copyright 2011 geniv <geniv.radek@gmail.com>
 *
 */

  namespace classes;

  use SimpleXMLElement,
      Exception;

  final class XmlStorage {
    const VERSION = '1.2';

    public static function getAutoPath($dir, $class) {
      return sprintf('%s/.%s.xml', $dir, $class);
    }

    private static function checkExtension() {
      if (!extension_loaded('simplexml')) {
        echo 'Missing Apache extension SimpleXML!';
        exit(1);
      }
    }

    public static function getData($path) {
      try {

        self::checkExtension();

        $result = NULL;
        if (!empty($path)) {
          if (file_exists($path)) {
            $xml = simplexml_load_file($path);
            $result = self::recursiveToArray($xml);
          }
        } else {
          throw new ExceptionXmlStorage('Path nesmi byt prazdny!');
        }

      } catch (ExceptionXmlStorage $e) {
        echo $e;
      }

      return $result;
    }

    private static function recursiveToArray($xml) {

      $result = array();
      foreach ($xml as $value) {
        $atr = $value->attributes();
        $key = (string) $atr->name;

        switch ($atr->type) {
          case 'array':
            $result[$key] = self::recursiveToArray($value);
          break;

          case 'string':
            $result[$key] = base64_decode($value);
          break;

          case 'boolean':
            $result[$key] = ($value == 1);
          break;

          case 'integer':
            $result[$key] = (integer) $value;
          break;

          case 'double':
            $result[$key] = (float) $value;
          break;

          case 'NULL':
          break;
        }
      }

      return $result;
    }

    private static function recursiveToXml($data, $xml = NULL) {

      if ($xml == NULL) {
        $xml = new SimpleXMLElement('<xmlstorage></xmlstorage>');
      }

      foreach ($data as $key => $value) {
        $type = gettype($value);

        switch ($type) {
          case 'array':
            $node = $xml->addChild('key');
            $node->addAttribute('name', $key);
            $node->addAttribute('type', $type);
            self::recursiveToXml($value, $node);
          break;

          case 'string':
            $node = $xml->addChild('key', base64_encode($value));
            $node->addAttribute('name', $key);
            $node->addAttribute('type', $type);
          break;

          case 'boolean':
            $node = $xml->addChild('key', ($value ? 1 : 0));
            $node->addAttribute('name', $key);
            $node->addAttribute('type', $type);
          break;

          case 'integer':
          case 'double':
            $node = $xml->addChild('key', $value);
            $node->addAttribute('name', $key);
            $node->addAttribute('type', $type);
          break;

          case 'NULL':
            //slouzi pro mazani
          break;

          default:
            echo sprintf('neznami typ %s!', $type);
          break;
        }
      }

      return $xml;
    }

    public static function setData($path, array $data) {
      try {

        self::checkExtension();

        $result = false;
        if (!empty($path)) {
          $xml = self::recursiveToXml($data);
          if (!$result = $xml->asXML($path)) {
            throw new ExceptionXmlStorage('xml se nepodarilo zapsat!');
          }
        } else {
          throw new ExceptionXmlStorage('Path nesmi byt prazdny!');
        }

      } catch (ExceptionXmlStorage $e) {
        echo $e;
      }

      return $result;
    }
  }

  class ExceptionXmlStorage extends Exception {}

/*
$xml_path = XmlStorage::getAutoPath(__DIR__, __CLASS__);
$data = XmlStorage::getData($xml_path);
XmlStorage::setData($xml_path, $form->getValues())
*/
?>
